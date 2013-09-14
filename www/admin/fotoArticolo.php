<?php

include(dirname(__FILE__).'/../include/common.php');

$id_articolo = $_GET['id_articolo'];
$id_categoria = $_GET['id_categoria'];

$imgFolder = dirname(__FILE__).'/../';

if(isset($_POST['act']))
{
	switch($_POST['act'])
	{
		case 'new':
			$sql = "
				INSERT INTO foto 
					(id_articolo, caption_en, caption_it)
				VALUES
					({$_POST['id_articolo']}, '{$_POST['caption_en']}', '{$_POST['caption_it']}')
			";

			$id = database::insert($sql);
			
			if($_FILES['image']['name'] != '')
			{
				$sql = "UPDATE foto SET image = '/foto/{$_FILES['image']['name']}' WHERE id = $id";
				//var_dump($sql);
				database::update($sql);
				move_uploaded_file($_FILES['image']['tmp_name'], $imgFolder.'foto/'.$_FILES['image']['name']);
			}

			if($_FILES['thumbnail']['name'] != '')
			{
				$sql = "UPDATE foto SET thumbnail = '/foto/{$_FILES['thumbnail']['name']}' WHERE id = $id";
				//var_dump($sql);
				database::update($sql);
				move_uploaded_file($_FILES['thumbnail']['tmp_name'], $imgFolder.'foto/'.$_FILES['thumbnail']['name']);
			}
			
			$sql .= " WHERE id = $id";			
			
			database::update($sql);
			break; 
		case 'delete':
			$foto = new foto($_POST['id']);
			$foto->delete;
			break; 
		case 'edit':
			$sql = "
				UPDATE foto 
				SET caption_en = '{$_POST['caption_en']}',
					caption_it = '{$_POST['caption_it']}'
			";
			
			if($_FILES['image']['name'] != '')
			{
				$sql .= ", image = '/foto/{$_FILES['image']['name']}'";
				move_uploaded_file($_FILES['image']['tmp_name'], $imgFolder.'foto/'.$_FILES['image']['name']);
			}

			if($_FILES['thumbnail']['name'] != '')
			{
				$sql .= ", thumbnail = '/foto/{$_FILES['thumbnail']['name']}'";
				move_uploaded_file($_FILES['thumbnail']['tmp_name'], $imgFolder.'foto/'.$_FILES['thumbnail']['name']);
			}
			
			$sql .= " WHERE id = {$_POST['id']}";	
			
			//var_dump($sql);		
			
			database::update($sql);
			
			break; 
	}
}

$sql = "
	SELECT *
	FROM foto
	WHERE id_articolo = $id_articolo
	ORDER BY id
";

$smarty->assign('id_categoria', $id_categoria);
$smarty->assign('id_articolo', $id_articolo);
$smarty->assign('foto', database::getArray($sql));

include(dirname(__FILE__).'/../include/endcode.php');

$smarty->display('admin/fotoArticolo.tpl');
?>
