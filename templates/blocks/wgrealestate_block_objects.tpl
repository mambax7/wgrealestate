<{if $block}>
	<div class="row">
		<{foreach item=object from=$block}>
			<{if $block|@count == 1}>
				<div class="col-xs-12 col-sm-4 center">
			<{elseif $block|@count == 2}>
				<div class="col-xs-12 col-sm-6 center">
			<{else}>
				<div class="col-xs-12 col-sm-4 center">
			<{/if}>
				<{if $object.mainimage}>
					<div class="center">
						<a class="center" href="<{$wgrealestate_url}>/objects.php?op=show&amp;obj_id=<{$object.id}>" title="<{$smarty.const._MB_WGREALESTATE_READMORE}>">
							<img class='img-responsive wgre-block-img center' src='<{$wgrealestate_obj_image_url}>/objects/<{$object.id}>/medium/<{$object.mainimage}>' title='<{$object.title}>' alt='<{$object.title}>'>
						</a>
					</div>
				<{/if}>
				<div class="wgre-block-div center"><span class="wgre-block-highlight"><{$object.dealtype}></span></div>
				<div class="wgre-block-div center"><{$object.title}></div>
				<div class="wgre-block-div center"><{$object.loc_show}></div>
				<div class="wgre-block-div center">
					<a class='wgre-btn' href="<{$wgrealestate_url}>/objects.php?op=show&amp;obj_id=<{$object.id}>" title="<{$smarty.const._MB_WGREALESTATE_READMORE}>"><{$smarty.const._MB_WGREALESTATE_READMORE}></a>
				</div>
				
			</div>
		<{/foreach}>
	</div>
	<{if $block|@count > 3}>
		<div class="row wgre-block-footer">
			<div class="col-xs-12 col-sm-12 center">
				<a class='wgre-btn' href="<{$wgrealestate_url}>/objects.php?op=show&amp;obj_id=<{$object.id}>" title="<{$smarty.const._MB_WGREALESTATE_MOREOBJECTS}>"><{$smarty.const._MB_WGREALESTATE_MOREOBJECTS}></a>
			</div>
		</div>
	<{/if}>
<{/if}>
