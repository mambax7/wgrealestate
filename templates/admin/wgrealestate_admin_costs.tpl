<!-- Header -->
<script type="text/javascript">
	<!--
	var arrValues = new Array();
	arrValues[""] = "";
	<{foreach item=cost_type from=$cost_types_list}>
	arrValues["<{$cost_type.id}>"] = "<{$cost_type.value}>";
	<{/foreach}>
	function changePerc(value){
		$("#cost_perc").val(arrValues[value]);
	}
	function calculate(index){
		var varSum = 0;
		var varValue1 = document.getElementById("cost_perc_"+index).value;
		var varValue2 = document.getElementById("cost_base_"+index).value;
		varSum = varValue1*varValue2/100;
		$("#cost_value_"+index).val(varSum);
	}
	//-->
</script>
<{include file='db:wgrealestate_admin_header.tpl'}>
<{if $costs_list}>
<table class='table table-bordered'>
	<thead>
        <tr class="head">
            <th class="center"><{$smarty.const._CO_WGREALESTATE_ID}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_OBJECT}></th>            
            <th class="center"><{$smarty.const._CO_WGREALESTATE_COST_TYPE}></th>
			<th class="center"><{$smarty.const._CO_WGREALESTATE_COST_PERC}></th>
			<th class="center"><{$smarty.const._CO_WGREALESTATE_COST_BASE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_COST_VALUE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_COST_INFO}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_DATECREATE}></th>
            <th class="center"><{$smarty.const._CO_WGREALESTATE_SUBMITTER}></th>
            <th class="center width5"><{$smarty.const._CO_WGREALESTATE_FORM_ACTION}></th>
        </tr>
    </thead>
<{if $costs_count}>
	<tbody>
    <{foreach item=cost from=$costs_list}>
        <tr class="<{cycle values='odd, even'}>">
            <td class='center'><{$cost.id}></td>
            <td class="center"><{$cost.obj_title}></td>
            <td class="center"><{$cost.costt_text}></td>
			<td class="center"><{$cost.perc}></td>
			<td class="center"><{$cost.base}></td>
            <td class="center"><{$cost.value}></td>
            <td class="center"><{$cost.info}></td>
            <td class="center"><{$cost.datecreate}></td>
            <td class="center"><{$cost.submitter}></td>
            <td class="center  width5">
                <a href="costs.php?op=edit&amp;cost_id=<{$cost.id}>" title="<{$smarty.const._EDIT}>">
                    <img src="<{xoModuleIcons16 edit.png}>" alt="costs" />
                </a>
                <a href="costs.php?op=delete&amp;cost_id=<{$cost.id}>" title="<{$smarty.const._DELETE}>">
                    <img src="<{xoModuleIcons16 delete.png}>" alt="costs" />
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
	<div class="errorMsg"><strong><{$error}></strong>
</div>

<{/if}>
<br>
<!-- Footer --><{include file='db:wgrealestate_admin_footer.tpl'}>
