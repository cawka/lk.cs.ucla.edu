<?php

class SettingsController extends TableController 
{
	public function __construct( &$model, &$helper )
	{
		parent::__construct( $model,$helper,
			"admin/settings.tpl","","common/form.tpl"
		);
	}
}

?>
