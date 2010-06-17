{if isUserLogged()}{$this->getAddCtrl("Add/import new publication")}<br/><br/>{/if}
<div id='frame_0'>{eval var="`$this->myStatic->mainContent->myData.text` "}</div>
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
