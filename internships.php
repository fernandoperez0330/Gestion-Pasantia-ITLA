<?php
require("include/main.inc.php");
require("models/Model.php");
require("models/ModelInternship.php");

$model = new ModelInternship();
$arrInternships = $model->findsome(array());


$title = "Pasantias";
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
                    <h1>Pasantias activas</h1>
                    <div id="arealistinternships">
                        <?php
                        foreach($arrInternships as $internship){
                            $carreras = "";
                            foreach($internship['carreras'] as $career){
                                if ($carreras != "") $carreras .= ", ";
                                $carreras .= $career['NOMBRE'];
                            }
                           ?>
                        <div class="internships">
                            <p><?=$internship['NOMBRE']?></p>
                            <ul>
                                <li><?=$internship['EMPRESA']?></li>
                                <li><?=$carreras?></li>
                                <li><a href="">Solicitar</a></li>
                            </ul>
                        </div>   
                        <?php 
                            
                        }
                        ?>
                    </div>
            </div>
            <?php include("views/footer.html"); ?>
        </div>
    </body>
</html>
