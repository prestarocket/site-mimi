<?php

include_once(_PS_CLASS_DIR_.'PEAR.php');
include_once(_PS_PEAR_XML_PARSER_PATH_.'Parser.php');

class Blockrss extends Module
{
 	function __construct()
 	{
 	 	$this->name = 'blockrss';
 	 	$this->tab = 'Blocks';

		parent::__construct();

		$this->displayName = $this->l('RSS feed block');
		$this->description = $this->l('Adds a block displaying an RSS feed');

		$this->version = '1.0';
		$this->error = false;
		$this->valid = false;
 	}

 	function install()
 	{
		Configuration::updateValue('RSS_FEED_TITLE', $this->l('RSS feed'));
		Configuration::updateValue('RSS_FEED_NBR', 5);
 	 	if (parent::install() == false OR $this->registerHook('rightColumn') == false)
 	 		return false;
		return true;
  	}

	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitBlockRss'))
		{
			$urlfeed = strval(Tools::getValue('urlfeed'));
			$title = strval(Tools::getValue('title'));
			$nbr = intval(Tools::getValue('nbr'));
			if ($urlfeed AND !Validate::isUrl($urlfeed))
				$errors[] = $this->l('Invalid feed URL');
			elseif (!$title OR empty($title) OR !Validate::isGenericName($title))
				$errors[] = $this->l('Invalid title');
			elseif (!$nbr OR $nbr <= 0 OR !Validate::isInt($nbr))
				$errors[] = $this->l('Invalid number of feeds');
			elseif (stristr($urlfeed, $_SERVER['HTTP_HOST'].__PS_BASE_URI__))
				$errors[] = $this->l('You cannot select your own RSS feed');
			else
			{
				Configuration::updateValue('RSS_FEED_URL', $urlfeed);
				Configuration::updateValue('RSS_FEED_TITLE', $title);
				Configuration::updateValue('RSS_FEED_NBR', $nbr);
			}
			if (isset($errors) AND sizeof($errors))
				$output .= $this->displayError(implode('<br />', $errors));
			else
				$output .= $this->displayConfirmation($this->l('Settings updated'));
		}

		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		$output = '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Block title').'</label>
				<div class="margin-form">
					<input type="text" name="title" value="'.Tools::getValue('title', Configuration::get('RSS_FEED_TITLE')).'" />
					<p class="clear">'.$this->l('Create a title for the block (default: \'RSS feed\')').'</p>

				</div>
				<label>'.$this->l('Add a feed URL').'</label>
				<div class="margin-form">
					<input type="text" size="85" name="urlfeed" value="'.Tools::getValue('urlfeed', Configuration::get('RSS_FEED_URL')).'" />
					<p class="clear">'.$this->l('Add the url of the feed you wan\'t to use').'</p>

				</div>
				<label>'.$this->l('Number of threads displayed').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="nbr" value="'.Tools::getValue('nbr', Configuration::get('RSS_FEED_NBR')).'" />
					<p class="clear">'.$this->l('The number of threads displayed by the block (default value: 5)').'</p>

				</div>
				<center><input type="submit" name="submitBlockRss" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>';
		return $output;
	}

	function hookLeftColumn($params)
	{
		global $smarty;
		$smarty->caching = true;

		if (!$this->iscached(__FILE__, 'blockrss.tpl')){
		// Conf
		$title = strval(Configuration::get('RSS_FEED_TITLE'));
		$url = strval(Configuration::get('RSS_FEED_URL'));
		$nb = intval(Configuration::get('RSS_FEED_NBR'));
		
		// Getting data
		$rss_links = array();
		if ($url && ($contents = @file_get_contents($url)))
			if (@$src = new XML_Feed_Parser($contents))
				for ($i = 0; $i < ($nb ? $nb : 5); $i++)
					if (@$item = $src->getEntryByOffset($i))
						$rss_links[] = array('title' => $item->title, 'url' => $item->link);
		
		// Display smarty
		$smarty->assign(array(
			'title' => ($title ? $title : $this->l('RSS feed')),
			'rss_links' => $rss_links
		));

                }		

		$display =  $this->display(__FILE__, 'blockrss.tpl');
		$smarty->caching = false;
 	 	return $display;
 	}

	function hookRightColumn($params)
	{
		return $this->hookLeftColumn($params);
	}
}

?>
