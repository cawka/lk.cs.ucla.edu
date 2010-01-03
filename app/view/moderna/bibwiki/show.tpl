{knownlink link=$this->myData.key title="wikiinfo"}<br/>
{if isset($this->myData.file) && $this->myData.file!=""}
<a target="_blank" href="/papers/{$this->myData.file}"><img style="display:inline; border:0" src="{$wgScriptPath}/images/admin/pdf.png"></a>
{/if}
<a style="border:0" target="_blank" href="http://scholar.google.com/scholar?q=allintitle:{$this->myData.title|urlencode}"><img style="display:inline; border:0; vertical-align: top" src="{$wgScriptPath}/images/admin/scholar.png"></a>
<br/><br/>

{*refdescr bib=$this->myData.entry*}
{parse_authors value=$this->myData.authors}. <b>{$this->myData.title}</b>. <i>{$this->myData.journal}</i>, <b>{$this->myData.date|date_format:"%Y"}</b>

<pre>
Reference <b>&lt;bibref&gt;{$this->myData.key}&lt;/bibref&gt;</b>

Description <b>&lt;bibdescr&gt;{$this->myData.key}&lt;/bibdescr&gt;</b>
</pre>


<pre>
{$this->myData.entry}
</pre>
