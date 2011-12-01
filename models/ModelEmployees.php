<?php
/**
 * clase para modelos de los empleados (adminsitradores)
 * @author Fernando Perez
 * @version 1.0
 */
class ModelEmployees extends Model{
    
    public function __construct() {
        parent::__construct();
    }

    public function add($model) {
        $model['nombre'] = htmlentities($model['nombre']);
        $model['apellido'] = htmlentities($model['apellido']);
        $model['correo']= htmlentities($model['correo']);
        $model['telefono']= htmlentities($model['telefono']);
        
        $query = "INSERT INTO {$this->con->prefTable}empleados(NOMBRE,APELLIDO,CORREO,TELEFONO) ".
                 "VALUES('{$model['nombre']}','{$model['apellido']}','{$model['correo']}','{$model['telefono1']}')";
        $result = mysql_query($query,$this->con->link);
        if(!$result){
            Utils::logQryError($query, mysql_error($this->con->link),__FUNCTION__,__CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link) == 0) return false;
        else return true;
    }

    public function delete($model) {
        $model['ID'] = $model['ID'] + 0;
        $query = "DELETE FROM {$this->con->prefTable}empleados WHERE ID = {$model['ID']}"; 
        $result = mysql_query($query);
        if(!$result){
            return false;
        }
        if (mysql_affected_rows($this->con->link) == 0) return false;
        else return true;
    }

    public function find($prkey) {
        $prkey = $prkey + 0;
        $query = "SELECT ID,NOMBRE,APELLIDO,CORREO,TELEFONO FROM {$this->con->prefTable}empleados WHERE ID=$prkey";
        $result = mysql_query($query);
        if(!$result){
            return false;
        }
        $employee = array();
        $numRows = mysql_num_rows($result);
        if ($numRows != 0) $employee = mysql_fetch_assoc ($result);
        return $employee;
    }

    public function findsome($arrBy) {
        $where = "";
        foreach($arrBy as $field=>$value){
            $value = htmlentities($value);
            $where .= $where == "" ? "$field = $value" : " AND $field = $value";
        }
        $where = $where != "" ? "WHERE $where" : "";
        $query = "SELECT ID,NOMBRE,APELLIDO,CORREO,TELEFONO FROM {$this->con->prefTable}empleados $where";
        $result = mysql_query($query,$this->con->link);
        if(!$result){
            return false;
        }
        $numRows = mysql_num_rows($result);
        $arrEmployees = array();
        if ($numRows != 0){
            while ($row = mysql_fetch_assoc($result)){
                $arrEmployees[] = $row;
            }
        }
        return $arrEmployees; $employee = mysql_fetch_assoc ($result);
    }

    public function update($model) {
        $model['nombre'] = htmlentities($model['nombre']);
        $model['apellido'] = htmlentities($model['apellido']);
        $model['correo']= htmlentities($model['correo']);
        $model['telefono']= htmlentities($model['telefono']);
        
        $query = "UPDATE {$this->con->prefTable}empleados SET NOMBRE = '{$model['nombre']}',APELLIDO = '{$model['apellido']}',CORREO='{$model['correo']}',TELEFONO='{$model['telefono']}' WHERE ID={$model['id']}";
        $result = mysql_query($query,$this->con->link);
        if(!$result){
            Utils::logQryError($query, mysql_error($this->con->link),__FUNCTION__,__CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link) == 0) return false;
        else return true;
    }

}

?>
