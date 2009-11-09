<?php

class TextColumnStaticText extends BaseColumn 
{
	function extractValue( &$row )
	{
		global $langdata;
		
		return $langdata[$row[$this->myName]];
	}
}

?>
