<!-- Block search module TOP -->
<div id="search_block_top">
	<form method="get" action="{$base_dir_ssl}search.php" id="searchbox">
	<p>
		<label for="search_query"><!-- image on background --></label>
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input type="text" id="search_query" name="search_query" value="{if isset($smarty.get.search_query)}{$smarty.get.search_query|htmlentities:$ENT_QUOTES:'utf-8'|stripslashes}{/if}" />
		<input type="submit" name="submit_search" value="{l s='Search' mod='blocksearch'}" class="button" />
	</p>
	</form>
</div>
{if $ajaxsearch}
	<script type="text/javascript">
		{literal}
		
		function formatSearch(row) {
			return row[2] + ' > ' + row[1];
		}

		function redirectSearch(event, data, formatted) {
			$('#search_query').val(data[1]);
			document.location.href = data[3];
		}
		
		$('document').ready( function() {
			$("#search_query").autocomplete(
				'{/literal}{if $search_ssl == 1}{$base_dir_ssl}{else}{$base_dir}{/if}{literal}search.php', {
				minChars: 3,
				max:10,
				selectFirst:false,
				width:500,
				scroll: false,
				formatItem:formatSearch,
				extraParams:{ajaxSearch:1,id_lang:{/literal}{$cookie->id_lang}{literal}}
			}).result(redirectSearch)
		});
		{/literal}
	</script>
{/if}
<p id="annonce">
Cosmétiques et produits de bien être certifiés BIO<br>
Frais de ports offerts à partir de 69€ d'achat<br>
De nombreuses marques, des idées cadeaux et des conseils de pro !
</p>

<!-- /Block search module TOP -->
