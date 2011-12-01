 <?php
require("include/main.inc.php");
require("models/Model.php");
require("models/ModelEmployees.php");
require("utils/AjaxHandler.php");

$handler = new AjaxHandler();
$model = new ModelEmployees(); 
//para actualizar una empresa existente
if (isset($_POST['id'])) {
    if ($model->update($_POST)){
        $handler->setAt('return', true);
    }
//para agregar una empresa nueva    
}else {
    if ($model->add($_POST)) {
        $handler->setAt('return', true);
    }
}
//header('Content-type: application/json');
echo $handler->toJSON();
?>
  