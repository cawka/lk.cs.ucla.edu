<script type="text/javascript">
	var q="{$this->getQuery()}";
	if( q!="" ) mydata=q;
	mydata+="&ajax=true";
	
		new Request.HTML( {literal}{{/literal} url:"/{$this->myPhp}/{$this->myRefreshAction}", 
			method: "get",
			data: mydata,
			evalScripts: true,
			update: $("{$this->myParentId}")
/*,
			onComplete: TB_init*/
			{literal}}{/literal}
		).send();

	{if $this->myParentId!="TB_ajaxContent"}
	TB_remove( );
	{/if}
</script>
