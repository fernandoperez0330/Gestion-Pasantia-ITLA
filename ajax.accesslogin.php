<?php
session_start();
require("config/Config.php");
require("config/Conexion.php");
require("models/Model.php");
require("models/ModelUsers.php");
require("utils/AjaxHandler.php");
$model = new ModelUsers();
$handler = new AjaxHandler();
$return = $model->login($_POST['usuario'],$_POST['clave']);
if ($return){
    $model->setsession();
    $handler->setAt('return', true);
    $handler->setAt('redirect', "controlPanel.php");
}
else $handler->setAt('return', false);

header('Content-type: application/json');
echo $handler->toJSON();
?>
