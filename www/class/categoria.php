<?php

	class categoria
	{
		
		public $id 			= null;
		public $nome 		= null;
		public $articoli	= null;
		public $paginazione = null;
		public $linkLingua	= null;
		
		/***************************************************************/
		
		function __construct($id = null)
		{
			if(!is_null($id))
			{
				$sql = "SELECT * FROM categoria WHERE id = $id";
				$array = database::getRecord($sql);
				
				$this->id	= $array['id'];
				$this->nome = funzioni::scegliTermine($array['nome_en'], $array['nome_it']);
			}
		}
		
		/***************************************************************/
		
		function paginata($pagina)
		{
			$da_saltare = ($pagina - 1) * impostazioni::$articoliPerPagina;
			$articoliPerPagina = impostazioni::$articoliPerPagina;
			
			$sql = "
				SELECT *
				FROM articolo
				WHERE id_categoria = {$this->id}
				ORDER BY data DESC
				LIMIT $da_saltare, $articoliPerPagina
			";
				
			$this->articoli = array();
			$recordset = database::select($sql);
			while($row = database::getRecord($recordset))
			{
				$row['categoria'] = $this->nome;
				$this->articoli[] = new articolo($row);
			}
		}
		
		/***************************************************************/
		
		function calcolaPaginazione($pagina)
		{
			$sql = "
				SELECT COUNT(*) AS totale
				FROM articolo
				WHERE id_categoria = {$this->id}
			";
				
			$row = database::getRecord($sql);
			$articoli = $row['totale'];
			
			$pagine = $articoli / impostazioni::$articoliPerPagina;
			
			if(floor($pagine) != $pagine)
			{
				$pagine++;
			}
			
			$paginazione = array();
			for($counter=1; $counter<=$pagine; $counter++)
			{
				if($counter == $pagina)
				{
					$this->paginazione[$counter] = 'current';
				}
				else
				{
					$this->paginazione[$counter] = $this->link($counter);
				}
			}
			
		}
		
		/***************************************************************/
		
		function link($pagina=1)
		{
			$lingua = funzioni::lingua();
			$id = $this->id;
			$nome = funzioni::linkizza($this->nome);
			
			if($pagina == 1)
			{
				return "/$lingua/$id/$nome.html";
			}
			else
			{
				return "/$lingua/$id/$pagina/$nome.html";
			}
		}
		
		/***************************************************************/
		
		function generaLinkLingua($pagina=1)
		{
			$lingua = funzioni::scegliTermine('italiano', 'english');
			$id = $this->id;
			
			$sql = "
				SELECT nome_en, nome_it 
				FROM categoria
				WHERE id = {$this->id}
			";
			
			$array = database::getRecord($sql);
			
			$nome = funzioni::linkizza(funzioni::scegliTermine($array['nome_it'], $array['nome_en']));
			
			if($pagina == 1)
			{
				$this->linkLingua = "/$lingua/$id/$nome.html";
			}
			else
			{
				$this->linkLingua = "/$lingua/$id/$pagina/$nome.html";
			}
		}
		
		/***************************************************************/
		
		function breadcrumbs($internal=false)
		{
			$results = array(funzioni::homeBreadCrumbs(true));
			
			if($internal)
			{
				$link = $this->link();
			}
			else
			{
				$link = '';
			}
			
			$results[] = array(
				'link'	=> $link,
				'testo'	=> $this->nome
			);
			
			return $results;
		}
		
		/***************************************************************/
		
		static function listaCategorie()
		{
			if(!isset($_SESSION['categorie']))
			{
				self::calcolaCategorie();
			}
			return $_SESSION['categorie'];
		}
		
		/***************************************************************/
		
		static function calcolaCategorie()
		{
			$sql = "
				SELECT id 
				FROM categoria
			";
			$sql .= funzioni::scegliTermine('ORDER BY nome_en', 'ORDER BY nome_it');
			
			$result = array();
			$recordset = database::select($sql);

			while($row = database::getRecord($recordset))
			{
				$temp = new categoria($row['id']);
				
				$result[] = array(
					'link' => $temp->link(),
					'nome' => $temp->nome
				);
			}
			
			$_SESSION['categorie'] = $result;
		}
		
		/***************************************************************/
		
		static function listaAdmin()
		{
			$sql = "
				SELECT * 
				FROM categoria
				ORDER BY nome_it
			";
			return database::getArray($sql);
		}
		
		/***************************************************************/

		static function listaArticoli($id, $numero)
		{
			$sql = "
				SELECT * 
				FROM articolo 
				WHERE id_categoria = $id
				ORDER BY data DESC
				LIMIT 50
			";
			
			$articoli = array();
			$categoria = new categoria($id);
			$recordset = database::select($sql);
			while($row = database::getRecord($recordset))
			{
				$row['categoria'] = $categoria->nome;
				$articoli[] = new articolo($row);
			}
			
			return $articoli;	
		}
		
		/***************************************************************/
		
	}

?>