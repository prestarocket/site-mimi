<?php
//error_reporting(0);
$path = explode('/modules',dirname(__FILE__));
$settings = $path[0].'/config/settings.inc.php';
$config = $path[0].'/config/config.inc.php';
include("function.php");
$nom_module = $path[1];
include($settings);
include($config);
//error_reporting(0);
ini_set('memory_limit', '512M');
set_time_limit(0);
include("exportLengow.php");
$E = new exportLengow();
$E->secureDir($nom_module);
$flag_delim_poid='non';
$flag_delim_prix='non';

header('Content-Type: text/plain; charset=utf-8');

//LANG DU SITE : recup en bdd par default, sinon fr
$id_lang = getIdLang();

$sql_colonne_feature = 'SELECT fl.name, fl.id_feature FROM '.constant('_DB_PREFIX_').'feature_lang fl WHERE fl.id_lang='.$id_lang;
$sql_colonne_feature .= ' ORDER BY fl.id_feature ASC ';
$data_colonne_feature = Db::getInstance()->ExecuteS($sql_colonne_feature);

$entete = 'ID_PRODUCT|NAME_PRODUCT|REFERENCE_PRODUCT|SUPPLIER_REFERENCE|MANUFACTURER|CATEGORY|DESCRIPTION|DESCRIPTION_SHORT|PRICE_PRODUCT|WHOLESALE_PRICE|PRICE_HT|PRICE_REDUCTION|POURCENTAGE_REDUCTION|QUANTITY|WEIGHT|EAN|ECOTAX|AVAILABLE_PRODUCT|URL_PRODUCT|IMAGE_PRODUCT|PRODUCT_FEATURE|FDP|';

//FEATURE DES PRODUITS
$entete_feature='';
foreach($data_colonne_feature as $colonne_feature)
{
	$nom = str_replace(' ', '_', $colonne_feature['name']);
	$entete .= strtoupper($nom)."|";
	$entete_feature .=strtoupper($nom)."|";
}
$entete .='ID_MERE|DELAIS_LIVRAISON|IMAGE_PRODUCT_2|IMAGE_PRODUCT_3|';

//ATTRIBUTS DES PRODUITS
$entete_attribute='';
$sql_attribute_declinaison = 'SELECT DISTINCT(agl.name), agl.id_attribute_group FROM '.constant('_DB_PREFIX_').'product_attribute pa ';
$sql_attribute_declinaison .= ' LEFT JOIN '.constant('_DB_PREFIX_').'product_attribute_combination pac ON pa.id_product_attribute = pac.id_product_attribute';
$sql_attribute_declinaison .= ' LEFT JOIN '.constant('_DB_PREFIX_').'attribute a ON pac.id_attribute = a.id_attribute';
$sql_attribute_declinaison .= ' LEFT JOIN '.constant('_DB_PREFIX_').'attribute_lang al ON al.id_attribute = pac.id_attribute';
$sql_attribute_declinaison .= ' LEFT JOIN '.constant('_DB_PREFIX_').'attribute_group_lang agl ON agl.id_attribute_group = a.id_attribute_group';
$sql_attribute_declinaison .= ' WHERE al.id_lang ='.$id_lang.' AND agl.id_lang ='.$id_lang.' ORDER BY agl.id_attribute_group ASC';
$liste_attribute_declinaison =  Db::getInstance()->ExecuteS($sql_attribute_declinaison);
foreach($liste_attribute_declinaison as $attribute_declinaison)
{
	$nom = trim($attribute_declinaison['name']);
	$nom = str_replace(' ', '_', $attribute_declinaison['name']);
	$entete .= strtoupper($nom)."|";
	$entete_attribute .=strtoupper($nom)."|";
}
$entete = $entete."\r\n";
echo $entete;

$sql_produit = 'SELECT p.id_product,p.reference as reference_produit,p.supplier_reference, p.ean13,p.ecotax,p.quantity, pl.id_lang as lang, ';
$sql_produit .= ' p.price,t.rate as tax,p.reduction_percent, p.wholesale_price, p.reduction_price, p.id_category_default as category_id, ';
$sql_produit .='pl.description,pl.description_short,pl.name,pl.available_now,p.weight,m.name as manufacturer,';
$sql_produit .='(SELECT pi.id_image FROM '.constant('_DB_PREFIX_').'image pi WHERE pi.id_product=p.id_product AND pi.cover=1 LIMIT 1) as id_image,';
$sql_produit .='(SELECT cl.name FROM '.constant('_DB_PREFIX_').'category_lang cl INNER JOIN '.constant('_DB_PREFIX_').'category_product cp ON cp.id_category=cl.id_category ';
$sql_produit .='WHERE cl.id_lang='.$id_lang.' AND cp.id_product=p.id_product order by cp.position ASC LIMIT 1) as category ';
$sql_produit .='FROM '.constant('_DB_PREFIX_').'product p ';
$sql_produit .='LEFT JOIN '.constant('_DB_PREFIX_').'product_lang pl ON p.id_product=pl.id_product ';
$sql_produit .='LEFT JOIN '.constant('_DB_PREFIX_').'product_attribute pa ON p.id_product=pa.id_product ';
$sql_produit .='LEFT JOIN '.constant('_DB_PREFIX_').'manufacturer m ON m.id_manufacturer=p.id_manufacturer ';
$sql_produit .='LEFT JOIN '.constant('_DB_PREFIX_').'tax t ON t.id_tax=p.id_tax ';
$sql_produit .='WHERE pl.id_lang='.$id_lang.' AND p.active=1 ';

$tab_cat_selected_bdd = check_tab_parametre_lengow();
if(!empty($tab_cat_selected_bdd) && count($tab_cat_selected_bdd)>0)
{
	$list_cat_selected_bdd = implode(',', $tab_cat_selected_bdd);
	$sql_produit .= ' AND p.id_category_default in ('.$list_cat_selected_bdd.') ';
}

$tab_produit_selected_bdd = check_produit_parametre_lengow();
if(!empty($tab_produit_selected_bdd) && count($tab_produit_selected_bdd)>0)
{
	$list_produit_selected_bdd = implode(',', $tab_produit_selected_bdd);
	$sql_produit .= ' AND p.id_product in ('.$list_produit_selected_bdd.') ';
}

$sql_produit .='GROUP BY p.id_product';

$liste_produit = Db::getInstance()->ExecuteS($sql_produit);
//frais de port
$sql_config = 'SELECT name, value FROM '.constant('_DB_PREFIX_').'configuration ';
$data_conf = Db::getInstance()->ExecuteS($sql_config);
foreach($data_conf as $conf)
{
	if($conf['name'] == 'PS_SHIPPING_HANDLING')
	$frais_manut = $conf['value'];
	if($conf['name'] == 'PS_SHIPPING_FREE_PRICE')
	$free_prix = $conf['value'];
	if($conf['name'] == 'PS_SHIPPING_FREE_WEIGHT')
	$free_poid = $conf['value'];
	if($conf['name'] == 'PS_SHIPPING_METHOD')
	$mode = $conf['value'];
	if($conf['name'] == 'PS_CARRIER_DEFAULT')
	$id_carrier = $conf['value'];
	if($conf['name'] == 'PS_COUNTRY_DEFAULT')
	$id_pays = $conf['value'];
	if($conf['name'] == 'PS_TAX')
	$id_tax_conf = $conf['value'];
}

$sql_tax = 'SELECT rate FROM '.constant('_DB_PREFIX_').'tax WHERE id_tax='.$id_tax_conf;
$data_tax = Db::getInstance()->getRow($sql_tax);
$tax_conf = $data_tax['rate'];
$data_price2 = array();
if($mode == 0) //tranche prix
{
	$sql_range_price = 'SELECT c.id_carrier, rp.delimiter1, rp.delimiter2, t.rate, d.price ';
	$sql_range_price .='FROM '.constant('_DB_PREFIX_').'range_price rp ';
	$sql_range_price .='LEFT JOIN '.constant('_DB_PREFIX_').'carrier c ON c.id_carrier=rp.id_carrier ';
	$sql_range_price .='LEFT JOIN '.constant('_DB_PREFIX_').'tax t ON t.id_tax=c.id_tax ';
	$sql_range_price .='LEFT JOIN '.constant('_DB_PREFIX_').'delivery d ON rp.id_range_price=d.id_range_price ';
	$sql_range_price .='WHERE rp.id_carrier='.$id_carrier;
	$sql_range_price .=' AND d.id_zone=(SELECT id_zone FROM '.constant('_DB_PREFIX_').'country WHERE id_country='.$id_pays.') ORDER BY rp.delimiter1';
	$data_range_price =  Db::getInstance()->ExecuteS($sql_range_price);

	$cpt = 0;
	$numrow = count($data_range_price);
	foreach($data_range_price as $range_price)
	{
		$data_price[$cpt] = $range_price;
		if (++$cpt == $numrow)
		break;
	}
}
else //mode == 1 tranche poid
{
	$sql_range_weight = 'SELECT c.id_carrier, rw.delimiter1, rw.delimiter2, t.rate, d.price ';
	$sql_range_weight .='FROM '.constant('_DB_PREFIX_').'range_weight rw ';
	$sql_range_weight .='LEFT JOIN '.constant('_DB_PREFIX_').'carrier c ON c.id_carrier=rw.id_carrier ';
	$sql_range_weight .='LEFT JOIN '.constant('_DB_PREFIX_').'tax t ON t.id_tax=c.id_tax ';
	$sql_range_weight .='LEFT JOIN '.constant('_DB_PREFIX_').'delivery d ON rw.id_range_weight=d.id_range_weight ';
	$sql_range_weight .='WHERE rw.id_carrier='.$id_carrier;
	$sql_range_weight .=' AND d.id_zone=(SELECT id_zone FROM '.constant('_DB_PREFIX_').'country WHERE id_country='.$id_pays.') ORDER BY rw.delimiter1';
	$data_range_weight =  Db::getInstance()->ExecuteS($sql_range_weight);
	$cpt = 0;
	$numrow = count($data_range_weight);
	foreach($data_range_weight as $range_weight)
	{
		$data_weight[$cpt] = $range_weight;
		if (++$cpt == $numrow)
		break;
	}
}

//DELAIS DE LIVRAISON
$sql_delais_livraison = 'SELECT cl.delay FROM '.constant('_DB_PREFIX_').'carrier_lang cl ';
$sql_delais_livraison .= 'WHERE cl.id_lang='.$id_lang.' AND cl.id_carrier='.$id_carrier;
$data_delais_livraison = Db::getInstance()->getRow($sql_delais_livraison);
$delais_livraison = $data_delais_livraison['delay'];

// BOUCLE PRODUITS
foreach($liste_produit as $data)
{
	//ID_PRODUCT
	$id_product = $data['id_product'];

	// Description longue
	$description = ($data['description']);
	$description = nl2br($description);
	$description = $E->netoyage_html($description);

	// Description courte
	$description_short = ($data['description_short']);
	$description_short = nl2br($description_short);
	$description_short = $E->netoyage_html($description_short);

	// Categorie
	//$category = ($data['category']);
	$category = (getParentCategoy($data['category_id'], $id_lang));

	// Nom Produit
	$name = ($data['name']);

	// Disponibilité
	$available_now = ($data['available_now']);
	// Ecotax
	$ecotax = ($data['ecotax']);
	// EAN
	$ean13 = ($data['ean13']);

	// Référence
	$reference = $E->netoyage_html($data['reference_produit']);
	$reference = str_replace('-', '', $reference);
	// Référence Fournisseur
	$supplier_reference = $E->netoyage_html($data['supplier_reference']);
	$supplier_reference = str_replace('-', '', $supplier_reference);

	// Quantité
	$quantity = ($data['quantity']);
	// Fabricant
	$manufacturer = ($data['manufacturer']);

	// Prix
	$price = ($data['price'])+($data['price']*$data['tax']/100);
	$price = number_format(round($price, 2),2, '.', '');

	//Prix reduction
	if( ($data['reduction_percent'] > 0) || ($data['reduction_price'] > 0))
	{
		// Prix reduction (pourcentage)
		if($data['reduction_percent'] > 0)
		{
			//echo "reduction_price:".$data['reduction_percent']."%\n";
			$price_reduction = number_format(round($price-(($price*$data['reduction_percent'])/100),2),2, '.', '');
		}
		if($data['reduction_price'] > 0)
		{
			//echo "reduction_price:".$data['reduction_price']."\n";
			$price_reduction = number_format(round($price-$data['reduction_price'],2),2, '.', '');
		}
	}
	else
	{
		$price_reduction = number_format(round($price,2),2, '.', '');
	}

	// Prix achat HT - wholesale_price
	$wholesale_price = number_format(round($data['wholesale_price'],2),2, '.', '');
	// Prix vente HT
	$price_HT = number_format(round($data['price'],2),2, '.', '');

	// Pourcentage reduction
	$pourcentage_reduction = number_format(round($data['reduction_percent'],2),2, '.', '');
	// Poids
	$weight = ($data['weight']);
	// URL produit
	$url = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'product.php?id_product='.$data['id_product'];

	// URL image
	if($data['id_image'] > 0 or !empty($data['id_image']))
	{
		$image = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'img/p/'.$data['id_product'].'-'.$data['id_image'].'-large.jpg';
	}
	else
	{
		$image = '';
	}

	//Product feature
	$liste_colonne_feature = array();
	$sql_colonne_feature = 'SELECT fl.name, fl.id_feature FROM '.constant('_DB_PREFIX_').'feature_lang fl WHERE fl.id_lang='.$id_lang;
	$sql_colonne_feature .= ' ORDER BY fl.id_feature ASC ';
	$liste_colonne_feature = Db::getInstance()->ExecuteS($sql_colonne_feature);
	$product_feature = "";
	foreach($liste_colonne_feature as $data_colonne_feature)
	{
		$id_feature = $data_colonne_feature['id_feature'];
		$liste_value = array();
		$sql = 'SELECT fp.id_feature_value,fvl.value
		FROM '.constant('_DB_PREFIX_').'feature_product fp 
		LEFT JOIN '.constant('_DB_PREFIX_').'feature_value_lang fvl ON fp.id_feature_value = fvl.id_feature_value 
		WHERE 
		fp.id_feature='.$id_feature.' AND id_product="'.$data['id_product'].'" 
		AND fvl.id_lang="'.$id_lang.'"
		';
		$liste_value = Db::getInstance()->ExecuteS($sql);
		if(count($liste_value)>0)
		{
			$product_feature .= $liste_value[0]['value'].'|';
		}
		else
		{
			$product_feature .= ''.'|';
		}
	}

	//$product_feature = (substr($product_feature,2));
	if($mode == 0) //tranche prix
	{
		$fdp = fdp_prix($mode, $data_price, $price, $frais_manut, $free_prix, $tax_conf);
		//echo "fdp=".$fdp."\n";
	}
	else // tranche poid
	{
		$fdp = fdp_poid($mode, $data_weight, $weight, $frais_manut, $free_poid, $tax_conf);
		//	echo "fdp=".$fdp."\n";
	}

	//IMAGES SUPPLEMENTAIRE
	$sql_image_supp = 'SELECT pi.id_image FROM '.constant('_DB_PREFIX_').'image pi WHERE pi.id_product='.$data['id_product'].' AND pi.cover<>1 LIMIT 2';
	$liste_image_supp = Db::getInstance()->ExecuteS($sql_image_supp);
	if(count($liste_image_supp)>0)
	{
		if($liste_image_supp[0]['id_image'] > 0 or !empty($liste_image_supp[0]['id_image']))
		{
			$image2 = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'img/p/'.$data['id_product'].'-'.$liste_image_supp[0]['id_image'].'-large.jpg';
		}
		else
		{
			$image2 = '';
		}
		if($liste_image_supp[1]['id_image'] > 0 or !empty($liste_image_supp[1]['id_image']))
		{
			$image3 = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'img/p/'.$data['id_product'].'-'.$liste_image_supp[1]['id_image'].'-large.jpg';
		}
		else
		{
			$image3 = '';
		}
	}
	else
	{
		$image2 = '';
		$image3 = '';
	}

	//Product Attribute
	$product_attibute ='';
	foreach($liste_attribute_declinaison as $attribute_declinaison)
	{
		$product_attibute .= ''.'|';
	}

	// INSERTION DE LA LIGNE PRODUIT
	if($data['price'] != 0)
	echo $id_product.'|'.$name.'|'.$reference.'|'.$supplier_reference.'|'.$manufacturer.'|'.$category.'|'.$description.'|'.$description_short.'|'.$price.'|'.$wholesale_price.'|'.$price_HT.'|'.$price_reduction.'|'.$pourcentage_reduction.'|'.$quantity.'|'.$weight.'|'.$ean13.'|'.$ecotax.'|'.$available_now.'|'.$url.'|'.$image.'||'.$fdp.'|'.$product_feature.$id_product.'|'.$delais_livraison.'|'.$image2.'|'.$image3.'|'.$product_attibute."\r\n";
	//echo "id_product:".$id_product."\nname:".$name."\nreference:".$reference."\nsupplier_reference:".$supplier_reference."\nmanufacturer:".$manufacturer."\ncategory:".$category."\ndescription:".$description."\ndescription_short:".$description_short."\nprice:".$price."\nwholesale_price:".$wholesale_price."\nprice_HT:".$price_HT."\nprice_reduction:".$price_reduction."\npourcentage_reduction:".$pourcentage_reduction."\nquantity:".$quantity."\nweight:".$weight."\nean13:".$ean13."\necotax:".$ecotax."\navailable_now:".$available_now."\nurl:".$url."\nimage:".$image."\n\nfdp:".$fdp."\nproduct_attibute:".$product_attibute."\nproduct_feature:".$product_feature."\nid_mere:".$id_product."\ndelais_livraison:".$delais_livraison."\n"."---------------------\r\n";
}

if(isset($_GET['mode']) && $_GET['mode'] == 'full')
{
	$sql_declinaison_produit = 'SELECT pa.id_product_attribute,p.id_product,p.reference as reference_produit,pa.reference as reference_produit_declinaison,p.supplier_reference,pa.supplier_reference as supplier_reference_declinaison, p.ean13, pa.ean13 as ean13_declinaison , pa.ecotax, pa.quantity, pl.id_lang as lang, ';
	$sql_declinaison_produit .= ' p.price as price, pa.price as price_attribute,t.rate as tax,p.reduction_percent, pa.wholesale_price, p.reduction_price, p.id_category_default as category_id, ';
	$sql_declinaison_produit .='pl.description,pl.description_short,pl.name,pl.available_now,p.weight, pa.weight as poid_declinaison,m.name as manufacturer,';
	$sql_declinaison_produit .='(SELECT pi.id_image FROM '.constant('_DB_PREFIX_').'image pi WHERE pi.id_product=p.id_product AND pi.cover=1 LIMIT 1) as id_image,';
	$sql_declinaison_produit .='(SELECT pai.id_image FROM '.constant('_DB_PREFIX_').'product_attribute_image pai WHERE pai.id_product_attribute=pa.id_product_attribute LIMIT 1) as id_image2,';
	$sql_declinaison_produit .='(SELECT cl.name FROM '.constant('_DB_PREFIX_').'category_lang cl INNER JOIN '.constant('_DB_PREFIX_').'category_product cp ON cp.id_category=cl.id_category ';
	$sql_declinaison_produit .='WHERE cl.id_lang='.$id_lang.' AND cp.id_product=p.id_product order by cp.position ASC LIMIT 1) as category ';
	$sql_declinaison_produit .='FROM '.constant('_DB_PREFIX_').'product p ';
	$sql_declinaison_produit .='LEFT JOIN '.constant('_DB_PREFIX_').'product_lang pl ON p.id_product=pl.id_product ';
	$sql_declinaison_produit .='LEFT JOIN '.constant('_DB_PREFIX_').'product_attribute pa ON p.id_product=pa.id_product ';
	$sql_declinaison_produit .='LEFT JOIN '.constant('_DB_PREFIX_').'manufacturer m ON m.id_manufacturer=p.id_manufacturer ';
	$sql_declinaison_produit .='LEFT JOIN '.constant('_DB_PREFIX_').'tax t ON t.id_tax=p.id_tax ';
	$sql_declinaison_produit .='WHERE pl.id_lang='.$id_lang.' AND p.active=1 ';
	if(!empty($tab_cat_selected_bdd) && count($tab_cat_selected_bdd)>0)
	{
		$list_cat_selected_bdd = implode(',', $tab_cat_selected_bdd);
		$sql_declinaison_produit .= ' AND p.id_category_default in ('.$list_cat_selected_bdd.') ';
	}

	if(!empty($tab_produit_selected_bdd) && count($tab_produit_selected_bdd)>0)
	{
		$list_produit_selected_bdd = implode(',', $tab_produit_selected_bdd);
		$sql_declinaison_produit .= ' AND p.id_product in ('.$list_produit_selected_bdd.') ';
	}
	$liste_declinaison =  Db::getInstance()->ExecuteS($sql_declinaison_produit);
	//echo $sql_declinaison_produit;exit;

	// BOUCLE DECLINAISONS PRODUITS
	foreach($liste_declinaison as $data)
	{
		//ID_PRODUCT
		$id_product = $data['id_product']."_".$data['id_product_attribute'];

		// Description longue
		$description = ($data['description']);
		$description = nl2br($description);
		$description = $E->netoyage_html($description);

		// Description courte
		$description_short = ($data['description_short']);
		$description_short = nl2br($description_short);
		$description_short = $E->netoyage_html($description_short);

		// Categorie
		//$category = ($data['category']);
		$category = (getParentCategoy($data['category_id'], $id_lang));

		// Nom Produit
		$sql_feature_declinaison = 'SELECT agl.name, al.name AS valeur FROM '.constant('_DB_PREFIX_').'product_attribute pa ';
		$sql_feature_declinaison .= ' LEFT JOIN '.constant('_DB_PREFIX_').'product_attribute_combination pac ON pa.id_product_attribute = pac.id_product_attribute';
		$sql_feature_declinaison .= ' LEFT JOIN '.constant('_DB_PREFIX_').'attribute a ON pac.id_attribute = a.id_attribute';
		$sql_feature_declinaison .= ' LEFT JOIN '.constant('_DB_PREFIX_').'attribute_lang al ON al.id_attribute = pac.id_attribute';
		$sql_feature_declinaison .= ' LEFT JOIN '.constant('_DB_PREFIX_').'attribute_group_lang agl ON agl.id_attribute_group = a.id_attribute_group';
		$sql_feature_declinaison .= ' WHERE al.id_lang ='.$id_lang.' AND agl.id_lang ='.$id_lang.' AND pa.id_product_attribute ='.$data['id_product_attribute'];
		$liste_feature_declinaison =  Db::getInstance()->ExecuteS($sql_feature_declinaison);

		if(!empty($data['id_product_attribute']))
		{
			$feature_declinaison =" ";
			foreach($liste_feature_declinaison as $data_feature_declinaison)
			{
				$feature_declinaison .= $data_feature_declinaison['name'].' '.$data_feature_declinaison['valeur'].' ';
			}
			$feature_declinaison = rtrim($feature_declinaison);
			$name = ($data['name']).$feature_declinaison;
		}
		else
		{
			$name = $data['name'];
		}

		// Disponibilité
		$available_now = ($data['available_now']);
		// Ecotax
		$ecotax = ($data['ecotax']);
		// EAN
		if($data['ean13_declinaison'] !="")
		$ean13 = ($data['ean13_declinaison']);
		else
		$ean13 = ($data['ean13']);

		// Référence
		if($data['reference_produit_declinaison'] !="")
		$reference = ($data['reference_produit_declinaison']);
		else
		$reference = ($data['reference_produit']);

		// Référence Fournisseur
		if($data['supplier_reference_declinaison'] !="")
		$supplier_reference = ($data['supplier_reference_declinaison']);
		else
		$supplier_reference = ($data['supplier_reference']);

		// QuantitÃ©
		$quantity = ($data['quantity']);
		// Fabricant
		$manufacturer = ($data['manufacturer']);

		// Prix
		$price_tmp = $data['price']+$data['price_attribute'];
		$price = ($price_tmp)+($price_tmp*$data['tax']/100);
		$price = number_format(round($price, 2),2, '.', '');
		// Prix reduction
		if( ($data['reduction_percent'] > 0) || ($data['reduction_price'] > 0))
		{
			// Prix reduction (pourcentage)
			if($data['reduction_percent'] > 0)
			{
				//echo "reduction_price:".$data['reduction_percent']."%\n";
				$price_reduction = number_format(round($price-(($price*$data['reduction_percent'])/100),2),2, '.', '');
			}
			if($data['reduction_price'] > 0)
			{
				//echo "reduction_price:".$data['reduction_price']."\n";
				$price_reduction = number_format(round($price-$data['reduction_price'],2),2, '.', '');
			}
		}
		else
		{
			$price_reduction = number_format(round($price,2),2, '.', '');
		}	if( ($data['reduction_percent'] > 0) || ($data['reduction_price'] > 0))
		{
			// Prix reduction (pourcentage)
			if($data['reduction_percent'] > 0)
			{
				//echo "reduction_price:".$data['reduction_percent']."%\n";
				$price_reduction = number_format(round($price-(($price*$data['reduction_percent'])/100),2),2, '.', '');
			}
			if($data['reduction_price'] > 0)
			{
				//echo "reduction_price:".$data['reduction_price']."\n";
				$price_reduction = number_format(round($price-$data['reduction_price'],2),2, '.', '');
			}
		}
		else
		{
			$price_reduction = number_format(round($price,2),2, '.', '');
		}

		// Prix achat HT - wholesale_price
		$wholesale_price = number_format(round($data['wholesale_price'],2),2, '.', '');
		// Prix vente HT
		$price_HT = number_format(round($price_tmp,2),2, '.', '');

		// Pourcentage reduction
		$pourcentage_reduction = number_format(round($data['reduction_percent'],2),2, '.', '');
		// Poids
		$weight = ($data['weight']+$data['poid_declinaison']);
		// URL produit
		$url = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'product.php?id_product='.$data['id_product'];

		// URL image
		if($data['id_image'] > 0 or !empty($data['id_image']))
		{
			if($data['id_image2'] > 0 or !empty($data['id_image2']))
			$image = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'img/p/'.$data['id_product'].'-'.$data['id_image2'].'-large.jpg';
			else
			$image = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'img/p/'.$data['id_product'].'-'.$data['id_image'].'-large.jpg';
		}
		else{
			$image = '';
		}

		//Product feature
		$sql_colonne_feature = 'SELECT fl.name, fl.id_feature FROM '.constant('_DB_PREFIX_').'feature_lang fl WHERE fl.id_lang='.$id_lang;
		$sql_colonne_feature .= ' ORDER BY fl.id_feature ASC ';
		$liste_colonne_feature =  Db::getInstance()->ExecuteS($sql_colonne_feature);
		$product_feature = "";
		foreach($liste_colonne_feature as $data_colonne_feature)
		{
			$id_feature = $data_colonne_feature['id_feature'];
			$liste_value = array();
			$sql = 'SELECT fp.id_feature_value,fvl.value
			FROM '.constant('_DB_PREFIX_').'feature_product fp 
			LEFT JOIN '.constant('_DB_PREFIX_').'feature_value_lang fvl ON fp.id_feature_value = fvl.id_feature_value 
			WHERE 
			fp.id_feature='.$id_feature.' AND id_product="'.$data['id_product'].'" 
			AND fvl.id_lang="'.$id_lang.'"
			';
			$liste_value = Db::getInstance()->ExecuteS($sql);
			if(count($liste_value)>0)
			{
				$product_feature .= $liste_value[0]['value'].'|';
			}
			else
			{
				$product_feature .= ''.'|';
			}
		}

		if($mode == 0) //tranche prix
		{
			$fdp = fdp_prix($mode, $data_price, $price, $frais_manut, $free_prix, $tax_conf);
		}
		else // tranche poid
		{
			$fdp = fdp_poid($mode, $data_weight, $weight, $frais_manut, $free_poid, $tax_conf);
		}

		//IMAGES SUPPLEMENTAIRE
		$sql_image_supp = 'SELECT pi.id_image FROM '.constant('_DB_PREFIX_').'image pi WHERE pi.id_product='.$data['id_product'].' AND pi.cover<>1 LIMIT 2';
		$liste_image_supp = Db::getInstance()->ExecuteS($sql_image_supp);
		if(count($liste_image_supp)>0)
		{
			if($liste_image_supp[0]['id_image'] > 0 or !empty($liste_image_supp[0]['id_image']))
			{
				$image2 = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'img/p/'.$data['id_product'].'-'.$liste_image_supp[0]['id_image'].'-large.jpg';
			}
			else
			{
				$image2 = '';
			}
			if($liste_image_supp[1]['id_image'] > 0 or !empty($liste_image_supp[1]['id_image']))
			{
				$image3 = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'img/p/'.$data['id_product'].'-'.$liste_image_supp[1]['id_image'].'-large.jpg';
			}
			else
			{
				$image3 = '';
			}
		}
		else
		{
			$image2 = '';
			$image3 = '';
		}

		//Product Attribute
		$product_attibute = '';
		if($data['id_product_attribute'] != '')
		{
			foreach($liste_attribute_declinaison as $attribute)
			{
				$liste_attribute_produit = array();
				$sql_attribute_declinaison_produit = 'SELECT agl.name, al.name AS valeur FROM '.constant('_DB_PREFIX_').'product_attribute pa ';
				$sql_attribute_declinaison_produit .= ' LEFT JOIN '.constant('_DB_PREFIX_').'product_attribute_combination pac ON pa.id_product_attribute = pac.id_product_attribute';
				$sql_attribute_declinaison_produit .= ' LEFT JOIN '.constant('_DB_PREFIX_').'attribute a ON pac.id_attribute = a.id_attribute';
				$sql_attribute_declinaison_produit .= ' LEFT JOIN '.constant('_DB_PREFIX_').'attribute_lang al ON al.id_attribute = pac.id_attribute';
				$sql_attribute_declinaison_produit .= ' LEFT JOIN '.constant('_DB_PREFIX_').'attribute_group_lang agl ON agl.id_attribute_group = a.id_attribute_group';
				$sql_attribute_declinaison_produit .= ' WHERE al.id_lang ='.$id_lang.' AND agl.id_lang ='.$id_lang.' AND pa.id_product_attribute ='.$data['id_product_attribute'];
				$sql_attribute_declinaison_produit .= ' AND agl.id_attribute_group='.$attribute['id_attribute_group'];
				$liste_attribute_produit =  Db::getInstance()->ExecuteS($sql_attribute_declinaison_produit);
				$liste_attribute_produit = $liste_attribute_produit[0];

				if(count($liste_attribute_produit>0) && !empty($liste_attribute_produit))
				{
					$product_attibute .= $liste_attribute_produit['valeur'].'|';
				}
				else
				{
					$product_attibute .= ''.'|';
				}
			}
		}

		// INSERTION DE LA LIGNE PRODUIT
		if($data['id_product_attribute'] != NULL)
		echo $id_product.'|'.$name.'|'.$reference.'|'.$supplier_reference.'|'.$manufacturer.'|'.$category.'|'.$description.'|'.$description_short.'|'.$price.'|'.$wholesale_price.'|'.$price_HT.'|'.$price_reduction.'|'.$pourcentage_reduction.'|'.$quantity.'|'.$weight.'|'.$ean13.'|'.$ecotax.'|'.$available_now.'|'.$url.'|'.$image.'||'.$fdp.'|'.$product_feature.$data['id_product'].'|'.$delais_livraison.'|'.$image2.'|'.$image3.'|'.$product_attibute."\r\n";
	}
}


if((isset($_GET['debug'])) && ($_GET['debug'] ==1))
{
	echo "\n\n\n\n";
	if(isset($data_range_price[0]['delimiter1']) && ($mode == 0))
	{
		$flag_delim_prix = 'oui';
		print_r($data_range_price);
	}
	if(isset($data_range_weight[0]['delimiter1']) && ($mode == 1))
	{
		$flag_delim_poid = 'oui';
		print_r($data_range_weight);
	}
	echo '#PS_SHIPPING_HANDLING - frais_manut: '.$frais_manut."\n"
	.'#PS_SHIPPING_FREE_PRICE: '.$free_prix."\n".'#PS_SHIPPING_FREE_WEIGHT: '.$free_poid."\n"
	.'#PS_SHIPPING_METHOD: '.$mode."\n".'#PS_CARRIER_DEFAULT: '.$id_carrier."\n"
	.'#PS_COUNTRY_DEFAULT: '.$id_pays."\n".'#PS_TAX: '.$id_tax_conf."\n"
	.'#flag_delim_prix: '.$flag_delim_prix."\n".'#flag_delim_prix: '.$flag_delim_poid."\n";
	echo "tax_conf:".$tax_conf."\n";
	echo "sql_produit:".$sql_produit."\n";
	//	echo "sql_declinaison_produit:".$sql_declinaison_produit."\n";
	echo "entete:".$entete;
	echo "entete_feature:".$entete_feature."\n";
	echo "entete_attribute:".$entete_attribute."\n";
}
?>