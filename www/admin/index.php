<?php

include(dirname(__FILE__).'/../include/common.php');

include(dirname(__FILE__).'/../include/endcode.php');

print_r($_SERVER['REMOTE_ADDR']);

$smarty->display('admin/index.tpl');
?>
