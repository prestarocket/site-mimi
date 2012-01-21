<?php

class BlockManufacturerCarousel extends Module
{
    private $_html = '';
    private $_postErrors = array();

    public  $timeEffet=800;
    public  $timeTrans=5000;
    public  $disapear=0;

    function __construct()
    {
        $this->name = 'blockmanufacturercarousel';
        $this->tab = 'Olecorre Developpement';
        $this->version = 1.2;

        parent::__construct();
        $config = Configuration::getMultiple(array('MANUFACTURER_CAROUSEL_TEFFECT', 'MANUFACTURER_CAROUSEL_TTRANS', 'SPECIAL_CAROUSEL_DISAPEAR'));
		if (isset($config['MANUFACTURER_CAROUSEL_TEFFECT']))
			$this->timeEffet = $config['MANUFACTURER_CAROUSEL_TEFFECT'];
		if (isset($config['MANUFACTURER_CAROUSEL_TTRANS']))
			$this->timeTrans = $config['MANUFACTURER_CAROUSEL_TTRANS'];
                if (isset($config['SPECIAL_CAROUSEL_DISAPEAR']))
			$this->disapear = $config['SPECIAL_CAROUSEL_DISAPEAR'];

        $this->displayName = $this->l('Block manufacturer with carousel');
        $this->description = $this->l('Adds a block with current manufacturer');
    }

    function install()
    {
        if (!parent::install() OR !$this->registerHook('rightColumn'))
                return false;
        return true;
    }

    function uninstall()
    {
        if (!Configuration::deleteByName('MANUFACTURER_CAROUSEL_TEFFECT') OR !Configuration::deleteByName('MANUFACTURER_CAROUSEL_TTRANS') OR !Configuration::deleteByName('SPECIAL_CAROUSEL_DISAPEAR') OR !parent::uninstall())
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
                    Configuration::updateValue('MANUFACTURER_CAROUSEL_TEFFECT', $_POST['timeEffet']);
                    Configuration::updateValue('MANUFACTURER_CAROUSEL_TTRANS', $_POST['timeTrans']);
                    Configuration::updateValue('SPECIAL_CAROUSEL_DISAPEAR', intval($_POST['disapear']));
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
                                    <tr><td colspan="2">'.$this->l('Please specify the time of effet in ms and the time before change manufacturer').'.<br /><br /></td></tr>
                                    <tr><td width="130" style="height: 35px;">'.$this->l('Time of effect').'</td>
                                        <td><input type="text" name="timeEffet" value="'.Tools::getValue('timeEffet', $this->timeEffet).'" style="width: 50px;" /></td></tr>
                                    <tr><td width="130" style="vertical-align: top;">'.$this->l('Time of transition').'</td>
                                        <td><input type="text" name="timeTrans" value="'.Tools::getValue('timeTrans', $this->timeTrans).'" style="width: 50px;" /></td>
                                    </tr>
                                    <tr><td width="130" style="vertical-align: top;">'.$this->l('Disapear if empty').'</td>
                                        <td>
                                        <input type="radio" name="disapear" id="disapear_on" value="1" '.(intval(Tools::getValue('disapear', $this->disapear))==1 ? 'checked="checked" ' : '').'/>
					<label class="t" for="disapear_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="disapear" id="disapear_off" value="0" '.(intval(Tools::getValue('disapear', $this->disapear))==0 ? 'checked="checked" ' : '').'/>
					<label class="t" for="disapear_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
                                            <p class="clear">'.$this->l('The block will not appear when it is empty').'</p></td>
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
		global $smarty, $link;
		$smarty->caching = true;

		if (!$this->iscached(__FILE__, 'blockmanufacturercarousel.tpl')) {
                $manufacturers = Manufacturer::getManufacturers(true);
                $new_manufacturer = array();
		if ($manufacturers)
			foreach ($manufacturers AS $manufacturer){
                            if(file_exists(_PS_MANU_IMG_DIR_.$manufacturer['id_manufacturer'].'-medium.jpg')) $new_manufacturer[] = $manufacturer;
                        }
		$smarty->assign(array(
                    'manufacturers' => $new_manufacturer,
                    'link' => $link,
                    'timeEffet' => $this->timeEffet,
                    'timeTrans' => $this->timeTrans
                    ));

		// Create cache file
		file_put_contents($cache, "this is cache");
		}
		$display = $this->display(__FILE__, 'blockmanufacturercarousel.tpl');
		$smarty->caching = false;
 	 	return $display;
    }

    function hookLeftColumn($params)
    {
            return $this->hookRightColumn($params);
    }
}
?>
