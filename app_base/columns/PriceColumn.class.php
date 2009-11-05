<?php
include_once( "BaseColumn.class.php" );
include_once( "ListColumn.class.php" );
include_once( "GroupColumn.class.php" );

class PriceColumn extends BaseColumn 
{
	var $CURRENCY=array( "$","€"," грн." );
	var $myOptionMsg;
	var $myAutoCalc=true; // use javascript to forward price to calculator

	function PriceColumn( $name,$descr,$required=NULL,$brief=false,$brmsg="",$opt_msg="",$calc=1 )
	{
		parent::BaseColumn( $name,$descr,true,$required,$brief,$brmsg );
		$this->myOptionMsg=$opt_msg;
		$this->myGenType="price";
		$this->myAutoCalc=(isset($calc) && $calc!="")?$calc:1;
	}
	
	function getValue( &$row,$value=true ) //if false - currency
	{
		if( $value )
			return $row[$this->myName];
		else 
			return $row[$this->myName."_cur"];
	}

	function getXML( $row )
	{
		$ret="<!-- $this->myDescription -->";
	}
	
	function getInput( &$row )
	{
		$ret="<input class=\"addann_price\" type='text' name='$this->myName' value='".$this->getValue($row,true)."' ".
			   (isset($this->myRequired)?"tmt:required='true' tmt:message='$this->myRequired'":"")." tmt:pattern=\"integer\" tmt:filters=\"numbersonly\" />";
		$ret.="&nbsp;<select name='$this->myName"."_cur' class=\"addann_currency\">";
		for( $i=0; $i<sizeof($this->CURRENCY); $i++ )
		{
			$ret.="<option value='$i' ".($this->getValue($row,false)==$i?"selected='selected'":"").">".$this->CURRENCY[$i]."</option>\n";
		}
		$ret.="</select>"." ".$this->myOptionMsg;
		return $ret;
	}
	
	function getUpdate( &$request )
	{
		$ret="$this->myName=".$this->getInsertSpec($request,0).",".
			 "$this->myName"."_cur=".$this->getInsertSpec($request,1);
		return $ret;
	}
	
//	function getUpdate( &$request )
//	{
//		return $this->myName."=".$this->getInsert( $request,0 ).",".$this->myName."_cur=".$this->getInsert( $request,1 );
//	}

	function getUpdateName( )
	{
		$ret=$this->myName;
		$ret.=",".$this->myName."_cur";
		return $ret;
	}
	
	function getInsertSpec( &$request,$val )
	{
		$ret="";
		if( !isset($request[$this->myName]) || $request[$this->myName]=="" )
			$ret.="NULL";
		else
			$ret.="'".$request[$this->myName]."'";
		if( $val==0 ) return $ret;
			
		$ret2="'".$request[$this->myName."_cur"]."'";
		if( $val==1 ) return $ret2;
	}
	
	function getInsert( &$request )
	{
		return $this->getInsertSpec($request,0).",".$this->getInsertSpec($request,1);
	}
	
	function extractValue( &$row )
	{
//		print  "Calc: ". $this->myAutoCalc;
//		die;
		if( $row[$this->myName]!="" )
		{
			$ret.=str_replace( " ", "&nbsp;", number_format($row[$this->myName],0,"."," "))."".$this->CURRENCY[$row[$this->myName."_cur"]]." ".$this->myOptionMsg;
			switch( $this->myAutoCalc )
			{
			case 1:
				$ret.="<script>setPrice('".$row[$this->myName]."',".$row[$this->myName."_cur"].",'".$this->CURRENCY[$row[$this->myName."_cur"]]."','20')</script>";
				break;
			case 2:
				$ret.="<script>setPrice('".$row[$this->myName]."',".$row[$this->myName."_cur"].",'".$this->CURRENCY[$row[$this->myName."_cur"]]."','5')</script>";
				break;
			case 3:
				$ret.="<script>setPrice('".$row[$this->myName]."',".$row[$this->myName."_cur"].",'".$this->CURRENCY[$row[$this->myName."_cur"]]."','1')</script>";
				break;
			default:
				break;
			}
//			if( $this->myAutoCalc )
//			{
//	/*			$ret.="<script>$('hb1value').value='".$row[$this->myName]."';
//				$('curr_base').options[".$row[$this->myName."_cur"]."].selected=true;
//				do_calculation1('hb1value');
//				Element.update( $('currency'),'".$this->CURRENCY[$row[$this->myName."_cur"]]."' );
//				Element.update( $('currency1'),'".$this->CURRENCY[$row[$this->myName."_cur"]]."' );
//				</script>";
//	*/
//				
//			}
			return $ret;
		}
		else
			return "";
	}

	function extractBriefValue( &$row )
	{
		if( $row[$this->myName]!="" )
			return str_replace( " ", "&nbsp;", number_format($row[$this->myName],0,"."," "))."".$this->CURRENCY[$row[$this->myName."_cur"]]." ".$this->myOptionMsg;
		else 
			return "";
	}
	
	function extractPreviewValue( &$row )
	{
		return $this->extractBriefValue( $row );
	}	

	function extractAdminValue( &$row )
	{
		return $this->extractPreviewValue( $row );
	}
}

class PriceColumnExtra extends GroupColumn  
{
	function PriceColumnExtra( $name,$descr,$extra=array(),$required=NULL,$brief=false,$brmsg="",$calc=true,$tooltip="",$tooltip_extra="" )
	{
		parent::GroupColumn($name,$descr,array(
			"price"=>new PriceColumn($name,"",$required,$brief,$brmsg,"",$calc ),
			"extra"=>new ListColumn( $name."_extra","","",$extra,false,"","_other" ),
		),true,$required,$brief);
		$this->myColumns["price"]->myToolTip=$tooltip;
		$this->myColumns["extra"]->myToolTip=$tooltip_extra;

		$this->myExtractDelimeter=" ";
		$this->myBriefMsg=$brmsg;
	}

	function extractValue( &$row )
	{
		if( $this->myColumns["price"]->extractValue($row)!="" )
			return parent::extractValue( $row );
		else
			return "";
	}

	function extractBriefValue( &$row )
	{
		if( $this->myColumns["price"]->extractBriefValue($row)!="" )
			return parent::extractBriefValue( $row );
		else
			return "";
	}

	function extractPreviewValue( &$row )
	{
		if( $this->myColumns["price"]->extractPreviewValue($row)!="" )
			return parent::extractPreviewValue( $row );
		else
			return "";
	}
	
	function extractAdminValue( &$row )
	{
		if( $this->myColumns["price"]->extractAdminValue($row)!="" )
			return parent::extractAdminValue( $row );
		else
			return "";
	}
}

class PriceColumnTorg extends GroupColumn  
{
	function PriceColumnTorg( $name,$descr, $required=NULL,$brief=false,$brmsg="",$calc=true,$tooltip="",$tooltip_extra="" )
	{
		global $langdata;
		
		parent::GroupColumn($name,$descr,array(
			"price"=>new PriceColumn($name,"",$required,$brief,$brmsg,"",$calc ),
			"torg"=>new BooleanColumn($name."_torg",$langdata['torg'],"",false,$langdata['torg_brief'] ),
		),true,$required,$brief);
		$this->myColumns["price"]->myToolTip=$tooltip;
		$this->myColumns["torg"]->myToolTip=$tooltip_extra;

		$this->myExtractDelimeter=" ";
		$this->myBriefMsg=$brmsg;
	}

	function extractValue( &$row )
	{
		if( $this->myColumns["price"]->extractValue($row)!="" )
			return parent::extractValue( $row );
		else
			return "";
	}

	function extractBriefValue( &$row )
	{
		if( $this->myColumns["price"]->extractBriefValue($row)!="" )
			return parent::extractBriefValue( $row );
		else
			return "";
	}

	function extractPreviewValue( &$row )
	{
		if( $this->myColumns["price"]->extractPreviewValue($row)!="" )
			return parent::extractPreviewValue( $row );
		else
			return "";
	}
	
	function extractAdminValue( &$row )
	{
		if( $this->myColumns["price"]->extractAdminValue($row)!="" )
			return parent::extractAdminValue( $row );
		else
			return "";
	}
	
}


?>
