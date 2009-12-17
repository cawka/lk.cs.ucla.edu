<br/><br/>
{if !isset($smarty.request.ajax)}
{*strip*}
	</div>
<br/>
	<div id="footer">
		<a href="http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=" onclick="window.open('http://mailhide.recaptcha.net/d?k=01AkOqvipc-oi-UdWJ2oFbkg==&amp;c=sEnupUlCKOR8Mzqg1Q6ri_0Zra6jA0FVck8jpf9dnV4=', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;" title="Reveal this e-mail address">contact</a>
		|
		Copyright 2009 Alexander Afanasyev
{if isset($lastmodified)}
		|
		Last modified on {$lastmodified|date_format}
{/if}
	</div>
</div>

</body>
</html>
{*/strip*}
{/if}
