{include file="common/std_list_head.tpl"}

<div class="contentinside">

{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td>&nbsp;</td>
	<td>Date</td>
	<td>Text</td>
	<td width="10%">&nbsp;</td>
	<td width="10%">&nbsp;</td>
</tr>
{foreach name="list" from=$this->myData item=cat}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td>{$cat.publ_begin|date_format:"%d.%m.%Y"}</td>
	<td><b>{$cat.subject}</b><br/>
	{$cat.body}</td>
	<td>{eval var=$this->getEditCtrl($cat)}</td>
	<td>{eval var=$this->getDeleteCtrl($cat)}</td>
</tr>
{/foreach}
</table>
{else}
No items
{/if}
</div>

{include file="common/std_list_foot.tpl"}
