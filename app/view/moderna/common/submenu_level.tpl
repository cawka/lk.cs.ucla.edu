{if $item.link==$smarty.server.REQUEST_URI}
<b>{$item.name}</b>
{elseif $item.link==""}
{$item.title}
{else}
<a {if $item.target!=""}target="{$item.target}"}{/if} href="{$item.link}">{$item.name}</a>
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
