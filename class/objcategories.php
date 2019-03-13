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
 * @version        $Id: 1.0 objcategories.php 1 Sun 2018-01-07 21:18:20Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgrealestateObjcategories
 */
class WgrealestateObjcategories extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('objcat_id', XOBJ_DTYPE_INT);
		$this->initVar('objcat_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('objcat_valid', XOBJ_DTYPE_TXTBOX);
		$this->initVar('objcat_datecreate', XOBJ_DTYPE_INT);
		$this->initVar('objcat_submitter', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdObjcategories()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormObjcategories($action = false)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGREALESTATE_OBJCAT_CATEGORY_ADD) : sprintf(_AM_WGREALESTATE_OBJCAT_CATEGORY_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text ObjcatName
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_OBJCAT_CATEGORY_NAME, 'objcat_name', 50, 255, $this->getVar('objcat_name') ), true);
		// Form Radio Yes/No
		$objcatValid = $this->isNew() ? 1 : $this->getVar('objcat_valid');
		$form->addElement(new XoopsFormRadioYN( _CO_WGREALESTATE_TYPE_VALID, 'objcat_valid', $objcatValid), true);
		// Form Text Date Select
		$objcatDatecreate = $this->isNew() ? 0 : $this->getVar('objcat_datecreate');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_DATECREATE, 'objcat_datecreate', '', $objcatDatecreate ));
		// Form Select User
		$form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'objcat_submitter', false, $this->getVar('objcat_submitter') ));
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
	public function getValuesObjcategories($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('objcat_id');
		$ret['name'] = $this->getVar('objcat_name');
		$ret['valid'] = $this->getVar('objcat_valid');
		$ret['datecreate'] = formatTimeStamp($this->getVar('objcat_datecreate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('objcat_submitter'));
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayObjcategories()
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
 * Class Object Handler WgrealestateObjcategories
 */
class WgrealestateObjcategoriesHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgrealestate_objcategories', 'wgrealestateobjcategories', 'objcat_id', 'objcat_name');
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
	 * Get Count Objcategories in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountObjcategories($start = 0, $limit = 0, $sort = 'objcat_id ASC, objcat_name', $order = 'ASC')
	{
		$crCountObjcategories = new CriteriaCompo();
		$crCountObjcategories = $this->getObjcategoriesCriteria($crCountObjcategories, $start, $limit, $sort, $order);
		return parent::getCount($crCountObjcategories);
	}

	/**
	 * Get All Objcategories in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllObjcategories($start = 0, $limit = 0, $sort = 'objcat_id ASC, objcat_name', $order = 'ASC')
	{
		$crAllObjcategories = new CriteriaCompo();
		$crAllObjcategories = $this->getObjcategoriesCriteria($crAllObjcategories, $start, $limit, $sort, $order);
		return parent::getAll($crAllObjcategories);
	}

	/**
	 * Get Criteria Objcategories
	 * @param        $crObjcategories
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getObjcategoriesCriteria($crObjcategories, $start, $limit, $sort, $order)
	{
		$crObjcategories->setStart( $start );
		$crObjcategories->setLimit( $limit );
		$crObjcategories->setSort( $sort );
		$crObjcategories->setOrder( $order );
		return $crObjcategories;
	}
}
