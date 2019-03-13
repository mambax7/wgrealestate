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
 * @version        $Id: 1.0 sellers.php 1 Sun 2018-01-07 21:18:23Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'list');

$GLOBALS['xoTheme']->addStylesheet( $style, null );
$templateMain = 'wgrealestate_admin_maintainance.tpl';
$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url_32', WGREALESTATE_ICONS_URL . '/32/');
        
switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		
		$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
		$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
		
        $GLOBALS['xoopsTpl']->assign('list', true);


	break;
	case 'checkfolderobj':
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('maintainance.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_MAINTAINANCE_LIST, 'maintainance.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $objectsCount = $objectsHandler->getCountObjects();
		$objectsAll = $objectsHandler->getAll();
		// Table view objects
        $count_repair = 0;
		if($objectsCount > 0) {
			foreach(array_keys($objectsAll) as $i) {
				$objId = $objectsAll[$i]->getVar('obj_id');
				// check upload path images
				$wgrealestate_upload_images = WGREALESTATE_UPLOAD_IMAGE_PATH . '/objects/' . $objId;
                if(!is_dir($wgrealestate_upload_images)) {
                    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
                    $blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
                    mkdir($wgrealestate_upload_images, 0777);
                    chmod($wgrealestate_upload_images, 0777);
                    copy($indexFile, $wgrealestate_upload_images . '/index.html');
                    copy($blankFile, $wgrealestate_upload_images . '/blank.gif');
                    $count_repair++;
                }
                $wgrealestate_upload_images = WGREALESTATE_UPLOAD_IMAGE_PATH . '/objects/' . $objId . '/medium';
                if(!is_dir($wgrealestate_upload_images)) {
                    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
                    $blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
                    mkdir($wgrealestate_upload_images, 0777);
                    chmod($wgrealestate_upload_images, 0777);
                    copy($indexFile, $wgrealestate_upload_images . '/index.html');
                    copy($blankFile, $wgrealestate_upload_images . '/blank.gif');
                    $count_repair++;
                }
                $wgrealestate_upload_images = WGREALESTATE_UPLOAD_IMAGE_PATH . '/objects/' . $objId . '/small';
                if(!is_dir($wgrealestate_upload_images)) {
                    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
                    $blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
                    mkdir($wgrealestate_upload_images, 0777);
                    chmod($wgrealestate_upload_images, 0777);
                    copy($indexFile, $wgrealestate_upload_images . '/index.html');
                    copy($blankFile, $wgrealestate_upload_images . '/blank.gif');
                    $count_repair++;
                }
				// check upload path files
                $wgrealestate_upload_images = WGREALESTATE_UPLOAD_FILES_PATH . '/objects/' . $objId;
                if(!is_dir($wgrealestate_upload_images)) {
                    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
                    mkdir($wgrealestate_upload_images, 0777);
                    chmod($wgrealestate_upload_images, 0777);
                    copy($indexFile, $wgrealestate_upload_images . '/index.html');
                    $count_repair++;
                }
			}
            unset($objectsAll);
            $GLOBALS['xoopsTpl']->assign('maintain_type', _AM_WGREALESTATE_MAINTAIN_CHECK_FOLDER_OBJ);
            $GLOBALS['xoopsTpl']->assign('maintain_result', _AM_WGREALESTATE_MAINTAIN_CHECK_FOLDER_OBJ_RES);
            $GLOBALS['xoopsTpl']->assign('maintain_count', $count_repair);
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_OBJECTS);
		}
	break;
    case 'resizethumbs':
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('maintainance.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_MAINTAINANCE_LIST, 'maintainance.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));

        $count_repair = 0;
        $imagesCount = $imagesHandler->getCount();
        $imagesAll = $imagesHandler->getAll();
        if( 0 < $imagesCount ) {
            // Get All Images
            foreach(array_keys($imagesAll) as $i) {
                $imgName = $imagesAll[$i]->getVar('img_name');
                $objId   = $imagesAll[$i]->getVar('img_obj_id');
                $wgrealestate_upload_images = WGREALESTATE_UPLOAD_IMAGE_PATH . '/objects/' . $objId . '/small/';
                $sourcefile    = $wgrealestate_upload_images . $imgName;
                // echo "<br>resize " . $sourcefile;
                $endfile       = $sourcefile;
                $type          = mime_content_type ( $sourcefile );
                $imagesHandler->resizeThumb($sourcefile, $wgrealestate->getConfig('maxwidth_image_xs'), $wgrealestate->getConfig('maxheight_image_xs'), $endfile, $type);
                $count_repair++;

            }
            unset($imagesAll);
            $GLOBALS['xoopsTpl']->assign('maintain_type', _AM_WGREALESTATE_MAINTAIN_RESIZE_THUMBS);
            $GLOBALS['xoopsTpl']->assign('maintain_result', _AM_WGREALESTATE_MAINTAIN_RESIZE_THUMBS_RES);
            $GLOBALS['xoopsTpl']->assign('maintain_count', $count_repair);
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _CO_WGREALESTATE_THEREARENT_IMAGES);
		}
	break;
	case 'invalid_objid':
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('maintainance.php'));
		$adminObject->addItemButton(_AM_WGREALESTATE_MAINTAINANCE_LIST, 'maintainance.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$count_repair = 0;
		$count_error = 0;
		// delete attributes without existing object
		$sql = 'DELETE ' . $xoopsDB->prefix('wgrealestate_attributes') . '.* FROM ' . $xoopsDB->prefix('wgrealestate_attributes') . ' LEFT JOIN ' . $xoopsDB->prefix('wgrealestate_objects') . ' ON ' . $xoopsDB->prefix('wgrealestate_attributes') . '.att_objid = ' . $xoopsDB->prefix('wgrealestate_objects') . '.obj_id WHERE (((' . $xoopsDB->prefix('wgrealestate_objects') . '.obj_id) Is Null));';
		if ($result = $GLOBALS['xoopsDB']->queryF($sql)) {
			$count_repair += $GLOBALS['xoopsDB']->getAffectedRows();
		} else {
			$count_error++;
        }
		// delete costs without existing object
		$sql = 'DELETE ' . $xoopsDB->prefix('wgrealestate_costs') . '.* FROM ' . $xoopsDB->prefix('wgrealestate_costs') . ' LEFT JOIN ' . $xoopsDB->prefix('wgrealestate_objects') . ' ON ' . $xoopsDB->prefix('wgrealestate_costs') . '.cost_obj_id = ' . $xoopsDB->prefix('wgrealestate_objects') . '.obj_id WHERE (((' . $xoopsDB->prefix('wgrealestate_objects') . '.obj_id) Is Null));';
		if ($result = $GLOBALS['xoopsDB']->queryF($sql)) {
			$count_repair += $GLOBALS['xoopsDB']->getAffectedRows();
		} else {
			$count_error++;
        }
		// delete files without existing object
		$sql = 'DELETE ' . $xoopsDB->prefix('wgrealestate_files') . '.* FROM ' . $xoopsDB->prefix('wgrealestate_files') . ' LEFT JOIN ' . $xoopsDB->prefix('wgrealestate_objects') . ' ON ' . $xoopsDB->prefix('wgrealestate_files') . '.file_obj_id = ' . $xoopsDB->prefix('wgrealestate_objects') . '.obj_id WHERE (((' . $xoopsDB->prefix('wgrealestate_objects') . '.obj_id) Is Null));';
		if ($result = $GLOBALS['xoopsDB']->queryF($sql)) {
			$count_repair += $GLOBALS['xoopsDB']->getAffectedRows();
		} else {
			$count_error++;
		}
		
		// delete images without existing object
		$sql = 'DELETE ' . $xoopsDB->prefix('wgrealestate_images') . '.* FROM ' . $xoopsDB->prefix('wgrealestate_images') . ' LEFT JOIN ' . $xoopsDB->prefix('wgrealestate_objects') . ' ON ' . $xoopsDB->prefix('wgrealestate_images') . '.img_obj_id = ' . $xoopsDB->prefix('wgrealestate_objects') . '.obj_id WHERE (((' . $xoopsDB->prefix('wgrealestate_objects') . '.obj_id) Is Null));';
		if ($result = $GLOBALS['xoopsDB']->queryF($sql)) {
			$count_repair += $GLOBALS['xoopsDB']->getAffectedRows();
		} else {
			$count_error++;
        }
		$GLOBALS['xoopsTpl']->assign('maintain_type', _AM_WGREALESTATE_MAINTAIN_OBJIDS);
		$GLOBALS['xoopsTpl']->assign('maintain_result', _AM_WGREALESTATE_MAINTAIN_OBJIDS_RES);
		$GLOBALS['xoopsTpl']->assign('maintain_count', $count_repair);   
	
	break;
}
include __DIR__ . '/footer.php';
