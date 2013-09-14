<?php
	class funzioni
	{
		/**************************************************************/
		
		static function xml2array($xml)
		{
			if ($xml instanceof SimpleXMLElement) 
			{
				$xml = (array)$xml;
			}

			if(is_array($xml))
			{
				foreach($xml as $key => $value)
				{
					
					$xml[$key] = self::xml2array($value);
					
				}
			}
			
			return $xml;
			
		}
		/**************************************************************/
		
		static function lingua()
		{
			/*
			if(!isset($_SESSION['lingua']))
			{
				$lingue = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
				$impostazione = 'italiano';
				
				foreach($lingue as $lingua)
				{
					$lingua = substr($lingua,0,2);
					if($lingua == 'en')
					{
						$impostazione = 'english';
					}
				}
				
				$_SESSION['lingua'] = $impostazione;
			}
			
			return $_SESSION['lingua'];
			*/
			
			return 'italiano';
		}
		
		/**************************************************************/
		
		static function impostaLingua($lingua)
		{
			switch(true)
			{
				case !isset($_SESSION['lingua']) :
				case $lingua != $_SESSION['lingua']:
					unset($_SESSION);
					$_SESSION['lingua'] = $lingua;
					break;
			}
			
		}
		
		/**************************************************************/
		
		static function salvaFile($file, $testo)
		{
			$fp = fopen(dirname(__FILE__).'/../'.$file, "w");
			fwrite($fp, utf8_encode($testo));
		}
		
		/**************************************************************/
		
		static function meseDaNumero($mese)
		{
			switch($mese)
			{
				case  1 :
					return self::scegliTermine('January', 'Gennaio');
					break;					
				case  2 :
					return self::scegliTermine('February', 'Febbraio');
					break;					
				case  3 :
					return self::scegliTermine('March', 'Marzo');
					break;					
				case  4 :
					return self::scegliTermine('April', 'Aprile');
					break;					
				case  5 :
					return self::scegliTermine('May', 'Maggio');
					break;					
				case  6 :
					return self::scegliTermine('June', 'Giugno');
					break;					
				case  7 :
					return self::scegliTermine('July', 'Luglio');
					break;					
				case  8 :
					return self::scegliTermine('August', 'Agosto');
					break;					
				case  9 :
					return self::scegliTermine('September', 'Settembre');
					break;					
				case 10 :
					return self::scegliTermine('October', 'Ottobre');
					break;					
				case 11 :
					return self::scegliTermine('November', 'Novembre');
					break;					
				case 12 :
					return self::scegliTermine('December', 'Dicembre');
					break;					
			}
		}
		
		/**************************************************************/
		
		static function numeroDaMese($mese)
		{
			switch($mese)
			{
				case  'January' :
				case  'Gennaio' :
					return 1;
					break;					
				case  'February' :
				case  'Febbraio' :
					return 2;
					break;
				case  'March' :
				case  'Marzo' :
					return 3;
					break;					
				case  'April' :
				case  'Aprile' :
					return 4;
					break;					
				case  'May' :
				case  'Maggio' :
					return 5;
					break;					
				case  'June' :
				case  'Giugno' :
					return 6;
					break;					
				case 'July' :
				case 'Luglio' :
					return 7;
					break;					
				case 'August' :
				case 'Agosto' :
					return 8;
					break;					
				case 'September' :
				case 'Settembre' :
					return 9;
					break;					
				case 'October' :
				case 'Ottobre' :
					return 10;
					break;					
				case 'November' :
				case 'Novembre' :
					return 11;
					break;					
				case 'December' :
				case 'Dicembre' :
					return 12;
					break;					
			}
		}

		/**************************************************************/
		
		static function giornoDellaSettimana($abbreviazione)
		{
			switch(strtolower($abbreviazione))
			{
				case 'mon': 
				case 'lun':
					return self::scegliTermine('Monday', 'Lunedi');
					break;
					
				case 'mar':
				case 'tue':
					return self::scegliTermine('Tuesday', 'Martedi');
					break;
					
				case 'mer':
				case 'wed':
					return self::scegliTermine('Wednesday', 'Mercoledi');
					break;
					
				case 'gio':
				case 'thu':
					return self::scegliTermine('Thursday', 'Giovedi');
					break;
					
				case 'ven':
				case 'fri':
					return self::scegliTermine('Friday', 'Venerdi');
					break;
					
				case 'sab':
				case 'sat':
					return self::scegliTermine('Saturday', 'Sabato');
					break;
					
				case 'dom':
				case 'sun':
					return self::scegliTermine('Sunday', 'Domenica');
					break;
			}
		}

		/**************************************************************/
		
		static function scegliTermine($english, $italiano)
		{
			switch(self::lingua())
			{
				case 'italiano':
					return $italiano;
					break;
				case 'english':
					return $english;
					break;
			}
		}
		
		/**************************************************************/

		static function linkizza($string)
		{
			$cerca = array(
				' ',
				"'", ',', '?',
				'à', 'è', 'ì', 'ò', 'ù',
				'á', 'é', 'í', 'ó', 'ú',
			);
			$sostituisci = array(
				'_',
				'', '', '',
				'a', 'e', 'i', 'o', 'u',
				'a', 'e', 'i', 'o', 'u',
			);
			$string = str_replace($cerca, $sostituisci, $string);
			
			return $string;
		}
		
		/**************************************************************/
		
		static function caricaTesto()
		{
			$xml_str = file_get_contents(dirname(__FILE__).'/../lingue/'.self::lingua().'.xml');
			$xml = simplexml_load_string($xml_str);
			return self::ToArray($xml);
		}
		
		/**************************************************************/
		
		static function ToArray($data)
		{
			if(trim((string)$data) != '')
			{
				return (string)$data;
			}
			
			$array = array();
			
			foreach($data as $key=>$value)
			{
				$array[$key] = self::ToArray($value);
			}
			return $array;
		}
		
		/**************************************************************/

		static function homeBreadCrumbs($internal=false)
		{
			if($internal)
			{
				$link = '/'.self::lingua().'/';
			}
			else
			{
				$link = '';
			}
			
			$bc = array(
				'link'	=> $link,
				'testo'	=> self::scegliTermine('Homepage', 'Pagina Iniziale')
			);
			
			return $bc;
		}
		
		/**************************************************************/

		static function linkLingua()
		{
			$link = str_replace(
				self::scegliTermine('english', 'italiano'), 
				self::scegliTermine('italiano', 'english'), 
				$_SERVER['REQUEST_URI']
			);
			
			if($link == '/')
			{
				$link .= self::scegliTermine('italiano', 'english').'/';
			}
			
			$linkArray = array(
				'testo'	=> self::scegliTermine('Italiano', 'English'), 
				'link'	=> $link
			);
			
			return $linkArray;
		}

		/**************************************************************/
		
		static function sistemaData($data)
		{
			$data = strtotime($data);
			
			$giorno	= self::giornoDellaSettimana(date('D', $data));
			$mese	= self::meseDaNumero(date('n', $data));
			
			$result = $giorno.' '.date(self::scegliTermine('jS', 'j'), $data).' '.$mese.' '.date('Y H:i', $data);
			
			return $result;
		}
		
		/**************************************************************/

		static function creaSitemap()
		{
			$sql = "
				SELECT a.*, c.nome_en, c.nome_it 
				FROM articolo a
					INNER JOIN categoria c
						ON c.id = a.id_categoria
				ORDER BY data DESC
				LIMIT 500
			";
			
			$xml = '<?xml version="1.0" encoding="UTF-8"?>
				<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
			';
			
			//return "/$lingua/$id/$categoria/$titolo.html";
			$recordset = database::select($sql);
			$now = date('Y-m-d');
						
			while($row = database::getRecord($recordset))
			{
				$titolo_en = self::linkizza($row['titolo_en']);
				$titolo_it = self::linkizza($row['titolo_it']);
				
				$categoria_en = self::linkizza($row['nome_en']);
				$categoria_it = self::linkizza($row['nome_it']);

				if(!empty($row['testo_en']))
				{
					$xml .="<url><loc>http://www.strangerinlondon.com/english/{$row['id']}/$categoria_en/$titolo_en.html</loc></url>";
				}
				if(!empty($row['testo_it']))
				{
					$xml .="<url><loc>http://www.strangerinlondon.com/italiano/{$row['id']}/$categoria_it/$titolo_it.html</loc></url>";
				}
			}
			
			$xml .= '</urlset>';
			
			self::salvaFile('sitemap.xml', $xml);
		}

		/**************************************************************/

		static function convertCharset($http_response_header, $xml_str)
		{
			
			if(is_array($http_response_header))
			{
				foreach ($http_response_header as $header)
				{   
					if (preg_match('#^Content-Type: text/xml; charset=(.*)#i', $header, $m))
					{   
						switch (strtolower($m[1]))
						{   
							case 'utf-8':
								// do nothing
								break;
			
							case 'iso-8859-1':
								$xml_str = utf8_encode($xml_str);
								break;
			
							default:
								$xml_str = iconv($m[1], 'utf-8', $xml_str);
						}
						break;
					}
				}
		}
			
			return $xml_str;
			
		}

		/**************************************************************/

	}
