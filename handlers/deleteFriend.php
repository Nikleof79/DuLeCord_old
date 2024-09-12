<?php
include '../assets/inc/mysql.php';

session_start();

function checks($post)
{
    $ret_data = false;
    if (isset($post['target_username']) && isset($_SESSION['logined'])){
        $mysql = new BulbaSqlConn('../security/passsql.json');
        $target_user = $mysql->query(
            "SELECT * FROM users WHERE username=". $post['target_username'] .";"
        ) -> fetch_assoc();
        if (is_array($target_user)){
            if (count($target_user) > 0){
                $ret_data = true;
            }
        }
    }
    return $ret_data;
}


if (checks($_POST)){
    $post = $_POST;
    $mysql = new BulbaSqlConn('../security/passsql.json'); ;
    $mysql->query(
        "DELETE FROM friends WHERE ( 
                    requester =  ' "  .  $post['target_username'] .  " ' 
                    AND reciver = '"  . $_SESSION['login-data']['username'] . "' )
                    OR ( requester = ' " . $_SESSION['login-data']['username'] . " ' 
                    AND reciver = '" . $post['target_username'] . "' )"
    );
    $mysql->query("
                    INSERT INTO friends_requests ( requester, reciver ) 
                    VALUES ('" . $_SESSION['login-data']['username'] . "', '" . $post['target_username'] . "' );
                ");
}
header('location: /friends.php');