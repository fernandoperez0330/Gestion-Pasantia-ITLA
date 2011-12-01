<div id="areapanelcontrol">
    <div id="arealnklogout"><a href="logout.php"><img src="resources/bad.gif" width="14" border="0"/>&nbsp;Cerrar Session</a></div>
    <h2>Perfil de estudiante</h2>
    <div id="areaimgprofile">
        <img id="imgprofile" src="resources/student.png"/>
    </div>
    <div id="areadataprofile">
        <p>Nombre.: <strong><?= $arrStudent['NOMBRE'] ?></strong></p>
        <p>Correo.: <strong><?= $arrStudent['CORREO'] ?></strong></p>
        <p>Telefono.: <strong><?= $arrStudent['TELEFONO'] ?></strong></p>
        <p>Celular.: <strong><?= $arrStudent['CELULAR'] ?></strong></p>
        <p>Carrera.: <strong><?= isset($arrStudent['CARRERA']) ? $arrStudent['CARRERA'] : ""; ?></strong></p>
        <p>Nivel de acceso.: <strong><?= ucfirst(strtolower($nivel)); ?></strong></p>
    </div>
    <hr/>    
    <h3>Solicitudes de pasantia</h3>
    <div> 
        <?php
        if ($arrRequests) {
            foreach($arrRequests as $request){
            ?>    
            <h4>Tiene una solicitud</h4>
            <p>No.Solicitud.: <strong><?=$request['ID']?></strong></p>
            <p>Nombre.: <strong><?=$request['PASANTIA']?></strong></p>
            <p>Estatus.: <strong><?=Config::$arrEstatus[$request['ESTATUS']]?></strong></p>
            <?php
            
            }
        } else {
            ?>
            <p>No tiene solicitudes pendientes</p>
        <?php } ?>
    </div>
</div>
