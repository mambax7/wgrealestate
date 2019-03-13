<!-- Header -->
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $cost_types_list}>
	<table class='table table-bordered'>
		<thead>
			<tr class="head">
				<th class="center"><{$smarty.const._CO_WGREALESTATE_ID}></th>
				<th class="center"><{$smarty.const._AM_WGREALESTATE_COST_TYPE_TEXT}></th>
				<th class="center"><{$smarty.const._AM_WGREALESTATE_COST_TYPE_PERC}></th>
				<th class="center"><{$smarty.const._AM_WGREALESTATE_COST_TYPE_FIXED}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_TYPE_INFO}></th>
				<th class="center"><{$smarty.const._AM_WGREALESTATE_DEALTYPE_TYPE}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_INDEX_SHOW}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_TYPE_VALID}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_DATECREATE}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_SUBMITTER}></th>
				<th class="center width5"><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
			</tr>
		</thead>
		<{if $cost_types_count}>
			<tbody>
				<{foreach item=cost_type from=$cost_types_list}>
					<tr class="<{cycle values='odd, even'}>">
						<td class='center'><{$cost_type.id}></td>
						<td class="center"><{$cost_type.type}></td>
						<td class="center"><{$cost_type.perc}></td>
						<td class="center"><{$cost_type.fixed}></td>
						<td class="center"><{$cost_type.info}></td>
						<td class="center">(<{$cost_type.dealtype_id}>) <{$cost_type.dealtype}></td>
						<td class="center">
							<{if $cost_type.index == 1}>
								<a href="cost_types.php?op=edit_index&amp;costt_index=<{$cost_type.index}>&amp;costt_id=<{$cost_type.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>ok.png" alt="cost_types" /></a>
							<{else}>
								<a href="cost_types.php?op=edit_index&amp;costt_index=<{$cost_type.index}>&amp;costt_id=<{$cost_type.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>off.png" alt="cost_types" /></a>
							<{/if}>						
						
						</td>
						<td class="center">
							<{if $cost_type.valid == 1}>
								<a href="cost_types.php?op=edit_valid&amp;costt_valid=<{$cost_type.valid}>&amp;costt_id=<{$cost_type.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>ok.png" alt="cost_types" /></a>
							<{else}>
								<a href="cost_types.php?op=edit_valid&amp;costt_valid=<{$cost_type.valid}>&amp;costt_id=<{$cost_type.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>off.png" alt="cost_types" /></a>
							<{/if}>
						
						</td>
						<td class="center"><{$cost_type.datecreate}></td>
						<td class="center"><{$cost_type.submitter}></td>
						<td class="center  width5">
							<a href="cost_types.php?op=edit&amp;costt_id=<{$cost_type.id}>" title="<{$smarty.const._EDIT}>">
								<img src="<{xoModuleIcons16 edit.png}>" alt="cost_types" />
							</a>
							<a href="cost_types.php?op=delete&amp;costt_id=<{$cost_type.id}>" title="<{$smarty.const._DELETE}>">
								<img src="<{xoModuleIcons16 delete.png}>" alt="cost_types" />
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
