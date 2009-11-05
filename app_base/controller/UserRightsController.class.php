<?php

class UserRightsController extends TableController 
{
	public function __construct( &$model,&$helper )
	{
		parent::__construct( $model,$helper,
			"users/rights.tpl","",""
		);
	}
	
	public function edit( &$tmpl, &$request ) 
	{
		return $this->index( $tmpl, $request );
	}
}

?>
