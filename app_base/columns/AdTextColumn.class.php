<?php

include_once( "TextAreaColumn.class.php" );

class AdTextColumn extends TextAreaColumn 
{
//	var $myGenType="adtext";
	function AdTextColumn( $name,$descr,$required=NULL,$brief=false,$brmsg="",$class="",$opt_msg="",$readonly=false,$opt="" )
	{
		parent::TextColumn( $name,$descr,$required,$brief,$brmsg,$class,$opt_msg,$readonly,$opt );
		$this->mySpecType="adtext";
	}
	
	function extractBriefValue( &$row )
	{
		if( isset($row[$this->myName."_special"]) ) return $row[$this->myName."_special"];
		
		$ret=$this->myTable->getExtraBrief( $row );
		if( utf8_strlen($ret)>150 ) $ret=utf8_substr( $ret,0,150 )."...";

		if( $ret!="" ) $ret.="<br/>";
		$ret.=parent::extractBriefValue( $row );

		if( utf8_strlen($ret)>300 ) $ret=utf8_substr( $ret,0,300 )."...";
		return $ret;		
	}
	
	function extractOnlyValue( &$row )
	{
		$ret.=parent::extractBriefValue( $row );

		if( utf8_strlen($ret)>80 ) $ret=utf8_substr( $ret,0,80 )."...";
		return $ret;		
	}
}

?>
