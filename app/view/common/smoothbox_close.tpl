<script type="text/javascript">
	var mydata="_m={$this->myPhp}";
	var q="{$this->getQuery()}";
	if( q!="" ) mydata+="&"+q;
	mydata+="&ajax=true";
	
		new Request.HTML( {literal}{{/literal} url:"/1.php", 
			method: "get",
			data: mydata,
			evalScripts: true,
			update: $("{$this->myParentId}"),
			onComplete: TB_init
			{literal}}{/literal}
		).send();

	{if $this->myParentId=="frame_"}
	TB_remove( );
	{/if}
</script>
