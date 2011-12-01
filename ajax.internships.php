<?php
require("include/main.inc.php");
require("models/Model.php");
require("models/ModelInternship.php");
require("models/ModelStudents.php");
require("models/ModelRequests.php");
require("utils/AjaxHandler.php");

$handler = new AjaxHandler();
$model = new ModelRequests(); 
$modelInternship = new ModelInternship();
$modelStudent = new ModelStudents();
//setear el indice msg para mensajes en el resultado de ajax
$handler->setAt('msg', "");
if (!isset($_SESSION[Config::$arrKeySession['user']]['tipo_id'])){
    $handler->setAt('msg', "Debe de iniciar sesion como estudiante para poder solicitar pasantia");
}elseif (isset($_GET['id'])) {
    $arrRequests = array();
    
    $arrInternships = $modelInternship->find($_GET['id']);
    
    $arrRequests['pasantia_id'] = $arrInternships['ID'];
    //determinar el estudiante que va a solicitar la pasantia
    $arrRequests['estudiante_id'] = $_SESSION[Config::$arrKeySession['user']]['tipo_id'];
    //poner el estatus pendiente
    $arrRequests['estatus'] = "P";
    //verificar si el usuario es un estudiante y si existe
    if ($_SESSION[Config::$arrKeySession['user']]['tipo'] != 2 || !$modelStudent->find($arrRequests['estudiante_id'])){
        $handler->setAt ('msg', 'Este usuario no parece ser un estudiante, debes de iniciar sesion como estudiante para solicitar pasantia');
    }
    //verificar si ya tiene una solicitud este estudiante
    elseif ($model->findsome(array("ESTUDIANTE_ID"=>$arrRequests['estudiante_id']))){
       $handler->setAt ('msg', 'Ya tiene una solicitud pendiente o activa');
    } else {
        if ($model->add($arrRequests)){
            $handler->setAt('return', true);
        }  
    }
        
}
//header('Content-type: application/json');
echo $handler->toJSON();
?>