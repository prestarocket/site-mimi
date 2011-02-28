<?php

ini_set('display_errors', 'on');

class SPPlus extends PaymentModule
{
	private $_postErrors = array();
	public $_errors = array();

	public function __construct()
	{
		$this->name = 'spplus';
		$this->tab = 'Payment';
		$this->version = 2.2;
		
        parent::__construct();

		$this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('SPPlus');
        $this->description = $this->l('Accepts payments via SPPlus');
	}
	
	public function install()
	{
		return (parent::install()
			AND $this->registerHook('payment')
			AND $this->registerHook('paymentReturn')
			AND Configuration::updateValue('SPPLUS_PAYMENT_MODE', 'single')
			AND Configuration::updateValue('SPPLUS_MERCHANT_KEY', '')
			AND Configuration::updateValue('SPPLUS_CURRENCY', 'prestashop')
			AND Configuration::updateValue('SPPLUS_HMAC_URL', 'http://kits.spplus.net/cgi-bin/hmac_001.exe')
		);
	}

	public function getContent()
	{
		$output = '<h2>'.$this->l('SP Plus').'</h2>';

		if (Tools::isSubmit('submitSpplus'))
		{
			if (!extension_loaded('SPPLUS') AND !$this->dl('php_spplus.so'))
			{
				if (Tools::getValue('SPPLUS_HMAC_URL') == NULL)
					$this->_postErrors[]  = $this->l('SPPLUS_HMAC_URL');
			}
			elseif (Tools::getValue('SPPLUS_MERCHANT_KEY') == NULL)
				$this->_postErrors[]  = $this->l('SPPLUS_MERCHANT_KEY');
				
			if (Tools::getValue('SPPLUS_MERCHANT_CODE_SIRET') == NULL)
				$this->_postErrors[]  = $this->l('Siret code is empty');
				
			if (Tools::getValue('SPPLUS_CURRENCY') == NULL)
				$this->_postErrors[]  = $this->l('SPPLUS_CURRENCY');
				
			if (Tools::getValue('SPPLUS_PAYMENT_MODE') == NULL)
				$this->_postErrors[]  = $this->l('SPPLUS_PAYMENT_MODE');
			
			if (Tools::getValue('SPPLUS_PAYMENT_MODE') != 'single')
			{
				if (Tools::getValue('SPPLUS_NBRS_PAYMENTS') == NULL)
					$this->_postErrors[]  = $this->l('SPPLUS_NBRS_PAYMENTS');
					
				if (Tools::getValue('SPPLUS_DELAY') == NULL)
					$this->_postErrors[]  = $this->l('SPPLUS_DELAY');
					
				if (Tools::getValue('SPPLUS_MINIMUM') == NULL)
					$this->_postErrors[]  = $this->l('SPPLUS_MINIMUM');
			}
			
			Configuration::updateValue('SPPLUS_HMAC_URL', Tools::getValue('SPPLUS_HMAC_URL'));
			Configuration::updateValue('SPPLUS_MERCHANT_KEY', Tools::getValue('SPPLUS_MERCHANT_KEY'));
			Configuration::updateValue('SPPLUS_MERCHANT_CODE_SIRET', Tools::getValue('SPPLUS_MERCHANT_CODE_SIRET'));
			Configuration::updateValue('SPPLUS_CURRENCY', Tools::getValue('SPPLUS_CURRENCY'));
			Configuration::updateValue('SPPLUS_PAYMENT_MODE', Tools::getValue('SPPLUS_PAYMENT_MODE'));

			Configuration::updateValue('SPPLUS_NBRS_PAYMENTS', Tools::getValue('SPPLUS_NBRS_PAYMENTS'));
			Configuration::updateValue('SPPLUS_DELAY', Tools::getValue('SPPLUS_DELAY'));
			Configuration::updateValue('SPPLUS_MINIMUM', Tools::getValue('SPPLUS_MINIMUM'));

			if (!count($this->_postErrors))
			{
				$output .= '<div class="conf confirm">
					<img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />
					'.$this->l('Settings updated').'
				</div>';
			}
			else
			{
				$nbErrors = sizeof($this->_postErrors);
				$output .= '<div class="alert error">
				<h3>'.($nbErrors > 1 ? $this->l('There are') : $this->l('There is')).' '.$nbErrors.' '.($nbErrors > 1 ? $this->l('errors') : $this->l('error')).'</h3>
				<ol style="margin: 0 0 0 20px">';
				foreach ($this->_postErrors AS $err)
					$output .= '<li>'.$err.'</li>';
				$output .= '</ol></div>';
			}
		}
		
		$output .= $this->_displayForm();
		return $output;
	}
	
	public function _displayForm()
	{
		$currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));

		$output = '
		<script type="text/javascript">
			function toggleInstallmentsOptions(id)
			{
				switch (id) 
				{
					case "single":
						$("#payment_in_installments_options").hide("slow"); 
						break;
					case "installments":
						$("#payment_in_installments_options").show("slow"); 
						break;
					case "both":
						$("#payment_in_installments_options").show("slow"); 
						break;
				}
			}
			
			$(document).ready(function() {
				$.each($("input[name=SPPLUS_PAYMENT_MODE]"), function(index, value) {
					if (value.checked)
						toggleInstallmentsOptions(value.id);
				});
			});
		</script>
		<div class="warn warning">'.((extension_loaded('SPPLUS') OR $this->dl('php_spplus.so'))
			? $this->l('PECL library SPPLUS can be loaded, your transactions will be secured.')
			: $this->l('PECL library SPPLUS cannot be loaded, please fill in the HMAC URL field.')).'
		</div>
		<fieldset class="width3"><legend><img src="'.$this->_path.'logo.gif" alt="" class="middle" />SPPLUS</legend>
			<form action="'.htmlentities($_SERVER['REQUEST_URI']).'" method="post">'; 
		if (extension_loaded('SPPLUS') OR $this->dl('php_spplus.so'))
			$output .= '
				<label style="width:220px;">'.$this->l('Merchant Key').' :</label>
				<div class="margin-form"  style="float:left;padding:0 0 1em 10px;">
					<input type="text" name="SPPLUS_MERCHANT_KEY" value="'.htmlspecialchars(Tools::getValue('SPPLUS_MERCHANT_KEY',Configuration::get('SPPLUS_MERCHANT_KEY')), ENT_COMPAT, 'UTF-8').'" style="width: 290px;" />
				</div>';
		$output .= '
				<label style="width:220px;">'.$this->l('Siret Code').' :</label>
				<div class="margin-form"  style="float:left;padding:0 0 1em 10px;">
					<input type="text" name="SPPLUS_MERCHANT_CODE_SIRET" value="'.htmlspecialchars(Tools::getValue('SPPLUS_MERCHANT_CODE_SIRET',Configuration::get('SPPLUS_MERCHANT_CODE_SIRET')), ENT_COMPAT, 'UTF-8').'" style="width:150px;" />
				</div>';
		if (!extension_loaded('SPPLUS') AND !$this->dl('php_spplus.so'))
			$output .= '<label style="width:220px;">'.$this->l('HMAC URL').' :</label>
				<div class="margin-form"  style="float:left;padding:0 0 1em 10px;">
					<input type="text" name="SPPLUS_HMAC_URL" value="'.htmlspecialchars(Tools::getValue('SPPLUS_HMAC_URL',Configuration::get('SPPLUS_HMAC_URL')), ENT_COMPAT, 'UTF-8').'" style="width: 290px;" />
					<p>'.$this->l('Demonstration URL: http://kits.spplus.net/cgi-bin/hmac_001.exe').'</p>
				</div>';
		$output .= '
				<label style="width:220px;">'.$this->l('Currency').' :</label>
				<div class="margin-form"  style="float:left;padding:0 0 1em 10px;">
					<input type="radio" name="SPPLUS_CURRENCY" value="prestashop" '.(Configuration::get('SPPLUS_CURRENCY') == 'prestashop' ? 'checked="checked"' : '').' /> '.$this->l('Use prestashop currency').'
					<br /><input type="radio" name="SPPLUS_CURRENCY" value="customer" '.(Configuration::get('SPPLUS_CURRENCY') == 'customer' ? 'checked="checked"' : '').' /> '.$this->l('Use customer currency').'
				</div>
				<label style="width:220px;">'.$this->l('Payement mode').' :</label>
				<div class="margin-form" style="float:left;padding:0 0 1em 10px;">
					<input  type="radio" id="single" onchange="toggleInstallmentsOptions(this.id)" onclick="toggleInstallmentsOptions(this.id);" 
					'.(Tools::getValue('SPPLUS_PAYMENT_MODE',Configuration::get('SPPLUS_PAYMENT_MODE')) == 'single' ? 'checked="checked"' : '').' 
					name="SPPLUS_PAYMENT_MODE" value="single" /> '.$this->l('Single payement').'
					<br />
					<input type="radio" id="installments" onchange="toggleInstallmentsOptions(this.id)" onclick="toggleInstallmentsOptions(this.id);"
					'.(Tools::getValue('SPPLUS_PAYMENT_MODE',Configuration::get('SPPLUS_PAYMENT_MODE')) == 'installments' ? 'checked="checked"' : '').' 
					 name="SPPLUS_PAYMENT_MODE" value="installments" /> '.$this->l('Payment in installments').'
					<br />
					<input type="radio" id="both" onchange="toggleInstallmentsOptions(this.id)" onclick="toggleInstallmentsOptions(this.id);"
					'.(Tools::getValue('SPPLUS_PAYMENT_MODE',Configuration::get('SPPLUS_PAYMENT_MODE')) == 'both' ? 'checked="checked"' : '').' 
					name="SPPLUS_PAYMENT_MODE" value="both"  /> '.$this->l('Both').'
				</div>
				<div id="payment_in_installments_options" style="display: none; clear:both;">
					<label style="width:220px;">'.$this->l('Number of installments').' :</label>
						<div class="margin-form" style="float:left;padding:0 0 1em 10px;">
							<input type="text" name="SPPLUS_NBRS_PAYMENTS" value="'.Tools::getValue('SPPLUS_NBRS_PAYMENTS',Configuration::get('SPPLUS_NBRS_PAYMENTS')).'" /> 
						</div>
					<label style="width:220px;">'.$this->l('Delay between payments').' :</label>
						<div class="margin-form" style="float:left;padding:0 0 1em 10px;">
							<input type="text" name="SPPLUS_DELAY" value="'.Tools::getValue('SPPLUS_DELAY',Configuration::get('SPPLUS_DELAY')).'" /> '.$this->l('Day(s)').'
						</div>
					<label style="width:220px;">'.$this->l('Minimum').' :</label>
						<div class="margin-form" style="float:left;padding:0 0 1em 10px;">
							<input type="text" name="SPPLUS_MINIMUM" value="'.Tools::getValue('SPPLUS_MINIMUM',Configuration::get('SPPLUS_MINIMUM')).'" />'.($currency->format == 2 ? ' '.$currency->sign : '').'
						</div>
				</div>	
				<div class="clear">&nbsp;</div>
				<div class="margin-form" >
					<input type="submit" name="submitSpplus" value="'.$this->l('Update settings').'" class="button" />
				</div>
			</form>
		</fieldset>
		<div class="clear">&nbsp;</div>
		<fieldset>
			<legend>PrestaStore</legend>
			'.$this->l('This module has been developped by PrestaShop and can only be sold through').' <a href="http://addons.prestashop.com">addons.prestashop.com</a>.<br />
			'.$this->l('Please report all bugs to').' <a href="mailto:addons@prestashop.com">addons@prestashop.com</a> '.$this->l('or using our').' <a href="http://addons.prestashop.com/contact-form.php">'.$this->l('contact form').'</a>.
		</fieldset>';
		return $output;
	}
	
	public function hookPaymentReturn($params)
	{
		global $smarty;

		if ($params['objOrder']->valid == 1)
		{
			$smarty->assign(array(
				'total_to_pay' => Tools::displayPrice($params['total_to_pay'], $params['currencyObj'], false, false),
				'status' => 'ok',
				'id_order' => $params['objOrder']->id
			));
		}
		else
			$smarty->assign('status', 'failed');
		return $this->display(__FILE__, 'payment_return.tpl');
	}
	
	public function hookPayment($params)
	{
		global $cookie, $smarty;
		
		/*		
		**	To simulate a payment, a test can be made using these card numbers.:
		**	58 6d fc 9c 34 91 9b 86 3f fd 64 63 c9 13 4a 26 ba 29 74 1e c7 e9 80 79 = merchant key
		**	00000000000001-001 = merchant csiret code
		==================================================
		- 978  : pour l’Euro 
		- 124  : pour le Dollar Canadien 
		- 756  : pour le Franc Suisse 
		- 752  : pour la Couronne Suédoise 
		- 826  : pour la Livre Sterling 
		- 840  : pour le Dollar Américain 
		- 1234567890123456 (16 chiffres) qui génèrera un paiement autorisé.  (CCV2 123)
		- 0000000000000000 (16 chiffres) qui génèrera un paiement refusé.	(CVV2 123)
		*/
		
		$devises = array('EUR' => '978', 'CAD' => '124', 'CHF' => '756', 'SEK' => '752', 'GBP' => '826', 'USD' => '840');
		
		$conf = Configuration::getMultiple(array('SPPLUS_MERCHANT_KEY', 'SPPLUS_MERCHANT_CODE_SIRET', 'SPPLUS_CURRENCY', 'SPPLUS_PAYMENT_MODE', 'SPPLUS_NBRS_PAYMENTS' ));
		$id_currency = Configuration::get('SPPLUS_CURRENCY') == 'customer' ? intval($params['cart']->id_currency) : intval(Configuration::get('PS_CURRENCY_DEFAULT'));
		$currency = new Currency(intval($id_currency));
		$customer = new Customer(intval($params['cart']->id_customer));
		$http = (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://');

		$vars = array(
			'currency' => $currency,
			'montant' => number_format($params['cart']->getOrderTotal(true, 3), 2, '.', ''),
			'reference' => 'spp'.date('YmdHis'),
			'devise' => $devises[$currency->iso_code],
			'langue' => strtoupper(Language::getIsoById($cookie->id_lang)),
			'taxe' => '0.00',
			'moyen' => 'CBS',
			'modalite' => '1x'
		);			
		$data =
			'siret='.$conf['SPPLUS_MERCHANT_CODE_SIRET'].
			'&reference='.$vars['reference'].
			'&langue='.$vars['langue'].
			'&devise='.$vars['devise'].
			'&montant='.$vars['montant'].
			'&taxe='.$vars['taxe'].
			'&moyen='.$vars['moyen'].
			'&modalite='.$vars['modalite'].
			'&email='.$customer->email.
			'&urlretour='.urlencode($http.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'order-confirmation.php?id_cart='.(int)$params['cart']->id.'&id_module='.(int)$this->id.'&key='.$customer->secure_key).
			'&okURL='.urlencode($http.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'order-confirmation.php?id_cart='.(int)$params['cart']->id.'&id_module='.(int)$this->id.'&key='.$customer->secure_key).
			'&badURL='.urlencode($http.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__).
			'&arg1='.intval($params['cart']->id);
			if (!extension_loaded('SPPLUS') AND !$this->dl('php_spplus.so'))
				$url_calculhmac = $this->urlSPPlus(Configuration::get('SPPLUS_HMAC_URL').'?'.$data);
			else
				$url_calculhmac = 'https://www.spplus.net/paiement/init.do?'.$data.'&hmac='.calculhmac($conf['SPPLUS_MERCHANT_KEY'], $data);

		$smarty->assign(array('conf' => $conf, 'id_cart' => intval($params['cart']->id), 'url_calculhmac' => $url_calculhmac));

		switch ($conf['SPPLUS_PAYMENT_MODE'])
		{
			case 'single' :
				return ($this->display(__FILE__, 'spplus_single.tpl'));
			
			case 'installments' :
				$vars = array(
					'currency' => $currency,
					'montant' => number_format($params['cart']->getOrderTotal(true, 3), 2, '.', ''),
					'reference' => 'spp'.date('YmdHis'),
					'devise' => $devises[$currency->iso_code],
					'langue' => strtoupper(Language::getIsoById($cookie->id_lang)),
					'taxe' => '0.00',
					'moyen' => 'CBS',
					'modalite' => $conf['SPPLUS_NBRS_PAYMENTS'].'x'
				);		
				$data =
					'siret='.$conf['SPPLUS_MERCHANT_CODE_SIRET'].
					'&reference='.$vars['reference'].
					'&langue='.$vars['langue'].
					'&devise='.$vars['devise'].
					'&montant='.$vars['montant'].
					'&taxe='.$vars['taxe'].
					'&moyen='.$vars['moyen'].
					'&modalite='.$vars['modalite'].
					'&email='.$customer->email.
					'&urlretour='.urlencode($http.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'order-confirmation.php?key='.$customer->secure_key).
					'&okURL='.urlencode($http.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'order-confirmation.php?key='.$customer->secure_key).
					'&badURL='.urlencode($http.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__).
					'&arg1='.intval($params['cart']->id);
					
				if (!extension_loaded('SPPLUS') AND !$this->dl('php_spplus.so'))
					$url_calculhmac = $this->urlSPPlus(Configuration::get('SPPLUS_HMAC_URL').'?'.$data);
				else
					$url_calculhmac = 'https://www.spplus.net/paiement/init.do?'.$data.'&hmac='.calculhmac($conf['SPPLUS_MERCHANT_KEY'], $data);

				$smarty->assign(array('conf' => $conf, 'id_cart' => intval($params['cart']->id), 'url_calculhmac' => $url_calculhmac , 'nbr_installments' => $conf['SPPLUS_NBRS_PAYMENTS']));
				return $this->display(__FILE__, 'spplus_installments.tpl');
				
			case 'both' :
				$vars = array(
					'currency' => $currency,
					'montant' => number_format($params['cart']->getOrderTotal(true, 3), 2, '.', ''),
					'reference' => 'spp'.date('YmdHis'),
					'devise' => $devises[$currency->iso_code],
					'langue' => strtoupper(Language::getIsoById($cookie->id_lang)),
					'taxe' => '0.00',
					'moyen' => 'CBS',
					'modalite' => $conf['SPPLUS_NBRS_PAYMENTS'].'x'
				);		
				$data =
					'siret='.$conf['SPPLUS_MERCHANT_CODE_SIRET'].
					'&reference='.$vars['reference'].
					'&langue='.$vars['langue'].
					'&devise='.$vars['devise'].
					'&montant='.$vars['montant'].
					'&taxe='.$vars['taxe'].
					'&moyen='.$vars['moyen'].
					'&modalite='.$vars['modalite'].
					'&email='.$customer->email.
					'&urlretour='.urlencode($http.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'order-confirmation.php?key='.$customer->secure_key).
					'&okURL='.urlencode($http.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'order-confirmation.php?key='.$customer->secure_key).
					'&badURL='.urlencode($http.htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__).
					'&arg1='.intval($params['cart']->id);
					
				if (!extension_loaded('SPPLUS') AND !$this->dl('php_spplus.so'))
					$url_calculhmac = $this->urlSPPlus(Configuration::get('SPPLUS_HMAC_URL').'?'.$data);
				else
					$url_calculhmac = 'https://www.spplus.net/paiement/init.do?'.$data.'&hmac='.calculhmac($conf['SPPLUS_MERCHANT_KEY'], $data);

				$smarty->assign(array('conf' => $conf, 'id_cart' => intval($params['cart']->id), 'url_calculhmac' => $url_calculhmac , 'nbr_installments' => $conf['SPPLUS_NBRS_PAYMENTS']));
				return $this->display(__FILE__, 'spplus_single.tpl').$this->display(__FILE__, 'spplus_installments.tpl');
		}
	}
	
	function urlSPPlus($urlCGI)
	{
		if (!($handle = fopen($urlCGI, "rb")))
			return 'Erreur lors de l\'exécution du CGI.';
		$contents = fgetss($handle, 2048);
		fclose($handle);
		list($debut,$url,$fin) = @split("'", $contents, 3);
		return $url;
	}
	
	function dl($library)
	{
		return (function_exists('dl') AND dl($library));
	}
}

?>