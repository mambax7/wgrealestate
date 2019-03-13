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
 * @version        $Id: 1.0 files.php 1 Sun 2018-01-07 21:18:23Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgrealestate_files.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';

$op    = XoopsRequest::getString('op', 'none');
$objId = XoopsRequest::getInt('obj_id', 0);
$fileId = XoopsRequest::getInt('file_id', 0);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );

$GLOBALS['xoTheme']->addScript(WGREALESTATE_URL . '/assets/js/sortable.js');
$GLOBALS['xoTheme']->addScript(WGREALESTATE_URL . '/assets/js/jquery-ui.min.js');
// 
$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url_16', WGREALESTATE_ICONS_URL . '/16/');
$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url', WGREALESTATE_ICONS_URL);
$GLOBALS['xoopsTpl']->assign('wgrealestate_obj_file_url', WGREALESTATE_UPLOAD_FILES_URL.'/objects/' . $objId . '/');
$GLOBALS['xoopsTpl']->assign('panel_type', $wgrealestate->getConfig('panel_type'));

// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGREALESTATE_OBJECT, 'link' => WGREALESTATE_URL . '/objects.php?op=editmode&obj_id=' . $objId);
$xoBreadcrumbs[] = array('title' => _CO_WGREALESTATE_FILES);

// assign rights of current user
if ($isModerator) {
    $GLOBALS['xoopsTpl']->assign('isModerator', true);
    if ('edit' === $op) {
        $GLOBALS['xoopsTpl']->assign('editmode', true);
    }    
}

switch ($op) {
    case 'order':
        $order = XoopsRequest::getArray('forder', array());
        for ($i = 0, $iMax = count($order); $i < $iMax; $i++){
            $filesObj = $filesHandler->get($order[$i]);
            $filesObj->setVar('file_weight',$i+1);
            $filesHandler->insert($filesObj, true);
        }
        break;
	case 'delete':
		$filesObj = $filesHandler->get($fileId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('files.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
            $file_name = $filesObj->getVar('file_name');
			if($filesHandler->delete($filesObj)) {
                // delete file files
                $file = WGREALESTATE_UPLOAD_FILES_PATH.'/objects/' . $objId . '/' . $file_name;
                unlink($file);
                $file = WGREALESTATE_UPLOAD_FILES_PATH.'/objects/' . $objId . '/' . $file_name;
                unlink($file);
                
                redirect_header('files.php?op=edit&amp;obj_id=' . $objId, 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $filesObj->getHtmlErrors());
			}
		} else {
			$confirm_delete = xoops_confirm(array('ok' => 1, 'file_id' => $fileId,'obj_id' => $objId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $filesObj->getVar('file_title')), '', true, true);
            $GLOBALS['xoopsTpl']->assign('confirm_delete', $confirm_delete);
		}

	break;
    case 'edit_single':
		// Get Form
		$filesObj = $filesHandler->get($fileId);
		$form = $filesObj->getFormFiles();
        $GLOBALS['xoopsTpl']->assign('editmode',false);
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
    break;
    case 'new':
		// Get Form
        $GLOBALS['xoopsTpl']->assign('editmode',false);
		$filesObj = $filesHandler->create();
        $filesObj->setVar('file_obj_id', $objId);
		$form = $filesObj->getFormFiles();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
    break;
    case 'save':
        // Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('files.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($fileId)) {
			$filesObj = $filesHandler->get($fileId);
		} else {
			$filesObj = $filesHandler->create();
		}
		
		// Set Vars
        $fileObjId =  XoopsRequest::getInt('file_obj_id', 0);
		$filesObj->setVar('file_obj_id', $fileObjId);
		$filesObj->setVar('file_title', XoopsRequest::getString('file_title'));
        $filesObj->setVar('file_info',  XoopsRequest::getString('file_info'));

        $type = '';
        $size = '';

		// Set Var file_name
		include_once XOOPS_ROOT_PATH .'/class/uploader.php';
		$uploader = new XoopsMediaUploader(WGREALESTATE_UPLOAD_FILES_PATH.'/objects/' . $fileObjId . '/', '', 
													$wgrealestate->getConfig('maxsize'), null, null);
		if($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$extension = preg_replace('/^.+\.([^.]+)$/sU', '', $_FILES['file_name']['name']);
			$fileName = str_replace(' ', '', time()).'.'.$extension;
            
			$type = $_FILES['file_name']['type'];
            $size = $_FILES['file_name']['size'];
			$uploader->setPrefix($fileName);
            $xoops_upload_file = $_POST['xoops_upload_file'][0];
			$uploader->fetchMedia($xoops_upload_file);
			if(!$uploader->upload()) {
				$errors = $uploader->getErrors();
				redirect_header('javascript:history.go(-1).php', 3, $errors);
			} else {
				$fileSavedFileName = $uploader->getSavedFileName();
                $filesObj->setVar('file_name', $fileSavedFileName);
				$filesObj->setVar('file_type', $type);
                $filesObj->setVar('file_size', $size);
			}
		} else {
		    $errors = $uploader->getErrors();
            $filesObj->setVar('file_name', XoopsRequest::getString('file_name'));
			$filesObj->setVar('file_type', XoopsRequest::getString('file_type'));
            $filesObj->setVar('file_size', XoopsRequest::getInt('file_size', 0));
		}

        $filesObj->setVar('file_weight', XoopsRequest::getInt('file_weight', 0));
        $filesObj->setVar('file_datecreate', time());
		$filesObj->setVar('file_submitter', $xoopsUser->getVar('uid'));
        if (empty($errors) || 0 < $fileId) {
            // Insert Data
            if($filesHandler->insert($filesObj, true)) {
                redirect_header('files.php?op=edit&amp;obj_id=' . $fileObjId, 2, _CO_WGREALESTATE_FORM_OK);
            }
            $GLOBALS['xoopsTpl']->assign('error', $filesObj->getHtmlErrors());
        } else {
            $GLOBALS['xoopsTpl']->assign('error', $errors);
        }
    break;
    case 'list':
    default:
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('file_obj_id', $objId));
        $criteria->setSort('file_weight');
        $criteria->setOrder('ASC');
        $filesCount = $filesHandler->getCount($criteria);
        $filesAll = $filesHandler->getAll($criteria);

        if( 0 < $filesCount ) {
            $files = array();
            // Get All Files
            foreach(array_keys($filesAll) as $i) {
                $files[] = $filesAll[$i]->getValuesFiles();
            }
            $GLOBALS['xoopsTpl']->assign('files', $files);
            unset($files);
        }
        $GLOBALS['xoopsTpl']->assign('obj_id', $objId);
       

        // Description
        wgrealestateMetaDescription(_CO_WGREALESTATE_FILES_TITLE);

    break;
}
include __DIR__ . '/footer.php';
