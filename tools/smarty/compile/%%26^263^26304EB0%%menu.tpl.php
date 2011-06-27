<?php /* Smarty version 2.6.20, created on 2011-05-07 09:38:25
         compiled from /homez.387/lilibio/www2/site2.0/modules/jbx_menu/menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '/homez.387/lilibio/www2/site2.0/modules/jbx_menu/menu.tpl', 1, false),)), $this); ?>
<?php if (count($this->_tpl_vars['menu']['items']) > 0): ?>
    <?php if ($this->_tpl_vars['menu']['hook'] == 'top'): ?></div><?php endif; ?>
    <!-- MODULE JBX_MENU -->
    <div class="sf-contener">
        <ul class="sf-menu">
          <?php $_from = $this->_tpl_vars['menu']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menuTree'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menuTree']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['menuTree']['iteration']++;
?>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['menu_tpl_tree'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          <?php endforeach; endif; unset($_from); ?>
          <?php if ($this->_tpl_vars['menu']['searchable_active']): ?>
          <li class="sf-search noBack" style="float:right">
              <form id="searchbox" action="search.php" method="get">
                  <input type="hidden" value="position" name="orderby" />
                  <input type="hidden" value="desc" name="orderway" />
                  <input type="text" name="search_query" id="search_query_menu" class="search" value="<?php if (isset ( $_GET['search_query'] )): ?><?php echo $_GET['search_query']; ?>
<?php endif; ?>" autocomplete="off" />
                  <?php if ($this->_tpl_vars['menu']['searchable_button']): ?>
                      <input type="submit" value="ok" class="search_button" />
                  <?php endif; ?>
              </form>
          </li>
          <?php endif; ?>
        </ul>
        <!-- /MODULE JBX_MENU -->
<?php endif; ?>
<?php if ($this->_tpl_vars['menu']['hook'] == 'menu' && count($this->_tpl_vars['menu']['items']) > 0): ?></div><?php endif; ?>