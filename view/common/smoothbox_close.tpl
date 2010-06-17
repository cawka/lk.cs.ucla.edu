<script type="text/javascript">
{if isset($this->RefreshByReload)}
	TB_remove( );
	window.location.reload();
{else}
	var req="{$GLOBAL_PREFIX}{$this->myPhp}/{$this->myRefreshAction}";
{if $this->myParentId!="TB_ajaxContent"}
	if( typeof(selfUrl)!="undefined" ) req=selfUrl;
	TB_remove( );
{/if}
	
	var mydata="{$this->getQuery()}";
	if( mydata!="" ) mydata+="&";
	mydata+="ajax=true";

	new Request.HTML( {literal}{{/literal} url: req, 
			method: "get",
			data: mydata,
			evalScripts: true,
			update: $("{$this->myParentId}"),
			onComplete: TB_init
			{literal}}{/literal}
		).send();
{/if}
</script>
