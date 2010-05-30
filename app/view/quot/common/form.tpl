{include file="common/head.tpl" title=$this->myTitle}	
{strip}

{if isset($this->myImplicitAction)}
{assign var="myaction" value=$this->myImplicitAction}
{elseif $this->isId()}
{assign var="myaction" value="save_edit"}
{else}
{assign var="myaction" value="save_add"}
{/if}


{include file="common/form_pure.tpl" method="post" name="kform" action=$myaction data=$this->myData columns=$this->myColumns parent_request=$smarty.request._p ajax=$smarty.request.ajax}

{/strip}
{include file="common/foot.tpl"}
