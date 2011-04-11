{include file="common/std_list_head.tpl"}

<div class="contentinside">
{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td>&nbsp;</td>
	<td>{$this->getSort("name","Name")}</td>
	<td>{$this->getSort("login","Login")}</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
{foreach name="list" from=$this->myData item=row}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td>{$row.u_name}</td>
	<td>{$row.u_login}</td>
	<td>{eval var=$this->getEditCtrl($row)}</td>
	<td>{eval var=$this->getDeleteCtrl($row)}</td>
</tr>
{/foreach}
</table>
{else}
No items
{/if}
</div>

{include file="common/std_list_foot.tpl"}
