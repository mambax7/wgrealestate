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
 * @version        $Id: 1.0 install.php 1 Sun 2018-01-07 21:18:24Z XOOPS Project (www.xoops.org) $
 */
// Copy base file
$indexFile = XOOPS_UPLOAD_PATH.'/index.html';
$blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
// Making of uploads/wgrealestate folder
$wgrealestate = XOOPS_UPLOAD_PATH.'/wgrealestate';
if(!is_dir($wgrealestate)) {
	mkdir($wgrealestate, 0777);
	chmod($wgrealestate, 0777);
}
copy($indexFile, $wgrealestate.'/index.html');
// Making of images folder
$images = $wgrealestate.'/images';
if(!is_dir($images)) {
	mkdir($images, 0777);
	chmod($images, 0777);
}
copy($indexFile, $images.'/index.html');
copy($blankFile, $images.'/blank.gif');
// Making of images/objects folder
$objects = $images.'/objects';
if(!is_dir($objects)) {
	mkdir($objects, 0777);
	chmod($objects, 0777);
}
copy($indexFile, $objects.'/index.html');
copy($blankFile, $objects.'/blank.gif');
// Making of files uploads folder
$files = $wgrealestate.'/files';
if(!is_dir($files)) {
	mkdir($files, 0777);
	chmod($files, 0777);
}
copy($indexFile, $files.'/index.html');
// Making of files/objects folder
$objects = $files.'/objects';
if(!is_dir($objects)) {
	mkdir($objects, 0777);
	chmod($objects, 0777);
}
copy($indexFile, $objects.'/index.html');
// Making of sellers folder
$sellers = $wgrealestate.'/sellers';
if(!is_dir($sellers)) {
	mkdir($sellers, 0777);
	chmod($sellers, 0777);
}
copy($indexFile, $sellers.'/index.html');
// ------------------- Install Footer ------------------- //
