<?php
session_start();
include '../../assets/inc/mysql.php';


function checks($req){
    $ret_data = false;
    if (isset($req) && isset($req['intercultor'])) {
        if ($_SESSION['logined']) {
            $mysql = new BulbaSqlConn('../../security/passsql.json');
            $sql = "
            SELECT reciver FROM friends WHERE requester = '" . $_SESSION['login-data']['username'] . "'
            ";
            $is_friend = !(! $mysql->query($sql)->fetch_assoc() );
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
    $sql = "
        SELECT * FROM messages WHERE (requester = '" . $_SESSION['login-data']['username'] ."' AND reciever = '" . $_POST['intercultor'] . "') 
        OR (reciever = '" . $_SESSION['login-data']['username'] ."' AND requester = '" . $_POST['intercultor'] . "') ORDER BY timestamp
    ;";
    $messages = $MySql->query($sql);
    $ret_data = [
        'messages' => $messages->fetch_all()
    ];
}

header('Content-type: json');
echo json_encode($ret_data);
exit;