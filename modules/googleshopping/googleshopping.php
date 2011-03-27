<?php
/*
 *
 * Google Shopping
 *
 * @author Matthieu Fradcourt for igwane.com
 * @copyright igwane.com 2010
 * @version 1.6
 * @prestashopVersion 1.3.2
 */

require_once(_PS_MODULE_DIR_.'googleshopping'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'myTools.php');
require_once(_PS_MODULE_DIR_.'googleshopping'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'html2text.inc.php');
include("fonctions.php");				// fonctions

class GoogleShopping extends Module
{
	function __construct()
	{
		$this->name = 'googleshopping';
		$this->tab = 'Tools';
		$this->version = '1.61';

		parent::__construct();

		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Google Shopping');
		$this->description = $this->l('Exportez vos produits vers Google Shopping');
	}

	function install()
	{
		if(!parent::install())
		{
			return false;
		}
		return true;
	}

	public function getContent()
	{
		if(isset($_POST['generate']))
		{
			self::generateFile();
		}

		if(Configuration::get('GENERATE_FILE_IN_ROOT') == 1)
		{
			$get_file_url = 'http://'.myTools::getHttpHost(false, true).__PS_BASE_URI__.'googleshopping.xml';
		} else {
			$get_file_url = 'http://'.myTools::getHttpHost(false, true).__PS_BASE_URI__.'modules/'.$this->getName().'/file_exports/googleshopping.xml';
		}

		$output = '<h2>'.$this->displayName.'</h2>';
		$output .= $this->_displayForm();
		$output .= $this->l('Lien vers le fichier').' : <a href="'.$get_file_url.'">googleshopping.xml</a>';
		return $output;
	}

	private function _displayForm()
	{
		$options = '';
		$mpn = '';
		$generate_file_in_root = '';
		$quantity = '';
		$brand = '';
		$gtin = '';
		$selected_short = '';
		$selected_long = '';
		
		// Récupération des langues actives pour la boutique
		$languages = Language::getLanguages();
		foreach ($languages as $i => $lang)
		{
			$selected = '';
			if(Configuration::get('LANGUAGE') == ($i + 1))
			{
				$selected = 'selected';
			}
			$options .= '<option value="'.$lang['id_lang'].'" '.$selected.'>'.$lang['name'].'</option>';
		}

		// Checked sur la generate_root box si on veut générer le fichier à la racine du site
		if(Configuration::get('GENERATE_FILE_IN_ROOT') == 1)
		{
			$generate_file_in_root = "checked";
		}
		
		// Balises googleshopping optionnelles
		if(Configuration::get('GTIN') == 1)
		{
			$gtin = "checked";
		}
		if(Configuration::get('MPN') == 1)
		{
			$mpn = "checked";
		}
		if(Configuration::get('QUANTITY') == 1)
		{
			$quantity = "checked";
		}
		if(Configuration::get('BRAND') == 1)
		{
			$brand = "checked";
		}
		(intval(Configuration::get('DESCRIPTION')) === intval(1)) ? $selected_short = "selected" : $selected_long = "selected";

		$form = '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
		
		<fieldset style="float: right; width: 255px">
					<legend>'.$this->l('A propos').'</legend>
					<p style="font-size: 1.5em; font-weight: bold; padding-bottom: 0">'.$this->displayName.' '.$this->version.'</p>
					<p style="clear: both">
					'.$this->description.'
					</p>
					<p>Toutes les infos sur les spécifications du flux sur <a style="color: #7ba45b; text-decoration: underline;" href="http://www.google.com/support/merchants/bin/answer.py?hl=fr&answer=188494" target="_blank">Google Merchant</a></p>
		</fieldset>

		<fieldset class="space width3">
		<legend>'.$this->l('Paramètres').'</legend>
			<table>
				<tr>
					<td><label>'.$this->l('Langue').' </label></td>
					<td><select name="lang">'.$options.'</select></td>
				</tr>
				<tr>
					<td><label>'.$this->l('Générer le fichier à la racine du site').'</label></td>
					<td><input type="checkbox" name="generate_root" '.$generate_file_in_root.'></td>
				</tr>
				<tr>
					<td><label>'.$this->l('Références fabricants').'</label></td>
					<td><input type="checkbox" name="mpn" '.$mpn.'></td>
				</tr>
				<tr>
					<td><label>'.$this->l('Quantité de produits').'</label></td>
					<td><input type="checkbox" name="quantity" '.$quantity.'></td>
				</tr>
				<tr>
					<td><label>'.$this->l('Marque').'</label></td>
					<td><input type="checkbox" name="brand" '.$brand.'></td>
				</tr>
				<tr>
					<td><label>'.$this->l('Code EAN13').'</label></td>
					<td><input type="checkbox" name="gtin" '.$gtin.'></td>
				</tr>
				<tr>
					<td><label>'.$this->l('Type de description').'</label></td>
					<td>
						<select name="description">
							<option value="1" '.$selected_short.'>'.$this->l('Description courte').'</option>
							<option value="2" '.$selected_long.'>'.$this->l('Description longue').'</option>
						</select>
					</td>
				<tr>
					<td></td>
					<td></td>
				</tr>
			</table>
			<center><input name="generate" type="submit" value="'.$this->l('Générer le fichier').'"></center>
		</fieldset>	
		</form>
		';
		return $form;
	}

	public function getName()
	{
		$output = $this->name;
		return $output;
	}

	public function uninstall()
	{
		return parent::uninstall();
	}

	public static function generateFile()
	{
		global $link;
		$path_parts = pathinfo(__FILE__);

		$lang = $_POST['lang'];
		
		if(isset($_POST['lang']) && $_POST['lang'] != 0)
		{
			Configuration::updateValue('LANGUAGE', intval($_POST['lang']));
		}
		// Endroit où générer le fichier
		if(isset($_POST['generate_root']) && $_POST['generate_root'] === "on")
		{
			Configuration::updateValue('GENERATE_FILE_IN_ROOT', intval(1));
			$generate_file_path = "../googleshopping.xml";
		} else {
			Configuration::updateValue('GENERATE_FILE_IN_ROOT', intval(0));
			$generate_file_path = $path_parts["dirname"].'/file_exports/googleshopping.xml';
			@mkdir($path_parts["dirname"].'/file_exports', 0755, true);
			@chmod($path_parts["dirname"].'/file_exports', 0755);
		}
		// Gtin - Code EAN13
		if(isset($_POST['gtin']) && $_POST['gtin'] === "on")
		{
			Configuration::updateValue('GTIN', intval(1));
		} else {
			Configuration::updateValue('GTIN', intval(0));
		}
		// Référence fabricant
		if(isset($_POST['mpn']) && $_POST['mpn'] === "on")
		{
			Configuration::updateValue('MPN', intval(1));
		} else {
			Configuration::updateValue('MPN', intval(0));
		}
		// Quantité
		if(isset($_POST['quantity']) && $_POST['quantity'] === "on")
		{
			Configuration::updateValue('QUANTITY', intval(1));
		} else {
			Configuration::updateValue('QUANTITY', intval(0));
		}
		// Marque
		if(isset($_POST['brand']) && $_POST['brand'] === "on")
		{
			Configuration::updateValue('BRAND', intval(1));
		} else {
			Configuration::updateValue('BRAND', intval(0));
		}
		// Description
		if(isset($_POST['description']) && $_POST['description'] != 0)
		{
			Configuration::updateValue('DESCRIPTION', intval($_POST['description']));
		}

		//Google Shopping XML
		$xml = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
		$xml .= '<feed xmlns="http://www.w3.org/2005/Atom" xmlns:g="http://base.google.com/ns/1.0" encoding="UTF-8" >'."\n";
		$xml .= '<title>'.Configuration::get('PS_SHOP_NAME').'</title>'."\n";
		$xml .= '<link href="http://'.myTools::getHttpHost(false, true).__PS_BASE_URI__.'" rel="alternate" type="text/html"/>'."\n";
		$xml .= '<modified>'.date('Y-m-d').'T01:01:01Z</modified><author><name>'.Configuration::get('PS_SHOP_NAME').'</name></author>'."\n";

		$googleshoppingfile = fopen($generate_file_path,'w');

		fwrite($googleshoppingfile, $xml);

		$sql='SELECT * FROM '._DB_PREFIX_.'product p'.
		' LEFT JOIN '._DB_PREFIX_.'product_lang pl ON p.id_product = pl.id_product'.
		' WHERE p.active = 1 AND pl.id_lang='.$lang;

		$products = Db::getInstance()->ExecuteS($sql);

		$site_base = __PS_BASE_URI__;		// préfix du site
		$url_site = $_SERVER['HTTP_HOST'];	// url du site base Serveur
		$url_site_base_prestashop = $url_site.$site_base;
		
		$title_limit = 70;
		$description_limit = 10000;

		foreach($products as $product)
		{
			$xml_googleshopping ='';
			$cat_link_rew = Category::getLinkRewrite($product['id_category_default'], intval($lang));
			$product_link = $link->getProductLink($product['id_product'] , $product['link_rewrite'], $cat_link_rew);
			
			$title_crop = $product['name'];
			if(strlen($product['name']) > $title_limit)
			{
				$title_crop = substr($title_crop, 0, ($title_limit-1));
				$title_crop = substr($title_crop, 0, strrpos($title_crop," "));
			}
			
			if(intval(Configuration::get('DESCRIPTION')) === intval(2))
			{
				$description_crop = $product['description'];
			} else {
				$description_crop = $product['description_short'];
			}
			$description_crop = f_convert_text2("",$description_crop,false);
			
			if(strlen($description_crop) > $description_limit)
			{
				$description_crop = substr($description_crop, 0, ($description_limit-1));
				$description_crop = substr($description_crop, 0, strrpos($description_crop," "));
			}
			$xml_googleshopping .= '<entry>'."\n";
			$xml_googleshopping .= '<g:id>'.$product['id_product'].'</g:id>'."\n";
			$xml_googleshopping .= '<title>'.htmlspecialchars(ucfirst(mb_strtolower($title_crop,'UTF-8'))).'</title>'."\n";
			$xml_googleshopping .= '<link>'.$product_link.'</link>'."\n";
			$xml_googleshopping .= '<g:price>'.Product::getPriceStatic($product['id_product'],true,NULL,2).'</g:price>'."\n";
			$xml_googleshopping .= '<g:description>'.htmlspecialchars(mb_strtolower($description_crop, 'UTF-8'), null, 'UTF-8', false) /*htmlspecialchars(ucfirst(strtolower($description_crop)))*/.'</g:description>'."\n";
			$xml_googleshopping .= '<g:condition>new</g:condition>'."\n"; //condition = neuf, occasion, reconditionné OR new, used, refurbished
			if(Configuration::get('MPN') && $product['supplier_reference'] != '')
			{
				$xml_googleshopping .= '<g:mpn>'.$product['supplier_reference'].'</g:mpn>'; //ref fabricant
			}
			// Pour chaque image
			$images = Image::getImages($lang, $product['id_product']);
			$nbimages=0;
			foreach($images as $im)
			{
				$xml_googleshopping .= '<g:image_link>http://'.$url_site_base_prestashop.'img/p/'.$product['id_product'].'-'.$im['id_image'].'-large.jpg</g:image_link>'."\n";
				if (++$nbimages == 10) break;
			}
			
			// Quantité et disponibilité
            if ($product['quantity'] != '' && $product['quantity'] != '0')
                {
                	$xml_googleshopping .= '<g:quantity>'.$product['quantity'].'</g:quantity>'."\n";
                	$xml_googleshopping .= '<g:availability>in stock</g:availability>'."\n";
                }    
                else{
                    $xml_googleshopping .= '<g:quantity>0</g:quantity>'."\n";
                    $xml_googleshopping .= '<g:availability>out of stock</g:availability>'."\n";
             	}
			
			if(Configuration::get('BRAND') && $product['id_manufacturer'] != '0')
			{
				$xml_googleshopping .= '<g:brand>'.Manufacturer::getNameById(intval($product['id_manufacturer'])).'</g:brand>';
			}
			if(Configuration::get('GTIN') && $product['ean13'] != '')
			{
				$xml_googleshopping .= '<g:gtin>'.$product['ean13'].'</g:gtin>';
			}
				$xml_googleshopping .= '</entry>'."\n";

			// Ecriture du produit dans l'XML googleshopping
			fwrite($googleshoppingfile, $xml_googleshopping);
		}

		$xml = '</feed>';
		fwrite($googleshoppingfile, $xml);
		fclose($googleshoppingfile);

		@chmod($generate_file_path, 0777);
		return true;
	}
}
?>