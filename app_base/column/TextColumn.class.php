<?php

function utf8_substr($str,$from,$len){
# utf8 substr
# www.yeap.lv
  return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                       '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                       '$1',$str);
}

function utf8_strlen($str) {
  return preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $str, $dummy);
}

class TextColumn extends BaseColumn 
{
	var $myAdditional="";
	var $myLimit=9999999999;//400; //maximum 400 symbols
	var $myClass="";
	var $myOptionMsg="";
	var $myIsOptionBrief=true;
	
	function TextColumn( $name,$descr,$required=NULL,$brief=false,$brmsg="",$class="",$opt_msg="",$readonly=false,$opt="" )
	{
		parent::BaseColumn( $name,$descr,true,$required,$brief,$brmsg,$readonly );
		$this->myClass=$class;
		$this->myOptionMsg=$opt_msg;
		if( $opt!="" ) $this->myIsOptionBrief=false;
	}
	
	function getValue( &$row )
	{
		/// @bug: Add extra 20 symbols as a some kind of solution to the problem of incorre
		$ret=$row[$this->myName];
		if( utf8_strlen($ret)>$this->myLimit+20 ) $ret=utf8_substr( $ret,0,$this->myLimit+20 );
		return $ret;
	}

	function getInsert( &$request )
	{
		global $DB;
		$ret=$request[$this->myName];
		if( isset($ret) && utf8_strlen($ret)>$this->myLimit ) $ret=utf8_substr( $ret,0,$this->myLimit );
		
		if( !isset($ret) || $ret=="" )
			return "NULL";
		else
		{
			return $DB->qstr( stripslashes($ret) );
		}
	}
	
	function getInput( &$row )
	{
			$ret="<input id='$this->myName' class=\"addann_input$this->myClass".
					(isset($this->myRequired)?" validate['required']":"").
					"\" type='text' name='$this->myName' value=\"".htmlentities($this->getValue( $row ))."\" ";
		if( $this->myToolTip!="" ) $ret.=" onmouseover=\"Tip('$this->myToolTip')\" ";
		if( $this->myLimit>0 ) $ret.=" MAXLENGTH='$this->myLimit' ";
		$ret.= " $this->myAdditional />".
		   	   " $this->myOptionMsg";
		   	   
		return $ret;
	}
	
	function extractValue( &$row )
	{
		if( parent::extractValue($row)!="" )
			return htmlentities( parent::extractValue( $row ),ENT_NOQUOTES,"UTF-8" )." ".$this->myOptionMsg;
		else
			return "";
	}
	
	function extractBriefValue( &$row )
	{
		if( parent::extractValue($row)!="" )
		{
			$ret=htmlentities( parent::extractValue( $row ),ENT_NOQUOTES,"UTF-8" );
			if( utf8_strlen($ret)>100 ) $ret=utf8_substr( $ret,0,100 )."...";
			if( $this->myIsOptionBrief ) $ret.=" ".$this->myOptionMsg;
			return $ret;
		}
		else
			return "";
	}
	
	function extractPreviewValue( &$row )
	{
		return $this->extractBriefValue( $row );
	}

        function getXML( $request )
	{
		$ret="<!-- $this->myDescription -->\n";
                return $ret."<$this->myName><![CDATA[".$this->extractXMLValue($request)."]]></$this->myName>\n";
        }	
}

//class TextColumnFckEditor extends TextColumn 
//{
//	var $myWidth;
//	var $myHeight;
//	
//	function TextColumnFckEditor( $name,$descr,$required=NULL,$width,$height,$brief=false,$brmsg="" )
//	{
//		$this->myWidth=$width;
//		$this->myHeight=$height;
//		
//		parent::TextColumn( $name,$descr,$required,true,$brief,$brmsg );
//	}
//	
//	function getInput( &$row )
//	{
//		$oFCKeditor = new FCKeditor( $this->myName ) ;
//		
//        $oFCKeditor->BasePath="/class/fckeditor/" ;
//        $oFCKeditor->Height  =$this->myHeight;
//        $oFCKeditor->Width   =$this->myWidth;
//        $oFCKeditor->Value   =$row[$this->myName]; 
//        
//        $ret=$oFCKeditor->CreateHtml( );
//		
//		return $ret;
//	}	
//	
//	public function getInstances()
//	{
//		return "\"$this->myName\"";
//	}
//}

?>
