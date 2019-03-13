<!-- Header -->
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $files_list}>
	<table class='table table-bordered'>
		<thead>
			<tr class="head">
				<th class="center"><{$smarty.const._CO_WGREALESTATE_ID}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_OBJECT}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_FILE_TITLE}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_FILE_INFO}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_FILE_NAME}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_WEIGHT}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_FILE_SIZE}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_DATECREATE}></th>
				<th class="center"><{$smarty.const._CO_WGREALESTATE_SUBMITTER}></th>
				<th class="center width5"><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
			</tr>
		</thead>
		<{if $files_count}>
			<tbody>
			<{foreach item=file from=$files_list}>
				<tr class="<{cycle values='odd, even'}>">
					<td class='center'><{$file.id}></td>
					<td class="center"><{$file.obj_id}></td>
					<td class="center"><{$file.title}></td>
					<td class="center"><{$file.info}></td>
					<td class="center"><{$file.name}></td>
					<td class="center"><{$file.weight}></td>
					<td class="center"><{$file.size}></td>
					<td class="center"><{$file.datecreate}></td>
					<td class="center"><{$file.submitter}></td>
					<td class="center  width5">
						<a href="files.php?op=edit&amp;file_id=<{$file.id}>" title="<{$smarty.const._EDIT}>">
							<img src="<{xoModuleIcons16 edit.png}>" alt="files" />
						</a>
						<a href="files.php?op=delete&amp;file_id=<{$file.id}>" title="<{$smarty.const._DELETE}>">
							<img src="<{xoModuleIcons16 delete.png}>" alt="files" />
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
