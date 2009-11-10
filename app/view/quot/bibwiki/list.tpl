{include file="common/std_list_head.tpl"}

<div class="contentinside">

{if sizeof($this->myData)>0}
<table class="wikitable" summary="" width="100%">
<tr class='ann_header'>
	<th>{$this->getSortHeaderLinkNewStyle("author","First Author")}</th>
	<th>{$this->getSortHeaderLinkNewStyle("title","Title")}</th>
	<th>{$this->getSortHeaderLinkNewStyle("journal","Journal")}</th>
	<th>{$this->getSortHeaderLinkNewStyle("year","Year")}</th>
	<th width="10px">&nbsp;</th>
	<th width="10px">&nbsp;</th>
</tr>
{foreach name="list" from=$this->myData item=cat}
<tr>
{*<td>{$smarty.foreach.list.iteration}</td>*}
	<td nowrap><b>{$cat.first_author}</b></td>
	<td>
	{if isset($cat.file) && $cat.file!=""}
	<a target="_blank" href="/papers/{$cat.file}"><img src="{$wgScriptPath}/images/admin/pdf.png"></a>
	{/if}
	</td>
	<td><i>{$cat.journal}</i></td>
	<td>{$cat.date|date_format:"%Y"}</td>

	<td>{eval var=$this->getEditCtrl($cat)}</td>
	<td>{eval var=$this->getDeleteCtrl($cat)}</td>
</tr>
{/foreach}
</table>
{else}
Nothing found
{/if}
</div>

{include file="common/std_list_foot.tpl"}
