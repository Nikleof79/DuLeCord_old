<?php 
include '../../assets/inc/mysql.php';
function checks($req){
    $ret_data = false;
    if (isset($req['target'])) {
        if (mb_strlen($req['target']) < 25) {
            $mysql = new BulbaSqlConn('../../security/passsql.json');
            $exist = $mysql->query( " 
                SELECT username FROM users WHERE username = '" . $req['target'] . "' 
            ;")->fetch_assoc();
            if ($exist) {
                unset($exist);
                $ret_data = true;
            }
        }
    }
    return $ret_data;
}
$ret_data = null;
$checks = checks($_REQUEST);
if ($checks) {
    $mysql = new BulbaSqlConn('../../security/passsql.json');
    $ret_data = $mysql->query("
        SELECT username,name,about,hasAvatar FROM users WHERE username = '" . $_REQUEST['target'] ."'
    ;")->fetch_assoc();
}
header('Content-type: application/json');
echo json_encode($ret_data);
exit;