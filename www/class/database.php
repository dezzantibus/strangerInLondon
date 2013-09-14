<?php
	class database
	{
		/**************************************************************/
		static function open()
		{
			mysql_connect(
				impostazioni::$DBserver[$_SERVER['HTTP_HOST']], 
				impostazioni::$DBuser[$_SERVER['HTTP_HOST']], 
				impostazioni::$DBpassword[$_SERVER['HTTP_HOST']]
			);
			mysql_select_db(impostazioni::$DBname[$_SERVER['HTTP_HOST']]);
		}
		/**************************************************************/
		static function close()
		{
			mysql_close();
		}
		/**************************************************************/
		static function insert($sql)
		{
			mysql_query($sql);
			return mysql_insert_id();
		}
		/**************************************************************/
		static function update($sql)
		{
			return mysql_query($sql);
		}
		/**************************************************************/
		static function delete($sql)
		{
			return mysql_query($sql);
		}
		/**************************************************************/
		static function select($sql)
		{
			return mysql_query($sql);
		}
		/**************************************************************/
		static function getRecord($recordset)
		{
			if(is_string($recordset))
			{
				$recordset = self::select($recordset);
			}
			
			if($recordset)
			{
				return mysql_fetch_assoc($recordset);
			}
			else
			{
				return false;
			}
		}
		/**************************************************************/
		static function getArray($recordset)
		{
			if(is_string($recordset))
			{
				$recordset = self::select($recordset);
			}
			
			if($recordset)
			{
				$result = array();
				while($record = self::getRecord($recordset))
				{
					$result[] = $record;
				}
				return $result;
			}
			else
			{
				return false;
			}
		}
		/**************************************************************/
		static function sanitize($string)
		{
			$string = htmlentities($string);
			$string = mysql_real_escape_string($string);
			return $string;
		}
		/**************************************************************/
	}
?>