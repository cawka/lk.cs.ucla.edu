{if !isset($smarty.request.ajax)}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>{if !isset($title)}Leonard Kleinrock's Home Page{else}{$title}{/if}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="{$meta_descr|strip_tags}" />
<meta name="keywords" content="{$meta_keywords|strip_tags}" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />

<link rel="stylesheet" href="/css/smoothbox.css" type="text/css" />
<link rel="stylesheet" href="/css/{$SETTINGS.theme}/site.css" type="text/css" />
<link rel="stylesheet" href="/lib/formcheck/theme/classic/formcheck.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/css/{$SETTINGS.theme}/menu.css" type="text/css" />
<link rel="stylesheet" href="/css/{$SETTINGS.theme}/menu_fallback.css" id="fsmenu-fallback" type="text/css" />

<script type="text/javascript" src="/js/mootools-nc.js"></script>
<script type="text/javascript" src="/js/smoothbox.js"></script>

<script type="text/javascript" src="/js/site.js"></script>
<script type="text/javascript" src="/js/cookie.js"></script>
<script type="text/javascript" src="/lib/fsmenu/fsmenu.js"></script>

{if isUserLogged()}
<script type="text/javascript" src="/js/mootools-more.js"></script>
<script type="text/javascript" src="/lib/formcheck/lang/en.js"> </script>
<script type="text/javascript" src="/lib/formcheck/formcheck.js"> </script>

<script type="text/javascript" src="/lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/lib/ckfinder/ckfinder.js"></script>
{/if}
</head>
{strip}
<body>
<script type="text/javascript" src="/js/wz_tooltip.js"></script>
<div class="min-width">
	<div class="shapka">
		<div class="shapka_left">
			<div class="logo">
				<a href="/index.html"><img class="logo_image" src="/images/{$SETTINGS.theme}/logo.jpeg" title="Leonard Kleinrock" /></a>
			</div>
			<div class="dotline"></div>
			<div class="search" style="white-space:nowrap;">
				{*<!-- Google CSE Search Box Begins  -->
				<form action="/search.php" id="searchbox_006709068114398285328:zxae357nx_i">
				  <input type="hidden" name="cx" value="006709068114398285328:zxae357nx_i" />
				  										
				  <input type="hidden" name="cof" value="FORID:11" />
				  <span class="field_box"><input class="field" type="text" name="q" value="" /></span>
				  <input class="button" type="image" src="/images/search_btn.png" />
				</form>
				<!-- Google CSE Search Box Ends -->*}
			</div>
		</div>
		<div class="shapka_right">
			{*<div class="shapka_bar">
				
				<table>
				<tr>
					<td valign="middle">
						<img src="/images/phone.png" /> &nbsp;
					</td>
					<td valign="middle">
						+7 (495) 788-49-10
						&nbsp;
					</td>
					<td>
						<img src="/images/vert_bar.png" />
						<a href="/"><img onmouseover="Tip('На главную')" src="/images/home.png" /></a>
						&nbsp;
					</td>
					<td>
						<img src="/images/vert_bar.png" />
						<a href="/index.php?id=contacts-central"><img onmouseover="Tip('Контакты')" src="/images/contactus.png" /></a>
						&nbsp;
					</td>
					<td>
						<img src="/images/vert_bar.png" />
						<a href="/sitemap.php"><img onmouseover="Tip('Карта сайта')" src="/images/sitemap.png" /></a>
					</td>
				</tr>
				</table>
			</div>*}
			<div class="shapka_picture">
				<img src="{$top_pic|default:"/images/top.jpeg"}" />
			</div>
		</div>
	</div>
	<div class="menubar">
		<div class="dotline" />
		    <table class="iehacktable" border="0" width="100%" cellpadding="0" cellspacing="1px" style="margin-top: 5px;">
			<tr>



<td class="glink" style="width: 12%">
					<ul class="menulist" id="menu_about" >
						<li>
	<a class="main" >О компании</a>
		<ul>

				<li>
	<a  href="/page-about-us.html">Наша компания</a>
	</li>				<li>
	<a  href="/page-our-sertificats.html">Наши сертификаты</a>
	</li>				<li>
	<a  href="/page-managers.html">Наши люди</a>

	</li>				<li>
	<a  href="/page-about-partners.html">Наши партнеры</a>
	</li>				<li>
	<a  href="/page-vacances.html">Вакансии</a>
	</li>			</ul>
	</li>					</ul>

				</td>
												<td width="5px"><div class="dotcolumn" style="height:25px" /></td>
								<td class="glink" style="width: 12%">
					<ul class="menulist" id="menu_products" >
						<li>
	<a class="main" >Продукция</a>
		<ul>
				<li>

	<a  href="/page-products-holod.html">Холодильное оборудование</a>
	</li>				<li>
	<a  href="/page-products-izmerit.html">Измерительное оборудование</a>
	</li>				<li>				<li>
	<a  href="/page-managers.html">Наши люди</a>

	</li>				<li>
	<a  href="/page-about-partners.html">Наши партнеры</a>
	</li>				<li>
	<a  href="/page-vacances.html">Вакансии</a>
	</li>			</ul>
	</li>					</ul>

				</td>



			{foreach from=$menu->myData item=i name="menu"}
				{if !$smarty.foreach.menu.first}
					<td width="5px"><div class="dotcolumn" style="height:25px" /></td>
				{/if}
				<td class="glink{if $i.isselected}_s{/if}{if $smarty.foreach.menu.last} lastmenu{/if}" style="width: 12%">
					<ul class="menulist" id="menu_{$i.id}" >
						{include file="common/menulevel.tpl" item=$i level=1}
					</ul>
				</td>
			{/foreach}
			</tr>
			</table>
		<div class="dotline" />
	</div>
	<div class="body">
{/strip}
{/if}

