{include file="common/std_list_head.tpl"}

{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td>&nbsp;</td>
	<td>Контроллер</td>
	<td>Действие</td>
	<td>&nbsp;</td>
</tr>
{foreach name="list" from=$this->myData item=cat}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td>{$cat.controller_id}</td>
	<td>{$cat.allow_action|default}</td>
	<td>{eval var=$this->getDeleteCtrl($cat)}</td>
</tr>
{/foreach}
</table>
{else}
{/if}

{if !isset($smarty.request.ajax)}
</div>

{*<div class="sectioninside">
	{eval var=$this->getAddCtrl()}
</div>
*}

{if isset($this->mySearchColumns)}
<script>
alter_search( $("search"), "" );
</script>
{/if}

{else}

{include file="common/form_pure.tpl" name="kform" ajax="true" action="save_add" columns=$this->myColumns}
<script type="text/javascript">
alter_submit( $("kform"),$("TB_ajaxContent"),[] );
</script>

{/if}
{*/strip*}

{include file="common/foot.tpl"}
