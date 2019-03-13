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
 * @version        $Id: 1.0 search.inc.php 1 Sun 2018-01-07 21:18:25Z XOOPS Project (www.xoops.org) $
 */


/**
 * search callback functions
 * @param $queryarray
 * @param $andor
 * @param $limit
 * @param $offset
 * @param $userid
 */
function wgrealestate_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;
    $sql = "SELECT 'seller_id', 'seller_name' FROM " . $xoopsDB->prefix('wgrealestate_sellers') . ' WHERE seller_id != 0';
    if ( $userid != 0 ) {
        $sql .= ' AND seller_submitter='.(int) ($userid);
    }
    if ( is_array($queryarray) && $count = count($queryarray) )
    {
        $sql .= ' AND (';
        for($i = 1; $i < $count; ++$i)
        {
            $sql .= " $andor ";
            $sql .= '';
        }
        $sql .= ')';
    }
    $sql .= " ORDER BY 'seller_id' DESC";
    $result = $xoopsDB->query($sql,$limit,$offset);
    $ret = array();
    $i = 0;
    while($myrow = $xoopsDB->fetchArray($result))
    {
        $ret[$i]['image'] = 'assets/icons/32/blank.gif';
        $ret[$i]['link'] = 'sellers.php?seller_id='.$myrow['seller_id'];
        $ret[$i]['title'] = $myrow['seller_name'];
        ++$i;
    }
    unset($i);
}