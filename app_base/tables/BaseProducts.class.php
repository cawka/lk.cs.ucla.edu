<?php

include_once( "BaseTable.class.php" );
require_once( BASEDIR . "/class/recaptcha/recaptchalib.php" );
require_once( BASEDIR . "/class/Mail.class.php" );

class BaseProduct extends RecursiveCatalog  
{
	var $myCatId;
	var $myRegion;

	/**
	 * @var Announcement
	 */
	var $myProducts;
	
	/**
	 * @var RegionsClass
	 */
	var $myRegions;
	
	public $myLogo;
	
	function BaseProduct( &$db, $cat_id, $tblname, $columns, $region=NULL )
	{
		$this->myCatId=$cat_id;
		$this->myProductTable=$tblname;
		$this->myRegion=$region;
		
		global $LANG;
		
		if( isset($_REQUEST['id']) && $_REQUEST['id']!="" )
		{
			$tmp=APC_GetRow( array("data","id",$_REQUEST['id'],"cat_id"),$db,"SELECT cat_id FROM data WHERE id='$_REQUEST[id]'" );
			$cat_id=$tmp['cat_id'];
			$_REQUEST['cat_id']=$cat_id;
		}
		
		if( $_REQUEST['action']=='show' && !(isset($cat_id) && $cat_id!="") ) 
		{
			$tmp=APC_GetRow( array("data_archive","id",$_REQUEST['id'],"id"),$db,"SELECT id FROM data_archieve WHERE id='$_REQUEST[id]'" );
			if( !isset($tmp['id']) ||  $tmp['id']=="" ) 
			{
				header( "Location: /no_advertisment.html" );
				exit( 0 );
			}
			
			function __autoload( $classname )
			{
				preg_match( "/^(.+)(column|model|controller|helper)$/i",$classname,$matches );
				$prefix=BASEDIR . "/app/" . strtolower($matches[2]);
				if( strtolower($matches[2])=="column" ) $prefix=BASEDIR . "/class/reklama_ua/columns";
				
				if( is_file("$prefix/$classname.class.php") ) include_once( "$prefix/$classname.class.php" );
			}
			
			$archieve=&new ArchieveController( new ArchieveModel("archieve"),new BaseTableHelper()	);
			$tmpl=&new MySmarty( BASEDIR."/app/view/", $LANG );
			$archieve->show( $tmpl,$_REQUEST );

			exit( 0 );
		}
		
		parent::RecursiveCatalog( $db,$cat_id,0,1 );
		
		if( !isset($_REQUEST['prod']) ) 
		{
			$this->buildFullCatalog();
			
			if( isset($_REQUEST['id']) && $_REQUEST['id']!="" )
			{
				$cat_id=NULL;//$this->myInfo['cat_id'];
			}
			else
			{
				$subcat=$_REQUEST['subcat'];
				if( $subcat===null || $subcat=="" ) 
				{
					if( sizeof($this->ChildMap)>0 )
					{
						foreach( $this->ChildMap as $val )
						{
							$subcat=$val->myInfo['cat_id'];
							$this->myInfo['type_data']=$val->myInfo['type_data'];
							break;
						}
					}
					else
						$subcat=$cat_id;
				}
				else
				{
				    foreach( $this->ChildMap as $val )
				    {
						if( $val->myInfo['cat_id']==$subcat )
						{
						    $this->myInfo['type_data']=$val->myInfo['type_data'];
						    break;
						}
				    }
				}
				$cat_id=$subcat;
				$_REQUEST['subcat']=$cat_id;
			}
		}

		$this->myProducts=&new Announcement( $this,$db,
				$cat_id,
				"post.php", $this->myTemplate, $this->myTemplateForm,
				$this->myInfo['type_data'],
			"id",NULL,"prod",$region );
		$this->myRegions=&new RegionsClass( $this->myDB,$this->myRegion,"" );
		$this->myRegions->mapSelectHack( );
		
		$this->myLogo=new PartnerPhotoColumn("","");
	}
	
	function showDefault( &$request )
	{
		$this->showNewAnnoncement( $request ); //default action - new Announcement
	}
	
	function showList( &$request )
	{
		global $langdata,$LANG;
		$template=$this->myTemplate;
		if( isset($request['rss']) ) 
		{
			header( "Content-type: application/rss+xml; charset=utf-8" );
			$template.=".rss.xml";
		}
		$tmpl=new ReklamaUA( "templates/", "$LANG/" );
	
		if( !$tmpl->is_cached($template,(isUserLogged()?$_SESSION["user"]:"").getRequest(array()) ) )
		{
			$this->buildFullCatalog( );
			$this->myProducts->getProductData( $request );
			$tmpl->assign( "subcat", $request['subcat'] );

			$tmpl->assign_by_ref( "this", $this );
			$tmpl->assignMainMenu( );
		}
		
		$tmpl->display( $template,(isUserLogged()?$_SESSION["user"]:"").getRequest(array()) );	
	}
	
	function showFavourites( &$request )
	{
		global $LANG;
		$tmpl=new ReklamaUA( "templates/", "$LANG/" );
		$tmpl->caching=false;
	
//		if( !$tmpl->is_cached("favourites.tpl") )
//		{
			$this->myProducts->getProductDataBrief( $_SESSION['bookmarks'] );

			$tmpl->assign( "bookmarks", true );
			$tmpl->assign_by_ref( "this", $this );
			$tmpl->assignMainMenu( );
//		}
//		$tmpl->clear_cache( "ads/list_notebook.tpl","favaurites" );
		$tmpl->display( "ads/list_notebook.tpl","favaurites" );
	}
	
	function showSearch( &$request )
	{
		global $LANG;
		$template="ads/list_search.tpl";
		if( isset($request['rss']) ) 
		{
			header( "Content-type: application/rss+xml; charset=utf-8" );
			$rss="(rss)";
			$template.=".rss.xml";
		}
		$cache_id="search$rss-($request[search])($request[cat_id])($request[reg_id])($request[date])($request[phone_num])($request[user])($request[ip])($request[pp])(".(isset($request['print'])?"print":"").")($request[withphoto])($request[email])($request[uuid])($_SESSION[user])";
//		print $cache_id;die;

		$tmpl=new ReklamaUA( "templates/", "$LANG/" );
		
		if( !$tmpl->is_cached($template,$cache_id) )
		{
			$this->myProducts->getProductDataSearch( $request );

			$tmpl->assign( "search", true );
			$tmpl->assign_by_ref( "this", $this );
			$tmpl->assignMainMenu( );
		}
		$tmpl->display( $template,$cache_id );
	}

	function showRow( &$request )
	{
		global $LANG;

//		if( isset($request['xml']) )
//		{
//			header( "Content-type: text/xml" );
//			$this->myProducts->getProductData( $request,$request['id'] );
//
//			if( $this->myProducts->myData['cat_id']!==null )
//	                {
//		                $this->myCatCatId=$this->myProducts->myData['cat_id'];
//				$this->buildParentPath( );
//			}
//			$this->buildFullCatalog( );
//			print $this->myProducts->exportXML( $this->myProducts->myData );
//			exit( 0 );
//		}

		if( isset($request['print']) ) $print="(print)"; else $print="";
		$tmpl=new ReklamaUA( "templates/", "$LANG/" );
		if( !$tmpl->is_cached($this->myTemplate,"($_SESSION[group])($request[id])($request[uuid])$print") )
		{
			if( $request['uuid'] )
			{
				$request['id']=$this->myDB->GetOne( "SELECT id FROM data WHERE long_id='".$request['uuid']."'" );
				if( !$request['id'] ) $request['id']=NULL;
			}
			$this->myProducts->getProductData( $request,$request['id'] );
					
			if( $this->myProducts->myData['cat_id']!==null )
			{
				$this->myCatCatId=$this->myProducts->myData['cat_id'];
				$this->buildParentPath( );
			}
			$this->buildFullCatalog( );
			$tmpl->assign_by_ref( "this", $this );
			if( isset($this->myCatCatId) ) $tmpl->assignMainMenu( );
		}
		$tmpl->display( $this->myTemplate, "($_SESSION[group])($request[id])($request[uuid])$print" );
	}
	
	function showNewAnnoncement( &$request,$error="" )
	{
		global $LANG,$langdata;
		
		// automated data insertion
		if( isUserLogged() )
		{
//			$this->myDB->debug=true;
			$data=APC_GetRow( array("users",$_SESSION['user']),$this->myDB,
				"SELECT * FROM users WHERE user_id='".$_SESSION['user']."'" );
//			$data=$this->myDB->GetRow( "SELECT * FROM users WHERE user_id='".$_SESSION['user']."'" );
			$request['name']=$data['u_name'];
			$request['email']=$data['u_email'];
			$request['phone_num'] =$data['u_phone_num'];
			$request['phone_code']=$data['u_phone_code'];
		}
		
		$tmpl=new ReklamaUA( "templates/", "$LANG/" );
		unset( $this->myProducts->myColumns['cat_id'] );
		
		$this->buildFullCatalog( );
		if( sizeof($this->myData)==0 ) 
		{
			$this->myProducts->myData=&$request;
		}

		$err_msg="";
		if( isset($request['error']) ) $err_msg.=$request['error'];
		if( $error!="" ) $err_msg.=$langdata[$error];
		if( $err_msg!="" ) $tmpl->assign( "error", $err_msg );
		if( !($request['err_cols']===null) ) $tmpl->assign_by_ref( "err_cols",$request['err_cols'] );
	
		$tmpl->assign_by_ref( "this", $this );

		if( isset($request['inner']) ) $tmpl->assign( "withouthead", true );
		$tmpl->clear_cache( "ads/_add.tpl",$_SESSION['user'].getRequest(array()) );	
		$tmpl->display( "ads/_add.tpl",$_SESSION['user'].getRequest(array()) );	 
	}
	
	function showAddEditRow( &$request )
	{
		global $LANG,$langdata;

		if( isset($request['prod']) )
		{
			$tmpl=new ReklamaUA( "templates/", "$LANG/" );
			
			if( isset($request["uuid"]) )
			{
				$row=$this->myDB->GetRow( "SELECT * FROM data d JOIN catalog c ON c.cat_id=d.cat_id JOIN cat_types ON type_id=cat_type WHERE long_id='".$request['uuid']."'" );
			}
			
			if( $row )
			{
				$this->myCatId=$row['cat_id'];
				$this->myCatCatId=$row['cat_id'];
////				$this->updateMyInfo( );
				$this->buildParentPath( );
				
				$this->myProducts=&new Announcement( $this,$this->myDB,
						$row['cat_id'],
						"post.php", $this->myTemplate, $this->myTemplateForm,
						$row['type_data'],
					"id",NULL,"prod",$this->myRegion );
						
//				$this->myTableName=$row['type_data'];
				$this->myProducts->getProductData( $request,$row['id'],true );
	
				$err_msg="";
				if( isset($request['error']) ) $err_msg.=$request['error'];
//				if( $error!="" ) $err_msg.=$langdata[$error];
				if( $err_msg!="" ) $tmpl->assign( "error", $err_msg );
				if( !($request['err_cols']===null) ) $tmpl->assign_by_ref( "err_cols",$request['err_cols'] );
			
				$tmpl->assign_by_ref( "this", $this );
				$tmpl->assign( "disable_catalog", "true" );
				
				$tmpl->clear_cache( "ads/_add.tpl",$_SESSION['user'].getRequest(array()) );	
				$tmpl->display( "ads/_add.tpl",$_SESSION['user'].getRequest(array()) );	 
			}
			else
			{
				$tmpl=new ReklamaUA( "templates/", "$LANG/" );
				
				$tmpl->clear_cache( "ads/_edit.tpl",(isUserLogged()?$_SESSION["user"]:"").getRequest(array()) );
				$tmpl->assignMainMenu( );
				$tmpl->display( "ads/_edit.tpl", (isUserLogged()?$_SESSION["user"]:"").getRequest(array()));	
			}			
		}
		else 
			parent::showAddEditRow( $request );
	}
	
	function saveRow( &$request )
	{
		if( isset($request['prod']) )
		{
			setGlobalLang( );

			$this->myProducts->saveRow( $request );
		}
		else 
			parent::saveRow( $request );
	}
	
	function deleteRow( &$request )
	{
		if( isset($request['prod']) )
		{
			$this->myProducts->deleteRow( $request );
		}
		else 
			parent::deleteRow( $request );
	}
	
	function postSave( &$request )
	{
		if( isset($request['prod']) )
		{
			$this->myProducts->postSave( $request );
		}
		else 
			parent::postSave( $request );
	}

	function postDelete( &$request )
	{
		if( isset($request['prod']) )
		{
			$this->myProducts->postDelete( $request );
		}
		else 
			parent::postDelete( $request );
	}
}

?>
