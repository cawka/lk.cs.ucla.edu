{strip}
<br/><br/>
{if !isset($smarty.request.ajax)}
{*strip*}
	</div>
<br/>
	<div id="footer">
		<a href="http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=" onclick="window.open('http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;" title="Reveal this e-mail address">contact</a>&nbsp;
		|&nbsp;
		Copyright 2009 Alexander Afanasyev&nbsp;
{if isset($lastmodified)}
		|&nbsp;
		Last modified on {$lastmodified|date_format}
{/if}
	</div>
</div>
<br/>

{literal}
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2395047-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
  })();
</script>
{/literal}
</body>
</html>
{*/strip*}
{/if}
{/strip}
