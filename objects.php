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
$GLOBALS['xoopsOption']['template_main'] = 'wgrealestate_object_single.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';

$op         = XoopsRequest::getString('op', 'none');
$objId      = XoopsRequest::getInt('obj_id', 0);
$map_filter = XoopsRequest::getString('map_filter', '');

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );

$GLOBALS['xoTheme']->addScript(WGREALESTATE_URL . '/assets/js/sortable.js');
$GLOBALS['xoTheme']->addScript(WGREALESTATE_URL . '/assets/js/jquery-ui.min.js');

$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url_16', WGREALESTATE_ICONS_URL . '/16/');
$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url_32', WGREALESTATE_ICONS_URL . '/32/');
$GLOBALS['xoopsTpl']->assign('wgrealestate_icon_url', WGREALESTATE_ICONS_URL);
$GLOBALS['xoopsTpl']->assign('wgrealestate_obj_image_url', WGREALESTATE_UPLOAD_IMAGE_URL.'/objects/');
$GLOBALS['xoopsTpl']->assign('wgrealestate_obj_file_url', WGREALESTATE_UPLOAD_FILES_URL.'/objects/' . $objId . '/');

$keywords = array();

// assign rights of current user
$GLOBALS['xoopsTpl']->assign('isModerator', $isModerator);

switch ($op) {
    case 'new':
		// Get Form
		$GLOBALS['xoopsTpl']->assign('list', false);
		if ($isModerator) {
			$objectsObj = $objectsHandler->create();
			$form = $objectsObj->getFormObjects();
			$GLOBALS['xoopsTpl']->assign('form', $form->render());
		} else {
			redirect_header('objects.php', 3, _CO_WGREALESTATE_NO_PERM);
		}
	break;
    case 'delete':
        $objectsObj = $objectsHandler->get($objId);
        // Set Vars
        $objectsObj->setVar('obj_state', WGREALESTATE_STATE_DELETED);
        // Insert Data
		if($objectsHandler->insert($objectsObj)) {
            redirect_header('index.php?op=list', 2, _CO_WGREALESTATE_FORM_DELETE_OK);
        } else {
            $GLOBALS['xoopsTpl']->assign('error', $objectsObj->getHtmlErrors());
        }
        break;

	case 'state':   
		if( 0 < $objId) {
			$objectsObj = $objectsHandler->get($objId);
		} else {
			redirect_header('objects.php', 3, _CO_WGREALESTATE_ERROR_NO_VALID_OBJID);
		}
		// Set Vars
		$obj_state     = XoopsRequest::getInt('obj_state', 0);
		$obj_state_old = XoopsRequest::getInt('obj_state_old', 0);
		$objectsObj->setVar('obj_state', $obj_state);
		if ( !$obj_state_old == $obj_state) {
            $objectsObj->setVar('obj_datestate', time());
        }
		// Insert Data
		if($objectsHandler->insert($objectsObj)) {
            redirect_header('objects.php?op=editmode&amp;obj_id=' . $objId, 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $objectsObj->getHtmlErrors());
		$form = $objectsObj->getFormObjects();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('objects.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}        
		if( 0 < $objId) {
			$objectsObj = $objectsHandler->get($objId);
		} else {
			$objectsObj = $objectsHandler->create();
		}
		// Set Vars
        $objectsObj->setVar('obj_title',      XoopsRequest::getString('obj_title'));
		$objectsObj->setVar('obj_dealt_id',   XoopsRequest::getInt('obj_dealt_id', 0));
		$objectsObj->setVar('obj_objcat_id',  XoopsRequest::getInt('obj_objcat_id', 0));
        $obj_ctry = XoopsRequest::getString('obj_ctry');
        if ('-' === $obj_ctry) {$obj_ctry = '';} //reset nothing selected
        $obj_postalcode = XoopsRequest::getString('obj_postalcode');
        $obj_city       = XoopsRequest::getString('obj_city');
        $obj_address    = XoopsRequest::getString('obj_address');
        $objectsObj->setVar('obj_ctry',       $obj_ctry);
		$objectsObj->setVar('obj_postalcode', $obj_postalcode);
		$objectsObj->setVar('obj_city',       $obj_city);
		$objectsObj->setVar('obj_address',    $obj_address);
        $geocoords =  XoopsRequest::getInt('geocoords', 0);
        if (1 === $geocoords) {
            require_once __DIR__ . '/include/googlemaps.php';
            $obj_geo_lng = '';
            $obj_geo_lat = '';
            $place_id = '';
            // Your google API key
            // https://developers.google.com/maps/documentation/geocoding/usage-limits?hl=de
            // 2,500 free requests per day, calculated as the sum of client-side and server-side queries.
            // 50 requests per second, calculated as the sum of client-side and server-side queries.
            $googleKey = '';
            $search = implode(', ', [$obj_address, $obj_postalcode, $obj_city, $obj_ctry]);

            $geoData = google_maps_search($search, $googleKey);
            $mapData = map_google_search_result($geoData);
            if ($geoData) {
                $obj_geo_lng = $mapData['lng'];
                $obj_geo_lat = $mapData['lat'];
                $place_id    = $mapData['place_id'];
            }
            // Set Vars
            $objectsObj->setVar('obj_geo_lng', $obj_geo_lng);
            $objectsObj->setVar('obj_geo_lat', $obj_geo_lat);
            $objectsObj->setVar('obj_geo_placeid', $place_id);
        }
        if (2 === $geocoords) {
            // delete geo coords
            $objectsObj->setVar('obj_geo_lng', '');
            $objectsObj->setVar('obj_geo_lat', '');
            $objectsObj->setVar('obj_geo_placeid', '');
        }
		$objectsObj->setVar('obj_seller_id',  XoopsRequest::getInt('obj_seller_id', 0));
		$objectsObj->setVar('obj_descr',      XoopsRequest::getString('obj_descr'));
		$objectsObj->setVar('obj_infos',      XoopsRequest::getString('obj_infos'));
		$objectsObj->setVar('obj_misc',       XoopsRequest::getString('obj_misc'));
        $objectsObj->setVar('obj_location',   XoopsRequest::getString('obj_location'));
		$objectsObj->setVar('obj_views',      XoopsRequest::getInt('obj_views', 0));
		$objectsObj->setVar('obj_contacts',   XoopsRequest::getInt('obj_contacts', 0));
        $obj_state = XoopsRequest::getInt('obj_state', 0);
		$objectsObj->setVar('obj_state',      $obj_state);
        $obj_state_old = XoopsRequest::getInt('obj_state_old', 0);
		if ( !$obj_state_old == $obj_state) {
            $objectsObj->setVar('obj_datestate', time());
        }
        $objectsObj->setVar('obj_datecreate', XoopsRequest::getInt('obj_datecreate', 0));
		$objectsObj->setVar('obj_submitter',  $xoopsUser->getVar('uid'));
		// Insert Data
		if($objectsHandler->insert($objectsObj)) {
			if( 0 == $objId) {
                $objId = $objectsHandler->getInsertId();
                // check upload path images
                $wgrealestate_upload_images = WGREALESTATE_UPLOAD_IMAGE_PATH . '/objects/' . $objId ;
                if(!is_dir($wgrealestate_upload_images)) {
                    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
                    mkdir($wgrealestate_upload_images, 0777);
                    chmod($wgrealestate_upload_images, 0777);
                    copy($indexFile, $wgrealestate_upload_images . '/index.html');
                }
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
				// check upload path files
                $wgrealestate_upload_files = WGREALESTATE_UPLOAD_FILES_PATH . '/objects/' . $objId ;
                if(!is_dir($wgrealestate_upload_files)) {
                    $indexFile = XOOPS_UPLOAD_PATH.'/index.html';
                    mkdir($wgrealestate_upload_files, 0777);
                    chmod($wgrealestate_upload_files, 0777);
                    copy($indexFile, $wgrealestate_upload_files . '/index.html');
                }
            }
            redirect_header('objects.php?op=editmode&amp;obj_id=' . $objId, 2, _CO_WGREALESTATE_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $objectsObj->getHtmlErrors());
		$form = $objectsObj->getFormObjects();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
	break;
    
	case 'edit':
		// Get Form
		$GLOBALS['xoopsTpl']->assign('list', false);
		if ($isModerator) {
			$objectsObj = $objectsHandler->get($objId);
			$form = $objectsObj->getFormObjects();
			$GLOBALS['xoopsTpl']->assign('form', $form->render());
		} else {
			redirect_header('objects.php', 3, _CO_WGREALESTATE_NO_PERM);
		}
	break;
    
    case 'list':
    default:
        $GLOBALS['xoopsTpl']->assign('list', true);
		$GLOBALS['xoopsTpl']->assign('op', $op);
		$GLOBALS['xoopsTpl']->assign('map_searchbox', _MA_WGREALESTATE_GM_SEARCHBOX);
		
        // rolle auf darf bearbeiten abprüfen!!!!!!!!!!!
		if ($isModerator) {
			$GLOBALS['xoopsTpl']->assign('editmode', 'editmode' === $op);
		}
		$GLOBALS['xoopsTpl']->assign('defaultmode', 'editmode' !== $op);
        // get oject details
        $singleobjectObj = $objectsHandler->get($objId);
		
		if (!$isModerator) {
			//update counter views
			$singleobjectObj->setVar('obj_views', $singleobjectObj->getVar('obj_views') + 1);
			$objectsHandler->insert($singleobjectObj, true);
		}

        $singleobject = $singleobjectObj->getValuesObjectsUser();
        $keywords[] = $singleobjectObj->getVar('obj_title');
		$dealtype_id = $singleobjectObj->getVar('obj_dealt_id');

        $GLOBALS['xoopsTpl']->assign('object', $singleobject);
        unset($singleobject);
        
        $GLOBALS['xoopsTpl']->assign('googlemapsapikey', $wgrealestate->getConfig('googlemapsapikey'));

        // get object attdefaults
        $crit_attcat = new CriteriaCompo();
        $crit_attcat->add(new Criteria('attcat_valid', 1));
        $crit_attcat->setSort('attcat_weight');
        $crit_attcat->setOrder('ASC');
        $attcategoriesCount = $attcategoriesHandler->getCount($crit_attcat);
        $attcategoriesAll = $attcategoriesHandler->getAll($crit_attcat);
        if ($attcategoriesCount > 0) {
            $counterAtt = 0;
            $attributes = array();
            foreach(array_keys($attcategoriesAll) as $i) {
                $attcategories[$i] = $attcategoriesAll[$i]->getValuesAttcategories();
                $attcatId = $attcategories[$i]['attcat_id'];
                $attcatName = '';
                if ( 1 == $attcategories[$i]['attcat_show'] ) {
                    $attcatName = $attcategories[$i]['attcat_name'];
					$counterAtt = 0;
				}
                // get object attributes
                $criteria = new CriteriaCompo();
                $criteria->add(new Criteria('att_objid', $objId));
                $criteria->add(new Criteria('att_attcatid',$attcatId));
                $criteria->setSort('att_weight');
                $criteria->setOrder('ASC');
                $attributesCount = $attributesHandler->getCount($criteria);
                $attributesAll = $attributesHandler->getAll($criteria);
                if($attributesCount > 0) {
                    $objatt_attcatName = '';
                    // Get All Attributes
                    foreach(array_keys($attributesAll) as $j) {
                        $attributes[$j] = $attributesAll[$j]->getValuesAttributes();
						$counterAtt++;
						if (3 === $counterAtt) {$counterAtt = 1;}
                        if ($objatt_attcatName !== $attcatName) {
                            $objatt_attcatName = $attcatName;
                            $attributes[$j]['attcat_name'] = $objatt_attcatName;
                        } else {
                            $attributes[$j]['attcat_name'] = '';
                        }
						$attributes[$j]['counteratt'] = $counterAtt;
                    }
                    
                }
            }
            $GLOBALS['xoopsTpl']->assign('attributes', $attributes);
        }
        unset($criteria);
        unset($attributes);
        unset($i);
        unset($j);

        // get costs
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('cost_obj_id', $objId));
        $criteria->setSort('cost_weight');
        $criteria->setOrder('ASC');
        $costsCount = $costsHandler->getCount($criteria);
        $costsAll = $costsHandler->getAll($criteria);
        if($costsCount > 0) {
            $costs = array();
			$sum_costs = 0;
            $costsCount2 = 0;
            // Get All costs
            foreach(array_keys($costsAll) as $i) {
                $costs[$i] = $costsAll[$i]->getValuesCosts();
				$sum_costs += $costs[$i]['value'];
                if ( 0 < $costs[$i]['value'] ) {$costsCount2++;}
            }
            $GLOBALS['xoopsTpl']->assign('costs', $costs);
			if($costsCount2 > 1) {
				if (WGREALESTATE_DEALTYPE_RENT_VAL == $dealtype_id) {
					$GLOBALS['xoopsTpl']->assign('sum_cost_typ', _CO_WGREALESTATE_COST_SUM_RENT);
				} else {
					$GLOBALS['xoopsTpl']->assign('sum_cost_typ', _CO_WGREALESTATE_COST_SUM_SALE);
				}
                $sum_costs = number_format($sum_costs, 0, ',', '.') . ' ' . _CO_WGREALESTATE_CURRENCY;
				$GLOBALS['xoopsTpl']->assign('sum_costs', $sum_costs);;
			}
        }
        unset($criteria);
        unset($costs);
        unset($i);
		
		// get files
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('file_obj_id', $objId));
        $criteria->setSort('file_weight');
        $criteria->setOrder('ASC');
        $filesCount = $filesHandler->getCount($criteria);
        $filesAll = $filesHandler->getAll($criteria);
        if($filesCount > 0) {
            $files = array();
            // Get All files
            foreach(array_keys($filesAll) as $i) {
                $files[] = $filesAll[$i]->getValuesFiles();
            }
            $GLOBALS['xoopsTpl']->assign('files', $files);
        }
        unset($criteria);
        unset($files);
        unset($i);

        // get all additional images for this object
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('img_obj_id', $objId));
        $criteria->add(new Criteria('img_cat', WGREALESTATE_IMGCAT_PICTURE_VAL));   
        $criteria->setSort('img_weight');
        $criteria->setOrder('ASC');
        $imagesCount = $imagesHandler->getCount($criteria);
        $imagesAll = $imagesHandler->getAll($criteria);
        if($imagesCount > 0) {
            $images = array();
            // Get All conditions
            foreach(array_keys($imagesAll) as $i) {
                $images[] = $imagesAll[$i]->getValuesImages();
            }
            $GLOBALS['xoopsTpl']->assign('images_nb', $imagesCount);
            $GLOBALS['xoopsTpl']->assign('images', $images);
            if($imagesCount > 1) {
                $GLOBALS['xoTheme']->addStylesheet( WGREALESTATE_URL . '/assets/pgwslideshow/pgwslideshow.css', null );
                //$GLOBALS['xoTheme']->addScript(WGREALESTATE_URL . '/assets/js/jquery-ui.min.js');
                $GLOBALS['xoTheme']->addScript(WGREALESTATE_URL . '/assets/pgwslideshow/pgwslideshow.min.js');
                $GLOBALS['xoTheme']->addScript('', ['type' => 'text/javascript'], '
                $(document).ready(function() {
                    var pgwSlideshow = $(".pgwSlideshow").pgwSlideshow({
                        transitionEffect : "fading",
                        autoSlide : false,
                        transitionDuration : 500,
                        adaptiveDuration : 200
                    });
                    pgwSlideshow.displaySlide(1);
                    });
                ');
             }
        }
        unset($criteria);
        unset($images);
        unset($i);
        
        // get all plan images for this object
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('img_obj_id', $objId));
        $criteria->add(new Criteria('img_cat', WGREALESTATE_IMGCAT_PLAN_VAL));   
        $criteria->setSort('img_weight');
        $criteria->setOrder('ASC');
        $imagesCount = $imagesHandler->getCount($criteria);
        $imagesAll = $imagesHandler->getAll($criteria);
        if($imagesCount > 0) {
            $images = array();
            // Get All conditions
            foreach(array_keys($imagesAll) as $i) {
                $images[] = $imagesAll[$i]->getValuesImages();
            }
            $GLOBALS['xoopsTpl']->assign('plans_nb', $imagesCount);
            $GLOBALS['xoopsTpl']->assign('planimages', $images);
            if($imagesCount > 1) {
                $GLOBALS['xoTheme']->addStylesheet( WGREALESTATE_URL . '/assets/pgwslideshow/pgwslideshow.css', null );
                //$GLOBALS['xoTheme']->addScript(WGREALESTATE_URL . '/assets/js/jquery-ui.min.js');
                $GLOBALS['xoTheme']->addScript(WGREALESTATE_URL . '/assets/pgwslideshow/pgwslideshow.min.js');
                $GLOBALS['xoTheme']->addScript('', ['type' => 'text/javascript'], '
                $(document).ready(function() {
                    var pgwSlideshow = $(".pgwSlideshowPlan").pgwSlideshow({
                        transitionEffect : "fading",
                        autoSlide : true,
                        transitionDuration : 500,
                        adaptiveDuration : 200
                    });
                    pgwSlideshow.displaySlide(1);
                    });
                ');
             }
        }
        unset($criteria);
        unset($images);
        unset($i);
		
		$GLOBALS['xoopsTpl']->assign('footer', true);
		
    break;
}

$GLOBALS['xoopsTpl']->assign('panel_type', $wgrealestate->getConfig('panel_type'));

// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _CO_WGREALESTATE_OBJECTS);
// Keywords
wgrealestateMetaKeywords($wgrealestate->getConfig('keywords').', '. implode(',', $keywords));
unset($keywords);
// Description
wgrealestateMetaDescription(_CO_WGREALESTATE_OBJECT_TITLE);

include __DIR__ . '/footer.php';
