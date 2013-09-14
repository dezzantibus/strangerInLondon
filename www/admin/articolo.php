<?php

include(dirname(__FILE__).'/../include/common.php');

switch($_GET['act'])
{
	case 'edit':
		$sql = "
			SELECT *
			FROM articolo
			WHERE id = {$_GET['id']}
		";
		$smarty->assign('articolo', database::getRecord($sql));
		break;
	case 'new':
		$smarty->assign('articolo', array());
		break;
	case 'salva':
		$sql = "
			INSERT INTO articolo
			SET id				= {$_POST['id']},
				id_categoria	= {$_POST['id_categoria']},
				titolo_en		= '{$_POST['titolo_en']}',
				titolo_it		= '{$_POST['titolo_it']}',
				testo_en		= '{$_POST['testo_en']}',
				testo_it		= '{$_POST['testo_it']}',
				keywords_en		= '{$_POST['keywords_en']}',
				keywords_it		= '{$_POST['keywords_it']}',
				description_en	= '{$_POST['description_en']}',
				description_it	= '{$_POST['description_it']}'
			ON DUPLICATE KEY UPDATE
				id_categoria	= {$_POST['id_categoria']},
				titolo_en		= '{$_POST['titolo_en']}',
				titolo_it		= '{$_POST['titolo_it']}',
				testo_en		= '{$_POST['testo_en']}',
				testo_it		= '{$_POST['testo_it']}',
				keywords_en		= '{$_POST['keywords_en']}',
				keywords_it		= '{$_POST['keywords_it']}',
				description_en	= '{$_POST['description_en']}',
				description_it	= '{$_POST['description_it']}'
		";
		database::insert($sql);
		
		funzioni::creaSitemap();
		
		header('Location: /admin/listaArticoli.php?id_categoria='.$_POST['id_categoria']);
}

$smarty->assign('categorie', categoria::listaAdmin());

include(dirname(__FILE__).'/../include/endcode.php');

$smarty->display('admin/articolo.tpl');
?>
