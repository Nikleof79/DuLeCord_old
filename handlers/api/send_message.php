<?php 
include '../../assets/inc/mysql.php';


function checks($request) {
    $ret_data = false;
    if (isset($request)) {
        
            $mysql = new BulbaSqlConn('../../security/passsql.json');
            $friends = $mysql->query("
                SELECT * FROM friends WHERE 
                requester = ' " . $_SESSION['login-data']['username'] . "'
                AND reciver = '". $request['reciever']."'
            ;")->fetch_assoc(); 
            $ret_data = !(!$friends); // conversation to bool
    }
    return $ret_data;
}

$checks = checks($_POST);
if ($checks) {
    $MySql = new BulbaSqlConn('../../security/passsql.json');
    $MySql->query("
        INSERT INTO messages () VALUES 
    ;");
}