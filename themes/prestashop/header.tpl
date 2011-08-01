<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang_iso}">
	<head>
<meta name="google-site-verification" content="S6F0Ie_6vZ2qQQJaguKUiZNfcPQztywFpUcvjUgfBUs" />
      <title>{$meta_title|escape:'htmlall':'UTF-8'}</title>
{if isset($meta_description) AND $meta_description}
		<meta name="description" content="{$meta_description|escape:html:'UTF-8'}" />
{/if}
{if isset($meta_keywords) AND $meta_keywords}
		<meta name="keywords" content="{$meta_keywords|escape:html:'UTF-8'}" />
{/if}
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="{if isset($nobots)}no{/if}index,follow" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="{$img_ps_dir}favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="{$img_ps_dir}favicon.ico" />
{if isset($css_files)}
	{foreach from=$css_files key=css_uri item=media}
	<link href="{$css_uri}?v={php} $css_path = getcwd().$this->get_template_vars('css_uri'); echo filemtime($css_path);{/php}" rel="stylesheet" type="text/css" media="{$media}" />
	{/foreach}
{/if}
		<script type="text/javascript" src="{$content_dir}js/tools.js"></script>
		<script type="text/javascript">
			var baseDir = '{$content_dir}';
			var static_token = '{$static_token}';
			var token = '{$token}';
			var priceDisplayPrecision = {$priceDisplayPrecision*$currency->decimals};
			var roundMode = {$roundMode};
		</script>
		<script type="text/javascript" src="{$content_dir}js/jquery/jquery-1.2.6.pack.js"></script>
		<script type="text/javascript" src="{$content_dir}js/jquery/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="{$content_dir}js/jquery/jquery.hotkeys-0.7.8-packed.js"></script>
		<!-- Placez cette balise dans la section <head> ou juste avant la balise de fermeture </body> -->
		 <script type="text/javascript" src="https://apis.google.com/js/plusone.js"> {literal} {lang: 'fr'}{/literal} </script>
		 <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
		 <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
{if isset($js_files)}
	{foreach from=$js_files item=js_uri}
	<script type="text/javascript" src="{$js_uri}"></script>
	{/foreach}
{/if}
{$HOOK_HEADER}
	</head>
	
	<body {if $page_name}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if}>
	{if !$content_only}
		<noscript><ul><li>{l s='This shop requires JavaScript to run correctly. Please activate JavaScript in your browser.'}</li></ul></noscript>
		<div id="page">

			<!-- Header -->
			<div id="header">
				<div id="logo"><a href="{$base_dir}" title="{$shop_name|escape:'htmlall':'UTF-8'}"><img src="{$img_ps_dir}logo2.jpg" alt="{$shop_name|escape:'htmlall':'UTF-8'}" /></a></div>
				<div id="header_right">
					{$HOOK_TOP}
				</div>
			</div>

			<div id="columns">
				<!-- Left -->
				<div id="left_column" class="column">
					{$HOOK_LEFT_COLUMN}
				</div>

				<!-- Center -->
				<div id="center_column">
	{/if}
