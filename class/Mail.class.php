<?php
require_once( BASEDIR . "/class/Swift/swift_required.php" );

class Mail 
{
    private static $default_from_name ="Home Page Robot";
    private static $default_from_email="no-reply@lasr.cs.ucla.edu";
    
    private static $SMTP="127.0.0.1";

    public static function sendPure( &$message )
    {
		try
		{
//			$swift=&new Swift( new Swift_Connection_SMTP(Mail::$SMTP) );
//			$ret=$swift->send( $message, $to, $from ); 

			$transport=Swift_SmtpTransport::newInstance( Mail::$SMTP );
			$swift=Swift_Mailer::newInstance( $transport );

			$swift->send( $message );

			return $ret;
		}
		catch( Swift_ConnectionException $e )
		{
			return false;
		} 
		catch( Swift_Message_MimeException $e )
		{
			return false;
		}
    }
    
    public static function sendToUserFromRobot( $to_name,$to_email,$subject,$html,$txt ) //should be HTML, one recepient
    {	
//		$message=&new Swift_Message( $subject );
		 
		$message=Swift_Message::newInstance( )
			->setSubject( $subject )
			->setFrom( array( Mail::$default_from_email => Mail::$default_from_name ) )
			->setTo(   array( $to_email => $to_name ) )
			->setBody( $txt );

		if( $html!="" ) $message->addPart( $html, "text/html" );

		return Mail::sendPure( $message );
    }
    
/*    public static function sendToUserFromUser( $from_name,$from_email,$to_name,$to_email,$subject,$txt ) //should be TXT, one recepient
    {
		$message=&new Swift_Message( $subject, $txt );
		 
		$from=&new Swift_Address( $from_email, $from_name );
		$to  =&new Swift_Address( $to_email, $to_name );
		
		return Mail::sendPure( $from, $to, $message );
    }
    

	public static function sendFromRobot( $to_list,$subject,$html,$txt )
	{
		$message=&new Swift_Message( $subject );
		 
		$message->attach( new Swift_Message_Part($txt) );
		if( $html!="" ) $message->attach( new Swift_Message_Part($html, "text/html") );
	
		$from=&new Swift_Address( Mail::$default_from_email, Mail::$default_from_name );
		$to_array=explode( ",", $to_list );
		$to=new Swift_RecipientList( );
		foreach( $to_array as $i ) $to->add( $i );
	
		return Mail::sendPure( $from, $to, $message );
	}
    
	public static function sendToAdminFromUser( $from_name,$from_email,$to_list,$subject,$txt )
	{
		$message=&new Swift_Message( $subject, $txt );
	
		$from=&new Swift_Address( $from_email, $from_name );
		$to_array=explode( ",", $to_list );
		$to=new Swift_RecipientList( );
		foreach( $to_array as $i ) $to->add( $i );
	
		return Mail::sendPure( $from, $to, $message );
	}*/
}

?>
