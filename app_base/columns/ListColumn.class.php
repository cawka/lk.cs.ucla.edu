<?php

include_once( "BaseColumn.class.php" );

class ListColumn extends BaseColumn 
{
	var $myOptions;
	var $myClass;
	
	function ListColumn( $name,$descr,$required=NULL,$options,$brief=false,$brmsg="",$class="" )
	{
		$this->myOptions=$options;
		$this->myClass=$class;
		
		parent::BaseColumn( $name,$descr,true,$required,$brief,$brmsg );
	}
	
	function getValue( &$row )
	{
		return $row[$this->myName];
	}
	
	function checkBeforeSave( &$request )
	{
		return isset( $this->myOptions[$request[$this->myName]] );
	}
		
	function getInput( &$row )
	{
		$ret="<select class='addann_select$this->myClass' name='$this->myName' ";
		if( $this->myToolTip!="" ) $ret.=" onmouseover=\"Tip('$this->myToolTip')\" ";
		$ret.=">\n";
		foreach( $this->myOptions AS $key=>$value )
		{
			$ret.="<option value='$key'";
			if( "$key"==$this->getValue($row) ) $ret.=" selected='selected'";
			$ret.=">$value</option>\n";
		}
		$ret.="</select>\n";

		return $ret;
	}
	
	function extractValue( &$row )
	{
		return $this->myOptions[$row[$this->myName]];
	}

	function getXML( $row )
	{
		$ret="<!-- $this->myDescription \n";
		foreach( $this->myOptions AS $key=>$value )
		{
			$ret.="$key=>\"$value\" "; 
		}
		$ret.="-->\n";

		return $ret."<$this->myName>".$this->extractXMLValue($row)."</$this->myName>";
	}
}

?>
