<?php /* Smarty version 2.6.20, created on 2011-05-07 09:38:26
         compiled from /homez.387/lilibio/www2/site2.0/modules/blockspecialscarousel/blockspecialscarousel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www2/site2.0/modules/blockspecialscarousel/blockspecialscarousel.tpl', 18, false),array('function', 'displayWtPrice', '/homez.387/lilibio/www2/site2.0/modules/blockspecialscarousel/blockspecialscarousel.tpl', 27, false),array('modifier', 'count', '/homez.387/lilibio/www2/site2.0/modules/blockspecialscarousel/blockspecialscarousel.tpl', 20, false),array('modifier', 'escape', '/homez.387/lilibio/www2/site2.0/modules/blockspecialscarousel/blockspecialscarousel.tpl', 25, false),array('modifier', 'truncate', '/homez.387/lilibio/www2/site2.0/modules/blockspecialscarousel/blockspecialscarousel.tpl', 26, false),)), $this); ?>
<!-- MODULE Block specials -->
<?php echo '
<style type="text/css">
#special_slider ul, #special_slider li{
	margin:0;
	padding:0;
	list-style:none;
	}
#special_slider, #special_slider li{
	width:174px;
	height:80px;
	overflow:hidden;
	}
</style>
<script src="modules/blockspecialscarousel/js/olcSlider.js" type="text/javascript"></script>
'; ?>

<div id="special_block_right" class="block products_block exclusive blockspecials">
	<h4><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
prices-drop.php" title="<?php echo smartyTranslate(array('s' => 'Specials','mod' => 'blockspecialscarousel'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Specials','mod' => 'blockspecialscarousel'), $this);?>
</a></h4>
	<div class="block_content">
<?php if (count($this->_tpl_vars['products']) > 0): ?>
		<div  id="special_slider">
    	<ul style="">
		<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['products'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['products']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['products']['iteration']++;
?>
		<li style="padding: 3px 0px 3px 0px;">
                    <a style="float:left" href="<?php echo $this->_tpl_vars['product']['link']; ?>
"><img src="<?php echo $this->_tpl_vars['img_prod_dir']; ?>
<?php echo $this->_tpl_vars['product']['id_image']; ?>
-medium.jpg" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['legend'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" /></a>
                    <div><h5><a href="<?php echo $this->_tpl_vars['product']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 35) : smarty_modifier_truncate($_tmp, 35)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a></h5>
                    <span class="price-discount"><?php echo Product::displayWtPrice(array('p' => $this->_tpl_vars['product']['price_without_reduction']), $this);?>
</span>
                    <?php if ($this->_tpl_vars['product']['reduction_percent']): ?><span class="reduction">(-<?php echo $this->_tpl_vars['product']['reduction_percent']; ?>
%)</span><?php endif; ?>
                    <span class="price"><?php echo Product::displayWtPrice(array('p' => $this->_tpl_vars['product']['price']), $this);?>
</span></div>
                </li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
        </div>
		<p>
			<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
prices-drop.php" title="<?php echo smartyTranslate(array('s' => 'All specials','mod' => 'blockspecialscarousel'), $this);?>
" class="button"><?php echo smartyTranslate(array('s' => 'All specials','mod' => 'blockspecialscarousel'), $this);?>
</a>
		</p>
<?php else: ?>
		<p><?php echo smartyTranslate(array('s' => 'No specials at this time','mod' => 'blockspecialscarousel'), $this);?>
</p>
<?php endif; ?>
	</div>
</div>

<?php echo '
<script type="text/javascript">
$(document).ready(function(){
	$("#special_slider").olcSlider({
            speed: '; ?>
<?php echo $this->_tpl_vars['timeEffet']; ?>
<?php echo ',
            duration: '; ?>
<?php echo $this->_tpl_vars['timeTrans']; ?>
<?php echo '});
});
</script>
'; ?>

<!-- /MODULE Block specials -->