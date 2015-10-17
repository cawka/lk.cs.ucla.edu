{*<div class="title">{$submenu->myTitle|mxupper}</div>*}

{foreach from=$menu->mySubData item="i"}
	{if $i.width>=0}
	<div class="clear">
	{include file="common/submenu_level.tpl" item=$i}
	</div>
	{/if}
{/foreach}
