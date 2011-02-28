{if $status == 'ok'}
	<p>{l s='Your transaction with' mod='spplus'} <span class="bold">{$shop_name}</span> {l s='is complete.' mod='spplus'}
		<br /><br />
		<br /><br />- {l s='Awaitting for validation' mod='spplus'} <span class="price">{$total_to_pay}</span>
		<br /><br />{l s='For any questions or for further information, please contact our' mod='spplus'} <a href="{$base_dir}contact-form.php">{l s='customer support' mod='spplus'}</a>.
	</p>
{else}
	<p class="warning">
		{l s='We noticed a problem with your order. If you think this is an error, you can contact our' mod='spplus'} 
		<a href="{$base_dir}contact-form.php">{l s='customer support' mod='spplus'}</a>.
	</p>
{/if}
