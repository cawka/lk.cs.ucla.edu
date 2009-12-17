<?php

class RevisionsColumn extends BaseColumn 
{
	function __construct( $descr )
	{
		parent::BaseColumn( "", $descr,true,NULL,false,"",false );
		$this->mySQL=false;
	}
	
	function getInput( &$request )
	{
		
		return "<a href='/textRevisions/?text_id=$request[id]'>Show revisions</a>";
	}
}

?>
