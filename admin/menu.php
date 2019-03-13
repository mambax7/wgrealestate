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
 * @version        $Id: 1.0 menu.php 1 Sun 2018-01-07 21:18:24Z XOOPS Project (www.xoops.org) $
 */
$dirname = basename(dirname(__DIR__));
$moduleHandler = xoops_gethandler('module');
$xoopsModule = XoopsModule::getByDirname($dirname);
$moduleInfo = $moduleHandler->get($xoopsModule->getVar('mid'));
$sysPathIcon32 = $moduleInfo->getInfo('sysicons32');
$i = 1;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU1;
$adminmenu[$i]['link'] = 'admin/index.php';
$adminmenu[$i]['icon'] = $sysPathIcon32.'/dashboard.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU2;
$adminmenu[$i]['link'] = 'admin/objects.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/objects.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU3;
$adminmenu[$i]['link'] = 'admin/attributes.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/attributes.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU4;
$adminmenu[$i]['link'] = 'admin/costs.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/costs.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU5;
$adminmenu[$i]['link'] = 'admin/images.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/images.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU6;
$adminmenu[$i]['link'] = 'admin/files.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/files.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU7;
$adminmenu[$i]['link'] = 'admin/sellers.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/sellers.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU9;
$adminmenu[$i]['link'] = 'admin/objcategories.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/objcategories.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU10;
$adminmenu[$i]['link'] = 'admin/cost_types.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/cost_types.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU11;
$adminmenu[$i]['link'] = 'admin/attdefaults.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/attdefaults.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU12;
$adminmenu[$i]['link'] = 'admin/attcategories.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/attcategories.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ADMENU16;
$adminmenu[$i]['link'] = 'admin/maintainance.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/maintainance.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGREALESTATE_ABOUT;
$adminmenu[$i]['link'] = 'admin/about.php';
$adminmenu[$i]['icon'] = $sysPathIcon32.'/about.png';
unset($i);
