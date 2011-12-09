<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
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
					appId: 'localhost',
					cdnHost: 'https://localhost/embed/',
					host: 'https://localhost/embed/',
					apiHost: 'https://localhost/',
					endPoint: 'auth.php',
				};
				/*(function() {
					var arkS = document.createElement('script');
					arkS.type = 'text/javascript';
					arkS.src = 'https://localhost/embed/arkli.js';
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(arkS, s);
				})();*/
			</script>

			<script src='https://localhost/embed/arkli.js' type='text/javascript'></script>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
			<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>

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
