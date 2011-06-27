<?php /* Smarty version 2.6.20, created on 2011-05-07 09:38:25
         compiled from /homez.387/lilibio/www2/site2.0/modules/jbx_menu/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'substr', '/homez.387/lilibio/www2/site2.0/modules/jbx_menu/header.tpl', 16, false),)), $this); ?>

        <!-- MODULE JBX_MENU -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['menu']['path']; ?>
css/superfish-modified.css" media="screen" />
<!--        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['menu']['path']; ?>
cache/menu.css" media="screen" />  -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['content_dir']; ?>
css/jquery.autocomplete.css" />
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['menu']['path']; ?>
js/hoverIntent.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['menu']['path']; ?>
js/superfish-modified.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['content_dir']; ?>
js/jquery/jquery.autocomplete.js"></script>
<?php if ($this->_tpl_vars['menu']['searchable_autocomplete']): ?>
        <script type="text/javascript">
        //<![CDATA[
        var menu_path = '<?php echo $this->_tpl_vars['menu']['path']; ?>
';
        var id_lang = '<?php echo $this->_tpl_vars['menu']['id_lang']; ?>
';
        //]]>
        </script>
        <?php if (((is_array($_tmp=@_PS_VERSION_)) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 3) : substr($_tmp, 0, 3)) == '1.3'): ?>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['menu']['path']; ?>
js/search.js"></script>
		<?php elseif (((is_array($_tmp=@_PS_VERSION_)) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 3) : substr($_tmp, 0, 3)) == '1.4'): ?>
		<script type="text/javascript">
		//<!--
		<?php echo '
		$(\'document\').ready( function() {
			$("#search_query_menu")
				.autocomplete(
					\''; ?>
<?php if ($this->_tpl_vars['menu']['search_ssl'] == 1): ?><?php echo $this->_tpl_vars['link']->getPageLink('search.php',true); ?>
<?php else: ?><?php echo $this->_tpl_vars['link']->getPageLink('search.php'); ?>
<?php endif; ?><?php echo '\', {
						minChars: 3,
						max: 10,
						width: 500,
						selectFirst: false,
						scroll: false,
						dataType: "json",
						formatItem: function(data, i, max, value, term) {
							return value;
						},
						parse: function(data) {
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = { data: data[i], value: data[i].cname + \' > \' + data[i].pname };
							return mytab;
						},
						extraParams: {
							ajaxSearch: 1,
							id_lang: 2
						}
					}
				)
				.result(function(event, data, formatted) {
					$(\'#search_query_menu\').val(data.pname);
					document.location.href = data.product_link;
				})
		});
		'; ?>

		//-->
		</script>
		<?php endif; ?>
<?php endif; ?>
        <!-- /MODULE JBX_MENU -->