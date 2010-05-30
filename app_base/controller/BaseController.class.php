<?php

class BaseController
{
	/**
	 * Model
	 *
	 * @var BaseModel
	 */
	protected $myModel;
	
	/**
	 * Use 'fetch' SMARTY method to build page
	 *
	 * @var bool
	 */
	public $myUseSmartyFetch=false;
	
	public  $myHelper;
	
////////////////////////////////////////////////////////////////////////////////////////
// public:

	public function __construct( &$model,&$helper )
	{
		$this->myModel=$model;
		$this->myHelper=$helper;
		$this->myModel->myHelper=$helper;
	}
	
////////////////////////////////////////////////////////////////////////////////////////
// protected:
	
	protected function cacheId( &$request )
	{
		return ""; //getRequest(array()); !!! Controller should provide its own ID, otherwise no ID will be used
	}
	
	protected function showTemplate( &$tmpl, &$request, $template, $model_method, $cache=true )
	{
		if( !is_file($tmpl->template_dir."/".$template) ) 
		{
			$tmpl->assign( "error", "Template [$template] not found" );
			$template="common/error.tpl";
			$tmpl->clear_cache( $template,$this->cacheId($request) );
		}
		
		if( !$cache ) { $tmpl->clear_cache( $template,$this->cacheId($request) ); }

		if( !$tmpl->is_cached($template,$this->cacheId($request)) )
		{
			if( $model_method!="" ) call_user_method( $model_method, $this->myModel, $request );
			$tmpl->assign_by_ref( "this", $this->myModel );
			
			if( isset($request['error']) ) $tmpl->assign( "error", $request['error'] );
		}
		
		if( !$this->myUseSmartyFetch )
			$tmpl->display( $template, $this->cacheId($request) );		
		else 
			return $tmpl->fetch( $template, $this->cacheId($request) );	
	}
	
	protected function showTemplateDB( $tmpl, &$request, $static_page_id, $model_method, $cache=true )
	{
		global $LANG, $DB;
		if( !$cache ) $tmpl->caching=false;
		
		$template="common/base_static.tpl";
		
		if( !is_file($tmpl->template_dir."/".$template) ) 
		{
			$tmpl->assign( "error", "Template [$template] not found" );
			$template="common/error.tpl";
			$tmpl->clear_cache( $template,"($static_page_id)".$this->cacheId($request) );
		}
		
		if( !$cache ) { $tmpl->clear_cache( $template,"($static_page_id)".$this->cacheId($request) ); }
		if( !$tmpl->is_cached($template,"($static_page_id)".$this->cacheId( $request )) )
		{
			if( $model_method!="" ) call_user_method( $model_method, $this->myModel, $request );

			///////////////////////////////////////////////
			$tmp=new StaticPagesController( new StaticPagesModel( "staticPages" ), new BaseTableThickBoxHelper( ) );
			$this->myModel->myStaticPage=$tmp->myModel;

			$params=array( "id"=>$static_page_id );
			$this->myModel->myStaticPage->getRowToShow( $params );
			///////////////////////////////////////////////
			
			$tmpl->assign_by_ref( "this", $this->myModel );
			
			if( isset($request['error']) ) $tmpl->assign( "error", $request['error'] );
		}
		
		if( !$this->myUseSmartyFetch )
			$tmpl->display( $template, $this->cacheId($request) );		
		else 
			return $tmpl->fetch( $template, $this->cacheId($request) );	
	}
	
	protected function postSave( &$tmpl,&$request ) 
	{ 
		if( !isset($request['ajax']) )
			$this->myHelper->closeWindow( ); 
		else 
		{
			$this->showTemplate( $tmpl,$request,"common/smoothbox_close.tpl","" );
			//$this->index( &$tmpl,&$request );
		}
	}
	
	protected function postDelete( &$tmpl,&$request ) 
	{
		if( !isset($request['ajax']) )
			$this->myHelper->closeWindow( ); 
		else 
			$this->index( $tmpl,$request );
	}
}

?>
