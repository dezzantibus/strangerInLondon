<?php

	class articolo
	{
		
		public $id = null;
		public $titolo = '';
		public $testo = '';
		public $description = null;
		public $data = null;
		public $id_categoria = null;
		public $categoria = null;
		public $commenti = null;
		public $foto = null;
		public $letture = null;
		public $linkLingua = null;
		
		/***************************************************************/
		
		function __construct($id = null)
		{
			if(!is_null($id))
			{
				if(is_numeric($id))
				{
					$sql = "
						SELECT a.*, c.nome_en AS cat_en, c.nome_it AS cat_it 
						FROM articolo a 
							INNER JOIN categoria c
								ON c.id = a.id_categoria
						WHERE a.id = $id
					";
					$array = database::getRecord($sql);
				}
				elseif(is_array($id))
				{
					$array = $id;
					$array['cat_en'] = $id['categoria'];
					$array['cat_it'] = $id['categoria'];
				}
				else
				{
					return false;
				}
				
				$this->id 			= $array['id'];
				$this->data			= funzioni::sistemaData($array['data']);
				$this->id_categoria	= $array['id_categoria'];
				$this->categoria	= funzioni::scegliTermine($array['cat_en'], $array['cat_it']);
				$this->titolo		= funzioni::scegliTermine($array['titolo_en'], $array['titolo_it']);
				$this->testo		= funzioni::scegliTermine($array['testo_en'], $array['testo_it']);
				$this->letture		= $array['letture'];
				$this->description	= funzioni::scegliTermine($array['description_en'], $array['description_it']);
				$this->linkLingua	= funzioni::scegliTermine(
					'/italiano/'.$this->id.'/'.funzioni::linkizza($array['cat_it']).'/'.funzioni::linkizza($array['titolo_it']).'.html', 
					'/english/'.$this->id.'/'.funzioni::linkizza($array['cat_en']).'/'.funzioni::linkizza($array['titolo_en']).'.html'
				);
				
				if($this->testo == '')
				{
					$this->testo = funzioni::scegliTermine(
						'Sorry, the article hasn\'t been translated yet.',
						'Spiacente, l\'articolo non è stato ancora tradotto.'
					);
				}
			}
		}
		
		/***************************************************************/
		
		public function foto()
		{
			if(isnull($this->foto))
			{
				$this->caricafoto();
			}
			return $this->foto;
		}
		
		/***************************************************************/
		
		public function caricaFoto()
		{
			$this->foto = array();
			
			$sql = "
				SELECT * 
				FROM foto 
				WHERE id_articolo = {$this->id}
			";
				
			$recordset = database::select($sql);
			while($row = database::getRecord($recordset))
			{
				$this->foto[] = new foto($row);
			}
		}
		
		/***************************************************************/
		
		public function commenti()
		{
			if(isnull($this->commenti))
			{
				$this->caricaCommenti();
			}
			return $this->commenti;
		}
		
		/***************************************************************/
		
		public function caricaCommenti()
		{
			$this->commenti = array();
			
			$sql = "
				SELECT * 
				FROM commento 
				WHERE id_articolo = {$this->id}
					AND lingua = ".funzioni::lingua();
				
			$recordset = database::select($sql);
			while($row = database::getRecord($recordset))
			{
				$this->commenti[] = new commento($row);
			}
		}
		
		/***************************************************************/
		
		function link()
		{
			$lingua = funzioni::lingua();
			$id = $this->id;
			$categoria = funzioni::linkizza($this->categoria);
			$titolo = funzioni::linkizza($this->titolo);
			
			return "/$lingua/$id/$categoria/$titolo.html";
		}
		
		/***************************************************************/
		
		function registraLettura()
		{
			$this->letture++;
			
			$sql = "
				UPDATE articolo 
				SET letture = letture + 1 
				WHERE id = {$this->id}
			";
			database::update($sql);
		}
		
		/***************************************************************/
		
		function breadcrumbs()
		{
			$categoria = new categoria($this->id_categoria);
			
			$result = $categoria->breadcrumbs(true);
			$result[] = array(
				'link'	=> '',
				'testo'	=> $this->titolo
			);
			
			return $result;
		}
		
		/***************************************************************/
		
		function fratelli()
		{
			$sql = "
				SELECT * 
				FROM articolo 
				WHERE id_categoria = {$this->id_categoria}
					AND id <> {$this->id}
				ORDER BY data DESC
				LIMIT 10
			";
			
			$articoli = array();
			$categoria = new categoria($this->id_categoria);
			$recordset = database::select($sql);
			while($row = database::getRecord($recordset))
			{
				$row['categoria'] = $categoria->nome;
				$articoli[] = new articolo($row);
			}
			
			return $articoli;	
		}
		
		/***************************************************************/
		
		static function articoliHome()
		{
			$categoria = funzioni::scegliTermine('nome_en', 'nome_it');
			
			$sql = "
				SELECT articolo.*, $categoria AS categoria
				FROM articolo
					INNER JOIN categoria
						ON categoria.id = articolo.id_categoria
				ORDER BY data DESC
				LIMIT 10
			";
			
			$result = array();
			$recordset = database::select($sql);
			while($row = database::getRecord($recordset))
			{
				$result[] = new articolo($row);
			}
			
			return $result;
			
		}
		
		/***************************************************************/
		
		static function cancella($id)
		{
			$sql = array();
			
			$sql[] = "DELETE FROM articolo WHERE id = $id";
			$sql[] = "DELETE FROM commento WHERE id_articolo = $id";
			$sql[] = "DELETE FROM foto WHERE id_articolo = $id";
			
			foreach($sql as $query)
			{
				database::delete($query);
			}
		}
		
		/***************************************************************/
		
	}

?>