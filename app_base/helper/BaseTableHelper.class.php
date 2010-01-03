<?php

class BaseTableHelper 
{
	public function closeWindow( )
	{
		print "<script>window.opener.parent.location.reload(); window.close();</script>";
	}	
	
	public function form_action( &$model, $action, $validate,$params=array(),&$options )
	{
		global $GLOBAL_PREFIX;

		$ret="<form action='$GLOBAL_PREFIX$model->myPhp/$action' ";// tmt:validate='$validate'";
		foreach( $options as $key=>$value )
		{
			$ret.=" $key='$value'";
		}
		$ret.=">";

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
		global $GLOBAL_PREFIX;

		$ret="";
		$url="$GLOBAL_PREFIX$model->myPhp/$action";
		$query=http_build_query( $params,'', '&amp;' );
		if( $query!="" ) $url.="?$query";
		
		$ret.="<a href=\"javascript:;\" onclick=\"window.open('$url',".
				"'_blank','scrollbars=1,toolbar=0,resizable=1')\" >$name</a>";
		return $ret;
	}

	public function link_popup_confirm( &$model, $action, $name, &$params, $confirm_text, $method="get" )
	{
		global $GLOBAL_PREFIX;

		$ret="";
		$url="$GLOBAL_PREFIX$model->myPhp/$action";
		$query=http_build_query( $params,'', '&amp;' );
		if( $query!="" ) $url.="?$query";
		
		$ret.="<a href=\"javascript:;\" onclick=\"if( confirm('$confirm_text') ) window.open('$url',".
				"'_blank','scrollbars=1,toolbar=0,resizable=1')\" >$name</a>";
		return $ret;
	}
	
	public function img_button( $button, $name )
	{
		global $GLOBAL_PREFIX;

		return "<img style='margin:0;padding:0;display:inline' height='12px' src='$GLOBAL_PREFIX"."images/admin/$button.gif' alt='$name' onmouseover=\"Tip('$name')\" />";
	}
}

?>
