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
 * @version        $Id: 1.0 objcategories.php 1 Sun 2018-01-07 21:18:20Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request objcat_id
$objcatId = XoopsRequest::getInt('objcat_id');
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('adminpager'));
		$templateMain = 'wgrealestate_admin_objcategories.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('objcategories.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_OBJCATEGORY, 'objcategories.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$objcategoriesCount = $objcategoriesHandler->getCountObjcategories();
		$objcategoriesAll = $objcategoriesHandler->getAllObjcategories($start, $limit);
		$GLOBALS['xoopsTpl']->assign('objcategories_count', $objcategoriesCount);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url_16', WGREALESTATE_ICONS_URL . '/16/');
		// Table view objcategories
		if($objcategoriesCount > 0) {
			foreach(array_keys($objcategoriesAll) as $i) {
				$objcategory = $objcategoriesAll[$i]->getValuesObjcategories();
				$GLOBALS['xoopsTpl']->append('objcategories_list', $objcategory);
				unset($objcategory);
			}
			// Display Navigation
			if($objcategoriesCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($objcategoriesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_OBJCATEGORIES);
		}

	break;
	case 'new':
		$templateMain = 'wgrealestate_admin_objcategories.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('objcategories.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_OBJCAT_CATEGORIES_LIST, 'objcategories.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$objcategoriesObj = $objcategoriesHandler->create();
		$form = $objcategoriesObj->getFormObjcategories();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('objcategories.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($objcatId)) {
			$objcategoriesObj = $objcategoriesHandler->get($objcatId);
		} else {
			$objcategoriesObj = $objcategoriesHandler->create();
		}
		// Set Vars
		$objcategoriesObj->setVar('objcat_name', $_POST['objcat_name']);
		$objcategoriesObj->setVar('objcat_valid', ((1 == $_REQUEST['objcat_valid']) ? '1' : '0'));
		$objcategoryDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['objcat_datecreate']);
		$objcategoriesObj->setVar('objcat_datecreate', $objcategoryDatecreate->getTimestamp());
		$objcategoriesObj->setVar('objcat_submitter', isset($_POST['objcat_submitter']) ? $_POST['objcat_submitter'] : 0);
		// Insert Data
		if($objcategoriesHandler->insert($objcategoriesObj)) {
			redirect_header('objcategories.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $objcategoriesObj->getHtmlErrors());
		$form = $objcategoriesObj->getFormObjcategories();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wgrealestate_admin_objcategories.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('objcategories.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_OBJCATEGORY, 'objcategories.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGREALESTATE_OBJCAT_CATEGORIES_LIST, 'objcategories.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$objcategoriesObj = $objcategoriesHandler->get($objcatId);
		$form = $objcategoriesObj->getFormObjcategories();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit_valid':
		if( 0 < $objcatId ) {
			$objcategoriesObj = $objcategoriesHandler->get($objcatId);
		} else {
			redirect_header('objcategories.php', 3, _CO_WGREALESTATE_ERROR_NO_VALID_OBJID);
		}
		$objcat_valid = XoopsRequest::getInt('objcat_valid', 0);
		$objcategoriesObj->setVar('objcat_valid', ((1 == $objcat_valid) ? 0 : 1));
		// Insert Data
		if($objcategoriesHandler->insert($objcategoriesObj, true)) {
			redirect_header('objcategories.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}

	break;
	case 'delete':
		$objcategoriesObj = $objcategoriesHandler->get($objcatId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('objcategories.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($objcategoriesHandler->delete($objcategoriesObj)) {
				redirect_header('objcategories.php', 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $objcategoriesObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'objcat_id' => $objcatId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $objcategoriesObj->getVar('objcat_name')));
		}

	break;
}
include __DIR__ . '/footer.php';
