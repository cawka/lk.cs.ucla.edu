<?php

class PhotoColumn extends BaseColumn 
{
	var $myWidth;
	var $myHeight;
	
	function PhotoColumn( $name,$descr,$required=NULL,$width,$height,$brief=false,$brmsg="" )
	{
		$this->myWidth=$width;
		$this->myHeight=$height;
		$descr.="<br/><small>Figure in JPG, GIF, or PNG format ".$this->myWidth."x".$this->myHeight." size</small>";
		parent::BaseColumn( $name,$descr,true,$required,$brief,$brmsg );
	}
	
	function getValue( &$row )
	{
		return $row[$this->myName];
	}
	
	function getInput( &$row )
	{
		$ret="<img src=\"".$this->getValue($row)."\" border=\"0\" id=\"$this->myName"."_pic\" style='height:100px; border:0' /><br />
        <input class='addann_photo' name=\"$this->myName\" type=\"text\" id=\"$this->myName\" size=\"40\" value=\"".$this->getValue($row)."\" />
		<script type='text/javascript'>
			function set_$this->myName(val){ updateImage('$this->myName',val); };
		</script>
        <input type=\"button\" class=\"button\" onClick=\"BrowserPopup('$this->myName');\" value=\"Browse\">\n";
		return $ret;

	}
}



?>
