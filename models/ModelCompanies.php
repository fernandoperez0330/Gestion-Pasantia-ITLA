<?php
/**
 * Clase para el modelo de compania, extiende de la clase {@link Model} 
 * @version 1.0
 * @author Fernando Perez
 */
class ModelCompanies extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add($model) {
        
        //depurar los datos antes de ponerlo en la consulta
        $model['nombre'] = htmlentities($model['nombre']);
        $model['descripcion'] = htmlentities($model['descripcion']);
        $model['direccion']= htmlentities($model['direccion']);
        $model['telefono1']= htmlentities($model['telefono1']);
        $model['telefono2']= htmlentities($model['telefono2']);
        $model['correo']= htmlentities($model['correo']);
        
        $query = "INSERT INTO {$this->con->prefTable}EMPRESAS(NOMBRE,DESCRIPCION,DIRECCION,TELEFONO1,TELEFONO2,CORREO) ".
                 "VALUES('{$model['nombre']}','{$model['descripcion']}','{$model['direccion']}','{$model['telefono1']}','{$model['telefono2']}','{$model['correo']}')";
        $result = mysql_query($query,conexion::$link);
        if(!$result){
            Utils::logQryError($query, mysql_error(conexion::$link),__FUNCTION__,__CLASS__);
            return false;
        }
        if (mysql_affected_rows(conexion::$link) == 0) return false;
        else return true;
    }

    public function delete($model) {
        $model['ID'] = $model['ID'] + 0;
        $query = "DELETE FROM {$this->con->prefTable}EMPRESAS WHERE ID = {$model['ID']}"; 
        $result = mysql_query($query);
        if(!$result){
            return false;
        }
        if (mysql_affected_rows(conexion::$link) == 0) return false;
        else return true;
    }

    public function find($prkey) {
        $prkey = $prkey + 0;
        $query = "SELECT ID,NOMBRE,DESCRIPCION,DIRECCION,TELEFONO1,TELEFONO2,CORREO FROM {$this->con->prefTable}EMPRESAS WHERE ID=$prkey";
        $result = mysql_query($query);
        if(!$result){
            return false;
        }
        $company = array();
        $numRows = mysql_num_rows($result);
        if ($numRows != 0) $company = mysql_fetch_assoc ($result);
        return $company;
    }

    public function findsome($arrBy) {
        $where = "";
        foreach($arrBy as $field=>$value){
            $value = htmlentities($value);
            $where = $where == "" ? "$field = $value" : " AND $field = $value";
        }
        $where = $where != "" ? "WHERE $where" : "";
        $query = "SELECT ID,NOMBRE,DESCRIPCION,DIRECCION,TELEFONO1,TELEFONO2,CORREO FROM {$this->con->prefTable}EMPRESAS $where";
        $result = mysql_query($query,conexion::$link);
        if(!$result){
            return false;
        }
        $numRows = mysql_num_rows($result);
        $arrCompanies = array();
        if ($numRows != 0){
            while ($row = mysql_fetch_assoc($result)){
                $arrCompanies[] = $row;
            }
        }
        return $arrCompanies;
    }

    public function update($model) {
        $model['nombre'] = htmlentities($model['nombre']);
        $model['descripcion'] = htmlentities($model['descripcion']);
        $model['direccion']= htmlentities($model['direccion']);
        $model['telefono1']= htmlentities($model['telefono1']);
        $model['telefono2']= htmlentities($model['telefono2']);
        $model['correo']= htmlentities($model['correo']);
        
        $query = "UPDATE {$this->con->prefTable}EMPRESAS SET NOMBRE = '{$model['nombre']}',DESCRIPCION = '{$model['descripcion']}',DIRECCION='{$model['direccion']}',TELEFONO1='{$model['telefono1']}',TELEFONO2='{$model['telefono2']}',CORREO='{$model['correo']}' WHERE ID={$model['id']}";
        $result = mysql_query($query,conexion::$link);
        if(!$result){
            Utils::logQryError($query, mysql_error(conexion::$link),__FUNCTION__,__CLASS__);
            return false;
        }
        if (mysql_affected_rows(conexion::$link) == 0) return false;
        else return true;
    }
}
?>
