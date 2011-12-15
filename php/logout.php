<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Clears the login set by the login page
 *
 * This page represents the logout page of your application.  In a real set up
 * this page would be handled by whatever authentication system your application
 * uses.
 *
 * @package AddInSocial-Demo
 * @author Sam Wilson <sam@arkli.com>
 */

session_start();
unset($_SESSION['user']);
header('Location: index.php');
?>
