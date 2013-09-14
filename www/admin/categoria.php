<?php

include(dirname(__FILE__).'/../include/common.php');

if(isset($_POST['act']))
{
	switch($_POST['act'])
	{
		case 'new':
			$sql = "
				INSERT INTO categoria
					(nome_en, nome_it)
				VALUES
					('{$_POST['nome_en']}', '{$_POST['nome_it']}')
			";
			database::insert($sql);
			break;
		case 'update':
			$sql = "
				UPDATE categoria
				SET nome_en = '{$_POST['nome_en']}',
					nome_it = '{$_POST['nome_it']}'
				WHERE id = {$_POST['id']}
			";
			break;
	}
}

$smarty->assign('categorie', categoria::listaAdmin());

include(dirname(__FILE__).'/../include/endcode.php');

$smarty->display('admin/categoria.tpl');
?>
