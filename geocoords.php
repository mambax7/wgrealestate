<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgRealEstate module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wgrealestate
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 costs.php 1 Sun 2018-01-07 21:18:23Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgrealestate_geocoords.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';
require_once __DIR__ . '/include/googlemaps.php';

$op    = XoopsRequest::getString('op', 'list');
$objId = XoopsRequest::getString('obj_id', 'list');
// 

// assign rights of current user
$GLOBALS['xoopsTpl']->assign('isModerator', $isModerator);

switch ($op) {
	case 'search':
        // Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('objects.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
        if( 0 < $objId) {
			$objectsObj = $objectsHandler->get($objId);
		} else {
			redirect_header('objects.php', 3, _CO_WGREALESTATE_ERROR_NO_VALID_OBJID);
		}
        // Your google API key
        // https://developers.google.com/maps/documentation/geocoding/usage-limits?hl=de
        // 2,500 free requests per day, calculated as the sum of client-side and server-side queries.
        // 50 requests per second, calculated as the sum of client-side and server-side queries.
        $googleKey = '';
        $obj_postalcode = XoopsRequest::getString('obj_postalcode');
        $obj_address    = XoopsRequest::getString('obj_address');
        $obj_city       = XoopsRequest::getString('obj_city');
        $obj_ctry       = XoopsRequest::getString('obj_ctry');
		if ( '-' === $obj_ctry) {$obj_ctry = '';} 
        $search = implode(', ', [$obj_address, $obj_postalcode, $obj_city, $obj_ctry]);

        $geoData = google_maps_search($search, $googleKey);
        if (!$geoData) {
            redirect_header('objects.php?op=editmode&amp;obj_id=' . $objId, 3, _CO_WGREALESTATE_ERROR_GEO);
        }
        $mapData = map_google_search_result($geoData);

		// Set Vars
        $objectsObj->setVar('obj_ctry', $obj_ctry);
		$objectsObj->setVar('obj_postalcode', $obj_postalcode);
		$objectsObj->setVar('obj_city', $obj_city);
		$objectsObj->setVar('obj_address', $obj_address);
		$objectsObj->setVar('obj_geo_lng', $mapData['lng']);
		$objectsObj->setVar('obj_geo_lat', $mapData['lat']);
        $objectsObj->setVar('obj_geo_placeid', $mapData['place_id']);

		// Insert Data
		if($objectsHandler->insert($objectsObj)) {
            redirect_header('objects.php?op=editmode&amp;obj_id=' . $objId, 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $objectsObj->getHtmlErrors());
		$form = $objectsObj->getFormObjectGeos();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
    
	case 'edit':
    default:
		// Get Form
		$objectsObj = $objectsHandler->get($objId);
		$form = $objectsObj->getFormObjectGeos();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
	break;
}

include __DIR__ . '/footer.php';



