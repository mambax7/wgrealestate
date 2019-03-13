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
 * @version        $Id: 1.0 attcategories.php 1 Sun 2018-01-07 21:18:21Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgrealestateAttcategories
 */
class WgrealestateAttcategories extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('attcat_id', XOBJ_DTYPE_INT);
		$this->initVar('attcat_name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('attcat_info', XOBJ_DTYPE_TXTBOX);
        $this->initVar('attcat_show', XOBJ_DTYPE_INT);
        $this->initVar('attcat_weight', XOBJ_DTYPE_INT);
		$this->initVar('attcat_valid', XOBJ_DTYPE_INT);
		$this->initVar('attcat_datecreate', XOBJ_DTYPE_INT);
		$this->initVar('attcat_submitter', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdAttcategories()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormAttcategories($action = false)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGREALESTATE_ATTCATEGORY_ADD) : sprintf(_AM_WGREALESTATE_ATTCATEGORY_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text attcatType
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_ATTCATEGORY_NAME, 'attcat_name', 50, 255, $this->getVar('attcat_name') ), true);
		// Form Text attcatInfo
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_TYPE_INFO, 'attcat_info', 50, 255, $this->getVar('attcat_info') ));
        // Form Radio Yes/No
		$attcatShow = $this->isNew() ? 1 : $this->getVar('attcat_show');
		$form->addElement(new XoopsFormRadioYN( _AM_WGREALESTATE_ATTCATEGORY_NAME_SHOW, 'attcat_show', $attcatShow), true);
        // Form Text attcatInfo
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_WEIGHT, 'attcat_weight', 50, 255, $this->getVar('attcat_weight') ));
        // Form Radio Yes/No
		$attcatValid = $this->isNew() ? 1 : $this->getVar('attcat_valid');
		$form->addElement(new XoopsFormRadioYN( _CO_WGREALESTATE_TYPE_VALID, 'attcat_valid', $attcatValid), true);
		// Form Text Date Select
		$attcatDatecreate = $this->isNew() ? 0 : $this->getVar('attcat_datecreate');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_DATECREATE, 'attcat_datecreate', '', $attcatDatecreate ));
		// Form Select User
		$form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'attcat_submitter', false, $this->getVar('attcat_submitter') ));
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
	public function getValuesAttcategories($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('attcat_id');
		$ret['name'] = $this->getVar('attcat_name');
        $ret['info'] = $this->getVar('attcat_info');
		$ret['valid'] = $this->getVar('attcat_valid');
        $ret['weight'] = $this->getVar('attcat_weight');
        $ret['show'] = $this->getVar('attcat_show');
		$ret['datecreate'] = formatTimeStamp($this->getVar('attcat_datecreate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('attcat_submitter'));
		
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayAttcategories()
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
 * Class Object Handler WgrealestateAttcategories
 */
class WgrealestateAttcategoriesHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgrealestate_attcategories', 'wgrealestateattcategories', 'attcat_id', 'attcat_name');
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
	 * Get Count Attcategories in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountAttcategories($start = 0, $limit = 0, $sort = 'attcat_weight', $order = 'ASC')
	{
		$crCountAttcategories = new CriteriaCompo();
		$crCountAttcategories = $this->getAttcategoriesCriteria($crCountAttcategories, $start, $limit, $sort, $order);
		return parent::getCount($crCountAttcategories);
	}

	/**
	 * Get All Attcategories in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllAttcategories($start = 0, $limit = 0, $sort = 'attcat_weight', $order = 'ASC')
	{
		$crAllAttcategories = new CriteriaCompo();
		$crAllAttcategories = $this->getAttcategoriesCriteria($crAllAttcategories, $start, $limit, $sort, $order);
		return parent::getAll($crAllAttcategories);
	}

	/**
	 * Get Criteria Attcategories
	 * @param        $crAttcategories
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getAttcategoriesCriteria($crAttcategories, $start, $limit, $sort, $order)
	{
		$crAttcategories->setStart( $start );
		$crAttcategories->setLimit( $limit );
		$crAttcategories->setSort( $sort );
		$crAttcategories->setOrder( $order );
		return $crAttcategories;
	}
}
