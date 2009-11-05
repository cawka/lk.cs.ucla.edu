<?php

include_once( "ListDBColumn.class.php" );

class RegionsColumn extends ListDBColumn 
{
	var $myLevels;
	
	function RegionsColumn( $name,$descr,$required,$brief=false,$brmsg="",$reg=NULL,$levels=3 )
	{
		global $LANG;
		$this->myLevels=$levels;
		
		parent::ListDBColumn( $name,$descr,$required, "v_regions","reg_id","reg_name","WHERE lang='$LANG'",$brief,$brmsg );
		$this->myOrder="reg_order,reg_name";
	}

	function getInput( &$row )
	{	
		global $langdata,$DB;
		$ret=""; $divcount=0;
		
		////////
		// create all controls for parent path
		$tmp=new RegionsClass( $DB,$row[$this->myKey],"" );

		////////
		// create possible future path with default selection
//		$reg_reg_id=$tmp->myParentDataRev[0]['reg_id'];
		if( sizeof($tmp->myParentData)==0 )
		{
//			array_push( $tmp->myParentData, array() );
		}
		else if( $this->myLevels>sizeof($tmp->myParentData) )
		{
//			array_push( $tmp->myParentData, array('reg_reg_id'=>$row[$this->myKey]) );
		}

		$i=0;
		$level=$this->myLevels;
//		print_r( $tmp->myParentData );
		foreach( $tmp->myParentData as &$val )
		{
//			if( $val['reg_id']=="" ) continue;
			
//			$dop=isset($val['reg_reg_id'])?"='".$val['reg_reg_id']."' ":" IS NULL ";
//			$this->myOptions=$DB->GetAssoc( "SELECT $this->myKey,$this->myVal FROM $this->myTblName $this->myWhere AND reg_reg_id$dop ORDER BY $this->myOrder" );
			$reg_id=$val['reg_id'];
			$val['reg_id']=$val['reg_reg_id'];
			$this->myOptions=$tmp->getOptions( $val );
			$val['reg_id']=$reg_id;
			
			if( sizeof($this->myOptions)==0 ) break;
//			print 

			$ret.="<select class='addann_select' name='$this->myName' ";
			if( $level>=2 ) $ret.="onchange=\"getRegions(this,'".$val['reg_reg_id']."',$level)\"";
			$ret.=">\n";
			$ret.="<option value='".$val['reg_reg_id']."'>";
//			$ret.=(( $dop!=" IS NULL " )?$langdata['post_cat_select']:$langdata['reg_all_ukraine']);
			//$ret.=$langdata["reg_all_$i"];
			$ret.="</option>\n";
			foreach( $this->myOptions AS $key=>$value )
			{
				$ret.="<option value='$key'".(($key==$val['reg_id'])?" selected='selected'":"").">$value</option>\n";
			}
			$ret.="</select>\n";
			$ret.="<div id='rregion".$val['reg_reg_id']."'>";
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
		$tmp=new RegionsClass( $DB,$row[$this->myKey],"" );
		$i=0;
		foreach( $tmp->myParentData as $val )
		{
			if( $val['reg_name']===null || $val['reg_name']=="" ) continue;
			if( $i>0 ) $ret.=", ";
			$ret.=$val['reg_name'];
			$i++;
		}
		return $ret;
	}
	
	function extractBriefValue( &$row )
	{
		global $DB;
		
		$ret="";
		$tmp=new RegionsClass( $DB,$row[$this->myKey],"" );
		$i=0;
		foreach( $tmp->myParentData as $val )
		{
			if( $val['reg_name']===null || $val['reg_name']=="" ) continue;
			if( $i>0 ) $ret.="<br/> ";
			$ret.=$val['reg_name'];
			$i++;
		}
		return $ret;
	}
	
	function extractOnlyValue( &$row, $levels=4 )
	{
		global $DB;
		
		$ret="";
		$tmp=new RegionsClass( $DB,$row[$this->myKey],"" );
		$i=0;
		foreach( $tmp->myParentData as $val )
		{
			if( $val['reg_name']===null || $val['reg_name']=="" ) continue;
			if( $i>0 ) $ret.="<br/> ";
			$ret.=$val['reg_name'];
			$i++;
			if( $i>=$levels ) break;
		}
		return $ret;
	}
}

?>
