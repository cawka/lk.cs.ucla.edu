<?php
include_once( "../inc/init.php" );
include_once( BASEDIR . "/app_base/helper/RequestAction.class.php" );

//$DB->debug=true;
$module=$_REQUEST['_m'];
if( !isset($module) ) $module="index";

new PermissionsHelper();
new NavHelper();

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

?>
