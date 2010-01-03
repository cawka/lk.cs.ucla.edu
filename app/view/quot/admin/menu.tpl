{include file="common/std_list_head.tpl"}

{if sizeof($this->myData)>0}
<table summary="" width="100%">
<tr class='ann_header'>
	<td>&nbsp;</td>
	<td>Menu item</td>
	<td width="20%">Link</td>
	<td>&nbsp;</td>
</tr>
{foreach name="list" from=$this->myData item=cat}
<tr>
	<td>{$smarty.foreach.list.iteration}</td>
	<td><a href="javascript:;" onclick="setEdit('{$cat.id}',$('name{$cat.id}').get('text'),$('descr{$cat.id}').get('text'),'{$cat.link}','{$cat.display_order}','{$cat.width}','{$cat.target}')"><span id="name{$cat.id}">{$cat.name}</span></a> <span id="descr{$cat.id}">{$cat.description}</span></td>
	<td width="20%">{$cat.link}</td>
	<td>{eval var=$this->getDeleteCtrl($cat)}</td>
</tr>
{/foreach}
</table>
{else}
{/if}

<script type="text/javascript">
function setEdit(id,name,descr,link,display_order,width,target)
{literal}{
	$('kform').adopt( new Element('input', {type:'hidden', name:'id', value:id}) );{/literal}
	$('kform').set( 'action', '{$GLOBAL_PREFIX}{$this->myPhp}/save_edit' );
	$('name').set( 'value', name );
	$('description').set( 'value', descr );
	$('link').set( 'value', link );
	$('display_order').set( 'value', display_order );
	$('width').set( 'value', width );
	$('target').set( 'value', target );
{literal}}{/literal}
</script>

{include file="common/form_pure.tpl" name="kform" method="post" ajax="true" action="save_add" columns=$this->myColumns}

{include file="common/foot.tpl"}
