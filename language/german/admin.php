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
define('_AM_WGREALESTATE_THEREARE_OBJCATEGORIES', "Es gibt <span class='bold'>%s</span> Objektkategorien in der Datenbank");
define('_AM_WGREALESTATE_THEREARE_ATTDEFAULTS', "Es gibt <span class='bold'>%s</span> Attribute Standard in der Datenbank");
define('_AM_WGREALESTATE_THEREARE_ATTRIBUTES', "Es gibt <span class='bold'>%s</span> Objektattribute in der Datenbank");
define('_AM_WGREALESTATE_THEREARE_ATTCATEGORIES', "Es gibt <span class='bold'>%s</span> Attributkategorien in der Datenbank");
define('_AM_WGREALESTATE_THEREARE_COST_TYPES', "Es gibt <span class='bold'>%s</span> cost_types in der Datenbank");
define('_AM_WGREALESTATE_THEREARE_OBJECTS', "Es gibt <span class='bold'>%s</span> Objekte in der Datenbank");
define('_AM_WGREALESTATE_THEREARE_COSTS', "Es gibt <span class='bold'>%s</span> costs in der Datenbank");
define('_AM_WGREALESTATE_THEREARE_IMAGES', "Es gibt <span class='bold'>%s</span> Bilder in der Datenbank");
define('_AM_WGREALESTATE_THEREARE_FILES', "Es gibt <span class='bold'>%s</span> Dateien in der Datenbank");
define('_AM_WGREALESTATE_THEREARE_SELLERS', "Es gibt <span class='bold'>%s</span> Verkäufer in der Datenbank");
// ---------------- Admin Files ----------------
// Buttons
define('_AM_WGREALESTATE_ADD_OBJCATEGORY', 'Neue Objektkategorie hinzufügen');
define('_AM_WGREALESTATE_ADD_ATTDEFAULTS', 'Neues Standard-Attribut hinzufügen');
define('_AM_WGREALESTATE_ADD_ATTRIBUTES', 'Neues Objektattribut hinzufügen');
define('_AM_WGREALESTATE_ADD_ATTCATEGORY', 'Neue Attributkategorie hinzufügen');
define('_AM_WGREALESTATE_ADD_COST_TYPE', 'Neuen Typ Kosten hinzufügen');
define('_AM_WGREALESTATE_ADD_OBJECT', 'Neues Objekt hinzufügen');
define('_AM_WGREALESTATE_ADD_COST', 'Neue Kosten hinzufügen');
define('_AM_WGREALESTATE_ADD_IMAGE', 'Neues Bild hinzufügen');
define('_AM_WGREALESTATE_ADD_FILE', 'Neue Datei hinzufügen');
define('_AM_WGREALESTATE_ADD_SELLER', 'Neuen Verkäufer hinzufügen');
// Lists
define('_AM_WGREALESTATE_OBJCAT_CATEGORIES_LIST', 'Liste der Objektkategorien');
define('_AM_WGREALESTATE_ATTDEFAULTS_LIST', 'Liste der Standard-Attribute');
define('_AM_WGREALESTATE_ATTRIBUTES_LIST', 'Liste der Objektattribute');
// define('_CO_WGREALESTATE_COND_TYPES_LIST', 'Liste der Zustandsarten');
define('_CO_WGREALESTATE_ATTCATEGORIES_LIST', 'Liste der Attributkategorien');
define('_AM_WGREALESTATE_COST_TYPES_LIST', 'Liste der Kostenarten');
define('_CO_WGREALESTATE_OBJECTS_LIST', 'Liste der Objekte');
define('_AM_WGREALESTATE_COSTS_LIST', 'Liste der Kosten');
define('_AM_WGREALESTATE_IMAGES_LIST', 'Liste der Bilder');
define('_AM_WGREALESTATE_FILES_LIST', 'Liste der Dateien');
define('_AM_WGREALESTATE_SELLERS_LIST', 'Liste der Verkäufer');
define('_AM_WGREALESTATE_MAINTAINANCE_LIST', 'Liste der Wartungen');
// ---------------- Admin Classes ----------------
// Elements of deal types
define('_AM_WGREALESTATE_DEALTYPES', 'Vermittlungstypen');
define('_AM_WGREALESTATE_DEALTYPE_TYPE', 'Vermittlungstyp');
// Objektkategorie add/edit
define('_AM_WGREALESTATE_OBJCAT_CATEGORY_ADD', 'Hinzufügen Objektkategorie');
define('_AM_WGREALESTATE_OBJCAT_CATEGORY_EDIT', 'Bearbeiten Objektkategorie');
// Elements of object categories
define('_AM_WGREALESTATE_OBJCAT_CATEGORIES', 'Objektkategorien');
define('_AM_WGREALESTATE_OBJCAT_CATEGORY_NAME', 'Name Objektkategorie');
// Add_attribute add/edit
define('_AM_WGREALESTATE_ATTDEFAULTS_ADD', 'Hinzufügen Standard-Attribut');
define('_AM_WGREALESTATE_ATTDEFAULTS_EDIT', 'Bearbeiten Standard-Attribut');
// Elements of Add_attdefault
define('_AM_WGREALESTATE_ATTDEFAULT', 'Standard-Attribut');
define('_AM_WGREALESTATE_ATTDEFAULTS', 'Standard-Attribute');
define('_AM_WGREALESTATE_ATTDEFAULTS_PARENT', 'Parent');
define('_AM_WGREALESTATE_ATTDEFAULTS_NAME', 'Name');
define('_AM_WGREALESTATE_ATTDEFAULTS_TYPE', 'Typ Attribut');
// Elements of additional attdefaults
define('_AM_WGREALESTATE_ATTRIBUTE', 'Objektattribut');
define('_AM_WGREALESTATE_ATTRIBUTES', 'Objektattribute');
define('_AM_WGREALESTATE_ATTRIBUTES_INFO', 'Info');
define('_AM_WGREALESTATE_ATTRIBUTES_VALUE', 'Value');
// Elements of heating types
define('_AM_WGREALESTATE_HEATING_TYPE_TEXT', 'Typ');
// Energiesystemart add/edit
define('_AM_WGREALESTATE_ATTCATEGORY_ADD', 'Hinzufügen Attributkategorie');
define('_AM_WGREALESTATE_ATTCATEGORY_EDIT', 'Bearbeiten Attributkategorie');
// Elements of energy types
define('_AM_WGREALESTATE_ATTCATEGORY_NAME', 'Name Attributkategorie');
define('_AM_WGREALESTATE_ATTCATEGORY_NAME_SHOW', 'Name auf Benutzerseite anzeigen');
// Kostenart add/edit
define('_AM_WGREALESTATE_COST_TYPE_ADD', 'Hinzufügen Kostenart');
define('_AM_WGREALESTATE_COST_TYPE_EDIT', 'Bearbeiten Kostenart');
// Elements of cost types
define('_AM_WGREALESTATE_COST_TYPES', 'Kostenarten');
define('_AM_WGREALESTATE_COST_TYPE_TEXT', 'Typ');
define('_AM_WGREALESTATE_COST_TYPE_PERC', 'Prozentsatz');
define('_AM_WGREALESTATE_COST_TYPE_FIXED', 'Fester Bestandteil');
// Elements of Image
define('_AM_WGREALESTATE_IMAGE', 'Bild');
define('_AM_WGREALESTATE_IMAGE_DIM', 'Abmessungen');
define('_AM_WGREALESTATE_IMAGE_SIZE', 'Größe');
// Verkäufer add/edit
define('_AM_WGREALESTATE_SELLER_ADD', 'Hinzufügen Verkäufer');
define('_AM_WGREALESTATE_SELLER_EDIT', 'Bearbeiten Verkäufer');
// Elements of seller
define('_AM_WGREALESTATE_SELLER_NAME', 'Name');
define('_AM_WGREALESTATE_SELLER_CTRY', 'Land');
define('_AM_WGREALESTATE_SELLER_POSTAL_CODE', 'PLZ');
define('_AM_WGREALESTATE_SELLER_CITY', 'Ort');
define('_AM_WGREALESTATE_SELLER_ADDRESS', 'Adresse');
define('_AM_WGREALESTATE_SELLER_PHONE', 'Telefon');
define('_AM_WGREALESTATE_SELLER_MAIL', 'E-Mail');
define('_AM_WGREALESTATE_SELLER_CAT', 'Kategorie');
define('_AM_WGREALESTATE_SELLER_PUBLIC', 'Öffentlich');
// Elements of maintainance
define('_AM_WGREALESTATE_MAINTAINANCE', 'Wartung');
define('_AM_WGREALESTATE_MAINTAIN_EXEC', 'Ausführen');
define('_AM_WGREALESTATE_MAINTAIN_RESULT', 'Ergebnis der Wartung');
define('_AM_WGREALESTATE_MAINTAIN_CHECK_FOLDER_OBJ', 'Dateistruktur Upload-Verzeichnis überprüfen');
define('_AM_WGREALESTATE_MAINTAIN_CHECK_FOLDER_OBJ_RES', 'Dateistruktur Upload-Verzeichnis überprüft. Anzahl der reparierten Ordner:');
define('_AM_WGREALESTATE_MAINTAIN_RESIZE_THUMBS', 'Vorschaubilder an Thumbgröße anpassen');
define('_AM_WGREALESTATE_MAINTAIN_RESIZE_THUMBS_RES', 'Vorschaubilder an Thumbgröße angepasst. Anzahl der angepassten Vorschaubilder:');
define('_AM_WGREALESTATE_MAINTAIN_OBJIDS', 'Tabellen auf ungültige Objekt-IDs überprüfen');
define('_AM_WGREALESTATE_MAINTAIN_OBJIDS_RES', 'Tabellen auf ungültige Objekt-IDs überprüft. Anzahl der Korrekturen:');

// ---------------- Admin Others ----------------
define('_AM_WGREALESTATE_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------