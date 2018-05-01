<?php
/**
 * Created by PhpStorm.
 * User: amina
 * Date: 29.04.2018
 * Time: 10:16
 */

$sitecontent = "";

if ($loggedin) {
    $sitecontent = file_get_contents("site-content-login.html");
}
else {
    $sitecontent = file_get_contents("site-content-login-no.html");
}