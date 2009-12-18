<?php

class KeywordsModel extends TableModel
{
	public $myTitle="Search Keywords";
	
	public function	 __construct( $php )
	{
		global $DB,$langdata;
		
		parent::__construct( $DB,$php, "keywords", array(
			), "id",NULL,"",true );
		$this->myOrder="date DESC";
//		$this->myElementsPerPage=30;
	}
}

?>
