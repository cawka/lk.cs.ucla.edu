{include file="common/head.tpl"}

<ul>
{foreach name="list" from=$this->myData item=i}
	<li>
	{$i.modified|date_format:"%D %T"}
	&nbsp;
	<a class="smoothbox" href="{$GLOBAL_PREFIX}textRevisions/show?id={$i.id}">Show</a>
	&nbsp;
	<a class="smoothbox" href="{$GLOBAL_PREFIX}textRevisions/diff?id={$i.id}">Diff</a>
{*	&nbsp;
	&nbsp;
	&nbsp;
	Restore*}
	</li>
{/foreach}
</ul>

{include file="common/foot.tpl"}
