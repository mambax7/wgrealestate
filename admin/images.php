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
 * @version        $Id: 1.0 images.php 1 Sun 2018-01-07 21:18:23Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');
// Request img_id
$imgId = XoopsRequest::getInt('img_id');
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('adminpager'));
		$templateMain = 'wgrealestate_admin_images.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('images.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_IMAGE, 'images.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$imagesCount = $imagesHandler->getCountImages();
		$imagesAll = $imagesHandler->getAllImages($start, $limit);
		$GLOBALS['xoopsTpl']->assign('images_count', $imagesCount);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		// Table view images
		if($imagesCount > 0) {
			foreach(array_keys($imagesAll) as $i) {
				$image = $imagesAll[$i]->getValuesImages();
				$GLOBALS['xoopsTpl']->append('images_list', $image);
				unset($image);
			}
			// Display Navigation
			if($imagesCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($imagesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_IMAGES);
		}

	break;
	case 'new':
		$templateMain = 'wgrealestate_admin_images.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('images.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_IMAGES_LIST, 'images.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$imagesObj = $imagesHandler->create();
		$form = $imagesObj->getFormImages();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'save':

        // Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('images.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($imgId)) {
			$imagesObj = $imagesHandler->get($imgId);
		} else {
			$imagesObj = $imagesHandler->create();
		}
        
        // resize too big pictures
        if (!'' == $_FILES['attachedfile']['tmp_name']) {
            $sourcefile= $_FILES['attachedfile']['tmp_name'];
            $type = $_FILES['attachedfile']['type'];
            $end_width = 0;
            $end_height = 0;
            require_once WGREALESTATE_PATH .'/include/resize_image.php';
            resizeImage($sourcefile, $wgrealestate->getConfig('maxwidth_image_md'), $wgrealestate->getConfig('maxheight_image_md'), $sourcefile, $type,  $end_width, $end_height);
        }

		// Set Vars
        $imgObjId =  isset($_POST['img_obj_id']) ? $_POST['img_obj_id'] : 0;
		$imagesObj->setVar('img_obj_id', $imgObjId);
		// Set Var img_name
		include_once XOOPS_ROOT_PATH .'/class/uploader.php';
		$uploader = new XoopsMediaUploader(WGREALESTATE_UPLOAD_IMAGE_PATH.'/objects/' . $imgObjId . '/',
													$wgrealestate->getConfig('mimetypes'), 
													$wgrealestate->getConfig('maxsize'), null, null);
		if($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$extension = preg_replace('/^.+\.([^.]+)$/sU', '', $_FILES['attachedfile']['name']);
			$imgName = str_replace(' ', '', $_POST['img_obj_id']).'.'.$extension;
            
            $sourcefile= $_FILES['attachedfile']['name'];
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if(!$uploader->upload()) {
				$errors = $uploader->getErrors();
				redirect_header('javascript:history.go(-1).php', 3, $errors);
			} else {
				$imagesObj->setVar('img_name', $uploader->getSavedFileName());
			}
		} else {
		    $errors = $uploader->getErrors();
            $imagesObj->setVar('img_name', $_POST['img_name']);
		}
		$imagesObj->setVar('img_title',  isset($_POST['img_title']) ? $_POST['img_title'] : '-');
        if ( 0 <  $end_width) {
            $imagesObj->setVar('img_width', $end_width);
            $imagesObj->setVar('img_height', $end_height);
            $imagesObj->setVar('img_size', $end_height);
        }
        $imagesObj->setVar('img_weight', isset($_POST['img_weight']) ? $_POST['img_weight'] : 0);
        $imagesObj->setVar('img_cat', isset($_POST['img_cat']) ? $_POST['img_cat'] : 0);
		$imageDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['img_datecreate']);
		$imagesObj->setVar('img_datecreate', $imageDatecreate->getTimestamp());
		$imagesObj->setVar('img_submitter', isset($_POST['img_submitter']) ? $_POST['img_submitter'] : 0);
        if (empty($errors) || 0 < $imgId) {
            // Insert Data
            if($imagesHandler->insert($imagesObj, true)) {
                redirect_header('images.php?op=list', 2, _CO_WGREALESTATE_FORM_OK);
            }
            $GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
        } else {
            $GLOBALS['xoopsTpl']->assign('error', $errors);
        }
		// Get Form
		$form = $imagesObj->getFormImages();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wgrealestate_admin_images.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('images.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_ADD_IMAGE, 'images.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGREALESTATE_IMAGES_LIST, 'images.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$imagesObj = $imagesHandler->get($imgId);
		$form = $imagesObj->getFormImages(false, true);
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$imagesObj = $imagesHandler->get($imgId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('images.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($imagesHandler->delete($imagesObj)) {
				redirect_header('images.php', 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'img_id' => $imgId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $imagesObj->getVar('img_name')));
		}

	break;
}
include __DIR__ . '/footer.php';
