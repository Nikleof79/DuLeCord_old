<?php
include '../../assets/inc/mysql.php';
session_start();

function settings()
{
    $mysql = new BulbaSqlConn('../../security/passsql.json');
    $ret_data = $mysql->query(
        "SELECT settings FROM users WHERE username = '" . $_SESSION['login-data']['username'] . "';"
    )->fetch_assoc();
    return $ret_data['settings'];
}

function friends()
{
    $ret_data = null;
    $mysql = new BulbaSqlConn('../../security/passsql.json');
    $friends = $mysql->query(
        "SELECT requester FROM friends WHERE reciver = '" . $_SESSION['login-data']['username'] . "';"
    )->fetch_all();
    if (is_array($friends)) {
        foreach ($friends as $key => $value) {
            $friend = $mysql->query(
                "SELECT username , name , hasAvatar FROM users WHERE username = '" . $value[0] . "';"
            )->fetch_assoc();
            $ret_data[] = $friend;
        }
    }
    return $ret_data;

}

function requestsFrom()
{
    $ret_data = null;
    $mysql = new BulbaSqlConn('../../security/passsql.json');
    $requests = $mysql->query(
        "SELECT reciver FROM friends_requests WHERE requester = '" . $_SESSION['login-data']['username'] . "';"
    )->fetch_assoc();
    if (is_array($requests)) {
        foreach ($requests as $key => $value) {
            $reciver = $mysql->query(
                "SELECT username , name FROM users WHERE username = '" . $value . "';"
            )->fetch_assoc();
            $ret_data[] = $reciver;
        }
    }
    return $ret_data;
}

function requestsFor()
{
    $ret_data = null;
    $mysql = new BulbaSqlConn('../../security/passsql.json');
    $requests = $mysql->query(
        "SELECT requester FROM friends_requests WHERE reciver = '" . $_SESSION['login-data']['username'] . "';"
    )->fetch_assoc();
    if (is_array($requests)) {
        foreach ($requests as $key => $value) {
            $reciver = $mysql->query(
                "SELECT username , name FROM users WHERE username = '" . $value . "';"
            )->fetch_assoc();
            $ret_data[] = $reciver;
        }
    }
    return $ret_data;
}

function hasAvatar()
{
    $mysql = new BulbaSqlConn('../../security/passsql.json');
    $ret_data = $mysql->query("
    SELECT hasAvatar FROM users WHERE username = '" . $_SESSION['login-data']['username'] . "'
    ;")->fetch_assoc();
    return $ret_data['hasAvatar'];
}

function checks($req) {
    $ret_data = false;
    if (isset($_SESSION) && isset($_SESSION['login-data'])) {
        $ret_data = true;        
    }
    return $ret_data;
}


$checks = checks($_REQUEST);
if ($checks) {
    $ret_data = [
        'login-data' => [
            'username' => $_SESSION['login-data']['username'],
            'name' => $_SESSION['login-data']['name'],
            'hasAvatar' => hasAvatar()
        ],
        'friends' => friends(),
        'requestsFrom' => requestsFrom(),
        'requestsFor' => requestsFor(),
        'settings' => settings()
    ];
}
header('Content-type: application/json');
echo json_encode($ret_data);