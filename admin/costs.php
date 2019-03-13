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
 * @version        $Id: 1.0 costs.php 1 Sun 2018-01-07 21:18:22Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request cost_id
$costId = XoopsRequest::getInt('cost_id');
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('adminpager'));
		$templateMain = 'wgrealestate_admin_costs.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('costs.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_COST, 'costs.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		
		$costsAll = $costsHandler->getAllCosts($start, $limit);
		$costsCount = $costsHandler->getCountCosts();
		$costsAll = $costsHandler->getAllCosts($start, $limit);
		$GLOBALS['xoopsTpl']->assign('costs_count', $costsCount);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		// Table view costs
		if($costsCount > 0) {
			foreach(array_keys($costsAll) as $i) {
				$cost = $costsAll[$i]->getValuesCosts();
				$GLOBALS['xoopsTpl']->append('costs_list', $cost);
				unset($cost);
			}
			// Display Navigation
			if($costsCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($costsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_COSTS);
		}

	break;
	case 'new':
		$templateMain = 'wgrealestate_admin_costs.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('costs.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_COSTS_LIST, 'costs.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$costsObj = $costsHandler->create();
		$form = $costsObj->getFormCosts();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		$cost_typesAll = $cost_typesHandler->getAll();
		foreach(array_keys($cost_typesAll) as $i) {
			$cost_type = $cost_typesAll[$i]->getValuesCost_types();
			$GLOBALS['xoopsTpl']->append('cost_types_list', $cost_type);
			unset($cost_type);
		}

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('costs.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($costId)) {
			$costsObj = $costsHandler->get($costId);
		} else {
			$costsObj = $costsHandler->create();
		}
		// Set Vars
		$costsObj->setVar('cost_obj_id', isset($_POST['cost_obj_id']) ? $_POST['cost_obj_id'] : 0);
		$costsObj->setVar('cost_costt_id', isset($_POST['cost_costt_id']) ? $_POST['cost_costt_id'] : 0);
		$costsObj->setVar('cost_perc', $_POST['cost_perc_1']);
		$costsObj->setVar('cost_base', $_POST['cost_base_1']);
		$costsObj->setVar('cost_value', $_POST['cost_value_1']);
		$costsObj->setVar('cost_info', $_POST['cost_info']);
        $costDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['cost_datecreate']);
		$costsObj->setVar('cost_datecreate', $costDatecreate->getTimestamp());
		$costsObj->setVar('cost_submitter', isset($_POST['cost_submitter']) ? $_POST['cost_submitter'] : 0);
		// Insert Data
		if($costsHandler->insert($costsObj)) {
			redirect_header('costs.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $costsObj->getHtmlErrors());
		$form = $costsObj->getFormCosts();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wgrealestate_admin_costs.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('costs.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_COST, 'costs.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGREALESTATE_COSTS_LIST, 'costs.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$costsObj = $costsHandler->get($costId);
		$form = $costsObj->getFormCosts();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		$cost_typesAll = $cost_typesHandler->getAll();
		foreach(array_keys($cost_typesAll) as $i) {
			$cost_type = $cost_typesAll[$i]->getValuesCost_types();
			$GLOBALS['xoopsTpl']->append('cost_types_list', $cost_type);
			unset($cost_type);
		}
	break;
	case 'delete':
		$costsObj = $costsHandler->get($costId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('costs.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($costsHandler->delete($costsObj)) {
				redirect_header('costs.php', 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $costsObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'cost_id' => $costId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $costsObj->getVar('cost_obj_id')));
		}

	break;
}
include __DIR__ . '/footer.php';
