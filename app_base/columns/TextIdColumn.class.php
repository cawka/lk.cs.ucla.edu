<?php

class TextIdColumn extends TextColumn 
{
	var $ALPH="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_/.";
	var $ALPH_SIZE=64;
	
	function prepareIndex( $src )
	{
		$ret="";
		for( $i=0; $i<strlen($src) && $i<30; $i++ )
		{
			if( ('a'<=$src[$i] && $src[$i]<='z') ||
				('A'<=$src[$i] && $src[$i]<='Z') ||
				('0'<=$src[$i] && $src[$i]<='9') ||
				$src[$i]=='-' || $src[$i]=='_'  || $src[$i]=='.' || $src[$i]=='/' )
				$ret.=$src[$i];
		}
		if( strlen($ret)<4 )
		{
			for( $i=0; $i<4; $i++ ) 
			{
				$ret.=substr( $this->ALPH,rand()%$this->ALPH_SIZE,1 );
			}
		}
		return $ret;
	}
	
	function getInput( &$row )
	{
		return "<input class=\"addann_input$this->myClass\" type='text' name='new_$this->myName' value='".$this->getValue( $row )."'
			   ".(isset($this->myRequired)?"tmt:required='true' tmt:message='$this->myRequired'":"")." $this->myAdditional />".
				" $this->myOptionMsg";
	}
	
	function getInsert( &$request )
	{
		if( !isset($request["new_".$this->myName]) || $request["new_".$this->myName]=="" )
			return "NULL";
		else
			return "'".$this->prepareIndex($request["new_".$this->myName])."'";
	}
}

?>
