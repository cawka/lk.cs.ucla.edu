<script type="text/javascript">
	{if $this->myParentId!="TB_ajaxContent"}
	TB_remove( );
	{/if}
	var req="/{$this->myPhp}/{$this->myRefreshAction}";
	if( selfUrl!==undefined ) req=selfUrl;

	var mydata="";
	var q="{$this->getQuery()}";
	if( q!="" ) mydata=q;
	mydata+="ajax=true";
	
		new Request.HTML( {literal}{{/literal} url: req, 
			method: "get",
			data: mydata,
			evalScripts: true,
			update: $("{$this->myParentId}"),
			onComplete: TB_init
			{literal}}{/literal}
		).send();
;
</script>
