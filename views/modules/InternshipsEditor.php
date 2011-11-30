<?php
define("URLROOT", "../../");
require(URLROOT . "include/main.inc.php");
require(URLROOT . "models/Model.php");
require(URLROOT . "models/ModelInternship.php");
require(URLROOT . "models/ModelCareers.php");
require(URLROOT . "models/ModelCompanies.php");

if (isset($_GET['id'])) {
    $_GET['id'] +=0;

    $model = new ModelInternship();
    $arrInternships = $model->find($_GET['id']);
    if ($arrInternships) {
        foreach ($arrInternships as $key => $value)
            $arrData[strtolower($key)] = $value;
    }else
        die("No se pudo encontrar la pasantia");

    $btnSubmit['name'] = "modificar";
    $btnSubmit['value'] = "modificar";
    $btnSubmit['title'] = "modificar empresa";
}
else {
    $arrData['nombre'] = "";
    $arrData['empresa_id'] = "";

    $btnSubmit['name'] = "agregar";
    $btnSubmit['value'] = "agregar";
    $btnSubmit['title'] = "Agregar Carrera";
}
//buscar las empresas para poder listarlo en el select
$modelCompany = new ModelCompanies();
//buscar todas las empresas
$arrCompanies = $modelCompany->findsome(array());
//buscar todas las carreras
$modelCarrer = new ModelCareers();
$arrCarrers = $modelCarrer->findsome(array());

include ("../jstagsforajax.html");
?>

<p class="breadscrumbs">
    <a href="controlPanel.php">Panel de control</a> -
    <a href="views/modules/InternshipsLists.php" class="ajaxredirect">Gestion de Pasantias</a> - 
    <strong>Registro de Pasantias</strong>
</p>
<h3>Registro de pasantias</h3>
<p>Breve instrucci&oacute;n para agregar una pasantia al sistema</p>
<form action="ajax.internshipEditor.php" name="frmInternshipEditor" id="frmInternshipEditor" method="post">
    <?=(isset($arrData['id'])) ? "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$arrData['id']}\"/>\n" : ""; ?>
    <h4>Nombre</h4>
    <div>
        <input type="text" name="nombre" id="nombre" value="<?= $arrData['nombre']; ?>"/>        
    </div>
    <h4>Empresa</h4>
    <div>
        <select name="empresa_id" id="empresa_id">
            <option value="0" selected="selected">Seleccione</option>
            <?php
            foreach ($arrCompanies as $company) {
                $sel = $arrData['empresa_id'] == $company['ID'] ? "selected=\"selected\"" : "";
                echo "<option value=\"{$company['ID']}\" $sel>{$company['NOMBRE']}</option>";
            }
            ?>
        </select>
    </div> 
    <h4>Carreras</h4>
    <div>
        <select name="carreras" id="carreras" size="5" class="selectwithsize" multiple>
            <?php
            foreach ($arrCarrers as $career) {
                $sel = $arrData['empresa_id'] == $career['ID'] ? "selected=\"selected\"" : "";
                echo "<option value=\"{$career['ID']}\" $sel>{$career['NOMBRE']}</option>";
            }
            ?>
        </select>
        <br/>
        <span>Presione CTRL + click para seleccionar multiples carreras que apliquen para esta pasantia</span>
    </div>  
    
    <br/>
    <div>
        <input type="submit" name="<?= $btnSubmit['name'] ?>" id="<?= $btnSubmit['name'] ?>" title="<?= $btnSubmit['title'] ?>" value="<?= $btnSubmit['value'] ?>"/>
    </div>
    <br> <span class="ajaxloader"></span>
</form>
