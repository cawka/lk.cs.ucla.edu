{strip}
{if !isset($smarty.request.ajax)}
</td>
</tr>
</table>
	</div>
	<div class="footer">
		<hr />
		<table width="100%"><tr>
		<td width="33%" align="center">
			Copyright 2009 Leonard Kleinrock. &nbsp; All rights reserved
		</td>
{if isset($lastmodified)}
		<td width="33%" align="center">
		Last modified on {$lastmodified|date_format}
		</td>
{/if}
		<td width="33%" align="center">
			Email: <a href="mailto:lk@cs.ucla.edu">lk@cs.ucla.edu</a>
		</td>
		</tr></table>
		<br/><br/>
	</div>
</div>
{*<script type="text/javascript">
{foreach from=$menu->myData item="i"}
menu{$i.id} = new FSMenu('menu{$i.id}', true, 'display', 'block', 'none');
menu{$i.id}.hideOnClick = false;
menu{$i.id}.hideDelay = 0;
menu{$i.id}.switchDelay=0;

addEvent(window, 'load', new Function('menu{$i.id}.activateMenu("menu_{$i.id}",null)'));
{/foreach}
</script>*}

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22803652-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>

{/if}
{/strip}
