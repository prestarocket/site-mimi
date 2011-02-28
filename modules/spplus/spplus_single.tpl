<script type="text/javascript">
<!--
   self.name = "sitecom";

   function Ouvrir_Spplus()
   {literal}{{/literal}
   	var PopupSpplus_largeur	= 750;
   	var PopupSpplus_hauteur	= 560;

  	var PopupSpplus_top	=((screen.height-PopupSpplus_hauteur)/2);
   	var PopupSpplus_left	=((screen.width-PopupSpplus_largeur)/2);

   	var win = window.open('', "SPPLUS","status=yes,top="+PopupSpplus_top+",left="+PopupSpplus_left+",width="+PopupSpplus_largeur+",height="+PopupSpplus_hauteur);
   	win.focus();
   {literal}}{/literal}
// -->
</script>
<p class="payment_module">
	<a target="SPPLUS" onclick="Ouvrir_Spplus();" href="{$url_calculhmac}" target="_blank" title="{l s='Pay with SPPlus' mod='spplus'}" style="cursor: pointer;">
		<img src="{$module_template_dir}spplus.gif" alt="{l s='Pay with SPPlus' mod='spplus'}" />
		{l s='Pay with SPPlus' mod='spplus'}
	</a>
</p>