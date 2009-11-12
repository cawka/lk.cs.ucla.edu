<?php

class StaticPagesController extends TableController 
{
	public function __construct( &$model, &$helper )
	{
		parent::__construct( $model,$helper,"admin/staticpages_list.tpl",
											"common/static.tpl",
											"common/form.tpl" );
	}

	protected function cacheId( &$request )
	{
		$add="";
		if( isset($request['ajax']) ) $add="(ajax)";
		if( $request['action']=="show" ) return "(show)(".$request[$this->myModel->myId].")$add";
		return "(list)$add";
	}

//	public function save_edit( &$tmpl, &$request )
//	{
//			$tmpl->clear_all_cache( );
//			return parent::save_edit( $tmpl, $request );
//	}
//
//	public function save_add( &$tmpl, &$request )
//	{
//			$tmpl->clear_all_cache( );
//			return parent::save_add( $tmpl, $request );
//	}
}
