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
 * @version        $Id: 1.0 modinfo.php 1 Sun 2018-01-07 19:48:16Z XOOPS Project (www.xoops.org) $
 */
// ---------------- Admin Main ----------------
define('_MI_WGREALESTATE_NAME', 'wgRealEstate');
define('_MI_WGREALESTATE_DESC', 'This module provides a platform for selling / renting real estates');
// ---------------- Admin Menu ----------------
define('_MI_WGREALESTATE_ADMENU1', 'Overview');
define('_MI_WGREALESTATE_ADMENU2', 'Objects');
define('_MI_WGREALESTATE_ADMENU3', 'Attributes');
define('_MI_WGREALESTATE_ADMENU4', 'Costs');
define('_MI_WGREALESTATE_ADMENU5', 'Images');
define('_MI_WGREALESTATE_ADMENU6', 'Files');
define('_MI_WGREALESTATE_ADMENU7', 'Seller');
define('_MI_WGREALESTATE_ADMENU8', 'Mediation Types');
define('_MI_WGREALESTATE_ADMENU9', 'Categories Objects');
define('_MI_WGREALESTATE_ADMENU10', 'Cost Types');
define('_MI_WGREALESTATE_ADMENU11', 'Attributes Standard');
define('_MI_WGREALESTATE_ADMENU12', 'Attribute Categories');
define('_MI_WGREALESTATE_ADMENU16', 'Maintenance');
define('_MI_WGREALESTATE_ABOUT', 'About');
// ---------------- Admin Nav ----------------
define('_MI_WGREALESTATE_ADMIN_PAGER', 'Admin pager');
define('_MI_WGREALESTATE_ADMIN_PAGER_DESC', 'Admin per page list');
// user
define('_MI_WGREALESTATE_USER_PAGER', 'User pager');
define('_MI_WGREALESTATE_USER_PAGER_DESC', 'User per page list');
// submenu
define('_MI_WGREALESTATE_SMNAME1', 'List of available properties');
define('_MI_WGREALESTATE_SMNAME2', 'Create new object');
define('_MI_WGREALESTATE_SMNAME3', 'Show archive');
// blocks
define('_MI_WGREALESTATE_OBJECTS_BLOCK', 'Object List');
define('_MI_WGREALESTATE_OBJECTS_BLOCK_DESC', 'List of available objects');

// config
define('_MI_WGREALESTATE_KEYWORDS', 'Keywords');
define('_MI_WGREALESTATE_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
define('_MI_WGREALESTATE_EDITOR', 'Editor');
define('_MI_WGREALESTATE_EDITOR_DESC', 'Please select editor for input fields');
define('_MI_WGREALESTATE_MAXSIZE_IMAGE', 'Max size');
define('_MI_WGREALESTATE_MAXSIZE_IMAGE_DESC', 'Set a number of max size uploads images in bytes');
define('_MI_WGREALESTATE_MIMETYPES_IMAGE', 'Mime Types for images');
define('_MI_WGREALESTATE_MIMETYPES_IMAGE_DESC', 'Set the mime types for images selected');
define('_MI_WGREALESTATE_MAXWIDTH_IMAGE_MD', 'Max width image');
define('_MI_WGREALESTATE_MAXWIDTH_IMAGE_MD_DESC', 'Set a number of max width for upload images in pixels');
define('_MI_WGREALESTATE_MAXHEIGHT_IMAGE_MD', 'Max height image');
define('_MI_WGREALESTATE_MAXHEIGHT_IMAGE_MD_DESC', 'Set a number of max height for upload images in pixels');
define('_MI_WGREALESTATE_MAXWIDTH_IMAGE_XS', 'Max width thumbs');
define('_MI_WGREALESTATE_MAXWIDTH_IMAGE_XS_DESC', 'Set a number of max width for thumbs of uploaded images in pixels');
define('_MI_WGREALESTATE_MAXHEIGHT_IMAGE_XS', 'Max height thumbs');
define('_MI_WGREALESTATE_MAXHEIGHT_IMAGE_XS_DESC', 'Set a number of max height for thumbs of uploaded image in pixel');
define('_MI_WGREALESTATE_MAXSIZE_FILE', 'Max size');
define('_MI_WGREALESTATE_MAXSIZE_FILE_DESC', 'Set a number of max size uploads files in bytes');
define('_MI_WGREALESTATE_NUMB_COL', 'Number Columns');
define('_MI_WGREALESTATE_NUMB_COL_DESC', 'Number Columns to View.');
define('_MI_WGREALESTATE_PANEL_TYPE', 'Panel Type');
define('_MI_WGREALESTATE_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div.');
define('_MI_WGREALESTATE_GOOGLE_MAPS_API_KEY', 'Google API key');
define('_MI_WGREALESTATE_GOOGLE_MAPS_API_KEY_DESC', "Please enter your Google API key For more information about Google API, please visit <a href='https://support.google.com/googleapi/'> here </a>");
define('_MI_WGREALESTATE_CONTACT_INFO', 'Contact information');
define('_MI_WGREALESTATE_CONTACT_INFO_DESC', 'Please enter here information to be displayed on the contact form <br> may include HTML code');
define('_MI_WGREALESTATE_CONTACT_DEFAULT', 'Standard contact data');
define('_MI_WGREALESTATE_CONTACT_DEFAULT_DESC', 'Here you can specify the contact details to be displayed in addition to the form (e.g., name, address, telephone number, ...) <br> Can include HTML code');
define('_MI_WGREALESTATE_CONTACT_DEFAULT_DEFAULT', "<p> <i class = 'glyphicon glyphicon-phone-old'> </i>: Specify landline number </p><p> <i class = 'glyphicon glyphicon-phone'> </i>: Specify mobile number </p><p> <i class = 'glyphicon glyphicon-envelope'> </i>: specify email address </p> ");
define('_MI_WGREALESTATE_CONTACT_RECIPIENT_STD', 'Default recipient');
define('_MI_WGREALESTATE_CONTACT_RECIPIENT_STD_DESC', "Please enter here the e-mail address to which the contact requests should be forwarded. <br> If multiple e-mail addresses are used, they must be separated by a '|'");
define('_MI_WGREALESTATE_CONTACT_REPLY', 'Standard reply');
define('_MI_WGREALESTATE_CONTACT_REPLY_DESC', 'Please enter the e-mail address here, to be displayed as the sender e-mail address for confirmation e-mails');
define('_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_USE', 'Use Google reCaptcha?');
define('_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_USE_DESC', 'Select <em> Yes </em> to use reCaptcha in the input form. <br> Default: <em> No </em>');
define('_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_KEY', 'Your reCaptcha security key');
define('_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_KEY_DESC', 'More about Google reCaptcha at https:\/\/www.google.com/recaptcha <br> and under \'Help\'.');
define('_MI_WGREALESTATE_NB_FORMAT_DEC', 'Decimal separator');
define('_MI_WGREALESTATE_NB_FORMAT_DEC_DESC', 'Here you can specify which character should be used as a decimal separator');
define('_MI_WGREALESTATE_NB_FORMAT_THOUSANDS', 'Thousand separators');
define('_MI_WGREALESTATE_NB_FORMAT_THOUSANDS_DESC', 'Here you can specify which character should be used as a thousands separator');
define('_MI_WGREALESTATE_GROUP_WRITE', 'Groups with write permission');
define('_MI_WGREALESTATE_GROUP_WRITE_DESC', 'Please define the groups that can create new objects or edit existing objects');
define('_MI_WGREALESTATE_MAINTAINEDBY', 'Maintained By');
define('_MI_WGREALESTATE_MAINTAINEDBY_DESC', 'Allow URL of support site or community');
define('_MI_WGREALESTATE_SHOWCOPYRIGHT', 'Show copyright with developers logo');
define('_MI_WGREALESTATE_SHOWCOPYRIGHT_DESC', 'It is not allowed to remove developers logo without approval of developer');
// ---------------- End ----------------
