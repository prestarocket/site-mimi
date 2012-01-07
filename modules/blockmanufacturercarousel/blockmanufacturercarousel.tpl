<!-- MODULE Block Manufacturers -->
{literal}
<style type="text/css">
#manufacturer_slider ul, #manufacturer_slider li{
	margin:0;
	padding:0;
	list-style:none;
	}
#manufacturer_slider, #manufacturer_slider li{
	width:174px;
	height:80px;
	overflow:hidden;
	}
</style>
<script src="/modules/blockmanufacturercarousel/js/olcSlider.js" type="text/javascript"></script>
{/literal}
<div id="special_block_right" class="block products_block exclusive blockspecials">
	<h4><a href="{$base_dir}manufacturer.php" title="{l s='Manufacturers' mod='blockmanufacturercarousel' }">{l s='Manufacturers' mod='blockmanufacturercarousel'}</a></h4>
	<div class="block_content">
{if $manufacturers|@count > 0}
        <div  id="manufacturer_slider">
        <ul style="">
            {foreach from=$manufacturers item=manufacturer name=manufacturer_list}
		{if $manufacturer.nb_products > 0}
		<li style="padding: 3px 0px 3px 0px;">
                    <table border="0" cellspacing="0" cellpadding="0"><tr><td><a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)}" title="{l s='More about' mod='blockmanufacturer'} {$manufacturer.name}">
                    <img src="{$img_ps_dir}m/{$manufacturer.id_manufacturer|escape:'htmlall':'UTF-8'}-medium.jpg" alt="" /></a></td>
                   <!--  <td valign="center"><h3><a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)}" title="{l s='More about' mod='blockmanufacturer'} {$manufacturer.name}">{$manufacturer.name}</a></h3></td> --> </tr></table></li> 
		{/if}
            {/foreach}
        </ul>
        </div>
        <p>
            <a href="{$base_dir}manufacturer.php" title="{l s='All Manufacturers' mod='blockmanufacturercarousel'}" class="button">{l s='All Manufacturers' mod='blockmanufacturercarousel'}</a>
    </p>
{else}
		<p>{l s='No manufacturer at this time' mod='blockmanufacturercarousel'}</p>
{/if}
	</div>
</div>

{literal}
<script type="text/javascript">
$(document).ready(function(){
   var manufacturer_slider = new olcSlider({
            speed: {/literal}{$timeEffet}{literal},
            duration: {/literal}{$timeTrans}{literal}});
     manufacturer_slider.init("manufacturer_slider");
});
</script>
{/literal}
<!-- /MODULE Block Manufacturers -->