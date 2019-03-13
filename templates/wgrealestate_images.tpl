<{include file='db:wgrealestate_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
    <div class='panel-heading'><{$smarty.const._CO_WGREALESTATE_IMAGES_TITLE}></div>
    
    <div class='panel panel-body'>
        <{if $editmode}>
            <div class='wgre-obj-editmode-left col-xs-12 col-sm-12'>
				<{if $images}> 
					<{$smarty.const._CO_WGREALESTATE_IMAGES}>
				<{else}>
					<{$smarty.const._CO_WGREALESTATE_THEREARENT_IMAGES}>
				<{/if}>
			</div>
            <span id="sortable-images"> 
                <{foreach item=image from=$images}>
                    <div id="iorder_<{$image.id}>" order="<{$image.weight}>" class="wgre-obj-detail-row col-xs-12 col-sm-12">
                        <div class='wgre-obj-detail-left col-xs-1 col-sm-1'><img src="<{$wgrealestate_icon_url_16}>drag.png" alt="<{$smarty.const._MA_WGREALESTATE_SORTABLE_MOVE}>" /></div>
                        <div class='wgre-obj-detail-left col-xs-6 col-sm-6'>
                            <img class='img-responsive wgre-img-main wgre-img-edit' src='<{$wgrealestate_obj_image_url}>medium/<{$image.name}>' title='<{$image.title}>' alt='<{$image.title}>'>
                        </div>
                        <div class='wgre-obj-detail-right col-xs-5 col-sm-5'>
                            <p><{$smarty.const._CO_WGREALESTATE_IMAGE_TITLE}>: <{$image.title}></p>
                            <p><{$smarty.const._CO_WGREALESTATE_IMAGE_INFO}>: <{$image.info}></p>
                            <p><{$smarty.const._CO_WGREALESTATE_IMAGE_NAME}>: <{$image.name}></p>
                            <p><{$smarty.const._CO_WGREALESTATE_IMAGE_DIM}>: <{$image.width}>x<{$image.height}></p>
                            <p><{$smarty.const._CO_WGREALESTATE_IMAGE_SIZE}>: <{$image.size}></p>
                            <p>
                                <a class='wgre-btn right' href='images.php?op=edit_single&amp;obj_id=<{$image.obj_id}>&amp;img_id=<{$image.id}>' title='<{$smarty.const._EDIT}>'><{$smarty.const._EDIT}></a>
                                <a class='wgre-btn right' href='images.php?op=delete&amp;obj_id=<{$image.obj_id}>&amp;img_id=<{$image.id}>' title='<{$smarty.const._DELETE}>'><{$smarty.const._DELETE}></a>
                            </p>
                        </div>
                    </div>
                <{/foreach}>
            </span>
            <div class='wgre-obj-detail-footer right col-xs-12 col-sm-12'>
                <{if $isModerator && $editmode}> 
                    <a class='wgre-obj-detail-footer-btn wgre-btn right' href='images.php?op=new&amp;obj_id=<{$obj_id}>' title='<{$smarty.const._CO_WGREALESTATE_IMAGE_ADD}>'><{$smarty.const._CO_WGREALESTATE_IMAGE_ADD}></a>
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
