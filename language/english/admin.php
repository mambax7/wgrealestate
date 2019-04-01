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
 * @version        $Id: 1.0 admin.php 1 Sun 2018-01-07 19:48:17Z XOOPS Project (www.xoops.org) $
 */
include_once 'common.php';
// ---------------- Admin Index ----------------
define('_AM_WGREALESTATE_STATISTICS', 'Statistics');
// There are
define('_AM_WGREALESTATE_THEREARE_OBJCATEGORIES', "There are <span class = 'bold'>% s </span> object categories in the database");
define('_AM_WGREALESTATE_THEREARE_ATTDEFAULTS', "There are <span class = 'bold'>% s </span> attributes default in the database");
define('_AM_WGREALESTATE_THEREARE_ATTRIBUTES', "There are <span class = 'bold'>% s </span> object attributes in the database");
define('_AM_WGREALESTATE_THEREARE_ATTCATEGORIES', "There are <span class = 'bold'>% s </span> attribute categories in the database");
define('_AM_WGREALESTATE_THEREARE_COST_TYPES', "There are <span class = 'bold'>% s </span> cost_types in the database");
define('_AM_WGREALESTATE_THEREARE_OBJECTS', "There are <span class = 'bold'>% s </span> objects in the database");
define('_AM_WGREALESTATE_THEREARE_COSTS', "There are <span class = 'bold'>% s </span> costs in the database");
define('_AM_WGREALESTATE_THEREARE_IMAGES', "There are <span class = 'bold'>% s </span> images in the database");
define('_AM_WGREALESTATE_THEREARE_FILES', "There are <span class = 'bold'>% s </span> files in the database");
define('_AM_WGREALESTATE_THEREARE_SELLERS', "There are <span class = 'bold'>% s </span> vendors in the database");
// ---------------- Admin Files ----------------
// buttons
define('_AM_WGREALESTATE_ADD_OBJCATEGORY', 'Add new object category');
define('_AM_WGREALESTATE_ADD_ATTDEFAULTS', 'Add new default attribute');
define('_AM_WGREALESTATE_ADD_ATTRIBUTES', 'Add new object attribute');
define('_AM_WGREALESTATE_ADD_ATTCATEGORY', 'Add new attribute category');
define('_AM_WGREALESTATE_ADD_COST_TYPE', 'Add new type cost');
define('_AM_WGREALESTATE_ADD_OBJECT', 'Add new object');
define('_AM_WGREALESTATE_ADD_COST', 'Add new costs');
define('_AM_WGREALESTATE_ADD_IMAGE', 'Add new image');
define('_AM_WGREALESTATE_ADD_FILE', 'Add new file');
define('_AM_WGREALESTATE_ADD_SELLER', 'Add new seller');
// Lists
define('_AM_WGREALESTATE_OBJCAT_CATEGORIES_LIST', 'List of object categories');
define('_AM_WGREALESTATE_ATTDEFAULTS_LIST', 'List of standard attributes');
define('_AM_WGREALESTATE_ATTRIBUTES_LIST', 'List of object attributes');
// define('_CO_WGREALESTATE_COND_TYPES_LIST', 'List of state types');
define('_CO_WGREALESTATE_ATTCATEGORIES_LIST', 'List of attribute categories');
define('_AM_WGREALESTATE_COST_TYPES_LIST', 'List of Cost Elements');
define('_CO_WGREALESTATE_OBJECTS_LIST', 'List of objects');
define('_AM_WGREALESTATE_COSTS_LIST', 'List of costs');
define('_AM_WGREALESTATE_IMAGES_LIST', 'List of images');
define('_AM_WGREALESTATE_FILES_LIST', 'List of files');
define('_AM_WGREALESTATE_SELLERS_LIST', 'List of Sellers');
define('_AM_WGREALESTATE_MAINTAINANCE_LIST', 'List of Maintenance Items');
// ---------------- Admin Classes ----------------
// Elements of deal types
define('_AM_WGREALESTATE_DEALTYPES', 'Deal types');
define('_AM_WGREALESTATE_DEALTYPE_TYPE', 'Deal Type');
// object category add / edit
define('_AM_WGREALESTATE_OBJCAT_CATEGORY_ADD', 'Add object category');
define('_AM_WGREALESTATE_OBJCAT_CATEGORY_EDIT', 'Edit object category');
// Elements of object categories
define('_AM_WGREALESTATE_OBJCAT_CATEGORIES', 'Object Categories');
define('_AM_WGREALESTATE_OBJCAT_CATEGORY_NAME', 'Name object category');
// add_attribute add / edit
define('_AM_WGREALESTATE_ATTDEFAULTS_ADD', 'Add default attribute');
define('_AM_WGREALESTATE_ATTDEFAULTS_EDIT', 'Edit default attribute');
// Elements of Add_attdefault
define('_AM_WGREALESTATE_ATTDEFAULT', 'Default attribute');
define('_AM_WGREALESTATE_ATTDEFAULTS', 'Default attributes');
define('_AM_WGREALESTATE_ATTDEFAULTS_PARENT', 'Parent');
define('_AM_WGREALESTATE_ATTDEFAULTS_NAME', 'Name');
define('_AM_WGREALESTATE_ATTDEFAULTS_TYPE', 'Type attribute');
// Elements of additional attdefaults
define('_AM_WGREALESTATE_ATTRIBUTE', 'Object attribute');
define('_AM_WGREALESTATE_ATTRIBUTES', 'Object Attributes');
define('_AM_WGREALESTATE_ATTRIBUTES_INFO', 'Info');
define('_AM_WGREALESTATE_ATTRIBUTES_VALUE', 'Value');
// Elements of heating types
define('_AM_WGREALESTATE_HEATING_TYPE_TEXT', 'Type');
// energy system type add / edit
define('_AM_WGREALESTATE_ATTCATEGORY_ADD', 'Add Attribute Category');
define('_AM_WGREALESTATE_ATTCATEGORY_EDIT', 'Edit Attribute Category');
// Elements of energy types
define('_AM_WGREALESTATE_ATTCATEGORY_NAME', 'Name Attribute Category');
define('_AM_WGREALESTATE_ATTCATEGORY_NAME_SHOW', 'Show name on user page');
// Cost type add / edit
define('_AM_WGREALESTATE_COST_TYPE_ADD', 'Add cost type');
define('_AM_WGREALESTATE_COST_TYPE_EDIT', 'Edit cost element');
// Elements of cost types
define('_AM_WGREALESTATE_COST_TYPES', 'Cost Types');
define('_AM_WGREALESTATE_COST_TYPE_TEXT', 'Type');
define('_AM_WGREALESTATE_COST_TYPE_PERC', 'Percentage');
define('_AM_WGREALESTATE_COST_TYPE_FIXED', 'Fixed Constituent');
// Elements of Image
define('_AM_WGREALESTATE_IMAGE', 'Image');
define('_AM_WGREALESTATE_IMAGE_DIM', 'Dimensions');
define('_AM_WGREALESTATE_IMAGE_SIZE', 'Size');
// seller add / edit
define('_AM_WGREALESTATE_SELLER_ADD', 'Add seller');
define('_AM_WGREALESTATE_SELLER_EDIT', 'Edit seller');
// Elements of seller
define('_AM_WGREALESTATE_SELLER_NAME', 'Name');
define('_AM_WGREALESTATE_SELLER_CTRY', 'Country');
define('_AM_WGREALESTATE_SELLER_POSTAL_CODE', 'ZIP');
define('_AM_WGREALESTATE_SELLER_CITY', 'City');
define('_AM_WGREALESTATE_SELLER_ADDRESS', 'Address');
define('_AM_WGREALESTATE_SELLER_PHONE', 'Phone');
define('_AM_WGREALESTATE_SELLER_MAIL', 'E-Mail');
define('_AM_WGREALESTATE_SELLER_CAT', 'Category');
define('_AM_WGREALESTATE_SELLER_PUBLIC', 'Public');
// Elements of maintainance
define('_AM_WGREALESTATE_MAINTAINANCE', 'Maintenance');
define('_AM_WGREALESTATE_MAINTAIN_EXEC', 'Execute');
define('_AM_WGREALESTATE_MAINTAIN_RESULT', 'Result of maintenance');
define('_AM_WGREALESTATE_MAINTAIN_CHECK_FOLDER_OBJ', 'Check file structure upload directory');
define('_AM_WGREALESTATE_MAINTAIN_CHECK_FOLDER_OBJ_RES', 'File Structure Upload Directory Checked Number of Fixed Folders:');
define('_AM_WGREALESTATE_MAINTAIN_RESIZE_THUMBS', 'Customize thumbnails');
define('_AM_WGREALESTATE_MAINTAIN_RESIZE_THUMBS_RES', 'Thumbnails adjusted thumbnails Number of customized thumbnails:');
define('_AM_WGREALESTATE_MAINTAIN_OBJIDS', 'Check tables for invalid object IDs');
define('_AM_WGREALESTATE_MAINTAIN_OBJIDS_RES', 'Checked tables for invalid object IDs Number of fixes:');

// ---------------- Admin Others ----------------
define('_AM_WGREALESTATE_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------

define('_AM_WGREALESTATE_ATTCATEGORIES', 'Attribute Category');
