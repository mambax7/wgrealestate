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
 * @version        $Id: 1.0 files.php 1 Sun 2018-01-07 21:18:23Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgrealestateFiles
 */
class WgrealestateFiles extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('file_id', XOBJ_DTYPE_INT);
		$this->initVar('file_obj_id', XOBJ_DTYPE_INT);
		$this->initVar('file_title', XOBJ_DTYPE_TXTBOX);
        $this->initVar('file_info', XOBJ_DTYPE_TXTAREA);
		$this->initVar('file_name', XOBJ_DTYPE_TXTAREA);
		$this->initVar('file_type', XOBJ_DTYPE_TXTBOX);
		$this->initVar('file_size', XOBJ_DTYPE_INT);
		$this->initVar('file_weight', XOBJ_DTYPE_INT);
		$this->initVar('file_datecreate', XOBJ_DTYPE_INT);
		$this->initVar('file_submitter', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdFiles()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormFiles($action = false)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Permissions for uploader
		$gpermHandler = xoops_gethandler('groupperm');
		$groups = is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->getGroups() : XOOPS_GROUP_ANONYMOUS;
		if($GLOBALS['xoopsUser']) {
			if(!$GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid())) {
				$permissionUpload = $gpermHandler->checkRight('', 32, $groups, $GLOBALS['xoopsModule']->getVar('mid')) ? true : false;
			} else {
				$permissionUpload = true;
			}
		} else {
				$permissionUpload = $gpermHandler->checkRight('', 32, $groups, $GLOBALS['xoopsModule']->getVar('mid')) ? true : false;
		}
		// Title
		$title = $this->isNew() ? sprintf(_CO_WGREALESTATE_FILE_ADD) : sprintf(_CO_WGREALESTATE_FILE_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Select Files
		$objectsHandler = $wgrealestate->getHandler('objects');
		$fileObj_idSelect = new XoopsFormSelect( _CO_WGREALESTATE_OBJECT, 'file_obj_id', $this->getVar('file_obj_id'));
		$fileObj_idSelect->addOptionArray($objectsHandler->getList());
		$form->addElement($fileObj_idSelect, true);
		        
        // Form FileTitle
        $fileTitle = $this->isNew() ? '' : $this->getVar('file_title');
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_FILE_TITLE, 'file_title', 50, 255, $fileTitle ), true);
		
        // Form editor ImgInfos
		$editorConfigs = array();
		$editorConfigs['name'] = 'file_info';
		$editorConfigs['value'] = $this->getVar('file_info', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wgrealestate->getConfig('wgrealestate_editor');
		$form->addElement(new XoopsFormEditor( _CO_WGREALESTATE_FILE_INFO, 'file_info', $editorConfigs));
		
		// Form File
		$form->addElement(new XoopsFormFile( _CO_WGREALESTATE_FILE_NAME, 'file_name', $wgrealestate->getConfig('maxsize') ));
		// Form File type
		if (!$this->isNew()) {
			$form->addElement(new XoopsFormLabel( _CO_WGREALESTATE_FILE_TYPE, $this->getVar('file_type') ));
		}
		$form->addElement(new XoopsFormHidden('file_type', $this->getVar('file_type')));
		
		// Form Text FileWeight
		$fileWeight = $this->isNew() ? '0' : $this->getVar('file_weight');
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_WEIGHT, 'file_weight', 20, 150, $fileWeight ));
		// Form Text Date Select
		$fileDatecreate = $this->isNew() ? 0 : $this->getVar('file_datecreate');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_DATECREATE, 'file_datecreate', '', $fileDatecreate ));
		// Form Select User
		$form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'file_submitter', false, $this->getVar('file_submitter') ));
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
	public function getValuesFiles($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('file_id');
		$ret['obj_id'] = $this->getVar('file_obj_id');
		$ret['title'] = $this->getVar('file_title');
        $ret['info'] = $this->getVar('file_info', 'show');
		$ret['name'] = $this->getVar('file_name');
		$ret['weight'] = $this->getVar('file_weight');
		$ret['type'] = $this->getVar('file_type');
		$ret['size'] = $this->getVar('file_size');
		$ret['icon'] = $this->getFileIcon($this->getVar('file_type'));
		$ret['datecreate'] = formatTimeStamp($this->getVar('file_datecreate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('file_submitter'));
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayFiles()
	{
		$ret = array();
		$vars = $this->getVars();
		foreach(array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('"{$var}"');
		}
		return $ret;
	}
	/**
	 * Get Icon for uploaded files
	 * @param        $type
	 * @return string
	 */	
	public function getFileIcon ($type) {

		switch ($type) {
			// text files
			case 'text/plain':
			case 'text/html':
			case 'text/css':
			case 'application/javascript':
			case 'application/json':
			case 'application/xml':
			case 'application/x-shockwave-flash':
			case 'video/x-flv':
				$ret = 'icon-text.png';
			break;
			
			// images 
			case 'image/png':
			case 'image/jpeg':
			case 'image/gif':
			case 'image/bmp':
			case 'image/vnd.microsoft.icon':
			case 'image/tiff':
			case 'image/svg+xml':
				$ret = 'icon-image.png';
			break;
			
			// archives 
			case 'application/zip':
			case 'application/x-rar-compressed':
			case 'application/x-msdownload':
			case 'application/vnd.ms-cab-compressed':
				$ret = 'icon-zip.png';
			break;
			
			// audio/video 
			case 'audio/mpeg':
			case 'video/quicktime':
				$ret = 'icon-misc.png';
			break;
			
			// adobe 
			case 'application/pdf':
			case 'image/vnd.adobe.photoshop':
			case 'application/postscript':
				$ret = 'icon-misc.png';
			break;
			
			// ms office 
			case 'application/msword':
			case 'application/rtf':
			case 'application/vnd.ms-excel':
			case 'application/vnd.ms-powerpoint':
				$ret = 'icon-misc.png';
			break;
			
			// open office 
			case 'application/vnd.oasis.opendocument.text':
			case 'application/vnd.oasis.opendocument.spreadsheet':
				$ret = 'icon-misc.png';
			break;
		 }

		 return $ret;
	}
}

/**
 * Class Object Handler WgrealestateFiles
 */
class WgrealestateFilesHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgrealestate_files', 'wgrealestatefiles', 'file_id', 'file_name');
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
	 * Get Count Files in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountFiles($start = 0, $limit = 0, $sort = 'file_id ASC, file_name', $order = 'ASC')
	{
		$crCountFiles = new CriteriaCompo();
		$crCountFiles = $this->getFilesCriteria($crCountFiles, $start, $limit, $sort, $order);
		return parent::getCount($crCountFiles);
	}

	/**
	 * Get All Files in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllFiles($start = 0, $limit = 0, $sort = 'file_id ASC, file_name', $order = 'ASC')
	{
		$crAllFiles = new CriteriaCompo();
		$crAllFiles = $this->getFilesCriteria($crAllFiles, $start, $limit, $sort, $order);
		return parent::getAll($crAllFiles);
	}

	/**
	 * Get Criteria Files
	 * @param        $crFiles
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getFilesCriteria($crFiles, $start, $limit, $sort, $order)
	{
		$crFiles->setStart( $start );
		$crFiles->setLimit( $limit );
		$crFiles->setSort( $sort );
		$crFiles->setOrder( $order );
		return $crFiles;
	}
}
