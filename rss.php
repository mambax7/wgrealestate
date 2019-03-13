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
 * @version        $Id: 1.0 rss.php 1 Sun 2018-01-07 21:18:25Z XOOPS Project (www.xoops.org) $
 */

$cid = wgrealestate_CleanVars($_GET, 'cid', 0);
include_once XOOPS_ROOT_PATH.'/class/template.php';
if (function_exists('mb_http_output')) {
    mb_http_output('pass');
}
//header ('Content-Type:text/xml; charset=UTF-8');
$wgrealestate->geConfig('utf8') = false;

$tpl = new XoopsTpl();
$tpl->xoops_setCaching(2); //1 = Cache global, 2 = Cache individual (for template)
$tpl->xoops_setCacheTime($wgrealestate->geConfig('timecacherss')*60); // Time of the cache on seconds
$categories = wgrealestateMyGetItemIds('wgrealestate_view', 'wgrealestate');
$criteria = new CriteriaCompo();

$criteria->add(new Criteria('cat_status', 0, '!='));
$criteria->add(new Criteria('cid', '(' . implode(',', $categories) . ')','IN'));
if ($cid != 0){
    $criteria->add(new Criteria('cid', $cid));
    $sellers = $sellersHandler->get($cid);
    $title = $xoopsConfig['sitename'] . ' - ' . $xoopsModule->getVar('name') . ' - ' . $sellers->getVar('seller_submitter');
} else {
    $title = $xoopsConfig['sitename'] . ' - ' . $xoopsModule->getVar('name');
}
$criteria->setLimit($wgrealestate->geConfig('perpagerss'));
$criteria->setSort('date');
$criteria->setOrder('DESC');
$sellersArr = $sellersHandler->getAll($criteria);
unset($criteria);

if (!$tpl->is_cached('db:wgrealestate_rss.tpl', $cid)) {
    $tpl->assign('channel_title', htmlspecialchars($title, ENT_QUOTES));
    $tpl->assign('channel_link', XOOPS_URL.'/');
    $tpl->assign('channel_desc', htmlspecialchars($xoopsConfig['slogan'], ENT_QUOTES));
    $tpl->assign('channel_lastbuild', formatTimestamp(time(), 'rss'));
    $tpl->assign('channel_webmaster', $xoopsConfig['adminmail']);
    $tpl->assign('channel_editor', $xoopsConfig['adminmail']);
    $tpl->assign('channel_category', 'Event');
    $tpl->assign('channel_generator', 'XOOPS - ' . htmlspecialchars($xoopsModule->getVar('seller_submitter'), ENT_QUOTES));
    $tpl->assign('channel_language', _LANGCODE);
    if ( _LANGCODE == 'fr' ) {
        $tpl->assign('docs', 'http://www.scriptol.fr/rss/RSS-2.0.html');
    } else {
        $tpl->assign('docs', 'http://cyber.law.harvard.edu/rss/rss.html');
    }
    $tpl->assign('image_url', XOOPS_URL . $xoopsModuleConfig['logorss']);
    $dimention = getimagesize(XOOPS_ROOT_PATH . $xoopsModuleConfig['logorss']);
    if (empty($dimention[0])) {
        $width = 88;
    } else {
       $width = ($dimention[0] > 144) ? 144 : $dimention[0];
    }
    if (empty($dimention[1])) {
        $height = 31;
    } else {
        $height = ($dimention[1] > 400) ? 400 : $dimention[1];
    }
    $tpl->assign('image_width', $width);
    $tpl->assign('image_height', $height);
    foreach (array_keys($sellersArr) as $i) {
        $description = $sellersArr[$i]->getVar('description');
        //permet d'afficher uniquement la description courte
        if (strpos($description,'[pagebreak]')==false){
            $description_short = $description;
        } else {
            $description_short = substr($description,0,strpos($description,'[pagebreak]'));
        }
        $tpl->append('items', array('title' => htmlspecialchars($sellersArr[$i]->getVar('seller_submitter'), ENT_QUOTES),
                                    'link' => XOOPS_URL . '/modules/wgrealestate/single.php?cid=' . $sellersArr[$i]->getVar('cid') . '&amp;seller_id=' . $sellersArr[$i]->getVar('seller_id'),
                                    'guid' => XOOPS_URL . '/modules/wgrealestate/single.php?cid=' . $sellersArr[$i]->getVar('cid') . '&amp;seller_id=' . $sellersArr[$i]->getVar('seller_id'),
                                    'pubdate' => formatTimestamp($sellersArr[$i]->getVar('date'), 'rss'),
                                    'description' => htmlspecialchars($description_short, ENT_QUOTES)));
    }
}
header('Content-Type:text/xml; charset=' . _CHARSET);
$tpl->display('db:wgrealestate_rss.tpl', $cid);