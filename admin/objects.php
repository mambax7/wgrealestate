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
 * @version        $Id: 1.0 objects.php 1 Sun 2018-01-07 21:18:22Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request obj_id
$objId = XoopsRequest::getInt('obj_id');
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('adminpager'));
		$templateMain = 'wgrealestate_admin_objects.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('objects.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_OBJECT, 'objects.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$objectsCount = $objectsHandler->getCountObjects();
		$objectsAll = $objectsHandler->getAllObjects($start, $limit);
		$GLOBALS['xoopsTpl']->assign('objects_count', $objectsCount);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		// Table view objects
		if($objectsCount > 0) {
			foreach(array_keys($objectsAll) as $i) {
				$object = $objectsAll[$i]->getValuesObjects();
				$GLOBALS['xoopsTpl']->append('objects_list', $object);
				unset($object);
			}
			// Display Navigation
			if($objectsCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($objectsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_OBJECTS);
		}

	break;
	case 'new':
		$templateMain = 'wgrealestate_admin_objects.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('objects.php'));
		$adminObject->addItemButton(_CO_WGREALESTATE_OBJECTS_LIST, 'objects.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$objectsObj = $objectsHandler->create();
		$form = $objectsObj->getFormObjects(false, false);
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('objects.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($objId)) {
			$objectsObj = $objectsHandler->get($objId);
		} else {
			$objectsObj = $objectsHandler->create();
		}
		// Set Vars
        $objectsObj->setVar('obj_title', $_POST['obj_title']);
		$objectsObj->setVar('obj_dealt_id', isset($_POST['obj_dealt_id']) ? $_POST['obj_dealt_id'] : 0);
		$objectsObj->setVar('obj_objcat_id', isset($_POST['obj_objcat_id']) ? $_POST['obj_objcat_id'] : 0);
		$objectsObj->setVar('obj_ctry', $_POST['obj_ctry'] == '-' ? '' : $_POST['obj_ctry']);
		$objectsObj->setVar('obj_postalcode', $_POST['obj_postalcode']);
		$objectsObj->setVar('obj_city', $_POST['obj_city']);
		$objectsObj->setVar('obj_address', $_POST['obj_address']);
		$objectsObj->setVar('obj_geo_lng', $_POST['obj_geo_lng']);
		$objectsObj->setVar('obj_geo_lat', $_POST['obj_geo_lat']);
		$objectsObj->setVar('obj_seller_id', isset($_POST['obj_seller_id']) ? $_POST['obj_seller_id'] : 0);
		$objectsObj->setVar('obj_descr', $_POST['obj_descr']);
		$objectsObj->setVar('obj_infos', $_POST['obj_infos']);
        $objectsObj->setVar('obj_location', $_POST['obj_location']);
		$objectsObj->setVar('obj_misc', $_POST['obj_misc']);
		$objectsObj->setVar('obj_views', $_POST['obj_views']);
		$objectsObj->setVar('obj_contacts', $_POST['obj_contacts']);
		$objectsObj->setVar('obj_state', isset($_POST['obj_state']) ? $_POST['obj_state'] : 0);
		$objectDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['obj_datecreate']);
		$objectsObj->setVar('obj_datecreate', $objectDatecreate->getTimestamp());
		$objectDatestate = date_create_from_format(_SHORTDATESTRING, $_POST['obj_datestate']);
		$objectsObj->setVar('obj_datestate', $objectDatestate->getTimestamp());
		$objectsObj->setVar('obj_submitter', isset($_POST['obj_submitter']) ? $_POST['obj_submitter'] : 0);
		// Insert Data
		if($objectsHandler->insert($objectsObj)) {
			if( 0 === $objId) {
                $objId = $objectsHandler->getInsertId();
                // check upload path
                $wgrealestate_upload_images = WGREALESTATE_UPLOAD_IMAGE_PATH . '/objects/' . $objId . '/medium';
                if(!is_dir($wgrealestate_upload_images)) {
                    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
                    $blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
                    mkdir($wgrealestate_upload_images, 0777);
                    chmod($wgrealestate_upload_images, 0777);
                    copy($indexFile, $wgrealestate_upload_images . '/index.html');
                    copy($blankFile, $wgrealestate_upload_images . '/blank.gif');
                }
                $wgrealestate_upload_images = WGREALESTATE_UPLOAD_IMAGE_PATH . '/objects/' . $objId . '/small';
                if(!is_dir($wgrealestate_upload_images)) {
                    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
                    $blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
                    mkdir($wgrealestate_upload_images, 0777);
                    chmod($wgrealestate_upload_images, 0777);
                    copy($indexFile, $wgrealestate_upload_images . '/index.html');
                    copy($blankFile, $wgrealestate_upload_images . '/blank.gif');
                }
            }
            redirect_header('objects.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $objectsObj->getHtmlErrors());
		$form = $objectsObj->getFormObjects();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wgrealestate_admin_objects.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('objects.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_OBJECT, 'objects.php?op=new', 'add');
		$adminObject->addItemButton(_CO_WGREALESTATE_OBJECTS_LIST, 'objects.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$objectsObj = $objectsHandler->get($objId);
		$form = $objectsObj->getFormObjects(false, false);
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$objectsObj = $objectsHandler->get($objId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('objects.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($objectsHandler->delete($objectsObj)) {
				redirect_header('objects.php', 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $objectsObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'obj_id' => $objId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $objectsObj->getVar('obj_title')));
		}

	break;
}
include __DIR__ . '/footer.php';
