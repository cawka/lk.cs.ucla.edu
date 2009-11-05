<?php
include_once( "../inc/init.php" );

//$DB->debug=true;

function __autoload( $classname )
{
	preg_match( "/^(.+)(column|model|controller|helper)$/i",$classname,$matches );
	$prefix=BASEDIR . "/../app/" . strtolower($matches[2]);
	if( strtolower($matches[2])=="column" ) $prefix=BASEDIR . "/../class/columns";
	
	if( !is_file("$prefix/$classname.class.php") )
	{
//		print "[$prefix/$classname.class.php]<br/>";
	}
	else
		include_once( "$prefix/$classname.class.php" );
}

$module=$_REQUEST['_m'];
if( !isset($module) ) $module="index";

$controller=str_replace( " ", "", ucwords("$module controller") );
$model=str_replace( " ", "", ucwords("$module model") );
$helper=str_replace( " ", "", ucwords("$module helper") );

//print "$controller/$model/$helper<br/>";

if( !class_exists($helper) )     $helper    ="BaseTableThickBoxHelper";
if( !class_exists($model) )      $model     ="BaseModel";

if( !class_exists($controller) ) 
{
//	$controller="BaseController";
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
