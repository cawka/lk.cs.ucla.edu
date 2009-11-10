<?php

class BibwikiModel extends TableModel 
{
	public function __construct( $php )
	{
		global $DB;

		$this->myIsAutoId=true;
		
		if( preg_match('|.*'.$url.'/(Section:[a-zA-Z_]+/)?([a-z]+)/?(.*)|', $_SERVER['REQUEST_URI'], $matches) )
		{
			switch( $matches[2] )
			{
			case "key":
				$_REQUEST['key']=$matches[3];
				unset( $_REQUEST['section'] );
				break;
			case "keywords":
			case "authors":
			case "import":
				$_REQUEST['action']=$matches[2];					
				break;
			}
		}
		
		parent::__construct( $DB,$php,"bibwiki",array(
				"entry"=>new TextAreaColumn("entry","BibTeX Entry"),
			) );
		
		$this->myOrder="date DESC";
/*		$this->myIsOffset=true;
		$this->myElementsPerPage=30;*/
	}
	
	private function qstr( $str )
	{
		return $this->myDB->qstr( str_replace(array("{","}"),array("",""),$str) );
	}
	
	public function processEntries( )
	{
		$res=$this->myDB->Execute( "SELECT * FROM $this->myTableName" );
		while( $data=$res->FetchRow() )
		{
			foreach( $data as $key => &$value )
			{
				$value=addslashes( $value );
			}
			
			$this->save_edit( $data );
		}
	}
	
	private function denormalizeData( $bibentry, &$request ) //only one entry is allowed here
	{
		require_once( BASEDIR . "/class/OSBiB/format/bibtexParse/PARSEENTRIES.php" );

		$parse = NEW PARSEENTRIES();
		$parse->loadBibtexString( $bibentry );
		$parse->extractEntries( );
		$this->myEntry=$parse->entries[0];
		
		$this->updateDenormalizedColumns( );
	}
	
	private function updateDenormalizedColumns( )
	{
		if( !isset($this->myEntry['pdf']) && isset($this->myEntry['local-url']) )
		{
			$this->myEntry['pdf']=str_replace( '/Users/cawka/Documents/Papers/',"",$this->myEntry['local-url'] );
		}
		
		foreach( $this->myEntry as $key=>&$value ) $value=trim( $value,"{}" );

		$authors=$this->myHelper->parseAuthors( $this->myEntry["author"] );

		$this->myDB->debug=true;
		$this->myColumns=array(
			"entry"=>$this->myColumns["entry"],
			new HiddenExactValueColumn("timestamp","NOW()"),
			new HiddenExactValueColumn("keywords",$this->qstr($this->myEntry["keywords"]) ),
			new HiddenExactValueColumn("title",   $this->qstr($this->myEntry["title"]) ),
			new HiddenExactValueColumn( "first_author", $this->qstr($authors[0]["n"]) ),
			new HiddenExactValueColumn( "authors", $this->qstr($this->myEntry["author"]) ),
			new HiddenExactValueColumn( "date",    $this->qstr($this->myEntry["year"]."-".
												   $this->extractMonth( $this->myEntry["month"] )."-01") ),
			
			new HiddenExactValueColumn("journal", $this->qstr(isset($this->myEntry["journal"])?$this->myEntry["journal"]:$this->myEntry["booktitle"]) ),
			new HiddenExactValueColumn("file",    $this->qstr($this->myEntry["pdf"]) ),
		);
	}

	public function save_add( &$request )
	{
		$this->denormalizeData( $request[$this->myColumns["entry"]->myName], $request );
		
		return parent::save_add( $request );
	}
	
	public function save_edit( &$request )
	{
		$this->denormalizeData( $request[$this->myColumns["entry"]->myName], $request );
//		$this->myDB->debug=true;
		return parent::save_edit( $request );
//		die;
	}
	
	
/*	public function prepareKeywords( &$request )
	{
		
		$sql="SELECT keywords FROM $this->myTableName";
		if( isset($request['section']) ) $sql.=" WHERE section=".$this->myDB->qstr( $request['section'] );
		$res=$this->myDB->Execute( $sql );

		$this->myKeywords=array( );
		$this->myKeywords2=array( );
		$max=0;
		while( $data=$res->FetchRow() )
		{
			$list=explode(",",$data["keywords"] );
			foreach( $list as $key )
			{
				$key=trim( $key );
				if( $key=="" ) continue;
				
				if( !isset($this->myKeywords[$key]) ) 
				{
					$this->myKeywords[$key]=1;
					array_push( $this->myKeywords2, $key );
				}
				else
					$this->myKeywords[$key]++;
					
				if( $this->myKeywords[$key]>$max ) $max=$this->myKeywords[$key];
//				$sum++;
			}
		}
//		$avg=$sum/(double)count($this->myKeywords);
		sort( $this->myKeywords2 );

		foreach( $this->myKeywords as &$size )
		{
//			$size=2+(int) $size/$avg * 10.0;
			$size=round( ($size/(double)$max)*20+5 );

		}
	}
	
	public function prepareAuthors( &$request )
	{
		$sql="SELECT authors FROM $this->myTableName";
		if( isset($request['section']) ) $sql.=" WHERE section=".$this->myDB->qstr( $request['section'] );
		$res=$this->myDB->Execute( $sql );
		$this->mySizes=array( );
		$this->myAuthors=array( );
		$max=0;
		while( $data=$res->FetchRow() )
		{
			$list=$this->myHelper->parseAuthors( $data["authors"] );
			foreach( $list as &$key_full )
			{
				$key=trim( $key_full["n"] );
				if( $key=="" ) continue;
				
				if( !isset($this->mySizes[$key]) ) 
				{
					$this->mySizes[$key]=1;
					$this->myAuthorDescr[$key]=$key_full["f"];
					array_push( $this->myAuthors, $key );
				}
				else
					$this->mySizes[$key]++;
				if( $this->mySizes[$key]>$max ) $max=$this->mySizes[$key];
			}
 		}
//		$avg=$sum/(double)count($this->mySizes);
		sort( $this->myAuthors );
		
		foreach( $this->mySizes as &$size )
		{
//			$size=2+(int) $size/$avg * 10.0;
			$size=round( ($size/(double)$max)*20+5 );
		}
	}
 */
	public function prepareImport( &$request )
	{
		$this->myImplicitAction="import_save";
	}
	
	public function import( &$request )
	{
		$parse = NEW PARSEENTRIES();
		$parse->loadBibtexString( $request[$this->myColumns["entry"]->myName] );
		$parse->extractEntries( );
//		$this->myDB->debug=true;
		$this->myImportStatus=array();
		
		foreach( $parse->entries as &$this->myEntry )
		{
			$id=$this->myDB->GetOne( "SELECT id FROM $this->myTableName WHERE key=".$this->myDB->qstr($this->myEntry['bibtexCitation']) );
			if( isset($id) )
			{
				array_push( $this->myImportStatus, array("id"=>$id,"key"=>$this->myEntry['bibtexCitation'],"status"=>"Failed","reason"=>"Duplicate key") );
				continue;
			}
			
//			print( $this->myHelper->formatBibTexEntry($this->myEntry) );
			$this->updateDenormalizedColumns( );

			$id=parent::save_add( $request );
			
			array_push( $this->myImportStatus, array("id"=>$id,"key"=>$this->myEntry['bibtexCitation'],"status"=>"OK") );
		}
	}


	private function extractMonth( $item )
	{
		if( !isset($item) ) return "01";
		$space=strpos( $item,' ' );
		if( $space>=0 ) $item=substr( $item,0,$space );
		return isset($this->Months[$item])?$this->Months[$item]:"01";
	}

	private $Months=array(
		"January"=>"01",
		"February"=>"02",
		"March"=>"03",
		"April"=>"04",
		"May"=>"05",
		"June"=>"06",
		"July"=>"07",
		"August"=>"08",
		"September"=>"09",
		"October"=>"10",
		"November"=>"11",
		"December"=>"12",
	);	
}

?>
