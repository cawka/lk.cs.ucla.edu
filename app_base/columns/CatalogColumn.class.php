<?php

include_once( BASEDIR . "/class/reklama_ua/RecursiveCatalog.class.php" );
include_once( "ListDBColumn.class.php" );

class CatalogColumn extends ListDBColumn 
{
	var $myLevels;
	
	function CatalogColumn( $name,$descr,$required,$brief=false,$brmsg="",$levels=3 )
	{
		global $LANG;
		$this->myLevels=$levels;
		
		parent::ListDBColumn( $name,$descr,$required, "v_catalog","cat_id","cat_name","WHERE lang='$LANG'",$brief,$brmsg );
		$this->myOrder="cat_order,cat_name";
	}

	function getInput( &$row )
	{	
		global $langdata,$DB;
		
		$ret=""; $divcount=0;
		
		////////
		// create all controls for parent path
		$tmp=new RecursiveCatalog( $DB,$row[$this->myName] );
		$tmp->buildParentPath( );

		////////
		// create possible future path with default selection
//		$cat_cat_id=$tmp->myParentPathRev[0]['cat_id'];
		if( sizeof($tmp->myParentPath)==0 )
		{
			array_push( $tmp->myParentPath, array() );
		}
		else if( $this->myLevels>sizeof($tmp->myParentPath) )
		{
			array_push( $tmp->myParentPath, array("cat_cat_id"=>$tmp->myCatCatId) );
		}

//		print_r( $tmp->myParentPath );
		$i=0;
		$level=$this->myLevels;
		foreach( $tmp->myParentPath as $val )
		{
			$dop=isset($val['cat_cat_id'])?"='".$val['cat_cat_id']."' ":" IS NULL ";
			$this->myOptions=$DB->GetAssoc( "SELECT $this->myKey,$this->myVal FROM $this->myTblName $this->myWhere AND cat_id IS NOT NULL AND cat_cat_id$dop ORDER BY $this->myOrder" );
			if( sizeof($this->myOptions)==0 ) break;

			$ret.="<select class='addann_select' name='$this->myName' ";
			if( $level>=2 ) $ret.="onchange=\"getCatalog(this,'".$val['cat_cat_id']."',$level)\"";
			$ret.=">\n";
			$ret.="<option value='".$val['cat_cat_id']."'>";
			$ret.=(( $dop!=" IS NULL " )?$langdata['post_cat_select']:"");//$langdata['cat_all_ukraine']);
			//$ret.=$langdata["cat_all_$i"];
			$ret.="</option>\n";
			foreach( $this->myOptions AS $key=>$value )
			{
				$ret.="<option value='$key'".(($key==$val['cat_id'])?" selected='selected'":"").">$value</option>\n";
			}
			$ret.="</select>\n";
			$ret.="<div id='rcatalog".$val['cat_cat_id']."'>";
			$divcount++;
			$i++;
			$level--;
		}
		
		for( $i=0; $i<$divcount; $i++ ) $ret.="</div>";
		return $ret;
	}
	
	function extractValue( &$row )
	{
		global $DB;
		
		$ret="";
		$tmp=new RecursiveCatalog( $DB,$row[$this->myKey] );
		$i=0;
		foreach( $tmp->myParentPath as $val )
		{
			if( $i>0 ) $ret.=", ";
			$ret.=$val['cat_name'];
			$i++;
		}
		return $ret;
	}
	
	function extractBriefValue( &$row )
	{
		global $DB;
		
		$ret="";
		$tmp=new RecursiveCatalog( $DB,$row[$this->myKey] );
		$i=0;
		foreach( $tmp->myParentPath as $val )
		{
			if( $i>0 ) $ret.="<br/> ";
			$ret.=$val['cat_name'];
			$i++;
		}
		return $ret;
	}
}

?>
