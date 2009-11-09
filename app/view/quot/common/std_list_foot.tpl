{if !isset($smarty.request.ajax)}
</div>

<div class="sectioninside">
	{eval var=$this->getAddCtrl()}
</div>				

{if isset($this->mySearchColumns)}
<script>
//alter_search( $("search"), "frame_" );
</script>
{/if}

{/if}
{*/strip*}

{include file="common/foot.tpl"}
