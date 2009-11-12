{if !isset($smarty.request.ajax) && isUserLogged()}
<div style="float:left">{$this->getEditCtrl($this->myData)}</div>
<div style="float:right"><a href="/login/logout">Logout</a></div>
<div style="clear:both"></div>
{/if}

{include file="common/head.tpl" 
	title=$this->myData.sp_title 
	meta_descr=$this->myData.sp_meta_descr 
	meta_keywords=$this->myData.sp_meta
	top_pic=$this->myData.sp_top_figure
}
{strip}

{if $this->menuContent->myData.text=="" && !isset($menu->mySubData)}
	{if isUserLogged()}{$this->menuContent->getEditCtrl($this->menuContent->myData)}<br/>{/if}

	{if isUserLogged()}<div style="float:right">{$this->mainContent->getEditCtrl($this->mainContent->myData)}</div>{/if}
	{if !isset($smarty.request.ajax)}<div id='frame_0'>{/if}
	{eval var="`$this->mainContent->myData.text` "}
	{if !isset($smarty.request.ajax)}</div>{/if}
{else}

{if !isset($smarty.request.ajax)}
<table width="100%">
    <tbody>
        <tr>
            <td class="left">
				{if isset($menu->mySubData)}
                    {include file="common/submenu.tpl"}
                {/if}

				{if isUserLogged()}{$this->menuContent->getEditCtrl($this->menuContent->myData)}{/if}
				<div id='frame_1'>{eval var="`$this->menuContent->myData.text` "}</div>
            </td>
            <td class="right"><!-- Actual content -->
                {*if $this->myData.sp_title.0!=' '}<div class="title">{$this->myData.st_title|mxupper}</div>{/if*}
				
				{if isUserLogged()}{$this->mainContent->getEditCtrl($this->mainContent->myData)}{/if}
				<div id='frame_0'>
{/if}
				{eval var="`$this->mainContent->myData.text` "}
{if !isset($smarty.request.ajax)}
</div>
            </td>
        </tr>
    </tbody>
</table>
{/if}
{/if}

{/strip}
{include file="common/foot.tpl"}
