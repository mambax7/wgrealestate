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
 * @version        $Id: 1.0 images.php 1 Sun 2018-01-07 21:18:23Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgrealestateImages
 */
class WgrealestateImages extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('img_id', XOBJ_DTYPE_INT);
		$this->initVar('img_obj_id', XOBJ_DTYPE_INT);
        $this->initVar('img_title', XOBJ_DTYPE_TXTBOX);
        $this->initVar('img_info', XOBJ_DTYPE_TXTAREA);
		$this->initVar('img_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('img_cat', XOBJ_DTYPE_INT);
        $this->initVar('img_width', XOBJ_DTYPE_INT);
        $this->initVar('img_height', XOBJ_DTYPE_INT);
        $this->initVar('img_size', XOBJ_DTYPE_INT);
        $this->initVar('img_weight', XOBJ_DTYPE_INT);
		$this->initVar('img_datecreate', XOBJ_DTYPE_INT);
		$this->initVar('img_submitter', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdImages()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

    /**
     * @public function getForm
     * @param bool $action
     * @param bool $user
     * @return XoopsThemeForm
     */
	public function getFormImages($action = false, $user = true)
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
        $title = $this->isNew() ? sprintf(_CO_WGREALESTATE_IMAGE_ADD) : sprintf(_CO_WGREALESTATE_IMAGE_EDIT);

		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        
        // Form ImageTitle
        $imgTitle = $this->isNew() ? '' : $this->getVar('img_title');
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_IMAGE_TITLE, 'img_title', 50, 255, $imgTitle ), true);
		
        // Form editor ImgInfos
		$editorConfigs = array();
		$editorConfigs['name'] = 'img_info';
		$editorConfigs['value'] = $this->getVar('img_info', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wgrealestate->getConfig('wgrealestate_editor');
		$form->addElement(new XoopsFormEditor( _CO_WGREALESTATE_IMAGE_INFOS, 'img_info', $editorConfigs));
        
        $imgObjId = $this->getVar('img_obj_id');
        $getImgName = $this->getVar('img_name');
        $imgName = $getImgName ? $getImgName : 'blank.gif';
        $imageDirectory = '/uploads/wgrealestate/images/objects/' . $imgObjId . '/medium';
        if (!$user || $this->isNew()) {
            // Form Upload Image            
            $imageTray = new XoopsFormElementTray(_CO_WGREALESTATE_IMAGE_NAME, '<br>' );
            $imageSelect = new XoopsFormSelect( sprintf(_CO_WGREALESTATE_FORM_IMAGE_PATH, ".{$imageDirectory}/"), 'img_name', $imgName, 5);
            $imageArray = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . $imageDirectory );
            foreach($imageArray as $image1) {
                $imageSelect->addOption("{$image1}", $image1);
            }
            $imageSelect->setExtra("onchange='showImgSelected(\"image1\", \"img_name\", \"".$imageDirectory."\", \"\", \"".XOOPS_URL."\")'");
            $imageTray->addElement($imageSelect, false);
            $imageTray->addElement(new XoopsFormLabel('', "<br><img src='".XOOPS_URL."/".$imageDirectory."/".$imgName."' name='image1' id='image1' alt='' style='max-width:100px' />"));
            // Form File
            $fileSelectTray = new XoopsFormElementTray('', '<br>' );
            $fileSelectTray->addElement(new XoopsFormFile( _CO_WGREALESTATE_IMAGE_FORM_UPLOAD. ' (maximal ' .$wgrealestate->getConfig('maxsize_image'). ' kb)', 'attachedfile', $wgrealestate->getConfig('maxsize_image') ));
            $imageTray->addElement($fileSelectTray);
            $form->addElement($imageTray, true);
        } 
        if ($user || !$this->isNew()) {
            $form->addElement(new XoopsFormLabel('', "<img src='".XOOPS_URL."/".$imageDirectory."/".$imgName."' name='image1' id='image1' alt='' style='max-width:200px' />"));
			$form->addElement(new XoopsFormHidden('img_name', $imgName));
        }
        // Form img cat
        $img_cat = $this->isNew() ? 0 : $this->getVar('img_cat');
		$imgcatSelect = new XoopsFormSelect( _CO_WGREALESTATE_IMAGE_TYPE, 'img_cat', $img_cat);
		$imgcatSelect->addOption(WGREALESTATE_IMGCAT_PICTURE_VAL, _CO_WGREALESTATE_IMGCAT_PICTURE);
        $imgcatSelect->addOption(WGREALESTATE_IMGCAT_PLAN_VAL, _CO_WGREALESTATE_IMGCAT_PLAN);
		$form->addElement($imgcatSelect);

		if ($user) {
            $form->addElement(new XoopsFormHidden('img_obj_id', $imgObjId));
        } else {
            // Form Select Images
            $objectsHandler = $wgrealestate->getHandler('objects');
            $imgObj_idSelect = new XoopsFormSelect( _CO_WGREALESTATE_OBJECTS, 'img_obj_id', $imgObjId);
            $imgObj_idSelect->addOptionArray($objectsHandler->getList());
            $form->addElement($imgObj_idSelect, true);
             // Form Text ImgWidth x ImgHeight
            $form->addElement(new XoopsFormLabel( _AM_WGREALESTATE_IMAGE_DIM, $this->getVar('img_width') . 'x' . $this->getVar('img_height')));
            // Form Text ImgSize
            $form->addElement(new XoopsFormLabel( _AM_WGREALESTATE_IMAGE_SIZE, $this->getVar('img_size') ));
            // Form Text ImgWeight
            $imgWeight = $this->isNew() ? '0' : $this->getVar('img_weight');
            $form->addElement(new XoopsFormText( _CO_WGREALESTATE_WEIGHT, 'img_weight', 20, 150, $imgWeight ));           
            // Form Text Date Select
            $imgDatecreate = $this->isNew() ? 0 : $this->getVar('img_datecreate');
            $form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_DATECREATE, 'img_datecreate', '', $this->getVar('img_datecreate') ));
            // Form Select User
            $form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'img_submitter', false, $this->getVar('img_submitter') ));
        }
		// To Save
        $form->addElement(new XoopsFormHidden('obj_id', $imgObjId));
		$form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}

	/**
	 * Get Values
	 * @param null $keys 
	 * @param null $format 
	 * @param null$maxDepth 
	 * @return array varchar 2 256byte
	 */
	public function getValuesImages($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('img_id');
        $ret['obj_id'] = $this->getVar('img_obj_id');
		// $objects = $wgrealestate->getHandler('objects');
		// $obj_object = $objects->get($this->getVar('img_obj_id'));
        // $ret['obj_title'] = $obj_object->getVar('obj_title');
        // $ret['obj_dealt_id'] = $obj_object->getVar('obj_dealt_id');
		$ret['title'] = $this->getVar('img_title');
        $ret['info'] = $this->getVar('img_info', 'show');
        $ret['name'] = $this->getVar('img_name');
        $ret['width'] = $this->getVar('img_width');
        $ret['height'] = $this->getVar('img_height');
        $ret['size'] = $this->getVar('img_size');
		$ret['weight'] = $this->getVar('img_weight');
		$ret['cat'] = $this->getVar('img_cat');
		$ret['datecreate'] = formatTimeStamp($this->getVar('img_datecreate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('img_submitter'));
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayImages()
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
 * Class Object Handler WgrealestateImages
 */
class WgrealestateImagesHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgrealestate_images', 'wgrealestateimages', 'img_id', 'img_name');
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
	 * Get Count Images in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountImages($start = 0, $limit = 0, $sort = 'img_weight', $order = 'ASC')
	{
		$crCountImages = new CriteriaCompo();
		$crCountImages = $this->getImagesCriteria($crCountImages, $start, $limit, $sort, $order);
		return parent::getCount($crCountImages);
	}

	/**
	 * Get All Images in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllImages($start = 0, $limit = 0, $sort = 'img_weight', $order = 'ASC')
	{
		$crAllImages = new CriteriaCompo();
		$crAllImages = $this->getImagesCriteria($crAllImages, $start, $limit, $sort, $order);
		return parent::getAll($crAllImages);
	}

	/**
	 * Get Criteria Images
	 * @param        $crImages
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getImagesCriteria($crImages, $start, $limit, $sort, $order)
	{
		$crImages->setStart( $start );
		$crImages->setLimit( $limit );
		$crImages->setSort( $sort );
		$crImages->setOrder( $order );
		return $crImages;
	}

    /**
     * Get main images for defined object
     * @param $objId
     * @return array
     */
	public function getMainImage($objId)
	{
		$crMainImages = new CriteriaCompo();
        $crMainImages->add(new Criteria('img_obj_id', $objId));
        $crMainImages->setSort('img_weight');
		$crMainImages->setOrder('ASC');
        $crMainImages->setLimit( 1 );
		return parent::getAll($crMainImages);
	}
    
    /**
	 * resize image if size exceed max width/height
     * @param string $sourcefile 
	 * @param string $endfile 
     * @param int    $max_width 
	 * @param int    $max_height 
	 * @param string $type 
     * @param int refered $end_width 
	 * @param int refered $end_height 
	 * @return string|void
     */
    public function resizeImage($sourcefile, $max_width, $max_height, $endfile, $type, &$end_width, &$end_height){
        // check file extension
        switch($type){
            case'image/png':
                $img = imagecreatefrompng($sourcefile);

            break;
            case'image/jpeg':
                $img = imagecreatefromjpeg($sourcefile);
            break;
            case'image/gif':
                $img = imagecreatefromgif($sourcefile);
            break;
            default:
                return 'Unsupported format';
        }

        $width = imagesx( $img );
        $height = imagesy( $img );
        
        if ( $width > $max_width || $height > $max_height) {
            // recalc image size based on max_width/max_height
            if ($width > $height) {
                if($width < $max_width){
                    $new_width = $width;
                } else {
                    $new_width = $max_width;
                    $divisor = $width / $new_width;
                    $new_height = floor( $height / $divisor);
                }
            } else {
                if($height < $max_height){
                    $new_height = $height;
                } else {
                    $new_height =  $max_height;
                    $divisor = $height / $new_height;
                    $new_width = floor( $width / $divisor );
                }
            }

            // Create a new temporary image.
            $tmpimg = imagecreatetruecolor( $new_width, $new_height );
            imagealphablending($tmpimg, false);
            imagesavealpha($tmpimg, true);

            // Copy and resize old image into new image.
            imagecopyresampled( $tmpimg, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            // Save thumbnail into a file.
            //compressing the file
            switch($type){
                case'image/png':
                    imagepng($tmpimg, $endfile, 0);
                break;
                case'image/jpeg':
                    imagejpeg($tmpimg, $endfile, 100);
                break;
                case'image/gif':
                    imagegif($tmpimg, $endfile);
                break;
            }
            
            $end_width = $new_width;
            $end_height = $new_height;
            
            // release the memory
            imagedestroy($tmpimg);
        } else {
            $end_width = $width;
            $end_height = $height;
        }
        imagedestroy($img);
        return null;
    }
    
    /**
	 * resize image to thumbs width/height
     * @param string $sourcefile 
	 * @param string $endfile 
     * @param int    $new_width 
	 * @param int    $new_height 
	 * @param string $type 
	 * @return string|void
     */
    public function resizeThumb($sourcefile, $new_width, $new_height, $endfile, $type){
        // check file extension
        switch($type){
            case'image/png':
                $img = imagecreatefrompng($sourcefile);

            break;
            case'image/jpeg':
                $img = imagecreatefromjpeg($sourcefile);
            break;
            case'image/gif':
                $img = imagecreatefromgif($sourcefile);
            break;
            default:
                return 'Un supported format';
        }

        $width = imagesx( $img );
        $height = imagesy( $img );
        
        // Create a new temporary image.
        $tmpimg = imagecreatetruecolor( $new_width, $new_height );
        imagealphablending($tmpimg, false);
        imagesavealpha($tmpimg, true);

        // Copy and resize old image into new image.
        imagecopyresampled( $tmpimg, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Save thumbnail into a file.
        //compressing the file
        switch($type){
            case'image/png':
                imagepng($tmpimg, $endfile, 0);
            break;
            case'image/jpeg':
                imagejpeg($tmpimg, $endfile, 100);
            break;
            case'image/gif':
                imagegif($tmpimg, $endfile);
            break;
        }
       
        // release the memory
        imagedestroy($tmpimg);
        imagedestroy($img);
        return null;
    }
}
