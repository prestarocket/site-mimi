<?php /* Smarty version 2.6.20, created on 2011-02-28 22:05:47
         compiled from /homez.387/lilibio/www/site/themes/prestashop/order-address.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'intval', '/homez.387/lilibio/www/site/themes/prestashop/order-address.tpl', 6, false),array('modifier', 'addslashes', '/homez.387/lilibio/www/site/themes/prestashop/order-address.tpl', 6, false),array('modifier', 'default', '/homez.387/lilibio/www/site/themes/prestashop/order-address.tpl', 6, false),array('modifier', 'escape', '/homez.387/lilibio/www/site/themes/prestashop/order-address.tpl', 28, false),array('modifier', 'count', '/homez.387/lilibio/www/site/themes/prestashop/order-address.tpl', 33, false),array('function', 'l', '/homez.387/lilibio/www/site/themes/prestashop/order-address.tpl', 12, false),)), $this); ?>
<script type="text/javascript">
<!--
	var baseDir = '<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
';
	var addresses = new Array();
	<?php $_from = $this->_tpl_vars['addresses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['address']):
?>
		addresses[<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['id_address'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
] = new Array('<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['company'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['firstname'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['lastname'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['address1'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['address2'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['postcode'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['city'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['country'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
', '<?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['address']['state'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')))) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
');
	<?php endforeach; endif; unset($_from); ?>
-->
</script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['js_dir']; ?>
order-address.js"></script>

<?php ob_start(); ?><?php echo smartyTranslate(array('s' => 'Addresses'), $this);?>
<?php $this->_smarty_vars['capture']['path'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo smartyTranslate(array('s' => 'Addresses'), $this);?>
</h2>

<?php $this->assign('current_step', 'address'); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./order-steps.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form action="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
order.php" method="post">
	<div class="addresses">
		<p class="address_delivery select">
			<label for="id_address_delivery"><?php echo smartyTranslate(array('s' => 'Choose a delivery address:'), $this);?>
</label>
			<select name="id_address_delivery" id="id_address_delivery" class="address_select" onchange="updateAddressesDisplay();">
			<?php $_from = $this->_tpl_vars['addresses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['address']):
?>
				<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['id_address'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" <?php if ($this->_tpl_vars['address']['id_address'] == $this->_tpl_vars['cart']->id_address_delivery): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['address']['alias'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
		</p>
		<p class="checkbox">
			<input type="checkbox" name="same" id="addressesAreEquals" value="1" onclick="updateAddressesDisplay();" <?php if ($this->_tpl_vars['cart']->id_address_invoice == $this->_tpl_vars['cart']->id_address_delivery || count($this->_tpl_vars['addresses']) == 1): ?>checked="checked"<?php endif; ?> />
			<label for="addressesAreEquals"><?php echo smartyTranslate(array('s' => 'Use the same address for billing.'), $this);?>
</label>
		</p>
		<p id="address_invoice_form" class="select" <?php if ($this->_tpl_vars['cart']->id_address_invoice == $this->_tpl_vars['cart']->id_address_delivery): ?>style="display: none;"<?php endif; ?>>
		<?php if (count($this->_tpl_vars['addresses']) > 1): ?>
			<label for="id_address_invoice" class="strong"><?php echo smartyTranslate(array('s' => 'Choose a billing address:'), $this);?>
</label>
			<select name="id_address_invoice" id="id_address_invoice" class="address_select" onchange="updateAddressesDisplay();">
			<?php unset($this->_sections['address']);
$this->_sections['address']['loop'] = is_array($_loop=$this->_tpl_vars['addresses']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['address']['step'] = ((int)-1) == 0 ? 1 : (int)-1;
$this->_sections['address']['name'] = 'address';
$this->_sections['address']['show'] = true;
$this->_sections['address']['max'] = $this->_sections['address']['loop'];
$this->_sections['address']['start'] = $this->_sections['address']['step'] > 0 ? 0 : $this->_sections['address']['loop']-1;
if ($this->_sections['address']['show']) {
    $this->_sections['address']['total'] = min(ceil(($this->_sections['address']['step'] > 0 ? $this->_sections['address']['loop'] - $this->_sections['address']['start'] : $this->_sections['address']['start']+1)/abs($this->_sections['address']['step'])), $this->_sections['address']['max']);
    if ($this->_sections['address']['total'] == 0)
        $this->_sections['address']['show'] = false;
} else
    $this->_sections['address']['total'] = 0;
if ($this->_sections['address']['show']):

            for ($this->_sections['address']['index'] = $this->_sections['address']['start'], $this->_sections['address']['iteration'] = 1;
                 $this->_sections['address']['iteration'] <= $this->_sections['address']['total'];
                 $this->_sections['address']['index'] += $this->_sections['address']['step'], $this->_sections['address']['iteration']++):
$this->_sections['address']['rownum'] = $this->_sections['address']['iteration'];
$this->_sections['address']['index_prev'] = $this->_sections['address']['index'] - $this->_sections['address']['step'];
$this->_sections['address']['index_next'] = $this->_sections['address']['index'] + $this->_sections['address']['step'];
$this->_sections['address']['first']      = ($this->_sections['address']['iteration'] == 1);
$this->_sections['address']['last']       = ($this->_sections['address']['iteration'] == $this->_sections['address']['total']);
?>
				<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['addresses'][$this->_sections['address']['index']]['id_address'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" <?php if ($this->_tpl_vars['addresses'][$this->_sections['address']['index']]['id_address'] == $this->_tpl_vars['cart']->id_address_invoice && $this->_tpl_vars['cart']->id_address_delivery != $this->_tpl_vars['cart']->id_address_invoice): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['addresses'][$this->_sections['address']['index']]['alias'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</option>
			<?php endfor; endif; ?>
			</select>
			<?php else: ?>
				<a style="margin-left: 221px;" href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
address.php?back=order.php&amp;step=1&select_address=1<?php if ($this->_tpl_vars['back']): ?>&mod=<?php echo $this->_tpl_vars['back']; ?>
<?php endif; ?>" title="<?php echo smartyTranslate(array('s' => 'Add'), $this);?>
" class="button_large"><?php echo smartyTranslate(array('s' => 'Add a new address'), $this);?>
</a>
			<?php endif; ?>
		</p>
		<div class="clear"></div>
		<ul class="address item" id="address_delivery">
			<li class="address_title"><?php echo smartyTranslate(array('s' => 'Your delivery address'), $this);?>
</li>
			<li class="address_company"></li>
			<li class="address_name"></li>
			<li class="address_address1"></li>
			<li class="address_address2"></li>
			<li class="address_city"></li>
			<li class="address_country"></li>
			<li class="address_update"><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
address.php?id_address=<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['id_address'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
&amp;back=order.php&amp;step=1<?php if ($this->_tpl_vars['back']): ?>&mod=<?php echo $this->_tpl_vars['back']; ?>
<?php endif; ?>" title="<?php echo smartyTranslate(array('s' => 'Update'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Update'), $this);?>
</a></li>
		</ul>
		<ul class="address alternate_item" id="address_invoice">
			<li class="address_title"><?php echo smartyTranslate(array('s' => 'Your billing address'), $this);?>
</li>
			<li class="address_company"></li>
			<li class="address_name"></li>
			<li class="address_address1"></li>
			<li class="address_address2"></li>
			<li class="address_city"></li>
			<li class="address_country"></li>
			<li class="address_update"><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
address.php?id_address=<?php echo ((is_array($_tmp=$this->_tpl_vars['address']['id_address'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
&amp;back=order.php&amp;step=1<?php if ($this->_tpl_vars['back']): ?>&mod=<?php echo $this->_tpl_vars['back']; ?>
<?php endif; ?>" title="<?php echo smartyTranslate(array('s' => 'Update'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Update'), $this);?>
</a></li>
		</ul>
		<br class="clear" />
		<p class="address_add submit">
			<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
address.php?back=order.php&amp;step=1<?php if ($this->_tpl_vars['back']): ?>&mod=<?php echo $this->_tpl_vars['back']; ?>
<?php endif; ?>" title="<?php echo smartyTranslate(array('s' => 'Add'), $this);?>
" class="button_large"><?php echo smartyTranslate(array('s' => 'Add a new address'), $this);?>
</a>
		</p>
		<div id="ordermsg">
			<p><?php echo smartyTranslate(array('s' => 'If you want to leave us comment about your order, please write it below.'), $this);?>
</p>
			<p class="textarea"><textarea cols="60" rows="3" name="message"><?php echo $this->_tpl_vars['oldMessage']; ?>
</textarea></p>
		</div>
	</div>
	<p class="cart_navigation submit">
		<input type="hidden" class="hidden" name="step" value="2" />
		<input type="hidden" name="back" value="<?php echo $this->_tpl_vars['back']; ?>
" />
		<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
order.php?step=0<?php if ($this->_tpl_vars['back']): ?>&back=<?php echo $this->_tpl_vars['back']; ?>
<?php endif; ?>" title="<?php echo smartyTranslate(array('s' => 'Previous'), $this);?>
" class="button">&laquo; <?php echo smartyTranslate(array('s' => 'Previous'), $this);?>
</a>
		<input type="submit" name="processAddress" value="<?php echo smartyTranslate(array('s' => 'Next'), $this);?>
 &raquo;" class="exclusive" />
	</p>
</form>