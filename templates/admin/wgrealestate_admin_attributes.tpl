<!-- Header -->
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $attributes_list}>
<table class='table table-bordered'>
	<thead>
        <tr class="head">
            <th class="center"><{$smarty.const._CO_WGREALESTATE_ID}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_OBJECTS}></th>
            <th class="center"><{$smarty.const._AM_WGREALESTATE_ATTDEFAULTS}></th>
            <th class="center"><{$smarty.const._AM_WGREALESTATE_ATTRIBUTES_INFO}></th>
            <th class="center"><{$smarty.const._AM_WGREALESTATE_ATTRIBUTES_VALUE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_WEIGHT}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_DATECREATE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_SUBMITTER}></th>
            <th class="center width5"><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
        </tr>
    </thead>
<{if $attributes_count}>
	<tbody id="sortable-objatts" >
    <{foreach item=attribute from=$attributes_list}>
        <tr id="oaorder_<{$attribute.id}>" order="<{$attribute.weight}>" class="<{cycle values='odd, even'}>">
            <td class='center'><{$attribute.id}></td>
            <td class="center"><{$attribute.obj_title}></td>
            <td class="center"><{$attribute.attdef_name}></td>
            <td class="center"><{$attribute.info}></td>
            <td class="center"><{$attribute.value}></td>
            <td class="center"><{$attribute.weight}></td>
            <td class="center"><{$attribute.datecreate}></td>
            <td class="center"><{$attribute.submitter}></td>
            <td class="center  width5">
                <a href="attributes.php?op=edit&amp;att_id=<{$attribute.id}>" title="<{$smarty.const._EDIT}>">
                    <img src="<{xoModuleIcons16 edit.png}>" alt="attributes" />
                </a>
                <a href="attributes.php?op=delete&amp;att_id=<{$attribute.id}>" title="<{$smarty.const._DELETE}>">
                    <img src="<{xoModuleIcons16 delete.png}>" alt="attributes" />
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
