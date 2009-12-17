<?php

class StaticColumn extends BaseColumn 
{
	function StaticColumn( $name, $descr )
	{
		parent::BaseColumn( $name,$descr,true,NULL,false,"",false );
		$this->mySQL=false;
	}
	
	function getInput( &$request )
	{
		$ret="<span id='copy_$this->myName' ></span>
		{literal}
		<script type='text/javascript'>
		Event.observe( $('$this->myName'), 'change', function(){
			Element.update( $('copy_$this->myName'), $('$this->myName').value.replace(/\\n/g,'<br/>') ); 
		} );
		Element.update( $('copy_$this->myName'), $('$this->myName').value.replace(/\\n/g,'<br/>') ); 
		</script>
		{/literal}
		";
		return $ret;
	}
//	function extractValue( &$row )
//	{
//		return "";
//	}
}

?>
