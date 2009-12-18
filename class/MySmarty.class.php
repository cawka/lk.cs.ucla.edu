<?php

include_once SMARTY_DIR . "Smarty.class.php";

class MySmarty extends Smarty 
{
	function MySmarty( $template_dir, $subdir="" )
	{
		$this->template_dir = $template_dir; 
        $this->compile_dir = TEMPDIR . "/compile". (($subdir!="" )?"/$subdir":"");
        $this->cache_dir =   TEMPDIR . "/cache"   . (($subdir!="" )?"/$subdir":"");
        
		$this->caching = !isUserLogged( );
        $this->cache_lifetime=-1;
	}

	public function is_cached( $template, $cache_id=NULL, $compile_id=NULL )
	{
		global $SETTINGS, $GLOBAL_PREFIX;

		$ret=parent::is_cached( $template, $cache_id, $compile_id );
		if( !$ret )
		{
	        array_push( $this->plugins_dir, BASEDIR . "/app_base/plugins/" );
	        
	        if( !is_dir($this->compile_dir) ) mkdir( $this->compile_dir,0755,true );
	        if( !is_dir($this->cache_dir) ) mkdir( $this->cache_dir,0755,true );
	        
	        $this->compile_check=true;
	        
	        $this->assign( "HTTP_HOST", $_SERVER['HTTP_HOST'] );
			
			$this->assign_by_ref( "SETTINGS", $SETTINGS );
			$this->assign( "GLOBAL_PREFIX", $GLOBAL_PREFIX ); 
		        
//			$this->register_function( "isAdmin", "isAdmin" );
			$this->register_function( "isUserLogged", "isUserLogged" );
				
			$this->assign( "menu", new MainMenuHelper() );
	
			if( isUserLogged() )
			{
				$this->assign( "login",   $_SESSION['login'] );
				$this->assign( "u_name",  $_SESSION['fullname'] );
				$this->assign( "u_group", $_SESSION['company'] );
			}
		}

		return $ret;
	}
	
//	public function prepareAdminMenu( )
//	{
//		global $ADMIN_MENU;
//		include_once( BASEDIR . "/inc/admin_menu.php" );
//		
//		$this->assign( "adminmenu", $ADMIN_MENU );
//	}
}

?>
