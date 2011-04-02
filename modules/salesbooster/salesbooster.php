<?php

/*
 * Réalisé par Webbax
 * http://www.webbax.ch
 * contact@webbax.ch
 * 04.11.2010 Export vers comparateurs de produits
 */

/* Correctifs
 * V0.1 | 06.11.10 - Correction nom de la catégorie faussait l'url avec "->"
 * V0.1 | 16.11.10 - Modification de l'encodage CSV / pour pouvoir ouvrir avec excel
 * V0.2 | -
 * V0.3 | 22.11.10 - Modification du traitement Google Shopping "y/n" au lieu de "o/n"
 * V0.4 | 03.12.10 - Intégration de l'export shopping.com
 *                 - Plugin jquery checkboxtree
 *                 - Correction dans la sélection des catégories
 * V0.5 | 22.12.10 - Google Shopping description tronquée à 70 char + minuscule
 * V0.6 | 10.01.11 - Tous les noeuds sont fermés au démarrage
 * V0.7 | 07.02.11 - Calcul des frais de ports Offerts selon le poids ou le prix (défini dans le BO)
 * V0.8 | 06.03.11 - Modifications de la sélection des articles par catégories (passage par ps_category_product)
 *                 - Option supplémentaire pour prendres les produits en stock / hors stock
 * V0.9 | 11.03.11 - Corrections Shopzilla / ajout form. frais de ports + poids
 *                 - Possibilité de sélectionner le transporteur
 */

class Salesbooster extends Module{

    private $_html = '';
    private $_postErrors = array();

    private $line = array();
    private $line_combinaison = array();
    private $file = array();
    private $products_id_list = array();

    public function __construct(){
        $this->name = 'salesbooster';
        $this->tab = 'Tools';
        $this->version = '0.9';
        parent::__construct();

        $this->displayName = $this->l('Sales booster');
        $this->description = $this->l('Propulse vos articles vers les différents comparateurs de produits');
        $this->confirmUninstall = $this->l('Etes-vous sûr de vouloir désinstaller ce module ?');
    }

    /*
     * Installe le module
     * @param   -
     * @return  -
    */
    public function install(){
        if(!parent::install())
            return false;
        return $this->registerHook('home');
    }

    /*
     * Désinstalle le module
     * @param   -
     * @return  -
    */
    public function uninstall(){
        if(!parent::uninstall())
            return false;
        return true;
    }

    /*
     * Valide le formulaire
     * @param   -
     * @return  -
    */
    private function _postValidation(){}

    /*
     * Export les articles
     * @param   -
     * @return  -
    */
    private function _postProcess(){
        if(isset($_POST['btnSubmit'])){
            
            $comparator = $_POST['comparator'];
            $comparator_filename = $_POST['comparator'];
            $secondhand = 0;
            require_once(dirname(__FILE__).'/'.$comparator.'.php');

            $link_file = $this->getHttpHost().__PS_BASE_URI__.'modules/salesbooster/downloads/'.$comparator_filename.'.txt';
            $message =  $this->l('Opération effectuée').'<br/>'.
                        '<br/>'.$this->l('Lien vers le fichier catalogue').' : <br/>
                        <a href="'.$link_file.'" target="_blank"><img src="../modules/salesbooster/link_file.png"/> '.$link_file.'</a><br/>
                        <a href="../modules/salesbooster/downloads/download.php?file='.$comparator_filename.'"><img src="../modules/salesbooster/save.png"/> '.$this->l('Télécharger le fichier').'</a>';

            $file = array();
            $export_combination = $_POST['export_combination'];
            $categories_selected = @$_POST['categories'];
            if(!is_array($categories_selected)){$categories_selected=array();}
            $languages = $_POST['languages'];
            @$shipping_time = $_POST['shipping_time'];
            @$warranty = $_POST['warranty'];
            @$id_zone = $_POST['id_zone'];
            $special_offer = @$_POST['special_offer']; // shopzilla
            $rewriting_settings = Configuration::get('PS_REWRITING_SETTINGS');
            $shipping_handling = Configuration::get('PS_SHIPPING_HANDLING');
            $id_currency = Configuration::get('PS_CURRENCY_DEFAULT');
            
             // transporteur
            $id_carrier = @$_POST['id_carrier'];
            if(empty($id_carrier)){$id_carrier = Configuration::get('PS_CARRIER_DEFAULT');}
            
            $Carrier = new Carrier($id_carrier);
            $carrier = $Carrier->getFields();
            // récupère la taxe pour le transporteur
            // si le shop utilise la TVA
            $res = Db::getInstance()->ExecuteS('SELECT `id_tax` FROM `'._DB_PREFIX_.'tax` WHERE `id_tax` = '.$carrier['id_tax']);
            if(!empty($res)){
                $Tax = new Tax($carrier['id_tax']);
                $tax = $Tax->getFields();
                $rate_carrier = $tax['rate'];
            // si le shop est sans TVA
            }else{
                $rate_carrier = 0;
            }

            // récupère l'id de la monnaie EUR
            $currencies = Currency::getCurrencies();
            foreach($currencies as $currency){
                if($currency['iso_code']=='EUR'){
                    $id_currency = $currency['id_currency'];
                }
            }
            global $cookie;
            $cookie->id_currency = $id_currency;
            // Code iso monnaie
            $Currency = new Currency($id_currency);
            $currency = $Currency->getFields();
            $currency_iso_code = $currency['iso_code'];

            // Sélectionne la liste des catégories produit
            $sql = 'SELECT id_category FROM '._DB_PREFIX_.'category c
                    WHERE c.`id_parent` != "0"';
            $categories = Db::getInstance()->ExecuteS($sql);

            // Parcourt la langue
            foreach($languages as $id_lang){

                // Parcourt les catégorie
                foreach($categories as $id_cat){
                                           
                    $id_cat = $id_cat['id_category'];
                    if(in_array($id_cat,$categories_selected)){ // si la catégorie est sélectionnée
           
                        $Category = new Category($id_cat,$id_lang);
                        $sql = 'SELECT * FROM '._DB_PREFIX_.'product p
                            LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
                            ON p.`id_product` = pl.`id_product`
                            LEFT JOIN `'._DB_PREFIX_.'category_product` cp
                            ON p.`id_product` = cp.`id_product`
                            WHERE cp.`id_category` = '.$id_cat.'
                            AND pl.`id_lang` = '.$id_lang.'
                            AND active = 1';
                            
                        $products = Db::getInstance()->ExecuteS($sql);

                        foreach($products as $product){                  

                            // lignes de produits
                            $Product = new Product($product['id_product']);
                            $this->line = array(); // vide la ligne
                            //----------------
                            // Leguide
                            //----------------
                            $this->build_line(@$order_fields[0],'');
                                $category_name_and_sub_category = $this->sanitize(Tools::getPath(intval($Category->id),$Category->name));
                            $this->build_line(@$order_fields[1],$category_name_and_sub_category);
                            $this->build_line(@$order_fields[2],$product['id_product']);
                            $this->build_line(@$order_fields[3],$product['name']);
                            $this->build_line(@$order_fields[4],$this->sanitize($product['description_short']));
                                $price = round($Product->getPrice(),2);
                            $this->build_line(@$order_fields[5],$price);
                                // Si l'url rewrite est activé
                                if($rewriting_settings){
                                    $url_product = $this->getHttpHost().__PS_BASE_URI__.$Category->link_rewrite.'/'.$product['id_product'].'-'.$product['link_rewrite'].'.html';
                                }else{
                                    $url_product = $this->getHttpHost().__PS_BASE_URI__.'product.php?id_product='.$product['id_product'];
                                }
                            $this->build_line(@$order_fields[6],$url_product);
                                $product_image = $Product->getImages($id_lang);
                                $id_image_prod = @$product_image[0]['id_image'];
                            $this->build_line(@$order_fields[7],$this->getHttpHost().__PS_BASE_URI__.'img/p/'.$product['id_product'].'-'.$id_image_prod.'-large.jpg');

                                $shipping_price = $shipping_handling+$Carrier->getDeliveryPriceByWeight($product['weight'],$id_zone);
                                $shipping_price = round(($shipping_price*$rate_carrier/100)+$shipping_price,2);

                                // Offre les frais de ports si + elevé que X Eur ou que X Kg (selon configuration PS)
                                if(@$_POST['shipping']=='PS_SHIPPING_FREE_WEIGHT'){
                                    if($product['weight']>=Configuration::get('PS_SHIPPING_FREE_WEIGHT')){
                                       $shipping_price = 0;
                                    }
                                }elseif(@$_POST['shipping']=='PS_SHIPPING_FREE_PRICE'){
                                    if($price>=Configuration::get('PS_SHIPPING_FREE_PRICE')){
                                        $shipping_price = 0;
                                    }
                                }

                            $this->build_line(@$order_fields[8],$shipping_price);
                            $this->build_line(@$order_fields[9],$in_stock);
                            $this->build_line(@$order_fields[10],$shipping_time);
                            $this->build_line(@$order_fields[11],$warranty);
                            $this->build_line(@$order_fields[12],$product['supplier_reference']);
                            $this->build_line(@$order_fields[13],$product['ecotax']);
                            $this->build_line(@$order_fields[14],Manufacturer::getNameById($product['id_manufacturer'])); // fabricant
                            $this->build_line(@$order_fields[15],$product['ean13']);
                                if($product['reduction_price']==0 && $product['reduction_percent']==0){
                                    $price_without_reduc='';
                                    $promotion_type = 0;
                                }else{
                                    $promotion_type = 1;
                                    if($product['reduction_price']!=0){
                                        $price_without_reduc = round($price+$product['reduction_price'],2);
                                    }else{
                                        $price_without_reduc = round($price/(1-($product['reduction_percent']/100)),2);
                                    }
                                }
                            $this->build_line(@$order_fields[16],$price_without_reduc);
                            $this->build_line(@$order_fields[17],$currency_iso_code);
                            $this->build_line(@$order_fields[18],$secondhand);
                            $this->build_line(@$order_fields[19],$promotion_type);
                            $this->build_line(@$order_fields[20],''); // URL_mobile
                            $this->build_line(@$order_fields[21],''); // réserve
                            $this->build_line(@$order_fields[22],''); // réserve
                            $this->build_line(@$order_fields[23],''); // réserve
                            $this->build_line(@$order_fields[24],''); // réserve
                            $this->build_line(@$order_fields[25],''); // réserve
                            //----------------
                            // Shopzilla
                            //----------------
                            $this->build_line(@$order_fields[26],$special_offer);
                            $this->build_line(@$order_fields[27],''); // réserve
                            $this->build_line(@$order_fields[28],''); // enchère
                            $this->build_line(@$order_fields[29],''); // réserve
                            $this->build_line(@$order_fields[30],''); // réserve
                            $this->build_line(@$order_fields[31],''); // réserve
                            $this->build_line(@$order_fields[32],''); // réserve
                            $this->build_line(@$order_fields[33],''); // réserve
                            //----------------
                            // Kelkoo
                            //----------------
                            $this->build_line(@$order_fields[34],substr($this->sanitize($product['name']),0,85)); // 85 char max
                            $this->build_line(@$order_fields[35],substr($this->sanitize($product['description_short']),0,160)); // 160 char max
                            $this->build_line(@$order_fields[36],''); // date fin offre
                            $this->build_line(@$order_fields[37],'YES'); // delete
                            $this->build_line(@$order_fields[38],$price); // prix unitaire
                            $this->build_line(@$order_fields[39],''); // réserve
                            $this->build_line(@$order_fields[40],''); // réserve
                            $this->build_line(@$order_fields[41],''); // réserve
                            $this->build_line(@$order_fields[42],''); // réserve
                            $this->build_line(@$order_fields[43],''); // réserve
                            $this->build_line(@$order_fields[44],''); // réserve
                            $this->build_line(@$order_fields[45],''); // réserve
                            $this->build_line(@$order_fields[46],''); // réserve
                            $this->build_line(@$order_fields[47],''); // réserve
                            $this->build_line(@$order_fields[48],''); // réserve
                            $this->build_line(@$order_fields[49],''); // réserve
                            $this->build_line(@$order_fields[50],''); // réserve
                            $this->build_line(@$order_fields[51],''); // réserve
                            $this->build_line(@$order_fields[52],''); // réserve
                            $this->build_line(@$order_fields[53],''); // réserve
                            $this->build_line(@$order_fields[54],''); // réserve
                            $this->build_line(@$order_fields[55],''); // réserve
                            $this->build_line(@$order_fields[56],''); // réserve
                            $this->build_line(@$order_fields[57],''); // réserve
                            //----------------
                            // I-comparateur
                            //----------------
                            $this->build_line(@$order_fields[58],''); // text promo.
                            $this->build_line(@$order_fields[59],$product['weight']); // poids
                            $this->build_line(@$order_fields[60],$this->getHttpHost().__PS_BASE_URI__.'img/p/'.$product['id_product'].'-'.$id_image_prod.'-medium.jpg');
                            $this->build_line(@$order_fields[61],''); // réserve
                            $this->build_line(@$order_fields[62],''); // réserve
                            $this->build_line(@$order_fields[63],''); // réserve
                            $this->build_line(@$order_fields[64],''); // réserve
                            $this->build_line(@$order_fields[65],''); // réserve
                            //----------------
                            // Google shopping
                            //----------------
                            $this->build_line(@$order_fields[66],$product['ean13']); // gtin
                            $this->build_line(@$order_fields[67],$product['quantity']);
                            $this->build_line(@$order_fields[68],':::'.$shipping_price);
                            $this->build_line(@$order_fields[69],''); // tva
                            $this->build_line(@$order_fields[70],''); // caractéristiques
                            $this->build_line(@$order_fields[71],'y'); // en ligne uniquement
                            $this->build_line(@$order_fields[72],''); // date expiration
                            $this->build_line(@$order_fields[73],''); // genre
                                  if($promotion_type){$promo_google_shopping = 'y';}else{$promo_google_shopping = 'n';}
                            $this->build_line(@$order_fields[74],$promo_google_shopping);
                            $this->build_line(@$order_fields[75],''); // couleur
                            $this->build_line(@$order_fields[76],''); // taille
                            $this->build_line(@$order_fields[77],''); // année
                            $this->build_line(@$order_fields[78],''); // auteur
                            $this->build_line(@$order_fields[79],''); // édition
                            $this->build_line(@$order_fields[80],Manufacturer::getNameById($product['id_manufacturer'])); // marque
                            $this->build_line(@$order_fields[81],  strtolower(substr($product['name'],0,70))); // nom
                            $this->build_line(@$order_fields[82],''); // réserve
                            $this->build_line(@$order_fields[83],''); // réserve
                            $this->build_line(@$order_fields[84],''); // réserve
                            $this->build_line(@$order_fields[85],''); // réserve
                            //
                            //----------------
                            // Twenga
                            //----------------
                            $this->build_line(@$order_fields[86],1); // product_type
                            $this->build_line(@$order_fields[87],''); // ISBN
                            $this->build_line(@$order_fields[88],''); // marque
                            //
                            //----------------
                            // Shopping.com
                            //----------------
                            $this->build_line(@$order_fields[89],''); // MPN
                            $this->build_line(@$order_fields[90],''); // CUP
                            $this->build_line(@$order_fields[91],''); // url mobile
                            $this->build_line(@$order_fields[92],''); // id cat
                            $this->build_line(@$order_fields[93],''); // nom cat
                            $this->build_line(@$order_fields[94],''); // sous cat
                            $this->build_line(@$order_fields[95],''); // ref. parent
                            $this->build_line(@$order_fields[96],''); // nom parent
                            $this->build_line(@$order_fields[97],''); // desc. longue
                            $this->build_line(@$order_fields[98],''); // desc. stock
                            $this->build_line(@$order_fields[99],''); // puce produit 1
                            $this->build_line(@$order_fields[100],''); // puce produit 2
                            $this->build_line(@$order_fields[101],''); // puce produit 3
                            $this->build_line(@$order_fields[102],''); // puce produit 4
                            $this->build_line(@$order_fields[103],''); // puce produit 5
                            $this->build_line(@$order_fields[104],''); // url image alt. 1
                            $this->build_line(@$order_fields[105],''); // url image alt. 2
                            $this->build_line(@$order_fields[106],''); // url image alt. 3
                            $this->build_line(@$order_fields[107],''); // url image alt. 4
                            $this->build_line(@$order_fields[108],''); // url image alt. 5
                            $this->build_line(@$order_fields[109],''); // type de produit
                            $this->build_line(@$order_fields[110],''); // style
                            $this->build_line(@$order_fields[111],''); // sexe
                            $this->build_line(@$order_fields[112],''); // section
                            $this->build_line(@$order_fields[113],''); // tranche d'âge
                            $this->build_line(@$order_fields[114],''); // couleur
                            $this->build_line(@$order_fields[115],''); // matière
                            $this->build_line(@$order_fields[116],''); // réserve
                            $this->build_line(@$order_fields[117],''); // sport ou activité
                            $this->build_line(@$order_fields[118],''); // équipe
                            $this->build_line(@$order_fields[119],''); // ligue
                            $this->build_line(@$order_fields[120],''); // réserve
                            $this->build_line(@$order_fields[121],''); // plat. logi.
                            $this->build_line(@$order_fields[122],''); // cat. logi.
                            $this->build_line(@$order_fields[123],''); // type affichage
                            $this->build_line(@$order_fields[124],''); // type tél. port.
                            $this->build_line(@$order_fields[125],''); // opérateur
                            $this->build_line(@$order_fields[126],''); // type formule
                            $this->build_line(@$order_fields[127],''); // prof. utilisateur
                            $this->build_line(@$order_fields[128],''); // taille
                            $this->build_line(@$order_fields[129],''); // unité de mesure taille
                            $this->build_line(@$order_fields[130],''); // long. prod.
                            $this->build_line(@$order_fields[131],''); // unité. long.
                            $this->build_line(@$order_fields[132],''); // larg. prod.
                            $this->build_line(@$order_fields[133],''); // unité larg.
                            $this->build_line(@$order_fields[134],''); // haut. prod.
                            $this->build_line(@$order_fields[135],''); // unité haut.
                            $this->build_line(@$order_fields[136],''); // unité mes. poids
                            $this->build_line(@$order_fields[137],''); // prix à l'uni.
                            $this->build_line(@$order_fields[138],''); // meill. ventes
                            $this->build_line(@$order_fields[139],''); // date lanc.
                            $this->build_line(@$order_fields[140],''); // poids du colis
                            $this->build_line(@$order_fields[141],''); // code post.
                            $this->build_line(@$order_fields[142],''); // date envoi
                            $this->build_line(@$order_fields[143],''); // code av.
                            $this->build_line(@$order_fields[144],''); // desc. code av.
                            $this->build_line(@$order_fields[145],''); // type de march.
                            $this->build_line(@$order_fields[146],''); // offre gr.
                            $this->build_line(@$order_fields[147],''); // produits assoc.
                            $this->build_line(@$order_fields[148],''); // perso.
                            $this->build_line(@$order_fields[149],''); // réserve
                            $this->build_line(@$order_fields[150],''); // réserve
                            $this->build_line(@$order_fields[151],''); // réserve
                            $this->build_line(@$order_fields[152],''); // réserve
                            $this->build_line(@$order_fields[153],''); // réserve

                            // si on ne veut pas des combinaisons
                            if(!$export_combination){$product_has_attributes = 0;}else{$product_has_attributes = $Product->hasAttributes();}
                            // lignes de déclinaison
                            $combArray = array(); // création d'un array avec les combinaisons
                            if($product_has_attributes>0){
                                $combinaisons = $Product->getAttributeCombinaisons($id_lang);
                                if(is_array($combinaisons)){
                                    foreach($combinaisons AS $k => $combinaison){
                                        $combArray[$combinaison['id_product_attribute']]['id_product_attribute'] = $combinaison['id_product_attribute'];
                                        $combArray[$combinaison['id_product_attribute']]['price'] = $combinaison['price'];
                                        $combArray[$combinaison['id_product_attribute']]['weight'] = $combinaison['weight'];
                                        $combArray[$combinaison['id_product_attribute']]['quantity'] = $combinaison['quantity'];
                                        $combArray[$combinaison['id_product_attribute']]['supplier_reference'] = $combinaison['supplier_reference'];
                                        $combArray[$combinaison['id_product_attribute']]['ean13'] = $combinaison['ean13'];
                                        $combArray[$combinaison['id_product_attribute']]['id_image'] = isset($combinationImages[$combinaison['id_product_attribute']][0]['id_image']) ? $combinationImages[$combinaison['id_product_attribute']][0]['id_image'] : 0;
                                        $combArray[$combinaison['id_product_attribute']]['ecotax'] = $combinaison['ecotax'];
                                        $combArray[$combinaison['id_product_attribute']]['price'] = $combinaison['price'];
                                        $combArray[$combinaison['id_product_attribute']]['attributes'][] = array($combinaison['group_name'], $combinaison['attribute_name'], $combinaison['id_attribute']);
                                    }
                                }
                                if(isset($combArray)){

                                    // Crée la description de la déclinaison
                                    foreach($combArray AS $id_product_attribute => $product_attribute){
                                        $list = '';
                                        foreach($product_attribute['attributes'] AS $attribute){
                                            $list .= addslashes(htmlspecialchars($attribute[0])).' - '.addslashes(htmlspecialchars($attribute[1])).', ';
                                        }
                                        $list = rtrim($list,', '); // description

                                        $this->line_combination = array(); // vide la ligne
                                        //----------------
                                        // Leguide
                                        //----------------
                                        $this->build_line_combination(@$order_fields[0],'');
                                        $this->build_line_combination(@$order_fields[1],$category_name_and_sub_category);
                                        $this->build_line_combination(@$order_fields[2],$product['id_product'].'-'.$product_attribute['id_product_attribute']);
                                        $this->build_line_combination(@$order_fields[3],$product['name'].' '.stripslashes($list));
                                        $this->build_line_combination(@$order_fields[4],$this->sanitize($product['description_short']));
                                            $price = round($Product->getPrice(true,$product_attribute['id_product_attribute']),2);
                                        $this->build_line_combination(@$order_fields[5],$price);
                                        $this->build_line_combination(@$order_fields[6],$url_product);
                                            $product_image = $Product->_getAttributeImageAssociations($product_attribute['id_product_attribute']);
                                            $id_image_decl = $product_image[0];
                                            if($id_image_decl==0){$id_image_decl=$id_image_prod;}
                                        $this->build_line_combination(@$order_fields[7],$this->getHttpHost().__PS_BASE_URI__.'img/p/'.$product['id_product'].'-'.$id_image_decl.'-large.jpg');

                                            $shipping_price = $shipping_handling+$Carrier->getDeliveryPriceByWeight($product['weight']+$product_attribute['weight'],1);
                                            $shipping_price = round(($shipping_price*$rate_carrier/100)+$shipping_price,2);

                                             // Offre les frais de ports si + elevé que X Eur ou que X Kg (selon configuration PS)
                                            if(@$_POST['shipping']=='PS_SHIPPING_FREE_WEIGHT'){
                                                if($product['weight']>=Configuration::get('PS_SHIPPING_FREE_WEIGHT')){
                                                   $shipping_price = 0;
                                                }
                                            }elseif(@$_POST['shipping']=='PS_SHIPPING_FREE_PRICE'){
                                                if($price>=Configuration::get('PS_SHIPPING_FREE_PRICE')){
                                                    $shipping_price = 0;
                                                }
                                            }

                                        $this->build_line_combination(@$order_fields[8],$shipping_price);
                                        $this->build_line_combination(@$order_fields[9],$in_stock);
                                        $this->build_line_combination(@$order_fields[10],$shipping_time);
                                        $this->build_line_combination(@$order_fields[11],$warranty);
                                        $this->build_line_combination(@$order_fields[12],$product_attribute['supplier_reference']);
                                        $this->build_line_combination(@$order_fields[13],$product_attribute['ecotax']);
                                        $this->build_line_combination(@$order_fields[14],Manufacturer::getNameById($product['id_manufacturer']));
                                        $this->build_line_combination(@$order_fields[15],$product_attribute['ean13']);
                                            if($product['reduction_price']==0 && $product['reduction_percent']==0){
                                                $price_without_reduc='';
                                                $promotion_type = 0;
                                            }else{
                                                $promotion_type = 1;
                                                if($product['reduction_price']!=0){
                                                    $price_without_reduc = round($price+$product['reduction_price'],2);
                                                }else{
                                                    $price_without_reduc = round($price/(1-($product['reduction_percent']/100)),2);
                                                }
                                            }
                                        $this->build_line_combination(@$order_fields[16],$price_without_reduc); // prix sans réduction
                                        $this->build_line_combination(@$order_fields[17],$currency_iso_code);
                                        $this->build_line_combination(@$order_fields[18],$secondhand);
                                        $this->build_line_combination(@$order_fields[19],$promotion_type);
                                        $this->build_line_combination(@$order_fields[20],''); // URL_mobile
                                        $this->build_line_combination(@$order_fields[21],''); // réserve
                                        $this->build_line_combination(@$order_fields[22],''); // réserve
                                        $this->build_line_combination(@$order_fields[23],''); // réserve
                                        $this->build_line_combination(@$order_fields[24],''); // réserve
                                        $this->build_line_combination(@$order_fields[25],''); // réserve
                                        //----------------
                                        // Shopzilla
                                        //----------------
                                        $this->build_line_combination(@$order_fields[26],$special_offer);
                                        $this->build_line_combination(@$order_fields[27],''); // réserve
                                        $this->build_line_combination(@$order_fields[28],''); // enchère
                                        $this->build_line_combination(@$order_fields[29],''); // réserve
                                        $this->build_line_combination(@$order_fields[30],''); // réserve
                                        $this->build_line_combination(@$order_fields[31],''); // réserve
                                        $this->build_line_combination(@$order_fields[32],''); // réserve
                                        $this->build_line_combination(@$order_fields[33],''); // réserve
                                        //----------------
                                        // Kelkoo
                                        //----------------
                                        $this->build_line_combination(@$order_fields[34],substr($this->sanitize($product['name'].' '.stripslashes($list)),0,85)); // 85 char max
                                        $this->build_line_combination(@$order_fields[35],substr($this->sanitize($product['description_short']),0,160)); // 160 char max
                                        $this->build_line_combination(@$order_fields[36],''); // date fin offre
                                        $this->build_line_combination(@$order_fields[37],'YES'); // delete
                                        $this->build_line_combination(@$order_fields[38],$price); // prix unitaire
                                        $this->build_line_combination(@$order_fields[39],''); // réserve
                                        $this->build_line_combination(@$order_fields[40],''); // réserve
                                        $this->build_line_combination(@$order_fields[41],''); // réserve
                                        $this->build_line_combination(@$order_fields[42],''); // réserve
                                        $this->build_line_combination(@$order_fields[43],''); // réserve
                                        $this->build_line_combination(@$order_fields[44],''); // réserve
                                        $this->build_line_combination(@$order_fields[45],''); // réserve
                                        $this->build_line_combination(@$order_fields[46],''); // réserve
                                        $this->build_line_combination(@$order_fields[47],''); // réserve
                                        $this->build_line_combination(@$order_fields[48],''); // réserve
                                        $this->build_line_combination(@$order_fields[49],''); // réserve
                                        $this->build_line_combination(@$order_fields[50],''); // réserve
                                        $this->build_line_combination(@$order_fields[51],''); // réserve
                                        $this->build_line_combination(@$order_fields[52],''); // réserve
                                        $this->build_line_combination(@$order_fields[53],''); // réserve
                                        $this->build_line_combination(@$order_fields[54],''); // réserve
                                        $this->build_line_combination(@$order_fields[55],''); // réserve
                                        $this->build_line_combination(@$order_fields[56],''); // réserve
                                        $this->build_line_combination(@$order_fields[57],''); // réserve
                                        //----------------
                                        // I-comparateur
                                        //----------------
                                        $this->build_line_combination(@$order_fields[58],''); // text promo.
                                            $weight = $product['weight']+$product_attribute['weight'];
                                        $this->build_line_combination(@$order_fields[59],$weight); // poids
                                        $this->build_line_combination(@$order_fields[60],$this->getHttpHost().__PS_BASE_URI__.'img/p/'.$product['id_product'].'-'.$id_image_decl.'-medium.jpg');
                                        $this->build_line_combination(@$order_fields[61],''); // réserve
                                        $this->build_line_combination(@$order_fields[62],''); // réserve
                                        $this->build_line_combination(@$order_fields[63],''); // réserve
                                        $this->build_line_combination(@$order_fields[64],''); // réserve
                                        $this->build_line_combination(@$order_fields[65],''); // réserve
                                        //----------------
                                        // Google shopping
                                        //----------------
                                        $this->build_line_combination(@$order_fields[66],$product_attribute['ean13']); // gtin
                                        $this->build_line_combination(@$order_fields[67],$product_attribute['quantity']);
                                        $this->build_line_combination(@$order_fields[68],':::'.$shipping_price);
                                        $this->build_line_combination(@$order_fields[69],''); // tva
                                        $this->build_line_combination(@$order_fields[70],''); // caractéristiques
                                        $this->build_line_combination(@$order_fields[71],'y'); // en ligne uniquement
                                        $this->build_line_combination(@$order_fields[72],''); // date expiration
                                        $this->build_line_combination(@$order_fields[73],''); // genre
                                            if($promotion_type){$promo_google_shopping = 'y';}else{$promo_google_shopping = 'n';}
                                        $this->build_line_combination(@$order_fields[74],$promo_google_shopping);
                                        $this->build_line_combination(@$order_fields[75],''); // couleur
                                        $this->build_line_combination(@$order_fields[76],''); // taille
                                        $this->build_line_combination(@$order_fields[77],''); // année
                                        $this->build_line_combination(@$order_fields[78],''); // auteur
                                        $this->build_line_combination(@$order_fields[79],''); // édition
                                        $this->build_line_combination(@$order_fields[80],Manufacturer::getNameById($product['id_manufacturer'])); // marque
                                        $this->build_line_combination(@$order_fields[81],strtolower(substr($product['name'].' '.stripslashes($list),0,70))); // nom
                                        $this->build_line_combination(@$order_fields[82],''); // réserve
                                        $this->build_line_combination(@$order_fields[83],''); // réserve
                                        $this->build_line_combination(@$order_fields[84],''); // réserve
                                        $this->build_line_combination(@$order_fields[85],''); // réserve
                                        //----------------
                                        // Twenga
                                        //----------------
                                        $this->build_line_combination(@$order_fields[86],1); // product_type
                                        $this->build_line_combination(@$order_fields[87],''); // ISBN
                                        $this->build_line_combination(@$order_fields[88],''); // marque
                                        //
                                        //----------------
                                        // Shopping.com
                                        //----------------
                                        $this->build_line_combination(@$order_fields[89],''); // MPN
                                        $this->build_line_combination(@$order_fields[90],''); // CUP
                                        $this->build_line_combination(@$order_fields[91],''); // url mobile
                                        $this->build_line_combination(@$order_fields[92],''); // id cat
                                        $this->build_line_combination(@$order_fields[93],''); // nom cat
                                        $this->build_line_combination(@$order_fields[94],''); // sous cat
                                        $this->build_line_combination(@$order_fields[95],''); // ref. parent
                                        $this->build_line_combination(@$order_fields[96],''); // nom parent
                                        $this->build_line_combination(@$order_fields[97],''); // desc. longue
                                        $this->build_line_combination(@$order_fields[98],''); // desc. stock
                                        $this->build_line_combination(@$order_fields[99],''); // puce produit 1
                                        $this->build_line_combination(@$order_fields[100],''); // puce produit 2
                                        $this->build_line_combination(@$order_fields[101],''); // puce produit 3
                                        $this->build_line_combination(@$order_fields[102],''); // puce produit 4
                                        $this->build_line_combination(@$order_fields[103],''); // puce produit 5
                                        $this->build_line_combination(@$order_fields[104],''); // url image alt. 1
                                        $this->build_line_combination(@$order_fields[105],''); // url image alt. 2
                                        $this->build_line_combination(@$order_fields[106],''); // url image alt. 3
                                        $this->build_line_combination(@$order_fields[107],''); // url image alt. 4
                                        $this->build_line_combination(@$order_fields[108],''); // url image alt. 5
                                        $this->build_line_combination(@$order_fields[109],''); // type de produit
                                        $this->build_line_combination(@$order_fields[110],''); // style
                                        $this->build_line_combination(@$order_fields[111],''); // sexe
                                        $this->build_line_combination(@$order_fields[112],''); // section
                                        $this->build_line_combination(@$order_fields[113],''); // tranche d'âge
                                        $this->build_line_combination(@$order_fields[114],''); // couleur
                                        $this->build_line_combination(@$order_fields[115],''); // matière
                                        $this->build_line_combination(@$order_fields[116],''); // réserve
                                        $this->build_line_combination(@$order_fields[117],''); // sport ou activité
                                        $this->build_line_combination(@$order_fields[118],''); // équipe
                                        $this->build_line_combination(@$order_fields[119],''); // ligue
                                        $this->build_line_combination(@$order_fields[120],''); // réserve
                                        $this->build_line_combination(@$order_fields[121],''); // plat. logi.
                                        $this->build_line_combination(@$order_fields[122],''); // cat. logi.
                                        $this->build_line_combination(@$order_fields[123],''); // type affichage
                                        $this->build_line_combination(@$order_fields[124],''); // type tél. port.
                                        $this->build_line_combination(@$order_fields[125],''); // opérateur
                                        $this->build_line_combination(@$order_fields[126],''); // type formule
                                        $this->build_line_combination(@$order_fields[127],''); // prof. utilisateur
                                        $this->build_line_combination(@$order_fields[128],''); // taille
                                        $this->build_line_combination(@$order_fields[129],''); // unité de mesure taille
                                        $this->build_line_combination(@$order_fields[130],''); // long. prod.
                                        $this->build_line_combination(@$order_fields[131],''); // unité. long.
                                        $this->build_line_combination(@$order_fields[132],''); // larg. prod.
                                        $this->build_line_combination(@$order_fields[133],''); // unité larg.
                                        $this->build_line_combination(@$order_fields[134],''); // haut. prod.
                                        $this->build_line_combination(@$order_fields[135],''); // unité haut.
                                        $this->build_line_combination(@$order_fields[136],''); // unité mes. poids
                                        $this->build_line_combination(@$order_fields[137],''); // prix à l'uni.
                                        $this->build_line_combination(@$order_fields[138],''); // meill. ventes
                                        $this->build_line_combination(@$order_fields[139],''); // date lanc.
                                        $this->build_line_combination(@$order_fields[140],''); // poids du colis
                                        $this->build_line_combination(@$order_fields[141],''); // code post.
                                        $this->build_line_combination(@$order_fields[142],''); // date envoi
                                        $this->build_line_combination(@$order_fields[143],''); // code av.
                                        $this->build_line_combination(@$order_fields[144],''); // desc. code av.
                                        $this->build_line_combination(@$order_fields[145],''); // type de march.
                                        $this->build_line_combination(@$order_fields[146],''); // offre gr.
                                        $this->build_line_combination(@$order_fields[147],''); // produits assoc.
                                        $this->build_line_combination(@$order_fields[148],''); // perso.
                                        $this->build_line_combination(@$order_fields[149],''); // réserve
                                        $this->build_line_combination(@$order_fields[150],''); // réserve
                                        $this->build_line_combination(@$order_fields[151],''); // réserve
                                        $this->build_line_combination(@$order_fields[152],''); // réserve
                                        $this->build_line_combination(@$order_fields[153],''); // réserve
                                        ksort($this->line_combination); // trie l'array
                                        // si le produit n'a pas déjà été ajouté via une autre catégorie
                                        if(!array_search($product['id_product'].'-'.$product_attribute['id_product_attribute'],$this->products_id_list)){
                                             // vérifie si l'on prend les produits en stock ou non
                                             $take_product = 0;
                                             if($_POST['take_stock_zero']==0){
                                                if($product_attribute['quantity']>0){
                                                 $take_product = 1;
                                                }
                                            }else{
                                                $take_product = 1;
                                            }
                                            if($take_product){
                                                $this->products_id_list[] = $product['id_product'].'-'.$product_attribute['id_product_attribute'];
                                                $this->file[] = $this->line_combination;
                                            }
                                        }
                                    }
                                }
                            }else{
                                ksort($this->line); // trie l'array
                                // si le produit n'a pas déjà été ajouté via une autre catégorie
                                if(!array_search($product['id_product'],$this->products_id_list)){
                                    // vérifie si l'on prend les produits en stock ou non
                                    $take_product = 0;
                                    if($_POST['take_stock_zero']==0){
                                        if($product['quantity']>0){
                                         $take_product = 1;
                                        }
                                    }else{
                                        $take_product = 1;
                                    }
                                    if($take_product){
                                        $this->products_id_list[] = $product['id_product'];
                                        $this->file[] = $this->line; // ajoute une nouvelle ligne au fichier
                                    }
                                }
                            }
                         } // end foreach products
                } // end if category selected
              } // end foreach categories
            } // end foreach languages
            $this->create_file($comparator_filename,$active_fields);
        } // end $_POST
        $this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('ok').'" />'.$message.'</div>';
    }

    /*
     * Affiche une description du module
     * @param   -
     * @return  -
    */
    private function _displaySalesBooster(){
        $this->_html .= '<b>'.$this->l('Ce module propulse vos articles vers les différents comparateurs de produits.').'</b><br />
        '.$this->l('Gagnez encore de nouveaux clients grâce à une meilleure visibilité.').'<br /><br />';
    }

    /*
     * Affiche le formulaire
     * @param   -
     * @return  -
    */
    private function _displayForm(){

        global $cookie;

        // monnaie par défaut
        $id_currency = Configuration::get('PS_CURRENCY_DEFAULT');
        $cookie->id_currency = $id_currency;
        $Currency = new Currency($id_currency);
        $currency = $Currency->getFields();

        // Crée l'arbre des catégories
        $depth = 0;
        $categTree = Category::getRootCategory()->recurseLiteCategTree($depth);
        function constructTreeNode($node){
            $ret = '<li>'."\n";
            $ret .= '<input type="checkbox" name="categories[]" value="'.$node['id'].'" /> '.$node['name']."\n";
            if(!empty($node['children']))
            {
                $ret .= '<ul style="padding-left:20px">'."\n";
                foreach ($node['children'] AS $child)
                        $ret .= constructTreeNode($child);
                $ret .= '</ul>'."\n";
            }
            $ret .= '</li>'."\n";
            return $ret;
        }

        $ulTree = '<br/><input type="checkbox" class="notchText"/><i><span class="SpanNotchText"> Cocher tout</span></i><br/><br/>';
        $ulTree .= '<div class="tree-top">' . $categTree['name'] . '</div>'."\n";
        $ulTree .=  '<ul class="tree">'."\n";
        foreach ($categTree['children'] AS $child)
                $ulTree .= constructTreeNode($child);
        $ulTree .=  '</ul>'."\n";

        // Liste les languages
        $id_lang_default = Configuration::get('PS_LANG_DEFAULT');
        $languages = Language::getLanguages();
        $form_languages = '';
        foreach($languages as $language){
            if($id_lang_default==$language['id_lang']){$checked='checked';}else{$checked='';}
            $form_languages .= ' <img src="../img/l/'.$language['id_lang'].'.jpg"/> <input type="checkbox" name="languages[]" value="'.$language['id_lang'].'" '.$checked.' />';
        }

        $form_stock_zero = '
        <select name="take_stock_zero">
            <option value="1">'.$this->l('Oui').'
            <option value="0" selected>'.$this->l('Non').'
        </select>';

        $form_combination = '
        <select name="export_combination">
            <option value="1">'.$this->l('Oui').'
            <option value="0" selected>'.$this->l('Non').'
        </select>';

        // Liste des transporteurs
        $carriers = Carrier::getCarriers($cookie->id_lang);
        $form_carriers = '<select name="id_carrier">';
            foreach($carriers as $c){
                $selected = '';
                if($c['id_carrier']==Configuration::get('PS_CARRIER_DEFAULT')){$selected='selected';}
                $form_carriers .= '<option value="'.$c['id_carrier'].' '.$selected.'">'.$c['name'];
            }
        $form_carriers .= '</select>';

        // Liste les délais de livraison
        $form_shipping_time = '<select name="shipping_time">';
        for($i=1;$i<=30;$i++){
            if($i>1){$jour = $this->l('jours');}else{$jour = $this->l('jour');}
            $form_shipping_time.= '<option value="'.$i.' '.$jour.'">'.$i.' '.$jour;
        }
        $form_shipping_time.= '</select>';

        // Liste des zones
        $Zone = new Zone();
        $zones = $Zone->getZones();
        $form_zones = '<select name="id_zone">';
        foreach($zones as $zone){
            if($zone['id_zone']==1){$selected='selected';}else{$selected='';}
            $form_zones.= '<option value="'.$zone['id_zone'].'" '.$selected.'>'.$zone['name'];
        }
        $form_zones.= '</select>';

        // Garantie
        $form_warranty = '<select name="warranty">';
        $form_warranty.= '<option value="0"'.$selected.'>'.$this->l('pas de garantie');
        for($i=1;$i<=12;$i++){
            $form_warranty.= '<option value="'.$i.' '.$this->l('mois').'" '.$selected.'>'.$i.' '.$this->l('mois');
        }
        $form_warranty.= '</select>';

        // Frais de ports offerts
        $form_shipping = '<select name="shipping">';
        $form_shipping.= '<option value="">'.$this->l('non');
        $form_shipping.= '<option value="PS_SHIPPING_FREE_WEIGHT">'.$this->l('selon poids').' ('.$this->l('offert à partir de').' '.Configuration::get('PS_SHIPPING_FREE_WEIGHT').' Kg )';
        $form_shipping.= '<option value="PS_SHIPPING_FREE_PRICE">'.$this->l('selon prix').' ('.$this->l('offert à partir de').' '.Configuration::get('PS_SHIPPING_FREE_PRICE').' '.$currency['iso_code'].')';
        $form_shipping.= '</select>';

        $this->_html .= '
        <!-- Checkboxtree -->
        <script type="text/javascript" src="../modules/salesbooster/checkboxtree/jquery.min.js"></script>
        <script type="text/javascript" src="../modules/salesbooster/checkboxtree/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../modules/salesbooster/checkboxtree/jquery-ui-lightness.css">
        <link rel="stylesheet" type="text/css" href="../modules/salesbooster/checkboxtree/jquery.checkboxtree.min.css">
        <script type="text/javascript" src="../modules/salesbooster/checkboxtree/jquery.checkboxtree.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                // lors du clique sur le guide on affiche le formulaire
                $("input:radio").click(function(){
                    var comparator;
                    comparator = $("input[name=comparator]:checked").val();
                    $(".comparator").hide();
                    $("#"+comparator).show();
                });
                // tree dynamique
                $(".tree").checkboxTree({
                    collapseImage: "../modules/salesbooster/checkboxtree/images/minus.png",
                    expandImage: "../modules/salesbooster/checkboxtree/images/plus.png",
                    collapsed:true
                });
                // cocher/décocher
                $(document).ready(function() {
                $(".notchText").click(function() { // clic sur la case cocher/decocher
                    var cases = $(".tree").find(":checkbox"); // on cherche les checkbox
                    if(this.checked){ // si "notchText" est coché
                        cases.attr("checked", true); // on coche les cases
                         $(".SpanNotchText").html(" Tout décocher"); // mise à jour du texte de SpanNotchText
                    }else{ // si on décoche "notchText"
                        cases.attr("checked", false);// on coche les cases
                    $(".SpanNotchText").html(" Cocher tout");// mise à jour du texte de SpanNotchText
                    }
                });
             });
           });
        </script>

        <fieldset>
            <legend><img src="../img/admin/contact.gif" />'.$this->l('Détail').'</legend>
            <table border="0" cellpadding="0" cellspacing="0" id="form">
                <tr>
                    <td><a href="http://www.leguide.com" target="_blank"><img src="../modules/salesbooster/img/logo_leguide.jpg"/></a></td><td><input type="radio" name="comparator" value="leguide"/></td>
                    <td width="50"></td>
                    <td><a href="http://www.shopzilla.fr" target="_blank"><img src="../modules/salesbooster/img/logo_shopzilla.jpg"/></a></td><td><input type="radio" name="comparator" value="shopzilla"/></td>
                    <td width="50"></td>
                    <td><a href="http://www.google.fr/merchants/merchantdashboard" target="_blank"><img src="../modules/salesbooster/img/logo_google_shopping.jpg"/></a></td><td><input type="radio" name="comparator" value="google_shopping"/></td>
                </tr>
                <tr>
                    <td><a href="http://www.kelkoo.fr" target="_blank"><img src="../modules/salesbooster/img/logo_kelkoo.jpg"/></a></td><td><input type="radio" name="comparator" value="kelkoo"/></td>
                    <td width="50"></td>
                    <td><a href="http://www.i-comparateur.com" target="_blank"><img src="../modules/salesbooster/img/logo_i-comparateur.jpg"/></a></td><td><input type="radio" name="comparator" value="i-comparateur"/></td>
                    <td width="50"></td>
                    <td><a href="http://www.twenga.fr" target="_blank"><img src="../modules/salesbooster/img/logo_twenga.jpg"/></a></td><td><input type="radio" name="comparator" value="twenga"/></td>
                </tr>
                <tr>
                    <td><a href="http://www.shopping.com" target="_blank"><img src="../modules/salesbooster/img/logo_shopping.jpg"/></a></td><td><input type="radio" name="comparator" value="shopping"/></td>
                    <td width="50"></td>
                    <td></td><td></td>
                    <td width="50"></td>
                    <td></td><td></td>
                </tr>
            </table>';

            require_once(dirname(__FILE__).'/form/form_leguide.php');
            require_once(dirname(__FILE__).'/form/form_shopzilla.php');
            require_once(dirname(__FILE__).'/form/form_kelkoo.php');
            require_once(dirname(__FILE__).'/form/form_i-comparateur.php');
            require_once(dirname(__FILE__).'/form/form_google_shopping.php');
            require_once(dirname(__FILE__).'/form/form_twenga.php');
            require_once(dirname(__FILE__).'/form/form_shopping.php');
            
            $this->_html .='</fieldset>';
    }

    /*
     * Lance l'affichage du module
     * @param   -
     * @return  -
    */
    public function getContent(){
        $this->_html = '<h2>'.$this->displayName.'</h2>';
        if(!empty($_POST)){
            $this->_postValidation();
            if(!sizeof($this->_postErrors))
                $this->_postProcess();
            else
                foreach ($this->_postErrors AS $err)
                $this->_html .= '<div class="alert error">'. $err .'</div>';
        }
        else
            $this->_html .= '';

        $this->_displaySalesBooster();
        $this->_displayForm();
        return $this->_html;
    }

    /*
     * Ajoute une ligne d'article
     * @param int (position du champ sur la ligne)
     * @param string (valeur)
     * @return -
     */
    private function build_line($pos,$val){
        if($pos!=0 && !empty($pos)){
            $this->line[$pos] = $val;
        }
    }

    /*
     * Ajoute une ligne  de combinaison
     * @param int (position du champ sur la ligne)
     * @param string (valeur)
     * @return -
     */
    private function build_line_combination($pos,$val){
        if($pos!=0 && !empty($pos)){
            $this->line_combination[$pos] = $val;
        }
    }

    /*
     * Crée le fichier avec le contenu
     * @param string (nom du comparateur)
     * @param int (no du dernier champ)
     * @return -
     */
    private function create_file($comparator,$last_field){

      $file_content = '';
      $separator = '|';
      if($comparator=='google_shopping' || $comparator=='shopzilla' || $comparator=='kelkoo'){$separator="\t";}
      if($comparator=='shopping'){$separator=';';}

      $file_content_debug = '';
      $separator_debug = ';';
      
      foreach($this->file as $line){
            foreach($line as $key=>$field){

              if($last_field==$key){
                 $file_content.=$field."\r\n";
                 //$field = substr(chr(255).chr(254).mb_convert_encoding($field, "UTF-16LE", "UTF-8"),2); // encodage pour le csv
                 $file_content_debug.=$field."\r\n";
              }else{
                 $file_content.=$field.$separator;
                // $field = substr(chr(255).chr(254).mb_convert_encoding($field, "UTF-16LE", "UTF-8"),2); // encodage pour le csv
                 $file_content_debug.=$field.$separator_debug;
              }
            }
            $f_txt= fopen(dirname(__FILE__).'/downloads/'.$comparator.'.txt','w+');
            fwrite($f_txt,$file_content);
            $f_csv= fopen(dirname(__FILE__).'/downloads/'.$comparator.'.csv','w+');
            fwrite($f_csv,$file_content_debug);
            
            if(!$f_txt){
                $this->_html = '<div class="alert error">'.$this->l('Erreur de création du fichier. Vérifiez que le répertoire "/modules/salesbooster/downloads/" est bien en CHMOD 777').'</div>';
            }
       }
    }

    /*
     * Nettoie la chaine
     * @param string (chaine)
     * @return string
     */
    public function sanitize($string){
        $string = Tools::htmlentitiesDecodeUTF8($string);
        $string = strip_tags($string);
        $string = str_replace(CHR(13).CHR(10),"",$string); // enlève les retours chariot
        $string = preg_replace('/<br\\s*?\/??>/i','', $string);
        return $string;
    }

    /*
     * Trouve l'Host ! // http pour tous les cas
     * @return string (host)
     */
    private function getHttpHost(){
        $host = $_SERVER['HTTP_HOST'];
        $host = 'http://'.$host;
        return $host;
    }

    /*
     * Pour debug var/array
     * @param var/array
     * @return -
     */
    public function debug($var){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }

}
