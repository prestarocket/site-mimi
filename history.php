<?php

/* SSL Management */
$useSSL = true;

include(dirname(__FILE__).'/config/config.inc.php');
include(dirname(__FILE__).'/init.php');

if (!$cookie->isLogged())
	Tools::redirect('authentication.php?back=history.php');

/* JS files call */
$js_files = array(__PS_BASE_URI__.'js/jquery/jquery.scrollto.js', _THEME_JS_DIR_.'history.js');

if ($orders = Order::getCustomerOrders(intval($cookie->id_customer)))
	foreach ($orders AS &$order)
	{
		$myOrder = new Order(intval($order['id_order']));
		if (Validate::isLoadedObject($myOrder))
			$order['virtual'] = $myOrder->isVirtual(false);
	}

include(dirname(__FILE__).'/header.php');
$smarty->assign(array(
	'orders' => $orders,
	'invoiceAllowed' => intval(Configuration::get('PS_INVOICE')),
	'slowValidation' => Tools::isSubmit('slowvalidation')));
$smarty->display(_PS_THEME_DIR_.'history.tpl');
?>
<div id="eval_shopzilla">
<a href="https://evalus.shopzilla.com/wix/p1937759.aspx?br=13163332594201487454202020302013717&amp;rid=1316336052020204017&amp;mid=252335&amp;l=12&amp;flow=151&amp;id=252335&amp;pr=0&amp;brand=BR&amp;rf_code=sur&amp;mkt_id=0&amp;cs_id=0&amp;pitch_type=99" target="_blank"><img src="https://images.bizrate.com/invite_pos?mid=252335&amp;product_id=1&amp;flow=151&amp;pitch_type=1">
</div>
<?php
include(dirname(__FILE__).'/footer.php');

?>
