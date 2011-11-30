<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
header('Content-Type: text/plain');
session_start();

function curPageURL()
{
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on")
    {
        $pageURL .= "s";
    }
    
    $pageURL .= "://";
    
    if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
    {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
    }
    else
    {
        $pageURL .= $_SERVER["SERVER_NAME"];
    }
    
    $pageURL .= dirname($_SERVER["REQUEST_URI"]);
    
    return $pageURL;
}

if (!isset($_SESSION['user']))
{
    header("HTTP/1.0 401 Unauthorized");
    print curPageURL() . '/index.php';
    return;
}

require_once('./ArkliAuth.php');

//print ArkliAuth::create_signature_url('APP_KEY', 'APP_SECRET', 'username', 'email address');
print ArkliAuth::create_signature_url('fd949f6b1c2610cacb1751eb03793f93', 'e988173dcaedec9f4749850a0872ae04ec8f1add', $_SESSION['user'], 'mike@arkli.com');
