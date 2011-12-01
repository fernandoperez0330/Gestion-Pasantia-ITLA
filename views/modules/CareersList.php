<?php
require_once("../../config/Config.php");
require_once("../../config/Conexion.php");
require_once("../../models/Model.php");
require_once("../../models/ModelCareers.php");
$model = new ModelCareers();
$arrCarrers = $model->findsome(array());

include("../jstagsforajax.html"); 
?>
<p class="breadscrumbs"><a href="controlPanel.php">Panel de control</a> - <strong>Gestion de carreras</strong></p>
<h3>Lista de Carreras</h3>
<div>
    <a href="views/modules/CareersEditor.php" class="ajaxredirect">Agregar</a>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Dercripci&oacute;n</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($arrCarrers) { 
            foreach ($arrCarrers as $carrer) {
                ?>
                <tr>
                    <td><?= $carrer['NOMBRE']; ?></td>
                    <td><?= $carrer['DESCRIPCION']; ?></td>                    
                    <td><a href="views/modules/CareersList.php" id="ajax.careerEditor.php?delete=<?=$carrer[ 'ID' ]?>" class="eliminar">Eliminar</a>&nbsp &nbsp<a href="views/modules/CareersEditor.php?id=<?= $carrer['ID']; ?>" class="ajaxredirect">Actualizar</a></td>
                </tr>    
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6" align="center">No hay ninguna carrera registrada</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    <span class="ajaxloader"></span>
</table>
 