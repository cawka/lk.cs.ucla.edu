<?php

class AuthHelper 
{
	private $myRights;
	private $myDefaultRedirect="/";	
	private $myController;
	
	public function __construct( $controller )
	{
		global $DB,$theAPC;
		$this->myController=$controller;
//		$DB->debug=true;

		if( $_SESSION['group']=="0" ) 
		{
			return;
		}
		$rows=APC_GetRows( array("user_rights",$_SESSION['group']),$DB,"SELECT * FROM user_rights WHERE user_group_id".(isset($_SESSION['group'])?"='$_SESSION[group]'":" IS NULL"));
		
		foreach( $rows as &$data )
		{
			$this->myRights[$data['controller_id']][$data['allow_action']]=true;
		}
		
		if( isset($_SESSION['group']) )
		{ //all public rights also granted to logged users
			$rows=APC_GetRows( array("user_rights",NULL),$DB,
							   "SELECT * FROM user_rights WHERE user_group_id IS NULL" );
			foreach( $rows as &$data )
			{
				$this->myRights[$data['controller_id']][$data['allow_action']]=true;
			}
		}
	}
	
	public function canAccessTo( $controller )
	{
		return $this->canUseAction( $controller,'index' );
	}
	
	public function canUseAction( $controller, $action )
	{
		if( $_SESSION['group']=="0" ||
			$controller=="public" || 
			isset($this->myRights[$controller]['all']) ||
			isset($this->myRights[$controller][$action]) )
		{			
			return true;
		}
		else 
			return false;
	}
	
	public function isAllowed( $action )
	{
		return $this->canUseAction( $this->myController, $action );
		return 	$_SESSION[group]=="0" || 
				$this->myRights['all']==1 || 
				$this->myRights[$action]==1;
	}
	
	public function allowOrRedirect( $action )
	{
		if( !$this->isAllowed($action) ) 
		{
			header( "Location: $this->myDefaultRedirect" );
			exit( 0 );
		}
	}
}

?>
