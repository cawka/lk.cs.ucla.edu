<?php

/**
 * Класс обработчика событий пользователя
 *
 */
class RequestAction
{
	/**
	 * Класс, реализующий функциональность
	 *
	 * @var BaseTable
	 */
	var $myClass;
	var $myTemplate;
	
	/**
	 * Authentification and Authorization Helper
	 *
	 * @var AuthHelper
	 */
	var $myAuth;
	
	function RequestAction( $controller,&$class, $nodelay=true )
	{
		global $DB,$LANG,$Auth,$SETTINGS;
		$this->myTemplate=&new MySmarty( BASEDIR."/app/view/$SETTINGS[theme]/", $LANG );
		
		$Auth=new AuthHelper( $controller );
		$this->myAuth=&$Auth;
		
		$this->myTemplate->assign_by_ref( "Auth", $this->myAuth );

		if( $_REQUEST['action']=='' ) $_REQUEST['action']='index';
		if( $nodelay ) $this->parseInput( $class );
	}
	
	function parseInput( &$class )
	{
		$this->myTemplate->assign_by_ref( "helper", $class->myHelper );
		
		if( isIn($_REQUEST['action'],get_class_methods($class)) ) 
		{
			$this->myAuth->allowOrRedirect( $_REQUEST['action'] );
			
			call_user_method_array( $_REQUEST['action'],$class,
									array(&$this->myTemplate,&$_REQUEST) );
		}
		else
			return $this->actionUndefined( );
	}
	
	function actionUndefined( )
	{
		$t=new ErrorHelper();
		$t->get404( );
//		$this->myTemplate->assign( "error", "action '$_REQUEST[action]' undefined" );
//		$this->myTemplate->display( "common/error.tpl" );
	}
}

?>
