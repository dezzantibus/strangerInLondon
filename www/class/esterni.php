<?php

	class esterni
	{
		
		static $completi = array(
			'Parzialmente',
			'Possibilità'
		);
		
		static $abbreviazioni = array(
			'Parz.',
			'Poss.'
		);
		
		/**************************************************************/

		static function weather()
		{
			if(!isset($_SESSION['weather']))
			{
				self::setWeather();
			}
			return $_SESSION['weather'];
		}
		
		/**************************************************************/
		
		static function getWeatherXml()
		{
			$file = funzioni::scegliTermine(
				'../weather_en.xml',
				'../weather_it.xml'
			);

			$link = funzioni::scegliTermine(
				'http://api.wunderground.com/api/03aa91bcfad8b663/conditions/forecast/lang:EN/q/England/London.xml',
				'http://api.wunderground.com/api/03aa91bcfad8b663/conditions/forecast/lang:IT/q/England/London.xml'
			);
			
			$modified = date ("d m Y H", filemtime($file));
			$now 	  = date ("d m Y H");
			
			if($modified == $now)
			{
				$xml = file_get_contents($file);
			}
			else
			{
				$xml = file_get_contents($link);
				file_put_contents($file, $xml);
			}
			
			$xml = funzioni::convertCharset($http_response_header, $xml);
			
			return $xml;
			
		}
		
		/**************************************************************/
		
		static function setWeather($link=null)
		{
					
			$xml_str = self::getWeatherXml();
		
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
			
			$xml = simplexml_load_string($xml_str);
			
			$data = funzioni::xml2array($xml);
			
			$source = array(
				'logo' => (string)$xml->current_observation->image->url['data'],
				'link' => (string)$xml->current_observation->image->link['data']
			);
			
			$current = array(
				'condition'		=> str_replace(self::$completi, self::$abbreviazioni, $data['current_observation']['weather']),
				'celsius'		=> $data['current_observation']['temp_c'],
				'farenheit'		=> $data['current_observation']['temp_f'],
				'humidity'		=> $data['current_observation']['relative_humidity'],
				'icon'			=> self::weatherIcon($data['current_observation']['icon']),
				'wind'			=> (string)$xml->weather->current_conditions->wind_condition['data']
			);

			$forecast = array(
				self::weatherSingleForecast($data['forecast']['simpleforecast']['forecastdays']['forecastday'][0]),
				self::weatherSingleForecast($data['forecast']['simpleforecast']['forecastdays']['forecastday'][1]),
				self::weatherSingleForecast($data['forecast']['simpleforecast']['forecastdays']['forecastday'][2]),
				self::weatherSingleForecast($data['forecast']['simpleforecast']['forecastdays']['forecastday'][3]),
				self::weatherSingleForecast($data['forecast']['simpleforecast']['forecastdays']['forecastday'][4]),
				self::weatherSingleForecast($data['forecast']['simpleforecast']['forecastdays']['forecastday'][5]),
				self::weatherSingleForecast($data['forecast']['simpleforecast']['forecastdays']['forecastday'][6]),
			);
			
			$_SESSION['weather'] = array(
				'current'	=> $current,
				'forecast'	=> $forecast
			);
			
		}
		
		/**************************************************************/

		static function weatherIcon($icona)
		{
			return '/images/weather/'.$icona.'.png';
		}

		/**************************************************************/
		
		static function weatherSingleForecast($day)
		{
			return array(
				'day'		=> $day['date']['weekday'],
				'low'		=> $day['low']['celsius'],
				'high'		=> $day['high']['celsius'],
				'icon'		=> self::weatherIcon($day['icon']),
				'condition'	=> str_replace(self::$completi, self::$abbreviazioni, $day['conditions'])
			);
		}
		
		/**************************************************************/
		
		static function tfl()
		{
			if(!isset($_SESSION['tfl']))
			{
				self::setTfl();
			}
			return $_SESSION['tfl'];
		}
		
		/**************************************************************/
		
		static function setTfl()
		{
			$_SESSION['tfl'] = '<script language="JavaScript" src="http://www.tfl.gov.uk/tfl/syndication/widgets/serviceboard/embeddable/serviceboard-iframe-stretchy.js"></script>';			
		}
		
		/**************************************************************/
		/**************************************************************/
		/**************************************************************/	
	}
