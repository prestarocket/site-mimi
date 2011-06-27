<?php /* Smarty version 2.6.20, created on 2011-05-07 09:39:05
         compiled from /homez.387/lilibio/www2/site2.0/modules/crossselling/crossselling.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www2/site2.0/modules/crossselling/crossselling.tpl', 5, false),array('function', 'math', '/homez.387/lilibio/www2/site2.0/modules/crossselling/crossselling.tpl', 9, false),array('modifier', 'count', '/homez.387/lilibio/www2/site2.0/modules/crossselling/crossselling.tpl', 9, false),array('modifier', 'htmlspecialchars', '/homez.387/lilibio/www2/site2.0/modules/crossselling/crossselling.tpl', 12, false),array('modifier', 'truncate', '/homez.387/lilibio/www2/site2.0/modules/crossselling/crossselling.tpl', 16, false),array('modifier', 'escape', '/homez.387/lilibio/www2/site2.0/modules/crossselling/crossselling.tpl', 16, false),)), $this); ?>
<?php if (count ( $this->_tpl_vars['orderProducts'] ) > 0): ?>
<script type="text/javascript">var middle = <?php echo $this->_tpl_vars['middlePosition_crossselling']; ?>
;</script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['content_dir']; ?>
modules/crossselling/js/crossselling.js"></script>

<h2><?php echo smartyTranslate(array('s' => 'Customers who bought this product also bought:','mod' => 'crossselling'), $this);?>
</h2>
<div id="<?php if (count ( $this->_tpl_vars['orderProducts'] ) > 5): ?>crossselling<?php else: ?>crossselling_noscroll<?php endif; ?>">
<?php if (count ( $this->_tpl_vars['orderProducts'] ) > 5): ?><a id="crossselling_scroll_left" title="<?php echo smartyTranslate(array('s' => 'Previous','mod' => 'crossselling'), $this);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s' => 'Previous','mod' => 'crossselling'), $this);?>
</a><?php endif; ?>
<div id="crossselling_list">
	<ul <?php if (count ( $this->_tpl_vars['orderProducts'] ) > 5): ?>style="width: <?php echo smarty_function_math(array('equation' => "width * nbImages",'width' => 107,'nbImages' => count($this->_tpl_vars['orderProducts'])), $this);?>
px"<?php endif; ?>>
		<?php $_from = $this->_tpl_vars['orderProducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['orderProduct'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['orderProduct']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['orderProduct']):
        $this->_foreach['orderProduct']['iteration']++;
?>
		<li <?php if (count ( $this->_tpl_vars['orderProducts'] ) < 6): ?>style="width: <?php echo smarty_function_math(array('equation' => "width / nbImages",'width' => 94,'nbImages' => count($this->_tpl_vars['orderProducts'])), $this);?>
%"<?php endif; ?>>
			<a href="<?php echo $this->_tpl_vars['orderProduct']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['orderProduct']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
">
				<img src="<?php echo $this->_tpl_vars['orderProduct']['image']; ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['orderProduct']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" />
			</a><br/>
			<a href="<?php echo $this->_tpl_vars['orderProduct']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['orderProduct']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
">
			<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['orderProduct']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 15, '...') : smarty_modifier_truncate($_tmp, 15, '...')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>

			</a>
		</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<?php if (count ( $this->_tpl_vars['orderProducts'] ) > 5): ?><a id="crossselling_scroll_right" title="<?php echo smartyTranslate(array('s' => 'Next','mod' => 'crossselling'), $this);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s' => 'Next','mod' => 'crossselling'), $this);?>
</a><?php endif; ?>
</div>
<?php endif; ?>