<?php

class StudentsController extends TableController 
{
	public function __construct( &$model,&$helper )
	{
		parent::__construct( $model,$helper,
			"common/students.tpl","","common/form.tpl"
		);
	}
}

