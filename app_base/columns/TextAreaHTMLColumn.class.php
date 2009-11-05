<?php
include_once( "TextAreaColumn.class.php" );

class TextAreaHTMLColumn extends TextAreaColumn 
{
	function getInputPostfix( )
	{
		global $langdata;
		
		return "<script>CKEDITOR.replace( '$this->myName' );</script>";
	}
}

?>