{*<div class="title">{$submenu->myTitle|mxupper}</div>*}

{foreach from=$menu->mySubData item="i"}
	<div class="clear">
	{include file="common/submenu_level.tpl" item=$i}
	</div>
{/foreach}
