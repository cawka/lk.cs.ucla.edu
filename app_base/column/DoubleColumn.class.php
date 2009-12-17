<?php

class DoubleColumn extends TextColumn 
{
	var $myDefault;
	
	function DoubleColumn( $name,$descr,$required=NULL,$brief=false,$brmsg="",$default=NULL,$length=0,$class="",$opt_msg="",$opt="" )
	{
		parent::TextColumn( $name,$descr,$required,$brief,$brmsg,$class,$opt_msg,false,$opt );
		
		$this->myAdditional=" tmt:pattern='number' tmt:filters='commastodots,numbersdots' ";//tmt:filters=\"numbersonly\"";
		$this->myDefault=$default;
////		$this->myLength=$length;
//		$this->myIsVisible=true;
	}
	
	function checkBeforeSave( &$request ) 
	{
		$test=trim( $request[$this->myName] );
		return $test=="" || is_numeric( $test );
	}
	
	function getInsert( &$request )
	{
		if( !isset($this->myDefault) || is_numeric($request[$this->myName]) ) 
			return parent::getInsert( $request );
		else 
			return "'$this->myDefault'";
	}

	function extractBriefValue( &$row )
	{
		if( parent::extractBriefValue($row)!="" )
			return "<center>".parent::extractBriefValue($row)."</center>";
		else 
			return "";
	}
	
	function extractPreviewValue( &$row )
	{
		return parent::extractBriefValue( $row );
	}	

	function extractAdminValue( &$row )
	{
		return $this->extractPreviewValue( $row );
	}
}

?>
