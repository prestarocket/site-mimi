<?php /* Smarty version 2.6.20, created on 2011-02-28 22:09:29
         compiled from /homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl', 1, false),array('function', 'dateFormat', '/homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl', 1, false),array('function', 'displayWtPriceWithCurrency', '/homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl', 86, false),array('function', 'convertPriceWithCurrency', '/homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl', 135, false),array('function', 'counter', '/homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl', 150, false),array('modifier', 'escape', '/homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl', 17, false),array('modifier', 'string_format', '/homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl', 30, false),array('modifier', 'intval', '/homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl', 36, false),array('modifier', 'nl2br', '/homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl', 44, false),array('modifier', 'count', '/homez.387/lilibio/www/site/themes/prestashop/order-detail.tpl', 253, false),)), $this); ?>
<h4><?php echo smartyTranslate(array('s' => 'Order placed on'), $this);?>
 <?php echo Tools::dateFormat(array('date' => $this->_tpl_vars['order']->date_add,'full' => 0), $this);?>
</h4>

<?php if (count ( $this->_tpl_vars['order_history'] )): ?>
<p class="bold"><?php echo smartyTranslate(array('s' => 'Follow your order step by step'), $this);?>
</p>
<div class="table_block">
	<table class="detail_step_by_step std">
		<thead>
			<tr>
				<th class="first_item"><?php echo smartyTranslate(array('s' => 'Date'), $this);?>
</th>
				<th class="last_item"><?php echo smartyTranslate(array('s' => 'Status'), $this);?>
</th>
			</tr>
		</thead>
		<tbody>
		<?php $_from = $this->_tpl_vars['order_history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['orderStates'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['orderStates']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['state']):
        $this->_foreach['orderStates']['iteration']++;
?>
			<tr class="<?php if (($this->_foreach['orderStates']['iteration'] <= 1)): ?>first_item<?php elseif (($this->_foreach['orderStates']['iteration'] == $this->_foreach['orderStates']['total'])): ?>last_item<?php endif; ?> <?php if (($this->_foreach['orderStates']['iteration']-1) % 2): ?>alternate_item<?php else: ?>item<?php endif; ?>">
				<td><?php echo Tools::dateFormat(array('date' => $this->_tpl_vars['state']['date_add'],'full' => 1), $this);?>
</td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['state']['ostate_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['followup']): ?>
<p class="bold"><?php echo smartyTranslate(array('s' => 'Click the following link to track delivery of your order'), $this);?>
</p>
<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['followup'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['followup'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a>
<?php endif; ?>

<p class="bold"><?php echo smartyTranslate(array('s' => 'Order:'), $this);?>
 <span class="color-myaccount"><?php echo smartyTranslate(array('s' => '#'), $this);?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['order']->id)) ? $this->_run_mod_handler('string_format', true, $_tmp, "%06d") : smarty_modifier_string_format($_tmp, "%06d")); ?>
</span></p>
<?php if ($this->_tpl_vars['carrier']->id): ?><p class="bold"><?php echo smartyTranslate(array('s' => 'Carrier:'), $this);?>
 <?php if ($this->_tpl_vars['carrier']->name == '0'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['shop_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['carrier']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php endif; ?></p><?php endif; ?>
<p class="bold"><?php echo smartyTranslate(array('s' => 'Payment method:'), $this);?>
 <span class="color-myaccount"><?php echo ((is_array($_tmp=$this->_tpl_vars['order']->payment)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</span></p>
<?php if ($this->_tpl_vars['invoice'] && $this->_tpl_vars['invoiceAllowed']): ?>
<p>
	<img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/pdf.gif" alt="" class="icon" />
	<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
pdf-invoice.php?id_order=<?php echo ((is_array($_tmp=$this->_tpl_vars['order']->id)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><?php echo smartyTranslate(array('s' => 'Download your invoice as a .PDF file'), $this);?>
</a>
</p>
<?php endif; ?>
<?php if ($this->_tpl_vars['order']->recyclable): ?>
<p><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/recyclable.gif" alt="" class="icon" />&nbsp;<?php echo smartyTranslate(array('s' => 'You have given permission to receive your order in recycled packaging.'), $this);?>
</p>
<?php endif; ?>
<?php if ($this->_tpl_vars['order']->gift): ?>
	<p><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/gift.gif" alt="" class="icon" />&nbsp;<?php echo smartyTranslate(array('s' => 'You requested gift-wrapping for your order.'), $this);?>
</p>
	<p><?php echo smartyTranslate(array('s' => 'Message:'), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['order']->gift_message)) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>
<?php endif; ?>
<br />
<ul class="address item">
	<li class="address_title"><?php echo smartyTranslate(array('s' => 'Invoice'), $this);?>
</li>
	<?php if ($this->_tpl_vars['address_invoice']->company): ?><li class="address_company"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_invoice']->company)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li><?php endif; ?>
	<li class="address_name"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_invoice']->firstname)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['address_invoice']->lastname)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li>
	<li class="address_address1"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_invoice']->address1)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li>
	<?php if ($this->_tpl_vars['address_invoice']->address2): ?><li class="address_address2"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_invoice']->address2)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li><?php endif; ?>
	<li class="address_city"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_invoice']->postcode)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['address_invoice']->city)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li>
	<li class="address_country"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_invoice']->country)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php if ($this->_tpl_vars['invoiceState']): ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceState']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php endif; ?></li>
	<?php if ($this->_tpl_vars['address_invoice']->phone): ?><li class="address_phone"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_invoice']->phone)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li><?php endif; ?>
	<?php if ($this->_tpl_vars['address_invoice']->phone_mobile): ?><li class="address_phone_mobile"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_invoice']->phone_mobile)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li><?php endif; ?>
</ul>
<ul class="address alternate_item">
	<li class="address_title"><?php echo smartyTranslate(array('s' => 'Delivery'), $this);?>
</li>
	<?php if ($this->_tpl_vars['address_delivery']->company): ?><li class="address_company"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_delivery']->company)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li><?php endif; ?>
	<li class="address_name"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_delivery']->firstname)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['address_delivery']->lastname)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li>
	<li class="address_address1"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_delivery']->address1)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li>
	<?php if ($this->_tpl_vars['address_delivery']->address2): ?><li class="address_address2"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_delivery']->address2)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li><?php endif; ?>
	<li class="address_city"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_delivery']->postcode)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['address_delivery']->city)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li>
	<li class="address_country"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_delivery']->country)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php if ($this->_tpl_vars['deliveryState']): ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['deliveryState']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php endif; ?></li>
	<?php if ($this->_tpl_vars['address_delivery']->phone): ?><li class="address_phone"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_delivery']->phone)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li><?php endif; ?>
	<?php if ($this->_tpl_vars['address_delivery']->phone_mobile): ?><li class="address_phone_mobile"><?php echo ((is_array($_tmp=$this->_tpl_vars['address_delivery']->phone_mobile)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li><?php endif; ?>
</ul>
<form action="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
order-follow.php" method="post">
<div id="order-detail-content" class="table_block">
	<table class="std">
		<thead>
			<tr>
				<?php if ($this->_tpl_vars['return_allowed']): ?><th class="first_item"><input type="checkbox" /></th><?php endif; ?>
				<th class="<?php if ($this->_tpl_vars['return_allowed']): ?>item<?php else: ?>first_item<?php endif; ?>"><?php echo smartyTranslate(array('s' => 'Reference'), $this);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s' => 'Product'), $this);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s' => 'Quantity'), $this);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s' => 'Unit price'), $this);?>
</th>
				<th class="last_item"><?php echo smartyTranslate(array('s' => 'Total price'), $this);?>
</th>
			</tr>
		</thead>
		<tfoot>
			<?php if ($this->_tpl_vars['priceDisplay']): ?>
				<tr class="item">
					<td colspan="<?php if ($this->_tpl_vars['return_allowed']): ?>6<?php else: ?>5<?php endif; ?>">
						<?php echo smartyTranslate(array('s' => 'Total products (tax excl.):'), $this);?>
 <span class="price"><?php echo Product::displayWtPriceWithCurrency(array('price' => $this->_tpl_vars['order']->getTotalProductsWithoutTaxes(),'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
</span>
					</td>
				</tr>
			<?php endif; ?>
			<tr class="item">
				<td colspan="<?php if ($this->_tpl_vars['return_allowed']): ?>6<?php else: ?>5<?php endif; ?>">
					<?php echo smartyTranslate(array('s' => 'Total products (tax incl.):'), $this);?>
 <span class="price"><?php echo Product::displayWtPriceWithCurrency(array('price' => $this->_tpl_vars['order']->getTotalProductsWithTaxes(),'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
</span>
				</td>
			</tr>
			<?php if ($this->_tpl_vars['order']->total_discounts > 0): ?>
			<tr class="item">
				<td colspan="<?php if ($this->_tpl_vars['return_allowed']): ?>6<?php else: ?>5<?php endif; ?>">
					<?php echo smartyTranslate(array('s' => 'Total vouchers:'), $this);?>
 <span class="price-discount"><?php echo Product::displayWtPriceWithCurrency(array('price' => $this->_tpl_vars['order']->total_discounts,'currency' => $this->_tpl_vars['currency'],'convert' => 1), $this);?>
</span>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['order']->total_wrapping > 0): ?>
			<tr class="item">
				<td colspan="<?php if ($this->_tpl_vars['return_allowed']): ?>6<?php else: ?>5<?php endif; ?>">
					<?php echo smartyTranslate(array('s' => 'Total gift-wrapping:'), $this);?>
 <span class="price-wrapping"><?php echo Product::displayWtPriceWithCurrency(array('price' => $this->_tpl_vars['order']->total_wrapping,'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
</span>
				</td>
			</tr>
			<?php endif; ?>
			<tr class="item">
				<td colspan="<?php if ($this->_tpl_vars['return_allowed']): ?>6<?php else: ?>5<?php endif; ?>">
					<?php echo smartyTranslate(array('s' => 'Total shipping (tax incl.):'), $this);?>
 <span class="price-shipping"><?php echo Product::displayWtPriceWithCurrency(array('price' => $this->_tpl_vars['order']->total_shipping,'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
</span>
				</td>
			</tr>
			<tr class="item">
				<td colspan="<?php if ($this->_tpl_vars['return_allowed']): ?>6<?php else: ?>5<?php endif; ?>">
					<?php echo smartyTranslate(array('s' => 'Total:'), $this);?>
 <span class="price"><?php echo Product::displayWtPriceWithCurrency(array('price' => $this->_tpl_vars['order']->total_paid,'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
</span>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['products'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['products']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['products']['iteration']++;
?>
			<?php if (! $this->_tpl_vars['product']['deleted']): ?>
				<?php $this->assign('productId', $this->_tpl_vars['product']['product_id']); ?>
				<?php $this->assign('productAttributeId', $this->_tpl_vars['product']['product_attribute_id']); ?>
				<?php if (isset ( $this->_tpl_vars['customizedDatas'][$this->_tpl_vars['productId']][$this->_tpl_vars['productAttributeId']] )): ?><?php $this->assign('productQuantity', $this->_tpl_vars['product']['product_quantity']-$this->_tpl_vars['product']['customizationQuantityTotal']); ?><?php else: ?><?php $this->assign('productQuantity', $this->_tpl_vars['product']['product_quantity']); ?><?php endif; ?>
				<!-- Customized products -->
				<?php if (isset ( $this->_tpl_vars['customizedDatas'][$this->_tpl_vars['productId']][$this->_tpl_vars['productAttributeId']] )): ?>
					<tr class="item">
						<?php if ($this->_tpl_vars['return_allowed']): ?><td class="order_cb"></td><?php endif; ?>
						<td><label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><?php if ($this->_tpl_vars['product']['product_reference']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_reference'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php else: ?>--<?php endif; ?></label></td>
						<td class="bold">
							<label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</label>
						</td>
						<td><input class="order_qte_input" name="order_qte_input[<?php echo ($this->_foreach['products']['iteration']-1); ?>
]" type="text" size="2" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['customizationQuantityTotal'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" /><label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><span class="order_qte_span editable"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['customizationQuantityTotal'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
</span></label></td>
						<td><label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><?php echo Product::convertPriceWithCurrency(array('price' => $this->_tpl_vars['product']['product_price_wt'],'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
</label></td>
						<td><label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><?php if (isset ( $this->_tpl_vars['customizedDatas'][$this->_tpl_vars['productId']][$this->_tpl_vars['productAttributeId']] )): ?><?php echo Product::convertPriceWithCurrency(array('price' => $this->_tpl_vars['product']['total_customization_wt'],'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
<?php else: ?><?php echo Product::convertPriceWithCurrency(array('price' => $this->_tpl_vars['product']['total_wt'],'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
<?php endif; ?></label></td>
					</tr>
					<?php $_from = $this->_tpl_vars['customizedDatas'][$this->_tpl_vars['productId']][$this->_tpl_vars['productAttributeId']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['customizationId'] => $this->_tpl_vars['customization']):
?>
					<tr class="alternate_item">
						<?php if ($this->_tpl_vars['return_allowed']): ?><td class="order_cb"><input type="checkbox" id="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" name="customization_ids[<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
][]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['customizationId'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" /></td><?php endif; ?>
						<td colspan="2">
						<?php $_from = $this->_tpl_vars['customization']['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type'] => $this->_tpl_vars['datas']):
?>
							<?php if ($this->_tpl_vars['type'] == $this->_tpl_vars['CUSTOMIZE_FILE']): ?>
							<ul class="customizationUploaded">
								<?php $_from = $this->_tpl_vars['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data']):
?>
									<li><img src="<?php echo $this->_tpl_vars['pic_dir']; ?>
<?php echo $this->_tpl_vars['data']['value']; ?>
_small" alt="" class="customizationUploaded" /></li>
								<?php endforeach; endif; unset($_from); ?>
							</ul>
							<?php elseif ($this->_tpl_vars['type'] == $this->_tpl_vars['CUSTOMIZE_TEXTFIELD']): ?>
							<ul class="typedText"><?php echo smarty_function_counter(array('start' => 0,'print' => false), $this);?>

								<?php $_from = $this->_tpl_vars['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data']):
?>
									<li><?php echo $this->_tpl_vars['data']['name']; ?>
<?php echo smartyTranslate(array('s' => ':'), $this);?>
 <?php echo $this->_tpl_vars['data']['value']; ?>
</li>
								<?php endforeach; endif; unset($_from); ?>
							</ul>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
						</td>
						<td>
							<input class="order_qte_input" name="customization_qty_input[<?php echo ((is_array($_tmp=$this->_tpl_vars['customizationId'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
]" type="text" size="2" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['customization']['quantity'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" /><label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><span class="order_qte_span editable"><?php echo ((is_array($_tmp=$this->_tpl_vars['customization']['quantity'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
</span></label>
						</td>
						<td colspan="2"></td>
					</tr>
					<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
				<!-- Classic products -->
				<?php if ($this->_tpl_vars['product']['product_quantity'] > $this->_tpl_vars['product']['customizationQuantityTotal']): ?>
					<tr class="item">
						<?php if ($this->_tpl_vars['return_allowed']): ?><td class="order_cb"><input type="checkbox" id="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" name="ids_order_detail[<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" /></td><?php endif; ?>
						<td><label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><?php if ($this->_tpl_vars['product']['product_reference']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_reference'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php else: ?>--<?php endif; ?></label></td>
						<td class="bold">
							<label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
">
								<?php if ($this->_tpl_vars['product']['download_hash'] && $this->_tpl_vars['invoice']): ?>
									<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
get-file.php?key=<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['filename'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['download_hash'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" title="<?php echo smartyTranslate(array('s' => 'download this product'), $this);?>
">
										<img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/download_product.gif" class="icon" alt="<?php echo smartyTranslate(array('s' => 'Download product'), $this);?>
" />
									</a>
									<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
get-file.php?key=<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['filename'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['download_hash'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" title="<?php echo smartyTranslate(array('s' => 'download this product'), $this);?>
">
										<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>

									</a>
								<?php else: ?>
									<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['product_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>

								<?php endif; ?>
							</label>
						</td>
						<td><input class="order_qte_input" name="order_qte_input[<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
]" type="text" size="2" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['productQuantity'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" /><label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><span class="order_qte_span editable"><?php echo ((is_array($_tmp=$this->_tpl_vars['productQuantity'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
</span></label></td>
						<td><label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><?php echo Product::convertPriceWithCurrency(array('price' => $this->_tpl_vars['product']['product_price_wt'],'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
</label></td>
						<td><label for="cb_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_order_detail'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><?php echo Product::convertPriceWithCurrency(array('price' => $this->_tpl_vars['product']['total_wt'],'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
</label></td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php $_from = $this->_tpl_vars['discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discount']):
?>
			<tr class="item">
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['discount']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</td>
				<td><?php echo smartyTranslate(array('s' => 'Voucher:'), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['discount']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</td>
				<td><span class="order_qte_span editable">1</span></td>
				<td>&nbsp;</td>
				<td><?php echo smartyTranslate(array('s' => '-'), $this);?>
<?php echo Product::convertPriceWithCurrency(array('price' => $this->_tpl_vars['discount']['value'],'currency' => $this->_tpl_vars['currency'],'convert' => 0), $this);?>
</td>
				<?php if ($this->_tpl_vars['return_allowed']): ?>
				<td>&nbsp;</td>
				<?php endif; ?>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
</div>
<?php if ($this->_tpl_vars['return_allowed']): ?>
<br />
<p class="bold"><?php echo smartyTranslate(array('s' => 'Merchandise return'), $this);?>
</p>
<p><?php echo smartyTranslate(array('s' => 'If you want to return one or several products, please mark the corresponding checkbox(es) and provide an explanation for the return. Then click the button below.'), $this);?>
</p>
<p class="textarea">
	<textarea cols="67" rows="3" name="returnText"></textarea>
</p>
<p class="submit">
	<input type="submit" value="<?php echo smartyTranslate(array('s' => 'Make a RMA slip'), $this);?>
" name="submitReturnMerchandise" class="button_large" />
	<input type="hidden" class="hidden" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['order']->id)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" name="id_order" />
</p>
<br />
<?php endif; ?>
</form>
<?php if (count ( $this->_tpl_vars['messages'] )): ?>
<p class="bold"><?php echo smartyTranslate(array('s' => 'Messages'), $this);?>
</p>
<div class="table_block">
	<table class="detail_step_by_step std">
		<thead>
			<tr>
				<th class="first_item" style="width:150px;"><?php echo smartyTranslate(array('s' => 'From'), $this);?>
</th>
				<th class="last_item"><?php echo smartyTranslate(array('s' => 'Message'), $this);?>
</th>
			</tr>
		</thead>
		<tbody>
		<?php $_from = $this->_tpl_vars['messages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['messageList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['messageList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['message']):
        $this->_foreach['messageList']['iteration']++;
?>
			<tr class="<?php if (($this->_foreach['messageList']['iteration'] <= 1)): ?>first_item<?php elseif (($this->_foreach['messageList']['iteration'] == $this->_foreach['messageList']['total'])): ?>last_item<?php endif; ?> <?php if (($this->_foreach['messageList']['iteration']-1) % 2): ?>alternate_item<?php else: ?>item<?php endif; ?>">
				<td>
					<?php if ($this->_tpl_vars['message']['ename']): ?>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['message']['efirstname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['message']['elastname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>

					<?php elseif ($this->_tpl_vars['message']['clastname']): ?>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['message']['cfirstname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['message']['clastname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>

					<?php else: ?>
						<b><?php echo ((is_array($_tmp=$this->_tpl_vars['shop_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</b>
					<?php endif; ?>
					<br />
					<?php echo Tools::dateFormat(array('date' => $this->_tpl_vars['message']['date_add'],'full' => 1), $this);?>

				</td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['message']['message'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
</div>
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['errors'] ) && $this->_tpl_vars['errors']): ?>
	<div class="error">
		<p><?php if (count($this->_tpl_vars['errors']) > 1): ?><?php echo smartyTranslate(array('s' => 'There are'), $this);?>
<?php else: ?><?php echo smartyTranslate(array('s' => 'There is'), $this);?>
<?php endif; ?> <?php echo count($this->_tpl_vars['errors']); ?>
 <?php if (count($this->_tpl_vars['errors']) > 1): ?><?php echo smartyTranslate(array('s' => 'errors'), $this);?>
<?php else: ?><?php echo smartyTranslate(array('s' => 'error'), $this);?>
<?php endif; ?> :</p>
		<ol>
		<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['error']):
?>
			<li><?php echo $this->_tpl_vars['error']; ?>
</li>
		<?php endforeach; endif; unset($_from); ?>
		</ol>
	</div>
<?php endif; ?>
<form action="<?php echo $this->_tpl_vars['base_dir']; ?>
order-detail.php" method="post" class="std" id="sendOrderMessage">
	<p class="bold"><?php echo smartyTranslate(array('s' => 'Add a message:'), $this);?>
</p>
	<p><?php echo smartyTranslate(array('s' => 'If you want to leave us comment about your order, please write it below.'), $this);?>
</p>
	<p class="textarea">
		<textarea cols="67" rows="3" name="msgText"></textarea>
	</p>
	<p class="submit">
		<input type="hidden" name="id_order" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['order']->id)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" />
		<input type="submit" class="button" name="submitMessage" value="<?php echo smartyTranslate(array('s' => 'Send'), $this);?>
"/>
	</p>
</form>