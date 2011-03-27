<?php /* Smarty version 2.6.20, created on 2011-03-19 14:46:41
         compiled from /homez.387/lilibio/www2/site/modules/spplus/spplus_single.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www2/site/modules/spplus/spplus_single.tpl', 19, false),)), $this); ?>
<script type="text/javascript">
<!--
   self.name = "sitecom";

   function Ouvrir_Spplus()
   <?php echo '{'; ?>

   	var PopupSpplus_largeur	= 750;
   	var PopupSpplus_hauteur	= 560;

  	var PopupSpplus_top	=((screen.height-PopupSpplus_hauteur)/2);
   	var PopupSpplus_left	=((screen.width-PopupSpplus_largeur)/2);

   	var win = window.open('', "SPPLUS","status=yes,top="+PopupSpplus_top+",left="+PopupSpplus_left+",width="+PopupSpplus_largeur+",height="+PopupSpplus_hauteur);
   	win.focus();
   <?php echo '}'; ?>

// -->
</script>
<p class="payment_module">
	<a target="SPPLUS" onclick="Ouvrir_Spplus();" href="<?php echo $this->_tpl_vars['url_calculhmac']; ?>
" target="_blank" title="<?php echo smartyTranslate(array('s' => 'Régler en ligne avec la solution sécurisée SPPLUS - Pay with SPPLUS','mod' => 'spplus'), $this);?>
" style="cursor: pointer;">
		<img src="<?php echo $this->_tpl_vars['module_template_dir']; ?>
spplus.gif" alt="<?php echo smartyTranslate(array('s' => 'Régler en ligne avec la solution sécurisée SPPLUS - Pay with SPPLUS','mod' => 'spplus'), $this);?>
" />
		<?php echo smartyTranslate(array('s' => 'Régler en ligne avec la solution sécurisée SPPLUS - Pay with SPPLUS','mod' => 'spplus'), $this);?>

	</a>
</p>