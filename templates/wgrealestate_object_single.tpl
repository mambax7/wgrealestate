<{include file='db:wgrealestate_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
    <div class='panel-heading'>    </div>
    <div class='panel-body'>
        <{if $list}>
            			
			<{if $editmode}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-8 col-sm-8'>
						<{$smarty.const._CO_WGREALESTATE_IMAGES}>
					</div>
					<div class='wgre-obj-header-right right col-xs-4 col-sm-4'>
						<a class='wgre-btn right' href='images.php?op=edit&amp;obj_id=<{$object.id}>' title='<{$smarty.const._CO_WGREALESTATE_IMAGE_EDIT}>'><{$smarty.const._CO_WGREALESTATE_IMAGE_EDIT}></a>
					</div>
				</div>
			<{/if}>
			
			<{if $images_nb > 0}>
				<div class="row wgre-obj-detail-row col-xs-12 col-sm-12">
					 <{if $images_nb > 1}>
						<div class='clear'></div>
						<div class='row wgre-img-gallery'>
							<ul class='pgwSlideshow'>
								<{foreach item=image from=$images}>
									<li><img src='<{$wgrealestate_obj_image_url}>/<{$object.id}>/medium/<{$image.name}>' alt='<{$image.title}>' title='<{$image.title}>' data-description='<{$image.info}>'></li>
								<{/foreach}>
							</ul>
						</div>
					<{else}>
						<div class='wgre-img-obj col-xs-12 col-sm-12 center'>
							<{if $object.mainimage}>
								<img class='img-responsive center wgre-img-main' src='<{$wgrealestate_obj_image_url}>/<{$object.id}>/medium/<{$object.mainimage}>' title='<{$image.title}>' alt='<{$image.title}>'>
							<{/if}> 
						</div>
					<{/if}> 
				</div>
			<{/if}> 
			
			<{if $object.title}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-title wgre-obj-header-left left col-xs-8 col-sm-8'>
						<span class='wgre-dealtype'><{$object.dealtype}></span><{$object.title}>
					</div>
					<div class='wgre-obj-header-right right col-xs-4 col-sm-4'>
						<{if $editmode}> 
							<a class='wgre-btn right' href='objects.php?op=edit&amp;obj_id=<{$object.id}>' title='<{$smarty.const._CO_WGREALESTATE_OBJECT_EDIT}>'><{$smarty.const._CO_WGREALESTATE_OBJECT_EDIT}></a>
						<{/if}>
					</div>
				</div>
			<{/if}>

            <{if $object.objcat_name  || $editmode}>   
                <div class='row wgre-obj-detail-row col-xs-12 col-sm-12'>
                    <div class='wgre-obj-detail-left col-xs-12 col-sm-2'>
                        <{$smarty.const._CO_WGREALESTATE_OBJCAT_CATEGORY}>
                    </div>
                    <div class='wgre-obj-detail-right col-xs-12 col-sm-10'>
                        <{$object.objcat_name}>
                    </div>
                </div>
            <{/if}>
            <{if $object.ctry  || $object.postalcode || $object.city || $object.obj_address}>   
                <div class='row wgre-obj-detail-row col-xs-12 col-sm-12'>
                    <div class='wgre-obj-detail-left col-xs-12 col-sm-2'>
                        <{$smarty.const._CO_WGREALESTATE_OBJECT_ADDRESS}>
                    </div>
                    <div class='wgre-obj-detail-right col-xs-12 col-sm-10'>
						<{if $object.obj_address}><p><{$object.obj_address}></p><{/if}>
                        <{if $object.postalcode || $object.city}>
							<p><{if $object.ctry}><{$object.ctry}>-<{/if}><{$object.postalcode}> <{$object.city}></p>
						<{/if}>
                    </div>
                </div>
            <{/if}>
            <{if $object.descr}>   
                <div class='row wgre-obj-detail-row col-xs-12 col-sm-12'>
                    <div class='wgre-obj-detail-left col-xs-12 col-sm-2'>
                        <{$smarty.const._CO_WGREALESTATE_OBJECT_DESCR}>
                    </div>
                    <div class='wgre-obj-detail-right col-xs-12 col-sm-10'>
                        <{$object.obj_descr}>
                    </div>
                </div>
            <{/if}>
            <{if $object.infos}>   
                <div class='row wgre-obj-detail-row col-xs-12 col-sm-12'>
                    <div class='wgre-obj-detail-left col-xs-12 col-sm-2'>
                        <{$smarty.const._CO_WGREALESTATE_OBJECT_INFOS}>
                    </div>
                    <div class='wgre-obj-detail-right col-xs-12 col-sm-10'>
                        <{$object.obj_infos}>
                    </div>
                </div>
            <{/if}>
            <{if $object.misc}>   
                <div class='row wgre-obj-detail-row col-xs-12 col-sm-12'>
                    <div class='wgre-obj-detail-left col-xs-12 col-sm-2'>
                        <{$smarty.const._CO_WGREALESTATE_OBJECT_MISC}>
                    </div>
                    <div class='wgre-obj-detail-right col-xs-12 col-sm-10'>
                        <{$object.misc}>
                    </div>
                </div>
            <{/if}>
            <{if $object.location}>   
                <div class='row wgre-obj-detail-row col-xs-12 col-sm-12'>
                    <div class='wgre-obj-detail-left col-xs-12 col-sm-2'>
                        <{$smarty.const._CO_WGREALESTATE_OBJECT_LOCATION}>
                    </div>
                    <div class='wgre-obj-detail-right col-xs-12 col-sm-10'>
                        <{$object.location}>
                    </div>
                </div>
            <{/if}>
			
			<{if $editmode}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-12 col-sm-8'>
						<{$smarty.const._MA_WGREALESTATE_ATTRIBUTES}>
					</div>
					<div class='wgre-obj-header-right right col-xs-12 col-sm-4'>
						<a class='wgre-btn right' href='attributes.php?op=edit&amp;obj_id=<{$object.id}>' title='<{$smarty.const._CO_WGREALESTATE_ATTRIBUTES_EDIT}>'><{$smarty.const._CO_WGREALESTATE_ATTRIBUTES_EDIT}></a>
					</div>
				</div>
				<span id="sortable-objatts">
			<{else}>
				<span id="nonsortable-objatts">
			<{/if}>
			
			<{if $defaultmode && $attributes}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-12 col-sm-12'>
						<{$smarty.const._MA_WGREALESTATE_ATTRIBUTES}>
					</div>
				</div>
			<{/if}>	

			<{foreach item=attribute name=attribute from=$attributes}>
				<{if $editmode}>
					<{if $attribute.value || $attribute.info}>    
						<div id="aorder_<{$attribute.id}>" order="<{$attribute.weight}>" class="row wgre-obj-detail-row col-xs-12 col-sm-12">
							<{if $attribute.attcat_name}> 
								<div class='wgre-obj-header-left col-xs-12 col-sm-12'><{$attribute.attcat_name}></div>
							<{/if}>
							<div class='wgre-obj-detail-left col-xs-12 col-sm-4'>
							<{if $editmode}>
								<img src="<{$wgrealestate_icon_url_16}>drag.png" alt="<{$smarty.const._MA_WGREALESTATE_SORTABLE_MOVE}>" />
							<{/if}>
							<{$attribute.attdef_name}>
							</div>
							<div class='wgre-obj-detail-right col-xs-12 col-sm-8'>
								<{if $attribute.value_user}><p><{$attribute.value_user}></p><{/if}>
								<{if $attribute.info}><p><{$attribute.info_user}></p><{/if}>
							</div>
							<{if $attribute.attdef_type == $smarty.const.WGREALESTATE_ATTR_TEXT_KWH_VAL}>
								<div class='clear'></div>
								<div class='col-xs-12 col-sm-12'><div class='none' style='margin-left:<{$attribute.kwh_left}>%'>&nbsp;<i style='display:inline;' class='glyphicon glyphicon-arrow-down'></i></div></div>
								<div class='col-xs-12 col-sm-12'>
									<img class='img-responsive wgre-kwh-img' src='<{$wgrealestate_url}>/assets/images/kwh.png' alt='<{$planimage.title}>' title='<{$attribute.attdef_name}>'  alt='<{$attribute.attdef_name}>'>
								</div>		
							<{/if}>
						</div>
					<{/if}>
				<{else}>
					<{if $attribute.value || $attribute.info}>    
						<{if $attribute.attcat_name}>
							<div class='clear'></div>
							<div class="row wgre-obj-detail-row col-xs-12 col-sm-12">
								<div class='wgre-obj-header-left col-xs-12 col-sm-12'><{$attribute.attcat_name}></div>
							</div>
						<{/if}>
							<div class='wgre-obj-detail-left col-xs-12 col-sm-2'>
								<{$attribute.attdef_name}>
							</div>
							<div class='wgre-obj-detail-right col-xs-12 col-sm-4'>
								<{if $attribute.value_user}><p><{$attribute.value_user}></p><{/if}>
                                <{if $attribute.value_user_yes || $attribute.info}>
                                    <p>
                                    <{if $attribute.value_user_yes}><img class='wgre-img-yes' src='<{$wgrealestate_icon_url_32}>yes.png' alt='<{$attribute.value_user}>' title='<{$attribute.value_user}>'  alt='<{$attribute.value_user}>'><{/if}>
                                    <{if $attribute.info}><{$attribute.info_user}><{/if}>
                                    </p>
                                <{/if}>
							</div>
							<{if $attribute.attdef_type == $smarty.const.WGREALESTATE_ATTR_TEXT_KWH_VAL}>
								<div class='clear'></div>
								<div class='col-xs-12 col-sm-6'><div class='none' style='margin-left:<{$attribute.kwh_left}>%'>&nbsp;<i style='display:inline;' class='glyphicon glyphicon-arrow-down'></i></div></div>					
								<div class='clear'></div>
								<div class='col-xs-12 col-sm-6'>
									<img class='img-responsive' src='<{$wgrealestate_url}>/assets/images/kwh.png' alt='<{$planimage.title}>' title='<{$attribute.attdef_name}>'  alt='<{$attribute.attdef_name}>'>
								</div>	
							<{/if}>
							<{if $attribute.counteratt == 2}>
                                <div class='clear'></div>
                            <{/if}>
					<{/if}>
				<{/if}>
			<{/foreach}>
			</span>
			
			<{if $editmode}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-8 col-sm-8'>
						<{$smarty.const._MA_WGREALESTATE_COSTS}>
					</div>
					<div class='wgre-obj-header-right right col-xs-4 col-sm-4'>
						<a class='wgre-btn right' href='costs.php?op=edit&amp;obj_id=<{$object.id}>' title='<{$smarty.const._CO_WGREALESTATE_COST_EDIT}>'><{$smarty.const._CO_WGREALESTATE_COST_EDIT}></a>
					</div>
				</div>
				<span id="sortable-costs">
			<{else}>
				<span id="nonsortable-costs">
			<{/if}>
			
			<{if $defaultmode && $costs}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-12 col-sm-12'>
						<{$smarty.const._MA_WGREALESTATE_COSTS}>
					</div>
				</div>
			<{/if}>	

            <{foreach item=cost from=$costs}>
                <{if $cost.value || $cost.info}>    
                    <div id="corder_<{$cost.id}>" order="<{$cost.weight}>" class="row wgre-obj-detail-row col-xs-12 col-sm-12">
                        <div class='wgre-obj-detail-left col-xs-12 col-sm-4'>
							<{if $editmode}><img src="<{$wgrealestate_icon_url_16}>drag.png" alt="<{$smarty.const._MA_WGREALESTATE_SORTABLE_MOVE}>" /><{/if}>
                            <{$cost.costt_text}>
                        </div>
                        <div class='wgre-obj-detail-right col-xs-12 col-sm-8'>
                            <{if $cost.value}>
								<p><{$cost.value_user}> <{if $cost.perc}>(<{$cost.perc}>%)<{/if}></p>
							<{/if}>
							<{if $cost.info}><p><{$cost.info}></p><{/if}>
                        </div>
                    </div>
                <{/if}>
            <{/foreach}>
            </span>
			<{if $sum_costs}>
				<div class="row wgre-obj-detail-row col-xs-12 col-sm-12">
					<div class='wgre-obj-detail-left col-xs-12 col-sm-4'>
						<{$sum_cost_typ}>
					</div>
					<div class='wgre-obj-detail-right col-xs-12 col-sm-8'>
						<{$sum_costs}>
					</div>
				</div>
			<{/if}>

			<{if $editmode}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-8 col-sm-8'>
						<{$smarty.const._CO_WGREALESTATE_IMAGES_PLAN_TITLE}>
					</div>
					<div class='wgre-obj-header-right right col-xs-4 col-sm-4'>
						<a class='wgre-btn right' href='images.php?op=edit&amp;obj_id=<{$object.id}>' title='<{$smarty.const._CO_WGREALESTATE_IMAGE_EDIT}>'><{$smarty.const._CO_WGREALESTATE_IMAGE_EDIT}></a>
					</div>
				</div>
			<{/if}>
			
			<{if $defaultmode && $planimages}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-12 col-sm-12'>
						<{$smarty.const._CO_WGREALESTATE_IMAGES_PLAN_TITLE}>
					</div>
				</div>
			<{/if}>	

			<{if $plans_nb > 0}>
				<div class="row wgre-obj-detail-row col-xs-12 col-sm-12">
					 <{if $plans_nb > 1}>
						<div class='clear'></div>
						<div class='row wgre-img-gallery'>
							<ul class='pgwSlideshowPlan'>
								<{foreach item=planimage from=$planimages}>
									<li><img src='<{$wgrealestate_obj_image_url}>/<{$object.id}>medium/<{$planimage.name}>' alt='<{$planimage.title}>' title='<{$planimage.title}>' data-description='<{$planimage.info}>'></li>
								<{/foreach}>
							</ul>
						</div>
					<{else}>
						<div class='wgre-img-obj col-xs-12 col-sm-12 center'>
							<{if $object.plan_image}>
								<img class='img-responsive wgre-img-main' src='<{$wgrealestate_obj_image_url}>/<{$object.id}>/medium/<{$object.mainimage}>' title='<{$object.name}>' alt='<{$object.name}>'>
							<{/if}> 
						</div>
					<{/if}> 
				</div>
			<{/if}> 
			
			<div class='clear'></div>
			
			<{if $editmode}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-8 col-sm-8'>
						<{$smarty.const._CO_WGREALESTATE_OBJECT_GEOCOORDS}>
					</div>
					<div class='wgre-obj-header-right right col-xs-4 col-sm-4'>
						<a class='wgre-btn right' href='geocoords.php?op=edit&amp;obj_id=<{$object.id}>' title='<{$smarty.const._CO_WGREALESTATE_OBJECT_GEOCOORDS_EDIT}>'><{$smarty.const._CO_WGREALESTATE_OBJECT_GEOCOORDS_EDIT}></a>
					</div>
				</div>
			<{/if}>
			
			<{if $defaultmode && $obj_geo_placeid}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-12 col-sm-12'>
						<{$smarty.const._CO_WGREALESTATE_OBJECT_GEOCOORDS}>
					</div>
				</div>
			<{/if}>	

			<{if $object.geo_lng && $object.geo_lat}>
				<div id="map1" class="row wgre-obj-detail-row object-map col-xs-12 col-sm-12">
					<div class='wgre-obj-header-left col-xs-12 col-sm-12'>
						<{$smarty.const._MA_WGREALESTATE_OBJECT_GEOCOORDS}>
						<{include file='db:wgrealestate_map.tpl'}>
					</div>
				</div>
			<{/if}>
			
			<{if $editmode}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-8 col-sm-8'>
						<{$smarty.const._CO_WGREALESTATE_FILES}>
					</div>
					<div class='wgre-obj-header-right right col-xs-4 col-sm-4'>
						<a class='wgre-btn right' href='files.php?op=edit&amp;obj_id=<{$object.id}>' title='<{$smarty.const._CO_WGREALESTATE_FILE_EDIT}>'><{$smarty.const._CO_WGREALESTATE_FILE_EDIT}></a>
					</div>
				</div>
			<{/if}>
			
			<{if $defaultmode && $files}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-12 col-sm-12'>
						<{$smarty.const._CO_WGREALESTATE_FILES}>
					</div>
				</div>
			<{/if}>	
			
			<{if $files}>
				<div class="row wgre-obj-detail-row col-xs-12 col-sm-12">
					<{foreach item=file from=$files}>
						<div class='wgre-obj-detail-right right col-xs-6 col-sm-1'>
							<img class='img-responsive wgre-img-icon' src='<{$wgrealestate_icon_url}>/<{$file.icon}>' title='<{$file.title}>' alt='<{$file.title}>'>
						</div>
						<div class='wgre-obj-detail-left col-xs-6 col-sm-4'>					
							<p><{$file.title}></p>
							<{if $file.info}><p><{$file.info}></p><{/if}>
							<p class='wgre-filedownload'><a class='wgre-btn right' href='<{$wgrealestate_obj_file_url}><{$file.name}>'  download title='<{$smarty.const._CO_WGREALESTATE_DOWNLOAD}>'><{$smarty.const._CO_WGREALESTATE_DOWNLOAD}></a></p>
						</div>
					<{/foreach}>
				</div>
			<{/if}>
		   
			<{if $editmode}>
				<div class='row wgre-obj-header-row col-xs-12 col-sm-12'>
					<div class='wgre-obj-header-left col-xs-12 col-sm-12'>
						<{$smarty.const._CO_WGREALESTATE_OBJECT_STATISTICS}>
					</div>
				</div>
				<div class="row wgre-obj-detail-row col-xs-12 col-sm-12">
					<div class='wgre-obj-detail-left col-xs-8 col-sm-8'>
						<{$smarty.const._CO_WGREALESTATE_OBJECT_VIEWS}>
					</div>
					<div class='wgre-obj-detail-right right col-xs-4 col-sm-4'>
						<{$object.views}>
					</div>
				</div>
				<div class="row wgre-obj-detail-row col-xs-12 col-sm-12">
					<div class='wgre-obj-detail-left col-xs-8 col-sm-8'>
						<{$smarty.const._CO_WGREALESTATE_OBJECT_CONTACTS}>
					</div>
					<div class='wgre-obj-detail-right right col-xs-4 col-sm-4'>
						<{$object.contacts}>
					</div>
				</div>
            <{/if}>
			<{if $footer}>
				<{if $isModerator && $editmode}>
					<div class="row wgre-obj-detail-row col-xs-12 col-sm-12">
						<div class='wgre-obj-header-left col-xs-12 col-sm-12'>
							<{$smarty.const._CO_WGREALESTATE_OBJECT_STATE}>
						</div>
						<div class='wgre-obj-detail-left col-xs-4 col-sm-4'>
							<{$smarty.const._MA_WGREALESTATE_OBJECTS_STATE}>: <{$object.state_text}>
						</div>
						<div class='wgre-obj-header-right right col-xs-8 col-sm-8'>
							<a class='wgre-btn right <{if $smarty.const.WGREALESTATE_STATE_NEW_VAL == $object.state}>wgre-btn-active<{/if}>' href='objects.php?op=state&amp;obj_state=<{$smarty.const.WGREALESTATE_STATE_NEW_VAL}>&amp;obj_state_old=<{$object.state}>&amp;obj_id=<{$object.id}>' title='<{$smarty.const._CO_WGREALESTATE_STATE_NEW}>'><{$smarty.const._CO_WGREALESTATE_STATE_NEW}></a>
							<a class='wgre-btn right <{if $smarty.const.WGREALESTATE_STATE_ONLINE_VAL == $object.state}>wgre-btn-active<{/if}>' href='objects.php?op=state&amp;obj_state=<{$smarty.const.WGREALESTATE_STATE_ONLINE_VAL}>&amp;obj_state_old=<{$object.state}>&amp;obj_id=<{$object.id}>' title='<{$smarty.const._CO_WGREALESTATE_STATE_ONLINE}>'><{$smarty.const._CO_WGREALESTATE_STATE_ONLINE}></a>
							<a class='wgre-btn right <{if $smarty.const.WGREALESTATE_STATE_ARCHIVE_VAL == $object.state}>wgre-btn-active<{/if}>' href='objects.php?op=state&amp;obj_state=<{$smarty.const.WGREALESTATE_STATE_ARCHIVE_VAL}>&amp;obj_state_old=<{$object.state}>&amp;obj_id=<{$object.id}>' title='<{$smarty.const._CO_WGREALESTATE_STATE_ARCHIVE}>'><{$smarty.const._CO_WGREALESTATE_STATE_ARCHIVE}></a>
							
						</div>
					</div>
				 <{/if}>
				 <div class='wgre-obj-detail-footer right col-xs-12 col-sm-12'>
					<{if $isModerator}> 
						<{if $editmode}>
							<a class='wgre-obj-detail-footer-btn wgre-btn right' href='objects.php?op=show&amp;obj_id=<{$object.id}>' title='<{$smarty.const._MA_WGREALESTATE_EDIT_END}>'><{$smarty.const._MA_WGREALESTATE_EDIT_END}></a>
						<{else}>
							<a class='wgre-obj-detail-header-btn wgre-btn right' href='objects.php?op=editmode&amp;obj_id=<{$object.id}>' title='<{$smarty.const._MA_WGREALESTATE_EDIT_START}>'><{$smarty.const._MA_WGREALESTATE_EDIT_START}></a>
						<{/if}>
					 <{/if}>
					<a class='wgre-obj-detail-footer-btn wgre-btn right' href='contact.php?op=list&amp;obj_id=<{$object.id}>' title='<{$smarty.const._MA_WGREALESTATE_CONTACT}>'><{$smarty.const._MA_WGREALESTATE_CONTACT}></a>
					<a class='wgre-obj-detail-footer-btn wgre-btn right' href='index.php?op=list#obj<{$object.id}>' title='<{$smarty.const._MA_WGREALESTATE_BACK_INDEX}>'><{$smarty.const._MA_WGREALESTATE_BACK_INDEX}></a>
				</div>

			<{/if}>
        <{/if}>
        <{if $form}>
            <{$form}>
        <{/if}>
        <{if $error}>
            <{$error}>
        <{/if}>
    </div>
</div>

<{include file='db:wgrealestate_footer.tpl'}>
