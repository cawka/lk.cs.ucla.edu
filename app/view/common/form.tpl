{include file="common/head.tpl" title=$this->myTitle}	
{strip}

{if $this->isId()}
{assign var="myaction" value="save_edit"}
{else}
{assign var="myaction" value="save_add"}
{/if}


{include file="common/form_pure.tpl" method="post" name="kform" action=$myaction data=$this->myData columns=$this->myColumns parent_request=$smarty.request._p}
<div id='test'></div>
{if isset($smarty.request.ajax)}
<script type="text/javascript">

alter_submit( $("kform"),$("TB_ajaxContent"),[] );
{*literal}
function FCKeditor_OnComplete( editorInstance ) { editorInstance.LinkedField.form.onsubmit = function() {return false;}; }
{/literal*}


</script>
{/if}

{/strip}
<!--Подвал-->
{include file="common/foot.tpl"}
