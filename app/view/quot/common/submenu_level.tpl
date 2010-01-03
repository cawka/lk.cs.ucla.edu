{if "`$GLOBAL_PREFIX``$item.link`"==$smarty.server.REQUEST_URI}
<b>{$item.name}</b> {if isset($item.description)}<br/><small>{$item.description}</small>{/if}
{elseif $item.link==""}
{$item.title}
{else}
<a {if $item.target!=""}target="{$item.target}"}{/if} href="{$GLOBAL_PREFIX}{$item.link}">{$item.name}</a> {if isset($item.description)}<br/><small>{$item.description}</small>{/if}
{/if}
{if $item.sublevel!==null}
<ul>
	{foreach from=$item.sublevel item="i"}
	<li>{include file="common/submenu_level.tpl" item=$i}</li>
	{/foreach}
</ul>
{else}
<br/>
<div class="dotline"></div>
{/if}
