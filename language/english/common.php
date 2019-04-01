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
 * @version        $Id: 1.0 constands.php 1 Sun 2018-01-07 19:48:17Z XOOPS Project (www.xoops.org) $
 */
 
// General
define('_CO_WGREALESTATE_FORM_UPLOAD', 'Upload file');
define('_CO_WGREALESTATE_FORM_IMAGE_PATH', 'Files in %s');
define('_CO_WGREALESTATE_FORM_ACTION', 'Action');
define('_CO_WGREALESTATE_FORM_EDIT', 'Edit');
define('_CO_WGREALESTATE_FORM_DELETE', 'Delete');

define('_CO_WGREALESTATE_TYPE_INFO', 'Info');
define('_CO_WGREALESTATE_TYPE_VALID', 'Valid');
define('_CO_WGREALESTATE_ID', 'Id');
define('_CO_WGREALESTATE_WEIGHT', 'Order');
define('_CO_WGREALESTATE_DATECREATE', 'Created on');
define('_CO_WGREALESTATE_SUBMITTER', 'Editor (in)');
define('_CO_WGREALESTATE_NONE', 'Without');
define('_CO_WGREALESTATE_NOACTION', 'No action');
define('_CO_WGREALESTATE_INDEX_SHOW', 'Show on index page');
define('_CO_WGREALESTATE_INDEX_HEADER', 'Show in main area');
define('_CO_WGREALESTATE_INDEX_MISC', 'Show as Addition');

define('_CO_WGREALESTATE_DOWNLOAD', 'Download');

// Save / Delete
define('_CO_WGREALESTATE_FORM_OK', 'Saved successfully');
define('_CO_WGREALESTATE_FORM_DELETE_OK', 'Successfully deleted');
define('_CO_WGREALESTATE_FORM_SURE_DELETE', "Do you really want to delete: <b> <span style = 'color: Red;'>% s </span> </b>");
define('_CO_WGREALESTATE_FORM_SURE_RENEW', "Are you sure you want to refresh: <b> <span style = 'color: Red;'>% s </span> </b>");
// Errors
define('_CO_WGREALESTATE_FORM_DELETE_FAIL1', 'The record could be deleted successfully, but an error occurred while deleting the picture!');
define('_CO_WGREALESTATE_ERROR_NO_VALID_OBJID', 'Error: Invalid parameter object ID!');
define('_CO_WGREALESTATE_ERROR_GEO', 'Errors when determining the geo coordinates!');
// misc
define('_CO_WGREALESTATE_NO_PERM', 'You do not have permission to perform this action!');
// attributes add / edit
define('_CO_WGREALESTATE_ATTRIBUTES_ADD', 'Add Object Attributes');
define('_CO_WGREALESTATE_ATTRIBUTES_EDIT', 'Edit Object Attributes');
// cost types
define('_CO_WGREALESTATE_COST_TYPE', 'Cost Type');
// cost add / edit
define('_CO_WGREALESTATE_COST_ADD', 'Add Costs');
define('_CO_WGREALESTATE_COST_EDIT', 'Edit Costs');
// Elements of cost
define('_CO_WGREALESTATE_COST_PERC', 'Percent');
define('_CO_WGREALESTATE_COST_BASE', 'Calculation Base');
define('_CO_WGREALESTATE_COST_INFO', 'Info');
define('_CO_WGREALESTATE_COST_VALUE', 'Value');
define('_CO_WGREALESTATE_COST_CALC', 'Calculate');
define('_CO_WGREALESTATE_COST_SUM_RENT', 'Total Rental Costs');
define('_CO_WGREALESTATE_COST_SUM_SALE', 'Total purchase cost');
// Object add / edit
define('_CO_WGREALESTATE_OBJECT_ADD', 'Add Object');
define('_CO_WGREALESTATE_OBJECT_EDIT', 'Edit Object');
// Elements of Object
define('_CO_WGREALESTATE_OBJECT', 'Object');
define('_CO_WGREALESTATE_OBJECTS', 'Objects');
define('_CO_WGREALESTATE_OBJECT_TITLE', 'Object title');
define('_CO_WGREALESTATE_OBJECT_CTRY', 'Country');
define('_CO_WGREALESTATE_OBJECT_POSTALCODE', 'ZIP');
define('_CO_WGREALESTATE_OBJECT_CITY', 'Location');
define('_CO_WGREALESTATE_OBJECT_ADDRESS', 'Address');
define('_CO_WGREALESTATE_OBJECT_GEO', 'Geo-Code');
define('_CO_WGREALESTATE_OBJECT_GEO_LNG', 'Longitude');
define('_CO_WGREALESTATE_OBJECT_GEO_LAT', 'Latitude');
define('_CO_WGREALESTATE_OBJECT_GEO_PLACEID', 'Geo-Place-ID');
define('_CO_WGREALESTATE_OBJECT_GEO_SEARCH', 'Get Geo Code');
define('_CO_WGREALESTATE_OBJECT_SELLER_ID', 'Salesperson');
define('_CO_WGREALESTATE_OBJECT_DESCR', 'Description');
define('_CO_WGREALESTATE_OBJECT_INFOS', 'Equipment');
define('_CO_WGREALESTATE_OBJECT_MISC', 'Other');
define('_CO_WGREALESTATE_OBJECT_LOCATION', 'Location');
define('_CO_WGREALESTATE_OBJECT_STATISTICS', 'Statistical Information');
define('_CO_WGREALESTATE_OBJECT_VIEWS', 'Views');
define('_CO_WGREALESTATE_OBJECT_CONTACTS', 'Contact');
define('_CO_WGREALESTATE_OBJECT_STATE', 'Status');
define('_CO_WGREALESTATE_OBJECT_DATESTATE', 'Date Status');
define('_CO_WGREALESTATE_OBJECT_GEOCOORDS', 'Geo-Coordinates');
define('_CO_WGREALESTATE_OBJECT_GEOCOORDS_EDIT', 'Get Geo-coordinates');
define('_CO_WGREALESTATE_OBJECT_GEOCOORDS_AUTO', 'Automatically detect geo coordinates based on specified location and address information');
define('_CO_WGREALESTATE_OBJECT_GEOCOORDS_DELETE', 'Delete current coordinates (% s)');
// image add / edit
define('_CO_WGREALESTATE_IMAGE_ADD', 'Add image');
define('_CO_WGREALESTATE_IMAGE_EDIT', 'Edit images');
// Elements of images
define('_CO_WGREALESTATE_IMAGES_TITLE', 'Editing and adding images');
define('_CO_WGREALESTATE_IMAGES_PLAN_TITLE', 'Plans and Floor Plans');
define('_CO_WGREALESTATE_IMAGE', 'Image');
define('_CO_WGREALESTATE_IMAGES', 'Image Gallery');
define('_CO_WGREALESTATE_IMAGES_GALLERY', 'To Image Gallery');
define('_CO_WGREALESTATE_IMAGE_TYPE', 'Usage Type');
define('_CO_WGREALESTATE_IMAGE_TITLE', 'Image title');
define('_CO_WGREALESTATE_IMAGE_INFO', 'Additional Information');
define('_CO_WGREALESTATE_IMAGE_NAME', 'Name');
define('_CO_WGREALESTATE_IMAGE_INFOS', 'Additional Image Info');
define('_CO_WGREALESTATE_IMAGE_FORM_UPLOAD', 'Select file to upload');
define('_CO_WGREALESTATE_IMAGE_DIM', 'Dimensions');
define('_CO_WGREALESTATE_IMAGE_SIZE', 'Size');
// File add / edit
define('_CO_WGREALESTATE_FILE_ADD', 'Add Files');
define('_CO_WGREALESTATE_FILE_EDIT', 'Edit Files');
// Elements of File
define('_CO_WGREALESTATE_FILES_TITLE', 'Edit and add files');
define('_CO_WGREALESTATE_FILES_PLAN_TITLE', 'Files');
define('_CO_WGREALESTATE_FILE', 'File');
define('_CO_WGREALESTATE_FILES', 'Files');
define('_CO_WGREALESTATE_FILE_TITLE', 'file title');
define('_CO_WGREALESTATE_FILE_INFO', 'Additional Information');
define('_CO_WGREALESTATE_FILE_NAME', 'Name');
define('_CO_WGREALESTATE_FILE_TYPE', 'File type');
define('_CO_WGREALESTATE_FILE_SIZE', 'File size');
define('_CO_WGREALESTATE_FILE_LOGO', 'Logo');
define('_CO_WGREALESTATE_FORM_UPLOAD_FILE_FILES', 'Select file to upload');

// Elements of deal types
define('_CO_WGREALESTATE_DEALTYPE', 'Transfer Type');
define('_CO_WGREALESTATE_DEALTYPE_RENT', 'Rent');
define('_CO_WGREALESTATE_DEALTYPE_SALE', 'Buy');
// Elements of object category
define('_CO_WGREALESTATE_OBJCAT_CATEGORY', 'Object category');
// Vars for constants
define('_CO_WGREALESTATE_STATE_NEW', 'Creation');
define('_CO_WGREALESTATE_STATE_ONLINE', 'Online');
define('_CO_WGREALESTATE_STATE_ARCHIVE', 'Archive');

define('_CO_WGREALESTATE_IMGCAT_PICTURE', 'Views');
define('_CO_WGREALESTATE_IMGCAT_PLAN', 'Plans');

define('_CO_WGREALESTATE_ATTR_YN', 'Yes / No');
define('_CO_WGREALESTATE_ATTR_TEXT', 'Textfeld');
define('_CO_WGREALESTATE_ATTR_TEXTAREA', 'Extended text field');
define('_CO_WGREALESTATE_ATTR_TEXT_M2', 'Textbox Square Meters');
define('_CO_WGREALESTATE_ATTR_TEXT_CURR', 'Textfield Euro');
define('_CO_WGREALESTATE_ATTR_SELECT', 'Selection field');
define('_CO_WGREALESTATE_ATTR_SELECT_ITEM', 'Entry selection field');
define('_CO_WGREALESTATE_ATTR_TEXT_KWH', 'Text field kWh');

define('_CO_WGREALESTATE_CURRENCY', 'Euro');
define('_CO_WGREALESTATE_SQUAREMETER', 'm <sup>2</sup>');
define('_CO_WGREALESTATE_KWH', 'kWh / (m <sup>2</sup>*a)');

define('_CO_WGREALESTATE_ALL', 'All');
define('_CO_WGREALESTATE_INFO', 'Additional Info');
define('_CO_WGREALESTATE_USE_NOT', 'Not applicable');

// There are not
define('_CO_WGREALESTATE_THEREARENT_OBJCATEGORIES', 'There are currently no objategories');
define('_CO_WGREALESTATE_THEREARENT_ATTDEFAULTS', 'There are currently no default attributes');
define('_CO_WGREALESTATE_THEREARENT_ATTRIBUTES', 'There are currently no attributes');
define('_CO_WGREALESTATE_THEREARENT_ATTCATEGORIES', 'There are currently no attribute categories');
define('_CO_WGREALESTATE_THEREARENT_COST_TYPES', 'There are currently no charge types');
define('_CO_WGREALESTATE_THEREARENT_OBJECTS', 'There are currently no objects');
define('_CO_WGREALESTATE_THEREARENT_COSTS', 'There are currently no costs');
define('_CO_WGREALESTATE_THEREARENT_IMAGES', 'There are currently no images');
define('_CO_WGREALESTATE_THEREARENT_FILES', 'There are currently no files');
define('_CO_WGREALESTATE_THEREARENT_SELLERS', 'There are currently no sellers');
