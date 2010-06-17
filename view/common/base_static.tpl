{*{include file="common/head.tpl" 
	title=$this->myStaticPage->myData.sp_title 
	meta_descr=$this->myStaticPage->myData.sp_meta_descr 
	meta_keywords=$this->myStaticPage->myData.sp_meta}*}
{strip}
{if isAdmin()}{$this->myStaticPage->getEditCtrl($this->myStaticPage->myData)}{/if}

{assign var="text" value=$this->myStaticPage->myData.sp_text}
{eval var=$text|replace:"&gt;":">"|replace:"&lt;":"<"}
{/strip}
{*{include file="common/foot.tpl"}*}
