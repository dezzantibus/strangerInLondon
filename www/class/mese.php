<?php

	class mese
	{
		
		public $mese = null;
		public $anno = null;
		public $articoli = null;
		
		/***************************************************************/
		
		function __construct($mese, $anno)
		{
			if(is_numeric($mese))
			{
				$this->mese = $mese;
			}
			else
			{
				$this->mese = funzioni::numeroDaMese($mese);
			}
			$this->anno = $anno;
		}
		
		/***************************************************************/
		
		function articoli()
		{
			$data_da = $this->anno.'-'.$this->mese.'-00';
			$data_a	 = $this->anno.'-'.$this->mese.'-99';
			
			$sql = "
				SELECT *
				FROM articolo
				WHERE data > '$data_da'
					AND data < '$data_a'
				ORDER BY data DESC
			";

			$this->articoli = array();
			$recordset = database::select($sql);
			while($row = database::getRecord($recordset))
			{
				$this->articoli[] = new articolo($row);
			}
		}
		
		/***************************************************************/

		function link()
		{
			$lingua = funzioni::lingua();
			$anno = funzioni::scegliTermine('Year', 'Anno').'_'.$this->anno;
			$mese = funzioni::meseDaNumero($this->mese);
			
			return "/$lingua/$anno/$mese.html";
		}
		
		/***************************************************************/
		/***************************************************************/
		
	}

?>