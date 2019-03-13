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
 * @version        $Id: 1.0 main.php 1 Sun 2018-01-07 19:48:19Z XOOPS Project (www.xoops.org) $
 */
 
include_once 'common.php';
 
// ---------------- Main ----------------
define('_MA_WGREALESTATE_INDEX', 'Übersicht');
define('_MA_WGREALESTATE_BACK_INDEX', 'Zurück zur Übersicht');
define('_MA_WGREALESTATE_BACK_OBJECT', 'Zurück zum Objekt');
define('_MA_WGREALESTATE_BACK_OBJECT_EDIT', 'Zurück zur Objektbearbeitung');

define('_MA_WGREALESTATE_TITLE', 'wgRealEstate');
define('_MA_WGREALESTATE_DESC', 'This module provides a platform for selling/renting real estates');
define('_MA_WGREALESTATE_NO', 'No');
// ---------------- Contents ----------------

// Object
define('_MA_WGREALESTATE_OBJECT', 'Objekt');
define('_MA_WGREALESTATE_OBJECTS_TITLE', 'Liste der derzeit verfügbaren Objekte');
define('_MA_WGREALESTATE_OBJECT_GEOCOORDS', 'Hier befindet sich Ihre zukünftige Immobilie');
define('_MA_WGREALESTATE_OBJECTS_NOIMAGE', 'Für diese Immobilie ist derzeit kein Bild verfügbar');
define('_MA_WGREALESTATE_OBJECTS_STATE', 'Aktueller Status');
// Attributes
define('_MA_WGREALESTATE_ATTRIBUTE', 'Objektattribut');
define('_MA_WGREALESTATE_ATTRIBUTES', 'Objektattribute');
define('_MA_WGREALESTATE_ATTRIBUTES_TITLE', 'Definieren der Attribute eines Objektes');
// Kostenart
define('_MA_WGREALESTATE_COST_TYPE', 'Kostenart');
define('_MA_WGREALESTATE_COST_TYPES', 'Kostenarten');
// Kosten
define('_MA_WGREALESTATE_COST', 'Kosten');
define('_MA_WGREALESTATE_COSTS', 'Kosten');
define('_MA_WGREALESTATE_COSTS_TITLE', 'Bearbeiten der Kosten eines Objektes');
define('_MA_WGREALESTATE_COST_SUM', 'Summe');
// Contact
define('_MA_WGREALESTATE_CONTACT', 'Verkäufer kontaktieren');
define('_MA_WGREALESTATE_CONTACT_NAME', 'Ihr Name');
define('_MA_WGREALESTATE_CONTACT_NAME_INFO', 'Bitte Ihren Namen angeben');
define('_MA_WGREALESTATE_CONTACT_PHONE', 'Ihre Telefonnummer');
define('_MA_WGREALESTATE_CONTACT_PHONE_INFO', 'Bitte Ihre Telefonnummer angeben');
define('_MA_WGREALESTATE_CONTACT_MAIL', 'Ihre E-Mail-Adresse');
define('_MA_WGREALESTATE_CONTACT_MAIL_INFO', 'Bitte Ihre E-Mail-Adresse angeben');
define('_MA_WGREALESTATE_CONTACT_SUBJECT', 'Betreff');
define('_MA_WGREALESTATE_CONTACT_MESSAGE', 'Nachricht');
define('_MA_WGREALESTATE_CONTACT_MESSAGE_INFO', 'Hier können Sie noch zusätzliche Infos/Wünsche angeben');
define('_MA_WGREALESTATE_CONTACT_SUBMIT', 'Anfrage absenden');
define('_MA_WGREALESTATE_CONTACT_CONFIRM', 'Eine Kopie der Anfrage an die von mir angegebene E-Mail-Adresse senden?');
define('_MA_WGREALESTATE_CONTACT_SUBMIT_SUCCESS', 'Ihre Anfrage wurde erfolgreich gesendet. Wir werden uns umgehend bei Ihnen melden.');
define('_MA_WGREALESTATE_CONTACT_SUBMIT_FAILED', 'Beim Senden der Anfrage ist leider ein Fehler aufgetreten. Bitte kontaktieren Sie uns direkt.');
// Admin link
define('_MA_WGREALESTATE_ADMIN', 'Admin');
//General
define('_MA_WGREALESTATE_SHOW', 'Details anzeigen');
define('_MA_WGREALESTATE_SORTABLE_MOVE', 'Reihenfolge ändern');
define('_MA_WGREALESTATE_EDIT_START', 'Details bearbeiten');
define('_MA_WGREALESTATE_EDIT_END', 'Bearbeitung Details beenden');
define('_MA_WGREALESTATE_DELETE', 'Objekt löschen');
define('_MA_WGREALESTATE_TYPE_VALID', 'Gültig');
define('_MA_WGREALESTATE_DATECREATE', 'Erstellt am');
define('_MA_WGREALESTATE_SUBMITTER', 'Ersteller');
define('_MA_WGREALESTATE_TYPE_INFO', 'Info');
// google map
define('_MA_WGREALESTATE_GM_SEARCHBOX', 'Bitte Suchfilter eingeben');
// ---------------- End ----------------