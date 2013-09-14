<?php

include(dirname(__FILE__).'/include/common.php');

$articolo = new articolo($_GET['id']);
$articolo->registraLettura();
$articolo->caricaFoto();
$articolo->caricaCommenti();

$smarty->assign('breadcrumbs', $articolo->breadcrumbs());

$smarty->assign('fratelli', $articolo->fratelli());

$smarty->assign('articolo', $articolo);

include(dirname(__FILE__).'/include/endcode.php');

$smarty->display('articolo.tpl');
?>
