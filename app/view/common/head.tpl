{if !isset($smarty.request.ajax)}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>{if !isset($title)}Reklama.com.ua{else}{$title}{if isset($showRegion)}{getRegion region=$this->myRegions->myParentData}{/if}{/if}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="{$meta_descr|strip_tags}" />
<meta name="keywords" content="{$meta_keywords|strip_tags}" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />

<meta name="verify-v1" content="78NNfoHi+F6EiTL/ns6A2DPc820k+g81pb7HbEOlBPc=" />
<meta name="verify-v1" content="jSRNSW3slOqzpDSv6Rj86HrJ5svhs0oo9+GaVftdyi8=" />
<meta name="verify-v1" content="oiSpOzfXVOQvTElRpc0OwB05gvyoa54wecngPvHoR9Y=" />
<meta name="verify-v1" content="3c8tyEWSjjuTHuaecFq7m1yGl6xlqfxmH7l6A9Wl/So=" />

<link rel="stylesheet" href="/css/teasers.css" type="text/css" />
<link rel="stylesheet" href="/css/smoothbox.css" type="text/css" />
<link rel="stylesheet" href="/css/reklama.css" type="text/css" />
<link rel="stylesheet" href="/css/uvumi-textarea.css" type="text/css" />
<link rel="stylesheet" href="/css/n_reklama.css" type="text/css" />
<!--[if lte IE 7]> <style type="text/css" media="all">@import url('css/ie.css');</style> <![endif]-->
<script language="javascript">
var notfirst={if !isset($smarty.request.search) || $smarty.request.search==""}0{else}1{/if};
</script>
<script type="text/javascript" src="/js/mootools1.2-mod.js"></script>
<script type="text/javascript" src="/js/mootools-1.2-more.js"></script>
<script type="text/javascript" src="/js/smoothbox.js"></script>

<script type="text/javascript" src="/js/tmt_core.js"></script>
<script type="text/javascript" src="/js/tmt_form.js"></script>
<script type="text/javascript" src="/js/tmt_validator.js"></script>
<script type="text/javascript" src="/js/swfobject.js"></script>
<script type="text/javascript" src="/js/homepage.js"></script>
<script type="text/javascript" src="/js/dyn_stuff.js"></script>
<script type="text/javascript" src="/js/js.js"></script>
<script type="text/javascript" src="/js/site.js"></script>
<script type="text/javascript" src="/js/UvumiTextarea-c.js"></script>
<script type="text/javascript" src="/js/cookie.js"></script>
{if isAdmin(99)}
<script type="text/javascript" src="/js/cal.js"></script>
<script type="text/javascript" src="/js/CalendarPopup.js"></script>

<script type="text/javascript" src="/class/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/class/ckfinder/ckfinder.js"></script>
{/if}
</head>
{strip}
<body>
<script type="text/javascript" src="/js/wz_tooltip.js"></script>
<h1 class="topline">
{if !isset($title)}Reklama.com.ua{else}{$title}{if isset($showRegion)}{getRegion region=$this->myRegions->myParentData}{/if}{/if}</title>
</h1>
<div id="layout">
	<div id="main">
		<!--Информационная часть-->
		<div class="n_content">
			<!--Левая колонка-->
			<div class="n_left">
				<table class="double_sec">
					<tr>
					{*<!--Добавление, удаление объявления-->*}
					<td id="announcement">
						<a href="/post.php?reg_id={$smarty.request.reg_id}&cat_id={$smarty.request.cat_id}" class="announcementitem1">{$langdata._title_post}</a>
						<a href="/advertisment-edit.html" class="announcementitem">{$langdata._title_post_edit}</a>
						<a href="/advertisment-delete.html" class="announcementitem">{$langdata._title_post_del}</a>
					</td>
					</tr>
				</table>
				<!--Поиск-->
				<div id="search">
					<form action="/search.html" method="POST" tmt:validate="true">
						<input class="searchinput" type="text" value="{$smarty.request.search|default:$langdata._title_search_input}" name="search" {literal}onclick="if(notfirst==0){ notfirst=1; this.value='';}" />{/literal}
						<input class="searchbutton" type="submit" onclick="if(notfirst==0) return false;" value="{$langdata._title_search}" />
					</form>
					<a href="/search{if $smarty.request.cat_id!=""}/{$smarty.request.cat_id}{if $smarty.request.reg_id!=""}-{$smarty.request.reg_id}{/if}{/if}" class="loginlink">{$langdata._title_search_advanced}</a>
				{if !isUserLogged()}	<a href="/recoverPassword.html" class="loginlink">{$langdata._title_recovery}</a>{/if}
				</div>
				<!--Логин-->
				<div id="login">
				{if !isUserLogged()}
					<form method="post" action="/login.php">
					<input name="action" type="hidden" id="send" value="login" /> 
					<input id="kname" name="kname" class="sm_logininput" type="text" size="50" onmouseover="Tip('{$langdata.login_login}')" value="{$langdata.login_login}" onFocus="onProcess(this,'{$langdata.login_login}')" onBlur="onProcessOut(this,'{$langdata.login_login}')" />
					<input name="kpass" class="sm_logininput" type="password" size="50" onmouseover="Tip('{$langdata.login_pass}')" />
					<input class="searchbutton loginbutton" type="submit" value="{$langdata.login_submit}" />
					</form>
					<a href="/register.html" class="loginlink floginlink">{$langdata._title_register}</a>

				{else}
					 <a href="/myprofile" class="loginlink">{$langdata._myprofile}</a>
					 <a href="/search.html&user={$smarty.session.user}" class="loginlink">{$langdata._myannons}</a>
					 {if $smarty.session.my_banners=='t'}
					 <a href="/mybanners" class="loginlink">{$langdata._mybanners}</a>
					 {/if}
					 <a href="/services.html" class="loginlink">{$langdata._myservices}</a>
				 
					 <a href="/login.php?action=logout" class="loginlink">{$langdata._title_logout}</a>
				{/if}
				</div>
				{if isAdmin(99)}
				{include file="common/adminmenu.tpl"}
				{/if}
				
				{if isset($mainmenu) && isset($articlemenu)}
				{if isset($articlemenu)}
				<div class="mainmenuinsidecontainer">
					<a href="/" class="mainmenuinside"><b>{$langdata._title_advertisments}</b></a>
				{/if}
					<!--Главное меню на внутренней-->
					<div class="mainmenuinsidecontainer">
					{foreach from=$mainmenu->myData item=cat}
						<a href="/{$mainmenu->getListHref($cat)}" class="mainmenuinside">{$cat.cat_name|escape:"html"}</a>
						<div class="mainmenuinsidespacer"></div>
					{/foreach}
					</div>
				{if isset($articlemenu)}
				</div>
				{/if}
				{/if}
				
				{if isset($articlemenu)}
				<div class="mainmenuinsidecontainer">
					<a href="/articles.html" class="mainmenuinside"><b>{$langdata._title_articles}</b></a>
	
					<div class="mainmenuinsidecontainer">
					{foreach from=$articlemenu->myData item=cat}
						<a href="/{$articlemenu->getListHref($cat)}" class="mainmenuinside">{$cat.cat_name|escape:"html"}</a>
						<div class="mainmenuinsidespacer"></div>
					{/foreach}
					</div>
				</div>
				{/if}
				
				{*$smarty.request.cat_id*}
				{*<script src="http://teasers.reklama.cawka.ru/designs/div60x45.js"></script>
				<script src="http://teasers.reklama.cawka.ru/table-rus-rand10.js"></script>*}
				
				{*catalog=$this->myInfo.cat_section region=$smarty.request.reg_id*}
				{getAdvertisment type="left" paid="true" limit=$SETTINGS.limit_top_paid}
				
				{getAdvertisment type="left" catalog=$this->myInfo.cat_section region=$smarty.request.reg_id limit=$SETTINGS.limit_free_top}
				
				{if isset($banner)}
				{insert name="getBanner" value=$banner type="2" format="1" id=$banner link=""}
				{/if}
				{insert name="getBanner" type="2" cat_id=$smarty.request.cat_id}
				{insert name="getBanner" type="1" cat_id=$smarty.request.cat_id}
				{insert name="getBanner" type="5" cat_id=$smarty.request.cat_id}
			</div>
			<!--Правая колонка-->
			<div class="n_rightblock">
				<div class="n_rightblock_2">
				<!--Главный заголовок-->
					<div id="contentheaderbck">
						<div id="contentheader">
							<h2 class="n_pagetitle">
								<a href="/index.php">{$langdata._mainpage}</a>
								{if isset($this) && isset($this->myParentPath)}
								{foreach from=$this->myParentPath item=item}
								&nbsp;&nbsp;>>&nbsp;&nbsp;<a href="/{$this->getListHrefParentPath($item)}">{$item.cat_name}</a>
								{/foreach}
								{/if}
							</h2>
						</div>
					</div>
{/strip}
{/if}

{if !isUserLogged()}
{literal}
<script type="text/javascript">
var deflogin=readCookie("reklama_ua_deflogin");
if( $("kname") && deflogin ) $("kname").value=decodeURIComponent(deflogin);
function onProcess(e,defvalue){ if( e.value==defvalue ) e.value=""; }
function onProcessOut(e,defvalue){ if( e.value=="" ) e.value=defvalue; }

</script>
{/literal}
{/if}
