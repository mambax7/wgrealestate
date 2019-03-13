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
 * @version        $Id: 1.0 attdefaults.php 1 Sun 2018-01-07 21:18:20Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');

// Request attdef_id
$attrId = XoopsRequest::getInt('attdef_id');
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('adminpager'));
		$templateMain = 'wgrealestate_admin_attdefaults.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('attdefaults.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_ATTDEFAULTS, 'attdefaults.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$attdefaultsCount = $attdefaultsHandler->getCountAttdefaults();
		$attdefaultsAll = $attdefaultsHandler->getAllAttdefaults($start, $limit);
		$GLOBALS['xoopsTpl']->assign('attdefaults_count', $attdefaultsCount);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url_16', WGREALESTATE_ICONS_URL . '/16/');
		// Table view attdefaults
		if($attdefaultsCount > 0) {
			foreach(array_keys($attdefaultsAll) as $i) {
				$attdefault = $attdefaultsAll[$i]->getValueAttdefaults();
				$GLOBALS['xoopsTpl']->append('attdefaults_list', $attdefault);
				unset($attdefault);
			}
			// Display Navigation
			if($attdefaultsCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($attdefaultsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_ATTDEFAULTS);
		}

	break;
	case 'new':
		$templateMain = 'wgrealestate_admin_attdefaults.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('attdefaults.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ATTDEFAULTS_LIST, 'attdefaults.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$attdefaultsObj = $attdefaultsHandler->create();
		$form = $attdefaultsObj->getFormAttdefaults();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit_valid':
		if( 0 < $attrId ) {
			$attdefaultsObj = $attdefaultsHandler->get($attrId);
		} else {
			redirect_header('attdefaults.php', 3, _CO_WGREALESTATE_ERROR_NO_VALID_OBJID);
		}
		$attdef_valid = XoopsRequest::getInt('attdef_valid', 0);
		$attdefaultsObj->setVar('attdef_valid', ((1 == $attdef_valid) ? 0 : 1));
		// Insert Data
		if($attdefaultsHandler->insert($attdefaultsObj, true)) {
			redirect_header('attdefaults.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('attdefaults.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if( 0 < $attrId ) {
			$attdefaultsObj = $attdefaultsHandler->get($attrId);
		} else {
			$attdefaultsObj = $attdefaultsHandler->create();
		}
		// Set Vars
		$attdefaultsObj->setVar('attdef_parent', $_POST['attdef_parent']);
		$attdefaultsObj->setVar('attdef_name', $_POST['attdef_name']);
		$attdefaultsObj->setVar('attdef_dealtid', isset($_POST['attdef_dealtid']) ? $_POST['attdef_dealtid'] : 0);
        $attdefaultsObj->setVar('attdef_attcatid', $_POST['attdef_attcatid']);
		$attdef_type = (0 < $_POST['attdef_parent']) ? WGREALESTATE_ATTR_SELECT_ITEM_VAL : $_POST['attdef_type'];
		$attdefaultsObj->setVar('attdef_type', $attdef_type);
		$attdefaultsObj->setVar('attdef_index', $_POST['attdef_index']);
        $attdefaultsObj->setVar('attdef_weight', isset($_POST['attdef_weight']) ? $_POST['attdef_weight'] : 0);
		$attdefaultsObj->setVar('attdef_valid', ((1 == $_POST['attdef_valid']) ? '1' : '0'));
		$attdefaultDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['attdef_datecreate']);
		$attdefaultsObj->setVar('attdef_datecreate', $attdefaultDatecreate->getTimestamp());
		$attdefaultsObj->setVar('attdef_submitter', isset($_POST['attdef_submitter']) ? $_POST['attdef_submitter'] : 0);
		// Insert Data
		if($attdefaultsHandler->insert($attdefaultsObj, true)) {
            // set new weight for all attdefaults
            $counter = 0;
            $criteria = new CriteriaCompo();
            $criteria->setSort('attdef_attcatid ASC, attdef_weight');
            $criteria->setOrder('ASC');
            $attdefaultsAll = $attdefaultsHandler->getAll($criteria);
            foreach(array_keys($attdefaultsAll) as $i) {
                unset($attdefaultsObj);
                $counter++;
                $attdefaultsObj = $attdefaultsHandler->get($i);
                $attdefaultsObj->setVar('attdef_weight', $counter);
                $attdefaultsHandler->insert($attdefaultsObj, true);
            }
            unset($attdefaultsObj);
			redirect_header('attdefaults.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $attdefaultsObj->getHtmlErrors());
		$form = $attdefaultsObj->getFormAttdefaults();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wgrealestate_admin_attdefaults.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('attdefaults.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_ATTDEFAULTS, 'attdefaults.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGREALESTATE_ATTDEFAULTS_LIST, 'attdefaults.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$attdefaultsObj = $attdefaultsHandler->get($attrId);
		$form = $attdefaultsObj->getFormAttdefaults();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$attdefaultsObj = $attdefaultsHandler->get($attrId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('attdefaults.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($attdefaultsHandler->delete($attdefaultsObj)) {
				redirect_header('attdefaults.php', 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $attdefaultsObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'attdef_id' => $attrId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $attdefaultsObj->getVar('attdef_name')));
		}

	break;
    case 'order':
        $order = XoopsRequest::getArray('attdeforder', array());
        for ($i = 0, $iMax = count($order); $i < $iMax; $i++){
            $attdefaultsObj = $attdefaultsHandler->get($order[$i]);
            $attdefaultsObj->setVar('attdef_weight',$i+1);
            $attdefaultsHandler->insert($attdefaultsObj, true);
        }
    break;
}
include __DIR__ . '/footer.php';
