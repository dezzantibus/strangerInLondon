{include file="include/html_head.tpl" title=$articolo->titolo description=$articolo->description}

{include file="include/header.tpl" linkLingua=$articolo->linkLingua}

<div id="mainBox">

	<div id="mainColumn">
		
		<p class="data">{$articolo->data}</p>

		<h1 id="titolo">{$articolo->titolo}</h1>
		
		{include file="pubblicita/banner.tpl"}
		
		<div id='testoArticolo'>{eval var=$articolo->testo}</div>
		
		<iframe src="http://www.facebook.com/plugins/like.php?href={$smarty.server.SCRIPT_URI}"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>
		
		{include file="pubblicita/banner.tpl"}
	
	</div>

	{include file="include/menu.tpl"}

	{include file="pubblicita/colonna.tpl"}
	
	<div class="clear"></div>

</div>

{include file="include/footer.tpl"}