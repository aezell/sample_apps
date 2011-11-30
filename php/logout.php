<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/*
 * A sample logout page.  In reality you will use your existing logout page. 
 */

session_start();
unset($_SESSION['user']);
header('Location: index.php');
?>
