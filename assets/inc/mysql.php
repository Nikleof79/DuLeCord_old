<?php
function mysqlQuery($query)
{
    include "../../security/passsql.php";
    // Create connection
    $conn = new mysqli(
        $my_sql_data['servername'],
        $my_sql_data['username'],
        $my_sql_data['password'],
        $my_sql_data['dbname']
    );
    $ret_data = $conn->query($query);
    $conn -> close();
    return $ret_data;
}

class BulbaSqlConn{
    private $jsonString;
    private $my_sql_data;
    public function __construct($path_to_json){
        $this -> jsonString  = file_get_contents($path_to_json);
        $this -> my_sql_data = json_decode($this->jsonString, true);
        unset($this -> jsonString);
    }
    /*
    * makes query to the db using seted data
    *
    *
    */
    function query($query){
        $conn = new mysqli(
            $this->my_sql_data['servername'],
            $this->my_sql_data['username'],
            $this->my_sql_data['password'],
            $this->my_sql_data['dbname']
        );
        $ret_data = $conn->query($query);
        $conn -> close();
        return $ret_data;
    }
}