<div id="header">
	{* <a href="{$linkLingua}">{$languageLink.testo}</a>&nbsp;&nbsp;|&nbsp;&nbsp; *}
	<a href="/about.php">{$locale.header.link1}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	<a href="/contacts.php">{$locale.header.link2}</a>
	<a href="/{$locale.language}/" id="titleLink">Stranger in London</a>
</div>
<div id="breadcrumbs">
	<strong>{$locale.header.breadcrumbs}</strong>&nbsp;&nbsp;
	{foreach item='b' from=$breadcrumbs}
		{if $b.link eq ''}
			{$b.testo|escape}
		{else}
			<a href="{$b.link}">{$b.testo|escape}</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;
		{/if}
	{/foreach}
</div>