<?php
session_start();
include '../../assets/inc/mysql.php';

function checks($post) {
    $ret_data = false;
    if(isset($post['target_username'])){
        $mysql = new BulbaSqlConn('../../security/passsql.json');
        $sql = "
            SELECT * FROM users WHERE username =  '" . $post['target_username'] . "';
        ";
        $result = $mysql->query($sql)->fetch_assoc();
        if (is_array($result)) {
            $ret_data = true;
        }
    }
    return $ret_data;
}

$checks = checks($_POST);
if ($checks) {
    $mysql = new BulbaSqlConn('../../security/passsql.json');
    $mysql->query("
    DELETE FROM friends WHERE (requester = '" . $_SESSION['login-data']['username'] . "' AND reciver = '" . $_POST['target_username'] . "')
     OR ( requester = '" . $_POST['target_username'] . "' AND reciver = '" . $_SESSION['login-data']['username'] . "' )
    ;");
    $cond =
    $mysql->query(" SELECT * FROM friends_requests WHERE requester = '" . $_POST['target_username'] . "' 
    AND reciver =  '" . $_SESSION['login-data']['username'] . "'")->fetch_assoc() ;
    if (is_array($cond)){
        $mysql->query("
            INSERT INTO friends_requests (requester, reciver) VALUES ('" . $_POST['target_username'] . "', '" . $_SESSION['login-data']['username'] . "') 
        ;");
    }
}
echo "successfully";