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
 * @version        $Id: 1.0 index.php 1 Sun 2018-01-07 21:18:24Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// Count elements
$countObjects = $objectsHandler->getCount();
$countAttributes = $attributesHandler->getCount();
$countCosts = $costsHandler->getCount();
$countImages = $imagesHandler->getCount();
$countFiles = $filesHandler->getCount();
$countSellers = $sellersHandler->getCount();
$countAttcategories = $attcategoriesHandler->getCount();
$countCost_types = $cost_typesHandler->getCount();
$countObjcategories = $objcategoriesHandler->getCount();
$countAttdefaults = $attdefaultsHandler->getCount();
// Template Index
$templateMain = 'wgrealestate_admin_index.tpl';
// InfoBox Statistics
$adminObject->addInfoBox(_AM_WGREALESTATE_STATISTICS);
// Info elements
$adminObject->addInfoBoxLine(sprintf( '<label>'._AM_WGREALESTATE_THEREARE_OBJECTS.'</label>', $countObjects));
$adminObject->addInfoBoxLine(sprintf( '<label>'._AM_WGREALESTATE_THEREARE_ATTRIBUTES.'</label>', $countAttributes));
$adminObject->addInfoBoxLine(sprintf( '<label>'._AM_WGREALESTATE_THEREARE_COSTS.'</label>', $countCosts));
$adminObject->addInfoBoxLine(sprintf( '<label>'._AM_WGREALESTATE_THEREARE_IMAGES.'</label>', $countImages));
$adminObject->addInfoBoxLine(sprintf( '<label>'._AM_WGREALESTATE_THEREARE_FILES.'</label>', $countFiles));
$adminObject->addInfoBoxLine(sprintf( '<label>'._AM_WGREALESTATE_THEREARE_SELLERS.'</label>', $countSellers));
$adminObject->addInfoBoxLine(sprintf( '<label>'._AM_WGREALESTATE_THEREARE_ATTCATEGORIES.'</label>', $countAttcategories));
$adminObject->addInfoBoxLine(sprintf( '<label>'._AM_WGREALESTATE_THEREARE_COST_TYPES.'</label>', $countCost_types));
$adminObject->addInfoBoxLine(sprintf( '<label>'._AM_WGREALESTATE_THEREARE_OBJCATEGORIES.'</label>', $countObjcategories));
$adminObject->addInfoBoxLine(sprintf( '<label>'._AM_WGREALESTATE_THEREARE_ATTDEFAULTS.'</label>', $countAttdefaults));
// Upload Folders
$folder = array(
	WGREALESTATE_UPLOAD_PATH,
	WGREALESTATE_UPLOAD_PATH . '/images/',
	WGREALESTATE_UPLOAD_PATH . '/files/',
	WGREALESTATE_UPLOAD_PATH . '/sellers/'
);
// Uploads Folders Created
foreach(array_keys($folder) as $i) {
	$adminObject->addConfigBoxLine($folder[$i], 'folder');
	$adminObject->addConfigBoxLine(array($folder[$i], '777'), 'chmod');
}

// Render Index
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('index.php'));
$GLOBALS['xoopsTpl']->assign('index', $adminObject->displayIndex());
include __DIR__ . '/footer.php';
