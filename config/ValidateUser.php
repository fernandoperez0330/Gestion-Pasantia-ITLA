<?php
/**
 * clase para validar los usuarios de lsistema 
 */
class ValidateUser {
    //
    public $arrUserLevels;
    //
    public $tocompare;
    //
    public $arrSession;
    //
    public static $keylevelSession = "tipo";
    
    /**
     * @param   integer $tocompare  default: 2 (estudiantes)
     * @param   array   $arrSesion
     */
    public function __construct($arrSession,$tocompare = 0){
        $this->arrUserLevels = Config::$arrUserLevels;
        $this->arrSession = $arrSession;
        $this->tocompare = $tocompare;
    }
    
    /**
     * funcion que valida que determina si un usuario esta autorizado segun su nivel
     * @param  Integer  $actual: nivel a comparar
     * @return Boolean
     */
    public function validateLevel(){
        if (!$this->arrSession) 
            return false;
        if ($this->tocompare != 0) 
            return $this->tocompare == $this->arrSession[self::$keylevelSession];
        return true;
    }
}

?>
