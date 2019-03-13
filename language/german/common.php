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
define('_CO_WGREALESTATE_FORM_UPLOAD', 'Hochladen Datei');
define('_CO_WGREALESTATE_FORM_IMAGE_PATH', 'Dateien in %s ');
define('_CO_WGREALESTATE_FORM_ACTION', 'Aktion');
define('_CO_WGREALESTATE_FORM_EDIT', 'Bearbeiten');
define('_CO_WGREALESTATE_FORM_DELETE', 'Löschen');

define('_CO_WGREALESTATE_TYPE_INFO', 'Info');
define('_CO_WGREALESTATE_TYPE_VALID', 'Gültig');
define('_CO_WGREALESTATE_ID', 'Id');
define('_CO_WGREALESTATE_WEIGHT', 'Reihenfolge');
define('_CO_WGREALESTATE_DATECREATE', 'Erstellt am');
define('_CO_WGREALESTATE_SUBMITTER', 'Bearbeiter(in)');
define('_CO_WGREALESTATE_NONE', 'Ohne');
define('_CO_WGREALESTATE_NOACTION', 'Keine Aktion');
define('_CO_WGREALESTATE_INDEX_SHOW', 'Auf Indexseite anzeigen');
define('_CO_WGREALESTATE_INDEX_HEADER', 'Im Hauptbereich anzeigen');
define('_CO_WGREALESTATE_INDEX_MISC', 'Als Zusatz anzeigen');

define('_CO_WGREALESTATE_DOWNLOAD', 'Download');

// Save/Delete
define('_CO_WGREALESTATE_FORM_OK', 'Erfolgreich gespeichert');
define('_CO_WGREALESTATE_FORM_DELETE_OK', 'Erfolgreich gelöscht');
define('_CO_WGREALESTATE_FORM_SURE_DELETE', "Wollen Sie wirklich löschen: <b><span style='color : Red;'>%s </span></b>");
define('_CO_WGREALESTATE_FORM_SURE_RENEW', "Wollen Sie wirklich aktualisieren: <b><span style='color : Red;'>%s </span></b>");
// Errors
define('_CO_WGREALESTATE_FORM_DELETE_FAIL1', 'Der Datensatz konnte erfolgreich gelöscht werden, jedoch trat beim Löschen des Bildes ein Fehler auf!');
define('_CO_WGREALESTATE_ERROR_NO_VALID_OBJID', 'Fehler: Ungültiger Parameter Objekt-ID!');
define('_CO_WGREALESTATE_ERROR_GEO', 'Fehler bei der Ermittlung der Geo-Koordinaten!');
// misc
define('_CO_WGREALESTATE_NO_PERM', 'Sie haben nicht die Berechtigung, diese Aktion durchzuführen!');
// attributes add/edit
define('_CO_WGREALESTATE_ATTRIBUTES_ADD', 'Hinzufügen Objektattribute');
define('_CO_WGREALESTATE_ATTRIBUTES_EDIT', 'Bearbeiten Objektattribute');
// cost types
define('_CO_WGREALESTATE_COST_TYPE', 'Kostenart');
// cost add/edit
define('_CO_WGREALESTATE_COST_ADD', 'Hinzufügen Kosten');
define('_CO_WGREALESTATE_COST_EDIT', 'Bearbeiten Kosten');
// Elements of cost
define('_CO_WGREALESTATE_COST_PERC', 'Prozent');
define('_CO_WGREALESTATE_COST_BASE', 'Berechnungsbasis');
define('_CO_WGREALESTATE_COST_INFO', 'Info');
define('_CO_WGREALESTATE_COST_VALUE', 'Wert');
define('_CO_WGREALESTATE_COST_CALC', 'Berechnen');
define('_CO_WGREALESTATE_COST_SUM_RENT', 'Summe Mietkosten');
define('_CO_WGREALESTATE_COST_SUM_SALE', 'Summe Kaufkosten');
// Object add/edit
define('_CO_WGREALESTATE_OBJECT_ADD', 'Hinzufügen Objekt');
define('_CO_WGREALESTATE_OBJECT_EDIT', 'Bearbeiten Objekt');
// Elements of Object
define('_CO_WGREALESTATE_OBJECT', 'Objekt');
define('_CO_WGREALESTATE_OBJECTS', 'Objekte');
define('_CO_WGREALESTATE_OBJECT_TITLE', 'Objekttitel');
define('_CO_WGREALESTATE_OBJECT_CTRY', 'LAND');
define('_CO_WGREALESTATE_OBJECT_POSTALCODE', 'PLZ');
define('_CO_WGREALESTATE_OBJECT_CITY', 'Ort');
define('_CO_WGREALESTATE_OBJECT_ADDRESS', 'Adresse');
define('_CO_WGREALESTATE_OBJECT_GEO', 'Geo-Code');
define('_CO_WGREALESTATE_OBJECT_GEO_LNG', 'Längengrade');
define('_CO_WGREALESTATE_OBJECT_GEO_LAT', 'Breitengrad');
define('_CO_WGREALESTATE_OBJECT_GEO_PLACEID', 'Geo-Place-ID');
define('_CO_WGREALESTATE_OBJECT_GEO_SEARCH', 'Geo-Code ermitteln');
define('_CO_WGREALESTATE_OBJECT_SELLER_ID', 'Verkäufer');
define('_CO_WGREALESTATE_OBJECT_DESCR', 'Beschreibung');
define('_CO_WGREALESTATE_OBJECT_INFOS', 'Ausstattung');
define('_CO_WGREALESTATE_OBJECT_MISC', 'Sonstiges');
define('_CO_WGREALESTATE_OBJECT_LOCATION', 'Lage');
define('_CO_WGREALESTATE_OBJECT_STATISTICS', 'Statistische Informationen');
define('_CO_WGREALESTATE_OBJECT_VIEWS', 'Aufrufe');
define('_CO_WGREALESTATE_OBJECT_CONTACTS', 'Kontaktaufnahmen');
define('_CO_WGREALESTATE_OBJECT_STATE', 'Status');
define('_CO_WGREALESTATE_OBJECT_DATESTATE', 'Datum Status');
define('_CO_WGREALESTATE_OBJECT_GEOCOORDS', 'Geo-Koordinaten');
define('_CO_WGREALESTATE_OBJECT_GEOCOORDS_EDIT', 'Geo-Koordinaten ermitteln');
define('_CO_WGREALESTATE_OBJECT_GEOCOORDS_AUTO', 'Geo-Koordinaten anhand der angegebenen Orts- und Adressangaben automatisch ermitteln');
define('_CO_WGREALESTATE_OBJECT_GEOCOORDS_DELETE', 'Derzeitige Koordinaten (%s) löschen');
// Image add/edit
define('_CO_WGREALESTATE_IMAGE_ADD', 'Bild hinzufügen');
define('_CO_WGREALESTATE_IMAGE_EDIT', 'Bilder bearbeiten');
// Elements of images
define('_CO_WGREALESTATE_IMAGES_TITLE', 'Bearbeiten und Hinzufügen von Bildern');
define('_CO_WGREALESTATE_IMAGES_PLAN_TITLE', 'Pläne und Grundrisse');
define('_CO_WGREALESTATE_IMAGE', 'Bild');
define('_CO_WGREALESTATE_IMAGES', 'Bildergalerie');
define('_CO_WGREALESTATE_IMAGES_GALLERY', 'Zur Bildergalerie');
define('_CO_WGREALESTATE_IMAGE_TYPE', 'Verwendungsart');
define('_CO_WGREALESTATE_IMAGE_TITLE', 'Bildtitel');
define('_CO_WGREALESTATE_IMAGE_INFO', 'Zusätzliche Informationen');
define('_CO_WGREALESTATE_IMAGE_NAME', 'Name');
define('_CO_WGREALESTATE_IMAGE_INFOS', 'Zusätzliche Bildinfos');
define('_CO_WGREALESTATE_IMAGE_FORM_UPLOAD', 'Datei zum Hochladen auswählen');
define('_CO_WGREALESTATE_IMAGE_DIM', 'Abmessungen');
define('_CO_WGREALESTATE_IMAGE_SIZE', 'Größe');
// File add/edit
define('_CO_WGREALESTATE_FILE_ADD', 'Hinzufügen Dateien');
define('_CO_WGREALESTATE_FILE_EDIT', 'Bearbeiten Dateien');
// Elements of File
define('_CO_WGREALESTATE_FILES_TITLE', 'Bearbeiten und Hinzufügen von Dateien');
define('_CO_WGREALESTATE_FILES_PLAN_TITLE', 'Dateien');
define('_CO_WGREALESTATE_FILE', 'Datei');
define('_CO_WGREALESTATE_FILES', 'Dateien');
define('_CO_WGREALESTATE_FILE_TITLE', 'Dateititel');
define('_CO_WGREALESTATE_FILE_INFO', 'Zusätzliche Informationen');
define('_CO_WGREALESTATE_FILE_NAME', 'Name');
define('_CO_WGREALESTATE_FILE_TYPE', 'Dateityp');
define('_CO_WGREALESTATE_FILE_SIZE', 'Dateigröße');
define('_CO_WGREALESTATE_FILE_LOGO', 'Logo');
define('_CO_WGREALESTATE_FORM_UPLOAD_FILE_FILES', 'Datei zum Hochladen auswählen');
 
// Elements of deal types
define('_CO_WGREALESTATE_DEALTYPE', 'Vermittlungstyp');
define('_CO_WGREALESTATE_DEALTYPE_RENT',  'Mieten');
define('_CO_WGREALESTATE_DEALTYPE_SALE',  'Kaufen'); 
// Elements of Objektkategorie
define('_CO_WGREALESTATE_OBJCAT_CATEGORY', 'Objektkategorie');
// Vars for constants
define('_CO_WGREALESTATE_STATE_NEW', 'Erstellung');
define('_CO_WGREALESTATE_STATE_ONLINE', 'Online');
define('_CO_WGREALESTATE_STATE_ARCHIVE', 'Archiv');

define('_CO_WGREALESTATE_IMGCAT_PICTURE', 'Ansichtsbilder');
define('_CO_WGREALESTATE_IMGCAT_PLAN', 'Pläne');

define('_CO_WGREALESTATE_ATTR_YN', 'Ja/Nein');
define('_CO_WGREALESTATE_ATTR_TEXT', 'Textfeld');
define('_CO_WGREALESTATE_ATTR_TEXTAREA', 'erweitertes Textfeld');
define('_CO_WGREALESTATE_ATTR_TEXT_M2', 'Textfeld Quadratmeter');
define('_CO_WGREALESTATE_ATTR_TEXT_CURR', 'Textfeld Euro');
define('_CO_WGREALESTATE_ATTR_SELECT', 'Auswahlfeld');
define('_CO_WGREALESTATE_ATTR_SELECT_ITEM', 'Eintrag Auswahlfeld');
define('_CO_WGREALESTATE_ATTR_TEXT_KWH', 'Textfeld kWh');

define('_CO_WGREALESTATE_CURRENCY', 'Euro');
define('_CO_WGREALESTATE_SQUAREMETER', 'm<sup>2</sup>');
define('_CO_WGREALESTATE_KWH', 'kWh/(m<sup>2</sup>*a)');

define('_CO_WGREALESTATE_ALL', 'Alle');
define('_CO_WGREALESTATE_INFO', 'Zusatzinfo');
define('_CO_WGREALESTATE_USE_NOT', 'Nicht zutreffend');

// There aren't
define('_CO_WGREALESTATE_THEREARENT_OBJCATEGORIES', 'Es gibt derzeit keine Objkategorien');
define('_CO_WGREALESTATE_THEREARENT_ATTDEFAULTS', 'Es gibt derzeit keine Standard-Attribute');
define('_CO_WGREALESTATE_THEREARENT_ATTRIBUTES', 'Es gibt derzeit keine Attribute');
define('_CO_WGREALESTATE_THEREARENT_ATTCATEGORIES', 'Es gibt derzeit keine Attributkategorien');
define('_CO_WGREALESTATE_THEREARENT_COST_TYPES', 'Es gibt derzeit keine Kostenarten');
define('_CO_WGREALESTATE_THEREARENT_OBJECTS', 'Es gibt derzeit keine Objekte');
define('_CO_WGREALESTATE_THEREARENT_COSTS', 'Es gibt derzeit keine Kosten');
define('_CO_WGREALESTATE_THEREARENT_IMAGES', 'Es gibt derzeit keine Bilder');
define('_CO_WGREALESTATE_THEREARENT_FILES', 'Es gibt derzeit keine Dateien');
define('_CO_WGREALESTATE_THEREARENT_SELLERS', 'Es gibt derzeit keine Verkäufer');