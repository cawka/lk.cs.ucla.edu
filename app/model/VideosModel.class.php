<?php

class VideosModel extends TableModel
{
	public $myTitle="";
	
	public function	 __construct( $php )
	{
		global $DB,$langdata;

		parent::__construct( $DB,$php, "videos", array(
			new HiddenColumn( "page", $_REQUEST['page'] ),
			new TextColumn( "title", "Title" ),
			new TextAreaColumn( "description", "Description" ),
			new FileColumn( "video", "Video" ),
			) );
		$this->myOrder="";

		$this->RefreshByReload=true;
//		$this->myElementsPerPage=30;
		
//		$this->mySortColumns=array( 
//			"login"=>array("asc"=>"u_login","desc"=>"u_login DESC"),
//		);
		
//		$this->mySearchColumns=array(
//			array( "column"=>new TextColumn("u_login","Логин содержит"),"type"=>"like" ),
//		);
	}


    public function collectData( &$request )
    {
        $this->myStatic=new StaticPagesModel( "staticPages" );
        $this->myStatic->myHelper=$this->myHelper;
        $req=array( "id"=>"videos-".$request['page'] );
        $this->myStatic->getRowToShow( $req );

        parent::collectData( $request );
    }
}

