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
$GLOBALS['xoopsOption']['template_main'] = 'wgrealestate_images.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';

$op    = XoopsRequest::getString('op', 'none');
$objId = XoopsRequest::getInt('obj_id', 0);
$imgId = XoopsRequest::getInt('img_id', 0);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );

$GLOBALS['xoTheme']->addScript(WGREALESTATE_URL . '/assets/js/sortable.js');
$GLOBALS['xoTheme']->addScript(WGREALESTATE_URL . '/assets/js/jquery-ui.min.js');

// 
$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url_16', WGREALESTATE_ICONS_URL . '/16/');
$GLOBALS['xoopsTpl']->assign('wgrealestate_obj_image_url', WGREALESTATE_UPLOAD_IMAGE_URL.'/objects/' . $objId . '/');
$GLOBALS['xoopsTpl']->assign('panel_type', $wgrealestate->getConfig('panel_type'));
// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGREALESTATE_OBJECT, 'link' => WGREALESTATE_URL . '/objects.php?op=editmode&obj_id=' . $objId);
$xoBreadcrumbs[] = array('title' => _CO_WGREALESTATE_IMAGES); 

// assign rights of current user
if ($isModerator) {
    $GLOBALS['xoopsTpl']->assign('isModerator', true);
    if ('edit' === $op) {
        $GLOBALS['xoopsTpl']->assign('editmode', true);
    }    
}

switch ($op) {
    case 'order':
        $order = XoopsRequest::getArray('iorder', array());
        for ($i = 0, $iMax = count($order); $i < $iMax; $i++){
            $imagesObj = $imagesHandler->get($order[$i]);
            $imagesObj->setVar('img_weight',$i+1);
            $imagesHandler->insert($imagesObj, true);
        }
        break;
    case 'delete':
		$imagesObj = $imagesHandler->get($imgId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('images.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
            $img_name = $imagesObj->getVar('img_name');
			if($imagesHandler->delete($imagesObj)) {
                // delete image files
                $image = WGREALESTATE_UPLOAD_IMAGE_PATH.'/objects/' . $objId . '/medium/' . $img_name;
                unlink($image);
                $image = WGREALESTATE_UPLOAD_IMAGE_PATH.'/objects/' . $objId . '/small/' . $img_name;
                unlink($image);
                
                redirect_header('images.php?op=edit&amp;obj_id=' . $objId, 3, _CO_WGREALESTATE_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
			}
		} else {
			$confirm_delete = xoops_confirm(array('ok' => 1, 'img_id' => $imgId,'obj_id' => $objId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGREALESTATE_FORM_SURE_DELETE, $imagesObj->getVar('img_name')), '', true, true);
            $GLOBALS['xoopsTpl']->assign('confirm_delete', $confirm_delete);
		}

	break;
    case 'edit_single':
		// Get Form
		$imagesObj = $imagesHandler->get($imgId);
		$form = $imagesObj->getFormImages();
        $GLOBALS['xoopsTpl']->assign('editmode',false);
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
    break;
    case 'new':
		// Get Form
        $GLOBALS['xoopsTpl']->assign('editmode',false);
		$imagesObj = $imagesHandler->create();
        $imagesObj->setVar('img_obj_id', $objId);
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
            $imagesHandler->resizeImage($sourcefile, $wgrealestate->getConfig('maxwidth_image_md'), $wgrealestate->getConfig('maxheight_image_md'), $sourcefile, $type, $end_width, $end_height);
        }

		// Set Vars
        $imgObjId = XoopsRequest::getInt('img_obj_id', 0);
		$imagesObj->setVar('img_obj_id', $imgObjId);
		// Set Var img_name
		include_once XOOPS_ROOT_PATH .'/class/uploader.php';
		$uploader = new XoopsMediaUploader(WGREALESTATE_UPLOAD_IMAGE_PATH.'/objects/' . $imgObjId . '/medium/',
													$wgrealestate->getConfig('mimetypes_image'), 
													$wgrealestate->getConfig('maxsize'), null, null);
		if($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$extension = preg_replace('/^.+\.([^.]+)$/sU', '', $_FILES['attachedfile']['name']);
			$imgName = str_replace(' ', '', time()).'.'.$extension;
            
            $sourcefile= $_FILES['attachedfile']['name'];
			$uploader->setPrefix($imgName);
            $xoops_upload_file = $_POST['xoops_upload_file'][0];
			$uploader->fetchMedia($xoops_upload_file);
			if(!$uploader->upload()) {
				$errors = $uploader->getErrors();
				redirect_header('javascript:history.go(-1).php', 3, $errors);
			} else {
				$imgSavedFileName = $uploader->getSavedFileName();
                $imagesObj->setVar('img_name', $imgSavedFileName);
                $imgFileSize = filesize ( WGREALESTATE_UPLOAD_IMAGE_PATH.'/objects/' . $imgObjId . '/medium/' . $imgSavedFileName );
                // create thumb and copy to folder 'small'
                $sourcefile = WGREALESTATE_UPLOAD_IMAGE_PATH.'/objects/' . $imgObjId . '/medium/' . $imgSavedFileName;
                $endfile    = WGREALESTATE_UPLOAD_IMAGE_PATH.'/objects/' . $imgObjId . '/small/' . $imgSavedFileName;
                $end_width_xs = 0;
                $end_height_xs = 0;  
                $imagesHandler->resizeThumb($sourcefile, $wgrealestate->getConfig('maxwidth_image_xs'), $wgrealestate->getConfig('maxheight_image_xs'), $endfile, $type);
    
			}
		} else {
		    $errors = $uploader->getErrors();
            $imagesObj->setVar('img_name', XoopsRequest::getString('img_name'));
		}
            
		$imagesObj->setVar('img_title', XoopsRequest::getString('img_title'));
        $imagesObj->setVar('img_info',  XoopsRequest::getString('img_info'));
        if ( 0 <  $end_width) {
            $imagesObj->setVar('img_width', $end_width);
            $imagesObj->setVar('img_height', $end_height);
            $imagesObj->setVar('img_size', $imgFileSize);
        }
        $imagesObj->setVar('img_weight', XoopsRequest::getInt('img_weight', 0));
        $imagesObj->setVar('img_cat', XoopsRequest::getInt('img_cat', 0));
		//$imageDatecreate = date_create_from_format(_SHORTDATESTRING, $_POST['img_datecreate']);
		// $imagesObj->setVar('img_datecreate', $imageDatecreate->getTimestamp());
        $imagesObj->setVar('img_datecreate', time());
		$imagesObj->setVar('img_submitter', $xoopsUser->getVar('uid'));
        if (empty($errors) || 0 < $imgId) {
            // Insert Data
            if($imagesHandler->insert($imagesObj, true)) {
                redirect_header('images.php?op=edit&amp;obj_id=' . $imgObjId, 2, _CO_WGREALESTATE_FORM_OK);
            }
            $GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
        } else {
            $GLOBALS['xoopsTpl']->assign('error', $errors);
        }
    break;
    case 'list':
    default:
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('img_obj_id', $objId));
        $criteria->setSort('img_weight');
        $criteria->setOrder('ASC');
        $imagesCount = $imagesHandler->getCount($criteria);
        $imagesAll = $imagesHandler->getAll($criteria);

        if( 0 < $imagesCount ) {
            $images = array();
            // Get All Images
            foreach(array_keys($imagesAll) as $i) {
                $images[] = $imagesAll[$i]->getValuesImages();
            }
            $GLOBALS['xoopsTpl']->assign('images', $images);
            unset($images);
        }
        $GLOBALS['xoopsTpl']->assign('obj_id', $objId);
        
        // Description
        wgrealestateMetaDescription(_CO_WGREALESTATE_IMAGES_TITLE);

    break;
}
include __DIR__ . '/footer.php';
