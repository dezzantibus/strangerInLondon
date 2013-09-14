<?php

	class foto
	{
		
		public $id = null;
		public $id_articolo = null;
		public $caption = null;
		public $thumbnail = null;
		public $image = null;
		
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
					$sql = "SELECT * FROM foto WHERE id = $id";
					$array = database::getRecord($sql);
				}
				
				$this->id 			= $array['id'];
				$this->id_articolo	= $array['id_articolo'];
				$this->caption		= funzioni::scegliTermine($array['caption_en'], $array['caption_it']);;
				$this->thumbnail	= $array['thumbnail'];
				$this->image		= $array['image'];
			}
		}
		
		/***************************************************************/
		/***************************************************************/
		/***************************************************************/
		
	}

?>