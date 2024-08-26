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
if ($checks) {
    $mysql = new BulbaSqlConn('../../security/passsql.json');
    $mysql->query("
    DELETE FROM friends_requests WHERE requester = '" . $_POST['target_username'] . "' AND reciver = '" . $_SESSION['login-data']['username'] . "'
    ;");
    $sql_query = "
    INSERT INTO friends (requester, reciver) VALUES ('" . $_POST['target_username'] . "', '" . $_SESSION['login-data']['username'] . "') ;
    ";
    $mysql->query($sql_query);
    $sql_query = "
        INSERT INTO friends (requester, reciver) VALUES ('" . $_SESSION['login-data']['username'] . "', '" . $_POST['target_username'] . "') ;
    ";
    $mysql->query($sql_query);
    echo "successfully";
}
