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
$GLOBALS['xoopsOption']['template_main'] = 'wgrealestate_objects.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';

$op    = XoopsRequest::getString('op', 'list');
$start = XoopsRequest::getInt('start', 0);
$limit = XoopsRequest::getInt('limit', $wgrealestate->getConfig('userpager'));
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );
// 
$GLOBALS['xoopsTpl']->assign('wgrealestate_icons32_url', WGREALESTATE_ICONS_URL . '/32/');
$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
$GLOBALS['xoopsTpl']->assign('wgrealestate_obj_image_url', WGREALESTATE_UPLOAD_IMAGE_URL.'/objects/');

// assign rights of current user
$GLOBALS['xoopsTpl']->assign('isModerator', $isModerator);

// 
$criteria = new CriteriaCompo();
if ( 'show_archive' === $op ) {
    $criteria->add(new Criteria('obj_state', WGREALESTATE_STATE_ARCHIVE_VAL));
} else {
    $criteria->add(new Criteria('obj_state', WGREALESTATE_STATE_ONLINE_VAL));
    if ($isModerator) {
        $criteria->add(new Criteria('obj_state', WGREALESTATE_STATE_NEW_VAL), 'OR');
    }
}
$criteria->setStart($start);
$criteria->setLimit($limit);
$criteria->setSort('obj_id');
$criteria->setOrder('DESC');
$objectsCount = $objectsHandler->getCount($criteria);
$objectsAll = $objectsHandler->getAll($criteria);
$keywords = array();

if($objectsCount > 0) {
	$objects = array();
	// Get All Objects
	foreach(array_keys($objectsAll) as $i) {
        $elements = 0; 
		$objects[$i] = $objectsAll[$i]->getValuesObjectsUser();
        if ($isModerator) {
            switch ($objects[$i]['state']) {
                case WGREALESTATE_STATE_NEW_VAL:
                    $objects[$i]['state_img'] = 'state_new.png';
                break;
                case WGREALESTATE_STATE_ONLINE_VAL:
                    $objects[$i]['state_img'] = 'state_online.png';
                break;
                case WGREALESTATE_STATE_ARCHIVE_VAL:
                    $objects[$i]['state_img'] = 'state_archive.png';
                break;
                case '':
                default:
                break;
            }
        }
		
		// get costs
        $crit_costs = new CriteriaCompo();
        $crit_costs->add(new Criteria('cost_obj_id', $objects[$i]['id']));
        $crit_costs->setSort('cost_weight');
        $crit_costs->setOrder('ASC');
        $costsCount = $costsHandler->getCount($crit_costs);
        $costsAll = $costsHandler->getAll($crit_costs);
        if($costsCount > 0) {
            $costs = array();
			$objects[$i]['costs'] =  array();
            // Get All costs
            foreach(array_keys($costsAll) as $c) {
                $costs[$c] = $costsAll[$c]->getValuesCosts();
 				if (1 == $costs[$c]['costt_index']) {
					$objects[$i]['costs'][] = $costs[$c];
				}
                $elements++;
            }
        }
        unset($crit_costs, $costs);

        // get attributes
        $crit_atts = new CriteriaCompo();
        $crit_atts->add(new Criteria('att_objid', $objects[$i]['id']));
        $crit_atts->setSort('att_weight');
        $crit_atts->setOrder('ASC');
        $attributesCount = $attributesHandler->getCount($crit_atts);
        $attributesAll = $attributesHandler->getAll($crit_atts);
        if($attributesCount > 0) {
            $attributes = array();
			$objects[$i]['attributes_header'] =  array();
			$objects[$i]['attributes_misc'] =  array();
            // Get All costs
            foreach(array_keys($attributesAll) as $a) {
                $attribute[$a] = $attributesAll[$a]->getValuesAttributes();
				switch ($attribute[$a]['attdef_index']) {
					case WGREALESTATE_INDEX_HEADER_VAL:
						$objects[$i]['attributes_header'][] = $attribute[$a];
					break;
					case WGREALESTATE_INDEX_MISC_VAL:
						$objects[$i]['attributes_misc'][] = $attribute[$a];
					break;
					case 0:
					default:
					break;
				}
                $elements++;
            }
        }
        unset($crit_atts, $attributes);

        $keywords[] = $objectsAll[$i]->getVar('obj_title');
        $objects[$i]['elements'] =  $elements;
	}
	$GLOBALS['xoopsTpl']->assign('objects', $objects);
	unset($objects);

	// Display Navigation
	if($objectsCount > $limit) {
		include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
		$pagenav = new XoopsPageNav($objectsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
		$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
	}
	$GLOBALS['xoopsTpl']->assign('numb_col', $wgrealestate->getConfig('numb_col'));
	$GLOBALS['xoopsTpl']->assign('panel_type', $wgrealestate->getConfig('panel_type'));
}
// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGREALESTATE_INDEX);
// Keywords
wgrealestateMetaKeywords($wgrealestate->getConfig('keywords').', '. implode(',', $keywords));
unset($keywords);
// Description
wgrealestateMetaDescription(_MA_WGREALESTATE_OBJECTS_TITLE);

include __DIR__ . '/footer.php';
