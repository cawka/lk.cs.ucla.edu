{foreach from=$this->myKeywords2 item="keyword"}
<a href="{$wgScriptPath}{getNormalizedUrl}?keywords={$keyword}" style="font-size: {$this->myKeywords.$keyword}pt">{$keyword}</a>
{/foreach}
