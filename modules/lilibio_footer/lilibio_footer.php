<?php

if ( !defined( '_PS_VERSION_' ) )
  exit;

class lilibio_footer extends Module
{
	
  function __construct()
  {
    $this->name = 'lilibio_footer';
    $this->version = '1.0';
    $this->tab = 'Footer';

    parent::__construct();

    $this->displayName = $this->l('Footer for LiliBio');
    $this->description = $this->l('Homemade footer');
  }


  function install() {
    if (parent::install() == false OR $this->registerHook('footer')) {
      return false;
    }
    return true;
  }

  public function uninstall() {
    return parent::uninstall();
  }

  public function hookFooter($params) {
    global $smarty;
    $smarty->caching = false;
    $result = $this->display(__FILE__, 'lilibio_footer.tpl');
    return $result;
  }

}