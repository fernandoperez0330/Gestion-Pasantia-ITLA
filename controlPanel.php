<?php
require("include/main.inc.php");
require("models/Model.php");
require("models/ModelUsers.php");
require("models/ModelEmployees.php");
require("models/ModelRequests.php");
require("models/ModelStudents.php");

//solo usurios logueados
$validateUser = new ValidateUser($_SESSION[Config::$arrKeySession['user']]);

$title = "Panel de control";
//TODO: terminar de llenar los metatags
$meta['keywords'] = "";
$meta['description'] = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        //archivo del title
        include("views/titletag.html");
        //archivo de los metatags
        include("views/metatags.html");
        //archivo de los tags javascript
        include("views/jstags.html");
        //archivo de los tags css
        include("views/csstags.html");
        ?>
    </head>
    <body>
        <div id="wrap">
            <div id="header">
                <?php
                //area del logo
                include("views/logo.html");
                //area del menu principal
                include("views/mainmenu.html");
                ?>
            </div>
            <div id="site_content">
                <?php 
                if ($validateUser->validateLevel()){
                    $keynivel = $_SESSION[Config::$arrKeySession['user']][ValidateUser::$keylevelSession];
                    $nivel = COnfig::$arrUserLevels[$keynivel];
                    switch($keynivel){
                        case 1: //administrador
                            $model = new ModelEmployees();
                            $arrEmployee = $model->find($_SESSION[Config::$arrKeySession['user']]['tipo_id']);
                            include("views/modules/controlPanelAdmin.php");
                            break;
                        case 2: //estudiante
                            $model = new ModelStudents();
                            $modelRequest = new ModelRequests();
                            $arrRequests = $modelRequest->findsome(array('S.ESTUDIANTE_ID'=>$_SESSION[Config::$arrKeySession['user']]['id']));
                            $arrStudent = $model->find($_SESSION[Config::$arrKeySession['user']]['tipo_id']);
                            include("views/modules/controlPanelStudents.php");
                            break;
                    }
                }else
                    echo "<h3>No tiene autorizacion para estar en esta area.</h3>";
                ?>
            </div>
            <?php include("views/footer.html"); ?>
        </div>
    </body>
</html>
