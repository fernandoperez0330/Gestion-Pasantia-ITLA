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
        
        $model[ 'nombre' ] =  htmlentities( $model[ 'nombre' ] );
        $model[ 'descripcion' ] - htmlentities( $model[ 'nombre' ] );
        
        $query  = "INSERT INTO {$this->con->prefTable} CARRERAS( NOMBRE,DESCRIPCION )".
                "VALUES('{$model[ 'nombre' ]}','{$model[ 'descripcion' ]}')";
                
        $result = mysql_query( $query );
        if( !($result) )
        {
            Utils::logQryError( $query,mysql_error( conexion::$link),__FUNCTION__,__CLASS__ );
            return false;
        }
        if( mysql_affected_rows( conexion::$link) )
                return true;
                return false;
        
    }

    public function delete($model) {
        
        $model[ 'id' ] =  htmlentities( $model[ 'id' ] );
        
        $query  = "DELETE FROM {$this->con->prefTable} CARRERAS WHERE ID={$model[ 'id' ]}";
        $result = mysql_query( $query );
        if( !($result) )
            return false;
        if( mysql_affected_rows( conexion::$link ) )
                return true;
                return false;           
    }

    public function find($prkey) {
        
        $prkey += 0;
        $query = "SELECT ID,NOMBRE,DESCRIPCION FROM {$this->con->prefTable}CARRERAS WHERE ID={ $prkey }";
        $result = mysql_query( $query );
        
        if( !($result) )
            return false;
        
        $carreras = array();
        if( mysql_num_rows !=0 )
        $carreras = mysql_fetch_assoc( $result );
        
        return $carreras;
        
    }

    public function findsome($arrBy) {
        
        $where = "";
        
        foreach( $arrBy as $field => $value )
        {
            $value = htmlentities( $value );
            $where .= $where == "" ? " $field = $value " : " AND $field = $value ";            
        }
        $where = $where == "" ? "" :" WHERE  $where ";
        $query = "SELECT ID,NOMBRE,DESCRIPCION FROM {$this->con->prefTable}CARRERAS $where";
        
        $result = mysql_query( $query );
        if( !($result) )
            return false;
        
        $carreras = array();
        if( mysql_num_rows( $result ) !=0 )
          while( $row = mysql_fetch_assoc( $result ) )
            $carreras[] = $row;
        
        return $carreras;
    }

    public function update($model) {
        
        $model[ 'nombre' ] = htmlentities( $model[ 'nombre' ] );
        $model[ 'descripcion' ] = htmlentities( $model[ 'descripcion' ] );
        
        $query = "UPDATE {$this->con->prefTable} CARRERAS SET NOMBRE='{$model[ 'nombre' ]}',DESCRIPCION='{$model[ 'descripcion' ]}' WHERE ID={$model[ 'id' ]}";
        $result = mysql_query( $query );
        
        if( !($result) )
        {
            Utils::logQryError( $query,mysql_error,__FUNCTION__,__CLASS__);
            return false;
        }        
        
        if( mysql_affected_rows( conexion::$link ) )
            return true;
            return false;         

    }

}

?>
