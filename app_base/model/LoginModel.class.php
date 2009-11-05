<?php
include_once( "BaseModel.class.php" );

class LoginModel extends BaseModel 
{
	public $myTitle="Вход в систему";
	protected $myTableName="users";
	protected $mySessionData=array( 
							"user_id"=>"user",
							"u_group"=>"group",
							"fullname"=>"fullname" );
	protected $myExtraSelect=",u_lname||' '||u_fname||' '||u_mname as fullname";
							
	public function __construct( $php )
	{
		parent::__construct( $php, array(
			"login" =>new TextColumn("login","Логин","Введите логин"),
			"passwd"=>new PasswordColumn("password","Пароль"),
		) );
	}
	
	public function clearSessionData( )
	{
		foreach( $this->mySessionData as $key=>$val ) unset( $_SESSION[$val] );
	}
	
	public function tryLogin( &$request )
	{
		global $DB;

		$name=$this->myColumns['login']->getInsert( $request );
		$pass=md5( md5($request[$this->myColumns['passwd']->myName]) );

		$sql_users="SELECT * $this->myExtraSelect FROM $this->myTableName 
						WHERE ".$this->myColumns['login']->myName."=$name AND 
						MD5(MD5(".$this->myColumns['passwd']->myName."))='$pass'";
		$row=$DB->GetRow( $sql_users );
		if( $row )
		{
			foreach( $this->mySessionData as $key=>$val ) $_SESSION[$val]=$row[$key];
			$this->set_default_login( $request );
		}
		else 
			return "Неправильный пароль или имя пользователя";
	}

   	public function get_default_login( &$request )
	{
		global $COOKIES;
		
		if( isset($request[$this->myColumns['login']->myName]) )
		{
			$this->myColumns['login']->myDefault=$request[$this->myColumns['login']->myName];
		}
		else
			$this->myColumns['login']->myDefault=$COOKIES->ReadCookie( "deflogin" );
	}
	
	public function set_default_login( &$request )
	{
		global $COOKIES;
		$COOKIES->WriteCookie( array("deflogin"=>$request[$this->myColumns['login']->myName]) );
	}
}

?>