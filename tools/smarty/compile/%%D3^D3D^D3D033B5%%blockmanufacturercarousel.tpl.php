<?php /* Smarty version 2.6.20, created on 2011-05-07 09:38:25
         compiled from /homez.387/lilibio/www2/site2.0/modules/blockmanufacturercarousel/blockmanufacturercarousel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www2/site2.0/modules/blockmanufacturercarousel/blockmanufacturercarousel.tpl', 18, false),array('modifier', 'count', '/homez.387/lilibio/www2/site2.0/modules/blockmanufacturercarousel/blockmanufacturercarousel.tpl', 20, false),array('modifier', 'escape', '/homez.387/lilibio/www2/site2.0/modules/blockmanufacturercarousel/blockmanufacturercarousel.tpl', 27, false),)), $this); ?>
<!-- MODULE Block Manufacturers -->
<?php echo '
<style type="text/css">
#manufacturer_slider ul, #manufacturer_slider li{
	margin:0;
	padding:0;
	list-style:none;
	}
#manufacturer_slider, #manufacturer_slider li{
	width:174px;
	height:80px;
	overflow:hidden;
	}
</style>
<script src="'; ?>
<?php echo $this->_tpl_vars['content_dir']; ?>
<?php echo 'modules/blockmanufacturercarousel/js/olcSlider.js" type="text/javascript"></script>
'; ?>

<div id="special_block_right" class="block products_block exclusive blockspecials">
	<h4><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
manufacturer.php" title="<?php echo smartyTranslate(array('s' => 'Manufacturers','mod' => 'blockmanufacturercarousel'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Manufacturers','mod' => 'blockmanufacturercarousel'), $this);?>
</a></h4>
	<div class="block_content">
<?php if (count($this->_tpl_vars['manufacturers']) > 0): ?>
        <div  id="manufacturer_slider">
        <ul style="">
            <?php $_from = $this->_tpl_vars['manufacturers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['manufacturer_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['manufacturer_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['manufacturer']):
        $this->_foreach['manufacturer_list']['iteration']++;
?>
		<?php if ($this->_tpl_vars['manufacturer']['nb_products'] > 0): ?>
		<li style="padding: 3px 0px 3px 0px;">
                    <table border="0" cellspacing="0" cellpadding="0"><tr><td><a href="<?php echo $this->_tpl_vars['link']->getmanufacturerLink($this->_tpl_vars['manufacturer']['id_manufacturer'],$this->_tpl_vars['manufacturer']['link_rewrite']); ?>
" title="<?php echo smartyTranslate(array('s' => 'More about','mod' => 'blockmanufacturer'), $this);?>
 <?php echo $this->_tpl_vars['manufacturer']['name']; ?>
">
                    <img src="<?php echo $this->_tpl_vars['img_manu_dir']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['manufacturer']['id_manufacturer'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
-medium.jpg" alt="" /></a></td>
                    <td valign="center"><h3><a href="<?php echo $this->_tpl_vars['link']->getmanufacturerLink($this->_tpl_vars['manufacturer']['id_manufacturer'],$this->_tpl_vars['manufacturer']['link_rewrite']); ?>
" title="<?php echo smartyTranslate(array('s' => 'More about','mod' => 'blockmanufacturer'), $this);?>
 <?php echo $this->_tpl_vars['manufacturer']['name']; ?>
"><?php echo $this->_tpl_vars['manufacturer']['name']; ?>
</a></h3></td></tr></table></li>
		<?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        </div>
        <p>
            <a href="<?php echo $this->_tpl_vars['base_dir']; ?>
manufacturer.php" title="<?php echo smartyTranslate(array('s' => 'All Manufacturers','mod' => 'blockmanufacturercarousel'), $this);?>
" class="button"><?php echo smartyTranslate(array('s' => 'All Manufacturers','mod' => 'blockmanufacturercarousel'), $this);?>
</a>
    </p>
<?php else: ?>
		<p><?php echo smartyTranslate(array('s' => 'No manufacturer at this time','mod' => 'blockmanufacturercarousel'), $this);?>
</p>
<?php endif; ?>
	</div>
</div>

<?php echo '
<script type="text/javascript">
$(document).ready(function(){
   var manufacturer_slider = new olcSlider({
            speed: '; ?>
<?php echo $this->_tpl_vars['timeEffet']; ?>
<?php echo ',
            duration: '; ?>
<?php echo $this->_tpl_vars['timeTrans']; ?>
<?php echo '});
     manufacturer_slider.init("manufacturer_slider");
});
</script>
'; ?>

<!-- /MODULE Block Manufacturers -->