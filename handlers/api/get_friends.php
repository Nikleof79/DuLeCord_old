<?php
session_start();
require_once "../../assets/inc/mysql.php";
require_once "../../library/bulbaPHP.php";

//function sendResponse($status,$data){
//    header("Content-type: application/json");
//    if ($status === 200){
//        http_response_code(200);
//        echo json_encode($data);
//    }else{
//        http_response_code(403);
//    }
//    exit;
//}
// https://github.com/Nikleof79/bulbaPHP
    if ($_SESSION['logined']) {
        $mysql = new BulbaSqlConn("../../security/passsql.json");
        $sql_query = "SELECT * FROM friends WHERE requester='" . $_SESSION['login-data']['username'] . "' OR reciver = '" . $_SESSION['login-data']['username'] . "';";
        $friends = $mysql->query($sql_query)->fetch_assoc();
        $sql_query = "SELECT * FROM friends_requests WHERE requester='" . $_SESSION['login-data']['username'] . "';";
        $requestsFrom = $mysql->query($sql_query)->fetch_assoc();
        $sql_query = "SELECT * FROM friends_requests WHERE reciver='" . $_SESSION['login-data']['username'] . "';";
        $requestsTo = $mysql->query($sql_query)->fetch_assoc();
        $ret_data = [
            'friends' => [
                $friends
            ],
            "requestFrom"=>[
                $requestsFrom
            ],
            "requestTo"=>[
                $requestsTo
            ],
            'user_data' => [
                'username' => $_SESSION['login-data']['username'],
                'name' => $_SESSION['login-data']['name']
            ],
        ];
        header('Content-type: application/json');
        echo json_encode($ret_data);
        exit;
    }