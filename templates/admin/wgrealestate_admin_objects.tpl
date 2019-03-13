<!-- Header -->
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $objects_list}>
<table class='table table-bordered'>
    <thead>
        <tr class="head">
            <th class="center"><{$smarty.const._CO_WGREALESTATE_ID}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_OBJECT_TITLE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_OBJCAT_CATEGORY}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_DEALTYPE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_OBJECT_ADDRESS}></th>
			<th class="center"><{$smarty.const._CO_WGREALESTATE_OBJECT_VIEWS}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_OBJECT_SELLER_ID}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_OBJECT_STATE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_DATECREATE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_OBJECT_DATESTATE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_SUBMITTER}></th>
            <th class="center width5"><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
        </tr>
    </thead>
<{if $objects_count}>
	<tbody>
    <{foreach item=object from=$objects_list}>
        <tr class="<{cycle values='odd, even'}>">
            <td class='center'><{$object.id}></td>
            <td class="center"><{$object.title}></td>
            <td class="center"><{$object.dealtype}></td>
            <td class="center"><{$object.objcat_name}></td>
            <td class="center">
                <{$object.ctry}> <{$object.postalcode}> <{$object.city}><{$object.address}><br/>
                <{$object.geo_lng}>/<{$object.geo_lat}>
            </td>
			<td class="center"><{$object.views}></td>
            <td class="center"><{$object.seller_id}></td>
            <td class="center">(<{$object.state}>) <{$object.state_text}></td>
            <td class="center"><{$object.datecreate}></td>
            <td class="center"><{$object.datestate}></td>
            <td class="center"><{$object.submitter}></td>
            <td class="center  width5">
            <a href="objects.php?op=edit&amp;obj_id=<{$object.id}>" title="<{$smarty.const._EDIT}>">
                <img src="<{xoModuleIcons16 edit.png}>" alt="objects" />
            </a>
            <a href="objects.php?op=delete&amp;obj_id=<{$object.id}>" title="<{$smarty.const._DELETE}>">
                <img src="<{xoModuleIcons16 delete.png}>" alt="objects" />
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
