<?php

class DateColumn extends BaseColumn 
{
	function DateColumn( $name,$descr,$required=NULL,$brief=false,$brmsg="" )
	{
		parent::BaseColumn( $name,$descr,true,$required,$brief,$brmsg );
	}
	
	function getValue( &$row )
	{
		$ret=$row[$this->myName];
		return $ret;
	}
	
	function getInput( &$row )
	{
//		return "<input class=\"addann_input\" type='text' name='$this->myName' value='".$this->getValue( )."'
//			   ".(isset($this->myRequired)?"tmt:required='true' tmt:message='$this->myRequired'":"")." $this->myAdditional />";
	
		//		$convert=isset($param['convert'])?true:false;
		//	$name=$param['name'];
		//	$form=$param['form'];
		$form="kform";
		//	
		//	if( $convert && isset($param['value']) && $param['value']!="" )
		//	{
		//	$temp=explode( ".", $param['value'] );
		//	$param['value']=$temp[2]."-".$temp[1]."-".$temp[0];
		//	}
			
//		if( isset($this->myRequired) )
//			$value=(isset($this->getValue()) && $this->getValue()!="")?date( "d.m.Y",strtotime($this->getValue()) ):date( "d.m.Y" );
//		else 
//			$value=(isset($this->getValue()) && $this->getValue()!="")?date( "d.m.Y",strtotime($this->getValue()) ):"";
		if( $this->getValue($row)!="" )
		{
			$value=date("Y-m-d",strtotime($this->getValue($row)) );
		}
		else 
		{
			//$value=date("Y-m-d");
		}

		$ret= 
		"<SCRIPT LANGUAGE=\"JavaScript\" ID=\"js_$this->myName\">
		var cal_$this->myName = new CalendarPopup( );
		cal_$this->myName.showYearNavigation( );
		</SCRIPT>
		
		<INPUT TYPE=\"text\" NAME=\"$this->myName\" VALUE=\"$value\" SIZE=25 tmt:datepattern='YYYY-MM-DD' tmt:message=\"Укажите дату в формате ГГГГ-ММ-ДД (например 2007-12-05)\" ";
		if( isset($this->myRequired) )
		{
			$ret.=" tmt:required=\"true\" ";
		}
		$ret.=">
		<A HREF=\"#\" onClick=\"cal_$this->myName.select( document.forms.$form.$this->myName,'anchor_$this->myName','yyyy-MM-dd'); return false;\" TITLE=\"cal_$this->myName.select(document.forms.$form.$this->myName,'anchor_$this->myName','yyyy-MM-dd'); return false;\" NAME=\"anchor_$this->myName\" ID=\"anchor_$this->myName\">Выбрать дату</A>
		";
		return $ret;
	}
}

class DateTimeColumn extends GroupColumn 
{
	function DateTimeColumn( $name,$descr,$required=NULL,$brief=false,$brmsg="" )
	{
		$hours=array(); $minutes=array(); $seconds=array();
		for( $i=0; $i<24; $i++ ) $hours[($i<10?"0":"")."$i"]=($i<10?"0":"")."$i";
		for( $i=0; $i<60; $i++ ) 
		{
			$minutes[($i<10?"0":"")."$i"]=($i<10?"0":"")."$i";
			$seconds[($i<10?"0":"")."$i"]=($i<10?"0":"")."$i";
		}
		
		parent::GroupColumn( $name,$descr,array(
			"date"=>new DateColumn( $name."_date",""),
			"hour"=>new ListColumn( $name."_hour","",NULL,$hours,false,"","_other" ),
			"minute"=>new ListColumn( $name."_minute","",NULL,$minutes,false,"","_other" ),
			"second"=>new ListColumn( $name."_second","",NULL,$seconds,false,"","_other" ),
		),true,$required,$brief);
	}
	
	function getInsert( &$request )
	{
		if( !isset($request[$this->myName."_date"]) || $request[$this->myName."_date"]=="" )
			return "NULL";
		else
			return "'".$request[$this->myName."_date"]." ".$request[$this->myName."_hour"].":".$request[$this->myName."_minute"].":".$request[$this->myName."_second"]."'";

		
		return $this->myColumns['date']->getInsert( $request );
	}
	
	function getUpdate( &$request )
	{
		return $this->getUpdateName()."=".$this->getInsert( $request );
	}
	
	function getUpdateName( )
	{
		return $this->myName;
	}

	function getInput( &$row )
	{
		if( $row[$this->myName]!="" )
		{
			$row[$this->myName."_date"]=date("Y-m-d",strtotime($row[$this->myName]) );

			$row[$this->myName."_hour"]=date("H",strtotime($row[$this->myName]) );
			$row[$this->myName."_minute"]=date("i",strtotime($row[$this->myName]) );
			$row[$this->myName."_second"]=date("s",strtotime($row[$this->myName]) );
		}
		else 
		{
			$row[$this->myName."_date"]=date("Y-m-d");

			$row[$this->myName."_hour"]=date("H");
			$row[$this->myName."_minute"]=date("i");
			$row[$this->myName."_second"]=date("s");
		}
		$this->myData=$row;
//		print_r( $row );
//		die;
		
		return parent::getInput( $row );
	}
}
?>
