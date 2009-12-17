<?php
include_once( BASEDIR . "/class/reklama_ua/helpers/bannerHelper.php" );


/**
 * SMARTY helper to automatically construct banners block for section
 *
 * @param array $params
 */
function smarty_insert_verticalBanners( $params )
{
	$section=$params["section"];
	$catalog=is_numeric($params['cat_id'])?$params['cat_id']:NULL;
	
	return displayVerticalBanners( $section, $catalog );
}

?>
