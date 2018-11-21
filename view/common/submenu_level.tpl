{if "`$GLOBAL_PREFIX``$item.link`"==$smarty.server.REQUEST_URI}
<b>{$item.name}</b> {if isset($item.description)}<br/><small>{$item.description}</small>{/if}
{elseif $item.link==""}
{$item.title}
{else}
{if $item.isselected}<strong>{/if}

{if strpos($item.link, "http")===0}
<a {if $item.target!=""}target="{$item.target}"{/if} href="{$item.link}">
{else}
<a {if $item.target!=""}target="{$item.target}"{/if} href="{$GLOBAL_PREFIX}{$item.link}">
{/if}
{$item.name}</a> {if isset($item.description)}<br/><small>{$item.description}</small>{/if}

{if $item.isselected}</strong>{/if}

{/if}
{if $item.sublevel!==null && $item.isselected}
<ul>
	{foreach from=$item.sublevel item="i"}
	<li>{include file="common/submenu_level.tpl" item=$i}</li>
	{/foreach}

	{if isUserLogged()}
		<li>
			<a class="smoothbox" href="/menu/?parent_id={$item.id}">
				<img style='margin:0;padding:0;display:inline' 
					height='12px' src='/images/admin/edit.gif' 
					alt='Edit menu items' />
			</a>
		</li>
	{/if}
</ul>
{else}
<br/>
<div class="dotline"></div>
{/if}
