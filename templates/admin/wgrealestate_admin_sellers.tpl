<!-- Header -->
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $sellers_list}>
	<table class='table table-bordered'>
	<thead><tr class="head"><th class="center"><{$smarty.const._CO_WGREALESTATE_ID}></th>
<th class="center"><{$smarty.const._AM_WGREALESTATE_SELLER_NAME}></th>
<th class="center"><{$smarty.const._AM_WGREALESTATE_SELLER_CTRY}></th>
<th class="center"><{$smarty.const._AM_WGREALESTATE_SELLER_POSTAL_CODE}></th>
<th class="center"><{$smarty.const._AM_WGREALESTATE_SELLER_CITY}></th>
<th class="center"><{$smarty.const._AM_WGREALESTATE_SELLER_ADDRESS}></th>
<th class="center"><{$smarty.const._AM_WGREALESTATE_SELLER_PHONE}></th>
<th class="center"><{$smarty.const._AM_WGREALESTATE_SELLER_MAIL}></th>
<th class="center"><{$smarty.const._AM_WGREALESTATE_SELLER_CAT}></th>
<th class="center"><{$smarty.const._AM_WGREALESTATE_SELLER_PUBLIC}></th>
<th class="center"><{$smarty.const._CO_WGREALESTATE_DATECREATE}></th>
<th class="center"><{$smarty.const._CO_WGREALESTATE_SUBMITTER}></th>
<th class="center width5"><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
</tr>

</thead>
<{if $sellers_count}>
	<tbody><{foreach item=seller from=$sellers_list}>
	<tr class="<{cycle values='odd, even'}>"><td class='center'><{$seller.id}></td><td class="center"><{$seller.name}></td>
<td class="center"><{$seller.ctry}></td>
<td class="center"><{$seller.postal_code}></td>
<td class="center"><{$seller.city}></td>
<td class="center"><{$seller.address}></td>
<td class="center"><{$seller.phone}></td>
<td class="center"><{$seller.mail}></td>
<td class="center"><{$seller.cat}></td>
<td class="center"><{$seller.public}></td>
<td class="center"><{$seller.datecreate}></td>
<td class="center"><{$seller.submitter}></td>
<td class="center  width5">
<a href="sellers.php?op=edit&amp;seller_id=<{$seller.id}>" title="<{$smarty.const._EDIT}>">
	<img src="<{xoModuleIcons16 edit.png}>" alt="sellers" />
</a>
<a href="sellers.php?op=delete&amp;seller_id=<{$seller.id}>" title="<{$smarty.const._DELETE}>">
	<img src="<{xoModuleIcons16 delete.png}>" alt="sellers" />
</a>
</td>
</tr>

<{/foreach}>
</tbody>

<{/if}>

</table>
<div class="clear">&nbsp;</div>
<{if $pagenav}>
	<div class="xo-pagenav floatright"><{$pagenav}></div>
<div class="clear spacer"></div>

<{/if}>

<{/if}>
<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong>
</div>

<{/if}>
<br>
<!-- Footer --><{include file='db:wgrealestate_admin_footer.tpl'}>
