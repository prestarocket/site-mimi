<?php /* Smarty version 2.6.20, created on 2011-02-25 14:11:04
         compiled from /homez.387/lilibio/www/site/modules/blockwishlist/blockwishlist-ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'intval', '/homez.387/lilibio/www/site/modules/blockwishlist/blockwishlist-ajax.tpl', 5, false),array('modifier', 'escape', '/homez.387/lilibio/www/site/modules/blockwishlist/blockwishlist-ajax.tpl', 6, false),array('modifier', 'truncate', '/homez.387/lilibio/www/site/modules/blockwishlist/blockwishlist-ajax.tpl', 6, false),array('function', 'l', '/homez.387/lilibio/www/site/modules/blockwishlist/blockwishlist-ajax.tpl', 7, false),)), $this); ?>
<?php if ($this->_tpl_vars['products']): ?>
	<dl class="products" style="<?php if ($this->_tpl_vars['products']): ?>border-bottom:1px solid #fff;<?php endif; ?>">
	<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['i']['iteration']++;
?>
		<dt class="<?php if (($this->_foreach['i']['iteration'] <= 1)): ?>first_item<?php elseif (($this->_foreach['i']['iteration'] == $this->_foreach['i']['total'])): ?>last_item<?php else: ?>item<?php endif; ?>">
			<span class="quantity-formated"><span class="quantity"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['quantity'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
</span>x</span>
			<a class="cart_block_product_name" href="<?php echo $this->_tpl_vars['link']->getProductLink($this->_tpl_vars['product']['id_product'],$this->_tpl_vars['product']['link_rewrite'],$this->_tpl_vars['product']['category_rewrite']); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" style="font-weight:bold;"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 13, '...') : smarty_modifier_truncate($_tmp, 13, '...')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a>
			<a class="ajax_cart_block_remove_link" href="javascript:;" onclick="javascript:WishlistCart('wishlist_block_list', 'delete', '<?php echo $this->_tpl_vars['product']['id_product']; ?>
', <?php echo $this->_tpl_vars['product']['id_product_attribute']; ?>
, '0', '<?php echo $this->_tpl_vars['static_token']; ?>
');" title="<?php echo smartyTranslate(array('s' => 'remove this product from my wishlist','mod' => 'blockwishlist'), $this);?>
"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/delete.gif" alt="<?php echo smartyTranslate(array('s' => 'Delete'), $this);?>
" class="icon" /></a>
		</dt>
		<?php if (isset ( $this->_tpl_vars['product']['attributes_small'] )): ?>
		<dd class="<?php if (($this->_foreach['myLoop']['iteration'] <= 1)): ?>first_item<?php elseif (($this->_foreach['myLoop']['iteration'] == $this->_foreach['myLoop']['total'])): ?>last_item<?php else: ?>item<?php endif; ?>" style="font-style:italic;margin:0 0 0 10px;">
			<a href="<?php echo $this->_tpl_vars['link']->getProductLink($this->_tpl_vars['product']['id_product'],$this->_tpl_vars['product']['link_rewrite']); ?>
" title="<?php echo smartyTranslate(array('s' => 'Product detail'), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['attributes_small'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a>
		</dd>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</dl>
<?php else: ?>
	<dl class="products" style="font-size:10px;border-bottom:1px solid #fff;">
	<?php if ($this->_tpl_vars['error']): ?>
		<dt><?php echo smartyTranslate(array('s' => 'You must create a wishlist before adding products','mod' => 'blockwishlist'), $this);?>
</dt>
	<?php else: ?>
		<dt><?php echo smartyTranslate(array('s' => 'No products','mod' => 'blockwishlist'), $this);?>
</dt>
	<?php endif; ?>
	</dl>
<?php endif; ?>