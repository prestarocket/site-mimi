<?php
 /*  
  This file is part of Croll SEO Fixer module for Prestashop.
 
  Croll SEO Fixer is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  any later version.

  Croll SEO Fixer is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with Croll SEO Fixer.  If not, see <http://www.gnu.org/licenses/>.

 * crollseofixer class 
 * @category classes
 *
 * @author Christophe Beveraggi <beve@croll.fr>
 * @based on seofixer.php by K. Baylog (http://www.baylog.info) 
 * @version 1.2
 *
 */

class crollseofixer extends Module {

    function __construct() {
	$this->name = 'crollseofixer';
	$this->tab = 'Tools';
	$this->version = '1.2';

	parent::__construct();

	$this->page = basename(__FILE__, '.php');
	$this->displayName = $this->l('CROLL SEO Fixer');
	$this->description = $this->l('Redirects wrong product and category URLs to valid URL to avoid duplicate content.');
	$this->_rewriteEnabled = intval(Configuration::get('PS_REWRITING_SETTINGS'));

	if ($this->_rewriteEnabled !== 1)
	    $this->warning = $this->l('Enable Friendly URL in the shop configuration or this module is useless.');
    }

    function install() {
	if (!parent::install() OR !$this->registerHook('header')) return false;
	return true;
    }

    function hookHeader($params) {
	global $cookie;

	// Check if rewrite enabled and if page is redirected
	if ($this->_rewriteEnabled !== 1 || !isset($_SERVER['REDIRECT_URL']))
	    return false;

	$link_rewrite = $lang_rewrite = $category_rewrite = $product_rewrite = $cms_rewrite = $new_url = NULL;
	$id_lang = intval(Tools::getValue("id_lang", 0));
	$id_category = intval(Tools::getValue("id_category", 0));
	$id_product = intval(Tools::getValue("id_product", 0));
	$id_cms = intval(Tools::getValue("id_cms", 0));
	$id_page = intval(Tools::getValue("p", 0));
	$page_num = (($id_page) ? '?p='.$id_page : '');
	$iso_lang = strval(Tools::getValue("isolang", ''));

	// In PrestaShop 1.1 base url is _PS_USE_SSL, in PS 1.3 it's _PS_BASE_URL_
	$base_url = (defined('_PS_BASE_URL_')) ? _PS_BASE_URL_ : (Configuration::get('PS_SSL_ENABLED') ? 'https://'.$_SERVER['SERVER_NAME'] : 'http://'.$_SERVER['SERVER_NAME']);
	$req_url = $base_url.Tools::safeOutput(urldecode($_SERVER['REDIRECT_URL'])).$page_num;

	// Check lang
	if ($id_lang AND strstr($req_url, 'lang'))
	    $lang_rewrite = 'lang-'.Language::getIsoById($id_lang).'/';
	else
	    $id_lang = intval($cookie->id_lang);

	// If category id is set, build category rewrite link
	if ($id_category AND Validate::isUnsignedId($id_category)) {
	    $category = new Category($id_category, $id_lang);
	    $link_rewrite = $base_url.__PS_BASE_URI__.$lang_rewrite.$id_category.'-'.$category->link_rewrite.$page_num;
	}

	// Product
	if($id_product AND Validate::isUnsignedId($id_product)) {
	    $product = new Product($id_product, true, $id_lang);
	    $link_rewrite = $base_url.__PS_BASE_URI__.$lang_rewrite.(($product->category != 'home' AND !empty($product->category)) ? $product->category.'/' : '').intval($product->id).'-'.$product->link_rewrite.($product->ean13 ? '-'.$product->ean13 : '').'.html';
	}

	// CMS
	if ($id_cms AND Validate::isUnsignedId($id_cms)) {
            $cms = new CMS($id_cms, $id_lang);
	    $link_rewrite = $base_url.__PS_BASE_URI__.$lang_rewrite.'content/'.intval($id_cms).'-'.$cms->link_rewrite;
	}

	if ($link_rewrite) {
	    $new_url = $link_rewrite;
	    if($new_url AND $req_url != $new_url)
		$this->_redirect($new_url);
	}
    }

    private function _redirect($url) {
	Header( "HTTP/1.1 301 Moved Permanently" );
	Header( "Location: ".$url ); 
	exit();
    }

}

?>
