{if !isset($smarty.request.ajax)}
{if isUserLogged()}
<div style="float:left"><a class="smoothbox" href="{$GLOBAL_PREFIX}staticPages/edit?id=bibwiki-{$smarty.request.biblio_type}"><img style="margin: 0pt; padding: 0pt; display: inline;" src="{$GLOBAL_PREFIX}images/admin/edit.gif" alt="" onmouseover="Tip('Edit')" height="12px"></a></div>
<div style="float:right"><a href="{$GLOBAL_PREFIX}login/logout">Logout</a></div>
<div style="clear:both"></div>
{/if}

{include file="common/head.tpl"
	title=$this->myStatic->myData.sp_title 
	meta_descr=$this->myStatic->myData.sp_meta_descr 
	meta_keywords=$this->myStatic->myData.sp_meta
	top_pic=$this->myStatic->myData.sp_top_figure

	menuContent=$this->myStatic->menuContent}

<script type="text/javascript">
var selfUrl="{$smarty.server.REQUEST_URI}";
</script>

				{if isUserLogged()}<p align="right">{$this->myStatic->mainContent->getEditCtrl($this->myStatic->mainContent->myData, "Edit Page")}</p>{/if}
				{if isUserLogged()}{$this->getAddCtrl("Add/import new publication")}<br/><br/>{/if}
				<div id='frame_0'>{eval var="`$this->myStatic->mainContent->myData.text` "}</div>
{/if}{* !isset(smarty.request.ajax)*}
				{if isUserLogged()}<div id="frame_">{/if}
				<ol>
				{foreach name="list" from=$this->myData item=cat}
				<li style="margin-top:14px">
					{$this->myHelper->format_reference($cat.entry)|replace:"L. Kleinrock":"<b>L. Kleinrock</b>"}
					&nbsp;
					{if isset($cat.pdf) && $cat.pdf!=""}
					<a target="_blank" href="{$cat.pdf|regex_replace:"%^/data%":"`$GLOBAL_PREFIX`data"}">[PDF]{*<img alt="pdf" src="{$GLOBAL_PREFIX}images/pdf.png">*}</a>
					{/if}
					&nbsp;
					{if isset($cat.slides) && $cat.slides!=""}
					<a target="_blank" href="{$cat.slides|regex_replace:"%^/data%":"`$GLOBAL_PREFIX`data"}">[SLIDES]</a>
					{/if}

					&nbsp;
					<a class="smoothbox_small" href="{$GLOBAL_PREFIX}bibwiki/bibtex?id={$cat.id}" title='BibTex Export' >[BibTex]</a>
					{if isUserLogged()}
					&nbsp;&nbsp;&nbsp;&nbsp;
					{eval var=$this->getEditCtrl($cat)}
					&nbsp;&nbsp;{eval var=$this->getDeleteCtrl($cat)}
					{/if}
				</li>
				{/foreach}
				</ol>
				{if isUserLogged()}</div>{/if}
{if !isset($smarty.request.ajax)}

{include file="common/foot.tpl" 
	lastmodified=$this->myStatic->myData.lastmodified}
{/if}
