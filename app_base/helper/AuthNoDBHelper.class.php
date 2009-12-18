<?php

class AuthNoDBHelper extends AuthHelper 
{
	public function __construct( $controller )
	{
		$this->myController=$controller;

		if( isUserLogged() ) { return; } //allow everything for any logged user
	}
	
	public function canUseAction( $controller, $action )
	{
		global $AUTH;

		if( isUserLogged() ||
			$controller=="public" || 
			isset($AUTH[$controller]['all']) ||
			isset($AUTH[$controller][$action]) )
		{			
			return true;
		}
		else 
			return false;
	}
}

?>
