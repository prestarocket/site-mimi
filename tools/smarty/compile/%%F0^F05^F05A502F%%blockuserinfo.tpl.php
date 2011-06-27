<?php /* Smarty version 2.6.20, created on 2011-05-07 09:38:25
         compiled from /homez.387/lilibio/www2/site2.0/modules/blockuserinfo/blockuserinfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www2/site2.0/modules/blockuserinfo/blockuserinfo.tpl', 4, false),array('function', 'convertPrice', '/homez.387/lilibio/www2/site2.0/modules/blockuserinfo/blockuserinfo.tpl', 18, false),)), $this); ?>
<!-- Block user information module HEADER -->
<div id="header_user">
	<p id="header_user_info">
		<?php echo smartyTranslate(array('s' => 'Welcome','mod' => 'blockuserinfo'), $this);?>
,
		<?php if ($this->_tpl_vars['logged']): ?>
			<span><?php echo $this->_tpl_vars['customerName']; ?>
</span> (<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
index.php?mylogout" title="<?php echo smartyTranslate(array('s' => 'Log me out','mod' => 'blockuserinfo'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Log out','mod' => 'blockuserinfo'), $this);?>
</a>)
		<?php else: ?>
			<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
my-account.php"><?php echo smartyTranslate(array('s' => 'Log in','mod' => 'blockuserinfo'), $this);?>
</a>
		<?php endif; ?>
		<span id="shopping_cart">
			<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
order.php" title="<?php echo smartyTranslate(array('s' => 'Your Shopping Cart','mod' => 'blockuserinfo'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Cart:','mod' => 'blockuserinfo'), $this);?>
</a>
			<span class="ajax_cart_quantity<?php if ($this->_tpl_vars['cart_qties'] == 0): ?> hidden<?php endif; ?>"><?php echo $this->_tpl_vars['cart_qties']; ?>
</span>
			<span class="ajax_cart_product_txt<?php if ($this->_tpl_vars['cart_qties'] != 1): ?> hidden<?php endif; ?>"><?php echo smartyTranslate(array('s' => 'product','mod' => 'blockuserinfo'), $this);?>
</span>
			<span class="ajax_cart_product_txt_s<?php if ($this->_tpl_vars['cart_qties'] < 2): ?> hidden<?php endif; ?>"><?php echo smartyTranslate(array('s' => 'products','mod' => 'blockuserinfo'), $this);?>
</span>
			<?php if ($this->_tpl_vars['cart_qties'] > 0): ?>
				<span class="ajax_cart_total<?php if ($this->_tpl_vars['cart_qties'] == 0): ?> hidden<?php endif; ?>">
					<?php if ($this->_tpl_vars['priceDisplay'] == 1): ?>
						<?php echo Product::convertPrice(array('price' => $this->_tpl_vars['cart']->getOrderTotal(false,4)), $this);?>

					<?php else: ?>
						<?php echo Product::convertPrice(array('price' => $this->_tpl_vars['cart']->getOrderTotal(true,4)), $this);?>

					<?php endif; ?>
				</span>
			<?php endif; ?>
			<span class="ajax_cart_no_product<?php if ($this->_tpl_vars['cart_qties'] > 0): ?> hidden<?php endif; ?>"><?php echo smartyTranslate(array('s' => '(empty)','mod' => 'blockuserinfo'), $this);?>
</span>
		</span>
		<span id="your_account"><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
my-account.php" title="<?php echo smartyTranslate(array('s' => 'Your Account','mod' => 'blockuserinfo'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Your Account','mod' => 'blockuserinfo'), $this);?>
</a></span>
	</p>
</div>
<!-- /Block user information module HEADER -->