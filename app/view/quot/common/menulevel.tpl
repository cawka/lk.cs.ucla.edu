<li>
	<a {if !isset($item.parent_id)}class="main"{/if} {if $item.link!=""}href="{$GLOBAL_PREFIX}{$item.link}"{/if} {if $item.target!=""}target="{$item.target}"}{/if}>{$item.name}</a>
	{if isset($item.sublevel) && (!isset($level) || $level>0)}
	<ul>
		{if isUserLogged()}
			<li><a class="smoothbox" href="/menu/?parent_id={$i.id}"><img style='margin:0;padding:0;display:inline' height='12px' src='/images/admin/edit.gif' alt='Edit menu items' onmouseover="Tip('Edit menu')" /></a></li>
		{/if}

		{foreach from=$item.sublevel item="i"}
		{include file="common/menulevel.tpl" item=$i morelevel="true" level=0}
		{/foreach}
	</ul>
	{else}
	<ul>
		{if isUserLogged()}
			<li><a class="smoothbox" href="/menu/?parent_id={$i.id}"><img style='margin:0;padding:0;display:inline' height='12px' src='/images/admin/edit.gif' alt='Edit menu items' onmouseover="Tip('Edit menu')" /></a></li>
		{/if}
	</ul>
	{/if}
</li>
