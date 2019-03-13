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
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request seller_id
$sellerId = XoopsRequest::getInt('seller_id');
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('adminpager'));
		$templateMain = 'wgrealestate_admin_sellers.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('sellers.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_SELLER, 'sellers.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$sellersCount = $sellersHandler->getCountSellers();
		$sellersAll = $sellersHandler->getAllSellers($start, $limit);
		$GLOBALS['xoopsTpl']->assign('sellers_count', $sellersCount);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		// Table view sellers
		if($sellersCount > 0) {
			foreach(array_keys($sellersAll) as $i) {
				$seller = $sellersAll[$i]->getValuesSellers();
				$GLOBALS['xoopsTpl']->append('sellers_list', $seller);
				unset($seller);
			}
			// Display Navigation
			if($sellersCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($sellersCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_SELLERS);
		}

	break;
	case 'new':
		$templateMain = 'wgrealestate_admin_sellers.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('sellers.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_SELLERS_LIST, 'sellers.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$sellersObj = $sellersHandler->create();
		$form = $sellersObj->getFormSellers();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('sellers.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($sellerId)) {
			$sellersObj = $sellersHandler->get($sellerId);
		} else {
			$sellersObj = $sellersHandler->create();
		}
		// Set Vars
		$sellersObj->setVar('seller_name', $_POST['seller_name']);
		$sellersObj->setVar('seller_ctry', $_POST['seller_ctry']);
		$sellersObj->setVar('seller_postal_code', $_POST['seller_postal_code']);
		$sellersObj->setVar('seller_city', $_POST['seller_city']);
		$sellersObj->setVar('seller_address', $_POST['seller_address']);
		$sellersObj->setVar('seller_phone', $_POST['seller_phone']);
		$sellersObj->setVar('seller_mail', $_POST['seller_mail']);
		$sellersObj->setVar('seller_cat', isset($_POST['seller_cat']) ? $_POST['seller_cat'] : 0);
		$sellersObj->setVar('seller_public', ((1 == $_REQUEST['seller_public']) ? '1' : '0'));
		$sellerDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['seller_datecreate']);
		$sellersObj->setVar('seller_datecreate', $sellerDatecreate->getTimestamp());
		$sellersObj->setVar('seller_submitter', isset($_POST['seller_submitter']) ? $_POST['seller_submitter'] : 0);
		// Insert Data
		if($sellersHandler->insert($sellersObj)) {
			redirect_header('sellers.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $sellersObj->getHtmlErrors());
		$form = $sellersObj->getFormSellers();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wgrealestate_admin_sellers.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('sellers.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_SELLER, 'sellers.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGREALESTATE_SELLERS_LIST, 'sellers.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$sellersObj = $sellersHandler->get($sellerId);
		$form = $sellersObj->getFormSellers();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$sellersObj = $sellersHandler->get($sellerId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('sellers.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($sellersHandler->delete($sellersObj)) {
				redirect_header('sellers.php', 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $sellersObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'seller_id' => $sellerId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $sellersObj->getVar('seller_name')));
		}

	break;
}
include __DIR__ . '/footer.php';
