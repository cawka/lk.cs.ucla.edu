{include file="common/head.tpl" title=$this->myTitle}	
{strip}

{if $this->isId()}
{assign var="myaction" value="save_edit"}
{else}
{assign var="myaction" value="save_add"}
{/if}

{include file="common/form_pure.tpl" method="post" name="kform" action=$myaction data=$this->myData columns=$this->myColumns parent_request=$smarty.request._p ajax=$smarty.request.ajax}

{*<script type="text/javascript">
{if isset($smarty.request.ajax)}
//alter_submit( $("kform"),$("TB_ajaxContent") );
{literal}
	new FormCheck('kform', {
							submitByAjax : true,
							ajaxEvalScripts : true,
							ajaxResponseDiv : $("TB_ajaxContent"),
							display: { indicateErrors : 2, errorsLocation : 3 }
						   } );
{/literal}
{else}
{literal}
	new FormCheck('kform', {
							display: { indicateErrors : 2, errorsLocation : 3 }
						   } );
{/literal}
{/if}
</script>
*}

{/strip}
{include file="common/foot.tpl"}
