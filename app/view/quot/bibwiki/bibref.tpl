{if isset($data.file) && $data.file!=""}
<a target="_blank" href="/papers/{$data.file}"><img src="{$wgScriptPath}/images/admin/pdf.png"></a>
{/if}
<a target="_blank" href="http://scholar.google.com/scholar?q=allintitle:{$data.title|urlencode}"><img src="{$wgScriptPath}/images/admin/scholar.png"></a>
{knownlink link=$data.key title="<small>wikiinfo</small>"}
{*refdescr bib=$data.entry*}
{parse_authors value=$data.authors}. <a target="_blank" href="{$wgScriptPath}/index.php/Special:BibCiter/key/{$data.key}">{$data.title}</a>. <i>{$data.journal}</i>, <b>{$data.date|date_format:"%Y"}</b>
<sup><a target="_blank" href="{$wgScriptPath}/index.php/Special:BibCiter/key/{$data.key}">Bib</a></sup>
<br/>
