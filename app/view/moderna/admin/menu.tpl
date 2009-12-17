{include file="common/std_list_head.tpl"}

{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td>&nbsp;</td>
	<td>Menu item</td>
	<td>Link</td>
	<td>&nbsp;</td>
</tr>
{foreach name="list" from=$this->myData item=cat}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td><a href="javascript:;" onclick="setEdit('{$cat.id}','{$cat.name}','{$cat.link}','{$cat.display_order}','{$cat.width}','{$cat.target}')">{$cat.name}</a></td>
	<td>{$cat.link}</td>
	<td>{eval var=$this->getDeleteCtrl($cat)}</td>
</tr>
{/foreach}
</table>
{else}
{/if}

<script type="text/javascript">
function setEdit(id,name,link,display_order,width,target)
{literal}{
	$('kform').adopt( new Element('input', {type:'hidden', name:'id', value:id}) );{/literal}
	$('kform').set( 'action', '/{$this->myPhp}/save_edit' );
	$('name').set( 'value', name );
	$('link').set( 'value', link );
	$('display_order').set( 'value', display_order );
	$('width').set( 'value', width );
	$('target').set( 'value', target );
{literal}}{/literal}
</script>

{include file="common/form_pure.tpl" name="kform" method="post" ajax="true" action="save_add" columns=$this->myColumns}

{include file="common/foot.tpl"}
