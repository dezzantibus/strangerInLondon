{include file="include/html_head.tpl"}

{include file="include/header.tpl"}

<div id="mainBox">

	<div id="mainColumn" class="admin">
		
		<a href="/admin/">Admin</a>

		<a href="/admin/listaArticoli.php?id_categoria={$articolo.id_categoria}">Lista articoli</a>
		
		<form action="?act=salva" method="post">
			<input type="hidden" name="id" value="{$articolo.id|default:'NULL'}" />

			<table cellpadding="0" cellspacing="10" border="0">
				<tr>
					<td>Categoria</td>
					<td>
						<select name="id_categoria">
							{foreach item='c' from=$categorie}
								<option value="{$c.id}"{if $articolo.id_categoria eq $c.id} selected="selected"{/if}>{$c.nome_it}</option>
							{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td>Titolo EN</td>
					<td><input type="text" name="titolo_en" value="{$articolo.titolo_en}" maxlength="250" /></td>
				</tr>
				<tr>
					<td>Titolo IT</td>
					<td><input type="text" name="titolo_it" value="{$articolo.titolo_it}" maxlength="250" /></td>
				</tr>
				<tr>
					<td>Testo EN</td>
					<td><textarea name="testo_en">{$articolo.testo_en}</textarea></td>
				</tr>
				<tr>
					<td>Testo IT</td>
					<td><textarea name="testo_it">{$articolo.testo_it}</textarea></td>
				</tr>
				<tr>
					<td>Keywords EN</td>
					<td><input type="text" name="keywords_en" value="{$articolo.keywords_en}" maxlength="250" /></td>
				</tr>
				<tr>
					<td>Keywords IT</td>
					<td><input type="text" name="keywords_it" value="{$articolo.keywords_it}" maxlength="250" /></td>
				</tr>
				<tr>
					<td>Description EN</td>
					<td><textarea name="description_en">{$articolo.description_en}</textarea></td>
				</tr>
				<tr>
					<td>Description IT</td>
					<td><textarea name="description_it">{$articolo.description_it}</textarea></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Salva" /></td>
				</tr>
			</table>
		</form>
	
	</div>

	<div class="clear"></div>

</div>

{include file="include/footer.tpl" nostats=true}