{if !isset($smarty.request.ajax)}
{strip}

</div>
	<div class="footer">
		<hr />
		<table width="100%"><tr>
		<td width="33%" align="center">
			Copyright 2009 Leonard Kleinrock. &nbsp; All rights reserved
		</td>
		<td width="33%" align="center">
			Email: <a href="mailto:lk@cs.ucla.edu">lk@cs.ucla.edu</a>
		</td>
		</tr></table>
		<br/><br/>
	</div>
</div>
<script type="text/javascript">
{foreach from=$menu->myData item="i"}
menu{$i.id|replace:"-":"_"} = new FSMenu('menu{$i.id}', true, 'display', 'block', 'none');
{*
//menu{$i.id|replace:"-":"_"}.animations[menu{$i.id|replace:"-":"_"}.animations.length] = FSMenu.animFade;
//menu{$i.id|replace:"-":"_"}.animations[menu{$i.id|replace:"-":"_"}.animations.length] = FSMenu.animSwipeDown;

*}
menu{$i.id|replace:"-":"_"}.hideOnClick = false;
menu{$i.id|replace:"-":"_"}.hideDelay = 0;
menu{$i.id|replace:"-":"_"}.switchDelay=0;

addEvent(window, 'load', new Function('menu{$i.id|replace:"-":"_"}.activateMenu("menu_{$i.id}",null)'));
{*//addEvent(window, 'load', new Function('listMenu.activateMenu("listMenuRoot", arrow)'));
*}
{/foreach}
</script>

</body>
</html>
{/strip}
{/if}
