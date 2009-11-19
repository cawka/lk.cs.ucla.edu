<?php

class TableModel extends BaseModel
{
	/**
	 * Переменная для связи с базой данных
	 *
	 * @var ADOConnection
	 */
	public $myDB;
	protected $myLang; ///< if not null, use language feature of the table
	public $myUrlAddon="";
	public $myUrlAddonValue="";
	
	public $myElementsPerPage=30;
	public $myElementOffset=0;
	public $myElementCount=0;
	public $myIsOffset=false;
	
	public $mySortColumns=array();
	
	public $myData;
	public $myId;
	public $myTableName;
	
	public $myOrder;
	public $mySearchColumns;
	public $myParentId="frame_";
	
	protected $myExtraWhere="";

	public function __construct( &$db,$php,
						$tblname,$columns,$id="id",
						$lang=NULL,$urladdon="",$offsets=false )
	{
		parent::__construct( $php );
		
		$this->myDB=&$db;
		$this->myColumns=$columns;
		$this->myTableName=$tblname;
		$this->myId=$id;
		$this->myLang=$lang;
		$this->myUrlAddon=$urladdon;
		$this->myIsOffset=$offsets;
		
//		if( !isset($_REQUEST['_p']) )
//		{
//			$tmp=array_merge( $_GET, $_POST );
/*			$tmp=$_GET;
			unset( $tmp['_m'] );
			unset( $tmp['action'] );
			unset( $tmp['_p'] );
			unset( $tmp['ajax'] ); unset( $tmp['width'] ); unset( $tmp['height'] );
			$query=http_build_query( $tmp );
			if( $query!="" ) 
			{
				$this->myUrlAddon="_p";
				$this->myUrlAddonValue=urlencode($query);
			}
		}*/
		
/*		if( isset($_REQUEST['_p']) )
		{
//			print $_REQUEST['_p'];
//			print urldecode( $_REQUEST['_p'] );
//			$this->myUrlAddon.=$_REQUEST['_p'];
			$params=explode( "&",urldecode( $_REQUEST['_p'] ) );
			foreach( $params as $param )
			{
				$p=explode( "=", $param );
//				print_r( $p );
//				$_REQUEST[$p[0]]=$p[1];
			}
		}
 */
	}
	
	private function addSortColumns( $sort )
	{
		$this->mySortColumns=array_merge( $this->mySortColumns, $sort );
	}

	public function isId( )
	{
		return isset( $this->myData[$this->myId] );
	}
	
	public function getId( )
	{
		return $this->myData[$this->myId];
	}
	
	protected function extraWhere( &$request )
	{
		if( !isset($this->mySearchColumns) ) return $this->myExtraWhere;
		$ret=$this->myExtraWhere;
		foreach( $this->mySearchColumns as &$colname )
		{
			if( isset($colname["name"]) )
				$col=&$this->myColumns[$colname["name"]];
			else
				$col=&$colname["column"];
			if( isset($request[$col->myName]) && $request[$col->myName]!="" )
			{
				if( $ret!="" ) $ret.=" AND ";
				switch( $colname['type'] )
				{
				case "like":
					$ret.="$col->myName like '%".$request[$col->myName]."%'";
					break;
				case "custom":
					$ret.=$colname["where"];
					break;
				default:
					$ret.="$col->myName='".$request[$col->myName]."'";
					break;
				}
			}
		}
		return $ret;
	}
	
	protected function collectDataBase( &$request )
	{
		global $LANG;

		$sort_temp=$request['sort'];
		$sort=NULL;
		foreach( $this->mySortColumns as $key=>&$value ) { if( $key==$sort_temp ) { $sort=$value; break;} }
		if( isset($sort) )
		{
			if( isset($_REQUEST['desc']) )
				$this->myOrder=$sort["desc"];
			else
				$this->myOrder=$sort["asc"];
		}
		
		$sql= " FROM $this->myTableName";
		$where="";
		if( isset($this->myLang) ) $where.=" $this->myLang='$LANG'";
		
		foreach( $this->myColumns as &$col )
		{
			if( !$col->myIsVisible && !isset($col->myIsProtected) ) 
			{ 
				if( $where!="" ) $where.=" AND ";
				$where.=$col->myName;
				if( $col->getInsert( $_REQUEST )=="NULL" )
					$where.=" IS NULL ";
				else 
					$where.="=".$col->getInsert( $_REQUEST );
			}
		}
		$where.=$this->extraWhere( $request );
		
		if( $where!="" ) $sql.=" WHERE $where";
		if( $this->myIsOffset )
		{
			$count=$this->myDB->GetOne( "SELECT count(*) $sql" );
			$offset=$this->getCurPage( $request,$count );
		}
		if( $this->myOrder!="" ) $sql.=" ORDER BY $this->myOrder";
		
		if( $this->myIsOffset )
			$res=$this->myDB->SelectLimit( "SELECT * $sql",$this->myElementsPerPage,$offset*$this->myElementsPerPage );
		else 
			$res=$this->myDB->Execute( "SELECT * $sql" );

		return $res;
	}

	public function collectData( &$request )
	{
		$res= &$this->collectDataBase( $request );
		$this->myData=&$res->GetRows( );
	}
	
	public function collectDataFetch( &$request )
	{
		$this->myData=&$this->collectDataBase( $request );
	}
	
	public function getRowToEdit( &$request )
	{
		global $LANG;
		if( isset($request['error']) )
		{
			$this->myData=&$request;
		}
		else
		{
			$sql="SELECT * FROM $this->myTableName WHERE ".$this->rowId( $request ); 
			if( isset($this->myLang) ) $sql.=" AND $this->myLang='$LANG'";
			$this->myData=$this->myDB->GetRow( $sql );
		}
	}

	protected function rowId( $request )
	{
			$ret=$this->myId;
			if( $request[$this->myId]!="" )
				$ret.="=".$this->myDB->qstr($request[$this->myId]);
			else
				$ret.=" IS NULL ";
			return $ret;
	}
	
	public function getRowToShow( &$request )
	{
		return $this->getRowToEdit( $request ); //by default - same action
	}
	
	public function deleteRow( &$request )
	{
		$id=$request[$this->myId];
		if( isset($id) ) $this->myDB->Execute( "DELETE FROM $this->myTableName WHERE $this->myId='$id'" );
	}
	
	protected function saveRowUpdate( $id, &$request )
	{
		$ret="UPDATE $this->myTableName SET ";
		$i=0;
		foreach( $this->myColumns as $col )
		{
			if( $col->myIsReadonly ) continue;
			if( !$col->mySQL ) 
			{
				$col->getUpdate( $request );
				continue;
			}
			//if( $col->myIsVisible==false ) continue;

			if( $i>0 ) $ret.=",";
			$ret.=$col->getUpdate( $request );
			$i++;			
		}
		$ret.=" WHERE $this->myId";
		if( $id!="" ) $ret.="='$id'"; else $ret.=" IS NULL ";

		$this->myDB->Execute( $ret );
		foreach( $this->myColumns as $col ) $col->postUpdate( $id,$request );
	}
	
	protected function saveRowInsert( &$request )
	{
		if( $this->myIsAutoId )
		{
			$id=$this->myDB->GenID( $this->myTableName."_".$this->myId."_seq" );
		}
		
		$ret="INSERT INTO $this->myTableName (";
		if( isset($id) ) $ret.="$this->myId,";
		$i=0;
		foreach( $this->myColumns as $col )
		{
			if( $col->myIsReadonly ) continue;
			if( !$col->mySQL ) continue;
			if( $i>0 ) $ret.=",";
			$ret.=$col->getUpdateName();
			$i++;				
		}
		$ret.=")";
		
		$ret.=" VALUES(";
		if( isset($id) ) $ret.="'$id',";
		$i=0;
		foreach( $this->myColumns as $col )
		{
			if( $col->myIsReadonly ) continue;
			if( !$col->mySQL ) 
			{
				$col->getInsert( $request );
				continue;
			}
			if( $i>0 ) $ret.=",";
			$ret.=$col->getInsert( $request );
			$i++;				
		}
		$ret.=")";	
		
		$this->myDB->Execute( $ret );
		foreach( $this->myColumns as $col ) $col->postInsert( $id,$request );
		
		return $id;
	}
	
	public function save_add( &$request )
	{
		return $this->saveRowInsert( $request );
	}
	
	public function save_edit( &$request )
	{
		$id=$request[$this->myId];
		return $this->saveRowUpdate( $id,$request );
	}
	
	public function checkUnique( $colnames,&$request )
	{
		$sql="SELECT $this->myId FROM $this->myTableName WHERE ";
		$params=array();
		foreach( $colnames as $colname )
		{
			$col=&$this->myColumns[$colname];
			$val=$col->getInsert( $request );
			if( $val=="NULL" ) 
				array_push( $params, "$colname IS NULL" );
			else
				array_push( $params, "$colname=$val" );
		}
		$sql.=implode( " AND ", $params );
		if( $this->myDB->GetOne($sql) ) 
			return "Non-unique combination";
		else
			return "";
	}

	public function getAddCtrl( )
	{
		global $Auth; if( !$Auth->isAllowed("add") ) return "";

		return $this->myHelper->link_popup( $this,"add",
											$this->myHelper->img_button("new","Add"),
											"Add",
											$this->getColumnParams( ) );
	}

	public function getEditCtrl( &$row )
	{
		global $Auth; if( !$Auth->isAllowed("edit") ) return "";

		return $this->myHelper->link_popup( 
						$this,"edit",
						$this->myHelper->img_button("edit","Edit"),
						"Edit",
						$this->getColumnParams( array($this->myId=>$row[$this->myId]) ) );
	}
	
	public function getDeleteCtrl( &$row )
	{
		global $Auth; if( !$Auth->isAllowed("delete") ) return "";

		return $this->myHelper->link_popup_confirm( 
						$this,"delete",
						$this->myHelper->img_button("delete","Delete"),
						$this->getColumnParams( array($this->myId=>$row[$this->myId]) ),
						"Are you sure?" );
	}
	
//	public function getCtrl( $row, $action, $title, $question )
//	{
//		global $Auth; if( !$Auth->isAllowed($action) ) return "";
//
//		return $this->myHelper->link_popup_confirm( 
//						$this,$action,
//						$title,
//						$this->getColumnParams( array($this->myId=>$row[$this->myId]) ),
//						$question );
//	}

	
//	public function getShowRowHref( &$row )
//	{	
//		$ret="$this->myPhp?action=show&amp;$this->myId=".$row[$this->myId];
//		foreach( $this->myColumns as $col )
//		{
//			if( !$col->myIsVisible && !isset($col->myIsProtected) ) 
//			{ 
//				$ret.="&amp;$col->myName=".$col->getValue($row)."";	
//			}
//		}
//		$ret.="&amp;$this->myUrlAddon";
//		return $ret;
//	}
	
	public function extractId( &$row )
	{
		return $row[$this->myId];
	}
	
	public function getCurPage( &$request,$count )
	{
		$this->myElementCount=$count;
		$page=$request['pp'];
		if( !isset($page) || !is_numeric($page) || $page<0 ) { $this->myElementOffset=0; return 0; }

		if( $page*$this->myElementsPerPage >= $this->myElementCount )
			$this->myElementOffset=floor( ($this->myElementCount+$this->myElementsPerPage-1) / $this->myElementsPerPage )-1;
		else 
			$this->myElementOffset=$page;
		return $this->myElementOffset;
	}
	
	public function getPageOffset( $page,$offset )
	{
		$test=$page+$offset;
		if( $test<0 ) return 0;
		if( $test*$this->myElementsPerPage >= $this->myElementCount )
		{
			$ret=floor( ($this->myElementCount+$this->myElementsPerPage-1) / $this->myElementsPerPage )-1;
			//print "$ret<BR>";
			return $ret;
		}
		else 
			return $test;
	}
	
	public function getPageOffsetCtrl( $suppress=true, $baseurl=NULL )
	{
		global $LANG,$langdata;
		$langdata=array(
			"navi_page"=>"Page",
		);
		
		if( $this->myElementCount<=$this->myElementsPerPage ) return ""; //no need to special navigation control
		$this->myElementOffset=$this->getPageOffset($this->myElementOffset,0); //additional check
		
		$pages=array();
		if( $suppress )
		{
			$pages=array( 
				$this->getPageOffset($this->myElementOffset,-6),
				$this->getPageOffset($this->myElementOffset,-5),
				$this->getPageOffset($this->myElementOffset,-4),
				$this->getPageOffset($this->myElementOffset,-3),
				$this->getPageOffset($this->myElementOffset,-2),
				$this->getPageOffset($this->myElementOffset,-1),
				$this->myElementOffset,
				$this->getPageOffset($this->myElementOffset,+1),
				$this->getPageOffset($this->myElementOffset,+2),
				$this->getPageOffset($this->myElementOffset,+3),
				$this->getPageOffset($this->myElementOffset,+4),
				$this->getPageOffset($this->myElementOffset,+5),
				$this->getPageOffset($this->myElementOffset,+6),
				$this->getPageOffset($this->myElementOffset,+7),
				$this->getPageOffset($this->myElementOffset,+8),
				$this->getPageOffset($this->myElementOffset,+9),
			);
			$pages=array_unique( $pages );
		}
		else
		{
			$pagecount=1+floor($this->myElementCount/$this->myElementsPerPage);
			
			for( $i=0; $i<$pagecount; $i++ ) array_push( $pages, $i );
		}
		//print_r( $pages );

		if( !isset($baseurl) )
		{
			$url=$_SERVER['PHP_SELF']."?".getRequest(array("skip"=>array("pp","favdel","ajax")));
			$ret="<span class=\"pagesblockinside\">".$langdata['navi_page'].":\n";
		}
		else {
			$url=$baseurl;
		}
		if( strstr($url,"?") ) $url.="&amp;pp="; else $url.="?pp=";
		if( $this->myElementOffset>0 )
				$ret.="<a href=\"$url".$this->getPageOffset($this->myElementOffset,-1)."\"><<</a>\n";

		foreach( $pages as $i )
		{
			if( $i==$this->myElementOffset )
				$ret.="<span class=\"selectedpage\">".($i+1)."</span>\n";
			else
				$ret.="<a href=\"$url$i\">".($i+1)."</a>\n";
		}
		if( $this->getPageOffset($this->myElementOffset,+1)!=$this->myElementOffset )
			$ret.="<a href=\"$url".$this->getPageOffset($this->myElementOffset,+1)."\">>></a>\n";
		$ret.="</span>\n";
		return $ret;
	}
	
	public function getSortHeaderLink( $colname )
	{
		if( isset($this->mySortColumns[$colname]) )
		{
			$ret="<a href='".$_SERVER['PHP_SELF']."?".getRequest(array("skip"=>"sort", "skip1"=>"desc")).
				"sort=".$this->myColumns[$colname]->getSortName();
			if( $_REQUEST['sort']==$this->myColumns[$colname]->getSortName() && !isset($_REQUEST['desc']) ) $ret.="&amp;desc";
			$ret.="'>";
			if( $this->myColumns[$colname]->myBriefMsg!="" )
				$ret.=$this->myColumns[$colname]->myBriefMsg;
			else 
				$ret.=$this->myColumns[$colname]->myDescription;
			$ret.="</a>";
			return $ret;
		}
		else 
			return ($this->myColumns[$colname]->myBriefMsg!="")?$this->myColumns[$colname]->myBriefMsg:$this->myColumns[$colname]->myDescription;
	}

	public function getSortHeaderLinkNewStyle( $colname,$title )
	{
		if( isset($this->mySortColumns[$colname]) )
		{
			$ret="<a href='".$_SERVER['PHP_SELF']."?".getRequest(array("skip"=>"sort", "skip1"=>"desc","skip2"=>"ajax")).
				"sort=".$colname;
			if( $_REQUEST['sort']==$colname && !isset($_REQUEST['desc']) ) $ret.="&amp;desc";
			$ret.="'>$title</a>";
			return $ret;
		}
		else 
			return $title;
	}
	
	
	public function getSortOptions( )
	{
		global $langdata;
	
//		return "pp".sizeof( $this->mySortColumns);
		if( sizeof($this->mySortColumns)==0 ) return "";
		$ret.="<span class=\"sortingblock\">".$langdata["sort_by"]; 
		$ret.=" <select class=\"sortingselect\" onchange=\"document.location.href='".$_SERVER['PHP_SELF']."?".getRequest(array("skip"=>"sort"))."sort='+this.options[this.selectedIndex].value\">\n";
		foreach( $this->mySortColumns as $c )
		{
			$ret.="<option value='".$this->myColumns[$c]->getSortName()."' ";
			if( $_REQUEST['sort']==$this->myColumns[$c]->getSortName() ) $ret.=" selected='selected' ";
			$ret.=">".$this->myColumns[$c]->mySortName."</option>\n";
		}
		$ret.="</select>\n</span>\n";
		return $ret;
	}
	
	public function isError( $name,&$err_cols )
	{
		return !($err_cols[$name]===null);
	}
	
	public function getTableHeader( )
	{
		return "";
	}	
}

?>
