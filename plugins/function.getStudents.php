<?php

function smarty_function_getStudents( $params,&$smarty )
{
  global $DB, $LANG;

  $new_smarty = new MySmarty( );

  $controller=
    new StudentsController(
                           new StudentsModel("students"),
                           new BaseTableThickBoxHelper()
                           );
  $controller->myAuth = new AuthHelper("students");
  $controller->myModel->myAuth = $controller->myAuth;
  $controller->myUseSmartyFetch=true;
  $new_smarty->assign( "Auth", $controller->myAuth );

  $smarty->caching=false;
  return $controller->index( $smarty, $params );
}
