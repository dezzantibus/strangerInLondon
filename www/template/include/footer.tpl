<div id="footer">
	<a href="{$languageLink.link}">{$languageLink.testo}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	<a href="/about.php">{$locale.header.link1}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	<a href="/contacts.php">{$locale.header.link2}</a>
</div>
{if $nostats neq true}
{literal}
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-15643626-8']);
	_gaq.push(['_trackPageview']);
	
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
{/literal}
{/if}
</body>
</html>