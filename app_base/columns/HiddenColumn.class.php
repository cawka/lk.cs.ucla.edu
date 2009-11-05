<?php
include_once( "BaseColumn.class.php" );

class HiddenColumn extends BaseColumn 
{
	var $myValue;
	
	function HiddenColumn( $name,$value )
	{
		parent::BaseColumn( $name,"",false,NULL );
		$this->myValue=$value;
	}
	
	function getValue( &$row  )
	{
		return $this->myValue;
	}
	
	function getInput( &$row )
	{
		if( isset($this->myValue) )
		{
			return "<input type='hidden' name='$this->myName' value='".$this->getValue($row)."' />";
		}
		else  
		{
			return "";
		}
	}
	
	function extractValue( &$row )
	{
		return "";
	}
}

class HiddenColumnExactValue extends HiddenColumn 
{
	function getInsert( &$req )
	{
		return $this->myValue;
	}
}

class HiddenColumnType2 extends BaseColumn 
{
	var $myValue;
	
	function HiddenColumnType2( $name )
	{
		parent::BaseColumn( $name,"",false,NULL );
//		print $this->myName;
//		die;
	}
	
	function getValue( &$row )
	{
		return $row[$this->myName];
	}
	
	function getInput( &$row )
	{
		if( isset($this->myValue) )
		{
			return "<input type='hidden' name='$this->myName' value='".$this->getValue($row)."' />";
		}
		else  
		{
			return "";
		}
	}
}

class HiddenColumnType3 extends BaseColumn 
{
	var $myField;
	
	function HiddenColumnType3( $name,$field )
	{
		$this->myField=$field;
		parent::BaseColumn( $name,"",false,NULL );
	}
	
	function getValue( &$row )
	{
		return $row[$this->myField];
	}
	
	function getInput( &$row )
	{
		if( $this->getValue($row)!==null )
		{
			return "<input type='hidden' name='$this->myName' value='".$this->getValue($row)."' />";
		}
		else  
		{
			return "";
		}
	}
}

?>
