<?php

define("URLROOT","../../");
require(URLROOT . "include/main.inc.php");
require(URLROOT . "models/Model.php");
require(URLROOT . "models/ModelStudents.php");
$model = new ModelStudents();
$arrStudents = $model->findsome(array());

include("../jstagsforajax.html"); 
?>
<p class="breadscrumbs"><a href="controlPanel.php">Panel de control</a> - <strong>Gestion de Estudiantes</strong></p>
<h3>Lista de Estudiantes</h3>
<div>
    <a href="views/modules/registerStudents.php" class="ajaxredirect">Agregar</a>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Celurar</th>
            <th>Carrera</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($arrStudents) { 
            foreach ($arrStudents as $students) {
                ?>
                <tr>
                    <td><?= $students['NOMBRE']; ?></td>
                    <td><?= $students['CORREO']; ?></td>
                    <td><?= $students['TELEFONO']; ?></td>
                    <td><?= $students['CELULAR']; ?></td>
                    <td><?= $students['CARRERA_ID']; ?></td>
                    <td><a href="studentsManager.php?del=<?=$students['ID']?>" class="eliminar">Eliminar</a>&nbsp &nbsp<a href="views/modules/registerStudents.php?id=<?= $students['ID']; ?>" class="ajaxredirect">Actualizar</a></td>
                </tr>        
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6" align="center">No hay ningun estudiante registrada</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    <span class="ajaxloader"></span>
</table>
  