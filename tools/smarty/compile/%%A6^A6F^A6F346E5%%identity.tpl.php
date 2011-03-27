<?php /* Smarty version 2.6.20, created on 2011-03-19 15:26:50
         compiled from /homez.387/lilibio/www2/site/themes/prestashop/identity.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www2/site/themes/prestashop/identity.tpl', 7, false),array('modifier', 'escape', '/homez.387/lilibio/www2/site/themes/prestashop/identity.tpl', 17, false),)), $this); ?>
<script type="text/javascript">
<!--
	var baseDir = '<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
';
-->
</script>

<?php ob_start(); ?><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
my-account.php"><?php echo smartyTranslate(array('s' => 'My account'), $this);?>
</a><span class="navigation-pipe"><?php echo $this->_tpl_vars['navigationPipe']; ?>
</span><?php echo smartyTranslate(array('s' => 'Your personal information'), $this);?>
<?php $this->_smarty_vars['capture']['path'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2><?php echo smartyTranslate(array('s' => 'Your personal information'), $this);?>
</h2>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['confirmation']): ?>
	<p class="success">
		<?php echo smartyTranslate(array('s' => 'Your personal information has been successfully updated.'), $this);?>

		<?php if ($this->_tpl_vars['pwd_changed']): ?><br /><?php echo smartyTranslate(array('s' => 'Your password has been sent to your e-mail:'), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['email'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php endif; ?>
	</p>
<?php else: ?>
	<h3><?php echo smartyTranslate(array('s' => 'Do not hesitate to update your personal information if it has changed.'), $this);?>
</h3>
	<p class="required"><sup>*</sup><?php echo smartyTranslate(array('s' => 'Required field'), $this);?>
</p>
	<form action="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
identity.php" method="post" class="std">
		<fieldset>
			<p class="radio">
				<span><?php echo smartyTranslate(array('s' => 'Gender'), $this);?>
</span>
				<input type="radio" id="id_gender1" name="id_gender" value="1" <?php if ($_POST['id_gender'] == 1 || ! $_POST['id_gender']): ?>checked="checked"<?php endif; ?> />
				<label for="id_gender1"><?php echo smartyTranslate(array('s' => 'Mr.'), $this);?>
</label>
				<input type="radio" id="id_gender2" name="id_gender" value="2" <?php if ($_POST['id_gender'] == 2): ?>checked="checked"<?php endif; ?> />
				<label for="id_gender2"><?php echo smartyTranslate(array('s' => 'Ms.'), $this);?>
</label>
			</p>
			<p class="required text">
				<label for="firstname"><?php echo smartyTranslate(array('s' => 'First name'), $this);?>
<sup>*</sup></label>
				<input type="text" id="firstname" name="firstname" value="<?php echo $_POST['firstname']; ?>
" />
			</p>
			<p class="required text">
				<label for="lastname"><?php echo smartyTranslate(array('s' => 'Last name'), $this);?>
<sup>*</sup></label>
				<input type="text" name="lastname" id="lastname" value="<?php echo $_POST['lastname']; ?>
" />
			</p>
			<p class="required text">
				<label for="email"><?php echo smartyTranslate(array('s' => 'E-mail'), $this);?>
<sup>*</sup></label>
				<input type="text" name="email" id="email" value="<?php echo $_POST['email']; ?>
" />
			</p>
			<p class="required text">
				<label for="old_passwd"><?php echo smartyTranslate(array('s' => 'Current password'), $this);?>
<sup>*</sup></label>
				<input type="password" name="old_passwd" id="old_passwd" />
			</p>
			<p class="password">
				<label for="passwd"><?php echo smartyTranslate(array('s' => 'Password'), $this);?>
</label>
				<input type="password" name="passwd" id="passwd" />
			</p>
			<p class="password">
				<label for="confirmation"><?php echo smartyTranslate(array('s' => 'Confirmation'), $this);?>
</label>
				<input type="password" name="confirmation" id="confirmation" />
			</p>
			<p class="select">
				<label><?php echo smartyTranslate(array('s' => 'Birthday'), $this);?>
</label>
				<select name="days" id="days">
					<option value="">-</option>
					<?php $_from = $this->_tpl_vars['days']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
						<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['v'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" <?php if (( $this->_tpl_vars['sl_day'] == $this->_tpl_vars['v'] )): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['v'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
&nbsp;&nbsp;</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
								<select id="months" name="months">
					<option value="">-</option>
					<?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
						<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" <?php if (( $this->_tpl_vars['sl_month'] == $this->_tpl_vars['k'] )): ?>selected="selected"<?php endif; ?>><?php echo smartyTranslate(array('s' => ($this->_tpl_vars['v'])), $this);?>
&nbsp;</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<select id="years" name="years">
					<option value="">-</option>
					<?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
						<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['v'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" <?php if (( $this->_tpl_vars['sl_year'] == $this->_tpl_vars['v'] )): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['v'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
&nbsp;&nbsp;</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</p>
			<?php if ($this->_tpl_vars['need_identification_number']): ?>
			<p class="required text">
				<label for="dni"><?php echo smartyTranslate(array('s' => 'Identication number'), $this);?>
</label>
				<input type="text" class="text" name="dni" id="dni" value="<?php if (isset ( $_POST['dni'] )): ?><?php echo $_POST['dni']; ?>
<?php endif; ?>" />
				<span class="form_info"><?php echo smartyTranslate(array('s' => 'DNI / NIF / NIE'), $this);?>
</span>
			</p>
			<?php endif; ?>
			<p class="checkbox">
				<input type="checkbox" id="newsletter" name="newsletter" value="1" <?php if ($_POST['newsletter'] == 1): ?> checked="checked"<?php endif; ?> />
				<label for="newsletter"><?php echo smartyTranslate(array('s' => 'Sign up for our newsletter'), $this);?>
</label>
			</p>
			<p class="checkbox">
				<input type="checkbox" name="optin" id="optin" value="1" <?php if ($_POST['optin'] == 1): ?> checked="checked"<?php endif; ?> />
				<label for="optin"><?php echo smartyTranslate(array('s' => 'Receive special offers from our partners'), $this);?>
</label>
			</p>
			<p class="submit">
				<input type="submit" class="button" name="submitIdentity" value="<?php echo smartyTranslate(array('s' => 'Save'), $this);?>
" />
			</p>
		</fieldset>
	</form>
	<p id="security_informations">
		<?php echo smartyTranslate(array('s' => '[Insert customer data privacy clause or law here, if applicable]'), $this);?>

	</p>
<?php endif; ?>

<ul class="footer_links">
	<li><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
my-account.php"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/my-account.gif" alt="" class="icon" /></a><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
my-account.php"><?php echo smartyTranslate(array('s' => 'Back to Your Account'), $this);?>
</a></li>
	<li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/home.gif" alt="" class="icon" /></a><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
"><?php echo smartyTranslate(array('s' => 'Home'), $this);?>
</a></li>
</ul>