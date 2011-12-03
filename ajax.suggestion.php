<?php
require("include/main.inc.php");
require("utils/AjaxHandler.php");

$handler = new AjaxHandler();
//enviar sugerencias por correo
$to = "20093331@itla.edu.do;20093287@itla.edu.do";
$subject = "Buzon de sugerencias" . __SITENAME__; 
$message = "Saludo estimado: 
El usuario con el nombre {$_POST['nombre']} ha dejado un sugerencia al portal: 

Sugerencia:
{$_POST['sugerencia']}

Datos de contacto;
Nombre: {$_POST['nombre']}
Email: {$_POST['correo']}

Gracias.

" . __SITENAME__;
@mail($to, $subject, $message);
$handler->setAt('return', true);
header('Content-type: application/json');
echo $handler->toJSON();
?>