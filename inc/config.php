<?php

$dbengine="mysql";
$dbuser  ="lk";
$dbpasswd="=ra8rav9jasW";
$dbhost  ="localhost";
$dbschema="lk";

$SETTINGS=array(
	"theme" => "quot",
	"index" => "index.html",
	"user.email" => "cawka1@gmail.com",
	"user.name" => "Alexander Afanasyev",
	"user.first_name" => "Alexander",
);

#Allowed access for anonymous users (logged users have full access to all components)
$AUTH=array(
	"staticPages"  => array( "show"=>1 ),
	"publications" => array( "index"=>1, "show"=>1 ),
	"login"        => array( "index"=>1, "login"=>1, "logout"=>1 ),
	"index"        => array( "index"=>1 ),
	"bibwiki"      => array( "index"=>1, "bibtex"=>1 ),
	"videos"	   => array( "index"=>1 ),
);

$GLOBAL_PREFIX="/";
$GLOBAL_PREFIX_FS="/home/lk/site/www/";

$CACHE_SERVERS=array(/*array( "host"=>"127.0.0.1", "port"=>"11211", "weight"=>100 ),*/);
date_default_timezone_set( "Europe/Riga" );
?>
