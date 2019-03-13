<{include file='db:wgrealestate_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
<div class='panel-heading'>
<{$smarty.const._MA_WGREALESTATE_SELLERS_TITLE}></div>

<{foreach item=seller from=$sellers}>
	<div class='panel panel-body'>
<{include file='db:wgrealestate_sellers_list.tpl' seller=$seller}>
<{if $seller.count is div by $numb_col}>
	<br>

<{/if}>

</div>


<{/foreach}>

</div>

<{include file='db:wgrealestate_footer.tpl'}>
