<?php /* Smarty version 2.6.20, created on 2011-03-19 14:46:17
         compiled from /homez.387/lilibio/www2/site/modules/productcomments//productcomments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '/homez.387/lilibio/www2/site/modules/productcomments//productcomments.tpl', 19, false),array('modifier', 'round', '/homez.387/lilibio/www2/site/modules/productcomments//productcomments.tpl', 24, false),array('modifier', 'escape', '/homez.387/lilibio/www2/site/modules/productcomments//productcomments.tpl', 30, false),array('modifier', 'truncate', '/homez.387/lilibio/www2/site/modules/productcomments//productcomments.tpl', 52, false),array('modifier', 'nl2br', '/homez.387/lilibio/www2/site/modules/productcomments//productcomments.tpl', 55, false),array('modifier', 'intval', '/homez.387/lilibio/www2/site/modules/productcomments//productcomments.tpl', 78, false),array('function', 'l', '/homez.387/lilibio/www2/site/modules/productcomments//productcomments.tpl', 20, false),array('function', 'dateFormat', '/homez.387/lilibio/www2/site/modules/productcomments//productcomments.tpl', 51, false),)), $this); ?>
<div id="idTab5">
<script type="text/javascript" src="<?php echo $this->_tpl_vars['module_dir']; ?>
js/jquery.rating.pack.js"></script>
<script type="text/javascript">
	$(function()<?php echo '{'; ?>
 $('input[@type=radio].star').rating(); <?php echo '}'; ?>
);
	$(function()<?php echo '{'; ?>

		$('.auto-submit-star').rating(<?php echo '{'; ?>

			callback: function(value, link)<?php echo '{'; ?>

			<?php echo '}'; ?>

		<?php echo '}'; ?>
);
	<?php echo '}'; ?>
);
	
	//close  comment form
	function closeCommentForm(){
		$('#sendComment').slideUp('fast');
		$('input#addCommentButton').fadeIn('slow');
	}
</script>
<?php if ($this->_tpl_vars['comments']): ?>
	<?php if (count($this->_tpl_vars['criterions']) > 0): ?>
		<h2><?php echo smartyTranslate(array('s' => 'Average grade','mod' => 'productcomments'), $this);?>
</h2>
		<div style="float: left">
			<?php echo smartyTranslate(array('s' => 'Average','mod' => 'productcomments'), $this);?>
:<br />
			<?php unset($this->_sections['average']);
$this->_sections['average']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['average']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['average']['start'] = (int)1;
$this->_sections['average']['name'] = 'average';
$this->_sections['average']['show'] = true;
$this->_sections['average']['max'] = $this->_sections['average']['loop'];
if ($this->_sections['average']['start'] < 0)
    $this->_sections['average']['start'] = max($this->_sections['average']['step'] > 0 ? 0 : -1, $this->_sections['average']['loop'] + $this->_sections['average']['start']);
else
    $this->_sections['average']['start'] = min($this->_sections['average']['start'], $this->_sections['average']['step'] > 0 ? $this->_sections['average']['loop'] : $this->_sections['average']['loop']-1);
if ($this->_sections['average']['show']) {
    $this->_sections['average']['total'] = min(ceil(($this->_sections['average']['step'] > 0 ? $this->_sections['average']['loop'] - $this->_sections['average']['start'] : $this->_sections['average']['start']+1)/abs($this->_sections['average']['step'])), $this->_sections['average']['max']);
    if ($this->_sections['average']['total'] == 0)
        $this->_sections['average']['show'] = false;
} else
    $this->_sections['average']['total'] = 0;
if ($this->_sections['average']['show']):

            for ($this->_sections['average']['index'] = $this->_sections['average']['start'], $this->_sections['average']['iteration'] = 1;
                 $this->_sections['average']['iteration'] <= $this->_sections['average']['total'];
                 $this->_sections['average']['index'] += $this->_sections['average']['step'], $this->_sections['average']['iteration']++):
$this->_sections['average']['rownum'] = $this->_sections['average']['iteration'];
$this->_sections['average']['index_prev'] = $this->_sections['average']['index'] - $this->_sections['average']['step'];
$this->_sections['average']['index_next'] = $this->_sections['average']['index'] + $this->_sections['average']['step'];
$this->_sections['average']['first']      = ($this->_sections['average']['iteration'] == 1);
$this->_sections['average']['last']       = ($this->_sections['average']['iteration'] == $this->_sections['average']['total']);
?>
				<input class="auto-submit-star" disabled="disabled" type="radio" name="average" <?php if (((is_array($_tmp=$this->_tpl_vars['averageTotal'])) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp)) != 0 && $this->_sections['average']['index'] == ((is_array($_tmp=$this->_tpl_vars['averageTotal'])) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp))): ?>checked="checked"<?php endif; ?> />
			<?php endfor; endif; ?>
		</div>
		<div style="float: left; margin-left: 40px; width: 400px">
		<?php $_from = $this->_tpl_vars['criterions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c']):
?>
			<div style="float: left; margin-left: 20px; margin-bottom: 10px;">
			<?php echo ((is_array($_tmp=$this->_tpl_vars['c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
<br />
			<?php unset($this->_sections['average']);
$this->_sections['average']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['average']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['average']['start'] = (int)1;
$this->_sections['average']['name'] = 'average';
$this->_sections['average']['show'] = true;
$this->_sections['average']['max'] = $this->_sections['average']['loop'];
if ($this->_sections['average']['start'] < 0)
    $this->_sections['average']['start'] = max($this->_sections['average']['step'] > 0 ? 0 : -1, $this->_sections['average']['loop'] + $this->_sections['average']['start']);
else
    $this->_sections['average']['start'] = min($this->_sections['average']['start'], $this->_sections['average']['step'] > 0 ? $this->_sections['average']['loop'] : $this->_sections['average']['loop']-1);
if ($this->_sections['average']['show']) {
    $this->_sections['average']['total'] = min(ceil(($this->_sections['average']['step'] > 0 ? $this->_sections['average']['loop'] - $this->_sections['average']['start'] : $this->_sections['average']['start']+1)/abs($this->_sections['average']['step'])), $this->_sections['average']['max']);
    if ($this->_sections['average']['total'] == 0)
        $this->_sections['average']['show'] = false;
} else
    $this->_sections['average']['total'] = 0;
if ($this->_sections['average']['show']):

            for ($this->_sections['average']['index'] = $this->_sections['average']['start'], $this->_sections['average']['iteration'] = 1;
                 $this->_sections['average']['iteration'] <= $this->_sections['average']['total'];
                 $this->_sections['average']['index'] += $this->_sections['average']['step'], $this->_sections['average']['iteration']++):
$this->_sections['average']['rownum'] = $this->_sections['average']['iteration'];
$this->_sections['average']['index_prev'] = $this->_sections['average']['index'] - $this->_sections['average']['step'];
$this->_sections['average']['index_next'] = $this->_sections['average']['index'] + $this->_sections['average']['step'];
$this->_sections['average']['first']      = ($this->_sections['average']['iteration'] == 1);
$this->_sections['average']['last']       = ($this->_sections['average']['iteration'] == $this->_sections['average']['total']);
?>
				<input class="auto-submit-star" disabled="disabled" type="radio" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['c']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
_<?php echo $this->_sections['average']['index']; ?>
" value="<?php echo $this->_sections['average']['index']; ?>
" <?php if (((is_array($_tmp=$this->_tpl_vars['averages'][$this->_tpl_vars['c']['id_product_comment_criterion']])) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp)) != 0 && $this->_sections['average']['index'] == ((is_array($_tmp=$this->_tpl_vars['averages'][$this->_tpl_vars['c']['id_product_comment_criterion']])) ? $this->_run_mod_handler('round', true, $_tmp) : round($_tmp))): ?>checked="checked"<?php endif; ?> />
			<?php endfor; endif; ?>
			</div>
		<?php endforeach; endif; unset($_from); ?>
		</div>
	<?php endif; ?>
	<div class="clear table_block">
		<table class="std" style="width: 100%">
			<thead>
				<tr>
					<th class="first_item" style="width:80px;"><?php echo smartyTranslate(array('s' => 'From','mod' => 'productcomments'), $this);?>
</th>
					<th class="item"><?php echo smartyTranslate(array('s' => 'Comment','mod' => 'productcomments'), $this);?>
</th>
				</tr>
			</thead>
			<tbody>
			<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['comment']):
?>
				<?php if ($this->_tpl_vars['comment']['content']): ?>
				<tr>
					<td style="vertical-align: top">
						<?php echo Tools::dateFormat(array('date' => ((is_array($_tmp=$this->_tpl_vars['comment']['date_add'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')),'full' => 0), $this);?>

						<?php echo ((is_array($_tmp=$this->_tpl_vars['comment']['firstname'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
 <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['comment']['lastname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 1, '...') : smarty_modifier_truncate($_tmp, 1, '...')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
.
					</td>
					<td style="vertical-align: top">
						<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['comment']['content'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

					</td>
				</tr>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<p class="align_center"><?php echo smartyTranslate(array('s' => 'No customer comments for the moment.','mod' => 'productcomments'), $this);?>
</p>
<?php endif; ?>
<?php if ($this->_tpl_vars['logged'] == true): ?>
<p class="align_center"><input style="margin:auto;" class="button_large" type="button" id="addCommentButton" value="<?php echo smartyTranslate(array('s' => 'Add a comment','mod' => 'productcomments'), $this);?>
" onclick="$('#sendComment').slideDown('slow');$(this).slideUp('slow');" /></p>
<form action="<?php echo $this->_tpl_vars['action_url']; ?>
" method="post" class="std" id="sendComment" style="display:none;">
	<fieldset>
		<p class="align_right"><a href="javascript:closeCommentForm()">X</a></p>
		<p class="bold"><?php echo smartyTranslate(array('s' => 'Add a comment','mod' => 'productcomments'), $this);?>
</p>
		<?php if (count($this->_tpl_vars['criterions']) > 0): ?>
		<table border="0" cellspacing="0" cellpadding="0">
		<?php unset($this->_sections['i']);
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['criterions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['start'] = (int)0;
$this->_sections['i']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
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
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>
				<input type="hidden" name="id_product_comment_criterion_<?php echo $this->_sections['i']['iteration']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['criterions'][$this->_sections['i']['index']]['id_product_comment_criterion'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" />
				<?php echo ((is_array($_tmp=$this->_tpl_vars['criterions'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>

			</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>
			<input class="star" type="radio" name="<?php echo $this->_sections['i']['iteration']; ?>
_grade" id="<?php echo $this->_sections['i']['iteration']; ?>
_grade" value="1" />
			<input class="star" type="radio" name="<?php echo $this->_sections['i']['iteration']; ?>
_grade" value="2" />
			<input class="star" type="radio" name="<?php echo $this->_sections['i']['iteration']; ?>
_grade" value="3" checked="checked" />
			<input class="star" type="radio" name="<?php echo $this->_sections['i']['iteration']; ?>
_grade" value="4" />
			<input class="star" type="radio" name="<?php echo $this->_sections['i']['iteration']; ?>
_grade" value="5" />
			</td>
		</tr>
		<?php endfor; endif; ?>
		</table>
		<?php endif; ?>
		<p><textarea cols="50" rows="5" name="content" id="content"></textarea></p>
		<p class="submit">
			<input class="button" name="submitMessage" value="<?php echo smartyTranslate(array('s' => 'Send','mod' => 'productcomments'), $this);?>
" type="submit" />
		</p>
	</fieldset>
</form>
<?php else: ?>
	<p class="align_center"><?php echo smartyTranslate(array('s' => 'Only registered users can post a new comment.','mod' => 'productcomments'), $this);?>
</p>
<?php endif; ?>
</div>