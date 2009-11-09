{include file="common/head.tpl" 
	title=$this->myData.sp_title 
	meta_descr=$this->myData.sp_meta_descr 
	meta_keywords=$this->myData.sp_meta}
{strip}


<table width="100%">
    <tbody>
        <tr>
            <td class="left">
				{if isset($submenu)}
                    {include file="submenu.tpl"}
                {/if}
            </td>
            <td class="right"><!-- Actual content -->
                {if $this->myData.sp_title.0!=' '}<div class="title">{$this->myData.st_title|mxupper}</div>{/if}
				{if isUserLogged()}{$this->getEditCtrl($this->myData)}{/if}
                {eval var="`$this->myData.sp_text` "}
            </td>
        </tr>
    </tbody>
</table>
{*assign var="text" value=$this->myData.sp_text}
{eval var=$text|replace:"&gt;":">"|replace:"&lt;":"<"*}

{/strip}
{include file="common/foot.tpl"}
