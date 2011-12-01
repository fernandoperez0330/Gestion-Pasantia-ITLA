<?php 
define("URLROOT","../../");
require(URLROOT . "include/main.inc.php");
require(URLROOT . "models/Model.php");
require(URLROOT . "models/ModelCompanies.php");

if (isset($_GET['id'])){    
    $_GET['id'] = $_GET['id'] + 0;
    
    $model = new ModelCompanies();
    $arrCompanies = $model->find($_GET['id']);
    
    if ($arrCompanies){
        foreach($arrCompanies as $k=>$v){
            $arrData[strtolower($k)] = $v;
        }
    }else 
        die("No se encontro la empresa");
    
    $btnSubmit['name'] = "actualizar";
    $btnSubmit['value'] = "Actualizar";
    $btnSubmit['title'] = "Actualizar empresa";
}else{
    $arrData['nombre'] = "";
    $arrData['direccion'] = "";
    $arrData['descripcion'] = "";
    $arrData['telefono1'] = "";
    $arrData['telefono2'] = "";
    $arrData['correo'] = "";
    
    $btnSubmit['name'] = "agregar";
    $btnSubmit['value'] = "Agregar";
    $btnSubmit['title'] = "Agregar empresa";
    
}
include ("../jstagsforajax.html"); 
?>
<p class="breadscrumbs">
    <a href="controlPanel.php">Panel de control</a> -
    <a href="views/modules/CompaniesLists.php" class="ajaxredirect">Gestion de Empresas</a> - 
    <strong>Registro de empresas</strong>
</p>
<h3>Registro de empresas</h3>
<p>Breve instrucci&oacute;n para agregar una empresa al sistema</p>
<form action="ajax.companiesEditor.php" name="frmCompaniesEditor" id="frmCompaniesEditor" method="post">
    <?=(isset($arrData['id'])) ? "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$arrData['id']}\"/>" : "";?>
    <h4>Nombre</h4>
    <div>
        <input type="text" name="nombre" id="nombre" value="<?=$arrData['nombre'];?>"/>        
    </div>
    <h4>Direcci&oacute;n</h4>
    <div>
        <input type="text" name="direccion" id="direccion" value="<?=$arrData['direccion'];?>"/>        
    </div>
    <h4>Descripcion</h4>
    <div>
        <textarea cols="60" rows="20" name="descripcion" id="descripcion"><?=$arrData['descripcion'];?></textarea>
    </div>
    <h4>Telefono 1</h4>
    <div>
        <input type="text" name="telefono1" id="telefono1" value="<?=$arrData['telefono1'];?>"/>        
    </div>
    <h4>Telefono 2</h4>
    <div>
        <input type="text" name="telefono2" id="telefono2" value="<?=$arrData['telefono2'];?>"/>        
    </div>
    <h4>Correo</h4>
    <div>
        <input type="text" name="correo" id="correo" value="<?=$arrData['correo'];?>"/>        
    </div>
    <br/>
    <div>
        <input type="submit" name="<?=$btnSubmit['name']?>" id="<?=$btnSubmit['name']?>" title="<?=$btnSubmit['title']?>" value="<?=$btnSubmit['value']?>"/>
        <span class="ajaxloader">&nbsp;</span>
    </div>
    
</form>