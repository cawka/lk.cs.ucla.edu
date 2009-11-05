{include file="common/std_list_head.tpl"}

<div class="contentinside">
{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td>&nbsp;</td>
	<td>Идентификатор</td>
	<td>Текст</td>
	<td width="10%">&nbsp;</td>
	<td width="10%">&nbsp;</td>
</tr>
{foreach name="list" from=$this->myData item=cat}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td>{$cat.st_name}</td>
	<td>{$cat.st_text}</td>
	<td>{eval var=$this->getEditCtrl($cat)}</td>
	<td>{eval var=$this->getDeleteCtrl($cat)}</td>
</tr>
{/foreach}
</table>
{else}
Ничего не найдено
{/if}
</div>

{include file="common/std_list_foot.tpl"}
