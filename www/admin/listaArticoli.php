<?php
include(dirname(__FILE__).'/../include/common.php');

$smarty->assign('categorie', categoria::listaAdmin());

if(!empty($_GET['id_categoria']))
{
	$smarty->assign('articoli', categoria::listaArticoli($_GET['id_categoria'], 50));
	$smarty->assign('categoriaSelezionata', $_GET['id_categoria']);
}

include(dirname(__FILE__).'/../include/endcode.php');

$smarty->display('admin/listaArticoli.tpl');
?>
