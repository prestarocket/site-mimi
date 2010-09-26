<?php /* Smarty version 2.6.20, created on 2010-09-21 18:21:39
         compiled from /srv/http/themes/prestashop/supplier-list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/srv/http/themes/prestashop/supplier-list.tpl', 1, false),array('modifier', 'escape', '/srv/http/themes/prestashop/supplier-list.tpl', 30, false),array('modifier', 'truncate', '/srv/http/themes/prestashop/supplier-list.tpl', 43, false),array('modifier', 'intval', '/srv/http/themes/prestashop/supplier-list.tpl', 65, false),)), $this); ?>
<?php ob_start(); ?><?php echo smartyTranslate(array('s' => 'Suppliers'), $this);?>
<?php $this->_smarty_vars['capture']['path'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo smartyTranslate(array('s' => 'Suppliers'), $this);?>
</h2>

<?php if (isset ( $this->_tpl_vars['errors'] ) && $this->_tpl_vars['errors']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>

	<p><?php echo '<span class="bold">'; ?><?php if ($this->_tpl_vars['nbSuppliers'] == 0): ?><?php echo ''; ?><?php echo smartyTranslate(array('s' => 'There are no suppliers.'), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['nbSuppliers'] == 1): ?><?php echo ''; ?><?php echo smartyTranslate(array('s' => 'There is'), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smartyTranslate(array('s' => 'There are'), $this);?><?php echo ''; ?><?php endif; ?><?php echo '&#160;'; ?><?php echo $this->_tpl_vars['nbSuppliers']; ?><?php echo '&#160;'; ?><?php if ($this->_tpl_vars['nbSuppliers'] == 1): ?><?php echo ''; ?><?php echo smartyTranslate(array('s' => 'supplier.'), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smartyTranslate(array('s' => 'suppliers.'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo '</span>'; ?>

	</p>

<?php if ($this->_tpl_vars['nbSuppliers'] > 0): ?>
	<ul id="suppliers_list">
	<?php $_from = $this->_tpl_vars['suppliers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['supplier']):
?>
		<li>
			<div class="left_side">

				<!-- logo -->
				<div class="logo">
				<?php if ($this->_tpl_vars['supplier']['nb_products'] > 0): ?>
				<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['link']->getsupplierLink($this->_tpl_vars['supplier']['id_supplier'],$this->_tpl_vars['supplier']['link_rewrite']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['supplier']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
">
				<?php endif; ?>
					<img src="<?php echo $this->_tpl_vars['img_sup_dir']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['supplier']['image'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
-medium.jpg" alt="" />
				<?php if ($this->_tpl_vars['supplier']['nb_products'] > 0): ?>
				</a>
				<?php endif; ?>
				</div>

				<!-- name -->
				<h3>
					<?php if ($this->_tpl_vars['supplier']['nb_products'] > 0): ?>
					<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['link']->getsupplierLink($this->_tpl_vars['supplier']['id_supplier'],$this->_tpl_vars['supplier']['link_rewrite']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
">
					<?php endif; ?>
					<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['supplier']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 60, '...') : smarty_modifier_truncate($_tmp, 60, '...')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>

					<?php if ($this->_tpl_vars['supplier']['nb_products'] > 0): ?>
					</a>
					<?php endif; ?>
				</h3>
				<p class="description">
				<?php if ($this->_tpl_vars['supplier']['nb_products'] > 0): ?>
					<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['link']->getsupplierLink($this->_tpl_vars['supplier']['id_supplier'],$this->_tpl_vars['supplier']['link_rewrite']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
">
				<?php endif; ?>
				<?php echo ((is_array($_tmp=$this->_tpl_vars['supplier']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>

				<?php if ($this->_tpl_vars['supplier']['nb_products'] > 0): ?>
				</a>
				<?php endif; ?>
				</p>

			</div>

			<div class="right_side">
			
			<?php if ($this->_tpl_vars['supplier']['nb_products'] > 0): ?>
				<a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['link']->getsupplierLink($this->_tpl_vars['supplier']['id_supplier'],$this->_tpl_vars['supplier']['link_rewrite']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
">
			<?php endif; ?>
				<span><?php echo ((is_array($_tmp=$this->_tpl_vars['supplier']['nb_products'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
 <?php if ($this->_tpl_vars['supplier']['nb_products'] == 1): ?><?php echo smartyTranslate(array('s' => 'product'), $this);?>
<?php else: ?><?php echo smartyTranslate(array('s' => 'products'), $this);?>
<?php endif; ?></span>
			<?php if ($this->_tpl_vars['supplier']['nb_products'] > 0): ?>
				</a>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['supplier']['nb_products'] > 0): ?>
				<a class="button" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['link']->getsupplierLink($this->_tpl_vars['supplier']['id_supplier'],$this->_tpl_vars['supplier']['link_rewrite']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"><?php echo smartyTranslate(array('s' => 'view products'), $this);?>
</a>
			<?php endif; ?>

			</div>
			<br class="clear"/>
		</li>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php endif; ?>