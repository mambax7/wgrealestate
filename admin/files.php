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
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request file_id
$fileId = XoopsRequest::getInt('file_id');

switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('adminpager'));
		$templateMain = 'wgrealestate_admin_files.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('files.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_FILE, 'files.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$filesCount = $filesHandler->getCountFiles();
		$filesAll = $filesHandler->getAllFiles($start, $limit);
		$GLOBALS['xoopsTpl']->assign('files_count', $filesCount);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		// Table view files
		if($filesCount > 0) {
			foreach(array_keys($filesAll) as $i) {
				$file = $filesAll[$i]->getValuesFiles();
				$GLOBALS['xoopsTpl']->append('files_list', $file);
				unset($file);
			}
			// Display Navigation
			if($filesCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($filesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_FILES);
		}

	break;
	case 'new':
		$templateMain = 'wgrealestate_admin_files.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('files.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_FILES_LIST, 'files.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$filesObj = $filesHandler->create();
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
		$filesObj->setVar('file_obj_id', isset($_POST['file_obj_id']) ? $_POST['file_obj_id'] : 0);
		// Set Var file_name
		include_once XOOPS_ROOT_PATH .'/class/uploader.php';
		$uploader = new XoopsMediaUploader(WGREALESTATE_UPLOAD_FILES_PATH.'/files/files', 
													$wgrealestate->getConfig('mimetypes'), 
													$wgrealestate->getConfig('maxsize'), null, null);
		if($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
		} else {
			//$uploader->setPrefix('file_name_');
			//$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if(!$uploader->upload()) {
				$errors = $uploader->getErrors();
				redirect_header('javascript:history.go(-1).php', 3, $errors);
			} else {
				$filesObj->setVar('file_name', $uploader->getSavedFileName());
			}
		}
		$filesObj->setVar('file_weight', isset($_POST['file_weight']) ? $_POST['file_weight'] : 0);
		$fileDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['file_datecreate']);
		$filesObj->setVar('file_datecreate', $fileDatecreate->getTimestamp());
		$filesObj->setVar('file_submitter', isset($_POST['file_submitter']) ? $_POST['file_submitter'] : 0);
		// Insert Data
		if($filesHandler->insert($filesObj)) {
			redirect_header('files.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $filesObj->getHtmlErrors());
		$form = $filesObj->getFormFiles();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wgrealestate_admin_files.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('files.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_FILE, 'files.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGREALESTATE_FILES_LIST, 'files.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$filesObj = $filesHandler->get($fileId);
		$form = $filesObj->getFormFiles();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$filesObj = $filesHandler->get($fileId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('files.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($filesHandler->delete($filesObj)) {
				redirect_header('files.php', 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $filesObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'file_id' => $fileId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $filesObj->getVar('file_name')));
		}

	break;
}
include __DIR__ . '/footer.php';
