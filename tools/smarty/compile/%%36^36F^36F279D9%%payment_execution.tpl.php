<?php /* Smarty version 2.6.20, created on 2011-02-22 21:19:41
         compiled from /homez.387/lilibio/www/site/modules/cheque/payment_execution.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www/site/modules/cheque/payment_execution.tpl', 1, false),array('function', 'displayPrice', '/homez.387/lilibio/www/site/modules/cheque/payment_execution.tpl', 23, false),array('modifier', 'count', '/homez.387/lilibio/www/site/modules/cheque/payment_execution.tpl', 28, false),)), $this); ?>
<?php ob_start(); ?><?php echo smartyTranslate(array('s' => 'Cheque payment','mod' => 'cheque'), $this);?>
<?php $this->_smarty_vars['capture']['path'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo smartyTranslate(array('s' => 'Order summary','mod' => 'cheque'), $this);?>
</h2>

<?php $this->assign('current_step', 'payment'); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./order-steps.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['nbProducts'] <= 0): ?>
	<p class="warning"><?php echo smartyTranslate(array('s' => 'Your shopping cart is empty.'), $this);?>
</p>
<?php else: ?>

<h3><?php echo smartyTranslate(array('s' => 'Cheque payment','mod' => 'cheque'), $this);?>
</h3>
<form action="<?php echo $this->_tpl_vars['this_path_ssl']; ?>
validation.php" method="post">
	<p>
		<img src="<?php echo $this->_tpl_vars['this_path']; ?>
cheque.jpg" alt="<?php echo smartyTranslate(array('s' => 'cheque','mod' => 'cheque'), $this);?>
" style="float:left; margin: 0px 10px 5px 0px;" />
		<?php echo smartyTranslate(array('s' => 'You have chosen to pay by cheque.','mod' => 'cheque'), $this);?>

		<br/><br />
		<?php echo smartyTranslate(array('s' => 'Here is a short summary of your order:','mod' => 'cheque'), $this);?>

	</p>
	<p style="margin-top:20px;">
		- <?php echo smartyTranslate(array('s' => 'The total amount of your order is','mod' => 'cheque'), $this);?>

		<span id="amount" class="price"><?php echo Tools::displayPriceSmarty(array('price' => $this->_tpl_vars['total']), $this);?>
</span>
		<?php echo smartyTranslate(array('s' => '(tax incl.)','mod' => 'cheque'), $this);?>

	</p>
	<p>
		-
		<?php if (count($this->_tpl_vars['currencies']) > 1): ?>
			<?php echo smartyTranslate(array('s' => 'We accept several currencies for cheques.','mod' => 'cheque'), $this);?>

			<br /><br />
			<?php echo smartyTranslate(array('s' => 'Choose one of the following:','mod' => 'cheque'), $this);?>

			<select id="currency_payement" name="currency_payement" onchange="setCurrency($('#currency_payement').val());">
			<?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['currency']):
?>
				<option value="<?php echo $this->_tpl_vars['currency']['id_currency']; ?>
" <?php if ($this->_tpl_vars['currency']['id_currency'] == $this->_tpl_vars['cust_currency']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['currency']['name']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php else: ?>
			<?php echo smartyTranslate(array('s' => 'We accept the following currency to be sent by cheque:','mod' => 'cheque'), $this);?>
&nbsp;<b><?php echo $this->_tpl_vars['currencies']['0']['name']; ?>
</b>
			<input type="hidden" name="currency_payement" value="<?php echo $this->_tpl_vars['currencies']['0']['id_currency']; ?>
" />
		<?php endif; ?>
	</p>
	<p>
		<?php echo smartyTranslate(array('s' => 'Cheque owner and address information will be displayed on the next page.','mod' => 'cheque'), $this);?>

		<br /><br />
		<b><?php echo smartyTranslate(array('s' => 'Please confirm your order by clicking \'I confirm my order\'','mod' => 'cheque'), $this);?>
.</b>
	</p>
	<p class="cart_navigation">
		<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
order.php?step=3" class="button_large"><?php echo smartyTranslate(array('s' => 'Other payment methods','mod' => 'cheque'), $this);?>
</a>
		<input type="submit" name="submit" value="<?php echo smartyTranslate(array('s' => 'I confirm my order','mod' => 'cheque'), $this);?>
" class="exclusive_large" />
	</p>
</form>
<?php endif; ?>