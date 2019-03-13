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
 * @version        $Id: 1.0 cost_types.php 1 Sun 2018-01-07 21:18:22Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgrealestateCost_types
 */
class WgrealestateCost_types extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('costt_id', XOBJ_DTYPE_INT);
		$this->initVar('costt_text', XOBJ_DTYPE_TXTBOX);
		$this->initVar('costt_dealt_id', XOBJ_DTYPE_INT);
		$this->initVar('costt_perc', XOBJ_DTYPE_FLOAT);
		$this->initVar('costt_fixed', XOBJ_DTYPE_FLOAT);
		$this->initVar('costt_info', XOBJ_DTYPE_TXTBOX);
		$this->initVar('costt_index', XOBJ_DTYPE_INT);
        $this->initVar('costt_valid', XOBJ_DTYPE_INT);
		$this->initVar('costt_datecreate', XOBJ_DTYPE_INT);
		$this->initVar('costt_submitter', XOBJ_DTYPE_INT);
		
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
	public function getNewInsertedIdCost_types()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormCost_types($action = false)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGREALESTATE_COST_TYPE_ADD) : sprintf(_AM_WGREALESTATE_COST_TYPE_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text CosttType
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_COST_TYPE_TEXT, 'costt_text', 50, 255, $this->getVar('costt_text') ), true);
		// Form Text CosttValue
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_COST_TYPE_PERC, 'costt_perc', 50, 255, $this->getVar('costt_perc') ));
		// Form Text CosttFixed
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_COST_TYPE_FIXED, 'costt_fixed', 50, 255, $this->getVar('costt_fixed') ));
		// Form Text CosttInfo
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_TYPE_INFO, 'costt_info', 50, 255, $this->getVar('costt_info') ));
		// Form Select costt_dealt_id
		$costtDealt_idSelect = new XoopsFormSelect( _AM_WGREALESTATE_DEALTYPE_TYPE, 'costt_dealt_id', $this->getVar('costt_dealt_id'));
		$costtDealt_idSelect->addOption(0, _CO_WGREALESTATE_ALL);
        $costtDealt_idSelect->addOption(WGREALESTATE_DEALTYPE_RENT_VAL, _CO_WGREALESTATE_DEALTYPE_RENT);
		$costtDealt_idSelect->addOption(WGREALESTATE_DEALTYPE_SALE_VAL, _CO_WGREALESTATE_DEALTYPE_SALE);
		$form->addElement($costtDealt_idSelect, true);
		 // Form Radio Yes/No
		$costtIndex = $this->isNew() ? 0 : $this->getVar('costt_index');
		$form->addElement(new XoopsFormRadioYN( _CO_WGREALESTATE_INDEX_SHOW, 'costt_index', $costtIndex), true);
        // Form Radio Yes/No
		$costtValid = $this->isNew() ? 1 : $this->getVar('costt_valid');
		$form->addElement(new XoopsFormRadioYN( _CO_WGREALESTATE_TYPE_VALID, 'costt_valid', $costtValid), true);
		// Form Text Date Select
		$costtDatecreate = $this->isNew() ? 0 : $this->getVar('costt_datecreate');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_DATECREATE, 'costt_datecreate', '', $costtDatecreate ));
		// Form Select User
		$form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'costt_submitter', false, $this->getVar('costt_submitter') ));
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
	public function getValuesCost_types($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('costt_id');
		$ret['type'] = $this->getVar('costt_text');
        $ret['dealtype_id'] = $this->getVar('costt_dealt_id');
		$ret['dealtype'] = (WGREALESTATE_DEALTYPE_RENT_VAL == $this->getVar('costt_dealt_id')) ? _CO_WGREALESTATE_DEALTYPE_RENT : _CO_WGREALESTATE_DEALTYPE_SALE;
        if (0 == $ret['dealtype_id']) { $ret['dealtype'] = _CO_WGREALESTATE_ALL; }
		$ret['perc'] = $this->getVar('costt_perc');
		$ret['fixed'] = $this->getVar('costt_fixed');
		$ret['info'] = $this->getVar('costt_info');
		$ret['index'] = $this->getVar('costt_index');
		$ret['valid'] = $this->getVar('costt_valid');
		$ret['datecreate'] = formatTimeStamp($this->getVar('costt_datecreate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('costt_submitter'));
		
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayCost_types()
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
 * Class Object Handler WgrealestateCost_types
 */
class WgrealestateCost_typesHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgrealestate_cost_types', 'wgrealestatecost_types', 'costt_id', 'costt_text');
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
	 * Get Count Cost_types in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountCost_types($start = 0, $limit = 0, $sort = 'costt_id ASC, costt_text', $order = 'ASC')
	{
		$crCountCost_types = new CriteriaCompo();
		$crCountCost_types = $this->getCost_typesCriteria($crCountCost_types, $start, $limit, $sort, $order);
		return parent::getCount($crCountCost_types);
	}

	/**
	 * Get All Cost_types in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllCost_types($start = 0, $limit = 0, $sort = 'costt_id ASC, costt_text', $order = 'ASC')
	{
		$crAllCost_types = new CriteriaCompo();
		$crAllCost_types = $this->getCost_typesCriteria($crAllCost_types, $start, $limit, $sort, $order);
		return parent::getAll($crAllCost_types);
	}

	/**
	 * Get Criteria Cost_types
	 * @param        $crCost_types
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getCost_typesCriteria($crCost_types, $start, $limit, $sort, $order)
	{
		$crCost_types->setStart( $start );
		$crCost_types->setLimit( $limit );
		$crCost_types->setSort( $sort );
		$crCost_types->setOrder( $order );
		return $crCost_types;
	}
}
