<?php
define("URLROOT", "../../");
require(URLROOT . "include/main.inc.php");
require(URLROOT . "models/Model.php");
require(URLROOT . "models/ModelInternship.php");
require(URLROOT . "models/ModelStudents.php");
require(URLROOT . "models/ModelRequests.php");

//crear instancia del modelo de pasantias para poder listarlo en el select
$modelInternship = new ModelInternship();
//crear instancia del modelo de estudiantes para poder listarlos en el select
$modelStudent = new ModelStudents();
//crear instancia del modelo de lasa solicitudes para poder ver que estudiantes no tienen solicitud
$modelRequest = new ModelRequests();

//buscar todas las empresas
$arrInternships = $modelInternship->findsome(array());
//buscar todos los estudiantes
$arrAllStudents = $modelStudent->findsome(array());
//buscar todos las solicitudes
$arrRequests = $modelRequest->findsome(array());

$arrStudents = $arrAllStudents;

if (isset($_GET['id'])) {
    $_GET['id'] +=0;

    $model = new ModelRequests();
    $arrRequests = $model->find($_GET['id']);
    if ($arrRequests) {
        foreach ($arrRequests as $key => $value)
            $arrData[strtolower($key)] = $value;
    }else
        die("No se pudo encontrar la pasantia");
    $btnSubmit['name'] = "modificar";
    $btnSubmit['value'] = "modificar";
    $btnSubmit['title'] = "modificar empresa";
}
else {
    $arrData['nombre'] = "";
    $arrData['estudiante_id'] = "";
    $arrData['pasantia_id'] = "";
    $arrData['estatus'] = "";

    $btnSubmit['name'] = "agregar";
    $btnSubmit['value'] = "agregar";
    $btnSubmit['title'] = "Agregar Carrera";

    //verificar los estudiantes que no esten en solicitudess pendientes
    foreach ($arrAllStudents as $student) {
        if ($arrRequests) {
            $arrStudents = array();
            foreach ($arrRequests as $request) {
                if ($student['ID'] != $request['ESTUDIANTE_ID']) {
                    $arrStudents[] = $student;
                }
            }
        }
    }
}

//verificar si hay que deshabilitar el combo de estudiantes en caso de actualziacion
$disFieldStudents = isset($_GET['id']) ? "disabled=\"disabled\"" : "";
include ("../jstagsforajax.html");
?>

<p class="breadscrumbs">
    <a href="controlPanel.php">Panel de control</a> -
    <a href="views/modules/RequestLists.php" class="ajaxredirect">Solicitudes de Pasantias</a> - 
    <strong>Registro de Pasantias</strong>
</p>
<h3>Registro de pasantias</h3>
<p>Breve instrucci&oacute;n para agregar realizar o actualizar una solicitud de pasantias</p>
<form action="ajax.RequestEditor.php" name="frmRequestEditor" id="frmRequestEditor" method="post">
<?= (isset($arrData['id'])) ? "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$arrData['id']}\"/>\n" : ""; ?>
    <h4>Pasantia</h4>
    <div>
        <select name="pasantia_id" id="pasantia_id">
            <option value="0" selected="selected">Seleccione</option>
            <?php
            foreach ($arrInternships as $internship) {
                $sel = $arrData['pasantia_id'] == $internship['ID'] ? "selected=\"selected\"" : "";
                echo "<option value=\"{$internship['ID']}\" $sel>{$internship['NOMBRE']}</option>";
            }
            ?>
        </select>
    </div> 
    <h4>Estudiante</h4>
    <div>
        <select name="estudiante_id" id="estudiante_id" <?= $disFieldStudents ?>>
            <option value="0" selected="selected">Seleccione</option>
            <?php
            foreach ($arrStudents as $student) {
                $sel = $arrData['estudiante_id'] == $student['ID'] ? "selected=\"selected\"" : "";
                echo "<option value=\"{$student['ID']}\" $sel>{$student['NOMBRE']}</option>";
            }
            ?>
        </select>
    </div> 
    <h4>Estatus</h4>
    <div>
        <select name="estatus" id="estatus">
            <option value="0" selected="selected">Seleccione</option>
            <?php
            foreach (Config::$arrEstatus as $k => $estatus) {
                $sel = $arrData['estatus'] == $k ? "selected=\"selected\"" : "";
                echo "<option value=\"{$k}\" $sel>{$estatus}</option>";
            }
            ?>
        </select>
    </div> 
    <br/>
    <div>
        <input type="submit" name="<?= $btnSubmit['name'] ?>" id="<?= $btnSubmit['name'] ?>" title="<?= $btnSubmit['title'] ?>" value="<?= $btnSubmit['value'] ?>"/>
    </div>
    <br> <span class="ajaxloader"></span>
</form>
