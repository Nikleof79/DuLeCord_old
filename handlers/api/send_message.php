<?php
session_start();
include '../../assets/inc/mysql.php';

function checks($request)
{
    $ret_data = false;
    if (isset($request) && isset($request['reciever']) && isset($request['body'])) {
        if ($_SESSION['logined']) {

            $mysql = new BulbaSqlConn('../../security/passsql.json');
            $friends = $mysql->query("
                SELECT * FROM friends WHERE 
                requester = '". $_SESSION['login-data']['username'] ."'
                AND reciver = '". $request['reciever'] ."'
            ;")->fetch_assoc();
            $ret_data = !(!$friends); // conversation to bool

        }
    }
    return $ret_data;
}
$ret_data = [
    'result'=>false
];
$checks = checks($_POST);
if ($checks) {
    $MySql = new BulbaSqlConn('../../security/passsql.json');
    $sql = "INSERT INTO messages (body, requester, reciever) VALUES ('" . $_POST['body'] . "','" . $_SESSION['login-data']['username'] . "' , ' " . $_POST['reciever'] . "');";
    $MySql->query("
        INSERT INTO messages (body, requester, reciever) 
        VALUES ('" . $_POST['body'] . "' '" . $_SESSION['login-data']['username'] . "' , ' " . $_POST['reciever'] . "')
    ;");
    $ret_data['result' ] = true;
}
header('Content-type: application/json');
echo json_encode($ret_data);
exit;