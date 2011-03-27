<?php /* Smarty version 2.6.20, created on 2011-03-21 15:28:55
         compiled from /homez.387/lilibio/www2/site/themes/prestashop/404.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www2/site/themes/prestashop/404.tpl', 1, false),)), $this); ?>
<h2><?php echo smartyTranslate(array('s' => 'Page not available'), $this);?>
</h2>

<p class="error">
	<img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/error.gif" alt="<?php echo smartyTranslate(array('s' => 'Error'), $this);?>
" class="middle" />
	<?php echo smartyTranslate(array('s' => 'We\'re sorry, but the Web address you entered is no longer available'), $this);?>

</p>

<h3><?php echo smartyTranslate(array('s' => 'To find a product, please type its name in the field below'), $this);?>
</h3>

<form action="<?php echo $this->_tpl_vars['base_dir']; ?>
search.php" method="post" class="std">
	<fieldset>
		<p>
			<label for="search"><?php echo smartyTranslate(array('s' => 'Search our product catalog:'), $this);?>
</label>
			<input id="search_query" name="search_query" type="text" />
			<input type="submit" name="Submit" value="OK" class="button_small" />
		</p>
	</fieldset>
</form>

<p><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
" title="<?php echo smartyTranslate(array('s' => 'Home'), $this);?>
"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/home.gif" alt="<?php echo smartyTranslate(array('s' => 'Home'), $this);?>
" class="icon" /></a><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
" title="<?php echo smartyTranslate(array('s' => 'Home'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Home'), $this);?>
</a></p>