<?php /* Smarty version 2.6.20, created on 2011-03-23 01:41:30
         compiled from /homez.387/lilibio/www2/site/modules/sendtoafriend/sendtoafriend.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www2/site/modules/sendtoafriend/sendtoafriend.tpl', 1, false),array('modifier', 'escape', '/homez.387/lilibio/www2/site/modules/sendtoafriend/sendtoafriend.tpl', 23, false),array('modifier', 'stripslashes', '/homez.387/lilibio/www2/site/modules/sendtoafriend/sendtoafriend.tpl', 23, false),)), $this); ?>
<?php ob_start(); ?><?php echo smartyTranslate(array('s' => 'Send to a friend','mod' => 'sendtoafriend'), $this);?>
<?php $this->_smarty_vars['capture']['path'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo smartyTranslate(array('s' => 'Send to a friend','mod' => 'sendtoafriend'), $this);?>
</h2>

<p class="bold"><?php echo smartyTranslate(array('s' => 'Send this page to a friend who might be interested in the item below.','mod' => 'sendtoafriend'), $this);?>
.</p>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['confirm']): ?>
	<p class="success"><?php echo $this->_tpl_vars['confirm']; ?>
</p>
<?php else: ?>
	<form method="post" action="<?php echo $this->_tpl_vars['request_uri']; ?>
" class="std">
		<fieldset>
			<h3><?php echo smartyTranslate(array('s' => 'Send a message','mod' => 'sendtoafriend'), $this);?>
</h3>
		
			<p class="align_center">
				<a href="<?php echo $this->_tpl_vars['productLink']; ?>
"><img src="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['product']->link_rewrite,$this->_tpl_vars['cover']['id_image'],'small'); ?>
" alt="" title="<?php echo $this->_tpl_vars['cover']['legend']; ?>
" /></a><br/>
				<a href="<?php echo $this->_tpl_vars['productLink']; ?>
"><?php echo $this->_tpl_vars['product']->name; ?>
</a>
			</p>
			
			<p>
				<label for="friend-name"><?php echo smartyTranslate(array('s' => 'Friend\'s name:','mod' => 'sendtoafriend'), $this);?>
</label>
				<input type="text" id="friend-name" name="name" value="<?php if (isset ( $_POST['name'] )): ?><?php echo ((is_array($_tmp=((is_array($_tmp=$_POST['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')))) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
<?php endif; ?>" />
			</p>
			<p>
				<label for="friend-address"><?php echo smartyTranslate(array('s' => 'Friend\'s email:','mod' => 'sendtoafriend'), $this);?>
</label>
				<input type="text" id="friend-address" name="email" value="<?php if (isset ( $_POST['name'] )): ?><?php echo ((is_array($_tmp=((is_array($_tmp=$_POST['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')))) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
<?php endif; ?>" />
			</p>
			
			<p class="submit">
				<input type="submit" name="submitAddtoafriend" value="<?php echo smartyTranslate(array('s' => 'send','mod' => 'sendtoafriend'), $this);?>
" class="button" />
			</p>
		</fieldset>
	</form>
<?php endif; ?>

<ul class="footer_links">
	<li><a href="<?php echo $this->_tpl_vars['productLink']; ?>
" class="button_large"><?php echo smartyTranslate(array('s' => 'Back to','mod' => 'sendtoafriend'), $this);?>
 <?php echo $this->_tpl_vars['product']->name; ?>
</a></li>
</ul>