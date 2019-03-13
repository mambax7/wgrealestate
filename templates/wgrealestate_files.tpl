<{include file='db:wgrealestate_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
    <div class='panel-heading'><{$smarty.const._CO_WGREALESTATE_FILES_TITLE}></div>
    
    <div class='panel panel-body'>
        <{if $editmode}>
            <div class='wgre-obj-editmode-left col-xs-12 col-sm-12'>
				<{if $files}> 
					<{$smarty.const._CO_WGREALESTATE_FILES}>
				<{else}>
					<{$smarty.const._CO_WGREALESTATE_THEREARENT_FILES}>
				<{/if}>
            </div>
            <span id="sortable-files"> 
                <{foreach item=file from=$files}>
                    <div id="forder_<{$file.id}>" order="<{$file.weight}>" class="wgre-obj-detail-row col-xs-12 col-sm-12">
                        <div class='wgre-obj-detail-left col-xs-1 col-sm-1'><img src="<{$wgrealestate_icon_url_16}>drag.png" alt="<{$smarty.const._MA_WGREALESTATE_SORTABLE_MOVE}>" /></div>
                        <div class='wgre-obj-detail-left col-xs-2 col-sm-2'>
                            <img class='img-responsive wgre-img-icon' src='<{$wgrealestate_icon_url}>/<{$file.icon}>' title='<{$file.title}>' alt='<{$file.title}>'>
                        </div>
                        <div class='wgre-obj-detail-right-- col-xs-9 col-sm-9'>
                            <p><{$smarty.const._CO_WGREALESTATE_FILE_TITLE}>: <{$file.title}></p>
							<p><{$smarty.const._CO_WGREALESTATE_FILE_INFO}>: <{$file.info}></p>
							<p><{$smarty.const._CO_WGREALESTATE_FILE_NAME}>: <{$file.name}></p>
							<p><{$smarty.const._CO_WGREALESTATE_FILE_TYPE}>: <{$file.type}></p>
                            <p><{$smarty.const._CO_WGREALESTATE_FILE_SIZE}>: <{$file.size}></p>
                            <p class="wgre-filedownload">
                                <a class='wgre-btn' href='files.php?op=edit_single&amp;obj_id=<{$file.obj_id}>&amp;file_id=<{$file.id}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
                                <a class='wgre-btn' href='files.php?op=delete&amp;obj_id=<{$file.obj_id}>&amp;file_id=<{$file.id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
								<a class='wgre-btn' href='<{$wgrealestate_obj_file_url}><{$file.name}>'  download title='<{$smarty.const._CO_WGREALESTATE_DOWNLOAD}>'><{$smarty.const._CO_WGREALESTATE_DOWNLOAD}></a>
                            </p>
                        </div>
                    </div>
                <{/foreach}>
            </span>
            <div class='wgre-obj-detail-footer right col-xs-12 col-sm-12'>
                <{if $isModerator && $editmode}> 
                    <a class='wgre-obj-detail-footer-btn wgre-btn right' href='files.php?op=new&amp;obj_id=<{$obj_id}>' title='<{$smarty.const._CO_WGREALESTATE_FILE_ADD}>'><{$smarty.const._CO_WGREALESTATE_FILE_ADD}></a>
                 <{/if}>
                <a class='wgre-obj-detail-footer-btn wgre-btn right' href='objects.php?op=editmode&amp;obj_id=<{$obj_id}>' title='<{$smarty.const._MA_WGREALESTATE_BACK_OBJECT_EDIT}>'><{$smarty.const._MA_WGREALESTATE_BACK_OBJECT_EDIT}></a>
            </div>
        <{/if}>
    </div>
</div>
<{if $form}>
    <{$form}>
<{/if}>
<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>
<{if $confirm_delete}>
	<{$confirm_delete}>
<{/if}>

<{include file='db:wgrealestate_footer.tpl'}>