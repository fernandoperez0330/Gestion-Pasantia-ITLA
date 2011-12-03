<?php

class Config {

    public static $dbHost = "localhost";
    public static $dbUsername = "root";
    public static $dbPassword = "";
    public static $dbName = "gestionpasantiadata";
    public static $prefTable = "";
    /**
     * Niveles de usuarios
     */
    public static $arrUserLevels = array(
                                    1=>'administrador',
                                    2=>'estudiantes'
                                );
    
    /**
     * arreglo de los indices de las sesiones 
     */
    public static $arrKeySession = array('user'=>"gp_user");
    
    //estatus generales para el portal
    public static $arrEstatus = array(
                                    "P"=>"Pendiente",
                                    "A"=>"Activo",
                                    "E"=>"Inactivo"
                                );
    
}

define("__SITENAME__", "Gestion Pasantia");
?>
