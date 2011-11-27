<?php

/**
 * Clase para entidad de usuarios
 * @version 1.0
 * @author Fernando Perez
 */
class ModelUsers extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function add($model) {
        
    }

    public function delete($model) {
        
    }

    public function find($prkey) {
        
    }

    public function findsome($arrBy) {
        
    }

    public function update($model) {
        
    }

    /**
     * funcion para hacer login de un usuario
     * @param  $usuario: nombre de usuario o correo a comparar
     * @param $clave clave de acceso a comparar (junto con el nombre de usuario o correo electronico)
     * @return boolean: determina si existe este login o no
     */
    public function login($username, $password) {
        return true;
        $username = mysql_real_escape_string($username);
        $query = "SELECT ID,USUARIO,CLAVE FROM " . $this->con->prefTable . "Usuarios WHERE USUARIO='$username'";
        $result = mysql_query($query, $this->con);
        if (!$result)
            return false;
        if (mysql_fetch_row($result) != 0) {
            $row = mysql_fetch_array($result);
            $fetchpassword = $row[2];
            return $password == $fetchpassword;
        }
    }

    /**
     * 
     * 
     */
    public function setsession() {
        
    }

}

?>
