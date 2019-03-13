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
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgrealestateCosts
 */
class WgrealestateCosts extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('cost_id', XOBJ_DTYPE_INT);
		$this->initVar('cost_obj_id', XOBJ_DTYPE_INT);
		$this->initVar('cost_costt_id', XOBJ_DTYPE_INT);
		$this->initVar('cost_perc', XOBJ_DTYPE_FLOAT);
		$this->initVar('cost_base', XOBJ_DTYPE_FLOAT);
		$this->initVar('cost_value', XOBJ_DTYPE_FLOAT);
		$this->initVar('cost_info', XOBJ_DTYPE_TXTAREA);
        $this->initVar('cost_weight', XOBJ_DTYPE_TXTAREA);
		$this->initVar('cost_datecreate', XOBJ_DTYPE_INT);
		$this->initVar('cost_submitter', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdCosts()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormCosts($action = false)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_CO_WGREALESTATE_COST_ADD) : sprintf(_CO_WGREALESTATE_COST_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Select Costs
		$cost_typesHandler = $wgrealestate->getHandler('cost_types');
		$costCostt_idSelect = new XoopsFormSelect( _AM_WGREALESTATE_COST_TYPES, 'cost_costt_id', $this->getVar('cost_costt_id'));
        $costCostt_idSelect->addOption('', '');
		$costCostt_idSelect->addOptionArray($cost_typesHandler->getList());
		$costCostt_idSelect->setExtra("onchange='changePerc(this.value)'");
		$form->addElement($costCostt_idSelect);
		// Form Select Costs
		$objectsHandler = $wgrealestate->getHandler('objects');
		$costObj_idSelect = new XoopsFormSelect( _CO_WGREALESTATE_OBJECTS, 'cost_obj_id', $this->getVar('cost_obj_id'));
		$costObj_idSelect->addOptionArray($objectsHandler->getList());
		$form->addElement($costObj_idSelect);
		// Form Text CostPerc
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_COST_PERC, 'cost_perc_1', 50, 255, $this->getVar('cost_perc') ));
		// Form Text CostBase
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_COST_BASE, 'cost_base_1', 50, 255, $this->getVar('cost_base') ));
		// Form Text CostValue
		$eleValueTray = new XoopsFormElementTray(_CO_WGREALESTATE_COST_VALUE, ' ' );
		$eleValueTray->addElement(new XoopsFormText( '', 'cost_value_1', 50, 255, $this->getVar('cost_value') ));
		$eleValueBtn = new XoopsFormButton('', '', _CO_WGREALESTATE_COST_CALC, '');
		$eleValueBtn->setExtra("onclick='calculate(1)'");
		$eleValueTray->addElement($eleValueBtn);
		$form->addElement($eleValueTray);
		// Form editor CostInfo
		$editorConfigs = array();
		$editorConfigs['name'] = 'cost_info';
		$editorConfigs['value'] = $this->getVar('cost_info', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wgrealestate->getConfig('wgrealestate_editor');
		$form->addElement(new XoopsFormEditor( _CO_WGREALESTATE_COST_INFO, 'cost_info', $editorConfigs));
		// Form Select TextDate
        $costDatecreate = $this->isNew() ? 0 : $this->getVar('cost_datecreate');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_DATECREATE, 'cost_datecreate', '', $costDatecreate ));
		// Form Select User
		$form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'cost_submitter', false, $this->getVar('cost_submitter') ));
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
	public function getValuesCosts($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('cost_id');
        $ret['obj_id'] = $this->getVar('cost_obj_id');
		// $objects = $wgrealestate->getHandler('objects');
		// $obj_object = $objects->get($this->getVar('cost_obj_id'));
		// $ret['obj_title'] = $obj_object->getVar('obj_title');
		$cost_types = $wgrealestate->getHandler('cost_types');
		$cost_costt_id = $cost_types->get($this->getVar('cost_costt_id'));
		$ret['costt_text'] = $cost_costt_id->getVar('costt_text');
		$ret['costt_index'] = $cost_costt_id->getVar('costt_index');
		$ret['perc'] = $this->getVar('cost_perc');
		$ret['base'] = $this->getVar('cost_base');
		$ret['value'] = $this->getVar('cost_value');
		$ret['value_user'] = $wgrealestate->getCurrencyFormatted($this->getVar('cost_value'));
		$ret['info'] = strip_tags($this->getVar('cost_info'));
		$ret['datecreate'] = formatTimeStamp($this->getVar('cost_datecreate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('cost_submitter'));
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayCosts()
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
 * Class Object Handler WgrealestateCosts
 */
class WgrealestateCostsHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgrealestate_costs', 'wgrealestatecosts', 'cost_id', 'cost_obj_id');
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
	 * Get Count Costs in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountCosts($start = 0, $limit = 0, $sort = 'cost_id ASC, cost_obj_id', $order = 'ASC')
	{
		$crCountCosts = new CriteriaCompo();
		$crCountCosts = $this->getCostsCriteria($crCountCosts, $start, $limit, $sort, $order);
		return parent::getCount($crCountCosts);
	}

	/**
	 * Get All Costs in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllCosts($start = 0, $limit = 0, $sort = 'cost_id ASC, cost_obj_id', $order = 'ASC')
	{
		$crAllCosts = new CriteriaCompo();
		$crAllCosts = $this->getCostsCriteria($crAllCosts, $start, $limit, $sort, $order);
		return parent::getAll($crAllCosts);
	}

	/**
	 * Get Criteria Costs
	 * @param        $crCosts
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getCostsCriteria($crCosts, $start, $limit, $sort, $order)
	{
		$crCosts->setStart( $start );
		$crCosts->setLimit( $limit );
		$crCosts->setSort( $sort );
		$crCosts->setOrder( $order );
		return $crCosts;
	}

    /**
     * @public function getForm
     * @param $objId
     * @param bool $action
     * @return XoopsThemeForm
     */
	public function getFormCostsUser($objId, $action = false)
	{
        // Get instance of module
        $wgrealestate = WgrealestateHelper::getInstance();
        $cost_typesHandler = $wgrealestate->getHandler('cost_types');
        $objectsHandler = $wgrealestate->getHandler('objects');
        $costsHandler = $wgrealestate->getHandler('costs');

		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_CO_WGREALESTATE_COST_ADD) : sprintf(_CO_WGREALESTATE_COST_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');

        // get oject details
        $objectObj = $objectsHandler->get($objId); 
        $dealtype = $objectObj->getVar('obj_dealt_id');
        // get all cats for additional object attdefaults for current dealtype
        $crit_costt = new CriteriaCompo();
        $crit_costt->add(new Criteria('costt_dealt_id', 0), 'OR');
        $crit_costt->add(new Criteria('costt_dealt_id', $dealtype), 'OR');
        $crit_costt->add(new Criteria('costt_valid', 1));
        $crit_costt->setOrder('ASC');
        $cost_typesCount = $cost_typesHandler->getCount($crit_costt);
        $cost_typesAll = $cost_typesHandler->getAll($crit_costt);

        $counter = 0;
        if($cost_typesCount > 0) {
            foreach(array_keys($cost_typesAll) as $i) {
                $cost_types[$i] = $cost_typesAll[$i]->getValuesCost_types();
                $costt_id = $cost_types[$i]['costt_id'];
                $costt_text = $cost_types[$i]['costt_text'];
				$costt_perc = $cost_types[$i]['costt_perc'];
                // get additional object attdefaults for current object
                $crit_cost = new CriteriaCompo();
                $crit_cost->add(new Criteria('cost_obj_id', $objId));
                $crit_cost->add(new Criteria('cost_costt_id', $costt_id));
                $costsCount = $costsHandler->getCount($crit_cost);
                $costsAll = $costsHandler->getAll($crit_cost);
                
                // reset values
                $cost_id = 0;
				$cost_perc = 0;
				$cost_base = 0;
                $cost_value = '';
                $cost_info = '';
                if($costsCount > 0) {
                    $costs = array();
                    // Get All costs
                    foreach(array_keys($costsAll) as $j) {
                        $costs[$j] = $costsAll[$j]->getValuesCosts();
                        $cost_id = $costs[$j]['cost_id']; 
						$cost_costt_id = $costs[$j]['cost_costt_id'];
                        $cost_perc = $costs[$j]['perc'];
						$cost_base = $costs[$j]['base'];
						$cost_value = $costs[$j]['value'];
                        $cost_info = $costs[$j]['info'];
                    }
                }

                unset($crit_cost, $costs);

                // overwrite with default value
				if (0 == $cost_perc && 0 < $costt_perc) {
					$cost_perc = $costt_perc;
				}
                $counter++;
				$form->addElement(new XoopsFormLabel('', '<span class="wgre-attcatname">' . $costt_text . '</span>'));
				if (0 < $cost_perc) {
					$form->addElement(new XoopsFormText( _CO_WGREALESTATE_COST_PERC, 'cost_perc_' . $counter, 50, 255, $cost_perc)); 
					$form->addElement(new XoopsFormText( _CO_WGREALESTATE_COST_BASE, 'cost_base_' . $counter, 50, 255, $cost_base)); 
				}
				$eleValueTray = new XoopsFormElementTray(_CO_WGREALESTATE_COST_VALUE, '&nbsp;' );
				$eleValueTray->addElement(new XoopsFormText( '', 'cost_value_' . $counter, 50, 255, $cost_value));
				$eleValueTray->addElement(new XoopsFormLabel( _CO_WGREALESTATE_CURRENCY, '&nbsp;&nbsp;&nbsp;' ));
				if (0 < $cost_perc) {
					$eleValueBtn = new XoopsFormButton('', '', _CO_WGREALESTATE_COST_CALC, '');
					$eleValueBtn->setExtra("onclick='calculate(" . $counter . ")'");
					$eleValueTray->addElement($eleValueBtn);
				}
				$form->addElement($eleValueTray);

                $form->addElement(new XoopsFormText( _CO_WGREALESTATE_INFO, 'cost_info_' . $counter, 50, 255, $cost_info));
                $form->addElement(new XoopsFormHidden('cost_id_' . $counter,  $cost_id));
                $form->addElement(new XoopsFormHidden('cost_costt_id_' . $counter,  $costt_id));
                // echo " costt_text:" . $costt_text;
                // echo " costsCount:". $costsCount;
                // echo " cost_value:". $cost_value ." cost_info:". $cost_info;
            }
        }

		// To Save
		$form->addElement(new XoopsFormHidden('obj_id', $objId));
        $form->addElement(new XoopsFormHidden('counter', $counter));
        $form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}
}
