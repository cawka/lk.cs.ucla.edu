<?php

function smarty_function_getRegion( $params )
{
    $reg=$params['region'];
    $ret="";
    foreach( $reg as &$row )
    {
	if( $ret!="" ) $ret.=", ";
	$ret.=$row['reg_name'];
    }
    return $ret!=""?" ($ret)":"";
}

?>
