<?php

$dbengine="mysql";
$dbuser  ="cawka";
$dbpasswd="9.2#57@c6X3z";
$dbhost  ="localhost";
$dbschema="cawka";

$MY_MAX_PHOTO_SIZE=3000000;

$CACHE_SERVERS=array(
//	array( "host"=>"127.0.0.1", "port"=>"11211", "weight"=>100 ),
);


$SETTINGS=array(
	"theme" => "moderna",
	"index" => "index.html",
);

#Allowed access for anonymous users (logged users have full access to all components)
$AUTH=array(
	"staticPages"  => array( "show"=>1 ),
	"publications" => array( "index"=>1, "show"=>1 ),
	"login"        => array( "index"=>1, "login"=>1, "logout"=>1 ),
	"index"        => array( "index"=>1 ),
	"bibwiki"      => array( "index"=>1, "bibtex"=>1 ),
);

$GLOBAL_PREFIX="/~cawka/cawka/";
$GLOBAL_PREFIX_FS="/home/cawka/www/cawka/";

date_default_timezone_set( "Europe/Riga" );
?>
