<?php

include(dirname(__FILE__).'/include/common.php');

$categoria = new categoria($_GET['id']);

if(isset($_GET['pagina']))
{
	$pagina = $_GET['pagina'];
}
else
{
	$pagina = 1;
}

$smarty->assign('breadcrumbs', $categoria->breadcrumbs());

$categoria->paginata($pagina);
$categoria->calcolaPaginazione($pagina);
$categoria->generaLinkLingua($pagina);
$smarty->assign('categoria', $categoria);

include(dirname(__FILE__).'/include/endcode.php');

$smarty->display('categoria.tpl');
?>
