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
include_once XOOPS_ROOT_PATH.'/modules/wgrealestate/include/common.php';
// Function show block
function b_wgrealestate_objects_show($options)
{
    include_once XOOPS_ROOT_PATH.'/modules/wgrealestate/class/objects.php';
    $myts = MyTextSanitizer::getInstance();
    $GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
	$GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
	$GLOBALS['xoopsTpl']->assign('wgrealestate_obj_image_url', WGREALESTATE_UPLOAD_IMAGE_URL);
	$GLOBALS['xoTheme']->addStylesheet( WGREALESTATE_URL . '/assets/css/style.css', null );

    $block       = array();
    $typeBlock   = $options[0];
    $limit       = $options[1];
    $lenghtTitle = $options[2];
    $wgrealestate = WgrealestateHelper::getInstance();
    $objectsHandler = $wgrealestate->getHandler('objects');
    
    array_shift($options);
    array_shift($options);
    array_shift($options);
	
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('obj_state', 1));//WGREALESTATE_STATE_ONLINE_VAL
	$criteria->setSort('obj_datecreate');
	$criteria->setOrder('DESC');
    $criteria->setLimit($limit);
    $objectsAll = $objectsHandler->getAll($criteria);
	$objectsCount = $objectsHandler->getCount($criteria);
	unset($criteria);
    foreach(array_keys($objectsAll) as $i)
    {
        $block[$i] = $objectsAll[$i]->getValuesObjectsBlock();
    }
    return $block;
}

// Function edit block
function b_wgrealestate_objects_edit($options)
{
    include_once XOOPS_ROOT_PATH.'/modules/wgrealestate/class/objects.php';
    $wgrealestate = WgrealestateHelper::getInstance();
    $objectsHandler = $wgrealestate->getHandler('objects');
    $GLOBALS['xoopsTpl']->assign('wgrealestate_upload_url', WGREALESTATE_UPLOAD_URL);
    $form  = _MB_WGREALESTATE_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='".$options[0]."' />";
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' />&nbsp;<br>";
    $form .= _MB_WGREALESTATE_TITLE_LENGTH." : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' /><br><br>";
    array_shift($options);
    array_shift($options);
    array_shift($options);
    return $form;
}