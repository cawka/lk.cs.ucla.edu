{if !isset($smarty.request.ajax)}
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

	menuContent=$this->myStatic->menuContent
}

<script type="text/javascript">
var selfUrl="{$smarty.server.REQUEST_URI}";
</script>

				{if isUserLogged()}{$this->myStatic->mainContent->getEditCtrl($this->myStatic->mainContent->myData)}{/if}
				<div id='frame_0'>{eval var="`$this->myStatic->mainContent->myData.text` "}</div>
{/if}{* !isset(smarty.request.ajax)*}
				{if isUserLogged()}<div id="frame_">{/if}
				{foreach name="outer" from=$this->myTypes item=type}
				<h5>{*<a name="{$type.0}">*}{$type.1}{*</a>*}</h5>
				<ol>
				{foreach name="list" from=$type.2 item=cat}
				<li style="margin-top:14px">
					{$this->myHelper->format_reference($cat.entry)|replace:"A. Afanasyev":"<b>A. Afanasyev</b>"}
					&nbsp;
					{if isset($cat.pdf) && $cat.pdf!=""}
					<a target="_blank" href="/data/files/{$cat.pdf|replace:"/data/files/":""|replace:" ":"%20"|replace:"?":"%3F"}">[PDF]{*<img alt="pdf" src="/images/pdf.png">*}</a>
					{/if}
					&nbsp;
					<a class="smoothbox" href="/bibwiki/bibtex?id={$cat.id}&amp;width=50&amp;height=50" title='BibTex Export' >[BibTex]</a>
					{if isUserLogged()}
					&nbsp;&nbsp;&nbsp;&nbsp;
					{eval var=$this->getEditCtrl($cat)}
					&nbsp;&nbsp;{eval var=$this->getDeleteCtrl($cat)}
					{/if}
				</li>
				{/foreach}
				</ol>
				<br /> 
				{/foreach}
				{if isUserLogged()}{$this->getAddCtrl("Add/import new publication")}{/if}
				{if isUserLogged()}</div>{/if}
{if !isset($smarty.request.ajax)}

{include file="common/foot.tpl" 
	lastmodified=$this->myStatic->myData.lastmodified}}
{/if}
