{include file="std_list_head.tpl" title=$this->myTitle}
<div class="contentinside">
<table summary="" width="100%">
{$this->getTableHeader()}
{foreach from=$this->myData item=cat}
<tr>
	<td>{eval var=$this->showBrief($cat)}</td>
	<td>{eval var=$this->getEditCtrl($cat)}</td>
	<td>{eval var=$this->getDeleteCtrl($cat)}</td>
</tr>
{/foreach}
</table>
</div>

{include file="std_list_foot.tpl"}
