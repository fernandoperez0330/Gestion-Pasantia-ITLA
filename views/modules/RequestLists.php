<?php
define("URLROOT","../../");
require(URLROOT . "include/main.inc.php");
require(URLROOT . "Models/Model.php");
require(URLROOT . "Models/ModelRequests.php");
$model = new ModelRequests();
$arrRequests = $model->findsome(array());
include("../jstagsforajax.html");
?>
<p class="breadscrumbs"><a href="controlPanel.php">Panel de control</a> - <strong>Solicitudes de pasantias</strong></p>
<h3>Lista de Solicitudes de pasantias</h3>
<div>
    <a href="views/modules/RequestsEditor.php" class="ajaxredirect">Agregar</a>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>NO.Solicitud</th>
            <th>C&oacute;digo Estudiante</th>
            <th>Estudiante</th>
            <th>C&oacute;digo Pasantia</th>
            <th>Pasantia</th>
            <th>Estatus</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($arrRequests) {
            foreach ($arrRequests as $request) {
                ?>
                <tr>
                    <td><?=$request['ID']?></td>
                    <td><?=$request['ESTUDIANTE_ID']?></td>
                    <td><?=$request['ESTUDIANTE']?></td>
                    <td><?=$request['PASANTIA_ID']?></td>
                    <td><?=$request['PASANTIA']?></td>
                    <td><?=COnfig::$arrEstatus[$request['ESTATUS']];?></td>
                    <td>
                        <a target="_blank" href="pdf.letterinternship.php?id=<?=$request['ID']?>" title="Generar carte de pasantia">Carta</a><br/>
                        <a href="views/modules/RequestsEditor.php?id=<?=$request['ID']; ?>" class="ajaxredirect">Modificar</a><br/>
                        <a href="requestsManager.php?del=<?=$request['ID']?>" class="eliminar">Eliminar</a><br/>
                    </td>
                </tr>    
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="7" align="center">No hay ninguna solicitud realizada</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
