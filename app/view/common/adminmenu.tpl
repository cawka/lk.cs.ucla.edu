<div class="adminmenu">
{foreach from=$adminmenu item=i}
	<a class="admingroup" href="javascript:;" onclick="toggle( 'adminmenu_{$i.id}' )">{$i.name}</a>
	{assign var="tagname" value="adminmenu_`$i.id`"}
	<div class="adminmenu{if isset($smarty.cookies.$tagname) && $smarty.cookies.$tagname=='1'} collapsed{/if}" id="adminmenu_{$i.id}" >
	{*if $Auth->canAccessTo($i.permission)*}
		{foreach from=$i.items item=ii}
		{if isset($ii.controller)}
			<a href="/1.php?_m={$ii.controller}" class="loginlink">{$ii.name}</a>
		{else}
			<a href="{$ii.link}" target="{$ii.target}" class="loginlink">{$ii.name}</a>
		{/if}
		{/foreach}
	{*/if*}
	</div>
{/foreach}
</div>
<br/>