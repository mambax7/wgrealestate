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
 * @version        $Id: 1.0 header.php 1 Sun 2018-01-07 21:18:25Z XOOPS Project (www.xoops.org) $
 */
include dirname(dirname(__DIR__)) .'/mainfile.php';
include __DIR__ .'/include/common.php';
$dirname = basename(__DIR__);
// Breadcrumbs
$xoBreadcrumbs = array();
$xoBreadcrumbs[] = array('title' => $GLOBALS['xoopsModule']->getVar('name'), 'link' => WGREALESTATE_URL . '/');
// Get instance of module
$wgrealestate = WgrealestateHelper::getInstance();
$objcategoriesHandler = $wgrealestate->getHandler('objcategories');
$attdefaultsHandler = $wgrealestate->getHandler('attdefaults');
$attributesHandler = $wgrealestate->getHandler('attributes');
$attcategoriesHandler = $wgrealestate->getHandler('attcategories');
$cost_typesHandler = $wgrealestate->getHandler('cost_types');
$objectsHandler = $wgrealestate->getHandler('objects');
$costsHandler = $wgrealestate->getHandler('costs');
$imagesHandler = $wgrealestate->getHandler('images');
$filesHandler = $wgrealestate->getHandler('files');
$sellersHandler = $wgrealestate->getHandler('sellers');
// Permission
$isModerator = wgrealestate_isModerator();
// 
$myts = MyTextSanitizer::getInstance();
// Default Css Style
$style = WGREALESTATE_URL . '/assets/css/style.css';
if(!file_exists($style)) {
	return false;
}
// Smarty Default
$sysPathIcon16 = $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32 = $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
$modPathIcon16 = $GLOBALS['xoopsModule']->getInfo('modicons16');
$modPathIcon32 = $GLOBALS['xoopsModule']->getInfo('modicons16');
// Load Languages
xoops_loadLanguage('main');
xoops_loadLanguage('modinfo');
