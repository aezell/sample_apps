<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
/**
 * Display the javascript application
 *
 * This file writes the HTML and javascript necessary to display AddIn Social
 * widgets.  This file requires that auth.php exists, is executable, and is
 * reachable from the web.
 *
 * @package AddInSocial-Demo
 * @author Sam Wilson <sam@arkli.com>
 */

/**
 * Initialize PHP's sessions to access the currently logged in user.  If there
 * is no logged in user, we redirect to the login url.
 */
session_start();
if (!isset($_SESSION['user']))
{
    header('Location: index.php');
    return;
}
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Application Page</title>
    </head>
    <body>
        <h1>AddIn Social Page</h1>
		<div style="float:left; width:600px;">
			<a href="logout.php">Logout</a>
			<p>
				This demo shows the AddIn Social platform embedded on a
				sample website.
			</p>
			<script type="text/javascript">
				// The application id for your application
				var gArkliConfig = {
					authEndPoint: 'auth.php',							// The url (relative to this page) to request authentication tokens from
					campaignName: 'bob',								// The name of the campaign to associate publications with
					vendorCampaignId: 'aoeu'							// Your unique identifier for this campaign
				};
			</script>

			<script src='//dgnhwo58nu60t.cloudfront.net/latest/addin.min.js' type='text/javascript'></script>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
			<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>

			<div id="tabs">
				<ul>
					<li><a href="#tabs-0">Accounts</a></li>
					<li><a href="#tabs-1">Facebook</a></li>
					<li><a href="#tabs-2">Twitter</a></li>
					<li><a href="#tabs-3">LinkedIn</a></li>
					<li><a href="#tabs-4">Publications</a></li>
					<li><a href="#tabs-5">Comments</a></li>
				</ul>
				<div id="tabs-0"><div class="add"></div><div class="edit"></div></div>
				<div id="tabs-1"></div>
				<div id="tabs-2"></div>
				<div id="tabs-3"></div>
				<div id="tabs-4"></div>
				<div id="tabs-5"></div>
			</div>

			<script type='text/javascript'>
				// Build the tabs
				$(function() {
					$( "#tabs" ).tabs();
				});

				// Register a callback to be executed when the AddIn library is
				// ready
				addin.social(function (AS) {
					// Select some elements and attach widgets to them
					AS('#tabs-0 .add').accountsLink({});
					AS('#tabs-0 .edit').accountsManage({});
					AS('#tabs-1').editor({type:'facebook'});
					AS('#tabs-2').editor({type:'twitter'});
					AS('#tabs-3').editor({type:'linkedin'});
					AS('#tabs-4').publications({});
					AS('#tabs-5').comments({});
				});
			</script>
		</div>
    </body>
</html>
