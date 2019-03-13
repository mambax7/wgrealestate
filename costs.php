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
 * @version        $Id: 1.0 costs.php 1 Sun 2018-01-07 21:18:23Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgrealestate_costs.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';

$op    = XoopsRequest::getString('op', 'list');
$objId = XoopsRequest::getString('obj_id', 'list');

// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGREALESTATE_OBJECT, 'link' => WGREALESTATE_URL . '/objects.php?op=editmode&obj_id=' . $objId);
$xoBreadcrumbs[] = array('title' => _MA_WGREALESTATE_COSTS);

switch ($op) {
    case 'order':
        $order = XoopsRequest::getArray('corder', array());
        for ($i = 0, $iMax = count($order); $i < $iMax; $i++){
            $costsObj = $costsHandler->get($order[$i]);
            $costsObj->setVar('cost_weight',$i+1);
            $costsHandler->insert($costsObj, true);
        }
    break;
	case 'save':
		$counter = XoopsRequest::getInt('counter', 0);
        $count_errors = 0;
        
        for ($i = 1, $iMax = $counter; $i <= $iMax; $i++){
            $cost_id       = XoopsRequest::getInt('cost_id_' . $i, 0);
            $cost_costt_id = XoopsRequest::getInt('cost_costt_id_' . $i, 0);
			$cost_perc     = XoopsRequest::getString('cost_perc_' . $i, '');
			$cost_base     = XoopsRequest::getString('cost_base_' . $i, '');
            $cost_value    = XoopsRequest::getString('cost_value_' . $i, '');
            $cost_info     = XoopsRequest::getString('cost_info_' . $i, '');
            // echo "<br>i:".$i . " cost_id:" . $cost_id . " cost_costt_id:" . $cost_costt_id .  " cost_value:" . $cost_value . " cost_info:" . $cost_info;
            if (0 < $cost_id) { //cost exist
                $costsObj = $costsHandler->get($cost_id);
                if ('' == ($cost_value . $cost_info)) { //delete old cost
                    if (!$costsHandler->delete($costsObj, true)) {
                        // show error
                        $GLOBALS['xoopsTpl']->assign('error', $costsObj->getHtmlErrors());
                    }
                } else {  //update existing cost
                    $costsObj->setVar('cost_perc', $cost_perc);
					$costsObj->setVar('cost_base', $cost_base);
					$costsObj->setVar('cost_value', $cost_value);
                    $costsObj->setVar('cost_info', $cost_info);
                    if(!$costsHandler->insert($costsObj, true)) {
                        // show error
                        $GLOBALS['xoopsTpl']->assign('error', $costsObj->getHtmlErrors());
                    }
                }
            } else { //add new cost
                $costsObj = $costsHandler->create();
                // Set Vars
                $costsObj->setVar('cost_obj_id', $objId);
                $costsObj->setVar('cost_costt_id', $cost_costt_id);
                $costsObj->setVar('cost_info', $cost_info);
				$costsObj->setVar('cost_perc', $cost_perc);
				$costsObj->setVar('cost_base', $cost_base);
                $costsObj->setVar('cost_value', $cost_value);
                $costsObj->setVar('cost_weight', $counter + 1);
                $costsObj->setVar('cost_datecreate', time());
                $costsObj->setVar('cost_submitter', $xoopsUser->getVar('uid'));
                // Insert Data
                if(!$costsHandler->insert($costsObj, true)) {
                    // show error
                    $GLOBALS['xoopsTpl']->assign('error', $costsObj->getHtmlErrors());
                    $count_errors++;
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
            redirect_header('index.php', 3, 'invalid object id at costs'); 
        }
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet( $style, null );
        // 
        $form = $costsHandler->getFormCostsUser($objId);
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        // Description
        wgrealestateMetaDescription(_MA_WGREALESTATE_COSTS_TITLE);
    break;
}
include __DIR__ . '/footer.php';
