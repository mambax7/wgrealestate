<!-- Header -->
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $attdefaults_list}>
<table class='table table-bordered'>
	<thead>
        <tr class="head">
			<th class="center"><{$smarty.const._CO_WGREALESTATE_ID}></th>
			<th class="center"><{$smarty.const._AM_WGREALESTATE_ATTDEFAULTS_PARENT}></th>
            <th class="center"><{$smarty.const._AM_WGREALESTATE_ATTDEFAULTS_NAME}></th>
            <th class="center"><{$smarty.const._AM_WGREALESTATE_ATTDEFAULTS_TYPE}></th>
            <th class="center"><{$smarty.const._AM_WGREALESTATE_DEALTYPES}></th>
            <th class="center"><{$smarty.const._AM_WGREALESTATE_ATTCATEGORY_NAME}></th>
			<th class="center"><{$smarty.const._CO_WGREALESTATE_INDEX_SHOW}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_WEIGHT}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_TYPE_VALID}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_DATECREATE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_SUBMITTER}></th>
            <th class="center width5"><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
        </tr>
    </thead>
<{if $attdefaults_count}>
	<tbody id="sortable-attdefs"><{foreach item=attdefault from=$attdefaults_list}>
        <tr id="attdeforder_<{$attdefault.id}>" order="<{$attdefault.weight}>" class="<{cycle values='odd, even'}>">
            <td class='center'><{$attdefault.id}></td>
			<td class="center"><{$attdefault.parent}></td>
            <td class="center"><{$attdefault.name}></td>
            <td class="center">(<{$attdefault.type}>) <{$attdefault.type_text}></td>
            <td class="center">(<{$attdefault.dealtype_id}>) <{$attdefault.dealtype}></td>
            <td class="center">(<{$attdefault.attcat_id}>) <{$attdefault.attcat_name}></td>
			<td class="center"><{$attdefault.index_text}></td>
            <td class="center"><{$attdefault.weight}></td>
            <td class="center">
				<{if $attdefault.valid == 1}>
					<a href="attdefaults.php?op=edit_valid&amp;attdef_valid=<{$attdefault.valid}>&amp;attdef_id=<{$attdefault.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>ok.png" alt="attdefaults" /></a>
				<{else}>
					<a href="attdefaults.php?op=edit_valid&amp;attdef_valid=<{$attdefault.valid}>&amp;attdef_id=<{$attdefault.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>off.png" alt="attdefaults" /></a>
				<{/if}>		
			</td>
            <td class="center"><{$attdefault.datecreate}></td>
            <td class="center"><{$attdefault.submitter}></td>
            <td class="center  width5">
                <a href="attdefaults.php?op=edit&amp;attdef_id=<{$attdefault.id}>" title="<{$smarty.const._EDIT}>">
                    <img src="<{xoModuleIcons16 edit.png}>" alt="attdefaults" />
                </a>
                <a href="attdefaults.php?op=delete&amp;attdef_id=<{$attdefault.id}>" title="<{$smarty.const._DELETE}>">
                    <img src="<{xoModuleIcons16 delete.png}>" alt="attdefaults" />
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
