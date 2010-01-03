{strip}
{if !isset($smarty.request.ajax)}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>{if !isset($title)}Leonard Kleinrock's Home Page{else}{$title}{/if}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="{$meta_descr|strip_tags}" />
<meta name="keywords" content="{$meta_keywords|strip_tags}" />

<link rel="shortcut icon" href="{$GLOBAL_PREFIX}favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="{$GLOBAL_PREFIX}apple-touch-icon.png" />

<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/smoothbox.css" type="text/css" />
<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/{$SETTINGS.theme}/site.css" type="text/css" />
<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/{$SETTINGS.theme}/menu.css" type="text/css" />
<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/{$SETTINGS.theme}/menu_fallback.css" id="fsmenu-fallback" type="text/css" />

{if isUserLogged()}
<link rel="stylesheet" href="{$GLOBAL_PREFIX}lib/formcheck/theme/classic/formcheck.css" type="text/css" media="screen" />
<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/admin.css" type="text/css" media="screen" />
{/if}

<script type="text/javascript">var GLOBAL_PREFIX="{$GLOBAL_PREFIX}";</script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}js/mootools-nc.js"></script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}js/smoothbox.js"></script>

<script type="text/javascript" src="{$GLOBAL_PREFIX}js/site.js"></script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}js/cookie.js"></script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}lib/fsmenu/fsmenu.js"></script>

{if isUserLogged()}
<script type="text/javascript" src="{$GLOBAL_PREFIX}js/mootools-more.js"></script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}lib/formcheck/lang/en.js"> </script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}lib/formcheck/formcheck.js"> </script>

<script type="text/javascript" src="{$GLOBAL_PREFIX}lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}lib/ckfinder/ckfinder.js"></script>
{/if}
</head>
<body>
<script type="text/javascript" src="/js/wz_tooltip.js"></script>
<div class="min-width">
	<div class="shapka">
		<div class="shapka_left">
			<div class="logo">
				<a href="/index.html"><img class="logo_image" src="/images/{$SETTINGS.theme}/logo.jpeg" title="University of California, Los Angeles (UCLA)" /></a>
			</div>
		</div>
		<div class="shapka_right">
			<div class="shapka_picture">
				<img src="{$top_pic|default:"/images/top.jpeg"}" alt="Leonard Kleinrock" />
			</div>
		</div>
	</div>
	<div class="menubar">
		<div class="dotline" />
		    <table class="iehacktable" border="0" width="100%" cellpadding="0" cellspacing="1px" style="margin-top: 5px;">
			<tr>
{foreach from=$menu->myData item=i name="menu"}
{if !$smarty.foreach.menu.first}
<td width="5px"><div class="dotcolumn" style="height:25px" /></td>

	{/if}
<td class="glink{if $i.isselected}_s{/if}{if $smarty.foreach.menu.last} lastmenu{/if}" style="width: {$i.width}">
<ul class="menulist" id="menu_{$i.id}" >
	{include file="common/menulevel.tpl" item=$i level=1}

</ul>
</td>

{/foreach}
<td class="glink" style="width:100px">
<ul class="menulist" id="menuSpecial" >
<li>
{if isUserLogged()}
<a style="float:right" class="smoothbox" href="/menu/" name='Edit' ><img style='margin:0;padding:0;display:inline' height='12px' src='/images/admin/edit.gif' alt='Edit menu items' onmouseover="Tip('Edit menu')" /></a>
</li>
	</ul>
</td>
		{/if}
			</tr>
			</table>
		<div class="dotline" />
	</div>
</div>
</div>

<div class="body">
	<table width="100%">
	<tr>
	<td class="left">
        {if isset($menuContent)}
        {if isUserLogged()}<p align="right">{$menuContent->getEditCtrl($menuContent->myData, "Edit subpage")}</p>{/if}
        <div id='frame_1'>{eval var="`$menuContent->myData.text` "}</div>
		<br/><br/>
        {/if}		
        
		{if isset($menu->mySubData)}
            {include file="common/submenu.tpl"}

			{if isUserLogged()}<br/><p align="right"><a class="smoothbox" href="/menu/?parent_id={$menu->mySubData.0.parent_id}">Edit submenu</a></p>{/if}
        {/if}
	</td>
	<td class="right">
{/if}
{/strip}
