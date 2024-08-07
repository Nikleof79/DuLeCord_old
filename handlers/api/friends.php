<?php

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
$app = new BulbaApp();

$app.req('/',function($req,$res){
    if ($_SESSION['logined']){
        $mysql = new BulbaSqlConn();
        $friends = $mysql->query("SELECT 'requester','reciver' FROM 'friends' WHERE 'is_request' = 0 AND 'requester'=' " . $_SESSION['username'] . "' ");
        $ret_data = [
            'friends'=>[

            ],
            'user_data'=>[
                'username'=>$_SESSION['username'],
                'name'=>$_SESSION['name']
            ],
        ];
        $res->sendJson();
    }
});