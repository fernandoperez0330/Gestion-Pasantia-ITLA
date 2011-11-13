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
        $model['NOMBRE'] = htmlentities($model['NOMBRE']);
        $model['DESCRIPCION'] = htmlentities($model['DESCRIPCION']);
        $query = "INSERT INTO {$this->con->prefTable}EMPRESAS(NOMBRE,DESCRIPCION) ".
                 "VALUES('{$model['NOMBRE']}','{$model['DESCRIPCION']}')";
        $result = mysql_query($query);
        if(!$result){
            return false;
        }
        if (mysql_affected_rows($result) == 0) return false;
        else return true;
    }

    public function delete($model) {
        $model['ID'] = $model['ID'] + 0;
        $query = "DELETE FROM {$this->con->prefTable}EMPRESAS WHERE ID = {$model['ID']}"; 
        $result = mysql_query($query);
        if(!$result){
            return false;
        }
        if (mysql_affected_rows($result) == 0) return false;
        else return true;
    }

    public function find($prkey) {
        $prkey = $prkey + 0;
        $query = "SELECT ID,NOMBRE,DESCRIPCION FROM {$this->con->prefTable}EMPRESAS WHERE ID=$prkey";
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
        $query = "SELECT ID,NOMBRE,DESCRIPCION FROM {$this->con->prefTable}EMPRESAS $where";
        $result = mysql_query($query);
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
        $model['NOMBRE'] = htmlentities($model['NOMBRE']);
        $model['DESCRIPCION'] = htmlentities($model['DESCRIPCION']);
        $query = "UPDATE {$this->con->prefTable}EMPRESAS SET NOMBRE = '{$model['NOMBRE']}',DESCRIPCION = '{$model['DESCRIPCION']}' ";
        $result = mysql_query($query);
        if(!$result){
            return false;
        }
        if (mysql_affected_rows($result) == 0) return false;
        else return true;
    }
}

?>
