<?php
define("URLROOT","../../");
require(URLROOT . "include/main.inc.php");
require(URLROOT . "Models/Model.php");
require(URLROOT . "Models/ModelCompanies.php");
$model = new ModelCompanies();
$arrCompanies = $model->findsome(array());

include("../jstagsforajax.html");
?>
<p class="breadscrumbs"><a href="controlPanel.php">Panel de control</a> - <strong>Gestion de empresas</strong></p>
<h3>Lista de Empresas</h3>
<div>
    <a href="views/modules/CompaniesEditor.php" class="ajaxredirect">Agregar</a>
</div>
<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Direcci&oacute;n</th>
            <th>Correo</th>
            <th>Telefono 1</th>
            <th>Telefono 2</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($arrCompanies) {
            foreach ($arrCompanies as $company) {
                ?>
                <tr>
                    <td><?= $company['NOMBRE']; ?></td>
                    <td><?= $company['DIRECCION']; ?></td>
                    <td><?= $company['CORREO']; ?></td>
                    <td><?= $company['TELEFONO1']; ?></td>
                    <td><?= $company['TELEFONO2']; ?></td>
                    <td><a href="views/modules/CompaniesEditor.php?id=<?= $company['ID']; ?>" class="ajaxredirect">Actualizar</a></td>
                </tr>    
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="6" align="center">No hay ninguna empresa registrada</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
