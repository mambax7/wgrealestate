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
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WgrealestateObjects
 */
class WgrealestateObjects extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('obj_id', XOBJ_DTYPE_INT);
        $this->initVar('obj_title', XOBJ_DTYPE_TXTBOX);
		$this->initVar('obj_dealt_id', XOBJ_DTYPE_INT);
		$this->initVar('obj_objcat_id', XOBJ_DTYPE_INT);
		$this->initVar('obj_ctry', XOBJ_DTYPE_TXTBOX);
		$this->initVar('obj_postalcode', XOBJ_DTYPE_TXTBOX);
		$this->initVar('obj_city', XOBJ_DTYPE_TXTBOX);
		$this->initVar('obj_address', XOBJ_DTYPE_TXTBOX);
		$this->initVar('obj_geo_lng', XOBJ_DTYPE_TXTBOX);
		$this->initVar('obj_geo_lat', XOBJ_DTYPE_TXTBOX);
        $this->initVar('obj_geo_placeid', XOBJ_DTYPE_TXTBOX);
		$this->initVar('obj_seller_id', XOBJ_DTYPE_INT);
		$this->initVar('obj_descr', XOBJ_DTYPE_TXTAREA);
		$this->initVar('obj_infos', XOBJ_DTYPE_TXTAREA);
		$this->initVar('obj_misc', XOBJ_DTYPE_TXTAREA);
        $this->initVar('obj_location', XOBJ_DTYPE_TXTAREA);
		$this->initVar('obj_views', XOBJ_DTYPE_INT);
		$this->initVar('obj_contacts', XOBJ_DTYPE_INT);
		$this->initVar('obj_state', XOBJ_DTYPE_INT);
		$this->initVar('obj_datecreate', XOBJ_DTYPE_INT);
		$this->initVar('obj_datestate', XOBJ_DTYPE_INT);
		$this->initVar('obj_submitter', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdObjects()
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
	public function getFormObjects($action = false, $user = true)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		if( false === $action ) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_CO_WGREALESTATE_OBJECT_ADD) : sprintf(_CO_WGREALESTATE_OBJECT_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        // Form Text ObjTitle
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_OBJECT_TITLE, 'obj_title', 50, 255, $this->getVar('obj_title') ));
		// Form Select Objects
		$objDealt_idSelect = new XoopsFormSelect( _CO_WGREALESTATE_DEALTYPE, 'obj_dealt_id', $this->getVar('obj_dealt_id'));
		$objDealt_idSelect->addOption('', '');
		$objDealt_idSelect->addOption(WGREALESTATE_DEALTYPE_RENT_VAL, _CO_WGREALESTATE_DEALTYPE_RENT);
		$objDealt_idSelect->addOption(WGREALESTATE_DEALTYPE_SALE_VAL, _CO_WGREALESTATE_DEALTYPE_SALE);
		$form->addElement($objDealt_idSelect, true);
		// Form Select Objects
		$objcategoriesHandler = $wgrealestate->getHandler('objcategories');
		$objObjcat_idSelect = new XoopsFormSelect( _CO_WGREALESTATE_OBJCAT_CATEGORY, 'obj_objcat_id', $this->getVar('obj_objcat_id'));
        $objObjcat_idSelect->addOption('', '');
		$objObjcat_idSelect->addOptionArray($objcategoriesHandler->getList());
		$form->addElement($objObjcat_idSelect, true);
		// Form Text ObjCtry
        $form->addElement(new XoopsFormSelectCountry( _CO_WGREALESTATE_OBJECT_CTRY, 'obj_ctry', $this->getVar('obj_ctry') ));
		// Form Text ObjPostalcode
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_OBJECT_POSTALCODE, 'obj_postalcode', 50, 255, $this->getVar('obj_postalcode') ));
		// Form Text ObjCity
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_OBJECT_CITY, 'obj_city', 50, 255, $this->getVar('obj_city') ));
		// Form Text ObjAddress
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_OBJECT_ADDRESS, 'obj_address', 50, 255, $this->getVar('obj_address') ));
		// Form Text Objgeo_lng / ObjGeo_lat
        $geocoords_auto = $this->isNew() ? 1 : 0;
        $geocoordsSelect = new XoopsFormRadio( _CO_WGREALESTATE_OBJECT_GEOCOORDS, 'geocoords', $geocoords_auto);
        $geocoordsSelect->addOption(0, _CO_WGREALESTATE_NOACTION);
        $geocoordsSelect->addOption(1, _CO_WGREALESTATE_OBJECT_GEOCOORDS_AUTO);
        if ( 0 < $this->getVar('obj_geo_lng')) {
			$geocoordsSelect->addOption(2, sprintf(_CO_WGREALESTATE_OBJECT_GEOCOORDS_DELETE, $this->getVar('obj_geo_lng') . ' / ' . $this->getVar('obj_geo_lat')));
        }
        $form->addElement($geocoordsSelect);
        
        $form->addElement(new XoopsFormHidden( 'obj_geo_lng', $this->getVar('obj_geo_lng') ));
        $form->addElement(new XoopsFormHidden( 'obj_geo_lat', $this->getVar('obj_geo_lat') ));
		// Form editor ObjDescr
		$editorConfigs = array();
		$editorConfigs['name'] = 'obj_descr';
		$editorConfigs['value'] = $this->getVar('obj_descr', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wgrealestate->getConfig('wgrealestate_editor_descr');
		$form->addElement(new XoopsFormEditor( _CO_WGREALESTATE_OBJECT_DESCR, 'obj_descr', $editorConfigs));
		// Form editor ObjInfos
		$editorConfigs = array();
		$editorConfigs['name'] = 'obj_infos';
		$editorConfigs['value'] = $this->getVar('obj_infos', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wgrealestate->getConfig('wgrealestate_editors');
		$form->addElement(new XoopsFormEditor( _CO_WGREALESTATE_OBJECT_INFOS, 'obj_infos', $editorConfigs));
		// Form editor ObjMisc
		$editorConfigs = array();
		$editorConfigs['name'] = 'obj_misc';
		$editorConfigs['value'] = $this->getVar('obj_misc', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wgrealestate->getConfig('wgrealestate_editors');
		$form->addElement(new XoopsFormEditor( _CO_WGREALESTATE_OBJECT_MISC, 'obj_misc', $editorConfigs));
        // Form editor ObjLocation
		$editorConfigs = array();
		$editorConfigs['name'] = 'obj_location';
		$editorConfigs['value'] = $this->getVar('obj_location', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wgrealestate->getConfig('wgrealestate_editors');
		$form->addElement(new XoopsFormEditor( _CO_WGREALESTATE_OBJECT_LOCATION, 'obj_location', $editorConfigs));
		// Form Text ObjViews
		$form->addElement(new XoopsFormLabel( _CO_WGREALESTATE_OBJECT_VIEWS, $this->getVar('obj_views') ));
		// Form Text ObjContacts
		$form->addElement(new XoopsFormLabel( _CO_WGREALESTATE_OBJECT_CONTACTS, $this->getVar('obj_contacts') ));
		// Form Select Objects
		$sellersHandler = $wgrealestate->getHandler('sellers');
		$objSeller_idSelect = new XoopsFormSelect( _CO_WGREALESTATE_OBJECT_SELLER_ID, 'obj_seller_id', $this->getVar('obj_seller_id'));
        $objSeller_idSelect->addOption('', '');
		$objSeller_idSelect->addOptionArray($sellersHandler->getList());
		$form->addElement($objSeller_idSelect);
		// Form Select
		$objStateSelect = new XoopsFormRadio( _CO_WGREALESTATE_OBJECT_STATE, 'obj_state', $this->getVar('obj_state'));
		$objStateSelect->addOption(WGREALESTATE_STATE_NEW_VAL, _CO_WGREALESTATE_STATE_NEW);
        $objStateSelect->addOption(WGREALESTATE_STATE_ONLINE_VAL, _CO_WGREALESTATE_STATE_ONLINE);
        $objStateSelect->addOption(WGREALESTATE_STATE_ARCHIVE_VAL, _CO_WGREALESTATE_STATE_ARCHIVE);
		$form->addElement($objStateSelect, true);
        if ($user) {
            // Form Text Date Select
            if ($this->isNew()) {
                $form->addElement(new XoopsFormHidden('obj_datecreate', time() ));
            } else {
                $form->addElement(new XoopsFormLabel( _CO_WGREALESTATE_DATECREATE, formatTimeStamp($this->getVar('obj_datecreate'), 's')));
                $form->addElement(new XoopsFormHidden('obj_datecreate', $this->getVar('obj_datecreate' )));
                // Form Text Date Select          
                $form->addElement(new XoopsFormLabel( _CO_WGREALESTATE_OBJECT_DATESTATE,formatTimeStamp($this->getVar('obj_datestate'), 's')));
                // Form Select User
                $form->addElement(new XoopsFormLabel( _CO_WGREALESTATE_SUBMITTER, XoopsUser::getUnameFromId($this->getVar('obj_submitter') )));
            }
        } else {
            // Form Text Date Select
            $objDatecreate = $this->isNew() ? 0 : $this->getVar('obj_datecreate');
            $form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_DATECREATE, 'obj_datecreate', '', $objDatecreate ));
            // Form Text Date Select
            $objDatestate = $this->isNew() ? 0 : $this->getVar('obj_datestate');
            $form->addElement(new XoopsFormHidden('obj_state_old', $this->getVar('obj_state')));
            $form->addElement(new XoopsFormTextDateSelect( _CO_WGREALESTATE_OBJECT_DATESTATE, 'obj_datestate', '', $objDatestate ), true);
            // Form Select User
            $form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'obj_submitter', false, $this->getVar('obj_submitter') ));
        }
		// To Save
        $form->addElement(new XoopsFormHidden('obj_state_old', $this->getVar('obj_state')));
		$form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}

    /**
     * @public function getForm
     * @return XoopsThemeForm
     */
	public function getFormObjectGeos()
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		
		$action = $_SERVER['REQUEST_URI'];
		
		// Title
		$title = _CO_WGREALESTATE_OBJECT_GEOCOORDS_EDIT;
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        // Form Text ObjTitle
		$form->addElement(new XoopsFormLabel( _CO_WGREALESTATE_OBJECT_TITLE, $this->getVar('obj_title') ));
				// Form Text ObjCtry
        $form->addElement(new XoopsFormSelectCountry( _CO_WGREALESTATE_OBJECT_CTRY, 'obj_ctry', $this->getVar('obj_ctry') ));
		// Form Text ObjPostalcode
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_OBJECT_POSTALCODE, 'obj_postalcode', 50, 255, $this->getVar('obj_postalcode') ));
		// Form Text ObjCity
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_OBJECT_CITY, 'obj_city', 50, 255, $this->getVar('obj_city') ));
		// Form Text ObjAddress
		$form->addElement(new XoopsFormText( _CO_WGREALESTATE_OBJECT_ADDRESS, 'obj_address', 50, 255, $this->getVar('obj_address') ));
		// Form Text Objgeo_lng / ObjGeo_lat
        $elemGeoTray = new XoopsFormElementTray(_CO_WGREALESTATE_OBJECT_GEO, '&nbsp;' );
        $elemGeoTray->addElement(new XoopsFormText( _CO_WGREALESTATE_OBJECT_GEO_LNG, 'obj_geo_lng', 10, 255, $this->getVar('obj_geo_lng') ));
        $elemGeoTray->addElement(new XoopsFormText( _CO_WGREALESTATE_OBJECT_GEO_LAT, 'obj_geo_lat', 10, 255, $this->getVar('obj_geo_lat') ));
        $elemGeoTray->addElement(new XoopsFormText( _CO_WGREALESTATE_OBJECT_GEO_PLACEID, 'obj_geo_placeid', 50, 255, $this->getVar('obj_geo_placeid') ));
        $form->addElement($elemGeoTray, false);
        // Form Select User
        $form->addElement(new XoopsFormSelectUser( _CO_WGREALESTATE_SUBMITTER, 'obj_submitter', false, $this->getVar('obj_submitter') ));
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'search'));
		$form->addElement(new XoopsFormButtonTray('', _CO_WGREALESTATE_OBJECT_GEO_SEARCH, 'submit', '', false));
		return $form;
	}

    /**
     * @public function getForm
     * @param string $recaptchakey
     * @return XoopsThemeForm
     */
	public function getFormObjectContact($recaptchakey = '')
	{
		$wgrealestate = WgrealestateHelper::getInstance();

		$action = $_SERVER['REQUEST_URI'];
		
		// Title
		$title = _MA_WGREALESTATE_CONTACT;
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text contactName
		$contact_name = new XoopsFormText( _MA_WGREALESTATE_CONTACT_NAME, 'contact_name', 50, 255, '' );
		$contact_name->setExtra('placeholder="' . _MA_WGREALESTATE_CONTACT_NAME_INFO . '"');
		$form->addElement($contact_name);
		// Form Text contactPhone
		$contact_phone = new XoopsFormText( _MA_WGREALESTATE_CONTACT_PHONE, 'contact_phone', 50, 255, '' );
		$contact_phone->setExtra('placeholder="' . _MA_WGREALESTATE_CONTACT_PHONE_INFO . '"');
		$form->addElement($contact_phone);
		// Form Text contactMail
		$contact_mail = new XoopsFormText( _MA_WGREALESTATE_CONTACT_MAIL, 'contact_mail', 50, 255, '' );
		$contact_mail->setExtra('placeholder="' . _MA_WGREALESTATE_CONTACT_MAIL_INFO . '"');
		$form->addElement($contact_mail);
		// Form Text contactSubject
		$form->addElement(new XoopsFormLabel( _MA_WGREALESTATE_CONTACT_SUBJECT, $this->getVar('obj_title') ));
		// Form Text contactMessage
		$contact_message = new XoopsFormTextArea( _MA_WGREALESTATE_CONTACT_MESSAGE, 'contact_message','' );
		$contact_message->setExtra('placeholder="' . _MA_WGREALESTATE_CONTACT_MESSAGE_INFO . '"');
		$form->addElement($contact_message);
		// Form Radio Yes/No
		$form->addElement(new XoopsFormRadioYN( _MA_WGREALESTATE_CONTACT_CONFIRM, 'contact_confirm', 0), true);
		// Form Radio Yes/No
		if ('' != $recaptchakey) {
			$form->addElement(new XoopsFormLabel( '', '<div class="g-recaptcha" data-sitekey="' . $recaptchakey . '"></div>'));
		}
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'send_request'));
		$form->addElement(new XoopsFormHidden('obj_id', $this->getVar('obj_id')));
		$form->addElement(new XoopsFormButtonTray('', _MA_WGREALESTATE_CONTACT_SUBMIT, 'submit', '', false));
		return $form;
	}
        
	/**
	 * Get Values
	 * @param null $keys 
	 * @param null $format 
	 * @param null$maxDepth 
	 * @return array
	 */
	public function getValuesObjects($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('obj_id');
        $ret['title'] = $this->getVar('obj_title');
        $ret['dealtype_id'] = $this->getVar('obj_dealt_id');
		$ret['dealtype'] = (WGREALESTATE_DEALTYPE_RENT_VAL == $this->getVar('obj_dealt_id')) ? _CO_WGREALESTATE_DEALTYPE_RENT : _CO_WGREALESTATE_DEALTYPE_SALE;
        $ret['objcat_id'] = $this->getVar('obj_objcat_id');
		$objcategories = $wgrealestate->getHandler('objcategories');
		$obj_objcat_id = $objcategories->get($this->getVar('obj_objcat_id'));
		$ret['objcat_name'] = $obj_objcat_id->getVar('objcat_name');
		$ret['ctry'] = $this->getVar('obj_ctry');
		$ret['postalcode'] = $this->getVar('obj_postalcode');
		$ret['city'] = $this->getVar('obj_city');
		$ret['address'] = $this->getVar('obj_address');
		$ret['geo_lng'] = $this->getVar('obj_geo_lng');
		$ret['geo_lat'] = $this->getVar('obj_geo_lat');
		$sellers = $wgrealestate->getHandler('sellers');
		$obj_seller_id = $sellers->get($this->getVar('obj_seller_id'));
		$ret['seller_id'] = $obj_seller_id->getVar('seller_name');
		$ret['descr'] = strip_tags($this->getVar('obj_descr'));
		$ret['infos'] = strip_tags($this->getVar('obj_infos'));
		$ret['misc'] = strip_tags($this->getVar('obj_misc'));
        $ret['location'] = strip_tags($this->getVar('obj_location'));
		$ret['views'] = $this->getVar('obj_views');
		$ret['contacts'] = $this->getVar('obj_contacts');
		$ret['state'] = $this->getVar('obj_state');
        $ret['state_text'] = $wgrealestate->getStateText($this->getVar('obj_state'));
		$ret['datecreate'] = formatTimeStamp($this->getVar('obj_datecreate'), 's');
		$ret['datestate'] = formatTimeStamp($this->getVar('obj_datestate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('obj_submitter'));
		return $ret;
	}

    /**
	 * Get Values with all details for user side
	 * @param null $keys 
	 * @param null $format 
	 * @param null$maxDepth 
	 * @return array
	 */
	public function getValuesObjectsUser($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
        $objId = $this->getVar('obj_id');
		$ret['id'] = $objId;
        $ret['title'] = $this->getVar('obj_title');
        $ret['dealtype_id'] = $this->getVar('obj_dealt_id');
		$ret['dealtype'] = (WGREALESTATE_DEALTYPE_RENT_VAL == $this->getVar('obj_dealt_id')) ? _CO_WGREALESTATE_DEALTYPE_RENT : _CO_WGREALESTATE_DEALTYPE_SALE;
        $ret['objcat_id'] = $this->getVar('obj_objcat_id');
		$objcategories = $wgrealestate->getHandler('objcategories');
		$obj_objcat_id = $objcategories->get($this->getVar('obj_objcat_id'));
		$ret['objcat_name'] = $obj_objcat_id->getVar('objcat_name');
		$ret['ctry'] = $this->getVar('obj_ctry');
		$ret['postalcode'] = $this->getVar('obj_postalcode');
		$ret['city'] = $this->getVar('obj_city');
		$ret['address'] = $this->getVar('obj_address');
		$ret['geo_lng'] = $this->getVar('obj_geo_lng');
		$ret['geo_lat'] = $this->getVar('obj_geo_lat');
		$sellers = $wgrealestate->getHandler('sellers');
		$obj_seller_id = $sellers->get($this->getVar('obj_seller_id'));
		$ret['seller_id'] = $obj_seller_id->getVar('seller_name');
		$ret['descr'] = strip_tags($this->getVar('obj_descr'));
		$ret['infos'] = strip_tags($this->getVar('obj_infos'));
		$ret['misc'] = strip_tags($this->getVar('obj_misc'));
        $ret['location'] = strip_tags($this->getVar('obj_location'));
		$ret['views'] = strip_tags($this->getVar('obj_views'));
		$ret['contacts'] = $this->getVar('obj_contacts');
		$ret['state'] = $this->getVar('obj_state');
        $ret['state_text'] = $wgrealestate->getStateText($this->getVar('obj_state'));
		$ret['datecreate'] = formatTimeStamp($this->getVar('obj_datecreate'), 's');
		$ret['datestate'] = formatTimeStamp($this->getVar('obj_datestate'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('obj_submitter'));
        // get first image
        $images = $wgrealestate->getHandler('images');
        $mainImage = $images->getMainImage($objId);
		foreach(array_keys($mainImage) as $i) {
            $ret['mainimage'] = $mainImage[$i]->getVar('img_name');
        }
		return $ret;
	}
	
	   /**
	 * Get Values with all details for block on user side
	 * @param null $keys 
	 * @param null $format 
	 * @param null$maxDepth 
	 * @return array
	 */
	public function getValuesObjectsBlock($keys = null, $format = null, $maxDepth = null)
	{
		$wgrealestate = WgrealestateHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
        $objId = $this->getVar('obj_id');
		$ret['id'] = $objId;
        $ret['title'] = $this->getVar('obj_title');
        $ret['dealtype_id'] = $this->getVar('obj_dealt_id');
		if (defined('_CO_WGREALESTATE_DEALTYPE_RENT')) {
			$ret['dealtype'] = (WGREALESTATE_DEALTYPE_RENT_VAL == $this->getVar('obj_dealt_id')) ? _CO_WGREALESTATE_DEALTYPE_RENT : _CO_WGREALESTATE_DEALTYPE_SALE;
		} else {
			$ret['dealtype'] = (WGREALESTATE_DEALTYPE_RENT_VAL == $this->getVar('obj_dealt_id')) ? _MB_WGREALESTATE_DEALTYPE_RENT : _MB_WGREALESTATE_DEALTYPE_SALE;
		}
        $ret['objcat_id'] = $this->getVar('obj_objcat_id');
		$objcategories = $wgrealestate->getHandler('objcategories');
		$obj_objcat_id = $objcategories->get($this->getVar('obj_objcat_id'));
		$ret['objcat_name'] = $obj_objcat_id->getVar('objcat_name');
		$loc_show = '';
		if ('' !== $this->getVar('obj_ctry')) {$loc_show .= $this->getVar('obj_ctry') . '-';}
		if ('' !== $this->getVar('obj_postalcode')) {$loc_show .= $this->getVar('obj_postalcode') . ' ';}
		if ('' !== $this->getVar('obj_city')) {$loc_show .= $this->getVar('obj_city') . ' ';}
		if ('' !== $this->getVar('obj_address')) {$loc_show .= $this->getVar('obj_address');}
		$ret['loc_show'] = $loc_show;
        // get first image
        $images = $wgrealestate->getHandler('images');
        $mainImage = $images->getMainImage($objId);
		foreach(array_keys($mainImage) as $i) {
            $ret['mainimage'] = $mainImage[$i]->getVar('img_name');
        }
		return $ret;
	}
	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayObjects()
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
 * Class Object Handler WgrealestateObjects
 */
class WgrealestateObjectsHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wgrealestate_objects', 'wgrealestateobjects', 'obj_id', 'obj_title');
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
	 * Get Count Objects in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountObjects($start = 0, $limit = 0, $sort = 'obj_id ASC, obj_dealt_id', $order = 'ASC')
	{
		$crCountObjects = new CriteriaCompo();
		$crCountObjects = $this->getObjectsCriteria($crCountObjects, $start, $limit, $sort, $order);
		return parent::getCount($crCountObjects);
	}

	/**
	 * Get All Objects in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllObjects($start = 0, $limit = 0, $sort = 'obj_id ASC, obj_dealt_id', $order = 'ASC')
	{
		$crAllObjects = new CriteriaCompo();
		$crAllObjects = $this->getObjectsCriteria($crAllObjects, $start, $limit, $sort, $order);
		return parent::getAll($crAllObjects);
	}

	/**
	 * Get Criteria Objects
	 * @param        $crObjects
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getObjectsCriteria($crObjects, $start, $limit, $sort, $order)
	{
		$crObjects->setStart( $start );
		$crObjects->setLimit( $limit );
		$crObjects->setSort( $sort );
		$crObjects->setOrder( $order );
		return $crObjects;
	}
}
