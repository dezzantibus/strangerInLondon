<?php

include(dirname(__FILE__).'/include/common.php');

$smarty->assign('breadcrumbs', array(funzioni::homeBreadCrumbs()));

$smarty->assign('articles', articolo::articoliHome());

$smarty->assign('linkLingua', funzioni::scegliTermine('/italiano/', '/english/'));

include(dirname(__FILE__).'/include/endcode.php');

$smarty->display('index.tpl');
?>
