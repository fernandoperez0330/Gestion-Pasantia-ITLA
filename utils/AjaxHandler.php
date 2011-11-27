<?php
/**
 * Clase para manejar los archivos que utilizaran ajax
 * @version 1.0
 * @author Fernando Perez
 */
class AjaxHandler {
   
    /**
     * varible prinicpal de la clase
     */
    private $arrReturn;
    
    /**
     * funcion constructor de la clase
     */
    public function __construct() {
        $this->arrReturn = array("return"=>false,"redirect"=>"");
    }
    
    /**
     * funcion que retorna los valores de retorno a json
     * @param   none    none        : none
     * @return  JSON                : los valores del arreglo convertido en formato JSON
     */
    public function toJSON(){
        return json_encode($this->arrReturn);
        
    }
    
    /**
     * funcion que agrega o actualiza el valor de un indice del arreglo de retorno
     * @param   string  $key        : indice del arreglo a agregar o actualizar
     * @param   string  $value      : valor a asignar al indice en cueestion
     * @return                      : none
     */
    public function setAt($key,$value){
        $this->arrReturn[$key] = $value;
    }
    
    
    /**
     * funcion destructor de la clase
     */
    public function __destruct(){
        unset($this->arrReturn);
    }
}

?>
