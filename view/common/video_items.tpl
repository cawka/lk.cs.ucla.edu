{strip}
{if !isset($smarty.request.ajax) && isUserLogged()}
<div style="float:left">
<a class="smoothbox" href="{$GLOBAL_PREFIX}staticPages/edit?id=videos-{$smarty.request.page}"><img style="margin: 0pt; padding: 0pt; display: inline;" src="{$GLOBAL_PREFIX}images/admin/edit.gif" alt="Edit" height="12px"></a>
</div>
<div style="float:right"><a href="{$GLOBAL_PREFIX}login/logout">Logout</a></div>
<div style="clear:both"></div>
{/if}
{include file="common/head.tpl" 
	title=$this->myStatic->myData.sp_title 
	meta_descr=$this->myStatic->myData.sp_meta_descr 
	meta_keywords=$this->myStatic->myData.sp_meta
	top_pic=$this->myStatic->myData.sp_top_figure

	menuContent=$this->menuContent}

{if !isset($smarty.request.ajax)}
	<div id='frame_0'>
{/if}

{if isUserLogged()}
<a class="smoothbox" href="/videos/add?page={$smarty.request.page}">Add new video</a>
<br/><br/>
{/if}


{foreach from=$this->myData item=i}

	{if isUserLogged()}
	<div style="float:right">
		&nbsp;&nbsp;
		<a name="Edit" href="/videos/edit?id={$i.id}&amp;page={$i.page}" class="smoothbox"><img height="12px" alt="Edit" src="/images/admin/edit.gif" style="margin: 0pt; padding: 0pt; display: inline;"/></a>

		<a onclick="if( confirm('Are you sure?') ) del('videos/delete','id={$i.id}','frame_')" href="javascript:;"><img height="12px" alt="Delete" src="/images/admin/delete.gif" style="margin: 0pt; padding: 0pt; display: inline;"/></a>	
	</div>
	{/if}

<div class="video">
	<h1>{$i.title}</h1>

	<p>{$i.description|strip_tags|replace:"\n":"<br />"}</p>

	<p align="center">
	<embed id="ply" width="500" height="400"
		type="application/x-shockwave-flash" 
		style="" 
		src="/data/flash/player.swf" 
		quality="high" name="ply" 
		flashvars="file={$i.video}&image={$i.video}.jpg" 
		bgcolor="#FFFFFF" allowscriptaccess="always" allowfullscreen="true"/>
	</p>
	<br/><br/>
</div>
{/foreach}

{if !isset($smarty.request.ajax)}
	</div>
{/if}

{include file="common/foot.tpl" 
	lastmodified=$this->myData.lastmodified}
{/strip}

