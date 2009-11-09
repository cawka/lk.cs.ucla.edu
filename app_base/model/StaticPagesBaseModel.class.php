<?php

class StaticPagesBaseModel extends TableModel 
{
	public function __construct( $php )
	{
		global $DB;
		parent::__construct( $DB,$php,"static_pages",array(
				"id"=>new TextIdColumn( "id","Page ID","Page ID is required" ),
				"sp_text"=>new TextAreaHTMLColumn("sp_text","Content",NULL,false,""," ckhtml"),
				"sp_title"=>new TextColumn("sp_title","Page title","Specify page title",false),
				"sp_meta"=>new TextAreaColumn( "sp_meta", "Meta information (keywords) <br/><small>for Google</small>" ),
				"sp_meta_descr"=>new TextAreaColumn( "sp_meta_descr", "Meta information (description) <br/><small>for Google</small>" ),
			),"id" );
		$this->myOrder="id";

//		$this->mySearchColumns=array(
//			array( "column"=>new TextColumn("id","ID"), "type"=>"like"),
//			array( "column"=>new TextColumn("sp_text","Content"), "type"=>"like"),
//		);
	}

	public function validateSave( &$request )
	{
		if( isset($request['id']) && $request['id']!=$request['new_id'] )
		{
			$ret=$this->myDB->GetOne( "SELECT id FROM $this->myTableName WHERE id=".$this->myDB->qstr($request['new_id']) );
			if( $ret ) return "Page ID should be unique";
		}
		return parent::validateSave( $request );
	}
}

?>
