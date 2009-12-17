<?php


class MenuHelper// extends RecursiveDataHelper
{
	var $myData=array("Home", "Publications");

	function __construct( ) //$selected,&$parentobj,&$inforow,$parentid=NULL )
	{
//		parent::__construct( $selected,$parentobj,$inforow,$parentid,"menu","id"," myorder!=-200 AND ","","myorder","title" );
	}
	
	function getLink( $id )
	{
		return "$id/";
	}
	
	function isSelected( &$row )
	{
		return $this->mySelectedRow['id']==$_REQUEST['id'];
	}
}

?>
