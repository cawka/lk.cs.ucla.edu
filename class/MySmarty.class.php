<?php

include_once SMARTY_DIR . "Smarty.class.php";

class MySmarty extends Smarty 
{
	function MySmarty( $template_dir, $subdir="" )
	{
		global $LANG,$langdata,$_GET,$SETTINGS,$_SESSION,$SID,$DISABLE_CACHE,$BROWSER_TYPE,$PRICES, $COOKIES,
		$MY_MAX_PHOTO_SIZE;
		
		$this->template_dir = $template_dir; //print $this->template_dir; die;
        $this->compile_dir = TEMPDIR . "/compile". (($subdir!="" )?"/$subdir":"");
        $this->cache_dir =   TEMPDIR . "/cache"   . (($subdir!="" )?"/$subdir":"");
        
		$this->caching = false;
		//!(isAdmin() || isAdmin(99));//!isUserLogged();
        if( $DISABLE_CACHE==true ) $this->caching=false;
        
        $this->cache_lifetime=300;
        
        array_push( $this->plugins_dir, BASEDIR . "/app_base/plugins/" );
        
        if( !is_dir($this->compile_dir) ) mkdir( $this->compile_dir,0755,true );
        if( !is_dir($this->cache_dir) ) mkdir( $this->cache_dir,0755,true );
        
        $this->compile_check=true;
        
        $this->assign( "HTTP_HOST", $_SERVER['HTTP_HOST'] );
		
		$this->assign_by_ref( "SETTINGS", $SETTINGS );
	        
		$this->register_function( "isAdmin", "isAdmin" );
		$this->register_function( "isUserLogged", "isUserLogged" );
			
//		if( !isUserLogged() )
//		{
//			$this->assign( "deflogin", $COOKIES->ReadCookie("deflogin") );
//		}
	
		$this->assign( "menu", new MainMenuHelper() );

		if( isUserLogged() )
		{
			$this->assign( "login",   $_SESSION['login'] );
			$this->assign( "u_name",  $_SESSION['fullname'] );
			$this->assign( "u_group", $_SESSION['company'] );
		}

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
