<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Stranger in London - {$title|escape}</title>
	
	<meta name="description" content="{$description|escape}" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
	<script type="text/javascript" src="/js/colorbox/jquery.colorbox-min.js"></script>

	<link rel="stylesheet" href="/css/colorbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/css/style.css" />

	<meta name="google-site-verification" content="7oVvdwcx42MCdDpnipikNPOYvi4GMee_JfTpIYaj-sw" />
	
	{literal}
	<script type="text/javascript">

		$(document).ready(function() {
			
			$('.image').colorbox({current:'{/literal}{$locale.gallery}{literal}'});
			
			if($('#messages').html() != null)
			{
				$.colorbox({width:'70%',inline:true,href:'#messages'});
			}
			
		});
		
	</script>
	{/literal}
		
</head>

<body>