{include file="common/std_list_head.tpl"}

<div class="contentinside">
{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td>&nbsp;</td>
	<td>{$this->getSortHeaderLinkNewStyle("name","Компания, ФИО")}</td>
	<td>{$this->getSortHeaderLinkNewStyle("login","Логин")}</td>
	<td>{$this->getSortHeaderLinkNewStyle("last","Последний заход")}"</td>
	<td>{$this->getSortHeaderLinkNewStyle("adv","Объявления<br/>(сейчас/всего)")}</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
{foreach name="list" from=$this->myData item=row}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td>
		{if $row.u_group=="0"}<span style='color: blue'>{/if}
		{if $row.is_active=="f"}<span style='color: red'>{/if}
		<b>{$row.u_company}</b> {$row.u_fname} {$row.u_lname}
		{if $row.is_active=="f"}</span>{/if}
		{if $row.u_group=="0"}</span>{/if}
	</td>
	<td><a target='_blank' href='/search.html&user={$row.user_id}'>{$row.u_login}</a></td>
	<td>{$row.u_lastlogin|date_format:"%d.%m.%Y %H:%M:%S"}</td>
	<td align="center">{$row.u_adv_count_cur}/{$row.u_adv_count}</td>
	<td>{eval var=$this->getEditCtrl($row)}</td>
	<td>{eval var=$this->getDeleteCtrl($row)}</td>
</tr>
{/foreach}
</table>
{else}
Ничего не найдено
{/if}
</div>

{include file="common/std_list_foot.tpl"}
