<?php

class TextAreaColumn extends TextColumn 
{
	function getInput( $row )
	{
		$ret="";
		$ret.= "<textarea id='$this->myName' class=\"addann_textarea$this->myClass".
				((isset($this->myRequired) && $this->myRequired)?" validate['required']":"").
				"\"  name='$this->myName' ";
		if( $this->myToolTip!="" ) $ret.=" onmouseover=\"Tip('$this->myToolTip')\" ";
		$ret.=" $this->myAdditional >".
		
		$this->getValue( $row )."</textarea><br/>\n".
		$this->getInputPostfix( );
		
		return $ret;
	}
	
	function getInputPostfix( )
	{
		global $langdata;
		return "";
		
//		$limit="";
//		if( $this->myLimit>0 ) $limit="maxChar: $this->myLimit,";
//
//		return "<script>new UvumiTextarea({ selector: 'textarea#$this->myName', minSize: 100, $limit
//				txtLimit:'$langdata[textareaLimit]',txtRemainsPrefix:'$langdata[textareaPrefix] ',txtRemainsPostfix:' $langdata[textareaPostfix]'});</script>
//				";
	}

}

?>
