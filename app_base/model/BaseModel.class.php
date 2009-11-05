<?php

class BaseModel
{
	/**
	 * Переменная для связи с базой данных
	 *
	 * @var ADOConnection
	 */
	public $myPhp;

	protected $myLang;

	/**
	 * ffddf
	 *
	 * @var BaseColumn[]
	 */
	public $myColumns=array();
	public $myData;
	
	/**
	 * Helper
	 *
	 * @var BaseTableHelper
	 */
	public $myHelper;
	
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
	public function __construct( $php )
	{
		$this->myPhp=$php;
	}
	
	public function addColumns( $columns )
	{
		$this->myColumns=array_merge( $this->myColumns, $columns );
	}
	
	public function collectData( &$request )
	{
		//no data to collect
		$this->myData=array();		
	}
	
	public function getRowToEdit( &$request )
	{
		$this->myData=$request;
	}

	public function getRowToShow( &$request )
	{
		$this->myData=$request;
	}
	
	public function showBrief( &$row )
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
	
	public function validateSave( &$request )
	{
		$error="";
		foreach( $this->myColumns as $col )
		{
			if( $col->myIsReadonly ) continue;
			$ret=$col->checkBeforeSave( $request );
			if( !$ret ) { if( $error!="" ) $error.="<br/>"; $error.=$col->myError; }
		}

		return $error;
	}
	
	protected function getAdditionalParameters( &$params ) 
	{ 
		if( $this->myUrlAddonValue!="" ) $params[$this->myUrlAddon]=$this->myUrlAddonValue;
		return $params;
	}
//	protected function getAdditionalParametersAfterDelete( &$request ) { array(); }

	protected function getColumnParams( $params=array() )
	{
		foreach( $this->myColumns as $col )
		{
			if( !$col->myIsVisible && !isset($col->myIsProtected) ) 
				$params[$col->myName]=$col->getValue( $this );
		}
		$params=$this->getAdditionalParameters( $params );
		return $params;
	}
	
	public function getFormCtrl( &$row,$action,$validate,&$options )
	{	
//		if( !$this->myHelper->allowChanges() ) return "";
		
		return $this->myHelper->form_action( $this,$action,$validate,$this->getColumnParams(),$options );
	}
	
	public function getQuery( )
	{
		$ret=urldecode( $_REQUEST['_p'] );
		$ret2=http_build_query( $this->getColumnParams(),NULL,"&" );
		if( $ret!="" && $ret2!="" ) $ret.="&";
		return $ret.$ret2;
//		return http_build_query( $this->getColumnParams(),NULL,"&" );
	}
	
	function extractParentId( &$row )
	{
		return "";
	}	
}

?>