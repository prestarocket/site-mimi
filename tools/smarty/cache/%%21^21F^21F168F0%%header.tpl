178
a:4:{s:8:"template";a:1:{s:56:"/homez.387/lilibio/www/site/themes/prestashop/header.tpl";b:1;}s:9:"timestamp";i:1298626491;s:7:"expires";i:1298630091;s:13:"cache_serials";a:0:{}}<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
	<head>
		<title>LiliBio</title>
		<meta name="description" content="Boutique propulsée par PrestaShop" />
		<meta name="keywords" content="boutique, prestashop" />
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="index,follow" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="http://www.lilibio.com/shop/img/favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="http://www.lilibio.com/shop/img/favicon.ico" />
		<link href="/shop/themes/prestashop/css/global.css" rel="stylesheet" type="text/css" media="all" />
			<script type="text/javascript" src="http://www.lilibio.com/shop/js/tools.js"></script>
		<script type="text/javascript">
			var baseDir = 'http://www.lilibio.com/shop/';
			var static_token = 'b49c8a04ea15d67bd28ce067415f1a40';
			var token = '2ac8c04676d27b0f72f91669c222dc6f';
			var priceDisplayPrecision = 2;
			var roundMode = 2;
		</script>
		<script type="text/javascript" src="http://www.lilibio.com/shop/js/jquery/jquery-1.2.6.pack.js"></script>
		<script type="text/javascript" src="http://www.lilibio.com/shop/js/jquery/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="http://www.lilibio.com/shop/js/jquery/jquery.hotkeys-0.7.8-packed.js"></script>
		<!-- Block search module HEADER -->
<link rel="stylesheet" type="text/css" href="http://www.lilibio.com/shop/css/jquery.autocomplete.css" />
<script type="text/javascript" src="http://www.lilibio.com/shop/js/jquery/jquery.autocomplete.js"></script>
<!-- Block search module HEADER -->
	</head>
	
	<body id="index">
			<noscript><ul><li>Cette boutique n&eacute;cessite JavaScript afin de fonctionner correctement. Merci de l&#039;activer dans votre navigateur.</li></ul></noscript>
		<div id="page">

			<!-- Header -->
			<div id="header">
				<h1 id="logo"><a href="http://www.lilibio.com/shop/" title="LiliBio"><img src="http://www.lilibio.com/shop/img/logo.jpg" alt="LiliBio" /></a></h1>
				<div id="header_right">
					<!-- Block permanent links module HEADER -->
<ul id="header_links">
	<li id="header_link_contact"><a href="http://www.lilibio.com/shop/contact-form.php" title="contact">contact</a></li>
	<li id="header_link_sitemap"><a href="http://www.lilibio.com/shop/sitemap.php" title="plan du site">plan du site</a></li>
	<li id="header_link_bookmark">
		<script type="text/javascript">writeBookmarkLink('http://www.lilibio.com/shop/', 'LiliBio', 'favoris');</script>
	</li>
</ul>
<!-- /Block permanent links module HEADER --><!-- Block search module TOP -->
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
<!-- /Block search module TOP --><!-- Block user information module HEADER -->
<div id="header_user">
	<p id="header_user_info">
		Bienvenue,
					<a href="http://www.lilibio.com/shop/my-account.php">identifiez-vous</a>
			</p>
	<ul id="header_nav">
		<li id="shopping_cart">
			<a href="http://www.lilibio.com/shop/order.php" title="Votre panier d&#039;achat">Panier :</a>
			<span class="ajax_cart_quantity hidden">0</span>
			<span class="ajax_cart_product_txt hidden">produit</span>
			<span class="ajax_cart_product_txt_s hidden">produits</span>
						<span class="ajax_cart_no_product">(vide)</span>
		</li>
		<li id="your_account"><a href="http://www.lilibio.com/shop/my-account.php" title="Votre compte">Votre compte</a></li>
	</ul>
</div>
<!-- /Block user information module HEADER -->
				</div>
			</div>

			<div id="columns">
				<!-- Left -->
				<div id="left_column" class="column">
					<script type="text/javascript" src="http://www.lilibio.com/shop/themes/prestashop/js/tools/treeManagement.js"></script>

<!-- Block categories module -->
<div id="categories_block_left" class="block">
	<h4>Cat&eacute;gories</h4>
	<div class="block_content">
		<ul class="tree dhtml">
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=47"  title="">Accessoires bien-être</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=113"  title="">Argile en vrac</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=15"  title="">Aromathérapie</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=127"  title="">Chauffe parfum</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=35"  title="">Composition huiles essentielles à diffuser</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=36"  title="">Diffuseur éléctrique</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=129"  title="">Entretien et verrerie diffuseur</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=34"  title="">Huiles essentielles</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=120"  title="">Roll-on huile essentielle</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=9"  title="">Bain et douche</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=110"  title="">Bain moussant</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=61"  title="">Essence et huile</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=57"  title="">Gel douche</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=59"  title="">Savon</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=139"  title="">Savon pour enfant</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=58"  title="">Sel de bain</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=13"  title="">Bébé</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=52"  title="">Le bain</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=48"  title="">Le change</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=77"  title="">Le massage</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=97"  title="">Les angoisses nocturnes</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=53"  title="">Soin de la future maman</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=137"  title="">Soin de la jeune maman</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=50"  title="">Soin du corps</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=49"  title="">Soin du visage</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=14"  title="La santé des dents passe par une bonne hygiène et une alimentation équilibrée. Si l’action mécanique du brossage est primordiale, l’entretien de la vitalité des gencives l’est autant.

La muqueuse buccale constituant une zone d’absorption accrue, nos soins ne contiennent ni agents moussants tensio-actifs, ni conservateurs, colorants ou arômes de synthèse. Ils sont exempts de fluor : une alimentation équilibrée en garantit les apports nécessaires au durcissement de l’émail des dents et la complémentation en fluor en cas de carence relève de la prescription médicale.">Buccodentaire</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=112"  title="">Bain de bouche</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=111"  title="">Dentifrice</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=133"  title="">Dentifrice pour dents de lait</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=132"  title="">Soin dentaire</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=17"  title="">Cheveux</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=152"  title="">2 en 1 cheveux et corps</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=66"  title="">Cheveux à tendance grasse</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=64"  title="">Cheveux blonds</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=63"  title="">Cheveux fins et sans volume</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=68"  title="">Cheveux normaux</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=62"  title="">Cheveux secs et abîmés</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=65"  title="">Cheveux très secs</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=71"  title="">Coloration</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=69"  title="">Démêlant</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=70"  title="">Masque et huile</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=67"  title="">Pellicules</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=7"  title="">Corps</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=73"  title="">Beurre et baume</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=115"  title="">Buste</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=95"  title="">Circulation, jambes lourdes</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=31"  title="">Epilation</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=33"  title="">Gommage</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=119"  title="">Huile </a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=30"  title="">Hydratant et/ou nourrissant</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=38"  title="">Hygiène intime</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=117"  title="">Massage</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=32"  title="">Minceur</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=46"  title="">Déodorant</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=108"  title="">Pour Elle</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=109"  title="">Pour Lui</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=153"  title="Un élixir floral est une eau dans laquelle on aurait transféré le « taux vibratoire » spécifique d’une fleur. En prenant un élixir, un individu pourrait modifier son propre taux vibratoire, ce qui aurait une influence bénéfique sur ses émotions, son attitude, ses traits de caractère et indirectement sur sa santé et son bien-être.">Elixirs floraux</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=158"  title="">Etats d&#039;hypersensibilité</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=155"  title="">Etats d&#039;incertitude et de doute</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=156"  title="">Etats d&#039;intérêt insuffisant pour le présent</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=154"  title="">Etats de peur</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=159"  title="">Etats de résignation,désespoir</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=157"  title="">Etats de solitude</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=160"  title="">Etats de soucis excessifs pour les autres</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=12"  title="">Homme</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=141"  title="">Contour des yeux</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=143"  title="">Déodorant</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=142"  title="">Gel douche et savon</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=144"  title="">Nettoyant visage</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=140"  title="">Soin anti-âge</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=44"  title="">Soin du rasage</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=43"  title="">Soin hydratant visage</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=37"  title="">Huiles végétales</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=42"  title="">Mains et pieds</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=151"  title="">Hygiène des mains</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=92"  title="">Soin des mains</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=93"  title="">Soin des pieds</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=18"  title="">Maison</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=41"  title="">Batonnet parfumé</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=39"  title="">Bougie</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=126"  title="">Brume d&#039;oreiller</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=40"  title="">Parfum intérieur</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=10"  title="">Parfum</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=75"  title="">Femme</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=76"  title="">Homme</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=16"  title="">Phytothérapie</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=107"  title="">Beauté et bien être de la femme</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=150"  title="">Capillaire</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=106"  title="">Concentration</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=100"  title="">Dépuratif</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=161"  title="">Diététique</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=103"  title="">Digestion</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=105"  title="">Fleurs de Bach</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=104"  title="">Fortifiant immunitaire</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=145"  title="">Hiver et défenses naturelles</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=118"  title="">Infusions et Thés</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=101"  title="">Jambes légères</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=138"  title="">Ménopause</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=98"  title="">Minceur</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=147"  title="">Solaire</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=99"  title="">Sommeil/Détente</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=102"  title="">Souplesse/Articulation</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=130"  title="">Tonus et vitalité</a>
	</li>							</ul>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=96"  title="">Soin SOS</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=131"  title="">Brûlure</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=128"  title="">Coup de froid</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=121"  title="">Coups, bleus, bosses...</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=124"  title="">Migraine</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=123"  title="">Nausées</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=122"  title="">Piqûres insecte</a>
	</li>							</ul>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=6"  title="">Visage</a>
			<ul>
											<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=24"  title="">Contour des yeux</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=5"  title="">Démaquillant</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=25"  title="">Masque et gommage</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=20"  title="">Nettoyant</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=26"  title="">Sérum</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=56"  title="">Soin anti tâche</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=54"  title="">Soin anti-rides</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=91"  title="">Soin anti-rides de nuit</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=28"  title="">Soin de nuit</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=114"  title="">Soin des lèvres</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=21"  title="">Soin hydratant</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=22"  title="">Soin nourrissant</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=27"  title="">Soin peau jeune</a>
	</li>														<li >
	<a href="http://www.lilibio.com/shop/category.php?id_category=116"  title="">Soin teinté</a>
	</li>														<li class="last">
	<a href="http://www.lilibio.com/shop/category.php?id_category=19"  title="">Tonique et eau florale</a>
	</li>							</ul>
	</li>							</ul>
	</div>
</div>
<script type="text/javascript">
// <![CDATA[
	// we hide the tree only if JavaScript is activated
	$('div#categories_block_left ul.dhtml').hide();
// ]]>
</script>
<!-- /Block categories module --><!-- Block manufacturers module -->
<div id="manufacturers_block_left" class="block blockmanufacturer">
	<h4><a href="http://www.lilibio.com/shop/manufacturer.php" title="Laboratoires">Laboratoires</a></h4>
	<div class="block_content">
		<ul class="bullet">
					<li class="first_item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=20" title="En savoir plus &agrave; propos de Acorelle">Acorelle</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=7" title="En savoir plus &agrave; propos de Allo'nature">Allo&#039;nature</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=28" title="En savoir plus &agrave; propos de Biosystem">Biosystem</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=22" title="En savoir plus &agrave; propos de Bleu vert">Bleu vert</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=5" title="En savoir plus &agrave; propos de Cattier">Cattier</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=19" title="En savoir plus &agrave; propos de Deva">Deva</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=11" title="En savoir plus &agrave; propos de Elicey">Elicey</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=25" title="En savoir plus &agrave; propos de Emma Noël">Emma No&euml;l</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=10" title="En savoir plus &agrave; propos de Florame">Florame</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=16" title="En savoir plus &agrave; propos de Les ânes d'autan">Les &acirc;nes d&#039;autan</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=3" title="En savoir plus &agrave; propos de Les douces angevines">Les douces angevines</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=27" title="En savoir plus &agrave; propos de Marilou bio">Marilou bio</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=24" title="En savoir plus &agrave; propos de Melvita">Melvita</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=8" title="En savoir plus &agrave; propos de Natessance">Natessance</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=17" title="En savoir plus &agrave; propos de Naturaloé">Naturalo&eacute;</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=9" title="En savoir plus &agrave; propos de Oléanat">Ol&eacute;anat</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=21" title="En savoir plus &agrave; propos de Phytoceutique">Phytoceutique</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=14" title="En savoir plus &agrave; propos de Phytonature ">Phytonature </a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=15" title="En savoir plus &agrave; propos de Plante system">Plante system</a></li>
							<li class="item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=12" title="En savoir plus &agrave; propos de Tamalys">Tamalys</a></li>
							<li class="last_item"><a href="http://www.lilibio.com/shop/manufacturer.php?id_manufacturer=23" title="En savoir plus &agrave; propos de Weleda">Weleda</a></li>
				</ul>
			</div>
</div>
<!-- /Block manufacturers module --><!-- Block informations module -->
<div id="informations_block_left" class="block">
	<h4>Informations</h4>
	<ul class="block_content">
					<li><a href="http://www.lilibio.com/shop/cms.php?id_cms=1" title="Livraison">Livraison</a></li>
					<li><a href="http://www.lilibio.com/shop/cms.php?id_cms=3" title="Conditions générales de vente">Conditions générales de vente</a></li>
					<li><a href="http://www.lilibio.com/shop/cms.php?id_cms=4" title="Qui est Lili BIO?">Qui est Lili BIO?</a></li>
					<li><a href="http://www.lilibio.com/shop/cms.php?id_cms=6" title="Qu&#039;est ce que la cosmétique BIO?">Qu&#039;est ce que la cosmétique BIO?</a></li>
			</ul>
</div>
<!-- /Block informations module --><!-- MODULE Block advertising -->
<div class="advertising_block">
	<a href="" title="Publicit&eacute;"><img src="http://www.lilibio.com/shop/modules/blockadvertising/advertising.jpg" alt="Publicit&eacute;" /></a>
</div>
<!-- /MODULE Block advertising --><!-- Block payment logo module -->
<div id="paiement_logo_block_left" class="paiement_logo_block">
	<a href="http://www.lilibio.com/shop/cms.php?id_cms=5">
		<img src="http://www.lilibio.com/shop/themes/prestashop/img/logo_paiement_visa.jpg" alt="visa" />
		<img src="http://www.lilibio.com/shop/themes/prestashop/img/logo_paiement_mastercard.jpg" alt="mastercard" />
		<img src="http://www.lilibio.com/shop/themes/prestashop/img/logo_paiement_paypal.jpg" alt="paypal" />
	</a>
</div>
<!-- /Block payment logo module -->
				</div>

				<!-- Center -->
				<div id="center_column">
	