<?php

class StudentsModel extends TableModel
{
	public $myTitle="";
	
	public function	 __construct( $php )
	{
		global $DB,$langdata;
		
		parent::__construct( $DB,$php, "students", array(
			new TextColumn("name",  "Name"),
			new TextColumn("title", "Current Affilation"),
			new TextColumn("disser","Dissertation Title"),
			new TextColumn("city",  "City"),
			new TextColumn("state", "State/Country"),
			new TextColumn("year",  "Finishing year"),
			new TextColumn("link",  "Homepage"),
			new PhotoColumn("image","Image", NULL, 50, 50),
			) );
		$this->myOrder="year ASC, name";

		$this->RefreshByReload=true;
	}
}

