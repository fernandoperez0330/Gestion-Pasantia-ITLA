<?php
require_once("include/main.inc.php");
if (isset($_SESSION[Config::$arrKeySession['user']])) unset($_SESSION[Config::$arrKeySession['user']]);
header('location: ./');
?>
