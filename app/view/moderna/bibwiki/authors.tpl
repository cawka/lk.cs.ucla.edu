<br style="clear:both;"/>
<table width="100%">
<tr valign="top"><td>
<ul>
{foreach name="for" from=$this->myAuthors item="author"}
	{if $smarty.foreach.for.first}<td>{/if}
	
	{if $smarty.foreach.for.iteration>1 && ($smarty.foreach.for.iteration-1)% ((count($this->myAuthors)+2)/3)==0}
	</ul></td><td>
		{if $last_start==$author.0|strtoupper}
		<h3>{$author.0|strtoupper} (cont.)</h3><ul>
		{/if}
	{/if}
	
	{if $last_start!=$author.0|strtoupper}
	</ul><h3>{$author.0|strtoupper}</h3><ul>
	{assign var="last_start" value=$author.0|strtoupper}
	{/if}
	<li><a style="font-size: {$this->mySizes.$author}pt" href="{$wgScriptPath}{getNormalizedUrl}?authors={$this->myAuthorDescr.$author.surname}">{$author}</a></li>
{/foreach}
</ul></td></tr></table>
