{include file="common/head.tpl"}
{if !isset($smarty.request.ajax)}
<div id="frame_">
{/if}
<div id="statistics">

<h2>{$this->myTitle}</h2>
{assign var="date" value=""}


{foreach name="list" from=$this->myData item="i"}
{assign var="newdate" value="$i.date"|date_format:"%A, %B %e, %Y"}
{if $newdate!=$date}
	{if $date!=""}</table>{/if}
	{assign var="date" value=$newdate}
	<table class='keyword_block'>
      <tr>
        <td colspan='5'>
          <div class='date'>{$date}</div>
        </td>
      </tr>
      <tr class='referer-list-header'>
        <td class='referer-query'>Keywords</td>
        <td class='referer-time'>Time (local)</td>
        <td class='referer-service'>Search Engine</td>
{*        <td class='referer-rank'>
          <a class='tooltip' href='#' title='This shows what position your page was in the search results.'>Rank</a>
        </td>*}
        <td class='referer-country'>IP</td>
        <td class='referer-delete'>
          &nbsp;
        </td>
      </tr>
{/if}

<tr class='referer-item'>
        <td class='referer-query'><a target="_blank" href="{$i.referer}">{$i.keywords}</a><br />
        </td>
        <td class='referer-time'>{$i.date|date_format:"%I:%M%p"}</td>
        <td class='referer-service'>Google</td>
		<td class='referer-country'><a target="_blank" href="http://www.geoiptool.com/en/?IP={$i.ip}">{$i.ip}</a></td>
        <td class='referer-delete'>{eval var=$this->getDeleteCtrl($i)}</td>
      </tr>
{/foreach}
{if $date!=""}</table>{/if}
</div>
{if !isset($smarty.request.ajax)}
</div>
{/if}
{include file="common/foot.tpl"}
