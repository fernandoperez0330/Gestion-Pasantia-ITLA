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
        $username = mysql_real_escape_string($username);
        $query = "SELECT ID,USUARIO,CLAVE,TIPO FROM " . $this->con->prefTable . "Usuarios WHERE USUARIO='$username'";
        $result = mysql_query($query, Conexion::$link);
        if (!$result)
            return false;
        if (mysql_num_rows($result) != 0) {
            $row = mysql_fetch_assoc($result);
            $fetchpassword = $row['CLAVE'];
            $password = Utils::encryptPassword($password);
            if ($password == $fetchpassword){
                $this->setsession($row);
                return true;
            }
        }
    }

    /**
     * funcion que sete la session que requiere de usuarios
     * @param   array   $arrUser : arreglo con los datos del usuario
     * @return  array            :  arreglo con los datos seteados
     */
    public function setsession($arrUser) {
        $arrReturn = array();
        if ($arrUser && is_array($arrUser)){
            foreach($arrUser as $k=>$v){
                $k = strtolower($k);
                $arrReturn[$k] = $v;
            }
            $_SESSION[Config::$arrKeySession['user']] = $arrReturn;
        }
        return $arrReturn;
    }
}

?>
