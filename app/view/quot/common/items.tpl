<div class="yui-u">
{foreach from=$this->myData item=i}
	{if isUserLogged()}
	<div style="float:right">
		&nbsp;&nbsp;
		<a name="Edit" href="items/edit?id={$i.id}" class="smoothbox"><img height="12px" onmouseover="Tip('Edit')" alt="" src="/images/admin/edit.gif" style="margin: 0pt; padding: 0pt; display: inline;"/></a>

		<a onclick="if( confirm('Are you sure?') ) del('items/delete','id={$i.id}','frame_')" href="javascript:;"><img height="12px" onmouseover="Tip('Delete')" alt="" src="/images/admin/delete.gif" style="margin: 0pt; padding: 0pt; display: inline;"/></a>	
	</div>
	{/if}
	<h4 class="job_year">{$i.years}</h4>
	{if isset($i.image)}<a href="{$i.image}" class="smoothbox"><p style="float:left; margin:4px;"><img src="{$i.image}" title="{$i.title}" style="height:50px" /></a><p>{/if}
	<div class="job">
	<h2>{$i.bold_title}</h2>
	<h3>{if isset($i.link)}
			<a href="{$i.link}" target="_blank">{$i.title}</a>
		{else if isset($i.image)}
			<a href="{$i.image}" class="smoothbox">{$i.title}</a>
		{else}
			{$i.title}
		{/if}</h3>
	<p><small>{$i.descr}</small></p>

	</div>
	<div class="line"></div>

{/foreach}
</div>

{if isUserLogged()}
<a href="items/add?type={$type}" title="Add" class="smoothbox">Add</a>
{/if}

