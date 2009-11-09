<?php

class PhoneCodeColumn extends IntegerColumn 
{
	function extractValue( &$request )
	{
		if( $request[ $this->myName ]=="inter" )
			return "";
		else
			return "8-".$request[ $this->myName ]."-";
	}
	
	function extractBriefValue( &$request ) { return $this->extractValue($request); }
	function extractPreviewValue( &$request ) { return $this->extractValue($request); }
	function extractAdminValue( &$request ) { return $this->extractValue($request); }
}

class PhoneNumColumn extends TextColumn
{
		var $PHONE_FORMATS=array
				(
					array("prefix"=>"8", "search"=>'(8)(\d{3})(\d{3})([\d]{4})', "format"=>'$1 ($2) $3-$4'),
					array("prefix"=>"8", "search"=>'(8)(\d{3})(\d+)', "format"=>'$1 ($2) $3'),
					array("prefix"=>"380", "search"=>'(380)(\d{2})(\d{3})(\d{4})', "format"=>'+$1 ($2) $3-$4'),
					array("prefix"=>"380", "search"=>'(380)(\d{2})(\d+)', "format"=>'+$1 ($2) $3'),
					array("prefix"=>'0', "search"=>'(\d{3})(\d{3})(\d{4})', "format"=>'8 ($1) $2-$3'),
					array("prefix"=>"0", "search"=>'(\d{3})(\d+)', "format"=>'8 ($1) $2'),
					array("prefix"=>"",  "search"=>'(\d{3})(\d{4})', "format"=>'$1-$2'),
				);

	function extractValue( &$request )
	{
			return $this->format_phone( $request[ $this->myName ] );
	}
	
	function extractBriefValue( &$request ) { return $this->extractValue($request); }
	function extractPreviewValue( &$request ) { return $this->extractValue($request); }
	function extractAdminValue( &$request ) { return $this->extractValue($request); }

	function extractXMLValue( &$request ) { return $this->extractValue($request); }
	
	function format_phone( $phone_orig )
	{
			$phone=preg_replace( "/\D/","",$phone_orig );

			foreach( $this->PHONE_FORMATS as $format )
			{
					if( preg_match("/^".$format['prefix'].".*/",$phone) && 
						preg_match("/^".$format['search']."$/", $phone) )
					{
							return preg_replace("/".$format['search']."/", $format['format'], $phone );
					}
			}
			return $phone_orig;
	}
	
//	function getInsert( &$request )
//	{
//		if( isset($request[$this->myName]) )
//		{
//			$request[$this->myName]=preg_replace( "/$(.*)[,;].*^/", '$1', $request[$this->myName] );
//			$request[$this->myName]=preg_replace( "/(\+?)[^\d\+]/", '', $request[$this->myName] );
//		}
//		return parent::getInsert( $request );
//	}
}

class PhoneColumn extends GroupColumn 
{
	var $myAllCodes=false;
	
	function PhoneColumn( $name,$descr,$req,$brief,$allcodes=false,$tooltip_code="",$tooltip_phone="" )
	{
		global $langdata,$DB,$COUNTRY;
		
		if( $this->myAllCodes==false /*&& $this->myCountry==""*/ ) 
		{
			$this->myCountry=$COUNTRY;
		}

		$this->myAllCodes=$allcodes;
		parent::GroupColumn( $name,$descr,
			array(
				// "code" =>new ListDBColumn($table,$name."_code","",$req,"phone_codes","phc_id","phc_name","",false,"","_phone",$allcodes?array(""=>$langdata["all_codes"]):NULL ),
 				"code" =>new PhoneCodeColumn($name."_code","", $this->myCountry=='UA'?$req:"", false,"",NULL, $this->myCountry=='UA'?5:0, "_phonecode" ),
//				"phone"=>new IntegerColumn($name."_num","", $req,false,"",NULL,$this->myCountry=='UA'?7:20,"_phone" ),
				"phone"=>new PhoneNumColumn($name."_num","", $req,false,"","_phone" ),
			),
			true,$req,$brief );
		$this->myColumns["code"]->myToolTip=$tooltip_code;
		$this->myColumns["phone"]->myToolTip=$tooltip_phone;
		$this->myExtractDelimeter="";
	}
	
	function getInsert( &$request )
	{
		if( $this->myCountry!='UA' ) $request[$this->myName."_code"]="inter";
		return parent::getInsert( $request );
	}
		
	function checkBeforeSave( &$request )
	{
		if( $this->myCountry=='UA' )
			$ret=parent::checkBeforeSave( $request );
		else 
			$ret=$this->myColumns['phone']->checkBeforeSave( $request );
		return $ret;
	}
	
	function getInput( &$request )
	{
		if( $this->myAllCodes==true ) return $this->myColumns['phone']->getInput( $request );
		
		if( $this->myCountry=="UA" )
			return "8 ".parent::getInput( $request );
		else
		{
			$ret="<input type='hidden' name='$this->myName"."_code' value='inter' />";
			return "$ret\n".$this->myColumns['phone']->getInput( $request );
		}
	}
	
	function extractValue( &$request )
	{
		if( $request[ $this->myColumns["phone"]->myName ]=="" ) return "";
		return parent::extractValue( $request );
	}
	
	function extractAdminValue( &$request )
	{
		if( $request[ $this->myColumns["phone"]->myName ]=="" ) return "";
		return parent::extractAdminValue( $request );
	}

	function getXML( $request )
	{
		$ret="<!-- $this->myDescription -->\n";
		return $ret."<$this->myName"."_num>".$this->myColumns['phone']->extractXMLValue($request)."</$this->myName"."_num>";
	}
}

?>
