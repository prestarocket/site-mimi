<?php /* Smarty version 2.6.20, created on 2011-02-22 21:19:15
         compiled from /homez.387/lilibio/www/site/modules/paypal/paypal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www/site/modules/paypal/paypal.tpl', 2, false),)), $this); ?>
<p class="payment_module">
	<a href="modules/paypal/redirect.php" title="<?php echo smartyTranslate(array('s' => 'Pay with PayPal','mod' => 'paypal'), $this);?>
">
		<img src="<?php echo $this->_tpl_vars['module_template_dir']; ?>
paypal.gif" alt="<?php echo smartyTranslate(array('s' => 'Pay with PayPal','mod' => 'paypal'), $this);?>
" />
		<?php echo smartyTranslate(array('s' => 'Pay with PayPal','mod' => 'paypal'), $this);?>

	</a>
</p>