<div id="areapanelcontrol">
    <div id="arealnklogout"><a href="logout.php"><img src="resources/bad.gif" width="14" border="0"/>&nbsp;Cerrar Session</a></div>
    <h2>Panel de control</h2>
    <div id="areaimgprofile">
        <img id="imgprofile" src="resources/support.png"/>
    </div>
    <div id="areadataprofile">
        <p>Nombre.: <strong><?=$arrEmployee['NOMBRE']?></strong></p>
        <p>Apellido.: <strong><?=$arrEmployee['APELLIDO']?></strong></p>
        <p>Correo.: <strong><?=$arrEmployee['CORREO']?></strong></p>
        <p>Nivel de acceso.: <strong><?=ucfirst(strtolower($nivel));?></strong></p>
    </div>
    <hr/>    
    <h3>Opciones</h3>
    <div id="optionControlPanelAdmin"> 
        <ul>
            <li><a href="companiesManager.php">Gestion de Empresas</a></li>
            <li><a href="careersManager.php">Gestion de Carreras</a></li>
            <li><a href="studentsManager.php">Gestion de Estudiantes</a></li>
            <li><a href="employeesManager.php">Gestion de Empleados</a></li>
            <li><a href="internshipsManager.php">Gestion de Pasantias</a></li>
            <li><a href="requestsManager.php">Solicitudes de pasantias</a></li>
        </ul>
    </div>
</div>



