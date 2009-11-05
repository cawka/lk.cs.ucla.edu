<?php
require_once( "AutoColumnTable.class.php" );

class Announcement extends AutoColumnTable  
{
	/**
	 * Массив ссылок на колонки с картинками (подмножество множества колонок)
	 *
	 * @var BaseColumn[]
	 */
	var $myPictureColumns=array( );
	
	/**
	 * Массив ссылок на колонки с картинками (подмножество множества колонок)
	 *
	 * @var BaseColumn[]
	 */
	var $myDataTable=array( "cat_id","reg_id","phone","publ_begin" );
	var $mySpecialTable=array( );
	var $myCatId;
	var $myRegion;
	var $myData=null;
	var $mySingleProduct=null;
	var $myCurRowId=NULL;
	var $myUUID=NULL;
	
	/**
	 * Brief columns
	 *
	 * @var string[]
	 */
	var $myBriefCols;
	var $myTopBriefCols;
	
	/**
	 * Link to parent object
	 *
	 * @var BaseProduct
	 */
	var $myParent;
	public $AnnEditType;
	
	function Announcement( &$parent,&$db,$cat_id,$php,$template,$template_form,$tblname,$id="id",$lang=NULL,$urladdon="",$region=null )
	{
		global $LANG,$langdata,$DB,$SETTINGS;
		$this->myCatId=$cat_id;
		$this->myRegion=$region;
		$this->myParent=$parent;

		$info=&APC_GetRow(array("catid-type",$cat_id),$DB,
			 "SELECT cat_type FROM catalog WHERE cat_id".(isset($cat_id)?"='$cat_id'":" IS NULL"),
			 0 );
	
		parent::__construct( $info['cat_type'],$php,$template,$template_form,$tblname,
			array( ),$id,$lang,$urladdon,true );
	
		$this->myElementsPerPage=$SETTINGS['advertisement_count'];
		if( isset($_REQUEST["rss"]) ) $this->myElementsPerPage=20;
		
		$this->addSortColumns( array("publ_begin"=>"publ_begin") );
		$this->getColumnOrders( );
	}
	
	protected function getStaticColumns( )
	{
		global $LANG,$langdata;
		
		$cols=array(
			'reg_id'=>	new RegionsColumn("reg_id",$langdata['cat_reg_id'],
									$langdata['cat_reg_id_msg'],999999,$langdata['cat_reg_id'] ),
		);
		$cols['reg_id']->mySpecType="region";
		return $cols;
	}
	
	protected function getAllColumns( )
	{
		global $langdata;
		
		parent::getAllColumns( );
		
		$this->addColumns( array(
				'cat_id'=>	new HiddenColumn( "cat_id",$this->myCatId ),
				'phone'=>	new PhoneColumn("phone",$langdata['cat_phone_num'],
								$langdata['cat_phone_num_msg'],$langdata['cat_phone_num_brief'],
								false,$langdata['tooltip_phone_code'],$langdata['tooltip_phone_num']),
				'publ_begin'=>new PublicationTimeColumn("publ",$langdata['cat_publ']),
		) );
	}
	
	function changeLanguage( $lang,$cat_id )
	{
		global $LANG,$langdata,$theAPC;
		$LANG=$lang;
		$langdata=null;
		setGlobalLang( );
		
		$this->myColumns['phone']->myBriefMsg=$langdata['cat_phone_num_brief'];
		$this->myColumns['reg_id']->myBriefMsg=$langdata['cat_reg_id'];
		
		$this->discoverColumns( );
	}

	protected function processDynColumnBefore( &$data )
	{
		if( $data['attr_name']=='reg_id' ) 
		{
//			print_r( $this->myStaticColumns );
			$this->myStaticColumns['reg_id']->myIsBriefInTop=$data['is_brief_in_top']=='t';

			if( is_numeric($data['attr_options']) ) 
			{
				$this->myStaticColumns['reg_id']->myLevels=$data['attr_options'];
			}
			if( $data['attr_options2']=='hidden' )
			{
				$this->myStaticColumns['reg_id']=new HiddenColumn( "reg_id","12");
				$this->myStaticColumns['reg_id']->myIsProtected=true;
			}
			return false;
		}
		
		$this->mySpecialTable[$data['attr_name']]=$data['attr_name'];
		return true;
	}
	
	protected function restoreCache( $id )
	{
		global $theAPC;
//		print_r( $theAPC->fetch( "(announcement-specialtable)".$id ) );
		$this->mySpecialTable=$theAPC->fetch( "(announcement-specialtable)".$id );
//		print_r( $this->mySpecialTable );
//		die;
	}
	
	protected function cacheData( $id )
	{
		global $theAPC;
//		print_r( $this->mySpecialTable );
		$theAPC->cache( "(announcement-specialtable)".$id, $this->mySpecialTable, 0 );
//		$this->mySpecialTable=$theAPC->fetch( "(announcement-specialtable)".$id );
//		print_r( $this->mySpecialTable );
//		die;
	}
	
	protected function processDynColumnAfter( &$col, &$data )
	{
		if( $data['attr_name']=='reg_id' ) 
		{
			return false;
		}
		
		return true;
	}
	
	function getColumnOrders( )
	{
		global $LANG,$theAPC;
		if( !isset($this->myType) ) return;

		$this->myBriefCols=APC_GetAssoc( array("attr_lang","brief",$LANG,"type_id",$this->myType),$this->myDB,
			"SELECT attr_name,attr_name FROM attrs_lang$LANG 
				WHERE type_id='$this->myType' AND attr_group>0 ORDER BY attr_brief_order,attr_group",
			0
		 );

		$this->myTopBriefCols=APC_GetAssoc( array("attr_lang","topbrief",$LANG,"type_id",$this->myType),$this->myDB,
			"SELECT attr_name,attr_name FROM attrs_lang$LANG 
				WHERE type_id='$this->myType' AND attr_top_order>0 ORDER BY attr_top_order",
			0
		);

		$this->myExtraBriefCols=APC_GetAssoc( array("attr_lang","extrabrief",$LANG,"type_id",$this->myType),$this->myDB, 
		"SELECT attr_name,attr_name FROM attrs_lang$LANG 
			WHERE type_id='$this->myType' AND 
				  (attr_group=0 OR attr_group IS NULL) AND 
				  (show_in_text='f' OR show_in_text IS NULL) AND
				  attr_type NOT IN (7,17) ORDER BY attr_order,attr_group",
			0
		);
		
		$this->myPostCols=APC_GetAssoc( array("attr_lang","post",$LANG,"type_id",$this->myType),$this->myDB, 
			"SELECT attr_name,attr_name FROM attrs_lang$LANG 
				WHERE type_id='$this->myType' 
				ORDER BY attr_post_order,attr_group",
			0
		);
		
		$reg_ok=false;
		foreach( $this->myPostCols as &$name )
		{
			if( $name=="reg_id" ) $reg_ok=true;
		}
		$this->myPostCols=array_merge( $this->myPostCols, array('cat_id'=>'cat_id','phone'=>'phone','publ_begin'=>'publ_begin') );
		if( !$reg_ok ) $this->myPostCols=array_merge( $this->myPostCols, array("reg_id"=>"reg_id") );

	}	

	function generateUUID( )
	{
		$is=true;
		while( $is )
		{
			$ret=md5(uniqid(rand(), true));
			$is=$this->myDB->GetOne( "SELECT long_id FROM data WHERE long_id='$ret'" );
		}
		return $ret;
	}
	
	private function isBanned( &$request )
	{
		//phase 1.IP check
		$ret=$this->myDB->GetOne( "SELECT id FROM bans WHERE type='ip' AND '$_SERVER[REMOTE_ADDR]' like value" );
		if( $ret ) return true;
	}
	
	/**
	 * Autorizing ad post request. Are used these rules:
	 *  
		Выбор платного или бесплатного осуществляется с помощью combobox(Платное,Бесплатное). 
		Если выбрана опция «Платное», то пользователю предоставляется поле ввода секретного кода, 
		а также ссылка на справочную информацию для получения этого кода.
		
		Объявление не будет запощено:
		 - выбрано бесплатное и изчерпан лимит бесплатных объявлений
		 - выбрано платное и неверно введен секретный код
		 - выбрано платное и лимит по секретному коду исчерпан (в принципе, тоже самое что и неверны код,
		   поскольку после достижения лимита, код удаляется из системы)
		
		Кроме того, если Парнер залогинился в систему и подает объявление, находясь в залогиненном режиме, 
		то должна отстуствовать опция выбора платного/бесплатного объявления. И объявление не будет запощено 
		в этом случае:
		 - нет лимита для постинга у текущего Партнера в выбранный раздел
		 - исчерпан месячный лимит на текущий раздел
	 *
	 * @param array $request
	 * @return boolean
	 */
	function autorizeAd( &$request )
	{
		global $SETTINGS,$langdata;
		
		if( isAdmin() ) return true;
		if( $this->isBanned($request) ) //move check to Helper class
		{
			$request['error']=$langdata['adv_banned'];
			return false;
		}
		
		if( isUserLogged() )
		{
			return $this->autorizePartners( $request );
		}
		else if( isset($request['sec_code']) ) //Payable ad. Checking security code
		{
			return $this->autorizeSecCode( $request );
		}
		else
		{
			$posts=$this->myDB->GetOne( "SELECT count(*) FROM data WHERE phone_code='".(isset($request['phone_code'])?$request['phone_code']:'inter')."' ".
										" AND phone_num='".$request['phone_num']."' AND user_id IS NULL " );
			if( !$posts || $posts<$SETTINGS["max_free_ads"] ) 
				return true;
			else 
			{
				$request['error']=$langdata['free_ad_limit'];
				return false;
			}
		}
	}
	
	function autorizePartners( &$request )
	{
		return true; //разрешаем для зарегистрированных пользователей
//		$catid=$request['cat_id'];
//		if( $catid===null ) 
//			$wh="NULL";
//		else
//			$wh="'$catid'";
//		
//		$sql="SELECT SUM(ua_count) FROM 
//			user_annon  where ua_user_id='".$_SESSION['user']."' 
//			AND ua_cat_id IN (SELECT * FROM get_catalog_parent_subtree($wh)) OR ua_cat_id IS NULL";
//		$count=$this->myDB->GetOne( $sql );
//		
//		if( !$count || $count=="" || $count==0 )
//		{
//			$request['error']="Вам не разрешено размещать объявления в этом разделе"; 
//			return false; 
//		}
//		
//		$posts=$this->myDB->GetOne( "SELECT count(*) FROM data WHERE cat_id IN (SELECT * FROM get_catalog_subtree_ids($wh)) ".
//									" AND user_id='".$_SESSION['user']."'".
//									" AND date_trunc('year',publ_begin)=date_trunc('year',NOW()) ".
//									" AND date_trunc('month',publ_begin)=date_trunc('month',NOW()) " );
//		if( $posts>=$count ) 
//		{
			$request['error']="Месячный лимит для размещения объявлений в этом разделе исчерпан";
			return false;
//		}
//		else
//			return true;
	}
	
	function autorizeSecCode( &$request )
	{
		return false;
	}
	
	function saveRowUpdate( &$request )
	{
		global $_SERVER,$langdata,$LANG;
//		if( isAdmin() ) $this->myDB->debug=true;

		if( isset($request['error']) || isset($request['err_cols']) )
		{
			$this->showAddEditRow( $request );
			exit( 0 );
		}
		
		if( isset($request["uuid"]) )
		{
			$row=$this->myDB->GetRow( "SELECT * FROM data d WHERE long_id='".$request['uuid']."'" );
			if( $row['id']!=$request['id'] ) 
			{
				$this->showAddEditRow( $request );
				exit( 0 );
			}
		}
		$this->AnnEditType="update";
		$id=$request['id'];
		$this->myCurRowId=$id;
		$this->myUUID=$request["uuid"];
		$request['publ_begin']=$row['publ_begin'];
//		$request['notify_sent']=$row['notify_sent'];
		if( $row['notify_sent']=='t' ) $this->AnnEditType="prolongation";
		
		$this->myDB->Execute( "BEGIN" );

		//////////////////////////////////
		// STAGE 1
		$ret="UPDATE data SET notify_sent='f', ";
		
		$i=0;
		foreach( $this->myDataTable as $field )
		{
			if( $this->myColumns[$field]->myGenType=="separator" ) continue;
			if( $this->myColumns[$field]->myIsReadonly ) continue;
			if( !$this->myColumns[$field]->mySQL ) 
			{
				$this->myColumns[$field]->getUpdate( $request );
				continue;
			}
			
			if( $i!=0 ) $ret.=","; $i=1;
			$ret.=$this->myColumns[$field]->getUpdate( $request );
		}
		$ret.=",publ_modif=NOW(),from_ip='".$_SERVER["REMOTE_ADDR"]."'::inet ";
		$ret.=" WHERE id='$id' ";

		$this->myDB->Execute( $ret );
		
		//////////////////////////////////
		// STAGE 2
		$ret="UPDATE ann_$this->myTableName SET ";
		$i=0;
		foreach( $this->mySpecialTable as $field )
		{
			if( $this->myColumns[$field]->myGenType=="separator" ) continue;
			if( $this->myColumns[$field]->myIsReadonly ) continue;
			if( !$this->myColumns[$field]->mySQL ) 
			{
				$this->myColumns[$field]->getUpdate( $request );
				continue;
			}
			if( $i!=0 ) $ret.=","; $i=1;
			$ret.=$this->myColumns[$field]->getUpdate( $request);			
		}
	
		$ret.=" WHERE id='$id' ";
		
		$rr=$this->myDB->Execute( $ret );
		$this->myDB->Execute( "COMMIT" );
	}
	
	function saveRowInsert( &$request )
	{
		global $_SERVER,$langdata,$LANG;
//		if( isAdmin() ) $this->myDB->debug=true;

		if( isset($request['error']) || isset($request['err_cols']) )
		{
			$this->myParent->showNewAnnoncement( $request );
			exit( 0 );
		}
		
		if( !$this->autorizeAd($request) )
		{
			$this->myParent->showNewAnnoncement( $request );
			exit( 0 );
		}
		
		$this->myDB->Execute( "BEGIN" );
		$id=$this->myDB->GenID( "data_id_seq" );
		
		// Hack for new images engine
		$request['id']=$id;
		$request['publ_begin']=date( "Y-m-d H:i:s" );
		// end of hack
		
		$this->AnnEditType="new";
		
		$this->myCurRowId=$id;
		$this->myUUID=$this->generateUUID( );
		
		//////////////////////////////////
		// STAGE 1
		$ret="INSERT INTO data (id";
		foreach( $this->myDataTable as $field )
		{
			if( $this->myColumns[$field]->myGenType=="separator" ) continue;
			$ret.=",".$this->myColumns[$field]->getUpdateName();
		}
		$ret.=",long_id,from_ip";
		if( isUserLogged() ) $ret.=",user_id";
		$ret.=")";
		
		$ret.=" VALUES('$id'";
		foreach( $this->myDataTable as $field )
		{
			if( $this->myColumns[$field]->myGenType=="separator" ) continue;
			$ret.=",".$this->myColumns[$field]->getInsert( $request );
		}
		$ret.=",'$this->myUUID','".$_SERVER["REMOTE_ADDR"]."'::inet";
		$this->myData['from_ip']=$_SERVER["REMOTE_ADDR"];
		
		if( isUserLogged() ) $ret.=",'".$_SESSION['user']."'";
		$ret.=")";
		$this->myDB->Execute( $ret );
		
		//////////////////////////////////
		// STAGE 2
		$ret="INSERT INTO ann_$this->myTableName (id";
		foreach( $this->mySpecialTable as $field )
		{
			if( $this->myColumns[$field]->myGenType=="separator" ) continue;
			$ret.=",".$this->myColumns[$field]->getUpdateName();			
		}
		$ret.=")";
		
		$ret.=" VALUES('$id'";
		foreach( $this->mySpecialTable as $field )
		{
			if( $this->myColumns[$field]->myGenType=="separator" ) continue;
			$ret.=",".$this->myColumns[$field]->getInsert( $request );				
		}
		$ret.=")";
		
		$rr=$this->myDB->Execute( $ret );
		
		if( isUserLogged() ) 
		{
			$this->myDB->Execute( "UPDATE users 
									SET 
										u_adv_count=u_adv_count+1,
										u_adv_count_cur=u_adv_count_cur+1 
									WHERE user_id='$_SESSION[user]'" );
		}
		
		$this->myDB->Execute( "COMMIT" );
	}
	
	function saveRow( &$request )
	{
		global $_SERVER,$langdata,$LANG,$SETTINGS;

		$error="";
		$err_cols=array();
		foreach( $this->myColumns as $col )
		{
			if( $col->myGenType=="separator" ) continue;
			$ret=$col->checkBeforeSave( $request );
			if( !$ret ) 
			{
				$error.=$col->myRequired;
				$err_cols[$col->myName]=true;
			}
		}
		if( sizeof($err_cols)!=0 || $error!="" ) 
		{
			$request['error']=$error;//."preved";
			$request['err_cols']=$err_cols;
		}

		if( !isset($request['id']) )
			$this->saveRowInsert( $request );
		else
			$this->saveRowUpdate( $request );
		
		$this->save_stage3( $request );
//		////////////////////////////////////
//		// STAGE 3
//		$this->myDB->Execute( "BEGIN" );
//		$this->getProductData( $request,$this->myCurRowId );
//		
//		$isphoto=$this->isImage( $this->myData,true )?'TRUE':'FALSE';
//		$photo=$isphoto=='TRUE'?$this->getFirstImagePreview( $this->myData,true ):"";
//		
//		$srch=$this->myDB->qstr(addslashes( extractCatalogPath( array("id"=>$request['cat_id'],"delim"=>" ")." " ). 
//						  $this->showBrief($this->myData,true,true) ));
//		$email=$this->myDB->qstr(addslashes( $this->myData['email'] ));
//		$real_email=$this->myData['email'];
//
//		$this->myDB->Execute( 
//"UPDATE data 
//	SET 
//		brief_is_photo='$isphoto',
//		search        =$srch,
//		brief_photo   ='$photo',
//		email_copy    =$email 
//	WHERE id='$this->myCurRowId'" );
//		
//		$this->updateDenormalizedData( $this->myCurRowId,$request );
//		$this->myDB->Execute( "COMMIT" );
////		die;
//		
////		$this->sendAdvertismentToEmail( $SETTINGS['notice_email'],$request,"admin_email" );
//		$this->sendAdvertismentToEmail( $real_email,$request );
//
////		if( isAdmin() ) die;
	}
	
	function save_stage3( $request )
	{
		$this->myDB->Execute( "BEGIN" );
		$this->getProductData( $request,$this->myCurRowId );
		
		$isphoto=$this->isImage( $this->myData,true )?'TRUE':'FALSE';
		$photo=$isphoto=='TRUE'?$this->getFirstImagePreview( $this->myData,true ):"";
		
		$srch=$this->myDB->qstr(addslashes( extractCatalogPath( array("id"=>$request['cat_id'],"delim"=>" ")." " ). 
						  $this->showBrief($this->myData,true,true) ));
		$email=$this->myDB->qstr(addslashes( $this->myData['email'] ));
		$real_email=$this->myData['email'];

		$this->myDB->Execute( 
"UPDATE data 
	SET 
		brief_is_photo='$isphoto',
		search        =$srch,
		brief_photo   ='$photo',
		email_copy    =$email 
	WHERE id='$this->myCurRowId'" );
		
		$this->updateDenormalizedData( $this->myCurRowId,$request );
		$this->myDB->Execute( "COMMIT" );
//		die;
		
//		$this->sendAdvertismentToEmail( $SETTINGS['notice_email'],$request,"admin_email" );
		$this->sendAdvertismentToEmail( $real_email,$request );

//		if( isAdmin() ) die;		
	}
	
	function updateDenormalizedData( $id,&$data )
	{
		global $LANG;
		$br=array(); 
		$cat=array();
		$tops=array();
		
		$this->myData=&$data;
		
		$orig_lang=$LANG;

		$this->myPostCols['publ_begin']=NULL;
		for( $i=1; $i<=3; $i++ )
		{
			$this->changeLanguage( $i,$data['cat_id'] );
			$br[$i]="brief$i=".$this->myDB->qstr( $this->showBrief($data,true,false) );
			$cat[$i]="cat_brief$i=".$this->myDB->qstr( extractCatalogPath( array("id"=>$data['cat_id'],"delim"=>">>") ) );
			$tops[$i]="brief_top$i=".$this->myDB->qstr( $this->showTopBrief( $data ) );
			
			$tmpl=&new ReklamaUA( BASEDIR . "/templates/", "$i" ); $tmpl->assign_by_ref( "this", $this->myParent );
			$tmpl->caching=false;
			$full[$i]="full$i=".$this->myDB->qstr( stripslashes($tmpl->fetch("ads/single_formatdata.tpl","($_SESSION[group])($data[id])()")) );
			$tmpl=NULL;
		}
		$LANG=$orig_lang;
					
//		$DB->debug=true;
		$this->myDB->Execute( "UPDATE data SET ".implode(",",$br).",".
												 implode(",",$cat).",".
												 implode(",",$tops).",".
												 implode(",",$full).
											     " WHERE id='$id'" );
//		$this->changeLanguage( $LANG,$data['cat_id'] );
//		$DB->debug=false;
	}
	
	function sendAdvertismentToEmail( $email,&$request,$tmpl_register="" )
	{
		global $LANG,$SETTINGS;
		if( !$email || $email=="" ) return;
		
		$to=$email;
		
		switch( $this->AnnEditType )
		{
			case "new":
				$subject=   $SETTINGS['notify_reply_subject'];//"Новое объявление";
				break;
			case "update":
				$subject=   $SETTINGS['notify_reply_subject_edit'];
				break;
			case "prolongation":
				$subject=   $SETTINGS['notify_reply_subject_edit_prolong'];//"Новое объявление";
				break;
		} 
		
		$tmpl=new ReklamaUA( BASEDIR . "/templates/", "$LANG" );
		$tmpl->caching=false;
		
		if( $tmpl_register!="" ) $tmpl->assign( "$tmpl_register", $tmpl_register );
		
		$tmpl->assign( "uuid", $this->myUUID );
		$tmpl->assign_by_ref( "this", $this->myParent );

		Mail::sendFromRobot( $to,$subject,
			$tmpl->fetch("ads/email.tpl"),
			$tmpl->fetch("ads/email.txt.tpl")
		);
	}
	
	function deleteRow( &$request,$robot=false )
	{
		global $LANG,$DB;
		if( isset($request["uuid"]) )
		{
			$row=$this->myDB->GetRow( "SELECT * FROM data d WHERE long_id='".$request['uuid']."'" );
		}

		if( $row )
		{
			if( isset($request['admin']) &&
			    $request['confirm_delete']!='1' && 
				($row['comm_bold']=='t' ||
				 $row['comm_up']  =='t' ||
				 $row['comm_top'] =='t') )
			{
				$str=array(); 
				if( $row['comm_bold']=='t' ) array_push( $str,"Выделение" );
				if( $row['comm_up']=='t' )   array_push( $str,"Наверху списка" );
				if( $row['comm_top']=='t' )  array_push( $str,"Рекламный блок" );
				
				$tmpl=new ReklamaUA( "templates/", "$LANG/" );
				$tmpl->assign( "error", "<input type='checkbox' name='confirm_delete' value='1'> Внимание! <b>Это объявление платное</b> <i>(".implode(",",$str).")</i>. Подтверждаете удаление?" );
				$tmpl->assign( "uuid", $request['uuid'] );
				return $tmpl->display( "ads/_delete.tpl", $_SESSION["user"].getRequest(array()) );	
			}

			if( $row['user_id']!="" )
			{
				if( !$robot ) $dec_count=" u_adv_count=u_adv_count-1, ";
				$this->myDB->Execute( "UPDATE users SET $dec_count u_adv_count_cur=u_adv_count_cur-1 WHERE user_id='$row[user_id]'" );
			}
			$this->myDB->Execute( "DELETE FROM data WHERE id='".$row['id']."'" );
			$redirect=urldecode(urldecode( $request['redirect'] )); if( $redirect=="" ) $redirect="/ad_deleted.html";
			header( "Location: $redirect" );
		}
		else
		{
			$tmpl=new ReklamaUA( "templates/", "$LANG/" );
			
			if( !$tmpl->is_cached("ads/_delete.tpl",(isUserLogged()?$_SESSION["user"]:"").getRequest(array())) )
			{
				$tmpl->assignMainMenu( );
			}
			$tmpl->display( "ads/_delete.tpl", (isUserLogged()?$_SESSION["user"]:"").getRequest(array()));	
		}
	}
	
///////////////////////////////////////////////////////////////	
///////////////////////////////////////////////////////////////	
///////////////////////////////////////////////////////////////	
	private function encodeComm( &$array )
	{
		$ret="";
		foreach( $array as $key=>$value )
		{
			if( $ret!="" ) $ret.="&";
			$ret.="comm[$key]=$value";
		}
		return "$ret";

	}


	function postSave( &$request )
	{
		global $SETTINGS;
		
		if( $this->AnnEditType=="new" )
			header( "Location: /submit.html?adv=$this->myCurRowId&uuid=$this->myUUID&type=new" );
		else
			header( "Location: /show-$this->myCurRowId.html?uuid=$this->myUUID&type=$this->AnnEditType" );
	}

	function postDelete( &$request )
	{
		//header( "Location: index.php" );
	}

	
///////////////////////////////////////////////////////////////	
///////////////////////////////////////////////////////////////	
///////////////////////////////////////////////////////////////	

	
	function getProductData( &$request,$id=null,$isedit=false )
	{
		global $langdata;
		
		if( $this->myTableName=="" ) return;
		global $LANG;
		$this->mySingleProduct=$id;
//$this->myDB->debug=true;
//		if( $id===null )
//		{
//			$subcat=$request['subcat'];
//			if( $subcat===null || $subcat=="" ) 
//			{
//				if( sizeof($this->myParent->ChildMap)>0 )
//				{
//					foreach( $this->myParent->ChildMap as $val )
//					{
//						$subcat=$val->myInfo['cat_id'];
//						$this->myCatId=$subcat;
//						$this->myColumns['cat_id']->myValue=$subcat;
//						$this->myTableName=$val->myInfo['type_data'];
//						break;
//					}
//					$request['subcat']=$subcat;
//				}
//				else
//					$subcat=$this->myCatId;
//			}
//			else
//			{
//				$this->myCatId=$subcat;
//				$this->myColumns['cat_id']->myValue=$subcat;
//			    foreach( $this->myParent->ChildMap as $val )
//			    {
//					if( $val->myInfo['cat_id']==$subcat )
//					{
//					    $this->myTableName=$val->myInfo['type_data'];
//					    break;
//					}
//			    }
//			}
//		}
		
		$sql_begin="SELECT t.*,d.*";//,reg.*";
		$sql= " FROM ann_$this->myTableName t JOIN (SELECT * FROM data d LEFT JOIN users u ON d.user_id=u.user_id) d ON d.id=t.id ".
//					" JOIN (SELECT reg_id,reg_name as reg_name_id,t_text as reg_name,t_lang_id as lang 
//							FROM regions JOIN texts ON reg_name=t_id ) reg ON reg.reg_id=d.reg_id ".
			  " WHERE ";
		if( !isset($id) )
			$sql.="cat_id='$this->myCatId' ";
		else 
			$sql.="d.id='$id' ";
		
		if( isset($request["withphoto"]) )
			$sql.=" AND (brief_photo IS NOT NULL AND brief_photo!='') ";
//		$sql.=" AND lang='$LANG' ";
		if( isset($this->myRegion) && !isset($id) )
			$sql.=" AND d.reg_tree ~ '*.$this->myRegion.*' ";
		if( !isset($id) ) 
		{
			$count=$this->myDB->GetOne( "SELECT count(*) $sql" );
			$offset=$this->getCurPage( $request,$count );
		}
		$sort_temp=$_REQUEST['sort'];
		$sort=NULL;
		foreach( $this->mySortColumns as $k ) { if( $k==$sort_temp ) { $sort=$k; break;} }
		if( isset($sort) && $sort!="" )
		{
			$sortColumn=$this->myColumns[$sort];
			$sql.=" ORDER BY comm_up DESC,".$sortColumn->getSortName();
			if( isset($_REQUEST['desc']) ) $sql.=" DESC";
		}
		else
			$sql.=" ORDER BY comm_up DESC,publ_begin DESC";
		//if( isset($this->myLang) ) $sql.=" AND $this->myLang='$LANG'";
		
		if( !isset($id) )
		{
			$res=$this->myDB->SelectLimit( $sql_begin.$sql,$this->myElementsPerPage,$offset*$this->myElementsPerPage );
			$this->myData=&$res->GetRows( );
		}
		else 
		{
			$this->myData=$this->myDB->GetRow( $sql_begin.$sql );
			
			if( !$isedit )
			{
				// For advertisment from registered users we have additional information
				$this->addColumns( array(
						"u_phone2"=>new PhoneColumn( "u_phone2",$langdata['cat_phone_num'],$langdata['cat_phone_num_msg'],$langdata['cat_phone_num_brief'],false,$langdata['tooltip_phone_code'],$langdata['tooltip_phone_num']),
						"u_phone3"=>new PhoneColumn( "u_phone3",$langdata['cat_phone_num'],$langdata['cat_phone_num_msg'],$langdata['cat_phone_num_brief'],false,$langdata['tooltip_phone_code'],$langdata['tooltip_phone_num']),
						"u_phone4"=>new PhoneColumn( "u_phone4",$langdata['cat_phone_num'],$langdata['cat_phone_num_msg'],$langdata['cat_phone_num_brief'],false,$langdata['tooltip_phone_code'],$langdata['tooltip_phone_num']),
					) );
				$this->myPostCols=array_merge( $this->myPostCols, array(
						"u_phone2","u_phone3","u_phone4",
					) );
			}
		}

		if( $id!==null && !isAdmin() && !(isUserLogged() && $this->myData['user_id']==$_SESSION['user'] ) )
		{
			$this->myDB->Execute( "UPDATE data SET show_count=show_count+1 where id='$id'" );
		}
		
//		print_r( $this->myData );
//		die;
	}

	function getProductDataBrief( $ids ) //Favourites
	{
//		$this->myDB->debug=true;
		global $LANG;

		$sql_begin="SELECT d.*,reg.*,vc.*";
		$sql= " FROM (SELECT * FROM data d LEFT JOIN users u ON d.user_id=u.user_id) d ".
					" JOIN (SELECT reg_id,reg_name as reg_name_id,t_text as reg_name,t_lang_id as lang 
							FROM regions JOIN texts ON reg_name=t_id ) reg ON reg.reg_id=d.reg_id ".
					" JOIN v_catalog vc ON vc.cat_id=d.cat_id and reg.lang=vc.lang ".
			  " WHERE reg.lang='$LANG' ";
		if( isset($this->myRegion) )
			$sql.=" AND d.reg_tree ~ '*.$this->myRegion.*' ";

		$www="";
		for( $j=0; $j<sizeof($ids); $j++ )
		{
			if( $j>0 ) $www.=",";
			$www.=$ids[$j];
		}
		if( $www!="" ) 
			$sql.=" AND d.id IN ($www) ";
		else
			$sql.=" AND d.id=-1 ";
			
		$count=$this->myDB->GetOne( "SELECT count(*) $sql" );
		$offset=$this->getCurPage( $_REQUEST,$count );
	
		$sort_temp=$_REQUEST['sort'];
		$sort=NULL;
		foreach( $this->mySortColumns as $k ) { if( $k==$sort_temp ) { $sort=$k; break;} }
		if( isset($sort) && $sort!="" )
		{
			$sortColumn=$this->myColumns[$sort];
			$sql.=" ORDER BY vc.cat_order,vc.cat_name,comm_up DESC,".$sortColumn->getSortName();
			if( isset($_REQUEST['desc']) ) $sql.=" DESC";
		}
		else
			$sql.=" ORDER BY comm_up DESC,publ_begin DESC";

		$res=$this->myDB->SelectLimit( $sql_begin.$sql,$this->myElementsPerPage,$offset*$this->myElementsPerPage );
		$this->myData=&$res->GetRows( );
	}

	function getProductDataSearch( &$request )
	{
//		$this->myDB->debug=true;
		global $LANG;
		$i=0;
		
		if( $request["search"]!="" )
		{
			$sWords=" AND search_vec @@ q ";
			$sWordVec=" plainto_tsquery('russian','".$request["search"]."') q, ";
			$brshow=" ts_headline('russian',brief$LANG,q,'StartSel=<b>,StopSel=</b>,HighlightAll=true') as brief$LANG ";
		}
		else 
			$brshow=" d.brief ";

		$sDate="";
		switch( $request['date'] )
		{
			case "today":
				$sDate=" publ_begin > NOW() - interval '1 day' ";
				break;
			case "week":
				$sDate=" publ_begin > NOW() - interval '1 week' ";
				break;
			case "month":
				$sDate=" publ_begin > NOW() - interval '1 month' ";
				break;
		}
		if( $sDate!="" ) $sDate=" AND $sDate ";

		if( $request["reg_id"]!="" ) $sRegId=" AND reg_tree ~ '*.$request[reg_id].*' ";
		if( $request["cat_id"]!="" ) $sCatId=" AND cat_tree ~ '*.$request[cat_id].*' ";
		if( $request["user"]!=""   ) 
		{
			$sUser =" AND user_id='$request[user]' ";
		}
		
		$sPhone="";
		if( $request['phone_num']!="" )
		{
			$user_phone=str_replace( array("-"," "), array("",""), $request['phone_num'] );
			$sPhone.=" AND ".$this->myDB->Concat("'8'","phone_code","phone_num")." LIKE '%$user_phone%' ";
		}
//		if( $request['phone_code']!="" )
//			$sPhone.=" AND phone_code='".$request['phone_code']."' ";
			
		if( $request["ip"]!="" ) $sIP=" AND from_ip='$request[ip]'::inet ";
		if( isset($request["withphoto"]) ) $sPhoto.=" AND (brief_photo IS NOT NULL AND brief_photo!='') ";
		if( $request["email"]!="" ) $sEmail=" AND email_copy='$request[email]' ";
		if( $request["uuid"]!="" )  $sUUID =" AND long_id='$request[uuid]' ";

		$sql_begin="SELECT 
				*,$brshow ";
		$sql= " FROM $sWordVec (SELECT * FROM data WHERE 1=1 $sDate  $sPhone $sUser $sIP $sPhoto $sEmail $sUUID) d  ".
					" LEFT JOIN users u ON u.user_id=d.user_id ".
			  " WHERE 1=1 $sWords $sRegId $sCatId ";

		$count=$this->myDB->GetOne( "SELECT count(*) $sql" );
		$offset=$this->getCurPage( $request,$count );
		
		$sort_temp=$_REQUEST['sort'];
		$sort=NULL;
		foreach( $this->mySortColumns as $k ) { if( $k==$sort_temp ) { $sort=$k; break;} }
		if( isset($sort) && $sort!="" )
		{
			$sortColumn=$this->myColumns[$sort];
			$sql.=" ORDER BY comm_up DESC,".$sortColumn->getSortName();
			if( isset($_REQUEST['desc']) ) $sql.=" DESC";
		}
		else
			$sql.=" ORDER BY comm_up DESC,publ_begin DESC";

		$res=$this->myDB->SelectLimit( $sql_begin.$sql,$this->myElementsPerPage,$offset*$this->myElementsPerPage );
		$this->myData=&$res->GetRows( );
		
		if( $request['user']!="" && (isAdmin() || $_SESSION['user']==$request['user']) )
		{
			$info=$this->myDB->GetRow( "SELECT * FROM users WHERE user_id='$request[user]' " );
			
			$this->myAdvCount=$info['u_adv_count'];
			$this->myAdvCountCur=$info['u_adv_count_cur'];
		}

	}

	function showBrief( &$row,$rebuild=false,$search=false )
	{
		global $LANG;
		$ret="";
		
		if( $rebuild )
		{
			$prevgroup=-1;
			$current="";
			
			foreach( $this->myColumns as &$col )
			{
				if( $col->myIsBrief>0 &&!isset($this->myPictureColumns[$col->myName]) )
				{
					if( $col->myIsBrief!=$prevgroup )
					{
						if( $current!="" && !$search ) $current.="</div>";
						$ret.=$current; 
						$current="";
					}
					
					$vvv=(!$search)?$col->myBriefMsg.($col->myBriefMsg!=""?":&nbsp;":""):"";
					$vvv.=$col->extractPreviewValue( $row );
					if( $current=="" && !$search )
						$current="<div class=\"smallannatributes\">";
					else if( $vvv!="" && !$search )
						$current.="&nbsp;| ";
					else if( $search ) $current.=" ";
					
					$current.=$vvv;
					$prevgroup=$col->myIsBrief;
				}
			}
			if( $current!="" && !$search ) $current.="</div>";
			$ret.=$current; 
		}
		else
			$ret=$row["brief$LANG"];
		return $ret;
	}
	
	function showTopBrief( &$row )
	{
		global $LANG;
		$ret="";
		foreach( $this->myTopBriefCols as $colname )
		{
			$col=&$this->myColumns[$colname];
			if( $col->myGenType=="photo" ) continue;
			
			if( $col->mySpecType=="adtext" )
				$val=preg_replace( array("/\n/"),array(" "), $col->extractOnlyValue( $row ) );
			else if( $col->mySpecType=="region" )
				$val=$col->extractOnlyValue( $row,3 );
			else
				$val=$col->extractPreviewValue( $row );

			if( $val=="" ) continue;
			
			if( $col->mySpecType!="adtext" && $col->myIsBriefInTop )
				$ret.=$col->myBriefMsg.($col->myBriefMsg!=""?": ":"");
			
			$ret.=strip_tags( preg_replace(array("/&nbsp;/","/<<<\/div>/"),array(" ","\n"),$val) )."\n";
		}
		return $ret;
	}

	function getExtraBrief( &$row )
	{
		$ret="";
		
		foreach( $this->myExtraBriefCols as $colkey )
		{
			if( $this->myColumns[$colkey]->myGenType=="separator" ) continue;
			$add=chop( $this->myColumns[$colkey]->extractPreviewValue( $row ) );
			if( $add=="" ) continue;
			
			if( $this->myColumns[$colkey]->myBriefMsg!="" )
				$add=$this->myColumns[$colkey]->myBriefMsg.":&nbsp;".$add;
			
			if( $ret!="" ) $ret.=", ";
			$ret.=$add;
		}
		
		return $ret;
	}
	
	function getBriefColsHead( )
	{
		$ret="";
		foreach( $this->myBriefCols as $colkey )
		{
			if( isset($this->myPictureColumns[$colkey]) )
				$ret.="<td class='short_ann_img'>";
			else
				$ret.="<td class='ann_short_items'>";
			$ret.=$this->getSortHeaderLink( $colkey );
			$ret.="</td>\n";
		}
		return $ret;
	}
	
	function showBriefColsData( &$row )
	{
		$ret="";
		foreach( $this->myBriefCols as $colkey )
		{
			if( isset($this->myPictureColumns[$colkey]) )
			{
				$ret.="<td class='short_ann_img'>";//<a href='".$this->getShowRowHref($row)."' target='_blank'>";
				$ret.=$this->myColumns[$colkey]->extractBriefValue( $row );//."</a>";
			}
			else
			{
				$ret.="<td class='ann_short_items";
				if( $row['comm_bold']=='t' ) $ret.=" payed";
				$ret.="'>";
				$ret.="<a target='_blank' class=\"rr\" href='/show-$row[id].html'>";
				$ret.=$this->myColumns[$colkey]->extractBriefValue( $row );
				$ret.="</a>";
			}
			$ret.="</td>\n";
		}
		return $ret;
	}
	
	function getBriefColsCount( )
	{
		return sizeof( $this->myBriefCols );
	}

	function isImage( &$row,$rebuild=false )
	{
		if( $rebuild )
		{
			$ret=false;
			foreach( $this->myPictureColumns as $col )
			{
				$ret=$ret||$this->myColumns[$col]->isAnyImages( $row );//isset( $row[$col->myName] );
			}
		}
		else
			$ret=$row['brief_is_photo']=='t';
		return $ret;
	}
	
	function isImageForm( )
	{
		$ret=false;
		foreach( $this->myPictureColumns as $col )
		{
			$ret=$ret||$this->myColumns[$col]->isAnyImagesForm( $this->myData );
		}
		return $ret;
	}

	function getFirstImagePreview( &$row,$rebuild=false )
	{
		if( $rebuild )
		{
			foreach( $this->myPictureColumns as $col )
			{
				if( $this->myColumns[$col]->isAnyImages($row) )
				{
					return $this->myColumns[$col]->getFirstImagePreview( $row );
				}
			}
		}
		else
			$ret=$row['brief_photo'];
		return $ret;
	}
}

?>
