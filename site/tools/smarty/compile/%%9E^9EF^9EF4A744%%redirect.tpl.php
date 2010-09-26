<?php /* Smarty version 2.6.20, created on 2010-09-26 16:22:31
         compiled from /srv/http/modules/paypal/redirect.tpl */ ?>
<html>
	<head>
		<script type="text/javascript" src="http://<?php echo $this->_tpl_vars['url']; ?>
js/jquery/jquery-1.2.6.pack.js"></script>
	</head>
	<body>
		<p><?php echo $this->_tpl_vars['redirect_text']; ?>
<br /><a href="javascript:history.go(-1);"><?php echo $this->_tpl_vars['cancel_text']; ?>
</a></p>
		<form action="<?php echo $this->_tpl_vars['paypal_url']; ?>
" method="post" id="paypal_form" class="hidden">
			<input type="hidden" name="upload" value="1" />
			<input type="hidden" name="address_override" value="1" />
			<input type="hidden" name="first_name" value="<?php echo $this->_tpl_vars['address']->firstname; ?>
" />
			<input type="hidden" name="last_name" value="<?php echo $this->_tpl_vars['address']->lastname; ?>
" />
			<input type="hidden" name="address1" value="<?php echo $this->_tpl_vars['address']->address1; ?>
" />
			<?php if ($this->_tpl_vars['address']->address2 != NULL): ?>
			<input type="hidden" name="address2" value="<?php echo $this->_tpl_vars['address']->address2; ?>
" />
			<?php endif; ?>
			<input type="hidden" name="city" value="<?php echo $this->_tpl_vars['address']->city; ?>
" />
			<input type="hidden" name="zip" value="<?php echo $this->_tpl_vars['address']->postcode; ?>
" />
			<input type="hidden" name="country" value="<?php echo $this->_tpl_vars['country']->iso_code; ?>
" />
			<?php if ($this->_tpl_vars['state'] != NULL): ?>
			<input type="hidden" name="state" value="<?php echo $this->_tpl_vars['state']->iso_code; ?>
" />
			<?php endif; ?>
			<input type="hidden" name="amount" value="<?php echo $this->_tpl_vars['amount']; ?>
" />
			<input type="hidden" name="email" value="<?php echo $this->_tpl_vars['customer']->email; ?>
" />
			<?php if (! $this->_tpl_vars['discount']): ?>
			<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['product']):
?>
			<input type="hidden" name="item_name_<?php echo $this->_tpl_vars['k']+1; ?>
" value="<?php echo $this->_tpl_vars['product']['name']; ?>
<?php if (isset ( $this->_tpl_vars['product']['attributes'] )): ?> - <?php echo $this->_tpl_vars['product']['attributes']; ?>
<?php endif; ?>" />
			<input type="hidden" name="amount_<?php echo $this->_tpl_vars['k']+1; ?>
" value="<?php echo $this->_tpl_vars['product']['price_wt']; ?>
" />
			<input type="hidden" name="quantity_<?php echo $this->_tpl_vars['k']+1; ?>
" value="<?php echo $this->_tpl_vars['product']['cart_quantity']; ?>
" />
			<?php endforeach; endif; unset($_from); ?>
			<input type="hidden" name="shipping_1" value="<?php echo $this->_tpl_vars['shipping']; ?>
" />
			<?php else: ?>
			<input type="hidden" name="item_name_1" value="<?php echo $this->_tpl_vars['cart_text']; ?>
" />
			<input type="hidden" name="amount_1" value="<?php echo $this->_tpl_vars['total']; ?>
" />
			<input type="hidden" name="quantity_1" value="1" />
			<?php endif; ?>
			<input type="hidden" name="business" value="<?php echo $this->_tpl_vars['business']; ?>
" />
			<input type="hidden" name="receiver_email" value="<?php echo $this->_tpl_vars['business']; ?>
" />
			<input type="hidden" name="cmd" value="_cart" />
			<input type="hidden" name="charset" value="utf-8" />
			<input type="hidden" name="currency_code" value="<?php echo $this->_tpl_vars['currency_module']->iso_code; ?>
" />
			<input type="hidden" name="payer_id" value="<?php echo $this->_tpl_vars['customer']->id; ?>
" />
			<input type="hidden" name="payer_email" value="<?php echo $this->_tpl_vars['customer']->email; ?>
" />
			<input type="hidden" name="custom" value="<?php echo $this->_tpl_vars['cart_id']; ?>
" />
			<input type="hidden" name="return" value="http://<?php echo $this->_tpl_vars['url']; ?>
order-confirmation.php?key=<?php echo $this->_tpl_vars['customer']->secure_key; ?>
&id_cart=<?php echo $this->_tpl_vars['cart_id']; ?>
&id_module=<?php echo $this->_tpl_vars['paypal_id']; ?>
&slowvalidation" />
			<input type="hidden" name="cancel_return" value="http://<?php echo $this->_tpl_vars['url']; ?>
index.php" />
			<input type="hidden" name="notify_url" value="http://<?php echo $this->_tpl_vars['url']; ?>
modules/paypal/validation.php" />
			<?php if ($this->_tpl_vars['header'] != NULL): ?>
			<input type="hidden" name="cpp_header_image" value="<?php echo $this->_tpl_vars['header']; ?>
" />
			<?php endif; ?>
			<input type="hidden" name="rm" value="2" />
			<input type="hidden" name="bn" value="PRESTASHOP_WPS" />
			<input type="hidden" name="cbt" value="<?php echo $this->_tpl_vars['return_text']; ?>
" />
		</form>
		<script type="text/javascript">
		<?php echo '
		$(document).ready(function() {
			$(\'#paypal_form\').submit();
		});
		'; ?>

		</script>
	</body>
</html>