<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {link} function plugin
 *
 * Type:     function<br>
 * Name:     link<br>
 * Purpose:  handle embedding links in template<br>
 * @author   Andrea Passante
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_link($params, &$smarty)
{
	$link = '<a href="'.$params['href'].'"';
	
	if($params['external'])
	{
		$link .=  ' rel="nofollow" target="_blank"';
	}
	
	if(!empty($params['class']))
	{
		$link .= ' class="'.$params['class'].'"';
	}
	
	$link .= '>'.$params['text'].'</a>';
	
	return $link;
}

/* vim: set expandtab: */

?>
