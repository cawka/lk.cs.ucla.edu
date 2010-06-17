<?php

class VideosController extends TableController 
{
	public function __construct( &$model,&$helper )
	{
		parent::__construct( $model,$helper,
			"common/video_items.tpl","","common/form.tpl"
		);
	}

    protected function cacheId( &$request )
    {
        $add="";
        if( isset($request['ajax']) ) $add="(ajax)";
        return "index|".$request['page']."$add";
    }
}

