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
        <div>
            <div style="float:left; width:600px;">
                <a href="logout.php">Logout</a>
                <p>
                    This demo shows the AddIn Social platform embedded on a
                    sample website.
                </p>
                <script type="text/javascript">
                    // The application id for your application
                    var gArkliAppId = 'localhost';
                    var gArkliAuthEndpoint = 'auth.php';
                    var gArkliHost = 'https://localhost/embed/'; //trailing slash required, default: embed.arkli.com
			        var gArkliAPIHost = 'https://localhost/';
			        var gArkliCDNHost = gArkliHost;
                    (function() {
                        var arkS = document.createElement('script');
                        arkS.type = 'text/javascript';
                        arkS.src = 'https://localhost/embed/arkli.js';
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(arkS, s);
                    })();
                </script>
                <div id="arkliapp"></div>
            </div>
    </body>
</html>
