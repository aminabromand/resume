<?php
/**
 * Created by PhpStorm.
 * User: amina
 * Date: 29.04.2018
 * Time: 10:16
 */

$sitemenu = "";

if ($loggedin) {
    $sitemenu = file_get_contents("site-menu-login.html");
}
else {
    $sitemenu = "";
}