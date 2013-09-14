<?php

	class commento
	{
		
		public $id = null;
		public $id_articolo = null;
		public $testo = null;
		public $data = null;
		public $lingua = null;
		
		/***************************************************************/
		
		function __construct($id = null)
		{
			if(!is_null($id))
			{
				if(is_array($id))
				{
					$array = $id;
				}
				else
				{
					$sql = "SELECT * FROM commento WHERE id = $id";
					$array = database::getRecord($sql);
				}
				
				$this->testo		= $array['testo'];
				$this->id 			= $array['id'];
				$this->data			= funzioni::sistemaData($array['data']);
				$this->id_articolo	= $array['id_articolo'];
				$this->lingua		= $array['lingua'];
			}
		}
		
		/***************************************************************/
		/***************************************************************/
		/***************************************************************/
		
	}

?>