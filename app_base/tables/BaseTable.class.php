<?php

include_once(  BASEDIR . "/class/reklama_ua/columns/BaseColumn.class.php" );

/**
 * Класс, реализующий работу по отображению и редактированию элементов таблицы
 *
 */
class BaseTable
{
	/**
	 * Переменная для связи с базой данных
	 *
	 * @var ADOConnection
	 */
	var $myDB;
	var $myPhp;
	var $myTemplate;
	var $myTemplateForm;
	var $myTableName;
	var $myLang; ///< if not null, use language feature of the table
	var $myDeps=array();
	var $myUrlAddon="";
	
	var $myCaptchaPrivateKey="6LckUAEAAAAAADSFrCjjsOUlK-AQcnImNYTYqeAB";
	var $myCapthcaPublicKey="6LckUAEAAAAAAKWvrknmWKbs2xbiK10K3YAnJnA4";
//	var $myCaptchaPrivateKey="6LffuwAAAAAAAEDzTOC48qjoa6nhHD4GhjHeOFkQ";
//	var $myCapthcaPublicKey="6LffuwAAAAAAAJIOZ0UhDNdrwQ8le21Y9XcU1jXv";
	// var $myCaptchaPrivateKey="6LcWugAAAAAAAFVqY6UIz-9Z4Osg2r4K0Jm1qXL3";
	// var $myCapthcaPublicKey="6LcWugAAAAAAAFGhj0tr-U-hPybp3l5LsbcNHLna";
		
	var $myElementsPerPage=10;
	var $myElementOffset=0;
	var $myElementCount=0;
	var $myIsOffset=false;
	
	var $mySortColumns=array();

	//	var $myHiddenColumns=array();

	/**
	 * ffddf
	 *
	 * @var BaseColumn[]
	 */
	var $myColumns=array();
	var $myData;
	var $myId;
	
	var $myOrder;
	
//	public function Delete( )
//	{
//		echo "==>Mem usage is: ", memory_get_usage(), "\n";
//		parent::Delete( );
//		unset( $this->myData );
//		echo "<==Mem usage is: ", memory_get_usage(), "\n";
//		unset( $this->myPictureColumns );
//		unset( $this->myColumns );
//		foreach( $this->myColumns as $key=>&$val )
//		{
//			unset( $this->myColumns[$key] );
//			unset( $col->myTable );
//		}
//		$this->myColumns=NULL;
//		unset( $this->myDB );
//		unset( $this->myParent );
//		unset( $this->myDB );
//	}	
	
	/**
	 * Конструктор класса
	 *
	 * @param adodb $db
	 * @param string $php
	 * @param string $template
	 * @param string $template_form
	 * @param string $tblname
	 * @param BaseColumn[] $columns
	 * @param string $id
	 * @return BaseTable
	 */
	function BaseTable( &$db,$php,$template,$template_form,$tblname,$columns,$id="id",$lang=NULL,$urladdon="",$offsets=false )
	{
		$this->myDB=&$db;
		$this->myPhp=$php;
		$this->myTemplate=$template;
		$this->myTemplateForm=$template_form;
		$this->myTableName=$tblname;
		$this->myColumns=$columns;
		$this->myId=$id;
		$this->myLang=$lang;
		$this->myUrlAddon=$urladdon;
		$this->myIsOffset=$offsets;
	}
	
	function showDefault( &$request ) { return $this->showList( $request ); }
	
	function showListTmpl( &$request, &$tmpl )
	{
		global $LANG;
		$template=$this->myTemplate;
		if( isset($request['rss']) ) 
		{
			header( "Content-type: application/rss+xml; charset=utf-8" );
			$template.=".rss.xml";
		}
		
		if( !$tmpl->is_cached($template, (isUserLogged()?$_SESSION["user"]:"").getRequest(array())) )
		{
			$sql= " FROM $this->myTableName";
			$where="";
			if( isset($this->myLang) ) $where.=" $this->myLang='$LANG'";
			
			foreach( $this->myColumns as $col )
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
			$this->myData=&$res->GetRows( );
			$tmpl->assign_by_ref( "this", $this );
		}
		$tmpl->display( $template, (isUserLogged()?$_SESSION["user"]:"").getRequest(array()) );		
	}
	
	function showList( &$request )
	{
		global $LANG;
		$tmpl=new ReklamaUA( BASEDIR . "/templates/", "$LANG/" );
		$this->showListTmpl( $request, $tmpl );
		$tmpl->assignMainMenu( );
	}
	
	function showBrief( &$row )
	{
		$ret="";
		foreach( $this->myColumns as $col )
		{
			if( $col->myIsBrief ) 
			{ 
				$ret.=$row[$col->myName]." ";
			}
		}
		return $ret;
	}
	
	function showRowTmpl( &$request, &$tmpl )
	{
		global $LANG;
		
		if( !$tmpl->is_cached($this->myTemplate, (isUserLogged()?$_SESSION["user"]:"").getRequest(array())) )
		{
			$sql="SELECT * FROM $this->myTableName WHERE $this->myId='".$request[$this->myId]."'";
			if( isset($this->myLang) ) $sql.=" AND $this->myLang='$LANG'";
			$this->myData=$this->myDB->GetRow( $sql );
			$tmpl->assign_by_ref( "this", $this );
			
		}
		$tmpl->display( $this->myTemplate, (isUserLogged()?$_SESSION["user"]:"").getRequest(array()) );	
	}

	function showRow( &$request )
	{
		global $LANG;
		if( isset($request['xml']) ) return $this->exportXML( $request );

		$tmpl=new ReklamaUA( BASEDIR . "/templates/", "$LANG/" );
		$tmpl->assignMainMenu( );
		
		return $this->showRowTmpl( $request, $tmpl );
	}
	
	function showAddEditRow( &$request )
	{
		if( !$this->allowChanges($request) ) return;
		global $LANG;
		$tmpl=new ReklamaUA( BASEDIR . "/templates/", "$LANG/" );
		if( isset($request['inner']) ) $tmpl->assign( "withouthead", "true" );
		$tmpl->prepareOutput( );
		$id=$request[$this->myId];

		if( isset($id) ) 
		{
			$tmpl->assign( "edit", "$id" );
			$sql="SELECT * FROM $this->myTableName WHERE $this->myId";
			if( $id!="" ) $sql.="='$id'"; else $sql.=" IS NULL ";
			if( isset($this->myLang) ) $sql.=" AND $this->myLang='$LANG'";
			$this->myData=$this->myDB->GetRow( $sql );
			$tmpl->assignMainMenu( );
		}
		$tmpl->assign_by_ref( "this", $this );
		if( isset($request['error']) ) 
		{
			$tmpl->assign( "error", $request['error'] );
			$this->myData=$request;
		}

		$tmpl->clear_cache( $this->myTemplateForm );
		$tmpl->display( $this->myTemplateForm );	 
	}
	
	function deleteRow( &$request )
	{
		if( !$this->allowChanges($request) ) return;
		$id=$request[$this->myId];
		if( isset($id) ) $this->myDB->Execute( "DELETE FROM $this->myTableName WHERE $this->myId='$id'" );
	}
	
	function checkBeforeSave( &$request )
	{
		foreach( $this->myColumns as $col )
		{
			if( $col->myIsReadonly ) continue;
			$ret=$col->checkBeforeSave( $request );
			if( !$ret ) $error.=$col->myError;
		}

		if( $error!="" ) 
		{
			$request['error']=$error;
			$this->showAddEditRow( $request );
			exit( 0 );
		}
	}
	
	function saveRowUpdate( $id, &$request )
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
		foreach( $this->myColumns as &$col ) $col->postUpdate( $id,$request );
	}
	
	function saveRowInsert( &$request )
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
		foreach( $this->myColumns as &$col ) $col->postInsert( $id,$request );
		
		return $id;
	}

	function saveRow( &$request )
	{
//		$DB->debug=true;
		if( !$this->allowChanges($request) ) return;
		$this->checkBeforeSave( $request );
		
		$id=$request[$this->myId];
		if( isset($id) )
		{
			return $this->saveRowUpdate( $id,$request );
		}
		else
		{
			return $this->saveRowInsert( $request );
		}
	}
	
	function postSave( &$request ) 
	{ 
		$this->closeWindow(); 
	}
	
	function postDelete( &$request ) 
	{
		$this->closeWindow();
		//header( "Location: $this->myPhp?action=list&".$this->getAdditionalParametersAfterDelete(&$request) ); 
	}
	
	function getAdditionalParameters( ) { return ""; }
	function getAdditionalParametersAfterDelete( &$request ) { return ""; }
	
	function closeWindow( )
	{
		print "<script>window.opener.parent.location.reload(); window.close();</script>";
	}
	
	function getAddCtrl( )
	{
		if( !$this->allowChanges($_REQUEST) ) return "";
		$ret="";
		$ret.="<a href=\"javascript:;\" onclick=\"window.open('$this->myPhp?action=add&amp;".$this->getAdditionalParameters( );
		foreach( $this->myColumns as $col )
		{
			if( !$col->myIsVisible && !isset($col->myIsProtected) ) 
			{ 
				$ret.="&amp;$col->myName=".$col->getValue($this)."";	
			}
		}
		$ret.="&amp;$this->myUrlAddon','w".rand()."','scrollbars=1,toolbar=0,resizable=1')\" ><img 
		        src='/images/admin/new.gif' onmouseover=\"Tip('Добавить')\"></a>";
		return $ret;
	}	

	function getEditCtrl( &$row )
	{
		if( !$this->allowChanges($_REQUEST) ) return "";
		$ret="";
		$ret.="<a href=\"javascript:;\" onclick=\"window.open('$this->myPhp?$this->myId=".$row[$this->myId]."&amp;action=edit&amp;".$this->getAdditionalParameters( );
		foreach( $this->myColumns as $col )
		{
			if( !$col->myIsVisible && !isset($col->myIsProtected) ) 
			{ 
				$ret.="&amp;$col->myName=".$col->getValue($row)."";	
			}
		}
		$ret.="&amp;$this->myUrlAddon','w".rand()."','scrollbars=1,toolbar=0,resizable=1')\" ><img 
		        src='/images/admin/edit.gif' onmouseover=\"Tip('Редактировать')\"></a>";
		$ret.="";
//		$ret.="<a href='".$this->myTemplate.".php?action=edit&amp;id=".$row[$this->myId]."' target='_new'><img 
//		        src='images/admin/edit.gif' onmouseover=\"Tip('Редактировать')\"></a>";
		return $ret;
	}
	
	function getDeps( &$row )
	{
		if( !$this->allowChanges($_REQUEST) ) return "";
		$ret="";
		foreach( $this->myDeps as $value ) 
		{
			$ret.="<a href='$this->myPhp?action=list&amp;".$value["fk"]."=".$row[$this->myId]."&amp;".$value['url']."'>".$value['descr']."</a>\n";
		}
		return $ret;
	}
	
	function getSaveUrl( &$row )
	{	
		$ret="$this->myPhp?action=save";
		foreach( $this->myColumns as $col )
		{
			if( !$col->myIsVisible && !isset($col->myIsProtected) ) 
			{ 
				$ret.="&amp;$col->myName=".$col->getValue($row)."";	
			}
		}
		$ret.="&amp;$this->myUrlAddon";
		return $ret;
	}
	
	function getShowRowHref( &$row )
	{	
		$ret="$this->myPhp?action=show&amp;$this->myId=".$row[$this->myId];
		foreach( $this->myColumns as $col )
		{
			if( !$col->myIsVisible && !isset($col->myIsProtected) ) 
			{ 
				$ret.="&amp;$col->myName=".$col->getValue($row)."";	
			}
		}
		$ret.="&amp;$this->myUrlAddon";
		return $ret;
	}
	
	function getDeleteCtrl( &$row )
	{
		if( !$this->allowChanges($_REQUEST) ) return "";
		$ret="";
		$ret.="<a href=\"javascript:;\" onclick=\"if( confirm('Вы подтверждаете удаление?') ) window.open('$this->myPhp?$this->myId=".$row[$this->myId]."&amp;action=delete&amp;".$this->getAdditionalParameters( );
		foreach( $this->myColumns as $col )
		{
			if( !$col->myIsVisible && !isset($col->myIsProtected)) 
			{ 
				$ret.="&amp;$col->myName=".$col->getValue($row)."";	
			}
		}
		$ret.="&amp;$this->myUrlAddon','w".rand()."','width=0,height=0,left=0,top=0,scrollbars=1,resizable=1')\" ><img 
			   src='/images/admin/delete.gif' onmouseover=\"Tip('Удалить')\"></a>";
		return $ret;
	}
	
	function extractId( &$row )
	{
		return $row[$this->myId];
	}
	
	function getCurPage( &$request,$count )
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
	
	function getPageOffset( $page,$offset )
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
	
	function getPageOffsetCtrl( )
	{
		global $LANG,$langdata;
		if( $this->myElementCount<=$this->myElementsPerPage ) return ""; //no need to special navigation control
		$this->myElementOffset=$this->getPageOffset($this->myElementOffset,0); //additional check
		
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
		//print_r( $pages );

		$url=$_SERVER['PHP_SELF']."?".getRequest(array("skip"=>"pp"));
		$ret="<span class=\"pagesblockinside\">".$langdata['navi_page'].":\n";
		if( $this->myElementOffset>0 )
			$ret.="<a href=\"$url&amp;pp=".$this->getPageOffset($this->myElementOffset,-1)."\"><<</a>\n";
		foreach( $pages as $i )
		{
			if( $i==$this->myElementOffset )
				$ret.="<span class=\"selectedpage\">".($i+1)."</span>\n";
			else
				$ret.="<a href=\"$url&amp;pp=$i\">".($i+1)."</a>\n";
		}
		if( $this->getPageOffset($this->myElementOffset,+1)!=$this->myElementOffset )
			$ret.="<a href=\"$url&amp;pp=".$this->getPageOffset($this->myElementOffset,+1)."\">>></a>\n";
		$ret.="</span>\n";
		return $ret;
	}
	
	function getSortHeaderLink( $colname )
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

	function getSortHeaderLinkNewStyle( $colname,$title )
	{
		if( isset($this->mySortColumns[$colname]) )
		{
			$ret="<a href='".$_SERVER['PHP_SELF']."?".getRequest(array("skip"=>"sort", "skip1"=>"desc")).
				"sort=".$colname;
			if( $_REQUEST['sort']==$colname && !isset($_REQUEST['desc']) ) $ret.="&amp;desc";
			$ret.="'>$title</a>";
			return $ret;
		}
		else 
			return $title;
	}
	
	
	function getSortOptions( )
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
	
	function isError( $name,&$err_cols )
	{
		return !($err_cols[$name]===null);
	}
	
	function getTableHeader( )
	{
		return "";
	}
	
	protected function setColumnCommonData( )
	{
		foreach( $this->myColumns as &$col ) 
		{
			$col->myTable=$this;
		}
	}
	
	function allowChanges( &$request )
	{
		return isAdmin( );
	}
	
	function addColumns( $columns )
	{
		$this->myColumns=array_merge( $this->myColumns, $columns );
	}
	
	function addDependend( $dep )
	{
		array_push( $this->myDeps, $dep );
	}
	
	function addSortColumns( $sort )
	{
		$this->mySortColumns=array_merge( $this->mySortColumns, $sort );
	}

	function isId( )
	{
		return isset( $this->myData[$this->myId] );
	}
	
	function getId( )
	{
		return $this->myData[$this->myId];
	}

	function exportXML( $request )
	{
		$ret="<ad>\n";

		foreach( $this->myColumns as $column )
		{
			$ret.=$column->getXML( $request );
		}

		$ret.="</ad>\n";

		return $ret;
	}	
}

?>
