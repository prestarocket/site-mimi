<?php /* Smarty version 2.6.20, created on 2011-02-25 14:10:59
         compiled from /homez.387/lilibio/www/site/modules/blockwishlist/blockwishlist-extra.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'intval', '/homez.387/lilibio/www/site/modules/blockwishlist/blockwishlist-extra.tpl', 1, false),array('function', 'l', '/homez.387/lilibio/www/site/modules/blockwishlist/blockwishlist-extra.tpl', 1, false),)), $this); ?>
<p class="buttons_bottom_block"><a href="javascript:;" class="button" onclick="javascript:WishlistCart('wishlist_block_list', 'add', '<?php echo ((is_array($_tmp=$this->_tpl_vars['id_product'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
', $('#idCombination').val(), document.getElementById('quantity_wanted').value);"><?php echo smartyTranslate(array('s' => 'Add to my wishlist','mod' => 'blockwishlist'), $this);?>
</a></p>