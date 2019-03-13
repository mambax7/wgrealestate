<!-- Header -->
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $list}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class='center'><{$smarty.const._AM_WGREALESTATE_MAINTAINANCE}></th>
                <th class='center'><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
            </tr>
        </thead>
        <tbody>
            <tr class="<{cycle values='odd, even'}>">
                <td class='center'><{$smarty.const._AM_WGREALESTATE_MAINTAIN_CHECK_FOLDER_OBJ}></td>
                <td class='center'>
                    <a class='btn' href='maintainance.php?op=checkfolderobj' title='<{$smarty.const._AM_WGREALESTATE_MAINTAIN_EXEC}>'>
						<img src='<{$wgrealestate_icon_url_32}>exec.png' alt='<{$smarty.const._AM_WGREALESTATE_MAINTAIN_EXEC}>' style='width:20px;' />
                    </a>
                </td>
            </tr>
            <tr class="<{cycle values='odd, even'}>">
                <td class='center'><{$smarty.const._AM_WGREALESTATE_MAINTAIN_RESIZE_THUMBS}></td>
                <td class='center'>
                    <a class='btn' href='maintainance.php?op=resizethumbs' title='<{$smarty.const._AM_WGREALESTATE_MAINTAIN_EXEC}>'>
                        <img src='<{$wgrealestate_icon_url_32}>exec.png' alt='<{$smarty.const._AM_WGREALESTATE_MAINTAIN_EXEC}>' style='width:20px;' />
                    </a>
                </td>
            </tr>
			<tr class="<{cycle values='odd, even'}>">
                <td class='center'><{$smarty.const._AM_WGREALESTATE_MAINTAIN_OBJIDS}></td>
                <td class='center'>
                    <a class='btn' href='maintainance.php?op=invalid_objid' title='<{$smarty.const._AM_WGREALESTATE_MAINTAIN_EXEC}>'>
                        <img src='<{$wgrealestate_icon_url_32}>exec.png' alt='<{$smarty.const._AM_WGREALESTATE_MAINTAIN_EXEC}>' style='width:20px;' />
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
<{/if}>  
<{if $maintain_result}>
    <table class='table table-bordered'>
        <thead>
            <tr class='head'>
                <th class='center'><{$smarty.const._AM_WGREALESTATE_MAINTAINANCE}></th>
                <th class='center'><{$smarty.const._AM_WGREALESTATE_MAINTAIN_RESULT}></th>
            </tr>
        </thead>
        <tbody>
            <tr class="<{cycle values='odd, even'}>">
                <td class='center'><{$maintain_type}></td>
                <td class='center'><{$maintain_result}><span style='color:red'> <{$maintain_count}></span></td>
            </tr>
        </tbody>
    </table>
<{/if}>   

<div class='clear'>&nbsp;</div>
<{if $error}>
    <div class='errorMsg'><strong><{$error}></strong></div>
<{/if}>
<br>
<!-- Footer --><{include file='db:wgrealestate_admin_footer.tpl'}>
