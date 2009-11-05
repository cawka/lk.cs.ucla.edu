<?php

class StaticPagesController extends TableController 
{
	public function __construct( &$model, &$helper )
	{
		parent::__construct( $model,$helper,"admin/staticpages_list.tpl",
											"common/static.tpl",
											"common/form.tpl" );
	}
}
