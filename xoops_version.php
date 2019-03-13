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
 * @version        $Id: 1.0 xoops_version.php 1 Sun 2018-01-07 21:18:26Z XOOPS Project (www.xoops.org) $
 */

// 
$dirname  = basename(__DIR__);
// ------------------- Informations ------------------- //
$modversion['name'] = _MI_WGREALESTATE_NAME;
$modversion['version'] = 1.01;
$modversion['description'] = _MI_WGREALESTATE_DESC;
$modversion['author'] = 'Wedega';
$modversion['author_mail'] = 'webmaster@wedega.com';
$modversion['author_website_url'] = 'https://wedega.com';
$modversion['author_website_name'] = 'Wedega - Webdesign Gabor';
$modversion['credits'] = 'XOOPS Project (www.xoops.org)';
$modversion['license'] = 'GPL 2.0 or later';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl-3.0.en.html';
$modversion['help'] = 'page=help';
$modversion['release_info'] = 'release_info';
$modversion['release_file'] = XOOPS_URL . '/modules/wgrealestate/docs/release_info file';
$modversion['release_date'] = '2018/01/07';
$modversion['manual'] = 'link to manual file';
$modversion['manual_file'] = XOOPS_URL . '/modules/wgrealestate/docs/install.txt';
$modversion['min_php'] = '5.3';
$modversion['min_xoops'] = '2.5.7';
$modversion['min_admin'] = '1.1';
$modversion['min_db'] = array('mysql' => '5.0.7', 'mysqli' => '5.0.7');
$modversion['image'] = 'assets/images/wgrealestate_logo.png';
$modversion['dirname'] = basename(__DIR__);
$modversion['dirmoduleadmin'] = 'Frameworks/moduleclasses/moduleadmin';
$modversion['sysicons16'] = '../../Frameworks/moduleclasses/icons/16';
$modversion['sysicons32'] = '../../Frameworks/moduleclasses/icons/32';
$modversion['modicons16'] = 'assets/icons/16';
$modversion['modicons32'] = 'assets/icons/32';
$modversion['demo_site_url'] = 'https://xoops.wedega.com';
$modversion['demo_site_name'] = 'Wedega XOOPS Demo Site';
$modversion['support_url'] = 'https://xoops.wedega.com';
$modversion['support_name'] = 'Wedega - Webdesign Gabor';
$modversion['module_website_url'] = 'https://xoops.wedega.com';
$modversion['module_website_name'] = 'Wedega XOOPS Demo Site';
$modversion['release'] = '01/01/2018';
$modversion['module_status'] = 'Beta 1';
$modversion['system_menu'] = 1;
$modversion['hasAdmin'] = 1;
$modversion['hasMain'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';
$modversion['onInstall'] = 'include/install.php';
$modversion['onUpdate'] = 'include/update.php';
// ------------------- Templates ------------------- //
// Admin
$modversion['templates'][] = array('file' => 'wgrealestate_admin_about.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_header.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_index.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_objcategories.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_attdefaults.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_attributes.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_attcategories.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_cost_types.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_objects.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_costs.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_images.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_files.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_sellers.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_geocoords.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_maintainance.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wgrealestate_admin_footer.tpl', 'description' => '', 'type' => 'admin');
// User
$modversion['templates'][] = array('file' => 'wgrealestate_header.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_index.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_attributes.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_objects.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_object_single.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_geocoords.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_map.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_costs.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_images.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_files.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_contact.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_sellers.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_sellers_list.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_breadcrumbs.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_pdf.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_rss.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_search.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wgrealestate_footer.tpl', 'description' => '');
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'][] = 'wgrealestate_objects';
$modversion['tables'][] = 'wgrealestate_attributes';
$modversion['tables'][] = 'wgrealestate_objcategories';
$modversion['tables'][] = 'wgrealestate_attdefaults';
$modversion['tables'][] = 'wgrealestate_attcategories';
$modversion['tables'][] = 'wgrealestate_costs';
$modversion['tables'][] = 'wgrealestate_cost_types';
$modversion['tables'][] = 'wgrealestate_images';
$modversion['tables'][] = 'wgrealestate_files';
$modversion['tables'][] = 'wgrealestate_sellers';
// ------------------- Search ------------------- //
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'wgrealestate_search';
// ------------------- Submenu ------------------- //
// Sub sellers
$s = 0;
// Sub objects
$s++;
$modversion['sub'][$s]['name'] = _MI_WGREALESTATE_SMNAME1;
$modversion['sub'][$s]['url'] = 'index.php';
// Sub add new
$currdirname = isset($GLOBALS['xoopsModule']) && is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';
if ($dirname == $currdirname) {
	// Get instance of module
    $pathname = XOOPS_ROOT_PATH . '/modules/' . $dirname;
    include_once $pathname . '/include/common.php';
	$wgrealestate = WgrealestateHelper::getInstance();
    if (wgrealestate_isModerator()) {
		$s++;
		$modversion['sub'][$s]['name'] = _MI_WGREALESTATE_SMNAME2;
		$modversion['sub'][$s]['url'] = 'objects.php?op=new';
        $s++;
		$modversion['sub'][$s]['name'] = _MI_WGREALESTATE_SMNAME3;
		$modversion['sub'][$s]['url'] = 'index.php?op=show_archive';
	}
}
unset($s);

// ------------------- Blocks ------------------- //
$b = 0;
// Objects
++$b;
$modversion['blocks'][$b]['file'] = 'objects.php';
$modversion['blocks'][$b]['name'] = _MI_WGREALESTATE_OBJECTS_BLOCK;
$modversion['blocks'][$b]['description'] = _MI_WGREALESTATE_OBJECTS_BLOCK_DESC;
$modversion['blocks'][$b]['show_func'] = 'b_wgrealestate_objects_show';
$modversion['blocks'][$b]['edit_func'] = 'b_wgrealestate_objects_edit';
$modversion['blocks'][$b]['template'] = 'wgrealestate_block_objects.tpl';
$modversion['blocks'][$b]['options'] = 'obj|5|25';

unset($b);
// ------------------- Config ------------------- //
$c = 1;
// Keywords
$modversion['config'][$c]['name'] = 'keywords';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_KEYWORDS';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_KEYWORDS_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'wgrealestate, real estate, wedega, webdesign gabor, xoops';
++$c;
// Editor
xoops_load('xoopseditorhandler');
$editorHandler            = XoopsEditorHandler::getInstance();
$modversion['config'][$c]['name'] = 'wgrealestate_editor';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_EDITOR';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_EDITOR_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['options'] = array_flip($editorHandler->getList());
$modversion['config'][$c]['default'] = 'dhtmltextarea';
++$c;
// Admin pager
$modversion['config'][$c]['name'] = 'adminpager';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_ADMIN_PAGER';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_ADMIN_PAGER_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 10;
++$c;
// User pager
$modversion['config'][$c]['name'] = 'userpager';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_USER_PAGER';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_USER_PAGER_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 10;
++$c;
// Number column
$modversion['config'][$c]['name'] = 'numb_col';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_NUMB_COL';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_NUMB_COL_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1;
$modversion['config'][$c]['options'] = array(1 => '1', 2 => '2', 3 => '3', 4 => '4');
++$c;
// Panel by
$modversion['config'][$c]['name'] = 'panel_type';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_PANEL_TYPE';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_PANEL_TYPE_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'default';
$modversion['config'][$c]['options'] = array('none' => 'none', 'default' => 'default', 'primary' => 'primary', 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger');
++$c;
//Uploads : maxsize images
++$c;
$modversion['config'][$c]['name'] = 'maxsize_image';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_MAXSIZE_IMAGE';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_MAXSIZE_IMAGE_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 10485760; // 1 MB
++$c;
$modversion['config'][$c]['name'] = 'maxwidth_image_md';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_MAXWIDTH_IMAGE_MD';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_MAXWIDTH_IMAGE_MD_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1000; // pixel
++$c;
$modversion['config'][$c]['name'] = 'maxheight_image_md';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_MAXHEIGHT_IMAGE_MD';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_MAXHEIGHT_IMAGE_MD_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1000; // pixel
++$c;
$modversion['config'][$c]['name'] = 'maxwidth_image_xs';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_MAXWIDTH_IMAGE_XS';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_MAXWIDTH_IMAGE_XS_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 200; // pixel
++$c;
$modversion['config'][$c]['name'] = 'maxheight_image_xs';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_MAXHEIGHT_IMAGE_XS';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_MAXHEIGHT_IMAGE_XS_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 200; // pixel
//Uploads : mimetypes of images/logos
++$c;
$modversion['config'][$c]['name'] = 'mimetypes_image';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_MIMETYPES_IMAGE';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_MIMETYPES_IMAGE_DESC';
$modversion['config'][$c]['formtype'] = 'select_multi';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = array('image/gif', 'image/jpeg', 'image/png');
$modversion['config'][$c]['options'] = array('bmp' => 'image/bmp', 'gif' => 'image/gif', 'pjpeg' => 'image/pjpeg',
                       'jpeg' => 'image/jpeg', 'jpg' => 'image/jpg', 'jpe' => 'image/jpe',
                       'png' => 'image/png');
// Google Maps API key
++$c;
$modversion['config'][$c]['name'] = 'googlemapsapikey';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_GOOGLE_MAPS_API_KEY';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_GOOGLE_MAPS_API_KEY_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'YOUR_MAP_API_KEY';
// Contact form
++$c;
$modversion['config'][$c]['name'] = 'contact_info';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_CONTACT_INFO';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_CONTACT_INFO_DESC';
$modversion['config'][$c]['formtype'] = 'textarea';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = '';
++$c;
$modversion['config'][$c]['name'] = 'contact_default';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_CONTACT_DEFAULT';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_CONTACT_DEFAULT_DESC';
$modversion['config'][$c]['formtype'] = 'textarea';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = _MI_WGREALESTATE_CONTACT_DEFAULT_DEFAULT;
++$c;
$modversion['config'][$c]['name'] = 'contact_recipient_std';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_CONTACT_RECIPIENT_STD';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_CONTACT_RECIPIENT_STD_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = $xoopsConfig['adminmail'];
++$c;
$modversion['config'][$c]['name'] = 'contact_reply';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_CONTACT_REPLY';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_CONTACT_REPLY_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'no-reply@mydomain.com';
// Contact form recaptcha
++$c;
$modversion['config'][$c]['name'] = 'recaptchause';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_USE';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_USE_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 0;
++$c;
$modversion['config'][$c]['name'] = 'recaptchakey';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_KEY';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_KEY_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'YOUR_RECAPTCHA_API_KEY';
// number formats
++$c;
$modversion['config'][$c]['name'] = 'format_decpoint';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_NB_FORMAT_DEC';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_NB_FORMAT_DEC_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = '.';
++$c;
$modversion['config'][$c]['name'] = 'format_thousands';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_NB_FORMAT_THOUSANDS';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_NB_FORMAT_THOUSANDS_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = ',';
++$c;
$modversion['config'][$c]['name'] = 'groups_write';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_GROUP_WRITE';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_GROUP_WRITE_DESC';
$modversion['config'][$c]['formtype'] = 'group_multi';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = '1';
// Maintained by
++$c;
$modversion['config'][$c]['name'] = 'maintainedby';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_MAINTAINEDBY';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_MAINTAINEDBY_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'https://xoops.wedega.com';
++$c;
$modversion['config'][$c]['name'] = 'show_copyright';
$modversion['config'][$c]['title'] = '_MI_WGREALESTATE_SHOWCOPYRIGHT';
$modversion['config'][$c]['description'] = '_MI_WGREALESTATE_SHOWCOPYRIGHT_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1;
unset($c);
