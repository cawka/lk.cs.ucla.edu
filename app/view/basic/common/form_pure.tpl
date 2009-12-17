{form_ctrl name=$name|default:"kform" action=$action validate=$validate|default:"true" id=$name|default:"kform" model=$this data=$data method=$method}
{if isset($ajax)}<input type="hidden" name="ajax" value="true">{/if}
{if isset($parent_request)}
<input type="hidden" name="_p" value="{$parent_request}" />
{/if}

<table width="100%" class="r_table">
{if isset($error)}
<tr>
	<td colspan="2">
	<p class="r_error">{$error}</p>
	</td>
</tr>
{/if}

{foreach from=$columns item=col}
{if isset($column_pool)}
	{if isset($col.name)}
		{assign var="colname" value=$col.name}
		{assign var="col" value=$column_pool.$colname}
	{else}
		{assign var="col" value=$col.column}
	{/if}
{/if}
{if $col->myIsVisible}
<tr>
	{if $col->myGenType!="separator"}
		<td class="r_td r_td_left"><label for="{$col->getId()}">{$col->myDescription}</label></td>
		<td class="r_td">{$col->getInput($data)}</td>
	{else}
		<td class="r_td r_td_left" colspan="2">{$col->myDescription}</td>
	{/if}
</tr>
{else}
	{eval var=$col->getInput($data)}
{/if}
{/foreach}

<tr>
	<td colspan="2" class="r_td r_td_left"> 
		{if $this->isId()}
			<input name="edit" type="hidden" value="1" />
			<input name="{$this->myId}" type="hidden" value="{$this->getId()}" />
		{/if}
		<input accesskey="s" type="submit" class="button" value="{$submit|default:"Save"}"> 
	</td>
</tr>
</table>

<script type="text/javascript">
{if isset($ajax)}
{literal}
    new FormCheck('{/literal}{$name|default:"kform"}{literal}', {
                            submitByAjax : true,
                            ajaxEvalScripts : true,
                            ajaxResponseDiv : $("TB_ajaxContent"),
                            display: { indicateErrors : 2, errorsLocation : 3 }
                           } );
{/literal}
{else}
{literal}
    new FormCheck('{/literal}{$name|default:"kform"}{literal}', {
                            display: { indicateErrors : 2, errorsLocation : 3 }
                           } );
{/literal}
{/if}
</script>
