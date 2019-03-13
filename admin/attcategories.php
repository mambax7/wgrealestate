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
 * @version        $Id: 1.0 attcategories.php 1 Sun 2018-01-07 21:18:21Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request attcat_id
$attcatId = XoopsRequest::getInt('attcat_id');
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('adminpager'));
		$templateMain = 'wgrealestate_admin_attcategories.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('attcategories.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_ATTCATEGORY, 'attcategories.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$attcategoriesCount = $attcategoriesHandler->getCountAttcategories();
		$attcategoriesAll = $attcategoriesHandler->getAllAttcategories($start, $limit);
		$GLOBALS['xoopsTpl']->assign('attcategories_count', $attcategoriesCount);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url_16', WGREALESTATE_ICONS_URL . '/16/');
		// Table view attcategories
		if($attcategoriesCount > 0) {
			foreach(array_keys($attcategoriesAll) as $i) {
				$attcategory = $attcategoriesAll[$i]->getValuesAttcategories();
				$GLOBALS['xoopsTpl']->append('attcategories_list', $attcategory);
				unset($attcategory);
			}
			// Display Navigation
			if($attcategoriesCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($attcategoriesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_ATTCATEGORIES);
		}

	break;
	case 'new':
		$templateMain = 'wgrealestate_admin_attcategories.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('attcategories.php'));
		$adminObject->addItemButton(_CO_WGREALESTATE_ATTCATEGORIES_LIST, 'attcategories.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$attcategoriesObj = $attcategoriesHandler->create();
		$form = $attcategoriesObj->getFormAttcategories();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit_valid':
		if( 0 < $attcatId ) {
			$attcategoriesObj = $attcategoriesHandler->get($attcatId);
		} else {
			redirect_header('attcategories.php', 3, _CO_WGREALESTATE_ERROR_NO_VALID_OBJID);
		}
		$attcat_valid = XoopsRequest::getInt('attcat_valid', 0);
		$attcategoriesObj->setVar('attcat_valid', ((1 == $attcat_valid) ? 0 : 1));
		// Insert Data
		if($attcategoriesHandler->insert($attcategoriesObj, true)) {
			redirect_header('attcategories.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}

	break;
	case 'edit_show':
		if( 0 < $attcatId ) {
			$attcategoriesObj = $attcategoriesHandler->get($attcatId);
		} else {
			redirect_header('attcategories.php', 3, _CO_WGREALESTATE_ERROR_NO_VALID_OBJID);
		}
		$attcat_show = XoopsRequest::getInt('attcat_show', 0);
		$attcategoriesObj->setVar('attcat_show', ((1 == $attcat_show) ? 0 : 1));
		// Insert Data
		if($attcategoriesHandler->insert($attcategoriesObj, true)) {
			redirect_header('attcategories.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('attcategories.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($attcatId)) {
			$attcategoriesObj = $attcategoriesHandler->get($attcatId);
		} else {
			$attcategoriesObj = $attcategoriesHandler->create();
		}
		// Set Vars
        $attcategoriesObj->setVar('attcat_info', $_POST['attcat_info']);
		$attcategoriesObj->setVar('attcat_name', $_POST['attcat_name']);
        $attcategoriesObj->setVar('attcat_weight', $_POST['attcat_weight']);
        $attcategoriesObj->setVar('attcat_show', ((1 == $_REQUEST['attcat_show']) ? '1' : '0'));
		$attcategoriesObj->setVar('attcat_valid', ((1 == $_REQUEST['attcat_valid']) ? '1' : '0'));
		$attcategoryDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['attcat_datecreate']);
		$attcategoriesObj->setVar('attcat_datecreate', $attcategoryDatecreate->getTimestamp());
		$attcategoriesObj->setVar('attcat_submitter', isset($_POST['attcat_submitter']) ? $_POST['attcat_submitter'] : 0);
		// Insert Data
		if($attcategoriesHandler->insert($attcategoriesObj)) {
			redirect_header('attcategories.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $attcategoriesObj->getHtmlErrors());
		$form = $attcategoriesObj->getFormAttcategories();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wgrealestate_admin_attcategories.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('attcategories.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_ATTCATEGORY, 'attcategories.php?op=new', 'add');
		$adminObject->addItemButton(_CO_WGREALESTATE_ATTCATEGORIES_LIST, 'attcategories.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$attcategoriesObj = $attcategoriesHandler->get($attcatId);
		$form = $attcategoriesObj->getFormAttcategories();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$attcategoriesObj = $attcategoriesHandler->get($attcatId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('attcategories.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($attcategoriesHandler->delete($attcategoriesObj)) {
				redirect_header('attcategories.php', 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $attcategoriesObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'attcat_id' => $attcatId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $attcategoriesObj->getVar('attcat_name')));
		}

	break;
    case 'order':
        $order = XoopsRequest::getArray('atcorder', array());
        for ($i = 0, $iMax = count($order); $i < $iMax; $i++){
            $attcategoriesObj = $attcategoriesHandler->get($order[$i]);
            $attcategoriesObj->setVar('attcat_weight',$i+1);
            $attcategoriesHandler->insert($attcategoriesObj, true);
        }
    break;
}
include __DIR__ . '/footer.php';
