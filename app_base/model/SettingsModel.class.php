<?php

class SettingsModel extends TableModel 
{
	public function __construct( $php )
	{
		global $DB;
		parent::__construct( $DB,$php,"settings",array(
				"set_name"=>new TextColumn("set_name","Option ID","Please specify identificator"),
				"set_value"=>new TextColumn("set_value","Option value"),
			),"set_id"
		);
		$this->myOrder="set_name";
	}
}

?>
