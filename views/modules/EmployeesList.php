<?php
define("URLROOT","../../");
require(URLROOT . "include/main.inc.php");
require(URLROOT . "models/Model.php");
require(URLROOT . "models/ModelEmployees.php");
$model = new ModelEmployees();
$arrEmployees = $model->findsome(array());

include("../jstagsforajax.html"); 
?>

<p class="breadscrumbs"><a href="controlPanel.php">Panel de control</a> - <strong>Gestion de empleados</strong></p>
<h3>Lista de Empleados</h3>
<div>
    <a href="views/modules/EmployeesEditor.php" class="ajaxredirect">Agregar</a>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($arrEmployees) { 
            foreach ($arrEmployees as $empl) {
                ?>
                <tr>
                    <td><?= $empl['NOMBRE']; ?></td>
                    <td><?= $empl['APELLIDO']; ?></td>
                    <td><?= $empl['CORREO']; ?></td>
                    <td><?= $empl['TELEFONO']; ?></td>
                    <td><a href="employeesManager.php?del=<?=$empl['ID']?>" class="eliminar">Eliminar</a>&nbsp &nbsp<a href="views/modules/EmployeesEditor.php?id=<?=$empl['ID']; ?>" class="ajaxredirect">Actualizar</a></td>
                </tr>        
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6" align="center">No hay ningun empleado registrado</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    <span class="ajaxloader"></span>
</table>
  