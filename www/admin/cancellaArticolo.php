<?php
include(dirname(__FILE__).'/../include/common.php');

articolo::cancella($_GET['id']);

funzioni::creaSitemap();

include(dirname(__FILE__).'/../include/endcode.php');

header('Location: /admin/listaArticoli.php?id_categoria='.$_GET['id_categoria']);
?>
