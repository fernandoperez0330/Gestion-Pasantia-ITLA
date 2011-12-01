<?php

/**
 * Clase para modelo de las solicitudes de pasantias
 * @version 1.0
 * @author Fernando Perez
 */
class ModelRequests extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function add($model) {
        $model['estudiante_id'] = $model['estudiante_id'] + 0;
        $model['pasantia_id'] = $model['pasantia_id'] + 0;
        $model['estatus'] = mysql_escape_string(htmlentities(strip_tags($model['estatus'])));

        $query = "INSERT INTO {$this->con->prefTable}solicitudes(ESTUDIANTE_ID,PASANTIA_ID,ESTATUS)" .
                "VALUES({$model['estudiante_id']},{$model['pasantia_id']},'{$model['estatus']}')";
        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link))
            return true;
        return false;
    }

    public function delete($model) {
        $model['id'] = $model['id'] + 0;
        $query = "DELETE FROM {$this->con->prefTable}solicitudes WHERE ID = {$model['id']}";
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
        $query = "SELECT ID,ESTUDIANTE_ID,PASANTIA_ID,ESTATUS FROM {$this->con->prefTable}solicitudes WHERE ID=$prkey";
        $result = mysql_query($query);
        if (!$result) {
            return false;
        }
        $request = array();
        $numRows = mysql_num_rows($result);
        if ($numRows != 0)
            $request = mysql_fetch_assoc($result);
        return $request;
    }

    public function findsome($arrBy) {
        $where = "";
        foreach ($arrBy as $field => $value) {
            $value = htmlentities($value);
            $where .= $where == "" ? "$field = $value" : " AND $field = $value";
        }
        $where = $where != "" ? "WHERE $where" : "";
        $query = "SELECT S.ID,S.ESTUDIANTE_ID,S.PASANTIA_ID,S.ESTATUS,E.NOMBRE ESTUDIANTE,P.NOMBRE PASANTIA,EM.NOMBRE EMPRESA FROM {$this->con->prefTable}solicitudes S " .
                "INNER JOIN {$this->con->prefTable}estudiantes E on S.ESTUDIANTE_ID = E.ID " .
                "INNER JOIN {$this->con->prefTable}pasantias P on s.PASANTIA_ID = P.ID " .
                "INNER JOIN {$this->con->prefTable}empresas EM on p.empresa_id = EM.ID " .
                "$where";
        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        $numRows = mysql_num_rows($result);
        $arrRequests = array();
        if ($numRows != 0) {
            while ($row = mysql_fetch_assoc($result)) {
                $arrRequests[] = $row;
            }
        }
        return $arrRequests;
    }

    public function update($model) {
        $model['id'] = $model['id'] + 0;
        $model['pasantia_id'] = $model['pasantia_id'] + 0;
        $model['estatus'] = mysql_escape_string(htmlentities(strip_tags($model['estatus'])));
        echo $query = "UPDATE {$this->con->prefTable}solicitudes SET PASANTIA_ID ={$model['pasantia_id']},ESTATUS='{$model['estatus']}' WHERE ID={$model['id']}";
        $result = mysql_query($query, $this->con->link);
        if (!$result) {
            Utils::logQryError($query, mysql_error($this->con->link), __FUNCTION__, __CLASS__);
            return false;
        }
        if (mysql_affected_rows($this->con->link))
            return true;
        return false;
    }

}

?>
