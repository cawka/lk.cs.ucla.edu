<?php
if(!defined("BASEDIR") )   define( "BASEDIR", substr(dirname(__FILE__), 0, -4) );
if(!defined("SMARTY_DIR")) define( "SMARTY_DIR", BASEDIR . "/class/Smarty/" );
if(!defined("TEMPDIR"))    define( "TEMPDIR", BASEDIR . "/tmp/" );

include_once( BASEDIR . "/inc/config.php" );
include_once( BASEDIR . "/class/adodb/adodb-exceptions.inc.php");
include_once( BASEDIR . "/class/adodb/adodb.inc.php" );
include_once( BASEDIR . "/class/APC.class.php" );
include_once( BASEDIR . "/class/MySmarty.class.php" );

global $dbengine, $dbuser, $dbpasswd, $dbhost, $dbschema;
$connectURI="$dbengine://$dbuser:$dbpasswd@$dbhost/$dbschema";
$DB=&NewADOConnection( $connectURI );
#ADOdb_Session::config( $dbengine, $dbhost, $dbuser, $dbpasswd, $dbschema, false );
$DB->Execute( "SET NAMES utf8" ); 

$theAPC=new APC( false, 300 );

spl_autoload_register( "my_autoload" );

$COOKIES=new CookieHelper( "", 3600*24*365 );

session_start( );

new SearchKeywordEmailerHelper( );

function my_autoload( $classname )
{
	preg_match( "/^(.+)(column|model|controller|helper)$/i",$classname,$matches );
	$prefix=BASEDIR . "/app/" . strtolower($matches[2]);
	$prefix2=BASEDIR . "/app_base/". strtolower($matches[2]);

	if( is_file("$prefix/$classname.class.php") )
	    include_once( "$prefix/$classname.class.php" );
	else if( is_file("$prefix2/$classname.class.php") )
	    include_once( "$prefix2/$classname.class.php" );
}

?>
