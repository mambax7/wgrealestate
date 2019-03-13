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
 * @version        $Id: 1.0 attdefaults.php 1 Sun 2018-01-07 21:18:20Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgrealestateAttdefaults
 */
class WgrealestateAttdefaults extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('attdef_id', XOBJ_DTYPE_INT);
		$this->initVar('attdef_parent', XOBJ_DTYPE_INT);
		$this->initVar('attdef_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('attdef_dealtid', XOBJ_DTYPE_INT);
        $this->initVar('attdef_attcatid', XOBJ_DTYPE_INT);
		$this->initVar('attdef_type', XOBJ_DTYPE_INT);
		$this->initVar('attdef_index', XOBJ_DTYPE_INT);
        $this->initVar('attdef_weight', XOBJ_DTYPE_INT);
		$this->initVar('attdef_valid', XOBJ_DTYPE_INT);
		$this->initVar('attdef_datecreate', XOBJ_DTYPE_INT);
		$this->initVar('attdef_submitter', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdAttdefaults()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormAttdefaults($action = false)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGREALESTATE_ATTDEFAULTS_ADD) : sprintf(_AM_WGREALESTATE_ATTDEFAULTS_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		
		// Form Select AttdefParent
		$attdef_parent = $this->isNew() ? 0 : $this->getVar('attdef_parent');
        $crit_parent = new CriteriaCompo();
		$crit_parent->add(new Criteria('attdef_parent', 0));
        $crit_parent->setSort('attdef_weight');
        $crit_parent->setOrder('ASC');
		$attdefaultsHandler = $wgrealestate->getHandler('attdefaults');
		$attdefParentSelect = new XoopsFormSelect( _AM_WGREALESTATE_ATTDEFAULTS_PARENT, 'attdef_parent', $attdef_parent); 
		$attdefParentSelect->addOption(0, ' ');
		$attdefParentSelect->addOptionArray($attdefaultsHandler->getList($crit_parent));
		$form->addElement($attdefParentSelect);
		// Form Text AttdefName
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_ATTDEFAULTS_NAME, 'attdef_name', 50, 255, $this->getVar('attdef_name') ), true);
		// Form Select Attdefaults
		if ($attdef_parent == 0) {
			$attdefTypeSelect = new XoopsFormSelect( _AM_WGREALESTATE_ATTDEFAULTS_TYPE, 'attdef_type', $this->getVar('attdef_type'));
			$attdefTypeSelect->addOption(WGREALESTATE_ATTR_NONE_VAL, _CO_WGREALESTATE_NONE);
			$attdefTypeSelect->addOption(WGREALESTATE_ATTR_YN_VAL, _CO_WGREALESTATE_ATTR_YN);
			$attdefTypeSelect->addOption(WGREALESTATE_ATTR_TEXT_VAL, _CO_WGREALESTATE_ATTR_TEXT);
			$attdefTypeSelect->addOption(WGREALESTATE_ATTR_TEXT_M2_VAL, _CO_WGREALESTATE_ATTR_TEXT_M2);
			$attdefTypeSelect->addOption(WGREALESTATE_ATTR_TEXT_CURR_VAL, _CO_WGREALESTATE_ATTR_TEXT_CURR);
			$attdefTypeSelect->addOption(WGREALESTATE_ATTR_TEXTAREA_VAL, _CO_WGREALESTATE_ATTR_TEXTAREA);
			$attdefTypeSelect->addOption(WGREALESTATE_ATTR_SELECT_VAL, _CO_WGREALESTATE_ATTR_SELECT);
			$attdefTypeSelect->addOption(WGREALESTATE_ATTR_TEXT_KWH_VAL, _CO_WGREALESTATE_ATTR_TEXT_KWH);
			$form->addElement($attdefTypeSelect, true);
		} else {
			$form->addElement(new XoopsFormLabel( _AM_WGREALESTATE_ATTDEFAULTS_TYPE, _CO_WGREALESTATE_ATTR_SELECT_ITEM));
		}
		// Form Select deal types
		$attdefDealt_idSelect = new XoopsFormSelect( _AM_WGREALESTATE_DEALTYPES, 'attdef_dealtid', $this->getVar('attdef_dealtid'));
		$attdefDealt_idSelect->addOption(0, _CO_WGREALESTATE_ALL);
		$attdefDealt_idSelect->addOption(WGREALESTATE_DEALTYPE_RENT_VAL, _CO_WGREALESTATE_DEALTYPE_RENT);
		$attdefDealt_idSelect->addOption(WGREALESTATE_DEALTYPE_SALE_VAL, _CO_WGREALESTATE_DEALTYPE_SALE);
		$form->addElement($attdefDealt_idSelect, true);
        // Form Select Attcategories
        $crit_attcat = new CriteriaCompo();
        $crit_attcat->setSort('attcat_weight');
        $crit_attcat->setOrder('ASC');
        $attcategoriesHandler = $wgrealestate->getHandler('attcategories');
        $attdefAttcatidSelect = new XoopsFormSelect( _AM_WGREALESTATE_ATTCATEGORY_NAME, 'attdef_attcatid', $this->getVar('attdef_attcatid'));
		$attdefAttcatidSelect->addOption(0, _CO_WGREALESTATE_NONE);
        $attdefAttcatidSelect->addOptionArray($attcategoriesHandler->getList($crit_attcat));
		$form->addElement($attdefAttcatidSelect, true);
		// Form Text Index
		$attdefIndex = $this->isNew() ? 0 : $this->getVar('attdef_index');
        $attdefIndexSelect = new XoopsFormRadio( _CO_WGREALESTATE_INDEX_SHOW, 'attdef_index', $attdefIndex);
		$attdefIndexSelect->addOption(0, _CO_WGREALESTATE_NONE);
		$attdefIndexSelect->addOption(1, _CO_WGREALESTATE_INDEX_HEADER);
		$attdefIndexSelect->addOption(2, _CO_WGREALESTATE_INDEX_MISC);
		$form->addElement($attdefIndexSelect, true);
        // Form Text Weight
		$attdefWeight = $this->isNew() ? 1000 : $this->getVar('attdef_weight');
        $form->addElement(new XoopsFormHidden( 'attdef_weight', $attdefWeight));
		// Form Radio Yes/No
		$attdefValid = $this->isNew() ? 1 : $this->getVar('attdef_valid');
		$form->addElement(new XoopsFormRadioYN( _CO_WGREALESTATE_TYPE_VALID, 'attdef_valid', $attdefValid), true);
		// Form Text Date Select
		$attdefDatecreate = $this->isNew() ? 0 : $this->getVar('attdef_datecreate');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_DATECREATE, 'attdef_datecreate', '', $attdefDatecreate ));
		// Form Select User
		$form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'attdef_submitter', false, $this->getVar('attdef_submitter') ));
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
	public function getValueAttdefaults($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('attdef_id');
		$ret['parent'] = $this->getVar('attdef_parent');
		$ret['name'] = $this->getVar('attdef_name');
        $ret['dealtype_id'] = $this->getVar('attdef_dealtid');
		$ret['dealtype'] = (WGREALESTATE_DEALTYPE_RENT_VAL == $this->getVar('attdef_dealtid')) ? _CO_WGREALESTATE_DEALTYPE_RENT : _CO_WGREALESTATE_DEALTYPE_SALE;
        if (0 == $ret['dealtype_id']) {$ret['dealtype'] = _CO_WGREALESTATE_ALL;}
        $ret['attcat_id'] = $this->getVar('attdef_attcatid');
		$attcategories = $wgrealestate->getHandler('attcategories');
		$attcategoryObj = $attcategories->get($this->getVar('attdef_attcatid'));
        $ret['attcat_name'] = $attcategoryObj->getVar('attcat_name');
        $ret['type'] = $this->getVar('attdef_type');
        $ret['type_text'] = $wgrealestate->getAddCatText($this->getVar('attdef_type'));
		$ret['index'] = $this->getVar('attdef_index');
		switch ($this->getVar('attdef_index')) {
			case WGREALESTATE_INDEX_HEADER_VAL:
				$ret['index_text'] = _CO_WGREALESTATE_INDEX_HEADER;
			break;
			case WGREALESTATE_INDEX_MISC_VAL:
				$ret['index_text'] = _CO_WGREALESTATE_INDEX_MISC;
			break;
			case 0:
			default:
				$ret['index_text'] = _CO_WGREALESTATE_NONE;
			break;
		}
        $ret['weight'] = $this->getVar('attdef_weight');
		$ret['valid'] = $this->getVar('attdef_valid');
		$ret['datecreate'] = formatTimeStamp($this->getVar('attdef_datecreate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('attdef_submitter'));
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayAttdefaults()
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
 * Class Object Handler WgrealestateAttdefaults
 */
class WgrealestateAttdefaultsHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgrealestate_attdefaults', 'wgrealestateattdefaults', 'attdef_id', 'attdef_name');
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
	 * Get Count Attdefaults in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
     
     
     // attdef_attcatid ASC, 
	public function getCountAttdefaults($start = 0, $limit = 0, $sort = 'attdef_weight', $order = 'ASC')
	{
		$crCountAttdefaults = new CriteriaCompo();
		$crCountAttdefaults = $this->getAttdefaultsCriteria($crCountAttdefaults, $start, $limit, $sort, $order);
		return parent::getCount($crCountAttdefaults);
	}

	/**
	 * Get All Attdefaults in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllAttdefaults($start = 0, $limit = 0, $sort = 'attdef_attcatid ASC, attdef_weight', $order = 'ASC')
	{
		$crAllAttdefaults = new CriteriaCompo();
		$crAllAttdefaults = $this->getAttdefaultsCriteria($crAllAttdefaults, $start, $limit, $sort, $order);
		return parent::getAll($crAllAttdefaults);
	}

	/**
	 * Get Criteria Attdefaults
	 * @param        $crAttdefaults
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getAttdefaultsCriteria($crAttdefaults, $start, $limit, $sort, $order)
	{
		$crAttdefaults->setStart( $start );
		$crAttdefaults->setLimit( $limit );
		$crAttdefaults->setSort( $sort );
		$crAttdefaults->setOrder( $order );
		return $crAttdefaults;
	}
}
