{include file="common/std_list_head.tpl"}

{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td>&nbsp;</td>
	<td>Controller</td>
	<td>Action</td>
	<td>&nbsp;</td>
</tr>
{foreach name="list" from=$this->myData item=cat}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td>{$cat.controller_id}</td>
	<td>{$cat.allow_action|default}</td>
	<td>{eval var=$this->getDeleteCtrl($cat)}</td>
</tr>
{/foreach}
</table>
{else}
{/if}

{include file="common/form_pure.tpl" name="kform" method="post" ajax="true" action="save_add" columns=$this->myColumns}

{include file="common/foot.tpl"}
