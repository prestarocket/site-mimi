<?php /* Smarty version 2.6.20, created on 2011-02-28 22:17:46
         compiled from /homez.387/lilibio/www/site/modules/productscategory/productscategory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www/site/modules/productscategory/productscategory.tpl', 5, false),array('function', 'math', '/homez.387/lilibio/www/site/modules/productscategory/productscategory.tpl', 11, false),array('modifier', 'count', '/homez.387/lilibio/www/site/modules/productscategory/productscategory.tpl', 11, false),array('modifier', 'htmlspecialchars', '/homez.387/lilibio/www/site/modules/productscategory/productscategory.tpl', 14, false),array('modifier', 'truncate', '/homez.387/lilibio/www/site/modules/productscategory/productscategory.tpl', 18, false),array('modifier', 'escape', '/homez.387/lilibio/www/site/modules/productscategory/productscategory.tpl', 18, false),)), $this); ?>
<?php if (count ( $this->_tpl_vars['categoryProducts'] ) > 0): ?>
<script type="text/javascript">var middle = <?php echo $this->_tpl_vars['middlePosition']; ?>
;</script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['content_dir']; ?>
modules/productscategory/js/productscategory.js"></script>
<ul class="idTabs">
	<li><a href="#idTab3"><?php echo smartyTranslate(array('s' => 'In the same category','mod' => 'productscategory'), $this);?>
</a></li>
</ul>

<div id="<?php if (count ( $this->_tpl_vars['categoryProducts'] ) > 5): ?>productscategory<?php else: ?>productscategory_noscroll<?php endif; ?>">
<?php if (count ( $this->_tpl_vars['categoryProducts'] ) > 5): ?><a id="productscategory_scroll_left" title="<?php echo smartyTranslate(array('s' => 'Previous','mod' => 'productscategory'), $this);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s' => 'Previous','mod' => 'productscategory'), $this);?>
</a><?php endif; ?>
<div id="productscategory_list">
	<ul <?php if (count ( $this->_tpl_vars['categoryProducts'] ) > 5): ?>style="width: <?php echo smarty_function_math(array('equation' => "width * nbImages",'width' => 107,'nbImages' => count($this->_tpl_vars['categoryProducts'])), $this);?>
px"<?php endif; ?>>
		<?php $_from = $this->_tpl_vars['categoryProducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['categoryProduct'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['categoryProduct']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['categoryProduct']):
        $this->_foreach['categoryProduct']['iteration']++;
?>
		<li <?php if (count ( $this->_tpl_vars['categoryProducts'] ) < 6): ?>style="width: <?php echo smarty_function_math(array('equation' => "width / nbImages",'width' => 94,'nbImages' => count($this->_tpl_vars['categoryProducts'])), $this);?>
%"<?php endif; ?>>
			<a href="<?php echo $this->_tpl_vars['link']->getProductLink($this->_tpl_vars['categoryProduct']['id_product'],$this->_tpl_vars['categoryProduct']['link_rewrite'],$this->_tpl_vars['categoryProduct']['category']); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['categoryProduct']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
">
				<img src="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['categoryProduct']['link_rewrite'],$this->_tpl_vars['categoryProduct']['id_image'],'medium'); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['categoryProduct']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" />
			</a><br/>
			<a href="<?php echo $this->_tpl_vars['link']->getProductLink($this->_tpl_vars['categoryProduct']['id_product'],$this->_tpl_vars['categoryProduct']['link_rewrite'],$this->_tpl_vars['categoryProduct']['category'],$this->_tpl_vars['categoryProduct']['ean13']); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['categoryProduct']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
">
			<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['categoryProduct']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 15, '...') : smarty_modifier_truncate($_tmp, 15, '...')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>

			</a>
		</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<?php if (count ( $this->_tpl_vars['categoryProducts'] ) > 5): ?><a id="productscategory_scroll_right" title="<?php echo smartyTranslate(array('s' => 'Next','mod' => 'productscategory'), $this);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s' => 'Next','mod' => 'productscategory'), $this);?>
</a><?php endif; ?>
</div>
<?php endif; ?>