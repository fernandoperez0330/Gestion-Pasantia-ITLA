<?php
require("include/main.inc.php");
require('models/Model.php');
require('models/ModelStudents.php');

//solo para administradores
$validateUser = new ValidateUser($_SESSION[Config::$arrKeySession['user']],1);
if (!$validateUser->validateLevel()){
    die("<script type=\"text/javascript\">alert('No tiene autorizacion para estar aqui');location.href='index.php'</script>");
}

$title = "Administrador de Estudiantes";

//TODO: terminar de llenar los metatags
$meta['keywords'] = "";
$meta['description'] = "";
$msg="";

if( isset( $_GET[ 'del' ] ) )
{
    $_GET[ 'del' ] +=0;
    $model = new ModelStudents();
    $elim = array();
    $elim[ 'id' ] =$_GET[ 'del' ];
    if( $model->delete( $elim ) )
    $msg = "El Usuario ha sido eliminado correctamente";
    else
    $msg = "El Usuario no ha sido eliminado, favor de intentar nuevamente";
}


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
                <div id="loadingajax"><img src="resources/ajax-loader.gif" width="14"/>&nbsp;Cargando...</div>
                <?php
                //area del logo
                include("views/logo.html");
                //area del menu principal
                include("views/mainmenu.html");
                ?>
            </div>
            <div id="site_content">
                <?=$msg ? "<div>{$msg}</div>" : ""?>            
                <div id="areastudentsmanager"></div>                
            </div>
            <?php include("views/footer.html"); ?>
        </div>
    </body>
</html>
  