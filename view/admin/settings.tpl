{include file="common/std_list_head.tpl"}

<div class="contentinside">
{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td>&nbsp;</td>
	<td>Option</td>
</tr>
{foreach name="list" from=$this->myData item=cat}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td>{$cat.set_name} = <b>{$cat.set_value}</b>
	&nbsp;&nbsp;
	{eval var=$this->getEditCtrl($cat)}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	{eval var=$this->getDeleteCtrl($cat)}
	</td>
</tr>
{/foreach}
</table>
{else}
No items
{/if}
</div>

{include file="common/std_list_foot.tpl"}
