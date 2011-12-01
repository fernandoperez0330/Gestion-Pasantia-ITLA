<?php

/**
 * Clase para el modelo de las pasantias
 * @version 1.0
 * @author Fernando Perez
 */
class ModelInternship extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function add($model) {
        //depurar los datos antes de ponerlo en la consulta
        $model['nombre'] = htmlentities($model['nombre']);
        $model['empresa_id'] = $model['empresa_id'] + 0;
        $model['fecha_creacion'] = "NOW()";
        
        foreach($model['carreras'] as $k=>$v)
            $model['carreras'][$k] = $v + 0;

        $query = "INSERT INTO {$this->con->prefTable}pasantias(NOMBRE,EMPRESA_ID,FECHA_CREACION) " .
                "VALUES('{$model['nombre']}','{$model['empresa_id']}',{$model['fecha_creacion']})";
        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link)) {
            //verificar la cantidad de carreras que aplica esta pasantia
            $values = "";
            $pasantia_id = mysql_insert_id($this->con->link);
            foreach ($model['carreras'] as $carrera_id) {
                if ($values != "")
                    $values .= ",";
                $values .= "($pasantia_id,$carrera_id)";
            }
            $query = "INSERT INTO {$this->con->prefTable}pasantias_carreras(PASANTIA_ID,CARRERA_ID)" .
                    " VALUES $values";
            $result = mysql_query($query);
            if (!$result)
                Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return true;
        }
        return false;
    }
    
     /**
     * funcion que obtiene la carreras en la que aplica esta pasantia 
     * @param   integer $prkey
     * @return  array   
     */
    public function getCareers($prkey){
        $query = "SELECT CARRERA_ID FROM {$this->con->prefTable}pasantias_carreras where PASANTIA_ID={$prkey}";
        $result = mysql_query($query);
        if (!$result){
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        $arrCareers = array();
        if (mysql_num_rows($result) != 0){
            while($row = mysql_fetch_assoc($result)){
                $arrCareers[] = $row;
            }
        }
        return $arrCareers; 
    }

    public function delete($model) {
        $model['id'] = $model['id'] + 0;
        //eliminar las carreras de la tabla enlace antes de borrar el registro
        $query = "DELETE FROM {$this->con->prefTable}pasantias_carreras WHERE PASANTIA_ID = {$model['id']}";
        $result = mysql_query($query);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        $query = "DELETE FROM {$this->con->prefTable}pasantias WHERE ID = {$model['id']}";
        $result = mysql_query($query);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link))
            return true;
        return false;
    }

    public function find($prkey) {
        $prkey = $prkey + 0;
        $query = "SELECT ID,NOMBRE,EMPRESA_ID,FECHA_CREACION FROM {$this->con->prefTable}pasantias WHERE ID=$prkey";
        $result = mysql_query($query);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        $pasantias = array();
        $numRows = mysql_num_rows($result);
        if ($numRows != 0) {
            $pasantias = mysql_fetch_assoc($result);
            $query = "SELECT CARRERA_ID FROM {$this->con->prefTable}pasantias_carreras WHERE PASANTIA_ID = $prkey";
            $result = mysql_query($query);
            if ($result && mysql_num_rows($result) != 0) {
                while ($row = mysql_fetch_row($result)) {
                    $pasantias['carreras'][] = $row[0];
                }
            }
        }
        return $pasantias;
    }

    public function findsome($arrBy) {
        $where = "";
        foreach ($arrBy as $field => $value) {
            $value = htmlentities($value);
            $where .= $where == "" ? "$field = $value" : " AND $field = $value";
        }
        $where = $where != "" ? "WHERE $where" : "";

        $query = "SELECT P.ID,P.NOMBRE,P.EMPRESA_ID,E.NOMBRE 'EMPRESA',FECHA_CREACION FROM {$this->con->prefTable}pasantias P INNER JOIN {$this->con->prefTable}empresas E" .
                " ON P.EMPRESA_ID = E.ID $where";
        $result = mysql_query($query);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        $numRows = mysql_num_rows($result);
        $arrInternships = array();
        if ($numRows != 0) {
            while ($row = mysql_fetch_assoc($result)) {
                $query2 = "SELECT CP.CARRERA_ID,C.NOMBRE FROM {$this->con->prefTable}pasantias_carreras CP INNER JOIN carreras C " .
                        "ON CP.CARRERA_ID = C.ID WHERE CP.PASANTIA_ID = {$row['ID']}";
                $result2 = mysql_query($query2);
                if ($result2 && mysql_num_rows($result2) != 0) {
                    while ($row2 = mysql_fetch_assoc($result2)) {
                        $row['carreras'][] = $row2;
                    }
                }
                $arrInternships[] = $row;
            }
            
        }
        return $arrInternships;
    }

    public function update($model) {
        //depurar los datos antes de ponerlo en la consulta
        $model['nombre'] = htmlentities($model['nombre']);
        $model['empresa_id'] = $model['empresa_id'] + 0;
        $model['fecha_creacion'] = "NOW()";
        
        foreach($model['carreras'] as $k=>$v)
            $model['carreras'][$k] = $v + 0;
        
        $query = "UPDATE {$this->con->prefTable}pasantias SET NOMBRE='{$model['nombre']}',EMPRESA_ID={$model['empresa_id']}".
                 " WHERE ID={$model['id']}";
        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link)) {
            //verificar la cantidad de carreras que aplica esta pasantia
            $values = "";
            $pasantia_id = $model['id'];
            
            //eliminar los registros de carreras pasantias para actualizarlos
            $query = "DELETE FROM {$this->con->prefTable}pasantias_carreras WHERE PASANTIA_ID={$model['id']}";
            $result = mysql_query($query);
            if (!$result)
                Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            foreach ($model['carreras'] as $carrera_id) {
                if ($values != "")
                    $values .= ",";
                $values .= "($pasantia_id,$carrera_id)";
            }
            //insertar las carreras a la pasantia actualizadas
            $query = "INSERT INTO {$this->con->prefTable}pasantias_carreras(PASANTIA_ID,CARRERA_ID)" .
                    " VALUES $values";
            $result = mysql_query($query);
            if (!$result)
                Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return true;
        }
        return false;
    } 

}

?>
