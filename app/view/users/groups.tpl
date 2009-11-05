{include file="common/std_list_head.tpl"}

<div class="contentinside">
{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td>&nbsp;</td>
	<td>Группа пользователей</td>
	<td width="10%">&nbsp;</td>
	<td width="10%">&nbsp;</td>
</tr>
{foreach from=$this->myData item=cat}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td>{$cat.name}</td>
	<td><a class="smoothbox" name="Настройка прав для роли '<b>{$cat.name}</b>'" href="/1.php?_m=userRights&user_group_id={$cat.id}&amp;ajax=true&amp;width=600&amp;height=400">{$this->myHelper->img_button("rights","Настройка прав для роли")}</a>
	{if $cat.id!==null}{eval var=$this->getEditCtrl($cat)}{/if}</td>
	<td>{if $cat.id!==null}{eval var=$this->getDeleteCtrl($cat)}{/if}</td>
</tr>
{/foreach}
</table>
{else}
Ничего не найдено
{/if}
</div>

{include file="common/std_list_foot.tpl"}
