<?php
/**
 * Clase para modelo de las carreras
 * @version 1.0
 * @author Fernando Perez
 */
class ModelCareers extends Model{
    
    public function __construct() {
        parent::__construct();
    }

    public function add($model) {
        
                //depurar los datos antes de ponerlo en la consulta
        $model[ 'nombre' ] = htmlentities($model[ 'nombre' ]);
        $model[ 'descripcion' ] = htmlentities( $model[ 'descripcion' ] );
        
        $query = "INSERT INTO {$this->con->prefTable}CARRERAS(NOMBRE,DESCRIPCION) ".
                 "VALUES('{$model['nombre']}','{$model['descripcion']}')";
        $result = mysql_query($query,$this->con->link);
        if(!$result){
            Utils::logQryError($query, mysql_error($this->con->link),__FUNCTION__,__CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link))
        return true;
        return  false;
    }

    public function delete($model) {
        $model['id'] = $model['id'] + 0;
        $query = "DELETE FROM {$this->con->prefTable}carreras WHERE ID = {$model['id']}"; 
        $result = mysql_query($query);
        if(!$result){
            return false;
        }
        if (mysql_affected_rows($this->con->link))
        return true;
        return  false;
    }

    public function find($prkey) {
        $prkey = $prkey + 0;
        $query = "SELECT ID,NOMBRE,DESCRIPCION FROM {$this->con->prefTable}carreras WHERE ID=$prkey";
        $result = mysql_query($query);
        if(!$result){
            Utils::logQryError($query, mysql_error($this->con->link),__FUNCTION__,__CLASS__);
            return false;
        }
        $carreras = array(); 
        $numRows = mysql_num_rows($result);
        if ($numRows != 0) $carreras = mysql_fetch_assoc ($result);
        return $carreras;        
    }

    public function findsome($arrBy) {
        
        $where = "";
        foreach($arrBy as $field=>$value){
            $value = htmlentities($value);
            $where .= $where == "" ? "$field = $value" : " AND $field = $value";
        }
        $where = $where != "" ? "WHERE $where" : "";
        $query = "SELECT ID,NOMBRE,DESCRIPCION FROM {$this->con->prefTable}carreras $where";
        $result = mysql_query($query,$this->con->link);
        if(!$result){
            Utils::logQryError($query, mysql_error($this->con->link),__FUNCTION__,__CLASS__);
            return false;
        }
        $numRows = mysql_num_rows($result);
        $arrCarreras = array();
        if ($numRows != 0){
            while ($row = mysql_fetch_assoc($result)){
                $arrCarreras[] = $row;
            }
        }
        return $arrCarreras;        
    }

    public function update($model) {
        
        $model['nombre'] = htmlentities($model['nombre']);
        $model['descripcion'] = htmlentities($model['descripcion']);
        
        $query = "UPDATE {$this->con->prefTable}carreras SET NOMBRE = '{$model['nombre']}',DESCRIPCION = '{$model['descripcion']}' WHERE ID={$model['id']}";
        $result = mysql_query($query,$this->con->link);
        if(!$result){
            Utils::logQryError($query, mysql_error($this->con->link),__FUNCTION__,__CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link))
        return true;
        return  false;        
    }

}

?>
