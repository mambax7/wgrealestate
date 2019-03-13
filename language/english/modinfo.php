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
define('_MI_WGREALESTATE_DESC', 'This module provides a platform for selling/renting real estates');
// ---------------- Admin Menu ----------------
define('_MI_WGREALESTATE_ADMENU1', 'Übersicht');
define('_MI_WGREALESTATE_ADMENU2', 'Objekte');
define('_MI_WGREALESTATE_ADMENU3', 'Attribute');
define('_MI_WGREALESTATE_ADMENU4', 'Kosten');
define('_MI_WGREALESTATE_ADMENU5', 'Bilder');
define('_MI_WGREALESTATE_ADMENU6', 'Files');
define('_MI_WGREALESTATE_ADMENU7', 'Verkäufer');
define('_MI_WGREALESTATE_ADMENU8', 'Typen Vermittlung');
define('_MI_WGREALESTATE_ADMENU9', 'Kategorien Objekte');
define('_MI_WGREALESTATE_ADMENU10', 'Kostenarten');
define('_MI_WGREALESTATE_ADMENU11', 'Attribute Standard');
define('_MI_WGREALESTATE_ADMENU12', 'Attribute Kategorien');
define('_MI_WGREALESTATE_ADMENU16', 'Wartung');
define('_MI_WGREALESTATE_ABOUT', 'About');
// ---------------- Admin Nav ----------------
define('_MI_WGREALESTATE_ADMIN_PAGER', 'Admin pager');
define('_MI_WGREALESTATE_ADMIN_PAGER_DESC', 'Admin per page list');
// User
define('_MI_WGREALESTATE_USER_PAGER', 'User pager');
define('_MI_WGREALESTATE_USER_PAGER_DESC', 'User per page list');
// Submenu
define('_MI_WGREALESTATE_SMNAME1', 'Liste der verfügbaren Immobilien');
define('_MI_WGREALESTATE_SMNAME2', 'Neues Objekt anlegen');
define('_MI_WGREALESTATE_SMNAME3', 'Show archive');
// Blocks
define('_MI_WGREALESTATE_OBJECTS_BLOCK', 'Objektliste');
define('_MI_WGREALESTATE_OBJECTS_BLOCK_DESC', 'Liste der verfügbaren Objekte');

// Config
define('_MI_WGREALESTATE_KEYWORDS', 'Keywords');
define('_MI_WGREALESTATE_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
define('_MI_WGREALESTATE_EDITOR', 'Editor');
define('_MI_WGREALESTATE_EDITOR_DESC', 'Bitte Editor für die Eingabefelder wählen');
define('_MI_WGREALESTATE_MAXSIZE_IMAGE', 'Max size');
define('_MI_WGREALESTATE_MAXSIZE_IMAGE_DESC', 'Set a number of max size uploads images in byte');
define('_MI_WGREALESTATE_MIMETYPES_IMAGE', 'Mime Types for images');
define('_MI_WGREALESTATE_MIMETYPES_IMAGE_DESC', 'Set the mime types for images selected');
define('_MI_WGREALESTATE_MAXWIDTH_IMAGE_MD', 'Max width image');
define('_MI_WGREALESTATE_MAXWIDTH_IMAGE_MD_DESC', 'Set a number of max width for upload images in pixel');
define('_MI_WGREALESTATE_MAXHEIGHT_IMAGE_MD', 'Max height image');
define('_MI_WGREALESTATE_MAXHEIGHT_IMAGE_MD_DESC', 'Set a number of max height for upload images in pixel');
define('_MI_WGREALESTATE_MAXWIDTH_IMAGE_XS', 'Max width thumbs');
define('_MI_WGREALESTATE_MAXWIDTH_IMAGE_XS_DESC', 'Set a number of max width for thumbs of uploaded images in pixel');
define('_MI_WGREALESTATE_MAXHEIGHT_IMAGE_XS', 'Max height thumbs');
define('_MI_WGREALESTATE_MAXHEIGHT_IMAGE_XS_DESC', 'Set a number of max height for thumbs of uploaded images in pixel');
define('_MI_WGREALESTATE_MAXSIZE_FILE', 'Max size');
define('_MI_WGREALESTATE_MAXSIZE_FILE_DESC', 'Set a number of max size uploads files in byte');
define('_MI_WGREALESTATE_NUMB_COL', 'Number Columns');
define('_MI_WGREALESTATE_NUMB_COL_DESC', 'Number Columns to View.');
define('_MI_WGREALESTATE_PANEL_TYPE', 'Panel Type');
define('_MI_WGREALESTATE_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div.');
define('_MI_WGREALESTATE_GOOGLE_MAPS_API_KEY', 'Google API Schlüssel');
define('_MI_WGREALESTATE_GOOGLE_MAPS_API_KEY_DESC', "Bitte Ihren Google API Schlüssel eingeben. Mehr Infos zu Google API finden Sie <a href='https://support.google.com/googleapi/' > hier</a>");
define('_MI_WGREALESTATE_CONTACT_INFO', 'Kontaktinformationen');
define('_MI_WGREALESTATE_CONTACT_INFO_DESC', 'Bitte hier Informationen angeben, die beim Kontaktformular angezeigt werden sollen<br>Darf HTML Code beinhalten');
define('_MI_WGREALESTATE_CONTACT_DEFAULT', 'Kontaktdaten Standard');
define('_MI_WGREALESTATE_CONTACT_DEFAULT_DESC', 'Hier können die Kontaktdaten angegeben werden, die zusätzlich zum Formular angezeigt werden sollen (z.B. Name, Adresse , Telefonnummer,...)<br>Darf HTML Code beinhalten');
define('_MI_WGREALESTATE_CONTACT_DEFAULT_DEFAULT', "<p><i class='glyphicon glyphicon-phone-alt'></i>: Festnetznummer angeben</p>
<p><i class='glyphicon glyphicon-phone'></i>: Handynummer angeben</p>
<p><i class='glyphicon glyphicon-envelope'></i>: Mailadresse angeben</p>");
define('_MI_WGREALESTATE_CONTACT_RECIPIENT_STD', 'Standardempfänger');
define('_MI_WGREALESTATE_CONTACT_RECIPIENT_STD_DESC', "Bitte hier die E-Mail-Adresse eintragen, an die die Kontaktanfragen weitergeleitet werden sollen.<br>Bei Verwendung von mehreren E-Mail-Adressen sind diese durch ein '|' zu trennen");
define('_MI_WGREALESTATE_CONTACT_REPLY', 'Standardabsender');
define('_MI_WGREALESTATE_CONTACT_REPLY_DESC', 'Bitte hier die E-Mail-Adresse eintragen, als Absender-E-Mail-Adressen bei Bestätigungsmails angezeigt werden soll');
define('_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_USE', 'Google reCaptcha verwenden?');
define('_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_USE_DESC', 'Wähle <em>Ja</em>, um reCaptcha im Eingabeformular zu verwenden.<br>Standard: <em>Nein</em>');
define('_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_KEY', 'Ihr reCaptcha-Sicherheitsschlüssel');
define('_MI_WGREALESTATE_CONTACT_FORM_RECAPTCHA_KEY_DESC', "Mehr über Google reCaptcha unter https://www.google.com/recaptcha <br>und unter 'Hilfe'.");
define('_MI_WGREALESTATE_NB_FORMAT_DEC', 'Dezimaltrennzeichen');
define('_MI_WGREALESTATE_NB_FORMAT_DEC_DESC', 'Hier können angegeben werden, welches Zeichen als Dezimaltrennzeichen verwendet werden soll');
define('_MI_WGREALESTATE_NB_FORMAT_THOUSANDS', 'Tausender-Trennzeichen');
define('_MI_WGREALESTATE_NB_FORMAT_THOUSANDS_DESC', 'Hier können angegeben werden, welches Zeichen als Tausender-Trennzeichen verwendet werden soll');
define('_MI_WGREALESTATE_GROUP_WRITE', 'Gruppen mit Schreibrecht');
define('_MI_WGREALESTATE_GROUP_WRITE_DESC', 'Definieren Sie bitte die Gruppen, die neue Objekte erstellen bzw. existierende Objekte bearbeiten dürfen');
define('_MI_WGREALESTATE_MAINTAINEDBY', 'Maintained By');
define('_MI_WGREALESTATE_MAINTAINEDBY_DESC', 'Allow url of support site or community');
define('_MI_WGREALESTATE_SHOWCOPYRIGHT', 'Show copyright with developers logo');
define('_MI_WGREALESTATE_SHOWCOPYRIGHT_DESC', 'It is not allowed to remove developers logo without approval of developer');
// ---------------- End ----------------