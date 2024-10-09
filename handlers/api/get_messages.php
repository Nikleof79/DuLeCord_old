<?php
session_start();
include '../../assets/inc/mysql.php';


function checks($req){
    $ret_data = false;
    if (isset($req) && isset($req['intercultor'])) {
        if ($_SESSION['logined']) {
            $mysql = new BulbaSqlConn('../../security/passsql.json');
            $is_friend = !(! $mysql->query("
            SELECT reciever FROM friends WHERE requester = '" . $_SESSION['login-data']['username'] . "'
            ")->fetch_assoc() );
            if ($is_friend) {
                $ret_data = true;
            }
        }
    }
    return $ret_data;
}
$ret_data = null;
$checks = checks($_POST);
if ($checks) {
    $MySql = new BulbaSqlConn('../../security/passsql.json');
    $messages = $MySql->query("
        SELECT * FROM messages WHERE (requester = '" . $_SESSION['login-data'] ."' AND reciever = '" . $_POST['intercultor'] . "') 
        OR (reciever = '" . $_SESSION['login-data'] ."' AND requester = '" . $_POST['intercultor'] . "')
    ;");
    $ret_data = [
        'messages' => $messages->fetch_assoc()
    ];
}

header('Content-type: json');
echo json_encode($ret_data);
exit;