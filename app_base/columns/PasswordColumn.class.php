<?php
include_once( "TextColumn.class.php" );

class PasswordColumn extends TextColumn 
{
	var $myEqualTo="";
	var $myPrimary=false;
	
	function PasswordColumn( $name,$descr,$required=NULL,$brief=false,$brmsg="",$primary=true,$checkto="" ) 
	{
		if( $checkto!="" ) 
		{
			$this->myAdditional=" tmt:equalto=\"$checkto\" ";
			$this->myEqualTo=$checkto;
		}
		parent::TextColumn( $name,$descr,$required,$brief,$brmsg );
		
		$this->mySQL=$primary;
		$this->myPrimary=$primary;
	}
	
	function checkBeforeSave( &$request )
	{
		global $langdata;
		
		if( !$this->myPrimary ) return true;
		if( $request[$this->myName]!=$request[$this->myEqualTo] )
		{
			$this->myError=$langdata['reg_password_mistmach'];//"Введенные пароли не совпадают<br>";
			return false;
		}
		return true;
	}
	
	function getInsert( &$request )
	{
		if( !$this->myPrimary ) return "";
		return parent::getInsert( $request );	
	}
	
	function getUpdate( &$request )
	{
		if( !$this->myPrimary ) return "";
		return parent::getUpdate( $request );	
	}
	
	function getValue( &$row )
	{
		if( !$this->myPrimary )
		{
			$tmp=$this->myName;
			$this->myName=$this->myEqualTo;
			$ret=parent::getValue( $row );
			$this->myName=$tmp;
			return $ret;
		}
		else
			return parent::getValue( $row );
	}

	function getInput( &$row )
	{
		$ret="<input class=\"addann_input\" type='password' id='$this->myName' name='$this->myName' value='".$this->getValue( $row )."'
			   ".(isset($this->myRequired)?"tmt:required='true' tmt:message='$this->myRequired'":"")." $this->myAdditional  ";
		if( $this->myToolTip!="" ) $ret.=" onmouseover=\"Tip('$this->myToolTip')\" ";
		$ret.="/>";
		return $ret;
	}	

	function extractValue( &$row )
	{
		if( !$this->mySQL ) return "";
		return parent::extractValue( $row );
	}
}

?>
