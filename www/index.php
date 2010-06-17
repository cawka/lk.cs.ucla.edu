<?php

include_once( "../_config.php" );
include_once( "helper/RequestAction.class.php" );

$module=isset($_REQUEST['_m'])?$_REQUEST['_m']:'index';

new PermissionsHelper();
new NavHelper();

if( isAdmin() )
{
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', '1');
	//$DB->debug=true;
}
//$DB->debug=true;

$controller=str_replace( " ", "", ucwords("$module controller") );
$model=str_replace( " ", "", ucwords("$module model") );
$helper=str_replace( " ", "", ucwords("$module helper") );

if( !class_exists($helper) )     $helper    ="BaseTableThickBoxHelper";
if( !class_exists($model) )      $model     ="BaseModel";

if( !class_exists($controller) ) 
{
	$t=new ErrorHelper( );
	$t->get404( );
	exit;
}


new RequestAction( 
	$module,
	new $controller(
		new $model( $module ),
		new $helper()
	)
);

