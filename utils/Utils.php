<?php
/**
 * Clase que contiene funciones de utilidad para el sistema
 * @version 1.0
 * @author Fernando Perez
 * 
 */
class Utils {
    
    /**
     * function para registrar los errores de las consultas de la conexion
     * @param   string  $query          : consulta mysql que genero error
     * @param   string  $error          : error que genero la consulta
     * @param   string  $classname      : nombre de la clase que ocurrio el problema
     * @param   string  $functioname    : nombre de la funcion que ocurrio el problema
     * @return  void                    : none
     */
    public static function logQryError($query,$error,$functionname = "N/A",$classname  = "N/A"){
        echo $error;
    }
    
    /**
     * funcion para encriptar las contrasenas de acceso a utilzar
     */
    public static function encryptPassword($password){
        return md5($password);
    }
}

?>
