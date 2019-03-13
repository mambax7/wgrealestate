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
 * @version        $Id: 1.0 sellers.php 1 Sun 2018-01-07 21:18:23Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgrealestateSellers
 */
class WgrealestateSellers extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('seller_id', XOBJ_DTYPE_INT);
		$this->initVar('seller_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('seller_ctry', XOBJ_DTYPE_TXTBOX);
		$this->initVar('seller_postal_code', XOBJ_DTYPE_TXTBOX);
		$this->initVar('seller_city', XOBJ_DTYPE_TXTBOX);
		$this->initVar('seller_address', XOBJ_DTYPE_TXTBOX);
		$this->initVar('seller_phone', XOBJ_DTYPE_TXTBOX);
		$this->initVar('seller_mail', XOBJ_DTYPE_TXTBOX);
		$this->initVar('seller_cat', XOBJ_DTYPE_INT);
		$this->initVar('seller_public', XOBJ_DTYPE_INT);
		$this->initVar('seller_datecreate', XOBJ_DTYPE_INT);
		$this->initVar('seller_submitter', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdSellers()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormSellers($action = false)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGREALESTATE_SELLER_ADD) : sprintf(_AM_WGREALESTATE_SELLER_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text SellerName
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_SELLER_NAME, 'seller_name', 50, 255, $this->getVar('seller_name') ), true);
		// Form Text SellerCtry
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_SELLER_CTRY, 'seller_ctry', 50, 255, $this->getVar('seller_ctry') ));
		// Form Text SellerPostal_code
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_SELLER_POSTAL_CODE, 'seller_postal_code', 50, 255, $this->getVar('seller_postal_code') ));
		// Form Text SellerCity
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_SELLER_CITY, 'seller_city', 50, 255, $this->getVar('seller_city') ));
		// Form Text SellerAddress
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_SELLER_ADDRESS, 'seller_address', 50, 255, $this->getVar('seller_address') ));
		// Form Text SellerPhone
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_SELLER_PHONE, 'seller_phone', 50, 255, $this->getVar('seller_phone') ));
		// Form Text SellerMail
		$form->addElement(new XoopsFormText( _AM_WGREALESTATE_SELLER_MAIL, 'seller_mail', 50, 255, $this->getVar('seller_mail') ));
		// Form Select
		$sellerCatSelect = new XoopsFormSelect( _AM_WGREALESTATE_SELLER_CAT, 'seller_cat', $this->getVar('seller_cat'));
		$sellerCatSelect->addOption('Empty');
		$form->addElement($sellerCatSelect);
		// Form Radio Yes/No
		$sellerPublic = $this->isNew() ? 0 : $this->getVar('seller_public');
		$form->addElement(new XoopsFormRadioYN( _AM_WGREALESTATE_SELLER_PUBLIC, 'seller_public', $sellerPublic));
		// Form Text Date Select
		$sellerDatecreate = $this->isNew() ? 0 : $this->getVar('seller_datecreate');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_DATECREATE, 'seller_datecreate', '', $sellerDatecreate ));
		// Form Select User
		$form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'seller_submitter', false, $this->getVar('seller_submitter') ));
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
	public function getValuesSellers($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('seller_id');
		$ret['name'] = $this->getVar('seller_name');
		$ret['ctry'] = $this->getVar('seller_ctry');
		$ret['postal_code'] = $this->getVar('seller_postal_code');
		$ret['city'] = $this->getVar('seller_city');
		$ret['address'] = $this->getVar('seller_address');
		$ret['phone'] = $this->getVar('seller_phone');
		$ret['mail'] = $this->getVar('seller_mail');
		$ret['cat'] = $this->getVar('seller_cat');
		$ret['public'] = $this->getVar('seller_public');
		$ret['datecreate'] = formatTimeStamp($this->getVar('seller_datecreate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('seller_submitter'));
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArraySellers()
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
 * Class Object Handler WgrealestateSellers
 */
class WgrealestateSellersHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgrealestate_sellers', 'wgrealestatesellers', 'seller_id', 'seller_name');
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
	 * Get Count Sellers in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountSellers($start = 0, $limit = 0, $sort = 'seller_id ASC, seller_name', $order = 'ASC')
	{
		$crCountSellers = new CriteriaCompo();
		$crCountSellers = $this->getSellersCriteria($crCountSellers, $start, $limit, $sort, $order);
		return parent::getCount($crCountSellers);
	}

	/**
	 * Get All Sellers in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllSellers($start = 0, $limit = 0, $sort = 'seller_id ASC, seller_name', $order = 'ASC')
	{
		$crAllSellers = new CriteriaCompo();
		$crAllSellers = $this->getSellersCriteria($crAllSellers, $start, $limit, $sort, $order);
		return parent::getAll($crAllSellers);
	}

	/**
	 * Get Criteria Sellers
	 * @param        $crSellers
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getSellersCriteria($crSellers, $start, $limit, $sort, $order)
	{
		$crSellers->setStart( $start );
		$crSellers->setLimit( $limit );
		$crSellers->setSort( $sort );
		$crSellers->setOrder( $order );
		return $crSellers;
	}
}
