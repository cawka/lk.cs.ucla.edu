<?php

class BaseColumn
{
	var $myName;
	var $myDescription;
	var $myRequired;
	var $myIsVisible;
	var $myIsBrief=false;
	var $myBriefMsg;
	var $mySQL=true;
	var $myGenType="";
	var $mySortName="";
	var $myError="";
	var $myIsReadonly=false;
	var $myToolTip="";
	var $mySpecType="";
	var $myIsBriefInTop=true;
	
	function BaseColumn( $name,$descr,$visible=true,$required=NULL,$brief=false,$brmsg="",$readonly=false )
	{
		$this->myName=$name;
		$this->myDescription=$descr;
		$this->myRequired=$required;
		$this->myIsVisible=$visible;
		$this->myIsBrief=$brief;
		$this->myBriefMsg=$brmsg;
		$this->myIsReadonly=$readonly;
	}
	
	function getUpdateName()
	{
		return $this->myName;
	}
	
	function checkBeforeSave( &$request ) 
	{
		return true;
	}

	function getInsert( &$request )
	{
		global $DB;
		if( !isset($request[$this->myName]) || $request[$this->myName]=="" )
			return "NULL";
		else
		{
			return $DB->qstr( stripslashes($request[$this->myName]) );
		}
	}

	function getId( )
	{
			return $this->myName;
	}
	
	function getUpdate( &$request )
	{
		return $this->getUpdateName()."=".$this->getInsert( $request );
	}
	
	function getTitle( )
	{
		return $this->myDescription;
	}
	
	function getValue( &$row )
	{
		//do nothing
	}
	
	function getInput( )
	{
		//do nothing
	}
	
	function postInsert( $id,&$data )
	{
	}
	
	function postUpdate( $id,&$data )
	{
	}
	
	function extractValue( &$row )
	{
		return $row[$this->myName];
	}
	
	function extractBriefValue( &$row )
	{
		return $this->extractValue( $row );
	}
	
	function extractPreviewValue( &$row )
	{
		return $this->extractValue( $row );
	}
	
	function extractAdminValue( &$row )
	{
		return $this->extractValue( $row );
	}

	function extractXMLValue( &$row )
	{
		return $row[$this->myName];
	}
	
	function getSortName( )
	{
		return $this->myName;
	}

	function getXML( $request )
	{
		if( !$this->mySQL || $this->myGenType=="separator" ) return "";
		if( "$this->myDescription"!="" ) 
			$ret="<!-- $this->myDescription -->\n";
		else
			$ret="";
		return $ret."<$this->myName>".$this->extractXMLValue($request)."</$this->myName>\n";
	}
}
?>
