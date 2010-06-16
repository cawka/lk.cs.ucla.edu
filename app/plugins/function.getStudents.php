<?php

function smarty_function_getStudents( $params,&$smarty )
{
	global $DB, $LANG;

	$controller=
	new StudentsController(
		new StudentsModel("students"),
		new BaseTableThickBoxHelper()
	);
	$controller->myUseSmartyFetch=true;

	$smarty->caching=false;
	return $controller->index( $smarty, $params ); 
}

