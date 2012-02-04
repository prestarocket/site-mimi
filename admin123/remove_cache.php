<?php


define('PS_ADMIN_DIR', getcwd());

include(PS_ADMIN_DIR.'/../config/config.inc.php');
include(PS_ADMIN_DIR.'/functions.php');
include(PS_ADMIN_DIR.'/toolbar.php');
include(PS_ADMIN_DIR.'/header.inc.php');


system ("rm -f ".dirname(__FILE__).'/../tools/smarty/cache/*tpl');
system ("rm -f ".dirname(__FILE__).'/../tools/smarty/compile/*');


echo "Cache removed !"


?>