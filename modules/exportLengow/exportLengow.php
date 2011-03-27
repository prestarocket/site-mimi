<?php
class exportLengow extends Module
{
	public function __construct()
	{
		$this->name = 'exportLengow';
		$this->tab = 'Products';
		$this->version = '1.3.0';

		parent::__construct();

		$this->displayName = $this->l('Lengow');
		$this->description = $this->l('Export your product catalog to the solution Lengow.');
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall the module Lengow?');
	}

	public function install()
	{
		if(!parent::install()
		|| !$this->registerHook('leftColumn')
		|| !Configuration::updateValue('MOD_EXPORT_LENGOW_URL', 'http://www.lengow.com/view/images/logo_transparant.png'))
		return false;
		return true;
	}

	public function uninstall()
	{
		$sql = "DROP TABLE `".constant('_DB_PREFIX_')."parametre_lengow`";
		Db::getInstance()->ExecuteS($sql);
		if(!parent::uninstall()
		|| !Configuration::deleteByName('MOD_EXPORT_LENGOW_URL'))
		return false;
		return true;
	}


	public function getContent()
	{
		$html = '';
		$exportLengow_url = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'modules/exportLengow/export.php';
		$exportFullLengow_url = 'http://'.$_SERVER['HTTP_HOST'].constant('__PS_BASE_URI__').'modules/exportLengow/export.php?mode=full';
		$html .= '<h2>'.$this->l('Lengow: export your product catalog').' (v'.$this->version.')</h2>
    <fieldset>
<legend>'.$this->l('Informations  :').'</legend>'.$this->l("Lengow is a SaaS solution to enable e-shopping optimize its product catalogs to price comparison, affiliation but also marketplaces and sites of Cashback.").'<br />	
	<br />'.$this->l('The principle is that the solution recovers the merchant\'s product catalog, configure, optimize and track information campaigns to restore market for e-trading statistics in the form of dashboards and charts.').' 
	<br />'.$this->l('This process allows e-merchants to optimize their flow and their cost of acquisition on each channel.').'
	<br clear="all" />
	<br clear="all" />
	<a href="http://www.lengow.com" target="_blank"><img src="http://www.lengow.com/view/images/logo_transparant.png" alt="'.$this->l('Lengow Solution').'" border="0" /></a>
	
    </fieldset>
<br clear="all" />
<fieldset>
<legend>'.$this->l('URL of your Product Catalog :').'</legend>
        <a href="'.$exportLengow_url.'" target="_blank" style="font-family:Courier">'.$exportLengow_url.'</a>
</fieldset>
<br clear="all" />
<fieldset>
<legend>'.$this->l('URL of your Product Catalog Full :').'</legend>
        <a href="'.$exportFullLengow_url.'" target="_blank" style="font-family:Courier">'.$exportFullLengow_url.'</a>
</fieldset>';
		//return $html;
		return $html.$this->displayForm();
	}

	public function secureDir($dir)
	{
		define('_LENGOW_DIR_','/exportLengow');
		define('MSG_ALERT_MODULE_NAME',$this->l('Module Lengow should not be renamed'));

		if($dir != _LENGOW_DIR_)
		{
			echo utf8_decode(MSG_ALERT_MODULE_NAME);
			exit();
		}
	}

	public function netoyage_html($CatList)
	{
		$CatList = strip_tags ($CatList);
		$CatList = trim ($CatList);
		$CatList = str_replace("&nbsp;"," ",$CatList);
		$CatList = str_replace("|"," ",$CatList);
		$CatList = str_replace("&#39;","' ",$CatList);
		$CatList = str_replace("&#150;","-",$CatList);
		$CatList = str_replace(chr(9)," ",$CatList);
		$CatList = str_replace(chr(10)," ",$CatList);
		$CatList = str_replace(chr(13)," ",$CatList);
		return $CatList;
	}

	public function displayForm()
	{
		$output = '';
		ob_start();
		include('formLengow.php');
		$output = ob_get_clean();
		return $output;
		ob_end_clean();
	}
}
?>
