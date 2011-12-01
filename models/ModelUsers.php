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
        //depurar los datos antes de ponerlo en la consulta
        $model['usuario'] = htmlentities(strip_tags($model['usuario']));
        $model['clave'] = htmlentities(strip_tags($model['clave']));
        $model['tipo'] = htmlentities(strip_tags($model['tipo']));

        $query = "INSERT INTO {$this->con->prefTable}usuarios(USUARIO,CLAVE) " .
                "VALUES('{$model['usuario']}','{$model['clave']}')";
        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link))
            return true;
        return false;
    }

    public function delete($model) {
        $model['id'] = $model['id'] + 0;
        $query = "DELETE FROM {$this->con->prefTable}usuarios WHERE ID = {$model['id']}";
        $result = mysql_query($query);
        if (!$result) {
            return false;
        }
        if (mysql_affected_rows($this->con->link))
            return true;
        return false;
    }

    public function find($prkey) {
        $prkey = $prkey + 0;
        $query = "SELECT ID,USUARIO,CLAVE FROM {$this->con->prefTable}usuarios WHERE ID=$prkey";
        $result = mysql_query($query);
        if (!$result) {
            return false;
        }
        $carreras = array();
        $numRows = mysql_num_rows($result);
        if ($numRows != 0)
            $carreras = mysql_fetch_assoc($result);
        return $carreras;
    }

    public function findsome($arrBy) {
        $where = "";
        foreach ($arrBy as $field => $value) {
            $value = htmlentities($value);
            $where .= $where == "" ? "$field = $value" : " AND $field = $value";
        }
        $where = $where != "" ? "WHERE $where" : "";
        $query = "SELECT ID,USUARIO,CLAVE FROM {$this->con->prefTable}usuarios $where";
        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        $numRows = mysql_num_rows($result);
        $arrUsers = array();
        if ($numRows != 0) {
            while ($row = mysql_fetch_assoc($result)) {
                $arrUsers[] = $row;
            }
        }
        return $arrUsers;
    }

    public function update($model) {
        $model['usuario'] = htmlentities($model['usuario']);
        $model['clave'] = htmlentities($model['clave']);
        $model['tipo'] = htmlentities($model['tipo']);

        $query = "UPDATE {$this->con->prefTable}usuarios SET USUARIO = '{$model['usuario']}',CLAVE = '{$model['clave']}' WHERE ID={$model['id']}";
        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link))
            return true;
        return false;
    }

    /**
     * funcion para hacer login de un usuario
     * @param  $usuario: nombre de usuario o correo a comparar
     * @param $clave clave de acceso a comparar (junto con el nombre de usuario o correo electronico)
     * @return boolean: determina si existe este login o no
     */
    public function login($username, $password) {
        $username = mysql_real_escape_string($username);
        $query = "SELECT ID,USUARIO,CLAVE FROM " . $this->con->prefTable . "usuarios WHERE USUARIO='$username'";
        $result = mysql_query($query, $this->con->link);
        if (!$result)
            return false;
        if (mysql_num_rows($result) != 0) {
            $row = mysql_fetch_assoc($result);
            $fetchpassword = $row['CLAVE'];
            $password = Utils::encryptPassword($password);
            if ($password == $fetchpassword) {
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
        if ($arrUser && is_array($arrUser)) {
            foreach ($arrUser as $k => $v) {
                $k = strtolower($k);
                $arrReturn[$k] = $v;
            }
            $query = "SELECT TIPO,TIPO_ID FROM {$this->con->prefTable}usuarios_tipos WHERE USUARIO_ID ={$arrReturn['id']}";
            $result = mysql_query($query,$this->con->link);
            if ($result && mysql_num_rows($result) != 0) {
                $row = mysql_fetch_assoc ($result);
                foreach($row as $k=>$v){
                    $arrRow[strtolower($k)] = $v;
                }
                $arrReturn = array_merge($arrReturn,$arrRow);
            }   
            $_SESSION[Config::$arrKeySession['user']] = $arrReturn;
        }
        return $arrReturn;
    }

}

?>
