<?php
session_start();

include(dirname(__FILE__).'/../class/articolo.php');
include(dirname(__FILE__).'/../class/categoria.php');
include(dirname(__FILE__).'/../class/database.php');
include(dirname(__FILE__).'/../class/esterni.php');
include(dirname(__FILE__).'/../class/foto.php');
include(dirname(__FILE__).'/../class/funzioni.php');
include(dirname(__FILE__).'/../class/impostazioni.php');
include(dirname(__FILE__).'/../class/mese.php');
include(dirname(__FILE__).'/../smarty/Smarty.class.php');

date_default_timezone_set(funzioni::scegliTermine('Europe/London', 'Europe/Rome'));

$message = array();

database::open();

if(isset($_GET['lingua']))
{
	funzioni::impostaLingua($_GET['lingua']);
}

$smarty = new Smarty;
$smarty->template_dir = dirname(__FILE__).'/../template';
$smarty->compile_dir = dirname(__FILE__).'/../template_c';

$smarty->assign('locale', funzioni::caricaTesto());

$smarty->assign('tfl', esterni::tfl());
$smarty->assign('weather', esterni::weather());

$smarty->assign('categorie', categoria::listaCategorie());

$smarty->assign('languageLink', funzioni::linkLingua());

?>