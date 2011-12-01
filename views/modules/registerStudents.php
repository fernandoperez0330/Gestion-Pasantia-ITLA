<?php

require_once( 'config/Config.php' );
require_once( 'config/conexion.php' );
require_once( 'models/Model.php' );
require_once( 'models/ModelCareers.php' );

$model = new ModelCareers();
$careers = $model->findsome( array() );

?>

<div id="registerarea">
    <form action="<?= __URLROOT__ ?>/register.php" name="frmregister" id="frmregister" method="post">
        <h3>Registro de estudiantes</h3>
        <h4>Nombre</h4>
        <div><input type="text" name="nombre" id="nombre" value="" /></div>
        <h4>Email</h4>
        <div><input type="text" name="correo" id="correo" value="" /></div>
        <h4>Password</h4>
        <div><input type="Password" name="password" id="password" value="" /></div>
        <h4>Telefono</h4>
        <div><input type="text" name="telefono" id="telefono" value=""/></div>
        <h4>Telefono 2</h4>
        <div><input type="text" name="telefono2" id="telefono2" value=""/></div>
        <h4>Celular</h4>
        <div><input type="text" name="celular" id="celular" value=""/></div>
        <h4>Carreras</h4>
        <div>
            <select name="carrera" id="carrera">
                <option value="0">Seleccione</option>
                <?php
                if( $careers )
                {
                foreach( $careers as $value )
                {
                ?>
                <option value="<?=$value[ 'ID' ]?>"><?php echo "{$value[ 'NOMBRE' ] }" ?> </option>
                <?php
                }
                }
                ?>
            </select>
        </div>
        <br/>
        <div>
            <input type="submit" name="agregar" id="agregar" value="Agregar" title="Enviar Solicitud"/>
        </div>
        <span class="ajaxloader"></span>
    </form>
</div>