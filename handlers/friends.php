<?php
include "../assets/inc/mysql.php";
session_start();

function checks($post)
{
    $mistake = "";
    $ret_data = false;
    if (isset($post['target_username'])) {
        if (mb_strlen($post['target_username']) < 26) {
            $mysql = new BulbaSqlConn("../security/passsql.json");
            $db = $mysql->query("SELECT username FROM users WHERE username = '" . $post['target_username'] . "';")->fetch_assoc();
            if (is_array($db)) {
                if (count($db) > 0) {
                    $ret_data = true;
                } else {
                    $mistake = "User not found";
                }
            } else {
                $mistake = "Unable to connect to database. Please buy for our company new server";
            }
        } else {
            $mistake = "Please enter a valid username";
        }
    } else {
        $mistake = "Please enter a username";
    }
    $_SESSION['friends-mistake'] = $mistake;
    return $ret_data;
}


$checks = checks($_POST);
if ($checks) {
    $mysql = new BulbaSqlConn("../security/passsql.json");
    //checking for existing other request by our target
    $sql_query = "
    SELECT * FROM friends_requests WHERE requester = '" . $_POST["target_username"] . "' 
    AND reciver = '" . $_SESSION['login-data']['username'] . "';";

    $requests = $mysql->query(
        $sql_query
    )->fetch_assoc();
    unset($sql_query);
    if ($requests == null) {
        //its case when our target-username hasn't queries to our user(saved is session)
        $sql_query = "
        SELECT * FROM friends_requests WHERE requester = '" . $_SESSION['login-data']['username'] . "' 
        AND reciver = '" . $_POST['target_username'] . "';";

        $requests = $mysql->query($sql_query)->fetch_assoc();
        if ($requests == null) {
            $sql_query = "
            INSERT INTO friends_requests(requester, reciver) VALUE ('" . $_SESSION['login-data']['username'] . "', '" . $_POST['target_username'] . "');
            ";
            $mysql->query($sql_query);
        }else{
            $_SESSION['friends-mistake'] = "You threw request to " . $_POST['target_username'];
        }
    } else {
        //its case when they will become a friends(target user and saved is session)
        //clear requests
        $sql_query = "
        DELETE FROM friends_requests 
        WHERE (requester = '" . $_SESSION['login-data']['username'] . "' 
        AND reciver = '" . $_POST['target_username'] . "')
        OR ( requester = '" . $_POST['target_username'] . "' 
        AND reciver = '" . $_SESSION['login-data']['username'] ."' );
        ";
        $mysql->query($sql_query);
        //add to db new friends
        $sql_queries = ["
        INSERT INTO friends(requester, reciver) 
        VALUE ( '" . $_POST['target_username'] ."' , '" . $_SESSION['login-data']['username'] . "');"
        , "
        INSERT INTO friends(requester, reciver) 
        VALUE ( '" . $_SESSION['login-data']['username'] ."' , '" . $_POST['target_username'] . "');"
        ];
        $mysql->query($sql_queries[0]);
        $mysql->query($sql_queries[1]);
        $_SESSION['friends-mistake'] = "Now you are friends with " . $_POST['target_username'];
    }
}
header("Location: ../friends.php");
exit();