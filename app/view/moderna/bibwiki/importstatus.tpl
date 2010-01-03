{include file="common/head.tpl"}

{foreach from=$this->myImportStatus item="status"}
Key: {eval var=$this->link($status,"show",$status.key)}
(<a href="{getNormalizedUrl}?key={$status.key}">_search</a>)... {if $status.status=="OK"}OK{else}<span style="color: red">Failed: {$status.reason}</span>{/if}</br>
{/foreach}

{include file="common/foot.tpl"}