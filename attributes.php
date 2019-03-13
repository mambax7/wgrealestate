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
 * @version        $Id: 1.0 attributes.php 1 Sun 2018-01-07 21:18:21Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgrealestate_attributes.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';

$op    = XoopsRequest::getString('op', 'list');
$objId = XoopsRequest::getInt('obj_id', 0);

// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGREALESTATE_OBJECT, 'link' => WGREALESTATE_URL . '/objects.php?op=editmode&obj_id=' . $objId);
$xoBreadcrumbs[] = array('title' => _MA_WGREALESTATE_ATTRIBUTES);
		
switch ($op) {
    case 'order':
        $order = XoopsRequest::getArray('aorder', array());
        for ($i = 0, $iMax = count($order); $i < $iMax; $i++){
            $attributesObj = $attributesHandler->get($order[$i]);
            $attributesObj->setVar('att_weight',$i+1);
            $attributesHandler->insert($attributesObj, true);
        }
        break;
    case 'save':
        if ( 0 == $objId) {
            redirect_header('objects.php', 3, 'invalid object id at attributes');
        }
        $counter = XoopsRequest::getInt('counter', 0);
        $count_errors = 0;
        for ($i = 1, $iMax = $counter; $i <= $iMax; $i++){
            $att_id          = XoopsRequest::getInt('att_id_' . $i, 0);
            $attdef_id       = XoopsRequest::getInt('attdef_id_' . $i, 0);
            $attdef_type     = XoopsRequest::getInt('attdef_type_' . $i, 0);
            $attdef_attcatid = XoopsRequest::getInt('attdef_attcatid_' . $i, 0);
            $att_value = '';
            $att_info = '';
            $att_value       = XoopsRequest::getString('att_value_' . $i, '');
            $att_info        = XoopsRequest::getString('att_info_' . $i, '');
            // echo "<br>i:".$i . " att_id:" . $att_id ." att_value:" . $att_value  . " att_info:" . $att_info;
            if (0 < $att_id) { //attribute exist
                $attributesObj = $attributesHandler->get($att_id);
                if (('' === ($att_value . $att_info)) || (WGREALESTATE_ATTR_YN_VAL === $attdef_type && '' === $att_value)) { //delete old attribute
                    // echo " delete";
                    if (!$attributesHandler->delete($attributesObj, true)) {
                        // show error
                        $GLOBALS['xoopsTpl']->assign('error', $attributesObj->getHtmlErrors());
                    }
                } else {  //update existing attribute
                    // echo " update";
                    $attributesObj->setVar('att_value',$att_value);
                    $attributesObj->setVar('att_info',$att_info);
                    $attributesObj->setVar('att_attcatid',$attdef_attcatid);
                    if(!$attributesHandler->insert($attributesObj, true)) {
                        // show error
                        $GLOBALS['xoopsTpl']->assign('error', $attributesObj->getHtmlErrors());
                    }
                }
                unset($attributesObj);
            } else { //add new attribute
                if ('' !== ($att_value . $att_info)) { 
                    // echo " new";
                    $attributesObj = $attributesHandler->create();
                    // Set Vars
                    $attributesObj->setVar('att_objid', $objId);
                    $attributesObj->setVar('att_attdefid',$attdef_id);
                    $attributesObj->setVar('att_attcatid',$attdef_attcatid);
                    $attributesObj->setVar('att_info', $att_info);
                    $attributesObj->setVar('att_value', $att_value);
                    $attributesObj->setVar('att_weight', $counter + 1);
                    $attributesObj->setVar('att_datecreate', time());
                    $attributesObj->setVar('att_submitter', $xoopsUser->getVar('uid'));
                    // Insert Data
                    if(!$attributesHandler->insert($attributesObj, true)) {
                        // show error
                        $GLOBALS['xoopsTpl']->assign('error', $attributesObj->getHtmlErrors());
                        $count_errors++;
                    }
                    unset($attributesObj);
                // } else {
                     // echo " nix";
                }
            }
        }
        if ( 0 == $count_errors ) {
            redirect_header('objects.php?op=editmode&amp;obj_id=' . $objId, 2, _CO_WGREALESTATE_FORM_OK);
        }
        
    break;
    case 'list':
    default:
        if ( 0 == $objId) {  // normally not possible
            redirect_header('index.php', 3, 'invalid object id at attributes'); 
        }
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet( $style, null );
        // 
        $GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL); 
        $form = $attributesHandler->getFormAttributesUser($objId);
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        // Description
        wgrealestateMetaDescription(_MA_WGREALESTATE_ATTRIBUTES_TITLE);
    
    break;
}
include __DIR__ . '/footer.php';
