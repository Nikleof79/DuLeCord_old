<?php
session_start();
include '../../assets/inc/mysql.php';

function checks($request)
{
    $ret_data = false;
    if (isset($request)) {
        if ($_SESSION['logined']) {

            $mysql = new BulbaSqlConn('../../security/passsql.json');
            $friends = $mysql->query("
                SELECT * FROM friends WHERE 
                requester = ' " . $_SESSION['login-data']['username'] . "'
                AND reciver = '" . $request['reciever'] . "'
            ;")->fetch_assoc();
            $ret_data = !(!$friends); // conversation to bool

        }
    }
    return $ret_data;
}

$checks = checks($_POST);
if ($checks) {
    $MySql = new BulbaSqlConn('../../security/passsql.json');
    $MySql->query("
        INSERT INTO messages (body, requester, reciever) 
        VALUES ('" . $_POST['body'] . "' '" . $_SESSION['login-data']['username'] . "' , ' " . $_POST['reciever'] . "')
    ;");
    echo json_encode(
        [
            ['result']=>true
        ]
    );
}else{
    echo json_encode(
        [
            ['result']=>false
        ]
    );
}
exit;