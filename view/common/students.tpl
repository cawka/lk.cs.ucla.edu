{if isUserLogged()}
<a href="students/add" title="Add" class="smoothbox">Add student</a><br/><br/>
{/if}

{strip}
<div class="yui-u">
{foreach from=$this->myData item=i}
	{if isUserLogged()}
	<div style="float:right">
		&nbsp;&nbsp;
		{$this->getEditCtrl($i)}
		{$this->getDeleteCtrl($i)}
	</div>
	{/if}
	<h4 class="job_year">{$i.year}</h4>
	{if isset($i.image)}<div style="float:right"><p style="float:left; margin:4px;"><img src="{$i.image}" title="{$i.name}" style="height:50px" /><p></div>{/if}
	<div class="job">
	<h2>{if isset($i.link)}
			<a href="{$i.link}" target="_blank">{$i.name}</a>
		{else}
			{$i.name}
		{/if} <span style="font-style: normal; font-size: 8pt; font-weight: normal;"
>({$i.title}
{if isset($i.city)}, {$i.city}{/if}
{if isset($i.state)}, {$i.state}{/if})</span></h2>
	<p><small>{$i.disser}</small></p>

	</div>
	<div class="line"></div>

{/foreach}
</div>
{/strip}

