<?php
require("include/main.inc.php");
require("models/Model.php");
require("models/ModelRequests.php");
require("utils/AjaxHandler.php");

$handler = new AjaxHandler();
$model = new ModelRequests(); 
//para actualizar una solicitud de pasantia existente
if (isset($_POST['id'])) {
    if ($model->update($_POST)){
        $handler->setAt('return', true);
    }
//para agregar una solicitud de pasantia nueva    
}else {
    if ($model->add($_POST)) {
        $handler->setAt('return', true);
    }
}
//header('Content-type: application/json');
echo $handler->toJSON();
?>
  