{if !isset($smarty.request.ajax)}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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

<script type="text/javascript" src="/js/mootools-nc.js"></script>
<script type="text/javascript" src="/js/smoothbox.js"></script>

<script type="text/javascript" src="/js/site.js"></script>
<script type="text/javascript" src="/js/cookie.js"></script>
{if isUserLogged()}
<script type="text/javascript" src="/js/mootools-more.js"></script>
<script type="text/javascript" src="/lib/formcheck/lang/en.js"> </script>
<script type="text/javascript" src="/lib/formcheck/formcheck.js"> </script>
<script type="text/javascript" src="/js/CalendarPopup.js"></script>*}

<script type="text/javascript" src="/lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/lib/ckfinder/ckfinder.js"></script>
{/if}
</head>
{strip}
<body>
<script type="text/javascript" src="/js/wz_tooltip.js"></script>
<div id="layout">
	<div id="main">
		<div class="n_content">
{/strip}
{/if}

