<?php
include_once( "../inc/init.php" );
include_once( BASEDIR . "/app_base/helper/RequestAction.class.php" );

function __autoload( $classname )
{
	preg_match( "/^(.+)(column|model|controller|helper)$/i",$classname,$matches );
	$prefix=BASEDIR . "/app/" . strtolower($matches[2]);
	$prefix2=BASEDIR . "/app_base/". strtolower($matches[2]);

	if( is_file("$prefix/$classname.class.php") )
	    include_once( "$prefix/$classname.class.php" );
	else if( is_file("$prefix2/$classname.class.php") )
	    include_once( "$prefix2/$classname.class.php" );
}

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
	print "No controller [$controller] found";
	exit( 1 );
}



new RequestAction( 
	$module,
	new $controller(
		new $model( $module ),
		new $helper()
	)
);

?>
