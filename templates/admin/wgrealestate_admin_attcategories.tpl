<!-- Header -->
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $attcategories_list}>
	<table class='table table-bordered'>
        <thead>
            <tr class="head">
                <th class="center"><{$smarty.const._CO_WGREALESTATE_ID}></th>
                <th class="center"><{$smarty.const._AM_WGREALESTATE_ATTCATEGORY_NAME}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_TYPE_INFO}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_WEIGHT}></th>
                <th class="center"><{$smarty.const._AM_WGREALESTATE_ATTCATEGORY_NAME_SHOW}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_TYPE_VALID}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_DATECREATE}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_SUBMITTER}></th>
                <th class="center width5"><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $attcategories_count}>
        <tbody id="sortable-attcats">
            <{foreach item=attcategory from=$attcategories_list}>
                <tr id="atcorder_<{$attcategory.id}>" order="<{$attcategory.weight}>" class="<{cycle values='odd, even'}>">
                    <td class='center'><{$attcategory.id}></td>
                    <td class="center"><{$attcategory.name}></td>
                    <td class="center"><{$attcategory.info}></td>
                    <td class="center"><{$attcategory.weight}></td>
                    <td class="center">
						<{if $attcategory.show == 1}>
							<a href="attcategories.php?op=edit_show&amp;attcat_show=<{$attcategory.show}>&amp;attcat_id=<{$attcategory.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>ok.png" alt="attdefaults" /></a>
						<{else}>
							<a href="attcategories.php?op=edit_show&amp;attcat_show=<{$attcategory.show}>&amp;attcat_id=<{$attcategory.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>off.png" alt="attdefaults" /></a>
						<{/if}>		
					
					
					</td>
                    <td class="center">
						<{if $attcategory.valid == 1}>
							<a href="attcategories.php?op=edit_valid&amp;attcat_valid=<{$attcategory.valid}>&amp;attcat_id=<{$attcategory.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>ok.png" alt="attdefaults" /></a>
						<{else}>
							<a href="attcategories.php?op=edit_valid&amp;attcat_valid=<{$attcategory.valid}>&amp;attcat_id=<{$attcategory.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>off.png" alt="attdefaults" /></a>
						<{/if}>		
					</td>
                    <td class="center"><{$attcategory.datecreate}></td>
                    <td class="center"><{$attcategory.submitter}></td>
                    <td class="center  width5">
                    <a href="attcategories.php?op=edit&amp;attcat_id=<{$attcategory.id}>" title="<{$smarty.const._EDIT}>">
                        <img src="<{xoModuleIcons16 edit.png}>" alt="attcategories" />
                    </a>
                    <a href="attcategories.php?op=delete&amp;attcat_id=<{$attcategory.id}>" title="<{$smarty.const._DELETE}>">
                        <img src="<{xoModuleIcons16 delete.png}>" alt="attcategories" />
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
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>
<br>
<!-- Footer --><{include file='db:wgrealestate_admin_footer.tpl'}>
