<div id="menu">

	{*
	<div class="menuBox">
		<h3>{$locale.menu.search}</h3>
		<form action="/search.php" id="search">
			<input type="text" name="search" />
			<input type="submit" value="{$locale.menu.go}" />
		</form>
	</div>
	*}

	<div class="menuBox">
		<h3>{$locale.menu.subjects}</h3>
		{foreach item='c' from=$categorie}
			<a href="{$c.link}">{$c.nome|escape}</a>
		{/foreach}
		<div class="spacer20"></div>
	</div>
	
	{if $fratelli}
	<div class="menuBox">
		<h3>{$locale.menu.siblings}</h3>
		{foreach item='f' from=$fratelli}
			<a href="{$f->link()}">{$f->titolo|escape}</a>
		{/foreach}
		<div class="spacer20"></div>
	</div>
	{/if}

	<div class="menuBox">
		<h3>{$locale.menu.weather}</h3>
		<div id="meteoOggi" style="background-image:url({$weather.current.icon});">
			<div>
				<p>{$locale.menu.today}</p>
				{$weather.current.condition}<br />
				{$locale.menu.temperature}: {$weather.current.celsius} &deg;C<br />
			</div>
		</div>
		
		<div id="forecast">
			{*
			<img src="{$weather.forecast.0.icon}" width="90" alt="{$weather.forecast.0.condition}" />
			<p>
				{$weather.forecast.0.day}<br />
				{$weather.forecast.0.condition}
			</p>
			<div class="clear"></div>
			*}
			<img src="{$weather.forecast.1.icon}" width="90" alt="{$weather.forecast.1.condition}" />
			<p>
				{$weather.forecast.1.day}<br />
				{$weather.forecast.1.condition}
			</p>
			<div class="clear"></div>
			<img src="{$weather.forecast.2.icon}" width="90" alt="{$weather.forecast.2.condition}" />
			<p>
				{$weather.forecast.2.day}<br />
				{$weather.forecast.2.condition}
			</p>
			<div class="clear"></div>
			<img src="{$weather.forecast.3.icon}" width="90" alt="{$weather.forecast.3.condition}" />
			<p>
				{$weather.forecast.3.day}<br />
				{$weather.forecast.3.condition}
			</p>
			<div class="clear"></div>
		</div>
	</div>

	{*
	<div class="spacer10"></div>

	<div class="menuBox">
		{$tfl}
	</div>
	*}

	<div class="spacer10"></div>
	
	<p>
		<a href="http://validator.w3.org/check?uri=referer"><img
		src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>
	</p>

	<div class="spacer10"></div>
	
	<p>
		<a href="http://jigsaw.w3.org/css-validator/check/referer">
			<img style="border:0;width:88px;height:31px"
				src="http://jigsaw.w3.org/css-validator/images/vcss"
				alt="Valid CSS!" />
		</a>
	</p>
	
</div>