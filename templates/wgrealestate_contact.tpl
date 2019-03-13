<{include file='db:wgrealestate_header.tpl'}>

<{if $recaptcha}>
<script src='https://www.google.com/recaptcha/api.js'></script>
<{/if}>

<div class='panel panel-<{$panel_type}>'>
    <div class='panel panel-body'>
		<{if $contact_info}>   
			<div class='row wgre-contact-info-row col-xs-12 col-sm-12'>
				<div class='wgre-contact-info-detail col-xs-12 col-sm-12'>
					<{$contact_info}>
				</div>
			</div>
		<{/if}>
		<{if $contact_default}>   
			<div class='row wgre-contact-default-row col-xs-12 col-sm-12'>
				<div class='wgre-contact-default-detail col-xs-12 col-sm-12'>
					<{$contact_default}>
				</div>
			</div>
		<{/if}>	
		<{if $form}>
			<div class='row wgre-contact-default-row col-xs-12 col-sm-12'>
				<div class='wgre-contact-default-detail col-xs-12 col-sm-12'>
					<{$form}>
				</div>
			</div>
        <{/if}>
        <{if $error}>
            <div class='row wgre-contact-default-row col-xs-12 col-sm-12'>
				<div class="errorMsg"><strong><{$error}></strong></div>
				<div class="errorMsg"><strong><{$error_info}></strong></div>
				<div class='wgre-obj-detail-footer right col-xs-12 col-sm-12'>
					<a class='wgre-obj-detail-footer-btn wgre-btn right' href='objects.php?op=show&amp;obj_id=<{$obj_id}>' title='<{$smarty.const._MA_WGREALESTATE_BACK_OBJECT}>'><{$smarty.const._MA_WGREALESTATE_BACK_OBJECT}></a>
				</div>
			</div>
        <{/if}>
    </div>
</div>

<{include file='db:wgrealestate_footer.tpl'}>