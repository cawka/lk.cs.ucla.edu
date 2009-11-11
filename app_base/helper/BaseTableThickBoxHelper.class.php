<?php

class BaseTableThickBoxHelper extends BaseTableHelper 
{
	public function form_action( &$model, $action, $validate,$params=array(),&$options )
	{
		if( isset($_REQUEST['ajax']) ) $params['ajax']=true;
		
		return parent::form_action( $model,$action,$validate,$params,$options );
	}	
	
	public function link_popup( &$model, $action, $name, $title, &$params, $method="get" )
	{
		$ret="";
		$url="/$model->myPhp/$action";
		
		$params=array_merge( $params, array(
//				"ajax"=>"true",
//				"KeepThis"=>"true",
//				"TB_iframe"=>"true",
//				"percent"=>"true",
//				"height"=>"90",
//				"width"=>"90",
			) );
		$query=http_build_query( $params,'', '&amp;' );
		if( $query!="" ) $url.="?$query";
		
		$ret.="<a class=\"smoothbox\" href=\"$url\" name='$title' >$name</a>";
		return $ret;
	}

	public function link_popup_confirm( &$model, $action, $name, &$params, $confirm_text, $method="get" )
	{
		$url=http_build_query( $params,'', '&amp;' );
		
		$ret="<a href=\"javascript:;\" onclick=\"if( confirm('$confirm_text') ) del('/$model->myPhp/$action','$url','$model->myParentId')\" >$name</a>";
		return $ret;
	}
}

?>
