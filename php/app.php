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
					appId: 'arklidemo',
					endPoint: 'auth.php'
				};
			</script>

			<script src='//d383k976x0uv95.cloudfront.net/latest/arkli.js' type='text/javascript'></script>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
			<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>

			<div id="tabs">
				<ul>
					<li><a href="#tabs-1">Facebook</a></li>
					<li><a href="#tabs-2">Twitter</a></li>
					<li><a href="#tabs-3">LinkedIn</a></li>
				</ul>
				<div id="tabs-1"></div>
				<div id="tabs-2"></div>
				<div id="tabs-3"></div>
			</div>

			<script type='text/javascript'>
				$(function() {
					$( "#tabs" ).tabs();
				});

				addin.social(function (AS) {
					AS('#tabs-1').editBox({type:'facebook'});
					AS('#tabs-2').editBox({type:'twitter'});
					AS('#tabs-3').editBox({type:'linkedin'});
				});
			</script>
		</div>
    </body>
</html>
