<?php /* Smarty version 2.6.20, created on 2011-06-07 20:00:46
         compiled from /homez.387/lilibio/www2/site2.1/modules/jbx_menu/menu_tree.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/homez.387/lilibio/www2/site2.1/modules/jbx_menu/menu_tree.tpl', 3, false),array('modifier', 'cat', '/homez.387/lilibio/www2/site2.1/modules/jbx_menu/menu_tree.tpl', 5, false),array('modifier', 'count', '/homez.387/lilibio/www2/site2.1/modules/jbx_menu/menu_tree.tpl', 20, false),)), $this); ?>
<?php if (! $this->_tpl_vars['item']['logged'] || ( $this->_tpl_vars['item']['logged'] && $this->_tpl_vars['menu']['logged'] )): ?>
<li <?php if (( $this->_tpl_vars['item']['type'] == $this->_tpl_vars['page_name'] && $this->_tpl_vars['item']['id'] == $this->_tpl_vars['menu']['id'] )): ?>class="sfHoverForce"<?php endif; ?><?php if ($this->_tpl_vars['item']['css']): ?> id="<?php echo $this->_tpl_vars['item']['css']; ?>
"<?php endif; ?>>
  <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"<?php if ($this->_tpl_vars['item']['new_window'] > 0): ?> target="_blank"<?php endif; ?>>
    <?php if ($this->_tpl_vars['menu']['icons']): ?>
      <?php if (file_exists ( ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['menu']['icons_path'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['item']['id_menu']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['item']['id_menu'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '.jpg') : smarty_modifier_cat($_tmp, '.jpg')) )): ?>
        <img src="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['menu']['icons_url'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['item']['id_menu']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['item']['id_menu'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '.jpg') : smarty_modifier_cat($_tmp, '.jpg')); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" />
        <?php $this->assign('haveIcon', '1'); ?>
      <?php endif; ?>
      <?php if (file_exists ( ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['menu']['icons_path'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['item']['id_menu']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['item']['id_menu'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '.gif') : smarty_modifier_cat($_tmp, '.gif')) )): ?>
        <img src="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['menu']['icons_url'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['item']['id_menu']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['item']['id_menu'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '.gif') : smarty_modifier_cat($_tmp, '.gif')); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" />
        <?php $this->assign('haveIcon', '1'); ?>
      <?php endif; ?>
      <?php if (file_exists ( ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['menu']['icons_path'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['item']['id_menu']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['item']['id_menu'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '.png') : smarty_modifier_cat($_tmp, '.png')) )): ?>
        <img src="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['menu']['icons_url'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['item']['id_menu']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['item']['id_menu'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '.png') : smarty_modifier_cat($_tmp, '.png')); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" />
        <?php $this->assign('haveIcon', '1'); ?>
      <?php endif; ?>
    <?php endif; ?>
    &nbsp;<?php if (isset ( $this->_tpl_vars['haveIcon'] )): ?><span><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php if (isset ( $this->_tpl_vars['haveIcon'] )): ?></span><?php endif; ?>
  </a>
  <?php if (count($this->_tpl_vars['item']['childrens']) > 0): ?>
  	<ul>
  	<?php $this->assign('childrens', $this->_tpl_vars['item']['childrens']); ?>
  	<?php $_from = $this->_tpl_vars['childrens']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menuTreeChildrens'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menuTreeChildrens']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['menuTreeChildrens']['iteration']++;
?>
  		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['menu_tpl_tree'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  	<?php endforeach; endif; unset($_from); ?>
  	</ul>
  <?php endif; ?>
</li>
<?php endif; ?>