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
 * @version        $Id: 1.0 footer.php 1 Sun 2018-01-07 21:18:25Z XOOPS Project (www.xoops.org) $
 */
if(count($xoBreadcrumbs) > 1) {
	$GLOBALS['xoopsTpl']->assign('xoBreadcrumbs', $xoBreadcrumbs);
}
$GLOBALS['xoopsTpl']->assign('adv', $wgrealestate->getConfig('advertise'));
// 
$GLOBALS['xoopsTpl']->assign('bookmarks', $wgrealestate->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $wgrealestate->getConfig('fbcomments'));
// 
$GLOBALS['xoopsTpl']->assign('admin', WGREALESTATE_ADMIN);
if (1 === $wgrealestate->getConfig('show_copyright')) {
	$GLOBALS['xoopsTpl']->assign('copyright', $copyright);
}
// 
include_once XOOPS_ROOT_PATH .'/footer.php';
