{include file="common/head.tpl" 
	title=$this->myData.sp_title 
	meta_descr=$this->myData.sp_meta_descr 
	meta_keywords=$this->myData.sp_meta}
{strip}
{if isAdmin()}{$this->getEditCtrl($this->myData)}{/if}

{assign var="text" value=$this->myData.sp_text}
{eval var=$text|replace:"&gt;":">"|replace:"&lt;":"<"}

{/strip}
{include file="common/foot.tpl"}
