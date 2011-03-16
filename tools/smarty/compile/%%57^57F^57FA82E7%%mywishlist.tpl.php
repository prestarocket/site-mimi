<?php /* Smarty version 2.6.20, created on 2011-02-25 14:11:30
         compiled from /homez.387/lilibio/www/site/modules/blockwishlist/mywishlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homez.387/lilibio/www/site/modules/blockwishlist/mywishlist.tpl', 8, false),array('modifier', 'intval', '/homez.387/lilibio/www/site/modules/blockwishlist/mywishlist.tpl', 15, false),array('modifier', 'escape', '/homez.387/lilibio/www/site/modules/blockwishlist/mywishlist.tpl', 19, false),array('modifier', 'count', '/homez.387/lilibio/www/site/modules/blockwishlist/mywishlist.tpl', 21, false),array('modifier', 'truncate', '/homez.387/lilibio/www/site/modules/blockwishlist/mywishlist.tpl', 41, false),array('modifier', 'date_format', '/homez.387/lilibio/www/site/modules/blockwishlist/mywishlist.tpl', 56, false),)), $this); ?>
<script type="text/javascript">
<!--
	var baseDir = '<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
';
-->
</script>

<div id="mywishlist">
	<?php ob_start(); ?><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
my-account.php"><?php echo smartyTranslate(array('s' => 'My account','mod' => 'blockwishlist'), $this);?>
</a><span class="navigation-pipe"><?php echo $this->_tpl_vars['navigationPipe']; ?>
</span><?php echo smartyTranslate(array('s' => 'My wishlists','mod' => 'blockwishlist'), $this);?>
<?php $this->_smarty_vars['capture']['path'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<h2><?php echo smartyTranslate(array('s' => 'My wishlists','mod' => 'blockwishlist'), $this);?>
</h2>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php if (((is_array($_tmp=$this->_tpl_vars['id_customer'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)) != 0): ?>
		<form action="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
modules/blockwishlist/mywishlist.php" method="post" class="std">
			<fieldset>
				<h3><?php echo smartyTranslate(array('s' => 'New wishlist','mod' => 'blockwishlist'), $this);?>
</h3>
				<input type="hidden" name="token" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['token'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" />
				<label class="align_right" for="name"><?php echo smartyTranslate(array('s' => 'Name','mod' => 'blockwishlist'), $this);?>
</label>
				<input type="text" id="name" name="name" value="<?php if (isset ( $_POST['name'] ) && count($this->_tpl_vars['errors']) > 0): ?><?php echo ((is_array($_tmp=$_POST['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
<?php endif; ?>" />
				<input type="submit" name="submitWishlist" id="submitWishlist" value="<?php echo smartyTranslate(array('s' => 'Save','mod' => 'blockwishlist'), $this);?>
" class="exclusive" />
			</fieldset>
		</form>
		<?php if ($this->_tpl_vars['wishlists']): ?>
		<div id="block-history" class="block-center">
			<table class="std">
				<thead>
					<tr>
						<th class="first_item"><?php echo smartyTranslate(array('s' => 'Name','mod' => 'blockwishlist'), $this);?>
</th>
						<th class="item mywishlist_first"><?php echo smartyTranslate(array('s' => 'Qty','mod' => 'blockwishlist'), $this);?>
</th>
						<th class="item mywishlist_first"><?php echo smartyTranslate(array('s' => 'Viewed','mod' => 'blockwishlist'), $this);?>
</th>
						<th class="item mywishlist_second"><?php echo smartyTranslate(array('s' => 'Created','mod' => 'blockwishlist'), $this);?>
</th>
						<th class="item mywishlist_second"><?php echo smartyTranslate(array('s' => 'Direct Link','mod' => 'blockwishlist'), $this);?>
</th>
						<th class="last_item mywishlist_first"><?php echo smartyTranslate(array('s' => 'Delete','mod' => 'blockwishlist'), $this);?>
</th>
					</tr>
				</thead>
				<tbody>
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['wishlists']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
					<tr id="wishlist_<?php echo ((is_array($_tmp=$this->_tpl_vars['wishlists'][$this->_sections['i']['index']]['id_wishlist'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
">
						<td class="bold" style="width:200px;"><a href="javascript:;" onclick="javascript:WishlistManage('block-order-detail', '<?php echo ((is_array($_tmp=$this->_tpl_vars['wishlists'][$this->_sections['i']['index']]['id_wishlist'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
');"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['wishlists'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, '...') : smarty_modifier_truncate($_tmp, 30, '...')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a></td>
						<td class="bold align_center">
						<?php $this->assign('n', 0); ?>
						<?php $_from = $this->_tpl_vars['nbProducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['nb']):
        $this->_foreach['i']['iteration']++;
?>
							<?php if ($this->_tpl_vars['nb']['id_wishlist'] == $this->_tpl_vars['wishlists'][$this->_sections['i']['index']]['id_wishlist']): ?>
								<?php $this->assign('n', ((is_array($_tmp=$this->_tpl_vars['nb']['nbProducts'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp))); ?>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
						<?php if ($this->_tpl_vars['n']): ?>
							<?php echo ((is_array($_tmp=$this->_tpl_vars['n'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>

						<?php else: ?>
							0
						<?php endif; ?>
						</td>
						<td class="align_center"><?php echo ((is_array($_tmp=$this->_tpl_vars['wishlists'][$this->_sections['i']['index']]['counter'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
</td>
						<td class="align_center"><?php echo ((is_array($_tmp=$this->_tpl_vars['wishlists'][$this->_sections['i']['index']]['date_add'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</td>
						<td class="align_center"><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
modules/blockwishlist/view.php?token=<?php echo ((is_array($_tmp=$this->_tpl_vars['wishlists'][$this->_sections['i']['index']]['token'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"><?php echo smartyTranslate(array('s' => 'View','mod' => 'blockwishlist'), $this);?>
</a></td>
						<td class="align_center">
							<a href="javascript:;"onclick="return (WishlistDelete('wishlist_<?php echo ((is_array($_tmp=$this->_tpl_vars['wishlists'][$this->_sections['i']['index']]['id_wishlist'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['wishlists'][$this->_sections['i']['index']]['id_wishlist'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
', '<?php echo smartyTranslate(array('s' => 'Do you really want to delete this wishlist ?','mod' => 'blockwishlist'), $this);?>
'));"><img src="<?php echo $this->_tpl_vars['content_dir']; ?>
modules/blockwishlist/img/icon/delete.png" alt="<?php echo smartyTranslate(array('s' => 'Delete','mod' => 'blockwishlist'), $this);?>
" /></a>
						</td>
					</tr>
				<?php endfor; endif; ?>
				</tbody>
			</table>
		</div>
		<div id="block-order-detail">&nbsp;</div>
		<?php endif; ?>
	<?php endif; ?>

	<ul class="footer_links">
		<li><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
my-account.php"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/my-account.gif" alt="" class="icon" /></a><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
my-account.php"><?php echo smartyTranslate(array('s' => 'Back to Your Account','mod' => 'blockwishlist'), $this);?>
</a></li>
		<li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/home.gif" alt="" class="icon" /></a><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
"><?php echo smartyTranslate(array('s' => 'Home','mod' => 'blockwishlist'), $this);?>
</a></li>
	</ul>
</div>