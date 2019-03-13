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
 * @version        $Id: 1.0 sellers.php 1 Sun 2018-01-07 21:18:23Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgrealestate_sellers.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';
$start = XoopsRequest::getInt('start', 0);
$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('userpager'));
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );
// 
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
// 
$sellersCount = $sellersHandler->getCountSellers();
$sellersAll = $sellersHandler->getAllSellers($start, $limit);
$keywords = array();
if($sellersCount > 0) {
	$sellers = array();
	// Get All Sellers
	foreach(array_keys($sellersAll) as $i) {
		$sellers[] = $sellersAll[$i]->getValuesSellers();
		$keywords[] = $sellersAll[$i]->getVar('seller_name');
	}
	$GLOBALS['xoopsTpl']->assign('sellers', $sellers);
	unset($sellers);
	// Display Navigation
	if($sellersCount > $limit) {
		include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
		$pagenav = new XoopsPageNav($sellersCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
		$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
	}
	$GLOBALS['xoopsTpl']->assign('type', $wgrealestate->getConfig('table_type'));
	$GLOBALS['xoopsTpl']->assign('divideby', $wgrealestate->getConfig('divideby'));
	$GLOBALS['xoopsTpl']->assign('numb_col', $wgrealestate->getConfig('numb_col'));
}
// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGREALESTATE_SELLERS);
// Keywords
wgrealestateMetaKeywords($wgrealestate->getConfig('keywords').', '. implode(',', $keywords));
unset($keywords);
// Description
wgrealestateMetaDescription(_MA_WGREALESTATE_SELLERS_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGREALESTATE_URL.'/sellers.php');
$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
include __DIR__ . '/footer.php';
