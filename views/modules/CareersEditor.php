<?php
define("URLROOT","../../");
require(URLROOT . "include/main.inc.php");
require_once(URLROOT . "models/Model.php");
require_once(URLROOT . "models/ModelCareers.php");

if( isset( $_GET[ 'id' ] ) )
{
    $_GET[ 'id' ] +=0;
        
    $model = new ModelCareers();
    $arrCarrers = $model->find( $_GET[ 'id' ] );
    
    if( $arrCarrers )
    {
        foreach( $arrCarrers as  $key => $value )
            $arrData[ strtolower( $key) ] = $value; 
    }else
        die( "No se pudo encontrar la carrera" );
        
    $btnSubmit['name'] = "modificar";
    $btnSubmit['value'] = "modificar";
    $btnSubmit['title'] = "modificar empresa";
}
else
{
    $arrData[ 'nombre' ] = "";
    $arrData[ 'descripcion' ] ="";
    
    $btnSubmit['name'] = "agregar";
    $btnSubmit['value'] = "agregar";
    $btnSubmit['title'] = "Agregar Carrera";
}
include ("../jstagsforajax.html");

?>

<p class="breadscrumbs">
    <a href="controlPanel.php">Panel de control</a> -
    <a href="views/modules/CareersList.php" class="ajaxredirect">Gestion de Carreras</a> - 
    <strong>Registro de Carreras</strong>
</p>
<h3>Registro de empresas</h3>
<p>Breve instrucci&oacute;n para agregar una Carrera al sistema</p>
<form action="ajax.careerEditor.php" name="frmCareerEditor" id="frmCareerEditor" method="post">
    <?=(isset($arrData['id'])) ? "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$arrData['id']}\"/>" : "";?>
    <h4>Nombre</h4>
    <div>
        <input type="text" name="nombre" id="nombre" value="<?=$arrData['nombre'];?>"/>        
    </div>
    <h4>Descripci&oacute;n</h4>
    <div>
        <textarea cols="60" rows="20" name="descripcion" id="descripcion"><?=$arrData['descripcion'];?></textarea>
    </div>  
    <br/>
    <div>
        <input type="submit" name="<?=$btnSubmit['name']?>" id="<?=$btnSubmit['name']?>" title="<?=$btnSubmit['title']?>" value="<?=$btnSubmit['value']?>"/>
    </div>
    <br> <span class="ajaxloader"></span>
</form>
