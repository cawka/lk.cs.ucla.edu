<?php
include_once( "TextColumn.class.php" );

class TextAreaColumn extends TextColumn 
{
	function getInput( $row )
	{
		$ret="";
		$ret.= "<textarea id='$this->myName' class=\"addann_textarea\"  name='$this->myName' ";
		if( $this->myToolTip!="" ) $ret.=" onmouseover=\"Tip('$this->myToolTip')\" ";
		$ret.=((isset($this->myRequired) && $this->myRequired)?"tmt:required='true' tmt:message='$this->myRequired'":"")." $this->myAdditional >".
				$this->getValue( $row )."</textarea><br/>\n".
		$this->getInputPostfix( );
		
		return $ret;
	}
	
	function getInputPostfix( )
	{
		global $langdata;
		
		$limit="";
		if( $this->myLimit>0 ) $limit="maxChar: $this->myLimit,";

		return "{literal}<script>new UvumiTextarea({ selector: 'textarea#$this->myName', minSize: 100, $limit
				txtLimit:'$langdata[textareaLimit]',txtRemainsPrefix:'$langdata[textareaPrefix] ',txtRemainsPostfix:' $langdata[textareaPostfix]'});</script>
				{/literal}";
	}

}

?>
