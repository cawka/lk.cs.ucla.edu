<?php

require_once( "lib/MyBaseSmarty.class.php" );

class MySmarty extends MyBaseSmarty
{
	public function __construct( )
	{
		parent::__construct( );

		$this->assign( "menu", new MainMenuHelper() );
	}
}

