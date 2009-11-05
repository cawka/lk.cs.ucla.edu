<?php
require_once( "BaseColumn.class.php" );

class GroupColumn extends BaseColumn 
{
	/**
	 * Array of columns
	 *
	 * @var BaseColumn[]
	 */
	var $myColumns;
	var $myExtractDelimeter=", ";
	
	function GroupColumn( $name,$descr,$columns,$visible,$req,$brief )
	{
		parent::BaseColumn( $name,$descr,$visible,$req,false,$brief );
		$this->myColumns=$columns;
		$this->myGenType="";
	}
	
	function checkBeforeSave( &$request )
	{
		$ret=true;
		foreach( $this->myColumns as $val )
		{
			$ret=$ret && $val->checkBeforeSave( $request );
		}
		return $ret;
	}
	
	function getInsert( &$request )
	{
		$ret="";
		foreach( $this->myColumns as $col )
		{
			if( $ret!="" ) $ret.=",";
			$ret.=$col->getInsert( $request );
		}
		return $ret;
	}
	
	function getUpdate( &$request )
	{
		$ret="";
		foreach( $this->myColumns as $col )
		{
			if( $ret!="" ) $ret.=",";
//			$ret.=$col->myName."=".$col->getInsert( $request );
			$ret.=$col->getUpdate( $request );
		}
		return $ret;
	}
	
	function getUpdateName( )
	{
		$ret="";
		foreach( $this->myColumns as $col )
		{
			if( $ret!="" ) $ret.=",";
			$ret.=$col->getUpdateName( );
		}
		return $ret;
	}
		
	function getInput( &$row )
	{
		$ret="";
		foreach( $this->myColumns as $col )
		{
			//if( $ret!="" ) $ret.=",";
			$ret.=$col->myDescription."&nbsp;".$col->getInput( $row )." &nbsp; ";
		}
		return $ret;
	}
	
	function extractValue( &$row )
	{
		$ret="";
		foreach( $this->myColumns as $col ) 
		{
			$data=$col->extractValue( $row );
			if( $data=="" ) continue;
			if( $ret!="" ) $ret.=$this->myExtractDelimeter;
			$ret.=$data;
		}
		return $ret;
	}	

	function extractBriefValue( &$row )
	{
		$ret="";
		foreach( $this->myColumns as $col ) 
		{
			$data=$col->extractBriefValue( $row );
			if( $data=="" ) continue;
			if( $ret!="" ) $ret.=$this->myExtractDelimeter;
			$ret.=$data;
		}
		return $ret;
	}	

	function extractPreviewValue( &$row )
	{
		$ret="";
		foreach( $this->myColumns as $col ) 
		{
			$data=$col->extractPreviewValue( $row );
			if( $data=="" ) continue;
			if( $ret!="" ) $ret.=$this->myExtractDelimeter;
			$ret.=$data;
		}
		return $ret;
	}	
	
	function extractAdminValue( &$row )
	{
		$ret="";
		foreach( $this->myColumns as $col ) 
		{
			$data=$col->extractAdminValue( $row );
			if( $data=="" ) continue;
			if( $ret!="" ) $ret.=$this->myExtractDelimeter;
			$ret.=$data;
		}
		return $ret;
	}

	function getXML( &$row )
	{
		$ret.="<!-- $this->myDescription -->\n";
		$ret.="<$this->myName>\n";
		foreach( $this->myColumns as $col )
		{
			$ret.="\t".$col->getXML( $row );
		}
		$ret.="</$this->myName>\n";
		return $ret;
	}
}

class GroupColumnTableOutput extends GroupColumn 
{
	var $myColCount;
	var $myMakeHidden=false;
	
 	function GroupColumnTableOutput( $name,$descr,$columns,$visible,$req,$brief,$outpcolcount=4,$hidden=false )
 	{
 		$this->myColCount=$outpcolcount;
 		$this->myMakeHidden=($hidden=="hidden");
 		parent::GroupColumn( $name,$descr,$columns,$visible,$req,$brief );
 	}

	function getInput( &$row )
	{
		$ret="";
		if( $this->myMakeHidden )
		{
			$ret.="<a href='javascript:;' onclick='trigger(\"$this->myName\")'><img id='button_$this->myName' src='/images/plus_9_px.gif' class='collapsed'/></a>";
			$ret.="<div id='group_$this->myName' class='collapsed'>";
		}
		$ret.="<table class='boolgroup'><tr>";
		$slice_count=floor(sizeof( $this->myColumns )/$this->myColCount+$this->myColCount-1);
		$width=round(100/$this->myColCount);

		$i=0;
		foreach( $this->myColumns as $col )
		{
			if( $i%$this->myColCount==0 ) 
			{
				if( $ret!="" ) $ret.="</tr>";
				$ret.="<tr>";
			}
			$ret.="<td width='$width%'>".$col->myDescription."&nbsp;".$col->getInput( $row )."</td>";
			$i++;
		}
		$ret.="</tr></table>";
		if( $this->myMakeHidden )
		{
			$ret.="</div>";
		}
		return $ret;
	}
}

?>
