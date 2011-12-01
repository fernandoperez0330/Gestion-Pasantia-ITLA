<?php
define("URLROOT","../../");
require(URLROOT . "include/main.inc.php");
require(URLROOT . "Models/Model.php");
require(URLROOT . "Models/ModelInternship.php");
$model = new ModelInternship();
$arrInternships = $model->findsome(array());
include("../jstagsforajax.html");
?>
<p class="breadscrumbs"><a href="controlPanel.php">Panel de control</a> - <strong>Gestion de pasantias</strong></p>
<h3>Lista de Pasantias</h3>
<div>
    <a href="views/modules/InternshipsEditor.php" class="ajaxredirect">Agregar</a>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Empresa</th>
            <th>Carreras</th>
            <th>Fecha Creaci&oacute;n</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($arrInternships) {
            foreach ($arrInternships as $internship) {
                $carrera = "";
                //buscar las carreras 
                foreach($internship['carreras'] as $arrCareers) {
                    $carrera .= "{$arrCareers['NOMBRE']}<br/>";
                    }
                ?>
                <tr>
                    <td><?= $internship['ID']; ?></td>
                    <td><?= $internship['NOMBRE']; ?></td>
                    <td><?= $internship['EMPRESA']; ?></td>
                    <td><?=$carrera?></td>
                    <td><?= $internship['FECHA_CREACION']; ?></td>
                    <td>
                        <a href="views/modules/InternshipsEditor.php?id=<?= $internship['ID']; ?>" class="ajaxredirect">Actualizar</a>
                        <a href="internshipsManager.php?del=<?= $internship['ID']; ?>" class="eliminar">Eliminar</a> <br/>
                    </td>
                </tr>    
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6" align="center">No hay ninguna pasantia registrada</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
