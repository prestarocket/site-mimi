<?php
function getIdLang($code='')
{
	if($code == '')
	{
		$sql_langue_bdd = 'SELECT parametre_valeur FROM '.constant('_DB_PREFIX_').'parametre_lengow WHERE parametre_nom="lang_id"';
		$lang_id_bdd = Db::getInstance()->getRow($sql_langue_bdd);
		$id_lang = $lang_id_bdd['parametre_valeur'];

		if($id_lang=='')
		{
			$id_lang= getIdLang('fr');
			return $id_lang;
		}
		else
		{
			return $id_lang;
		}
	}
	else
	{
		$sql = 'SELECT id_lang FROM '.constant('_DB_PREFIX_').'lang WHERE iso_code="'.$code.'"';
		$data = Db::getInstance()->getRow($sql);
		$id_lang = $data['id_lang'];
		return $id_lang;
	}
}

function check_tab_parametre_lengow()
{
	//test de la présence de la table parametre_lengow
	$list_category = array();
	$list_parametre ='';

	$sql_parametre = 'SELECT count(*) as nb from '.constant('_DB_PREFIX_').'parametre_lengow';
	$list_parametre = Db::getInstance()->getRow($sql_parametre);

	if($list_parametre !='')
	{
		//echo "bdd ok<br />";
		$sql_categorie = 'SELECT parametre_valeur from '.constant('_DB_PREFIX_').'parametre_lengow WHERE parametre_nom="cat_id"';
		$resultat = Db::getInstance()->ExecuteS($sql_categorie);
		foreach($resultat as $key=>$value)
		{
			$list_category[$key]=$value['parametre_valeur'];
		}
	}
	else
	{
		//echo "bdd vide<br />";
		//creation de la table parametre_lengow
		$sql = "CREATE TABLE `".constant('_DB_PREFIX_')."parametre_lengow` (
		`id_parametre` INT NOT NULL AUTO_INCREMENT ,
		`parametre_nom` TEXT NOT NULL ,
		`parametre_valeur` TEXT NOT NULL ,
		PRIMARY KEY ( `id_parametre` )
		) DEFAULT CHARSET=utf8 ENGINE = MYISAM";
		//echo "sql: ".$sql."<br />";
		Db::getInstance()->ExecuteS($sql);
	}

	return $list_category;
}

function check_produit_parametre_lengow()
{
	$list_produit = array();
	$sql_produit = 'SELECT parametre_valeur from '.constant('_DB_PREFIX_').'parametre_lengow WHERE parametre_nom="product_id"';
	$resultat = Db::getInstance()->ExecuteS($sql_produit);
	foreach($resultat as $key=>$value)
	{
		$list_produit[$key]=$value['parametre_valeur'];
	}
	return $list_produit;
}


function fieldClientLengow($valeur='', $msg_erreur = '')
{
	$html = '<input size="5" maxlength="5" type="text" name="Clientid_lengow" value="';
	if($valeur !='')
	{
		$html .= $valeur;
	}
	$html .= '" />&nbsp;'.$msg_erreur.'';
	return $html;
}

function get_Clientid_lengow()
{
	$sql_client_id = 'SELECT parametre_valeur from '.constant('_DB_PREFIX_').'parametre_lengow WHERE parametre_nom="client_id"';
	$resultat = Db::getInstance()->getRow($sql_client_id);
	//echo "Clientid en bdd:".$resultat['parametre_valeur']."<br />";
	return $resultat['parametre_valeur'];
}

function set_Clientid_lengow($Clientid_lengow)
{
	//insertion en BDD si il nexiste pas, update sinon
	$id = get_Clientid_lengow();
	if($id !='')
	{
		$sql_Clientid = 'UPDATE '.constant('_DB_PREFIX_').'parametre_lengow SET parametre_valeur='.$Clientid_lengow.' WHERE parametre_nom ="client_id"';
		Db::getInstance()->ExecuteS($sql_Clientid);
	}
	else
	{
		$sql_Clientid = 'INSERT INTO '.constant('_DB_PREFIX_').'parametre_lengow (parametre_nom, parametre_valeur) VALUES ("client_id", '.$Clientid_lengow.')';
		Db::getInstance()->ExecuteS($sql_Clientid);
	}

	//ecriture dans le template
	$emplacement_template =_PS_THEME_DIR_."order-confirmation.tpl";
	$tag_lengow ='<!-- Tag_Lengow --><img src="https://tracking.lengow.com/lead.php?idClient='.$Clientid_lengow.'&price={$total}&idCommande={$id_order}" alt="" /><!-- /Tag_Lengow -->';
	
	if(!$id_template = fopen($emplacement_template, 'r'))
	{
		exit("Erreur ouverture template, vérifier les droits du fichier");
	}
	else
	{
		//recherche du tag Lengow
		$template ='';
		while (!feof($id_template))
		{ //on parcourt toutes les lignes
			$template .= fgets($id_template, 4096);
		}
		fclose($id_template);
		$pattern = '`<!-- Tag_Lengow -->(.*)<!-- /Tag_Lengow -->`Us';
		$recherche_tag_lengow = preg_match_all($pattern,$template,$resultat);

		if($resultat[0][0]!='')
		{
			//remplacement du tag
			$remplacement = $tag_lengow;
			$new_template = preg_replace($pattern, $remplacement, $template, -1, $count);

			//reouverture du template et re-écriture complete
			if(!$id_template = fopen($emplacement_template, 'w'))
			{
				exit("Erreur ouverture template, vérifier les droits du fichier");
			}
			else
			{
				fputs($id_template, "");
				fclose($id_template);
				$id_template = fopen($emplacement_template, 'r+');
				fputs($id_template, $new_template);
				fclose($id_template);
			}
		}
		else
		{
			//pose du tag
			if(!$id_template = fopen($emplacement_template, 'a+'))
			{
				exit("Erreur ouverture template, vérifier les droits du fichier");
			}
			else
			{
				fputs($id_template, $tag_lengow);
				fclose($id_template);
			}
		}
	}
	
	//ecriture dans le script order-confirmation.php
	$emplacement_script =_PS_ROOT_DIR_."/order-confirmation.php";
	$smarty_var = '$smarty->assign("total",$order->total_paid_real);';
	
	if(!$id_script = fopen($emplacement_script, 'r'))
	{
		exit("Erreur ouverture script, vérifier les droits du fichier");
	}
	else
	{
		//recherche du tag Lengow
		$script ='';
		while (!feof($id_script))
		{ //on parcourt toutes les lignes
			$script .= fgets($id_script, 4096);
		}
		fclose($id_script);
		$pos = false;
		$pos = strpos($script, $smarty_var);
		if($pos > 0)
		{
			//echo "code found<br/>";
		}
		else
		{
			//echo "code not found<br/>";
			//il faut ecrire le code avant le display smarty.
			$delimiter = '$smarty->display';
			$tab_script = explode($delimiter, $script);
			$new_script = $tab_script[0].$smarty_var.$delimiter.$tab_script[1];
			
			if(!$id_script = fopen($emplacement_script, 'w'))
			{
				exit("Erreur ouverture script, vérifier les droits du fichier");
			}
			else
			{
				fputs($id_script, "");
				fclose($id_script);
				$id_script = fopen($emplacement_script, 'r+');
				fputs($id_script, $new_script);
				fclose($id_script);
			}
		}
	}
}

function getTree($tab_cat_selected, $tab_produit_selected, $traduction_produit, $traduction_check_all)
{
	$img_dir = constant('_PS_ADMIN_IMG_');
	//$id_lang = getIdLang('fr');

	if(isset($_GET['id_lang']) && $_GET['id_lang']!='')
	{
		$id_lang = $_GET['id_lang'];
	}
	else
	{
		$id_lang = getIdLang();
	}

	$html ='';
	$html .= "<a href='#' onclick='checkAll(this);return false;' style='color:blue;text-decoration:none;font-size:11px'>";
	$html .= $traduction_check_all;
	$html .= "</a><br /><br />\n";
	
	$sql_category = 'SELECT c.id_category, c.level_depth, cl.name from '.constant('_DB_PREFIX_').'category c LEFT JOIN '.constant('_DB_PREFIX_').'category_lang cl ON c.id_category = cl.id_category ';
	//$sql_category .= ' WHERE c.level_depth=0 and c.id_parent = 0 and cl.id_lang='.$id_lang.' and c.active=1';
	$sql_category .= ' WHERE c.level_depth=1  and cl.id_lang='.$id_lang.' and c.active=1';
	$list_category = Db::getInstance()->ExecuteS($sql_category);

	foreach($list_category as $category)
	{
		$nb_product = getNbProductInCategory($category['id_category']);
		$html .= "<span><input style='vertical-align:middle' type='checkbox' value='".$category['id_category']."' name=id_cat[] id='cat_".$category['id_category']."' onclick='check_produit_cat(this, \"produit_cat_".$category['id_category']."\")'";
		if(count($tab_cat_selected)>0 && in_array($category['id_category'], $tab_cat_selected))
		{
			$html .= " checked";
		}
		else
		{
			$html .= "";
		}
		$html .= ">&nbsp;<label for='cat_".$category['id_category']."' style=' float:none; padding:0; text-align:left; width:auto;'>".cleanNomCategorie($category['name'])."</label>\n";
		$html .= "<a href='#' onclick='toggle_produit_cat(\"product_cat_".$category['id_category']."\");return false;' style='color:blue;text-decoration:none;font-size:11px'>";
		
		if($nb_product > 1)
		$html .= " (id : ".$category['id_category']." - <u>Voir les ".$nb_product." ".$traduction_produit."s)</u>\n";
		else
		$html .= " (id : ".$category['id_category']." - <u>Voir le ".$traduction_produit.")</u>\n";
		
		$html .= "</a>\n";
		$html .= getProductInCategory($category['id_category'], $id_lang, $category['level_depth'], $tab_produit_selected)."</span><br />";
		
		$html .= " </span><br /> \n";
		$html .= getBranch($category['id_category'],1, $id_lang, $tab_cat_selected, $tab_produit_selected, $traduction_produit);
	}
	return $html;
}

function getBranch($idCat, $level, $id_lang, $tab_cat_selected, $tab_produit_selected, $traduction_produit)
{
	$img_dir = constant('_PS_ADMIN_IMG_');
	$next_category_level = $level+1;
	$sql_category = 'SELECT c.id_category, c.level_depth, cl.name from '.constant('_DB_PREFIX_').'category c LEFT JOIN '.constant('_DB_PREFIX_').'category_lang cl ON c.id_category = cl.id_category ';
	$sql_category .= ' WHERE c.level_depth='.$next_category_level.' and c.id_parent = '.$idCat.' and cl.id_lang='.$id_lang.' and c.active=1';
	$list_category = Db::getInstance()->ExecuteS($sql_category);
	$html = "";
	$getBranch = "";
	foreach($list_category as $category)
	{
		$nb_product = getNbProductInCategory($category['id_category']);
		$getBranch = getBranch($category['id_category'],$category['level_depth'],$id_lang, $tab_cat_selected, $tab_produit_selected, $traduction_produit);
		$html .= str_repeat('&nbsp;', $category['level_depth']*3)." <span>";
		$html .= "<input type='checkbox' style='vertical-align:middle;border:1px solid #DDD' value='".$category['id_category']."' name=id_cat[] id='cat_".$category['id_category']."' onclick='check_produit_cat(this, \"produit_cat_".$category['id_category']."\")'";

		if(count($tab_cat_selected)>0 && in_array($category['id_category'], $tab_cat_selected))
		{
			$html .= " checked";
		}
		else
		{
			$html .= "";
		}
		$html .= ">&nbsp;<label for='cat_".$category['id_category']."' style=' float:none; padding:0; text-align:left; width:auto;'>".cleanNomCategorie($category['name'])."</label>";
		$html .= "<a href='#' onclick='toggle_produit_cat(\"product_cat_".$category['id_category']."\");return false;' style='color:blue;text-decoration:none;font-size:11px'>";
		
		if($nb_product > 1)
		$html .= " (id : ".$category['id_category']." - <u>Voir les ".$nb_product." ".$traduction_produit."s)</u>\n";
		else
		$html .= " (id : ".$category['id_category']." - <u>Voir le ".$traduction_produit.")</u>\n";
		
		$html .= "</a><br />\n";
		$html .= getProductInCategory($category['id_category'], $id_lang, $category['level_depth'], $tab_produit_selected)."</span><br />";
		$html .= $getBranch;
	}
	return $html;
}

function getProductInCategory($idCat, $id_lang, $level, $tab_produit_selected)
{
	$sql_product = 'SELECT DISTINCT pl.name, cp.id_product ';
	$sql_product.= 'FROM '.constant('_DB_PREFIX_').'category_product cp LEFT JOIN '.constant('_DB_PREFIX_').'product p ON cp.id_product=p.id_product ';
	$sql_product .='LEFT JOIN '.constant('_DB_PREFIX_').'product_lang pl ON p.id_product=pl.id_product ';
	$sql_product.= 'WHERE p.active=1 AND p.id_category_default='.$idCat.' AND pl.id_lang='.$id_lang.' GROUP BY cp.id_product';

	$list_produit = Db::getInstance()->ExecuteS($sql_product);

	$html ='<div id="product_cat_'.$idCat.'" style="display: none;line-height:25px">';
	foreach($list_produit as $produit)
	{
		$html .= str_repeat('&nbsp;', $level*8)." <input type='checkbox' style='vertical-align:middle' class='produit_cat_".$idCat."' value='".$produit['id_product']."' name=id_produit[] id='product_".$produit['id_product'];
		$html .= "' onclick='if(this.checked)check_cat(\"cat_".$idCat."\");'";
		if(count($tab_produit_selected)>0 && in_array($produit['id_product'], $tab_produit_selected))
		{
			$html .= " checked";
		}
		else
		{
			$html .= "";
		}
		$html .= ">&nbsp;<label for='product_".$produit['id_product']."' style=' float:none; padding:0; text-align:left; width:auto; font-weight: normal;'>".$produit['name'].' (id : '.$produit['id_product'].')</label><br />';
	}
	$html .='</div>';
	return $html;
}

function getNbProductInCategory($idCat)
{
	$sql_product = 'SELECT COUNT( DISTINCT cp.id_product) as nb_product ';
	$sql_product.= 'FROM '.constant('_DB_PREFIX_').'category_product cp LEFT JOIN '.constant('_DB_PREFIX_').'product p ON cp.id_product=p.id_product ';
	$sql_product.= 'WHERE p.active=1 AND p.id_category_default='.$idCat;
	$count_product = Db::getInstance()->ExecuteS($sql_product);
	$count_product = $count_product[0];
	if(count($count_product)>0)
	{
		$retour = $count_product['nb_product'];
	}
	else
	{
		$retour = 0;
	}
	return $retour;
}

function getNomCategorie($catID, $langID)
{
	$sql_categorie_nom .='SELECT cl.name  as category_name ';
	$sql_categorie_nom .='FROM '.constant('_DB_PREFIX_').'category_lang cl ';
	$sql_categorie_nom .='WHERE cl.id_lang='.$langID.' AND cl.id_category='.$catID;

	$data_categorie = Db::getInstance()->ExecuteS($sql_categorie_nom);
	$nom_cat = cleanNomCategorie($data_categorie[0]['category_name']);
	return trim($nom_cat);
}


function cleanNomCategorie($nom)
{
	$nom_cat = ereg_replace("^[0-9]*",'',$nom);
	$nom_cat = ereg_replace("^[-.]*",'',$nom_cat);
	$nom_cat = trim($nom_cat);
	return $nom_cat;
}

function fieldLangue()
{
	$html ='';
	$sql_langue = 'SELECT id_lang,name,iso_code FROM '.constant('_DB_PREFIX_').'lang WHERE active=1';
	$liste_langue = Db::getInstance()->ExecuteS($sql_langue);

	$sql_langue_bdd = 'SELECT parametre_valeur FROM '.constant('_DB_PREFIX_').'parametre_lengow WHERE parametre_nom="lang_id"';
	$lang_id_bdd = Db::getInstance()->getRow($sql_langue_bdd);
	$lang_id_bdd = $lang_id_bdd['parametre_valeur'];

	//print_r($liste_langue);
	$html .= '<select name="lang_id">';
	foreach($liste_langue as $langue)
	{
		if($langue['id_lang']==$lang_id_bdd)
		{
			$selected = 'selected';
		}
		else
		{
			$selected = '';
		}
		$html .= '<option value="'.$langue['id_lang'].'" "'.$selected.'>'.$langue['name'].'</option>';
	}
	$html .= '</select>';
	return $html;
}

function set_Lang_id($lang_id)
{
	//insertion en BDD si il nexiste pas, update sinon
	$sql_langue_bdd = 'SELECT parametre_valeur FROM '.constant('_DB_PREFIX_').'parametre_lengow WHERE parametre_nom="lang_id"';
	$lang_id_bdd = Db::getInstance()->getRow($sql_langue_bdd);
	$lang_id_bdd = $lang_id_bdd['parametre_valeur'];

	if($lang_id_bdd !='')
	{
		$sql_Lang_id = 'UPDATE '.constant('_DB_PREFIX_').'parametre_lengow SET parametre_valeur='.$lang_id.' WHERE parametre_nom ="lang_id"';
		Db::getInstance()->ExecuteS($sql_Lang_id);
	}
	else
	{
		$sql_Lang_id = 'INSERT INTO '.constant('_DB_PREFIX_').'parametre_lengow (parametre_nom, parametre_valeur) VALUES ("lang_id", '.$lang_id.')';
		Db::getInstance()->ExecuteS($sql_Lang_id);
	}
}

function getParentCategoy($catID, $langID, $nom_cat='')
{
	if($nom_cat =='')
	{
		$nom_cat = getNomCategorie($catID, $langID);
	}
	else
	{
		$nom_cat = getNomCategorie($catID, $langID).' > '.$nom_cat;
	}
	$sql_categorie_parent .='SELECT id_parent FROM '.constant('_DB_PREFIX_').'category  WHERE id_category='.$catID;
	$data_categorie_parent = Db::getInstance()->ExecuteS($sql_categorie_parent);
	if(isset($data_categorie_parent) && ($data_categorie_parent[0]['id_parent'] !=0))
	{
		$nom_cat = getParentCategoy($data_categorie_parent[0]['id_parent'], $langID, $nom_cat);
	}
	return $nom_cat;
}

function fdp_prix($mode, $data, $price, $frais_manut, $free_prix, $tax_conf)
{
	//echo "mode=".$mode."\n"."data=".print_r($data)."\n". "price=".$price."\n". "frais_manut=".$frais_manut."\n". "free_prix=".$free_prix."\n". "tax_conf=".$tax_conf."\n";
	$fdp = 0;
	if(isset($data[0]['delimiter1']))
	{
		foreach($data as $info)
		{
			if($price >= round($info['delimiter1'],0) && $price < $info['delimiter2'])
			{
				if($price<=$free_prix)
				{
					if($info['rate']!='')
					{
						$taux_tva =$info['rate'];
					}
					else
					{
						$taux_tva =$tax_conf;
					}
					$fdp_HT = $info['price']+$frais_manut;
					$tva = ($fdp_HT*$taux_tva)/100;
					$fdp = $fdp_HT+$tva;
					$fdp = round($fdp, 2);
					//echo "fdp fct=".$fdp."\n";
					return $fdp;
				}
				else
				{
					$fdp = 0;
					//echo "fdp fct=".$fdp."\n";
					return $fdp;
				}
			}
		}
	}
	else
	{
		if($price<=$free_prix)
		{
			$fdp_HT = $frais_manut;
			$tva = ($fdp_HT*$tax_conf)/100;
			$fdp = $fdp_HT+$tva;
			$fdp = round($fdp, 2);
			//echo "fdp fct=".$fdp."\n";
			return $fdp;
		}
		else
		{
			$fdp = 0;
			//echo "fdp fct=".$fdp."\n";
			return $fdp;
		}
	}
	return $fdp;
}
function fdp_poid($mode, $data, $weight, $frais_manut, $free_poid, $tax_conf)
{
	if(isset($data[0]['delimiter1']))
	{
		foreach($data as $info)
		{
			if($weight >= round($info['delimiter1'],0) && $weight < $info['delimiter2'])
			{
				if($weight<=$free_poid)
				{
					if($info['rate']!='')
					{
						$taux_tva =$info['rate'];
					}
					else
					{
						$taux_tva =$tax_conf;
					}
					$fdp_HT = $info['price']+$frais_manut;
					$tva = ($fdp_HT*$taux_tva)/100;
					$fdp = $fdp_HT+$tva;
					$fdp = round($fdp, 2);
					return $fdp;
				}
				else
				{
					$fdp = 0;
					return $fdp;
				}
			}
		}
	}
	else
	{
		if($weight<=$free_poid)
		{
			$fdp_HT = $frais_manut;
			$tva = ($fdp_HT*$tax_conf)/100;
			$fdp = $fdp_HT+$tva;
			$fdp = round($fdp, 2);
			return $fdp;
		}
		else
		{
			$fdp = 0;
			return $fdp;
		}
	}
	return $fdp;
}

class Error extends Exception
{
	public function __construct($Msg)
	{
		parent::__construct($Msg);
	}

	public function getError($request)
	{
		$output  = '<div><strong>'.$this->getMessage().'</strong>';
		$output .= 'Ligne: '.$this->getLine().'<br />'.
		$output .= 'Fichier: '.$this->getFile().'<br />'.
		$output .= 'Requete: '.$request.'<br /></div>';
		return $output;
	}
}
?>