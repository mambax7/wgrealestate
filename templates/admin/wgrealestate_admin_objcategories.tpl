<!-- Header -->
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $objcategories_list}>
	<table class='table table-bordered'>
		<thead>
			<tr class="head">
				<th class="center"><{$smarty.const._CO_WGREALESTATE_ID}></th>
				<th class="center"><{$smarty.const._AM_WGREALESTATE_OBJCAT_CATEGORY_NAME}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_TYPE_VALID}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_DATECREATE}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_SUBMITTER}></th>
				<th class="center width5"><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
			</tr>
		</thead>
		<{if $objcategories_count}>
			<tbody>
			<{foreach item=objcategory from=$objcategories_list}>
				<tr class="<{cycle values='odd, even'}>">
					<td class='center'><{$objcategory.id}></td>
					<td class="center"><{$objcategory.name}></td>
					<td class="center">
						<{if $objcategory.valid == 1}>
							<a href="objcategories.php?op=edit_valid&amp;objcat_valid=<{$objcategory.valid}>&amp;objcat_id=<{$objcategory.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>ok.png" alt="objcategories" /></a>
						<{else}>
							<a href="objcategories.php?op=edit_valid&amp;objcat_valid=<{$objcategory.valid}>&amp;objcat_id=<{$objcategory.id}>" title="<{$smarty.const._EDIT}>"><img src="<{$wgrealestate_icon_url_16}>off.png" alt="objcategories" /></a>
						<{/if}>
					</td>
					<td class="center"><{$objcategory.datecreate}></td>
					<td class="center"><{$objcategory.submitter}></td>
					<td class="center  width5">
					<a href="objcategories.php?op=edit&amp;objcat_id=<{$objcategory.id}>" title="<{$smarty.const._EDIT}>">
						<img src="<{xoModuleIcons16 edit.png}>" alt="objcategories" />
					</a>
					<a href="objcategories.php?op=delete&amp;objcat_id=<{$objcategory.id}>" title="<{$smarty.const._DELETE}>">
						<img src="<{xoModuleIcons16 delete.png}>" alt="objcategories" />
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
