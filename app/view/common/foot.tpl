{if !isset($smarty.request.ajax)}
{strip}

</div>
</div>
			<div id="footer">
			{strip}
			<table class="layout">
			<tr>
			<td id="dev">
			{*<a href="http://dzin.lv/" target="_blank" class="dzin" title="Dzin e-solutions"></a>*}
			{if !isAdmin()}
			{*include file="common/counters/rambler.tpl"*}
			{include file="common/counters/bigmir.tpl"}
			{*include file="common/counters/liveinternet.tpl"*}
			{*include file="common/counters/spylogru.tpl"*}
			{*include file="common/counters/mailru.tpl"*}
			{include file="common/counters/webmoney.tpl"}
			{/if}
			<div class="link1">
				<br/>
			{sape_get_links|replace:"sape_context":"link1_context"|replace:"sape":"link1"}
			</div>
			</td>
			{/strip}
			<td id="copyrightbck">
				<div style="float: left; padding: 60px 0 0 25px;">
					<img src="/images/ver.gif" alt="verified">
				</div>
				<div id="feedbackerror">
				<a target="_blank" href="/staticpage.php?sp_id=1#contact"><img src="/images/feedback_{if $LANG==1}ru{elseif $LANG==2}ua{else}en{/if}.gif" />
				</div>
				<div id="copyright">
{*					<a class="bottomcontacts" href="staticpage.php?sp_id=6">{$langdata._title_about}</a>
					<span class="mainmenubullet">|</span>*}
					<a class="bottomcontacts" href="/rules.html">{$langdata._title_rules}</a>
					<span class="mainmenubullet">|</span>
					<a class="bottomcontacts" href="/reklama.html">{$langdata._title_reklama}</a>
					<span class="mainmenubullet">|</span>
					<a class="bottomcontacts" href="/sitemap">{$langdata._title_sitemap}</a>
					<span class="mainmenubullet">|</span>
					<a class="bottomcontacts" href="/contacts.html">{$langdata._title_contacts}</a>
					{*<span class="mainmenubullet">|</span>
					<a class="bottomcontacts" href="counter.php">{$langdata._title_links}</a>*}
					<span class="mainmenubullet">|</span>
					<a class="bottomcontacts" href="/archieve">{$langdata._title_ARCHIVE}</a>
					<br/>
					{$langdata._title_bottom_statup_begin}<a class="bottomcontacts" href="{$SITEURL}" onclick="setHP(this); return false;" >Reklama.com.ua</a>{$langdata._title_bottom_statup_end}
					<br/>
					{$langdata._copyright}<br/>
				</div>
			</td>
			</tr>
			</table>
		</div>
	</div>
	
	<!--Mainmenu-->
	<div class="n_mainmenu">
		<div>
			<a href="/">{$langdata._title_main}</a>
			<span class="mainmenubullet">|</span>
			{*<a href="/about.html">{$langdata._title_about}</a>
			<span class="mainmenubullet">|</span>*}
			<a href="/rules.html">{$langdata._title_rules}</a>
			<span class="mainmenubullet">|</span>
			<a href="/reklama.html">{$langdata._title_reklama}</a>
			<span class="mainmenubullet">|</span>
			<a href="/contacts.html">{$langdata._title_contacts}</a>
			<span class="mainmenubullet">|</span>
			<a href="/notebook.html">{$langdata._title_bookmarks}</a>
</div>
	</div>
	
	<!--Header-->
	<div class="n_header">
		<div class="n_lang">
			{if $LANG==1}<span class="selectedlang">ru</span>{else}<a href="{$self_url}?{getRequest skip="lang"}lang=1" class="langitem">ru</a>{/if}
				{if $LANG==2}<span class="selectedlang">ua</span>{else}<a href="{$self_url}?{getRequest skip="lang"}lang=2" class="langitem">ua</a>{/if}
				{if $LANG==3}<span class="selectedlang">en</span>{else}<a href="{$self_url}?{getRequest skip="lang"}lang=3" class="langitem">en</a>{/if}
		</div>
		<a href="/" class="n_logo" />
			<img src="/images/logo_new.gif" alt="Доска бесплатных объявлений Reklama.com.ua" title="Доска бесплатных объявлений Reklama.com.ua" />
		</a>
		<div class="n_banner">
			{insert name="getBanner" type="0" cat_id=$smarty.request.cat_id}
		</div>
	</div>
	
</div>
{if !isAdmin()}
{*<!-- Statistic generation -->*}
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3289682-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>

{*<!-- YaMetrics begin -->*}
<script type="text/javascript"><!--
var ya_cid=88463;
//--></script>
<script src="http://bs.yandex.ru/resource/watch.js" type="text/javascript"></script>
<noscript><div style="display: inline;"><img src="http://bs.yandex.ru/watch/88463" width="1" height="1" alt=""></div></noscript>
{*<!-- YaMetrics end -->*}
{/if}
</body>
</html>
{/strip}
{/if}
