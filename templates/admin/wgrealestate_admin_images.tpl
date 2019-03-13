<!-- Header -->
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $images_list}>
    <table class='table table-bordered'>
        <thead>
            <tr class="head">
                <th class="center"><{$smarty.const._CO_WGREALESTATE_ID}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_OBJECTS}></th>
                <th class="center"><{$smarty.const._AM_WGREALESTATE_IMAGE}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_IMAGE_TITLE}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_IMAGE_INFO}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_IMAGE_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGREALESTATE_IMAGE_DIM}></th>
                <th class="center"><{$smarty.const._AM_WGREALESTATE_IMAGE_SIZE}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_WEIGHT}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_DATECREATE}></th>
                <th class="center"><{$smarty.const._CO_WGREALESTATE_SUBMITTER}></th>
                <th class="center width5"><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $images_count}>
            <tbody>
            <{foreach item=image from=$images_list}>
                <tr class="<{cycle values='odd, even'}>">
                    <td class='center'><{$image.id}></td>
                    <td class="center"><{$image.obj_title}></td>
                    <td class="center"><img src="<{$wgrealestate_upload_url}>/images/objects/<{$image.obj_id}>/small/<{$image.name}>" alt="<{$image.name}>" style="max-width:50px" /></td>
                    <td class="center"><{$image.title}></td>
                    <td class="center"><{$image.info}></td>
                    <td class="center"><{$image.name}></td>
                    <td class="center"><{$image.width}>x<{$image.height}></td>
                    <td class="center"><{$image.size}></td>
                    <td class="center"><{$image.weight}></td>
                    <td class="center"><{$image.datecreate}></td>
                    <td class="center"><{$image.submitter}></td>
                    <td class="center  width5">
                    <a href="images.php?op=edit&amp;img_id=<{$image.id}>" title="<{$smarty.const._EDIT}>">
                        <img src="<{xoModuleIcons16 edit.png}>" alt="images" />
                    </a>
                    <a href="images.php?op=delete&amp;img_id=<{$image.id}>" title="<{$smarty.const._DELETE}>">
                        <img src="<{xoModuleIcons16 delete.png}>" alt="images" />
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
