<?php
/**
 * Clase conexion: para administracion de la conexion de la dbms (MYSQL)
 * @version 1.0
 * @author Fernando Perez
 */
class conexion {
    /**
     * @var $host: contiene el nombre del servidor de la base de datos
     */
    var $host;
    /**
     * @var $username: contiene el nombre de usuario de la base de datos
     */
    var $username;
    /**
     * @var $password: contiene el contrasena del usuario de la base de datos
     */
    var $password;
    /**
     * @var $dbname: contiene el nombre de la base de datos a utilizar
     */
    var $dbname;
    /**
     * @var $prefTable: contiene el prefijo de las tablas de la base de datos a utilizar
     */
    var $prefTable;
    /**
     * @var static $link: contiene el enlace de la base de datos
     */
    static $link;

    
    /**
     * @method __construct: metodo constructor de la clase conexion que inicia la conexion y la guarga en la variable estatica $link
     * @param  none
     */
    function __construct() {
        $this->host = Config::$dbHost;
        $this->username = Config::$dbUsername;
        $this->password = Config::$dbPassword;
        $this->dbname = Config::$dbName;
        $this->prefTable = Config::$prefTable;
        $this->connect();
    }

    /**
     * @method connect: metodo para realizar la conexion (Mysql)
     * @param  none
     * @return boolean si se realizo la conexion o no
     */
    function connect() {
        self::$link = mysql_connect($this->host, $this->username, $this->password);
        if (self::$link) {
            if (!mysql_select_db($this->dbname, self::$link))
                return false;
        }else
            return false;

        return true;
    }
}
?>