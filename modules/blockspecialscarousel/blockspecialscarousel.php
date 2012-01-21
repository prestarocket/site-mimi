<?php

class BlockSpecialsCarousel extends Module
{
    private $_html = '';
    private $_postErrors = array();

    public  $timeEffet=800;
    public  $timeTrans=5000;

    function __construct()
    {
        $this->name = 'blockspecialscarousel';
        $this->tab = 'Blocks';
        $this->version = 1;

        parent::__construct();
        $config = Configuration::getMultiple(array('SPECIAL_CAROUSEL_TEFFECT', 'SPECIAL_CAROUSEL_TTRANS'));
		if (isset($config['SPECIAL_CAROUSEL_TEFFECT']))
			$this->timeEffet = $config['SPECIAL_CAROUSEL_TEFFECT'];
		if (isset($config['SPECIAL_CAROUSEL_TTRANS']))
			$this->timeTrans = $config['SPECIAL_CAROUSEL_TTRANS'];

        $this->displayName = $this->l('Specials block with carousel');
        $this->description = $this->l('Adds a block with current product Specials');
    }

    function install()
    {
        if (!parent::install() OR !$this->registerHook('leftColumn') OR !$this->registerHook('paymentReturn'))
                return false;
        return true;
    }

    function uninstall()
    {
        if (!Configuration::deleteByName('SPECIAL_CAROUSEL_TEFFECT') OR !Configuration::deleteByName('SPECIAL_CAROUSEL_TTRANS') OR !parent::uninstall())
                return false;
        return true;
    }

    private function _postValidation()
    {
            if (isset($_POST['btnSubmit']))
            {
                    if (empty($_POST['timeEffet']))
                            $this->_postErrors[] = $this->l('Time effect field is required.');
                    elseif (empty($_POST['timeTrans']))
                            $this->_postErrors[] = $this->l('Time transition is required.');
            }
    }

    private function _postProcess()
    {
            if (isset($_POST['btnSubmit']))
            {
                    Configuration::updateValue('SPECIAL_CAROUSEL_TEFFECT', $_POST['timeEffet']);
                    Configuration::updateValue('SPECIAL_CAROUSEL_TTRANS', $_POST['timeTrans']);
            }
            $this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('OK').'" /> '.$this->l('Settings updated').'</div>';
    }

    private function _displayForm()
    {
            $this->_html .=
            '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                    <fieldset>
                    <legend><img src="../img/admin/contact.gif" />'.$this->l('Parameters').'</legend>
                            <table border="0" width="500" cellpadding="0" cellspacing="0" id="form">
                                    <tr><td colspan="2">'.$this->l('Please specify the time of effet in ms and the time before change product').'.<br /><br /></td></tr>
                                    <tr><td width="130" style="height: 35px;">'.$this->l('Time of effect').'</td>
                                        <td><input type="text" name="timeEffet" value="'.Tools::getValue('timeEffet', $this->timeEffet).'" style="width: 50px;" /></td></tr>
                                    <tr><td width="130" style="vertical-align: top;">'.$this->l('Time of transition').'</td>
                                        <td><input type="text" name="timeTrans" value="'.Tools::getValue('timeTrans', $this->timeTrans).'" style="width: 50px;" /></td>
                                    </tr>
                                    <tr><td colspan="2" align="center"><br /><input class="button" name="btnSubmit" value="'.$this->l('Update settings').'" type="submit" /></td></tr>
                            </table>
                    </fieldset>
            </form>';
    }

    function getContent()
    {
            $this->_html = '<h2>'.$this->displayName.'</h2>';

            if (!empty($_POST))
            {
                    $this->_postValidation();
                    if (!sizeof($this->_postErrors))
                            $this->_postProcess();
                    else
                            foreach ($this->_postErrors AS $err)
                                    $this->_html .= '<div class="alert error">'. $err .'</div>';
            }
            else
                    $this->_html .= '<br />';

            $this->_displayForm();

            return $this->_html;
    }

    function hookRightColumn($params)
    {
		global $smarty;
                $smarty->caching = true;
		$cache = $smarty->cache_dir . '/blockspecialscarroussel.cache';

		if (! (file_exists($cache) && $smarty->cache_lifetime > (time() - filemtime($cache))) ) {
		
                $products = Product::getPricesDrop(intval($params['cookie']->id_lang));
                $new_product = array();
		if ($products)
			foreach ($products AS $Product)
				$new_product[] = $Product;

		$smarty->assign(array(
                    'timeEffet' => $this->timeEffet,
                    'timeTrans' => $this->timeTrans,
                    'products' => $new_product));
		// Create cache file
		file_put_contents($cache, "this is cache");
                }		

		$display = $this->display(__FILE__, 'blockspecialscarousel.tpl');
		$smarty->caching = false;
		return $display;
    }

    function hookLeftColumn($params)
    {
            return $this->hookRightColumn($params);
    }
}
?>
