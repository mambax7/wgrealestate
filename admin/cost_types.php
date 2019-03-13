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
 * @version        $Id: 1.0 cost_types.php 1 Sun 2018-01-07 21:18:21Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request costt_id
$costtId = XoopsRequest::getInt('costt_id');
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('adminpager'));
		$templateMain = 'wgrealestate_admin_cost_types.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('cost_types.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_COST_TYPE, 'cost_types.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$cost_typesCount = $cost_typesHandler->getCountCost_types();
		$cost_typesAll = $cost_typesHandler->getAllCost_types($start, $limit);
		$GLOBALS['xoopsTpl']->assign('cost_types_count', $cost_typesCount);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url_16', WGREALESTATE_ICONS_URL . '/16/');
		// Table view cost_types
		if($cost_typesCount > 0) {
			foreach(array_keys($cost_typesAll) as $i) {
				$cost_type = $cost_typesAll[$i]->getValuesCost_types();
				$GLOBALS['xoopsTpl']->append('cost_types_list', $cost_type);
				unset($cost_type);
			}
			// Display Navigation
			if($cost_typesCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($cost_typesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_COST_TYPES);
		}

	break;
	case 'new':
		$templateMain = 'wgrealestate_admin_cost_types.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('cost_types.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_COST_TYPES_LIST, 'cost_types.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$cost_typesObj = $cost_typesHandler->create();
		$form = $cost_typesObj->getFormCost_types();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('cost_types.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($costtId)) {
			$cost_typesObj = $cost_typesHandler->get($costtId);
		} else {
			$cost_typesObj = $cost_typesHandler->create();
		}
		// Set Vars
		$cost_typesObj->setVar('costt_text', $_POST['costt_text']);
        $cost_typesObj->setVar('costt_dealt_id', $_POST['costt_dealt_id']);
		$cost_typesObj->setVar('costt_perc', $_POST['costt_perc']);
		$cost_typesObj->setVar('costt_fixed', $_POST['costt_fixed']);
		$cost_typesObj->setVar('costt_info', $_POST['costt_info']);
		$cost_typesObj->setVar('costt_index', ((1 == $_REQUEST['costt_index']) ? '1' : '0'));
		$cost_typesObj->setVar('costt_valid', ((1 == $_REQUEST['costt_valid']) ? '1' : '0'));
		$cost_typeDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['costt_datecreate']);
		$cost_typesObj->setVar('costt_datecreate', $cost_typeDatecreate->getTimestamp());
		$cost_typesObj->setVar('costt_submitter', isset($_POST['costt_submitter']) ? $_POST['costt_submitter'] : 0);
		// Insert Data
		if($cost_typesHandler->insert($cost_typesObj)) {
			redirect_header('cost_types.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $cost_typesObj->getHtmlErrors());
		$form = $cost_typesObj->getFormCost_types();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wgrealestate_admin_cost_types.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('cost_types.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_COST_TYPE, 'cost_types.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGREALESTATE_COST_TYPES_LIST, 'cost_types.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$cost_typesObj = $cost_typesHandler->get($costtId);
		$form = $cost_typesObj->getFormCost_types();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit_valid':
		if( 0 < $costtId ) {
			$cost_typesObj = $cost_typesHandler->get($costtId);
		} else {
			redirect_header('cost_types.php', 3, _CO_WGREALESTATE_ERROR_NO_VALID_OBJID);
		}
		$costt_valid = XoopsRequest::getInt('costt_valid', 0);
		$cost_typesObj->setVar('costt_valid', ((1 == $costt_valid) ? 0 : 1));
		// Insert Data
		if($cost_typesHandler->insert($cost_typesObj, true)) {
			redirect_header('cost_types.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}

	break;
	case 'edit_index':
		if( 0 < $costtId ) {
			$cost_typesObj = $cost_typesHandler->get($costtId);
		} else {
			redirect_header('cost_types.php', 3, _CO_WGREALESTATE_ERROR_NO_VALID_OBJID);
		}
		$costt_index = XoopsRequest::getInt('costt_index', 0);
		$cost_typesObj->setVar('costt_index', ((1 == $costt_index) ? 0 : 1));
		// Insert Data
		if($cost_typesHandler->insert($cost_typesObj, true)) {
			redirect_header('cost_types.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}

	break;
	case 'delete':
		$cost_typesObj = $cost_typesHandler->get($costtId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('cost_types.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($cost_typesHandler->delete($cost_typesObj)) {
				redirect_header('cost_types.php', 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $cost_typesObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'costt_id' => $costtId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $cost_typesObj->getVar('costt_text')));
		}

	break;
}
include __DIR__ . '/footer.php';
