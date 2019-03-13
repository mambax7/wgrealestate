<{include file='db:wgrealestate_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
    <div class='panel-heading'><{$smarty.const._MA_WGREALESTATE_OBJECTS_TITLE}></div>
    <div class='panel-body'>    
        <{foreach item=object from=$objects}>
            <div class='wgre-divider'>&nbsp;</div>
            <div id='obj<{$object.id}>' class='row wgre-row'>
                <{if $numb_col == 2}>
                    <div class='wgre-img-obj col-xs-6 col-sm-3'>
                <{else}>
                    <div class='wgre-img-obj col-xs-12 col-sm-6'>
                <{/if}>
					<{if $object.mainimage}>
						<a class='' href="objects.php?op=show&amp;obj_id=<{$object.id}>" title="<{$smarty.const._MA_WGREALESTATE_SHOW}>">
                            <img class='img-responsive wgre-img-object' src='<{$wgrealestate_obj_image_url}>/<{$object.id}>/medium/<{$object.mainimage}>' title='<{$object.title}>' alt='<{$object.title}>'>
                        </a>
					<{else}>
						<p><{$smarty.const._MA_WGREALESTATE_OBJECTS_NOIMAGE}></p>
                <{/if}>
                </div>
                <{if $numb_col == 2}>
                    <div class='wgre-img-obj col-xs-6 col-sm-3'>
                <{else}>
                    <div class='wgre-img-obj col-xs-12 col-sm-6'>
                <{/if}>
                    <{if $object.state_img}>
                    <img class='wgre-img-state right' src='<{$wgrealestate_icons32_url}><{$object.state_img}>' title='<{$object.title}>' alt='<{$object.title}>'>
                    <{/if}>
                    <p class='wgre-obj-title'><span class='wgre-dealtype'><{$object.dealtype}></span><{$object.title}></p>
					<p class='wgre-obj-address'><{$object.obj_postalcode}> <{$object.obj_city}></p>
					<{foreach item=cost from=$object.costs}>
						<{if $cost.costt_text}>
							<p class='wgre-obj-detail'><span class='wgre-obj-index-costname'><{$cost.costt_text}>: </span><span class='wgre-obj-index-costvalue'><{$cost.value_user}></span></p>
						<{/if}>
					<{/foreach}>
					<{foreach item=attribute_index from=$object.attributes_header}>
						<{if $attribute_index.attdef_name}>
							<p class='wgre-obj-detail'>
								<span class='wgre-obj-index-attname'><{$attribute_index.attdef_name}>: </span>
								<span class='wgre-obj-index-attvalue'>
									<{if $attribute_index.value_user}><{$attribute_index.value_user}><{else}><{$attribute_index.info}><{/if}>
								</span>
							</p>
						<{/if}>
					<{/foreach}>	
					<ul class='wgre-obj-attmisc-ul'>
					
					<{foreach item=attribute_misc from=$object.attributes_misc}>
						<li class='wgre-obj-attmisc-li'><{$attribute_misc.attdef_name}></li>
					<{/foreach}>
					</ul>
					
                    <p class='wgre-obj-link-det right'><a class='wgre-btn' href="objects.php?op=show&amp;obj_id=<{$object.id}>" title="<{$smarty.const._MA_WGREALESTATE_SHOW}>"><{$smarty.const._MA_WGREALESTATE_SHOW}></a>
					<{if $isModerator}>
						<a class='wgre-btn right' href='objects.php?op=editmode&amp;obj_id=<{$object.id}>'  title='<{$smarty.const._MA_WGREALESTATE_EDIT_START}>'><{$smarty.const._MA_WGREALESTATE_EDIT_START}></a>
                        <{if $object.elements == 0 || $object.state == $smarty.const.WGREALESTATE_STATE_ARCHIVE_VAL}>
                            <a class='wgre-btn right' href='objects.php?op=delete&amp;obj_id=<{$object.id}>'  title='<{$smarty.const._MA_WGREALESTATE_DELETE}>'><{$smarty.const._MA_WGREALESTATE_DELETE}></a>
                        <{/if}>
					<{/if}>
					</p>
                </div>
            </div>
        <{/foreach}>
    </div>
        
</div>

<{include file='db:wgrealestate_footer.tpl'}>
