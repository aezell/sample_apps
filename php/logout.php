<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
session_start();
unset($_SESSION['user']);
header('Location: index.php');
?>
