<?php
include "../assets/inc/mysql.php";
session_start();

function checks($post){
    $mistake = "";
    $ret_data = false;
    if (isset($post['target_username'])) {
        if (mb_strlen($post['target_username']) < 26){
            $mysql = new BulbaSqlConn("../security/passsql.json");
            $db = $mysql->query("SELECT username FROM users WHERE username = '" . $post['target_username']."';")->fetch_assoc();
            if(is_array($db)){
                if (count($db) > 0){
                    $ret_data = true;
                }else{
                    $mistake = "User not found";
                }
            }else{
                $mistake = "Unable to connect to database. Please buy for our company new server";
            }
        }else{
            $mistake = "Please enter a valid username";
        }
    }else{
        $mistake = "Please enter a username";
    }
    $_SESSION['friends-mistake'] = $mistake;
    return $ret_data;
}
$checks = checks($_POST);
if ($checks){
    $mysql = new BulbaSqlConn("../security/passsql.json");

}else{
    header("Location: friends.php");
    exit();
}
