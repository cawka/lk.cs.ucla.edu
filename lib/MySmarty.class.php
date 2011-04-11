<?php

require_once( "lib/MyBaseSmarty.class.php" );

class MySmarty extends MyBaseSmarty
{
	public function __construct( )
	{
		parent::__construct( );
		global $PREFIX;

		$this->assign( "menu", new MainMenuHelper() );
		$this->assign( "GLOBAL_PREFIX", $PREFIX );
	}
}

