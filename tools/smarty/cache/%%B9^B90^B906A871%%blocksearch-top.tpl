189
a:4:{s:8:"template";a:1:{s:67:"/homez.387/lilibio/www/site/modules/blocksearch/blocksearch-top.tpl";b:1;}s:9:"timestamp";i:1298626491;s:7:"expires";i:1298630091;s:13:"cache_serials";a:0:{}}<!-- Block search module TOP -->
<div id="search_block_top">
	<form method="get" action="http://www.lilibio.com/shop/search.php" id="searchbox">
	<p>
		<label for="search_query"><!-- image on background --></label>
		<input type="hidden" name="orderby" value="position" />
		<input type="hidden" name="orderway" value="desc" />
		<input type="text" id="search_query" name="search_query" value="" />
		<input type="submit" name="submit_search" value="Rechercher" class="button" />
	</p>
	</form>
</div>
	<script type="text/javascript">
		
		
		function formatSearch(row) {
			return row[2] + ' > ' + row[1];
		}

		function redirectSearch(event, data, formatted) {
			$('#search_query').val(data[1]);
			document.location.href = data[3];
		}
		
		$('document').ready( function() {
			$("#search_query").autocomplete(
				'http://www.lilibio.com/shop/search.php', {
				minChars: 3,
				max:10,
				selectFirst:false,
				width:500,
				scroll: false,
				formatItem:formatSearch,
				extraParams:{ajaxSearch:1,id_lang:2}
			}).result(redirectSearch)
		});
		
	</script>
<!-- /Block search module TOP -->