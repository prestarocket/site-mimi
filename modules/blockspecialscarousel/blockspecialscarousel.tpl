<!-- MODULE Block specials -->
{literal}
<style type="text/css">
#special_slider ul, #special_slider li{
	margin:0;
	padding:0;
	list-style:none;
	}
#special_slider, #special_slider li{
	width:174px;
	height:80px;
	overflow:hidden;
	}
</style>
<script src="modules/blockspecialscarousel/js/olcSlider.js" type="text/javascript"></script>
{/literal}
<div id="special_block_right" class="block products_block exclusive blockspecials">
	<h4><a href="{$base_dir}prices-drop.php" title="{l s='Specials' mod='blockspecialscarousel' }">{l s='Specials' mod='blockspecialscarousel'}</a></h4>
	<div class="block_content">
{if $products|@count > 0}
		<div  id="special_slider">
    	<ul style="">
		{foreach from=$products item=product name=products}
		<li style="padding: 3px 0px 3px 0px;">
                    <a style="float:left" href="{$product.link}"><img src="{$img_prod_dir}{$product.id_image}-medium.jpg" alt="{$product.legend|escape:htmlall:'UTF-8'}" title="{$product.name|escape:htmlall:'UTF-8'}" /></a>
                    <div><h5><a href="{$product.link}" title="{$product.name|escape:htmlall:'UTF-8'}">{$product.name|truncate:35|escape:'htmlall':'UTF-8'}</a></h5>
                    <span class="price-discount">{displayWtPrice p=$product.price_without_reduction}</span>
                    {if $product.reduction_percent}<span class="reduction">(-{$product.reduction_percent}%)</span>{/if}
                    <span class="price">{displayWtPrice p=$product.price}</span></div>
                </li>
		{/foreach}
		</ul>
        </div>
		<p>
			<a href="{$base_dir}prices-drop.php" title="{l s='All specials' mod='blockspecialscarousel'}" class="button">{l s='All specials' mod='blockspecialscarousel'}</a>
		</p>
{else}
		<p>{l s='No specials at this time' mod='blockspecialscarousel'}</p>
{/if}
	</div>
</div>

{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("#special_slider").olcSlider({
            speed: {/literal}{$timeEffet}{literal},
            duration: {/literal}{$timeTrans}{literal}});
});
</script>
{/literal}
<!-- /MODULE Block specials -->