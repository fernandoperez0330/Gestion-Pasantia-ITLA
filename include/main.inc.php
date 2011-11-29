<?php
session_start();
if (!defined("URLROOT")) define("URLROOT", "");
require_once(URLROOT . "config/Config.php");
require_once(URLROOT . "config/Conexion.php");
require_once(URLROOT . "utils/Utils.php");
require_once(URLROOT . "config/ValidateUser.php");
$_SESSION[Config::$arrKeySession['user']] = isset($_SESSION[Config::$arrKeySession['user']]) ? $_SESSION[Config::$arrKeySession['user']] : array();
?>
