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
 * @version        $Id: 1.0 common.php 1 Sun 2018-01-07 21:18:26Z XOOPS Project (www.xoops.org) $
 */
if (!defined('XOOPS_ICONS32_PATH')) {
    define('XOOPS_ICONS32_PATH', XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
}
if (!defined('XOOPS_ICONS32_URL')) {
    define('XOOPS_ICONS32_URL', XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
}
define('WGREALESTATE_DIRNAME', 'wgrealestate');
define('WGREALESTATE_PATH', XOOPS_ROOT_PATH.'/modules/'.WGREALESTATE_DIRNAME);
define('WGREALESTATE_URL', XOOPS_URL.'/modules/'.WGREALESTATE_DIRNAME);
define('WGREALESTATE_ICONS_PATH', WGREALESTATE_PATH.'/assets/icons');
define('WGREALESTATE_ICONS_URL', WGREALESTATE_URL.'/assets/icons');
define('WGREALESTATE_IMAGE_PATH', WGREALESTATE_PATH.'/assets/images');
define('WGREALESTATE_IMAGE_URL', WGREALESTATE_URL.'/assets/images');
define('WGREALESTATE_UPLOAD_PATH', XOOPS_UPLOAD_PATH.'/'.WGREALESTATE_DIRNAME);
define('WGREALESTATE_UPLOAD_URL', XOOPS_UPLOAD_URL.'/'.WGREALESTATE_DIRNAME);
define('WGREALESTATE_UPLOAD_FILES_PATH', WGREALESTATE_UPLOAD_PATH.'/files');
define('WGREALESTATE_UPLOAD_FILES_URL', WGREALESTATE_UPLOAD_URL.'/files');
define('WGREALESTATE_UPLOAD_IMAGE_PATH', WGREALESTATE_UPLOAD_PATH.'/images');
define('WGREALESTATE_UPLOAD_IMAGE_URL', WGREALESTATE_UPLOAD_URL.'/images');
define('WGREALESTATE_ADMIN', WGREALESTATE_URL . '/admin/index.php');
$localLogo = WGREALESTATE_IMAGE_URL . '/wedega_logo.png';
// Module Information
$copyright = "<a href='https://wedega.com' title='Wedega - Webdesign Gabor' target='_blank'><img src='".$localLogo."' alt='Wedega - Webdesign Gabor' /></a>";
include_once XOOPS_ROOT_PATH .'/class/xoopsrequest.php';
include_once WGREALESTATE_PATH .'/class/helper.php';
include_once WGREALESTATE_PATH .'/include/functions.php';

// Constants for deal types
define('WGREALESTATE_DEALTYPE_RENT_VAL',  1);
define('WGREALESTATE_DEALTYPE_SALE_VAL',  2); 

//Constands for state
define('WGREALESTATE_STATE_NEW_VAL',     0);
define('WGREALESTATE_STATE_ONLINE_VAL',  1);
define('WGREALESTATE_STATE_ARCHIVE_VAL', 2);
define('WGREALESTATE_STATE_DELETED',     3);

// Constants for image types
define('WGREALESTATE_IMGCAT_PICTURE_VAL',  0);
define('WGREALESTATE_IMGCAT_PLAN_VAL',     1);

// Constands for type of add cats
define('WGREALESTATE_ATTR_NONE_VAL',        0);
define('WGREALESTATE_ATTR_YN_VAL',          1);
define('WGREALESTATE_ATTR_TEXTAREA_VAL',    2);
define('WGREALESTATE_ATTR_TEXT_VAL',        3);
define('WGREALESTATE_ATTR_TEXT_M2_VAL',     4);
define('WGREALESTATE_ATTR_TEXT_CURR_VAL',   5);
define('WGREALESTATE_ATTR_SELECT_VAL',      6);
define('WGREALESTATE_ATTR_SELECT_ITEM_VAL', 7);
define('WGREALESTATE_ATTR_TEXT_KWH_VAL',    8);

// Constants for deal types
define('WGREALESTATE_INDEX_HEADER_VAL',  1);
define('WGREALESTATE_INDEX_MISC_VAL',  2); 
