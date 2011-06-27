<?php /* Smarty version 2.6.20, created on 2011-05-09 11:43:49
         compiled from /homez.387/lilibio/www2/site2.0/themes/prestashop/password.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www2/site2.0/themes/prestashop/password.tpl', 1, false),array('modifier', 'escape', '/homez.387/lilibio/www2/site2.0/themes/prestashop/password.tpl', 9, false),array('modifier', 'stripslashes', '/homez.387/lilibio/www2/site2.0/themes/prestashop/password.tpl', 16, false),)), $this); ?>
<?php ob_start(); ?><?php echo smartyTranslate(array('s' => 'Forgot your password'), $this);?>
<?php $this->_smarty_vars['capture']['path'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo smartyTranslate(array('s' => 'Forgot your password'), $this);?>
</h2>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (isset ( $this->_tpl_vars['confirmation'] )): ?>
<p class="success"><?php echo smartyTranslate(array('s' => 'Your password has been successfully reset and has been sent to your e-mail address:'), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</p>
<?php else: ?>
<p><?php echo smartyTranslate(array('s' => 'Please enter your e-mail address used to register. We will e-mail you your new password.'), $this);?>
</p>
<form action="<?php echo ((is_array($_tmp=$this->_tpl_vars['request_uri'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" method="post" class="std">
	<fieldset>
		<p class="text">
			<label for="email"><?php echo smartyTranslate(array('s' => 'Type your e-mail address:'), $this);?>
</label>
			<input type="text" id="email" name="email" value="<?php if (isset ( $_POST['email'] )): ?><?php echo ((is_array($_tmp=((is_array($_tmp=$_POST['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')))) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
<?php endif; ?>" />
		</p>
		<p class="submit">
			<input type="submit" class="button" value="<?php echo smartyTranslate(array('s' => 'Retrieve'), $this);?>
" />
		</p>
	</fieldset>
</form>
<?php endif; ?>
<p class="clear">
	<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
authentication.php" title="<?php echo smartyTranslate(array('s' => 'Back to Login'), $this);?>
"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/my-account.gif" alt="<?php echo smartyTranslate(array('s' => 'Back to Login'), $this);?>
" class="icon" /></a><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
authentication.php" title="<?php echo smartyTranslate(array('s' => 'Back to Login'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Back to Login'), $this);?>
</a>
</p>