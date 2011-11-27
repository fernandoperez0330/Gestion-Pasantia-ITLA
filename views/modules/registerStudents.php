<div id="registerarea">
    <form action="<?= __URLROOT__ ?>/register.php" name="frmregister" id="frmregister" method="post">
        <h3>Registro de estudiantes</h3>
        <h4>Nombre</h4>
        <div><input type="text" name="nombre" id="nombre" value="" /></div>
        <h4>Correo</h4>
        <div><input type="text" name="correo" id="correo" value="" /></div>
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
            </select>
        </div>
        <br/>
        <div>
            <input type="submit" name="agregar" id="agregar" value="Agregar" title="Enviar Solicitud"/>
        </div>
        <span class="ajaxloader"></span>
    </form>
</div>