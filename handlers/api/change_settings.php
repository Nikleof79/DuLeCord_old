<?php
session_start();
header("Content-type: application/json");
include '../../assets/inc/mysql.php';
$mysql = new BulbaSqlConn('../../security/passsql.json');

function checks($post): bool{
    // $ret_data = false;
    //TODO: checks for this API
    $ret_data = true;
    return $ret_data;
}

if (checks($_REQUEST)) {
    $old_data = get_object_vars(
    json_decode($mysql->query(" 
    SELECT settings FROM users WHERE username = '" . $_SESSION['login-data']['username'] . "' 
    ;")->fetch_assoc()['settings'])
    );
    $new_data = $old_data;
    foreach ($_REQUEST as $key => $value) {
        if (isset($old_data[$key])) {
            $new_data[$key] = $value;
            break;
        }
    }
    if ($new_data != $old_data) {
        $mysql->query("
        UPDATE users
        SET settings = ( ' " .json_encode($new_data)." ' )  
        WHERE username = '" . $_SESSION['login-data']['username'] . "'
        ;");
    }
    echo "succesfully";
}

    exit;