<?php
/**
 * Clase para el modelo de los estudiantes
 * @version 1.0
 * @author Fernando Perez
 */
class ModelStudents extends Model{
    
    public function __construct() {
        parent::__construct();
    }

    public function add($model) {
                //depurar los datos antes de ponerlo en la consulta
        $model[ 'nombre' ] = htmlentities($model[ 'nombre' ]);
        $model[ 'correo' ] = htmlentities( $model[ 'correo' ] );
        $model[ 'password' ] = htmlentities( $model[ 'password' ] );
        $model[ 'telefono' ] = htmlentities( $model[ 'telefono' ] );
        $model[ 'telefono2' ] = htmlentities( $model[ 'telefono2' ] );
        $model[ 'celular' ] = htmlentities( $model[ 'celular' ] );
        $model[ 'carrera' ] = htmlentities( $model[ 'carrera' ] );
        
        
        $query = "INSERT INTO {$this->con->prefTable} ESTUDIANTES (NOMBRE,CORREO,TELEFONO,TELEFONO2,CELULAR,CARRERA_ID) ".
                 "VALUES('{$model['nombre']}','{$model['correo']}','{$model['telefono']}','{$model['telefono2']}','{$model['celular']}',{$model['carrera']})";
        $result = mysql_query($query,conexion::$link);
        if(!$result){
            Utils::logQryError($query, mysql_error(conexion::$link),__FUNCTION__,__CLASS__);
            return false;
        }
        if (mysql_affected_rows(conexion::$link))
        return true;
        return  false;        
    }

    public function delete($model) {
        $model['id'] = $model['id'] + 0;
        $query = "DELETE FROM {$this->con->prefTable}ESTUDIANTES WHERE ID = {$model['id']}"; 
        $result = mysql_query($query);
        if(!$result){
            return false;
        }
        if (mysql_affected_rows(conexion::$link))
        return true;
        return  false;        
    }

    public function find($prkey) {
        $prkey = $prkey + 0;
        $query = "SELECT ID,NOMBRE,CORREO,TELEFONO,TELEFONO2,CELULAR,CARRERA_ID FROM {$this->con->prefTable}ESTUDIANTES WHERE ID=$prkey";
        $result = mysql_query($query);
        if(!$result){
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
        $query = "SELECT ID,NOMBRE,CORREO,TELEFONO,TELEFONO2,CELULAR,CARRERA_ID FROM {$this->con->prefTable}ESTUDIANTES $where";
        $result = mysql_query($query,conexion::$link);
        if(!$result){
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
        
        $model[ 'nombre' ] = htmlentities($model[ 'nombre' ]);
        $model[ 'correo' ] = htmlentities( $model[ 'correo' ] );
        $model[ 'password' ] = htmlentities( $model[ 'password' ] );
        $model[ 'telefono' ] = htmlentities( $model[ 'telefono' ] );
        $model[ 'telefono2' ] = htmlentities( $model[ 'telefono2' ] );
        $model[ 'celular' ] = htmlentities( $model[ 'celular' ] );
        $model[ 'carrera' ] = htmlentities( $model[ 'carrera' ] );
        
        $query = "UPDATE {$this->con->prefTable}CARRERAS SET NOMBRE = '{$model['nombre']}',CORREO = '{$model[ 'correo' ]}',TELEFONO='{$model[ 'telefono' ]}',TELEFONO2='{$model[ 'telefono2' ]}',CELULAR='{$model[ 'celular' ]}',CARRERA_ID={$model[ 'carrera' ]}, WHERE ID={$model['id']}";
        $result = mysql_query($query,conexion::$link);
        if(!$result){
            Utils::logQryError($query, mysql_error(conexion::$link),__FUNCTION__,__CLASS__);
            return false;
        }
        if (mysql_affected_rows(conexion::$link))
        return true;
        return  false;          
    }

}

?>
