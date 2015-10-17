<?php

$CMS_PATH="CMS/"; //relative to BASEDIR
$PREFIX="/"; //prefix in URL path

$dbengine="mysql";
$dbuser  ="lk";
$dbpasswd="=ra8rav9jasW";
$dbhost  ="localhost";
$dbschema="lk";

$SETTINGS=array(
	"index" => "index.html",
	"user.email" => "cawka1@gmail.com",
	"user.name" => "Alexander Afanasyev",
	"user.first_name" => "Alexander",
);

$RIGHTS=array(
	// PUBLIC
	NULL=>array(
		"staticPages"  => array( "show"=>1 ),
		"login"        => array( "index"=>1, "login"=>1, "logout"=>1 ),
		"index"        => array( "index"=>1 ),
		"publications" => array( "index"=>1, "show"=>1 ),
		"bibwiki"      => array( "index"=>1, "bibtex"=>1 ),
		"videos"	   => array( "index"=>1 ),
	)
);

$CACHE_SERVERS=array(/*array( "host"=>"127.0.0.1", "port"=>"11211", "weight"=>100 ),*/);
date_default_timezone_set( "America/Los_Angeles" );

/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////

if( !defined("BASEDIR") )   define( "BASEDIR", dirname(__FILE__) );
if( !defined("TEMPDIR") )   define( "TEMPDIR", BASEDIR . "/.tmp/" );
if( !defined("CMSDIR") )    define( "CMSDIR",  BASEDIR . "/".$CMS_PATH );

$GLOBAL_PREFIX_FS=BASEDIR . "/www/";
$GLOBAL_PREFIX="/";

set_include_path( BASEDIR . PATH_SEPARATOR . 
				  BASEDIR . "/".$CMS_PATH . PATH_SEPARATOR . 
				  get_include_path() );

require_once( "CMS.init.php" );

$connectURI="$dbengine://$dbuser:$dbpasswd@$dbhost/$dbschema";
$DB=&NewADOConnection( $connectURI );
$DB->Execute( "SET NAMES utf8" ); // may be necessary for MySQL database 


