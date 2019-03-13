<{include file='db:wgrealestate_header.tpl'}>

<div class='panel panel-<{$panel_type}>'>
    <div class='panel-heading'><{$smarty.const._MA_WGREALESTATE_COSTS_TITLE}></div>
    <div class='panel panel-body'>
        <{if $form}>
            <{$form}>
        <{/if}>
        <{if $error}>
            <div class="errorMsg"><strong><{$error}></strong></div>
        <{/if}>
    </div>
</div>

<{include file='db:wgrealestate_footer.tpl'}>
