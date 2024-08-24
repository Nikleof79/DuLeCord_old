<?php
session_start();
include '../../assets/inc/mysql.php';

function checks($post)
{
    $ret_data = false;
    if (isset($post)){
        if ($post != $_SESSION['login-data']['username']){
            $mysql = new BulbaSqlConn('../../security/passsql.json');
            $user = $mysql->query("
            SELECT * FROM users where username = '" . $post['target_username'] ."'
            ;")->fetch_assoc();
            if (is_array($user)){
                $ret_data = true;
            }
        }
    }
    return $ret_data;
}

$checks = checks($_POST);
if ($checks == true) {
    $mysql = new BulbaSqlConn('../../security/passsql.json');
    $mysql->query("
    DELETE FROM friends_requests WHERE requester = '" . $_POST['target_username'] . "' AND reciver = '" . $_SESSION['login-data']['username'] . "'
    ;");
    $mysql->query("
    INSERT INTO friends (requester, reciver) VALUES ('" . $_POST['target_username'] . "', '" . $_SESSION['login-data']['username'] . "') ;
    INSERT INTO friends (requester, reciver) VALUES ('" . $_SESSION['login-data']['username'] . "', '" . $_POST['target_username'] . "') ;
    ");
    echo "successfully";
}
