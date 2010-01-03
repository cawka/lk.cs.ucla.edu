{include file="common/std_list_head.tpl"}

<div class="contentinside">
{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td width="50px">&nbsp;</td>
	<td width="100px">ID</td>
	<td>Page</td>
	<td width="10%">&nbsp;</td>
	<td width="10%">&nbsp;</td>
</tr>
{foreach name="list" from=$this->myData item=cat}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td>{$cat.id}</td>
	<td><a href="{$GLOBAL_PREFIX}{$cat.id}.html">{$cat.sp_title}</a><br/>
	<small>{$cat.sp_text|strip_tags|truncate:"400"}</small></td>
	<td>{eval var=$this->getEditCtrl($cat)}</td>
	<td>{eval var=$this->getDeleteCtrl($cat)}</td>
</tr>
{/foreach}
</table>
{else}
{/if}
</div>

{include file="common/std_list_foot.tpl"}
