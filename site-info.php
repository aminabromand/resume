<?php
/**
 * Created by PhpStorm.
 * User: amina
 * Date: 29.04.2018
 * Time: 10:16
 */

$siteinfo = "";

$siteinfo_top = file_get_contents("site-info-top.html");


$siteinfo_mid = file_get_contents("site-info-mid.html");

$siteinfo_bottom = file_get_contents("site-info-bottom.html");

if ($loggedin) {
    $siteinfo = $siteinfo_top . $siteinfo_mid . $siteinfo_bottom;
}
else {
    $siteinfo = $siteinfo_top . $siteinfo_bottom;
}