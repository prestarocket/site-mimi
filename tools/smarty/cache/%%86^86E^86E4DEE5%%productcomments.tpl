194
a:4:{s:8:"template";a:1:{s:72:"/homez.387/lilibio/www/site/modules/productcomments//productcomments.tpl";b:1;}s:9:"timestamp";i:1298626483;s:7:"expires";i:1298630083;s:13:"cache_serials";a:0:{}}<div id="idTab5">
<script type="text/javascript" src="/shop/modules/productcomments/js/jquery.rating.pack.js"></script>
<script type="text/javascript">
	$(function(){ $('input[@type=radio].star').rating(); });
	$(function(){
		$('.auto-submit-star').rating({
			callback: function(value, link){
			}
		});
	});
	
	//close  comment form
	function closeCommentForm(){
		$('#sendComment').slideUp('fast');
		$('input#addCommentButton').fadeIn('slow');
	}
</script>
	<p class="align_center">Aucun commentaire n&#039;a &eacute;t&eacute; publi&eacute; pour le moment.</p>
	<p class="align_center">Seuls les utilisateurs enregistr&eacute;s peuvent poster des commentaires.</p>
</div>