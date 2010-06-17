{include file="common/head.tpl" title=$this->myTitle}	
{*strip*}
{if !isset($smarty.request.ajax)}
{if sizeof($this->myParentDataRev)>0}<h3>{$this->showBrief($this->myParentDataRev[0])}</h3>{/if}
{if $this->myTitle!=""}<h3>{$this->myTitle}</h3>{/if}
{if $this->getPageOffsetCtrl()!=""}<h3><span class="pagesblockinside">{$this->getPageOffsetCtrl()}</span></h3>{/if}

{if isset($this->mySearchColumns)}
Filter
{include file="common/form_pure.tpl" method="get" validate="false" name="search" action="index" data=$smarty.request submit="Filter"
	columns=$this->mySearchColumns column_pool=$this->myColumns parent_request=""}
{/if}

<div>
	{eval var=$this->getAddCtrl()}
</div>				

<div class="frame" id="frame_">
{/if}
