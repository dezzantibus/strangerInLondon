{include file="include/html_head.tpl"}

{include file="include/header.tpl"}

<div id="mainBox">

	<div id="mainColumn" class="admin">
		
		<a href="/admin/">Admin</a>
		
		<select onchange="window.location='/admin/listaArticoli.php'+this.value">
			<option value="">&nbsp;</option>
			{foreach item='c' from=$categorie}
				<option value="?id_categoria={$c.id}"{if $categoriaSelezionata eq $c.id} selected="selected"{/if}>{$c.nome_it}</option>
			{/foreach}
		</select>
		<input type="button" value="Nuovo" onclick="window.location='/admin/articolo.php?id={$a.id}&act=new'">
		<br />
		<br />
		
		{foreach item='a' from=$articoli}
			<p>{$a->titolo}</p>
			<input type="button" value="Foto" onclick="window.location='/admin/fotoArticolo.php?id_articolo={$a->id}&id_categoria={$a->id_categoria}'">
			<input type="button" value="Modifica" onclick="window.location='/admin/articolo.php?id={$a->id}&act=edit'">
			<input type="button" value="Cancella" onclick="if(confirm('Cancellare?\n{$a->titolo|replace:"'":"\'"}'))window.location='/admin/cancellaArticolo.php?id={$a->id}&id_categoria={$a->id_categoria}'">
			<br />
			<br />
		{/foreach}

	</div>

	<div class="clear"></div>

</div>

{include file="include/footer.tpl" nostats=true}