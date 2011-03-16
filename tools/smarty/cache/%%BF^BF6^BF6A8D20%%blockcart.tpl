181
a:4:{s:8:"template";a:1:{s:59:"/homez.387/lilibio/www/site/modules/blockcart/blockcart.tpl";b:1;}s:9:"timestamp";i:1298626491;s:7:"expires";i:1298630091;s:13:"cache_serials";a:0:{}}
<script type="text/javascript" src="http://www.lilibio.com/shop/js/jquery/iutil.prestashop-modifications.js"></script>
<script type="text/javascript" src="http://www.lilibio.com/shop/js/jquery/ifxtransfer.js"></script>
<script type="text/javascript">
var CUSTOMIZE_TEXTFIELD = 1;
var customizationIdMessage = 'Personnalisation ';
var removingLinkText = 'supprimer cet article du panier';
</script>
<script type="text/javascript" src="http://www.lilibio.com/shop/modules/blockcart/ajax-cart.js"></script>

<!-- MODULE Block cart -->
<div id="cart_block" class="block exclusive">
	<h4>
		<a href="http://www.lilibio.com/shop/order.php">Panier</a>
				<span id="block_cart_expand" class="hidden">&nbsp;</span>
		<span id="block_cart_collapse" >&nbsp;</span>
			</h4>
	<div class="block_content">
	<!-- block summary -->
	<div id="cart_block_summary" class="collapsed">
				<span class="ajax_cart_product_txt_s hidden">articles</span>
		<span class="ajax_cart_product_txt hidden">article</span>
				<span class="ajax_cart_no_product">(vide)</span>	</div>
	<!-- block list of products -->
	<div id="cart_block_list" class="expanded">
			<p  id="cart_block_no_products">Aucun produit</p>
		
				
		<p id="cart-prices">
			<span>Exp&eacute;dition</span>
			<span id="cart_block_shipping_cost" class="price ajax_cart_shipping_cost">0,00 €</span>
			<br/>
						<span>Total</span>
			<span id="cart_block_total" class="price ajax_block_cart_total">0,00 €</span>
		</p>
						<p id="cart-buttons">
			<a href="http://www.lilibio.com/shop/order.php" class="button_small" title="Panier">Panier</a>
			<a href="http://www.lilibio.com/shop/order.php?step=1" id="button_order_cart" class="exclusive" title="Commander">Commander</a>
		</p>
	</div>
	</div>
</div>
<!-- /MODULE Block cart -->