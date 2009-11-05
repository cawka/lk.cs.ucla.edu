<?php

class BaseTableHelper 
{
	public function closeWindow( )
	{
		print "<script>window.opener.parent.location.reload(); window.close();</script>";
	}	
	
	public function form_action( &$model, $action, $validate,$params=array(),&$options )
	{
		if( $action!="" ) $params=array_merge( array("action"=>$action), $params );
		
		$ret="<form action='/1.php' tmt:validate='$validate'";
		foreach( $options as $key=>$value )
		{
			$ret.=" $key='$value'";
		}
		$ret.=">";

		$ret.="<input type='hidden' name='_m' value='$model->myPhp' />";
		foreach( $params as $key=>$value )
		{
			$ret.="<input type='hidden' name='$key' value='$value' />";
		}
		return $ret;
	}
	
	public function link( &$model, $action, $name, &$params )
	{
	}

	public function link_popup_post( &$model, $action, $name, &$params )
	{
	}
	
	public function link_popup( &$model, $action, $name, $title, &$params, $method="get" )
	{
		$ret="";
		$url="/1.php?_m=$model->myPhp";
		if( $action!="" ) $params=array_merge( array("action"=>$action), $params );
		$query=http_build_query( $params,'', '&amp;' );
		if( $query!="" ) $url.="&amp;$query";
		
		$ret.="<a href=\"javascript:;\" onclick=\"window.open('$url',".
				"'_blank','scrollbars=1,toolbar=0,resizable=1')\" >$name</a>";
		return $ret;
	}

	public function link_popup_confirm( &$model, $action, $name, &$params, $confirm_text, $method="get" )
	{
		$ret="";
		$url="/1.php?_m=$model->myPhp";
		if( $action!="" ) $params=array_merge( array("action"=>$action), $params );
		$query=http_build_query( $params,'', '&amp;' );
		if( $query!="" ) $url.="&amp;$query";
		
		$ret.="<a href=\"javascript:;\" onclick=\"if( confirm('$confirm_text') ) window.open('$url',".
				"'_blank','scrollbars=1,toolbar=0,resizable=1')\" >$name</a>";
		return $ret;
	}
	
	public function img_button( $button, $name )
	{
		return "<img style='margin:0;padding:0;display:inline' height='12px' src='/images/admin/$button.gif' alt='$name' onmouseover=\"Tip('$name')\" />";
	}
}

?>
