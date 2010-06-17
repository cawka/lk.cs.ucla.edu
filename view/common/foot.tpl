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

</body>
</html>

{/if}
{/strip}
