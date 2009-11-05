<?php
if(!defined("BASEDIR") )   define( "BASEDIR", substr(dirname(__FILE__), 0, -4) );
if(!defined("SMARTY_DIR")) define( "SMARTY_DIR", BASEDIR . "/class/Smarty/" );
if(!defined("TEMPDIR"))    define( "TEMPDIR", BASEDIR . "/tmp/" );

include_once( BASEDIR . "/inc/config.php" );
include_once( BASEDIR . "/class/adodb/adodb-exceptions.inc.php");
include_once( BASEDIR . "/class/adodb/adodb.inc.php" );
#include_once( BASEDIR . "/class/adodb/session/adodb-session2.php");
include_once( BASEDIR . "/class/APC.class.php" );
include_once( BASEDIR . "/class/MySmarty.class.php" );

global $dbengine, $dbuser, $dbpasswd, $dbhost, $dbschema;
$connectURI="$dbengine://$dbuser:$dbpasswd@$dbhost/$dbschema";
$DB=&NewADOConnection( $connectURI );
#ADOdb_Session::config( $dbengine, $dbhost, $dbuser, $dbpasswd, $dbschema, false );
$DB->Execute( "SET NAMES utf8" ); 

$theAPC=new APC( false, 300 );

$SETTINGS=$theAPC->fetch( "SETTINGS" );
if( !$SETTINGS )
{
	$SETTINGS=$DB->GetAssoc( "SELECT set_name,set_value FROM settings" );
	$theAPC->cache( "SETTINGS", $SETTINGS );
}

session_start( );

?>

