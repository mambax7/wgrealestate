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
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgrealestateAttributes
 */
class WgrealestateAttributes extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('att_id', XOBJ_DTYPE_INT);
		$this->initVar('att_objid', XOBJ_DTYPE_INT);
		$this->initVar('att_attdefid', XOBJ_DTYPE_INT);
        $this->initVar('att_attcatid', XOBJ_DTYPE_INT);
		$this->initVar('att_info', XOBJ_DTYPE_TXTAREA);
		$this->initVar('att_value', XOBJ_DTYPE_TXTBOX);
		$this->initVar('att_weight', XOBJ_DTYPE_INT);
		$this->initVar('att_datecreate', XOBJ_DTYPE_INT);
		$this->initVar('att_submitter', XOBJ_DTYPE_INT);
	}

	/**
	 * @static function &getInstance
	 *
	 * @param null
	 */
	public static function getInstance()
	{
		static $instance = false;
		if(!$instance) {
			$instance = new self();
		}
	}

	/**
	 * The new inserted $Id
	 * @return inserted id
	 */
	public function getNewInsertedIdAttributes()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormAttributes($action = false)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_CO_WGREALESTATE_ATTRIBUTES_ADD) : sprintf(_CO_WGREALESTATE_ATTRIBUTES_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Select att_objid
		$objectsHandler = $wgrealestate->getHandler('objects');
		$addObj_idSelect = new XoopsFormSelect( _CO_WGREALESTATE_OBJECTS, 'att_objid', $this->getVar('att_objid'));
		$addObj_idSelect->addOptionArray($objectsHandler->getList());
		$form->addElement($addObj_idSelect, true);
		// Form Select Attributes
		$attdefaultsHandler = $wgrealestate->getHandler('attdefaults');
		$attdefidSelect = new XoopsFormSelect( _AM_WGREALESTATE_ATTDEFAULTS, 'att_attdefid', $this->getVar('att_attdefid'));
		$attdefidSelect->addOptionArray($attdefaultsHandler->getList());
		$form->addElement($attdefidSelect, true);
        // Form Select ObjAttCat
		$attcategoriesHandler = $wgrealestate->getHandler('attcategories');
		$attcat_idSelect = new XoopsFormSelect( _AM_WGREALESTATE_ATTCATEGORIES, 'att_attcatid', $this->getVar('att_attcatid'));
		$attcat_idSelect->addOptionArray($attcategoriesHandler->getList());
		$form->addElement($attcat_idSelect, true);
		// Form editor objattInfo
		$editorConfigs = array();
		$editorConfigs['name'] = 'att_info';
		$editorConfigs['value'] = $this->getVar('att_info', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wgrealestate->getConfig('wgrealestate_editor');
		$form->addElement(new XoopsFormEditor( _AM_WGREALESTATE_ATTRIBUTES_INFO, 'att_info', $editorConfigs));
		// Form Text AddValue
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_ATTRIBUTES_VALUE, 'att_value', 50, 255, $this->getVar('att_value') ));
		// Form Radio Yes/No
		$addWeight = $this->isNew() ? 1 : $this->getVar('att_weight');
        $form->addElement(new XoopsFormText( _CO_WGREALESTATE_WEIGHT, 'att_weight', 5, 255, $addWeight ));
		// Form Text Date Select
		$addDatecreate = $this->isNew() ? 0 : $this->getVar('att_datecreate');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_DATECREATE, 'att_datecreate', '', $addDatecreate ));
		// Form Select User
		$form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'att_submitter', false, $this->getVar('att_submitter') ));
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}

	/**
	 * Get Values
	 * @param null $keys 
	 * @param null $format 
	 * @param null$maxDepth 
	 * @return array
	 */
	public function getValuesAttributes($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('att_id');
        $ret['obj_id'] = $this->getVar('att_objid');
		// $objects = $wgrealestate->getHandler('objects');
		// $obj_object = $objects->get($this->getVar('att_objid'));
		// $ret['obj_title'] = $obj_object->getVar('obj_title');
        // $ret['obj_dealt_id'] = $obj_object->getVar('obj_dealt_id');
        $att_attdefid = $this->getVar('att_attdefid');
        $ret['attdef_id'] = $att_attdefid;
		$attdefaults = $wgrealestate->getHandler('attdefaults');
		$attdefaultObj = $attdefaults->get($att_attdefid);
        $ret['attdef_attcatid'] = $attdefaultObj->getVar('attdef_attcatid');
		$ret['attdef_name'] = $attdefaultObj->getVar('attdef_name');
        $ret['attdef_weight'] = $attdefaultObj->getVar('attdef_weight');
		$ret['attdef_type'] = $attdefaultObj->getVar('attdef_type');
		$ret['attdef_index'] = $attdefaultObj->getVar('attdef_index');
        $ret['info'] = $this->getVar('att_info', 'show');
        $ret['info_user'] = $wgrealestate->getObjattInfoText($attdefaultObj->getVar('attdef_type'),  $this->getVar('att_info', 'show'));
        $att_value = $this->getVar('att_value');
		$ret['value'] = $att_value;
		if (WGREALESTATE_ATTR_YN_VAL == $attdefaultObj->getVar('attdef_type')) {
			$ret['value_user_yes'] = $att_value;
		} else {
			$ret['value_user'] = $wgrealestate->getObjattValueText($attdefaultObj->getVar('attdef_type'), $att_value);
		}
		if ( WGREALESTATE_ATTR_TEXT_KWH_VAL == $attdefaultObj->getVar('attdef_type')) {
			$ret['kwh_left'] = number_format ( 100/420*$att_value, $decimals = 0);
		}
		$ret['weight'] = $this->getVar('att_weight');
		$ret['datecreate'] = formatTimeStamp($this->getVar('att_datecreate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('att_submitter'));
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayAttributes()
	{
		$ret = array();
		$vars = $this->getVars();
		foreach(array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('"{$var}"');
		}
		return $ret;
	}
}

/**
 * Class Object Handler WgrealestateAttributes
 */
class WgrealestateAttributesHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgrealestate_attributes', 'wgrealestateattributes', 'att_id', 'att_objid');
	}

	/**
	 * @param bool $isNew
	 *
	 * @return object
	 */
	public function create($isNew = true)
	{
		return parent::create($isNew);
	}

	/**
	 * retrieve a field
	 *
	 * @param int $i field id
	 * @param null fields
	 * @return mixed reference to the {@link Get} object
	 */
	public function get($i = null, $fields = null)
	{
		return parent::get($i, $fields);
	}

	/**
	 * get inserted id
	 *
	 * @param null
	 * @return integer reference to the {@link Get} object
	 */
	public function getInsertId()
	{
		return $this->db->getInsertId();
	}

	/**
	 * Get Count Attributes in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountAttributes($start = 0, $limit = 0, $sort = 'att_weight', $order = 'ASC')
	{
		$crCountAttributes = new CriteriaCompo();
		$crCountAttributes = $this->getAttributesCriteria($crCountAttributes, $start, $limit, $sort, $order);
		return parent::getCount($crCountAttributes);
	}

	/**
	 * Get All Attributes in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllAttributes($start = 0, $limit = 0, $sort = 'att_weight', $order = 'ASC')
	{
		$crAllAttributes = new CriteriaCompo();
		$crAllAttributes = $this->getAttributesCriteria($crAllAttributes, $start, $limit, $sort, $order);
		return parent::getAll($crAllAttributes);
	}

	/**
	 * Get Criteria Attributes
	 * @param        $crAttributes
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getAttributesCriteria($crAttributes, $start, $limit, $sort, $order)
	{
		$crAttributes->setStart( $start );
		$crAttributes->setLimit( $limit );
		$crAttributes->setSort( $sort );
		$crAttributes->setOrder( $order );
		return $crAttributes;
	}

    /**
     * @public function getForm
     * @param $objId
     * @param bool $action
     * @return XoopsThemeForm
     */
	public function getFormAttributesUser($objId, $action = false)
	{
        // Get instance of module
        $wgrealestate = WgrealestateHelper::getInstance();
        $attdefaultsHandler = $wgrealestate->getHandler('attdefaults');
        $attributesHandler = $wgrealestate->getHandler('attributes');
        $attcategoriesHandler = $wgrealestate->getHandler('attcategories');
        $objectsHandler = $wgrealestate->getHandler('objects');

		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_CO_WGREALESTATE_ATTRIBUTES_ADD) : sprintf(_CO_WGREALESTATE_ATTRIBUTES_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');

        // get oject details
        $objectObj = $objectsHandler->get($objId); 
        $dealtype = $objectObj->getVar('obj_dealt_id');
        // get all cats for additional object attdefaults for current dealtype
        $crit_att = new CriteriaCompo();
        $crit_att->add(new Criteria('attdef_dealtid', $dealtype), 'OR');
        $crit_att->add(new Criteria('attdef_dealtid', 0), 'OR');
        $crit_att->add(new Criteria('attdef_valid', 1));
        $crit_att->setSort('attdef_weight');
        $crit_att->setOrder('ASC');
        $attdefaultsCount = $attdefaultsHandler->getCount($crit_att);
        $attdefaultsAll = $attdefaultsHandler->getAll($crit_att);

        $counter = 0;
        $attr_attcat_name = '';
        if($attdefaultsCount > 0) {
            foreach(array_keys($attdefaultsAll) as $i) {
                $attdefaults[$i] = $attdefaultsAll[$i]->getValueAttdefaults();
                $attdef_id = $attdefaults[$i]['id'];
                $attr_attcatid = $attdefaults[$i]['attcat_id'];
                $attdef_name = $attdefaults[$i]['name'];
                $attdef_type = $attdefaults[$i]['type'];
                // $attcategoriesObj = $attcategoriesHandler->get($attr_attcatid);
                // $attdef_attcatid = $attcategoriesObj->getVar('attcat_id');
                // if ($attr_attcat_name !== $attcategoriesObj->getVar('attcat_name')) {;
				$attdef_attcatid = $attdefaults[$i]['attcat_id'];
				if ($attr_attcat_name !== $attdefaults[$i]['attcat_name']) {
                    $attr_attcat_name = $attdefaults[$i]['attcat_name'];//$attcategoriesObj->getVar('attcat_name');
					$labelAttcatname = new XoopsFormLabel('', '<span class="wgre-attcatname">' . $attr_attcat_name . '</span>');
                    $form->addElement($labelAttcatname);
                }                
                // get additional object attdefaults for current object
                $crit_objatt = new CriteriaCompo();
                $crit_objatt->add(new Criteria('att_objid', $objId));
                $crit_objatt->add(new Criteria('att_attdefid', $attdef_id));
                $attributesCount = $attributesHandler->getCount($crit_objatt);
                $attributesAll = $attributesHandler->getAll($crit_objatt);
                
                // reset values
                $att_id = 0;
                $att_value = '';
                $att_info = '';
                if($attributesCount > 0) {
                    $attributes = array();
                    // Get All Attributes
                    foreach(array_keys($attributesAll) as $j) {
                        $attributes[$j] = $attributesAll[$j]->getValuesAttributes();
                        $att_id = $attributes[$j]['att_id'];                        
                        $att_value = $attributes[$j]['att_value'];
                        $att_info = $attributes[$j]['att_info'];
                    }
                }
                unset($crit_objatt, $attributes);
                $counter++;
                switch ($attdef_type) {
                    case WGREALESTATE_ATTR_YN_VAL:
                        $eleTray = new XoopsFormElementTray($attdef_name, '<br>' );
                        $objattoptYN = new XoopsFormRadio( '', 'att_value_' . $counter, $att_value);
                        $objattoptYN->addOption(1, _YES);
                        $objattoptYN->addOption(0, _NO);
                        $objattoptYN->addOption('', _CO_WGREALESTATE_USE_NOT);
                        $eleTray->addElement($objattoptYN, false);
                        $eleTray->addElement(new XoopsFormText( _CO_WGREALESTATE_INFO, 'att_info_' . $counter, 35, 255, $att_info));
                        $form->addElement($eleTray, false);
                        unset($objattoptYN, $eleTray);
                        break;
                    case WGREALESTATE_ATTR_TEXT_VAL:
                        $form->addElement(new XoopsFormText( $attdef_name, 'att_info_' . $counter, 25, 255, $att_info)); 
                        $form->addElement(new XoopsFormHidden('att_value_' . $counter,  ''));                        
                    break;
                    case WGREALESTATE_ATTR_TEXT_M2_VAL:
                        $elem2Tray = new XoopsFormElementTray($attdef_name, '&nbsp;' );
                        $elem2Tray->addElement(new XoopsFormText( '', 'att_value_' . $counter, 25, 255, $att_value), false);
                        $elem2Tray->addElement(new XoopsFormLabel( '', _CO_WGREALESTATE_SQUAREMETER));
                        $form->addElement($elem2Tray, false);
                        $form->addElement(new XoopsFormHidden('att_info_' . $counter,  '')); 
                    
                        unset($elem2Tray);
                    break;
                    case WGREALESTATE_ATTR_TEXT_CURR_VAL:
                        $eleEurTray = new XoopsFormElementTray($attdef_name, '&nbsp;' );
                        $eleEurTray->addElement(new XoopsFormText( '', 'att_value_' . $counter, 25, 255, $att_value), false);
                        $eleEurTray->addElement(new XoopsFormLabel( '', _CO_WGREALESTATE_CURRENCY));
                        $form->addElement($eleEurTray, false);
                        $form->addElement(new XoopsFormHidden('att_info_' . $counter,  '')); 
                    
                        unset($eleEurTray);
                    break;
                    case WGREALESTATE_ATTR_TEXT_KWH_VAL:
                        $eleKwhTray = new XoopsFormElementTray($attdef_name, '&nbsp;' );
                        $eleKwhTray->addElement(new XoopsFormText( '', 'att_value_' . $counter, 25, 255, $att_value), false);
                        $eleKwhTray->addElement(new XoopsFormLabel( '', _CO_WGREALESTATE_KWH));
                        $form->addElement($eleKwhTray, false);
                        $form->addElement(new XoopsFormHidden('att_info_' . $counter,  '')); 
                    
                        unset($eleKwhTray);
                    break;
					case WGREALESTATE_ATTR_TEXTAREA_VAL:
                        // Form editor AddInfo
                        $editorConfigs = array();
                        $editorConfigs['name'] = 'att_info_' . $counter;
                        $editorConfigs['value'] = $att_info;
                        $editorConfigs['rows'] = 5;
                        $editorConfigs['cols'] = 40;
                        $editorConfigs['width'] = '100%';
                        $editorConfigs['height'] = '400px';
                        $editorConfigs['editor'] = $wgrealestate->getConfig('wgrealestate_editor');
                        $form->addElement(new XoopsFormEditor( $attdef_name, 'att_info_' . $counter, $editorConfigs));
                        $form->addElement(new XoopsFormHidden('att_value_' . $counter,  ''));
                    break;
					case WGREALESTATE_ATTR_SELECT_VAL:
						$crit_select = new CriteriaCompo();
						$crit_select->add(new Criteria('attdef_parent', $attdef_id));
						$crit_select->setSort('attdef_weight');
						$crit_select->setOrder('ASC');
						$attdefaultsHandler = $wgrealestate->getHandler('attdefaults');
						$attdefParentSelect = new XoopsFormSelect( $attdef_name, 'att_value_' . $counter, $att_value); 
						$attdefParentSelect->addOption(0, ' ');
						$attdefParentSelect->addOptionArray($attdefaultsHandler->getList($crit_select));
						$form->addElement($attdefParentSelect);
						$form->addElement(new XoopsFormHidden('att_info_' . $counter,  ''));
                        unset($objattoptYN, $eleTray);
                        break;
                    case '':
                    default:
                    break;
                }
                // $form->addElement(new XoopsFormHidden('attdef_name_' . $counter, $attdef_name));
                $form->addElement(new XoopsFormHidden('attdef_attcatid_' . $counter, $attdef_attcatid));
                $form->addElement(new XoopsFormHidden('attdef_id_' . $counter,  $attdef_id));
                $form->addElement(new XoopsFormHidden('attdef_type_' . $counter,  $attdef_type));
                $form->addElement(new XoopsFormHidden('att_id_' . $counter,  $att_id));
                // echo "<br>objatt id:". $attdef_id  . " attdef_name:" . $attdef_name . " attdef_type:" . $attdef_type;
                // echo " attributesCount:". $attributesCount;
                // echo " att_value:". $att_value ." att_info:". $att_info;
            }
        }
        unset($crit_att);

		// To Save
		$form->addElement(new XoopsFormHidden('obj_id', $objId));
        $form->addElement(new XoopsFormHidden('counter', $counter));
        $form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}
}
