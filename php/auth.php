<?php
/*
 * This file must be added onto your server. It creates a unique signature
 * for your currently logged in user.  
 * 
 * You must: 
 * 1.  Set the APP_KEY and APP_SECRET with your own information.
 * 2.  Define the user's username (likely from a session variable).
 * 3.  Define the user's email address (likely from a session variable).
 * 4.  Define the URL to send users to when they are logged out.
 */

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
header('Content-Type: text/plain');
session_start();

define("APP_KEY", ""); //from https://www.addinsocial.com/
define("APP_SECRET", ""); //from https://www.addinsocial.com/
define("USERNAME", ""); //maybe something like $_SESSION["username"]?
define("EMAIL_ADDRESS", 'sample@demo.com'); //maybe $_SESSION["email_address"]?
define("LOGIN_URL", "index.php"); //the URL to your login screen for this user

if (!isset($_SESSION['user']))
{
    header("HTTP/1.0 401 Unauthorized");
    print LOGIN_URL;
    return;
}

require_once('./ArkliAuth.php');

print ArkliAuth::create_signature_url(APP_KEY, APP_SECRET, USERNAME, EMAIL_ADDRESS); //email address is optional
