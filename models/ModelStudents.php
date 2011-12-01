<?php

/**
 * Clase para el modelo de los estudiantes
 * @version 1.0
 * @author Fernando Perez
 */
require_once( 'ModelUsers.php' );
require_once( 'ModelCareers.php' );

class ModelStudents extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function add($model) {

        $modelUser = new ModelUsers();

        //depurar los datos antes de ponerlo en la consulta
        $model['nombre'] = mysql_escape_string(htmlentities(strip_tags($model['nombre'])));
        $model['correo'] = mysql_escape_string(htmlentities(strip_tags($model['correo'])));
        $model['password'] = mysql_escape_string(htmlentities(strip_tags($model['password'])));
        $model['telefono'] = mysql_escape_string(htmlentities(strip_tags($model['telefono'])));
        $model['telefono2'] = mysql_escape_string(htmlentities(strip_tags($model['telefono2'])));
        $model['celular'] = mysql_escape_string(htmlentities(strip_tags($model['celular'])));
        $model['carrera'] = $model['carrera'] + 0;


        $query = "INSERT INTO {$this->con->prefTable}estudiantes (NOMBRE,CORREO,TELEFONO,TELEFONO2,CELULAR,CARRERA_ID) " .
                "VALUES('{$model['nombre']}','{$model['correo']}','{$model['telefono']}','{$model['telefono2']}','{$model['celular']}',{$model['carrera']})";

        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link)) {
            $idStudents = mysql_insert_id(conexion::$link);

            $modelUserData = array();
            $modelUserData['usuario'] = $model['correo'];
            $modelUserData['clave'] = Utils::encryptPassword($model['password']);
            $modelUserData['tipo'] = 2;

            if ($modelUser->add($modelUserData)) {
                $idUSer = mysql_insert_id(conexion::$link);
                $query = "INSERT INTO usuarios_tipos (`USUARIO_ID` ,`TIPO` ,`TIPO_ID`)VALUES ('{$idUSer}', '2', '{$idStudents}')";
                mysql_query($query);
                return true;
            }
            else
                return false;
        }else
            return false;
    }

    public function delete($model) {
        $model['id'] = $model['id'] + 0;

        $query = "DELETE FROM {$this->con->prefTable}estudiantes WHERE ID = {$model['id']}";
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

        $modelCareers = new ModelCareers();

        $query = "SELECT ID,NOMBRE,CORREO,TELEFONO,TELEFONO2,CELULAR,CARRERA_ID FROM {$this->con->prefTable}estudiantes WHERE ID=$prkey";
        $result = mysql_query($query);
        if (!$result) {
            return false;
        }
        $students = array();
        $numRows = mysql_num_rows($result);
        if ($numRows != 0) {
            $students = mysql_fetch_assoc($result);
            $careers = $modelCareers->find($students['CARRERA_ID']);
            $students['CARRERA_NOMBRE'] = $careers['NOMBRE'];
        }
        return $students;
    }

    public function findsome($arrBy) {

        $modelCareers = new ModelCareers();
        $i = 0;

        $where = "";
        foreach ($arrBy as $field => $value) {
            $value = htmlentities($value);
            $where .= $where == "" ? "$field = $value" : " AND $field = $value";
        }
        $where = $where != "" ? "WHERE $where" : "";
        $query = "SELECT ID,NOMBRE,CORREO,TELEFONO,TELEFONO2,CELULAR,CARRERA_ID FROM {$this->con->prefTable}estudiantes $where";
        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            return false;
        }
        $numRows = mysql_num_rows($result);
        $arrStudents = array();
        if ($numRows != 0) {
            while ($row = mysql_fetch_assoc($result)) {
                $arrStudents[] = $row;
                $careers = $modelCareers->find($arrStudents[$i]['CARRERA_ID']);
                $arrStudents[$i]['CARRERA_ID'] = $careers['NOMBRE'];
                ++$i;
            }
        }
        return $arrStudents;
    }

    public function update($model) {

        //depurar los datos a actualizar
        $model['id'] = $model['id'] + 0;
        $model['nombre'] = mysql_escape_string(htmlentities(strip_tags($model['nombre'])));
        $model['correo'] = mysql_escape_string(htmlentities(strip_tags($model['correo'])));
        $model['password'] = mysql_escape_string(htmlentities(strip_tags($model['password'])));
        $model['telefono'] = mysql_escape_string(htmlentities(strip_tags($model['telefono'])));
        $model['telefono2'] = mysql_escape_string(htmlentities(strip_tags($model['telefono2'])));
        $model['celular'] = mysql_escape_string(htmlentities(strip_tags($model['celular'])));
        $model['carrera'] = $model['carrera'] + 0;

        $query = "UPDATE {$this->con->prefTable}estudiantes SET NOMBRE = '{$model['nombre']}',CORREO = '{$model['correo']}',TELEFONO='{$model['telefono']}',TELEFONO2='{$model['telefono2']}',CELULAR='{$model['celular']}',CARRERA_ID={$model['carrera']} WHERE ID={$model['id']}";
        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link))
            return true;
        return false;
    }
}
?>
