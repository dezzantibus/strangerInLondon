{include file="include/html_head.tpl"}

{include file="include/header.tpl"}

<div id="mainBox">

	<div id="mainColumn" class="admin">
		
		<a href="/admin/">Admin</a>
		
		{foreach item='c' from=$categorie}
			<form method="post">
				<input type="hidden" name="act" value="update" />
				<input type="hidden" name="id" value="{$c.id}" />
				<input type="text" name="nome_en" value="{$c.nome_en}" />
				<input type="text" name="nome_it" value="{$c.nome_it}" />
				<input type="submit" value="Salva" />
			</form>
			<br />
		{/foreach}
		<form method="post">
			<input type="hidden" name="act" value="new" />
			<input type="text" name="nome_en" value="" />
			<input type="text" name="nome_it" value="" />
			<input type="submit" value="Salva" />
		</form>

	</div>

	<div class="clear"></div>

</div>

{include file="include/footer.tpl" nostats=true}