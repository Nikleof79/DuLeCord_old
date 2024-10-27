<?php
session_start();
include '../../assets/inc/mysql.php';


function checks($req){
    $ret_data = false;
    if (isset($req) && isset($req['intercultor'])) {
        if ($_SESSION['logined'] && $_SERVER['REQUEST_METHOD'] == "POST") {
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
// $checks = true;
// $_SESSION['login-data']['username'] = 'nikman78';
// $_POST['intercultor'] = 'copilot';
if ($checks) {
    $MySql = new BulbaSqlConn('../../security/passsql.json');
    $sql = "
        SELECT * FROM messages WHERE (requester = '" . $_SESSION['login-data']['username'] ."' AND reciever = '" . $_POST['intercultor'] . "') 
        OR (reciever = '" . $_SESSION['login-data']['username'] ."' AND requester = '" . $_POST['intercultor'] . "') ORDER BY timestamp
    ;";
    $messages = $MySql->query($sql);
    $ret_data = $messages->fetch_all(MYSQLI_ASSOC);
}

header('Content-type: json');
echo json_encode($ret_data);
exit;   