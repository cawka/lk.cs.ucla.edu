<?php
include_once( "ListColumn.class.php" );

class ListDBColumn extends ListColumn 
{
	var $myTblName;
	var $myKey;
	var $myVal;
	var $myWhere="";
	var $myFirstEl=NULL;
	
	function ListDBColumn( $name,$descr,$required,$db_name,$db_key,$db_val,$where="",$brief=false,$brmsg="",$class="",$firtOpt=NULL )
	{
		$this->myTblName=$db_name;
		$this->myKey=$db_key;
		$this->myVal=$db_val;
		$this->myWhere=$where;
		$this->myFirstEl=$firtOpt;
		$this->myOrder="$this->myVal";
		
		parent::ListColumn( $name,$descr,$required,NULL,$brief,$brmsg,$class );
	}
	
	function getOptions( )
	{
		global $DB,$theAPC;
		
		$tmp=$theAPC->fetch( "($this->myTblName-assoc)($this->myWhere)($this->myFirstEl)" );
		if( !$tmp )
		{
			$this->myOptions=$DB->GetAssoc( "SELECT $this->myKey,$this->myVal FROM $this->myTblName $this->myWhere ORDER BY $this->myOrder" );
			if( $this->myFirstEl!==null )
			{
				$this->myOptions=array_merge( $this->myFirstEl, $this->myOptions );
			}
			$theAPC->cache( "($this->myTblName-assoc)($this->myWhere)($this->myFirstEl)",
							$this->myOptions, 0 );
		}
		else 
			$this->myOptions=$tmp;
	}
	
	function getInput( &$row )
	{
		if( !isset($this->myOptions) ) $this->getOptions( );
		return parent::getInput( $row );
	}
	
	function extractValue( &$row )
	{
		if( !isset($this->myOptions) ) $this->getOptions( );
		return parent::extractValue( $row );
	}
	
	function checkBeforeSave( &$row )
	{
		if( !isset($this->myOptions) ) $this->getOptions( );
		return parent::checkBeforeSave( $row );
	}

	function getXML( $row )
	{
		return BaseColumn::getXML( $row );
	}
}

?>
