<?php
class DbMySQL{
    var $host         = '';
    var $login        = '';
    var $pass         = '';
    var $name         = '';
    var $db_link      = null;
    var $error_report = true;
    var $sql          = '';

    function DbMySQL($tHost, $tName, $tLogin, $tPass)
    {
        $this->host  = $tHost;
        $this->name  = $tName;
        $this->login = $tLogin;
        $this->pass  = $tPass;
    }

    function connect()
    {
        $this->db_link = mysql_connect($this->host, $this->login, $this->pass);
        if ($this->db_link){
            if(mysql_select_db($this->name)){
                return true;
            }
        }
        return false;
    }

    function _query($tSql)
    {
        $this->sql = $tSql;
        $res = mysql_query($tSql, $this->db_link);
        if (mysql_errno($this->db_link)>0){
            $this->show_error();
        }
        return $res;
    }

    function select($tSql)
    {
        $result = array();
        $res = $this->_query($tSql, $this->db_link);

        if($res){
            while ($row = mysql_fetch_assoc($res)){
                $result[] = $row;
            }
        }else {
            return false;
        }

        return $result;
    }

    function select_row($tSql)
    {
        $result = array();
        $res = $this->_query($tSql, $this->db_link);
        if ($res){
            $tmp = mysql_fetch_assoc($res);
            if (is_array($tmp)){
                $result = $tmp;
            }
        }else{
            return false;
        }
        return $result;
    }

    function query($tSql)
    {
        $res = $this->_query($tSql, $this->db_link);
        return $res;
    }

    function insert($tSql)
    {
        $res = $this->_query($tSql, $this->db_link);
        $last_insert_id = 0;
        if (mysql_errno($this->db_link)==0){
            $last_insert_id = mysql_insert_id($this->db_link);
        }
        return $last_insert_id;
    }

    function close()
    {
        return mysql_close($this->db_link);
    }

    function get_last_error()
    {
        return mysql_error($this->db_link);
    }

    function error()
    {
        return array(
                    'error' => $this->get_last_error(),
                    'sql'   => $this->sql
                    );
    }

    function show_error()
    {
        if ($this->error_report){
            $str = $this->get_last_error();
            echo "Mysql error: [$str] in query: [{$this->sql}]\n";
        }else{
            //echo "While nothing...";
        }
    }
}
?>