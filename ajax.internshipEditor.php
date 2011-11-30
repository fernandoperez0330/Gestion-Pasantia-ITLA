<?php
require("include/main.inc.php");
require("models/Model.php");
require("models/ModelInternship.php");
require("utils/AjaxHandler.php");
$handler = new AjaxHandler();
$model = new ModelInternship(); 
$_POST['carreras'] = explode(",",$_POST['carreras']);
//para actualizar una pasantia existente
if (isset($_POST['id'])) {
    if ($model->update($_POST)){
        $handler->setAt('return', true);
    }
//para agregar una pasantia nueva    
}else {
    if ($model->add($_POST)) {
        $handler->setAt('return', true);
    }
}
header('Content-type: application/json');
echo $handler->toJSON();
?>
  