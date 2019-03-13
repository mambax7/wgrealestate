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
 * @version        $Id: 1.0 attributes.php 1 Sun 2018-01-07 21:18:20Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request att_id
$objattId = XoopsRequest::getInt('att_id');
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('adminpager'));
		$templateMain = 'wgrealestate_admin_attributes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('attributes.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_ATTRIBUTES, 'attributes.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$attributesCount = $attributesHandler->getCountAttributes();
		$attributesAll = $attributesHandler->getAllAttributes($start, $limit);
		$GLOBALS['xoopsTpl']->assign('attributes_count', $attributesCount);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		// Table view attributes
		if($attributesCount > 0) {
			foreach(array_keys($attributesAll) as $i) {
				$attribute = $attributesAll[$i]->getValuesAttributes();
				$GLOBALS['xoopsTpl']->append('attributes_list', $attribute);
				unset($attribute);
			}
			// Display Navigation
			if($attributesCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($attributesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_ATTRIBUTES);
		}

	break;
	case 'new':
		$templateMain = 'wgrealestate_admin_attributes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('attributes.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ATTRIBUTES_LIST, 'attributes.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$attributesObj = $attributesHandler->create();
		$form = $attributesObj->getFormAttributes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('attributes.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($objattId)) {
			$attributesObj = $attributesHandler->get($objattId);
		} else {
			$attributesObj = $attributesHandler->create();
		}
		// Set Vars
		$attributesObj->setVar('att_objid', isset($_POST['att_objid']) ? $_POST['att_objid'] : 0);
		$attributesObj->setVar('att_attdefid', isset($_POST['att_attdefid']) ? $_POST['att_attdefid'] : 0);
		$attributesObj->setVar('att_info', $_POST['att_info']);
		$attributesObj->setVar('att_value', $_POST['att_value']);
		$attributesObj->setVar('att_weight', $_POST['att_weight']);
		$additionalDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['att_datecreate']);
		$attributesObj->setVar('att_datecreate', $additionalDatecreate->getTimestamp());
		$attributesObj->setVar('att_submitter', isset($_POST['att_submitter']) ? $_POST['att_submitter'] : 0);
		// Insert Data
		if($attributesHandler->insert($attributesObj)) {
			redirect_header('attributes.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $attributesObj->getHtmlErrors());
		$form = $attributesObj->getFormAttributes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wgrealestate_admin_attributes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('attributes.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_ATTRIBUTES, 'attributes.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGREALESTATE_ATTRIBUTES_LIST, 'attributes.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$attributesObj = $attributesHandler->get($objattId);
		$form = $attributesObj->getFormAttributes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$attributesObj = $attributesHandler->get($objattId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('attributes.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($attributesHandler->delete($attributesObj)) {
				redirect_header('attributes.php', 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $attributesObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'att_id' => $objattId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $attributesObj->getVar('att_objid')));
		}

	break;
    case 'order':
        $order = XoopsRequest::getArray('oaorder', array());
        for ($i = 0, $iMax = count($order); $i < $iMax; $i++){
            $attributesObj = $attributesHandler->get($order[$i]);
            $attributesObj->setVar('att_weight',$i+1);
            $attributesHandler->insert($attributesObj, true);
        }
    break;
}
include __DIR__ . '/footer.php';
