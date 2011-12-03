<?php
define("URLROOT","../../");
require(URLROOT . "include/main.inc.php");
require_once(URLROOT . "models/Model.php");
require_once(URLROOT . "models/ModelEmployees.php");

if( isset( $_GET[ 'id' ] ) )
{
    $_GET[ 'id' ] +=0;
        
    $model = new ModelEmployees();
    $arrCarrers = $model->find( $_GET[ 'id' ] );
    
    if( $arrCarrers )
    {
        foreach( $arrCarrers as  $key => $value )
            $arrData[ strtolower( $key) ] = $value; 
    }else
        die( "No se pudo encontrar el empleado" );
        
    $btnSubmit['name'] = "modificar";
    $btnSubmit['value'] = "modificar";
    $btnSubmit['title'] = "modificar Empleado";
}
else
{
    $arrData[ 'nombre' ] = "";
    $arrData[ 'apellido' ] ="";
    $arrData[ 'correo' ] ="";
    $arrData[ 'telefono' ] ="";
    
    
    $btnSubmit['name'] = "agregar";
    $btnSubmit['value'] = "agregar";
    $btnSubmit['title'] = "Agregar Empleado";
}
include ("../jstagsforajax.html");
    

?>

<p class="breadscrumbs">
    <a href="controlPanel.php">Panel de control</a> -
    <a href="views/modules/EMployeesList.php" class="ajaxredirect">Gestion de Empleados</a> - 
    <strong>Registro de Empleados</strong>
</p>
<h3>Registro de empleados</h3>
<p>Breve instrucci&oacute;n para agregar un Empleado al sistema</p>
<form action="ajax.employeesEditor.php" name="frmEmployeesEditor" id="frmEmployeesEditor" method="post">
    <?=(isset($arrData['id'])) ? "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$arrData['id']}\"/>" : "";?>
    <h4>Nombre</h4>
    <div>
        <input type="text" name="nombre" id="nombre" value="<?=$arrData['nombre'];?>"/>        
    </div>
    <h4>Apellido</h4>
    <div>
        <input type="text" name="apellido" id="apellido" value="<?=$arrData['apellido'];?>"/>        
    </div>
        <h4>Correo</h4>
    <div>
        <input type="text" name="correo" id="correo" value="<?=$arrData['correo'];?>"/>        
    </div>
    </div>
        <h4>Password</h4>
    <div>
        <input type="password" name="password" id="password" value=""/>        
    </div>    
        <h4>Telefono</h4>
    <div>
        <input type="text" name="telefono" id="telefono" value="<?=$arrData['telefono'];?>"/>        
    </div>
    <br/>
    <div>
        <input type="submit" name="<?=$btnSubmit['name']?>" id="<?=$btnSubmit['name']?>" title="<?=$btnSubmit['title']?>" value="<?=$btnSubmit['value']?>"/>
    </div>
    <br> <span class="ajaxloader"></span>
</form>
