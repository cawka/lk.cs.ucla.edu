{assign var=lastmodified value=$this->myData.lastmodified}
{strip}
{if !isset($smarty.request.ajax) && isUserLogged()}
<div style="float:left">{$this->getEditCtrl($this->myData)}</div>
<div style="float:right"><a href="{$GLOBAL_PREFIX}login/logout">Logout</a></div>
<div style="clear:both"></div>
{/if}
{include file="common/head.tpl" 
	title=$this->myData.sp_title 
	meta_descr=$this->myData.sp_meta_descr 
	meta_keywords=$this->myData.sp_meta
	top_pic=$this->myData.sp_top_figure

	menuContent=$this->menuContent}

{if !isset($smarty.request.ajax)}
	{*if $this->myData.sp_title.0!=' '}<div class="title">{$this->myData.st_title|mxupper}</div>{/if*}
	
	{if isUserLogged()}<p align="right">{$this->mainContent->getEditCtrl($this->mainContent->myData, "Edit Page")}</p>{/if}
	<div id='frame_0'>
{/if}
		{eval var="`$this->mainContent->myData.text`"|replace:"\"/data/":"\"`$GLOBAL_PREFIX`data/"}
{if !isset($smarty.request.ajax)}
	</div>
{/if}

{include file="common/foot.tpl" 
	lastmodified=$lastmodified}
{/strip}

