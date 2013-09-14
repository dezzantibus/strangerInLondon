{include file="include/html_head.tpl"}

{include file="include/header.tpl"}

<div id="mainBox">

	<div id="mainColumn" class="admin">
		
		<a href="/admin/">Admin</a>

		<a href="/admin/listaArticoli.php?id_categoria={$id_categoria}">Lista articoli</a>

		<form action="" method="post" enctype="multipart/form-data" id="form{$f.id}">

			<input type="hidden" name="act" value="new" id="act{$f.id}" />
			<input type="hidden" name="id_articolo" value="{$id_articolo}" />

			<label>Thumbnail</label>
			<input type="file" name="thumbnail" />
			<br />
			 
			<label>Large image</label>
			<input type="file" name="image" />
			<br />
			 
			<label>Caption EN</label>
			<input type="text" name="caption_en" value="{$f.caption_en}" />
			<br />

			<label>Caption IT</label>
			<input type="text" name="caption_it" value="{$f.caption_it}" />
			<br />
			
			<input type="submit" value="Inserisci" />
			
		</form>
		
		{foreach item='f' from=$foto}
			
			<hr />

			<form action="" method="post" enctype="multipart/form-data" id="form{$f.id}">

				<input type="hidden" name="act" value="edit" id="act{$f.id}" />
				<input type="hidden" name="id_articolo" value="{$id_articolo}" />
				<input type="hidden" name="id" value="{$f.id}" />

				<img src="{$f.thumbnail}" />
				<br />
	
				<label>Thumbnail</label>
				<input type="file" name="thumbnail" />
				<br />
				 
				<label>Large image</label>
				<input type="file" name="image" />
				<br />
				 
				<label>Caption EN</label>
				<input type="text" name="caption_en" value="{$f.caption_en}" />
				<br />
	
				<label>Caption IT</label>
				<input type="text" name="caption_it" value="{$f.caption_it}" />
				<br />
				
				<input type="submit" value="Modifica" />
				<input type="button" value="Cancella" onclick="cancellaFoto($f.id);" />
				
			</form>
			
		{/foreach}

		<script type="text/javascript">
			{literal}
				function cancellaFoto(id)
				{
					$('#act'+id).attr('value', 'delete');
					$('#form'+id).submit();
				}
			{/literal}
		</script>
	
	</div>

	<div class="clear"></div>

</div>

{include file="include/footer.tpl" nostats=true}