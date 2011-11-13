<?php
/** 
 * Clase abstracta principal de los modelos de las entidades
 * @abstract
 * @version 1.0
 * @author Fernando Perez 
 */
abstract class Model {
    /**
     * variable de la conexion de la Base de datos
     * @var
     */
    public $con;
    
    /**
     * metodo constructor de los modelos (solo inicia la conexion)
     * @param none
     * @method
     * 
     */
    public function __construct() {
        $this->con = new conexion();
    }

    /**
     * metodo para agregar una entidad del modelo en cuestion
     * @abstract
     * @param $model: modelo con los atributos para agregar
     * @return boolean: determina si se agrego o no la entidad del modelo
     */
    abstract public function add($model);

    /**
     * metodo para actualizar una entidad del modelo en cuestion
     * @abstract
     * @param $model: modelo con los atributos para agregar
     * @return boolean: determina si se agrego o no la entidad del modelo
     */
    abstract public function update($model);

    /**
     * metodo para eliminar una entidad del modelo en cuestion
     * @abstract
     * @param $model: modelo con los atributos para agregar
     * @return boolean: determina si se agrego o no la entidad del modelo
     */
    abstract public function delete($model);

    /**
     * metodo para buscar una entidad del modelo
     * @abstract
     * @param @var $prkey: primary key de la entidad del modelo
     * @return array: arreglo con los atributos de la entidad del modelo
     */
    abstract public function find($prkey);

    /**
     * metodo para buscar uno o mas entidades del modelo por uno o varios filtros
     * @abstract
     * @param  array $arrBy: arreglo con los campos a filtrar poniendo el nombre del campo en el indice y el valor en el value del arreglo
     * @return array: arreglo con las entidades y sus atributos del modelo
     */
    abstract public function findsome($arrBy);
    
    /**
     * metodo destructor de los modelos (solo cierra la conexion)
     * @param none
     * @method
     * 
     */
    public function __destruct() {
        if (isset(conexion::$link) && is_resource(conexion::$link)) {
            mysql_close(conexion::$link);
        }
    }

}
?>