<?php
if( !defined("URLROOT") ) define( "URLROOT","../../" );
require_once( URLROOT.'include/main.inc.php' );
require_once( URLROOT.'models/Model.php' );
require_once( URLROOT.'models/ModelCareers.php' );
require_once( URLROOT.'models/ModelStudents.php' );
require_once( URLROOT.'views/jstags.html');
require_once( URLROOT.'views/jstagsforajax.html' );

$model = new ModelCareers();
$careers = $model->findsome( array() );

if( isset( $_GET[ 'id' ] ) )
{
    $_GET[ 'id' ] +=0;
    $modelStudent = new ModelStudents();
    
    $students = $modelStudent->find( $_GET[ 'id' ] );
    if( $students )
    {
        foreach( $students as $key=>$value )
        $arrData[ strtolower( $key) ] = $value;
    }else
        die( 'No de pudo encontrar el Estudiante' );
    
    $btnSubmit[ 'name' ] ="Modificar";
    $btnSubmit[ 'title' ]="Modificar Usuario";
    $btnSubmit[ 'id' ]="modificar";
}else
{
    
    $arrData[ 'nombre' ]="";
    $arrData[ 'correo' ]="";
    $arrData[ 'telefono' ]="";
    $arrData[ 'telefono2' ]="";
    $arrData[ 'celular' ]="";
    $arrData[ 'carrera_id' ]="0";
    
    $btnSubmit[ 'name' ] ="Agregar";
    $btnSubmit[ 'title' ]="Enviar Solicitud";
    $btnSubmit[ 'id' ]="agregar";
}

?>
<?php
if( !isset($showPanel) )
{
?>
<p class="breadscrumbs">
    <a href="controlPanel.php">Panel de control</a> -
    <a href="views/modules/StudentsList.php" class="ajaxredirect">Gestion de Estudiantes</a> - 
    <strong>Registro de Estudiantes</strong>
</p>
<?php
}
?>
<div id="registerarea">
    <form action="ajax.postStudents.php" name="frmregister" id="frmregister" method="post">
        <?=(isset( $arrData[ 'id' ])) ? "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"{$arrData[ 'id' ]}\"/>" :"";?>
        <h3>Registro de estudiantes</h3>
        <p>Breve instrucci&oacute;n para agregar un Estudiante al sistema</p>
        <h4>Nombre</h4>
        <div><input type="text" name="nombre" id="nombre" value="<?=$arrData[ 'nombre' ];?>" /></div>
        <h4>Email</h4>
        <div><input type="text" name="correo" id="correo" value="<?=$arrData[ 'correo' ];?>" /></div>
        <h4>Password</h4>
        <div><input type="Password" name="password" id="password" value="" /></div>
        <h4>Telefono</h4>
        <div><input type="text" name="telefono" id="telefono" value="<?=$arrData[ 'telefono' ];?>" /></div>
        <h4>Telefono 2</h4>
        <div><input type="text" name="telefono2" id="telefono2" value="<?=$arrData[ 'telefono2' ];?>" /></div>
        <h4>Celular</h4>
        <div><input type="text" name="celular" id="celular" value="<?=$arrData[ 'celular' ];?>" /></div>
        <h4>Carreras</h4>
        <div>
            <select name="carrera" id="carrera">
                <option value="<?=$arrData[ 'carrera_id' ];?>" >Seleccione</option>
                <?php
                if( $careers )
                {
                foreach( $careers as $value )
                {
                ?>
                <option value="<?=$value[ 'ID' ]?>"  <?=$value[ 'ID' ]==$arrData[ 'carrera_id' ] ? "selected":"" ?> ><?php echo "{$value[ 'NOMBRE' ] }" ?> </option>
                <?php
                }
                }
                ?>
            </select>
        </div>
        <br/>
        <div>
            <input type="submit" name="<?=$btnSubmit['name']?>" id="<?=$btnSubmit['id']?>" value="<?=$btnSubmit['name']?>" title="<?=$btnSubmit['title']?>"/>
        </div>
        <span class="ajaxloader"></span>
    </form>
</div>