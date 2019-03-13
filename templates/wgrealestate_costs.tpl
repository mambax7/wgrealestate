<{include file='db:wgrealestate_header.tpl'}>
<script type="text/javascript">
	<!--
	function calculate(index){
		var varSum = 0;
		var varValue1 = document.getElementById("cost_perc_"+index).value;
		var varValue2 = document.getElementById("cost_base_"+index).value;
		varSum = varValue1*varValue2/100;
		$("#cost_value_"+index).val(varSum);
	}
	//-->
</script>
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
