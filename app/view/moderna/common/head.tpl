{if !isset($smarty.request.ajax)}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>{if !isset($title)}Alexander Afanasyev's Home Page{else}{$title}{/if}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="{$meta_descr|strip_tags}" />
<meta name="keywords" content="{$meta_keywords|strip_tags}" />

{*<link rel="shortcut icon" href="{$GLOBAL_PREFIX}favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="{$GLOBAL_PREFIX}apple-touch-icon.png" />*}

<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/smoothbox.css" type="text/css" />

<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/{$SETTINGS.theme}/site.css" type="text/css" />

{if isUserLogged()}
<link rel="stylesheet" href="{$GLOBAL_PREFIX}lib/formcheck/theme/classic/formcheck.css" type="text/css" media="screen" />
<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/admin.css" type="text/css" media="screen" />

{/if}

{*<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/{$SETTINGS.theme}/menu.css" type="text/css" />
<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/{$SETTINGS.theme}/menu_fallback.css" id="fsmenu-fallback" type="text/css" />*}


<script type="text/javascript">var GLOBAL_PREFIX="{$GLOBAL_PREFIX}";</script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}js/mootools-nc.js"></script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}js/smoothbox.js"></script>

<script type="text/javascript" src="{$GLOBAL_PREFIX}js/site.js"></script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}js/cookie.js"></script>
{*<script type="text/javascript" src="{$GLOBAL_PREFIX}lib/fsmenu/fsmenu.js"></script>*}

{if isUserLogged()}
<script type="text/javascript" src="{$GLOBAL_PREFIX}js/mootools-more.js"></script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}lib/formcheck/lang/en.js"> </script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}lib/formcheck/formcheck.js"> </script>

<script type="text/javascript" src="{$GLOBAL_PREFIX}lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="{$GLOBAL_PREFIX}lib/ckfinder/ckfinder.js"></script>
{/if}
</head>
{*strip*}
<body>
{if isUserLogged()}<script type="text/javascript" src="{$GLOBAL_PREFIX}js/wz_tooltip.js"></script>{/if}

<div id="container">
	<div id="banner">
<div style="text-align: center"><img src="{$GLOBAL_PREFIX}images/baltic_sea.jpeg" alt="Shore of the Baltic Sea"/></div>
<h1>Alexander Afanasyev</h1>
</div>
	<!-- Begin Top Menu -->
	<ul id="navlist">
{foreach from=$menu->myData item=i name="menu"}
{if $i.display_order<0}
	{if isUserLogged()}
		<li{if $i.isselected} id="current"{/if}><a style="float:right"{if $i.isselected} id="current"{/if}{if $i.link!=""} href="{$GLOBAL_PREFIX}{$i.link}"{/if}{if $i.target!=""} target="{$i.target}"}{/if}>{$i.name}</a></li>
	{/if}
{else}
		<li{if $i.isselected} id="current"{/if}><a{if $i.isselected} id="current"{/if}{if $i.link!=""} href="{$GLOBAL_PREFIX}{$i.link}"{/if}{if $i.target!=""} target="{$i.target}"}{/if}>{$i.name}</a></li>
{/if}
{/foreach}
{if isUserLogged()}
		<li><a style="float:right" class="smoothbox" href="{$GLOBAL_PREFIX}menu/" name='Edit' ><img style='margin:0;padding:0;display:inline' height='12px' src='{$GLOBAL_PREFIX}images/admin/edit.gif' alt='Edit menu items' onmouseover="Tip('Edit menu')" /></a></li>
{/if}
	</ul>
	<!-- End Top Menu -->

	<div id="sidebar-a">
		{if isset($menu->mySubData)}
			{include file="common/submenu.tpl"}
		{/if}

		{if isset($menuContent)}
		{if isUserLogged()}{$menuContent->getEditCtrl($menuContent->myData)}{/if}
		<div id='frame_1'>{eval var="`$menuContent->myData.text` "}</div>
		{/if}
	</div>

{*	<div id="sidebar-b">
		<h3>Test</h3>
		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse a tortor. Pellentesque sollicitudin, ante nec posuere tempus, arcu lectus vehicula mi, ac rhoncus lorem turpis sed sapien.</p>
	</div>*}

	<div id="content">
{/if}



