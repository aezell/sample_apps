<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Provide authentication signatures for AddIn Social javascript widgets
 *
 * This file provides authentication credentials to javascript widgets embedded
 * on your page.  This file is requested by the javascript library roughly every
 * five minutes to refresh the active session.
 *
 * The AddIn widgets take the response from this file and append it to any
 * requests made to the AddIn Social api.  After receiving a request, AddIn
 * Social checks the signature returned from this file and authenticates the
 * request.
 *
 * Right now the APP_KEY and APP_SECRET are set to the demo application, which
 * is heavily rate limited.  If you'd like to actually use this file on your own
 * server, register an application on https://addinsocial.com and replace the
 * key and secret with your own values.
 *
 * @package AddInSocial-Demo
 * @author Sam Wilson <sam@arkli.com>
 */

/******************************************************************************
 * Constants                                                                  *
 ******************************************************************************/

/**
 * The unique identifier assigned to your application by AddIn Social.
 */
define("APP_KEY",       "YOUR_APP_KEY");

/**
 * The unique secret used to sign requests on behalf of your application.  Keep
 * this value secret, and never, ever, ever give it to anyone.  APP_SECRET is
 * assigned by AddIn Social.
 */
define("APP_SECRET",    "YOUR_APP_SECRET");

/**
 * The url the javascript application should redirect the user to in case they
 * get logged out from your website while still using AddIn Social widgets.  You
 * define this value to match your current login system.
 */
define("LOGIN_URL",     "index.php");

/******************************************************************************
 * Includes                                                                   *
 ******************************************************************************/

/**
 * Import the AddIn Social authentication library
 */
require_once(dirname(__FILE__) . "/ArkliAuth.php");



/******************************************************************************
 * Response                                                                   *
 ******************************************************************************/

/**
 * Initialize the PHP session system.  The demo login system uses PHP sessions
 * to validate users, but you can use any system you like.
 */
session_start();

/**
 * The data returned by this file MUST be plain text.
 */
header('Content-Type: text/plain');

/**
 * Make sure that a user is authenticated by checking the session variable.
 *
 * When integrating this file into your application, replace this check with
 * whatever authorization system you are using.  The end result should be that
 * if there is no authenticated user, the response content is set to the login
 * url and the status code is set to 401 Unauthorized.
 */
if (!isset($_SESSION['user']))
{
    header("HTTP/1.0 401 Unauthorized");
    print LOGIN_URL;
    return;
}

/**
 * Get the username of your user from whatever authentication system your
 * application uses.
 */
$username = $_SESSION["user"];

/**
 * If available, get the username of the currently authenticated user and
 * include it in the signature.
 */
$email = "sample@example.com";

/**
 * Write out the signature generated for the user and email address provided
 */
print ArkliAuth::create_signature_url(APP_KEY, APP_SECRET, $username, $email);
