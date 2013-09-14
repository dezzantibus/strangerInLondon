<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {image} function plugin
 *
 * Type:     function<br>
 * Name:     image<br>
 * Purpose:  handle embedding images in template<br>
 * @author   Andrea Passante
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_image($params, &$smarty)
{
	if(is_null($params['image']))
	{
		return '';
	}
	
	$image = '';
	
	if($params['lightbox'] !== false)
	{
		$image .= '<a href="'.$params['image']->image.'" class="image" rel="galleria">';
	}

	if($params['position'] == 'right')
	{
		$image .= '<img src="'.$params['image']->thumbnail.'" style="float:right;margin:0 0 10px 10px" class="'.$params['class'].'" alt="'.$params['image']->caption.'" />';
	}
	else
	{
		$image .= '<img src="'.$params['image']->thumbnail.'" style="float:left;margin:0 10px 10px 0" class="'.$params['class'].'" alt="'.$params['image']->caption.'" />';
	}
	
	if($params['lightbox'] !== false)
	{
		$image .= '</a>';
	}
		
	return $image;
}

/* vim: set expandtab: */

?>
