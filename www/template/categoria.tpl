{include file="include/html_head.tpl" title=$categoria->nome}

{include file="include/header.tpl" linkLingua=$categoria->linkLingua}

<div id="mainBox">

	<div id="mainColumn">
		
		<h1>{$categoria->nome}</h1>
		
		{foreach item='a' from=$categoria->articoli}
			{counter assign='c' name='articoli'}
			<div class="homeArticle">
				<p class="data">{$a->data}</p>
				<a href="{$a->link()}">{$a->titolo}</a>
				<div>{$a->description}</div>
			</div>
			{if $c is div by 3}
				<div class="homeArticle">
					{include file="pubblicita/striscetta_link.tpl"}
				</div>
			{/if}
		{/foreach}
	
	</div>

	{include file="include/menu.tpl"}

	{include file="pubblicita/colonna.tpl"}
	
	<div class="clear"></div>

</div>

{include file="include/footer.tpl"}