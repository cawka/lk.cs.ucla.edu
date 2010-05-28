<?php

function smarty_function_getItems( $params,&$smarty )
{
	global $DB, $LANG;

	$controller=
	new ItemsController(
		new ItemsModel("items"),
		new BaseTableThickBoxHelper()
	);
	$controller->myUseSmartyFetch=true;

	$params=array( "type"=>"awards" );
	return "x".$controller->index( $smarty, $params )."y"; 
}

