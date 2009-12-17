<?php

include_once( BASEDIR . "/class/reklama_ua/helpers/bannerHelper.php" );

/**
 * SMARTY helper to display banners
 *
 * @param array $params
 * @return banner code
 */
function smarty_insert_getBanner( $params )
{
	if( !isset($params['value']) )
		$params=getBannerFromPool( $params['type'], is_numeric($params['cat_id'])?$params['cat_id']:NULL );
	if( !isset($params) ) return "";

	return displayBanner( $params['type'],$params['format'],$params['id'],$params['value'],$params['link'] );
}



?>
