<?php
/**
 * Interface to APC engine
*/

class APC
{
	var $myIsEnabled;
	var $myTTL;
	
	var $myMemCache;
	
	function APC( $enable,$ttl=0 )
	{
		global $CACHE_SERVERS;
		
		$this->myIsEnabled=$enable;
		$this->myTTL=$ttl;
		
		if( $this->myIsEnabled )
		{
			$this->myMemCache=&new Memcache( );
			foreach( $CACHE_SERVERS as $server )
			{
				$this->myMemCache->addServer( $server['host'], $server['port'], true, $server['weight'] );
			}	
		}
	}
	
	function fetch( $key )
	{
		if( !$this->myIsEnabled ) return false;
		return $this->myMemCache->get( $key );
//		return apc_fetch( $key );
	}
	
	function cache( $key, &$value, $ttl=-1 )
	{
		if( !$this->myIsEnabled ) return;
//		$ret=apc_store( $key, $value, $this->myTTL );
		$this->myMemCache->set( $key, $value, false, $ttl>=0?$ttl:$this->myTTL );//$ttl>=0?$ttl:$this->myTTL );
	}
	
	function clear( $key )
	{
		if( !$this->myIsEnabled ) return;
//		apc_delete( $key );
		$this->myMemCache->delete( $key );
	}
	
	function clear_all( )
	{
		if( !$this->myIsEnabled ) return;
		$this->myMemCache->flush( );
	}
}

function APC_constructName( $params )
{
	$name="";
	foreach( $params as $key )
	{
		$name.="($key)";
	}
	return $name;
}

function APC_GetRows( $params, &$db, $sql, $ttl=-1 )
{
	global $theAPC;
	$name=APC_constructName( $params );

//	$theAPC->clear( $name );
	$ret=$theAPC->fetch( $name );
	if( !$ret ) 
	{
		$res=$db->Execute( $sql );
		$ret=$res->GetRows();
		
		if( sizeof($ret)==0 ) $ret="no data"; //bug: if no data present - APC thinks that no cache is available
		$theAPC->cache( $name, $ret,$ttl );
	}
	
	return is_array($ret)?$ret:array();
}

function APC_GetAssoc( $params, &$db, $sql, $ttl=-1 )
{
	global $theAPC;
	
	$name=APC_constructName( $params );

	$ret=$theAPC->fetch( $name );
	if( !$ret ) 
	{
		$ret=$db->GetAssoc( $sql );
		
		if( sizeof($ret)==0 ) $ret="no data";
		$theAPC->cache( $name, $ret,$ttl );
	}
	
	return is_array($ret)?$ret:array();
}


function APC_GetRow( $params, &$db, $sql, $ttl=-1 )
{
	global $theAPC;
	
	$name=APC_constructName( $params );

	$ret=$theAPC->fetch( $name );
	if( !$ret ) 
	{
		$ret=$db->GetRow( $sql );

		if( sizeof($ret)==0 ) $ret="no data";
		$theAPC->cache( $name, $ret,$ttl );
	}
	
	return is_array($ret)?$ret:array();
}
