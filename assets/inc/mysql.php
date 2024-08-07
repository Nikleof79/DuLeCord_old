<?php
function mysqlQuery($query)
{
    // include "../../security/passsql.php";
    $my_sql_data = [
        'servername' => 'localhost',
        'username' => 'dulecord',
        'password' => '16031987',
        'dbname' => 'dulecord'
    ];
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
    private $my_sql_data = [
        'servername' => 'localhost',
        'username' => 'dulecord',
        'password' => '16031987',
        'dbname' => 'dulecord'
    ];
    private $conn;
    public function __construct(){

    }
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