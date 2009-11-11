{if isUserLogged()}
<div style="float:left"><a class="smoothbox" href="/staticPages/edit?id=bibwiki"><img style="margin: 0pt; padding: 0pt; display: inline;" src="/images/admin/edit.gif" alt="" onmouseover="Tip('Edit')" height="12px"></a></div>
<div style="float:right"><a href="/login/logout">Logout</a></div>
<div style="clear:both"></div>
{/if}

{include file="common/head.tpl"
	title=$this->myStatic->myData.sp_title 
	meta_descr=$this->myStatic->myData.sp_meta_descr 
	meta_keywords=$this->myStatic->myData.sp_meta
	top_pic=$this->myStatic->myData.sp_top_figure
}


<table width="100%">
    <tbody>
        <tr>
            <td class="left">
				{if isset($menu->mySubData)}
                    {include file="common/submenu.tpl"}
                {/if}

				{if isUserLogged()}{$this->myStatic->menuContent->getEditCtrl($this->myStatic->menuContent->myData)}{/if}
				<div id='frame_1'>{eval var="`$this->myStatic->menuContent->myData.text` "}</div>
            </td>
            <td class="right"><!-- Actual content -->
				{if isUserLogged()}{$this->myStatic->mainContent->getEditCtrl($this->myStatic->mainContent->myData)}{/if}
				<div id='frame_0'>{eval var="`$this->myStatic->mainContent->myData.text` "}</div>

				{foreach name="outer" from=$this->myTypes item=type}
				<h1><a name="{$type.0}">{$type.1}</a></h1>
				<ol>
				{foreach name="list" from=$type.2 item=cat}
				<li style="margin-top:7px">
					{$this->myHelper->format_reference($cat.entry)}
					&nbsp;
					{if isset($cat.pdf) && $cat.pdf!=""}
					<a target="_blank" href="/papers/{$cat.pdf}"><img src="/images/pdf.png"></a>&nbsp;
					{/if}
					{if isUserLogged()}
					&nbsp;&nbsp;&nbsp;&nbsp;
					{eval var=$this->getEditCtrl($cat)}
					&nbsp;&nbsp;{eval var=$this->getDeleteCtrl($cat)}
					{/if}
				</li>
				{/foreach}
				</ol>
				{if isUserLogged()}{$this->getAddCtrl()}{/if}
				<br /><br /> 
				{/foreach}
            </td>
        </tr>
    </tbody>
</table>

{include file="common/foot.tpl"}
