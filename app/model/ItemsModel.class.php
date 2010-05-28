<?php

class NewsModel extends TableModel
{
	public $myTitle="";
	
	public function	 __construct( $php )
	{
		global $DB,$langdata;
		
		parent::__construct( $DB,$php, "items", array(
			new HiddenColumn("type"),
			new TextColumn("title","Title"),
			new TextAreaColumn("descr","Description"),
			new TextColumn("link","Link (if available)"),
			new TextColumn("years","Years"),
			) );
		$this->myOrder="years DESC";
//		$this->myElementsPerPage=30;
		
//		$this->mySortColumns=array( 
//			"login"=>array("asc"=>"u_login","desc"=>"u_login DESC"),
//		);
		
//		$this->mySearchColumns=array(
//			array( "column"=>new TextColumn("u_login","Логин содержит"),"type"=>"like" ),
//		);
	}
}

