<?php
session_start();
include('../assets/inc/mysql.php');

//👍 good job
try{
$MySql = new BulbaSqlConn("../security/passsql.json");
$query_result = $MySql ->query("SELECT * FROM users WHERE username ='" . $_POST['username'] . "';")->fetch_array();
}catch(Exception $e){
    $_SESSION['login-mistakes'] = "Unable to connect to database , try again later";
    header("Location: /start.php");
    exit();
}

// $query_result = [];
if (is_array($query_result)) {
    if (password_verify($_POST['pass'], $query_result['password'])) {
        //User Was Logined Success
        $_SESSION['logined'] = true;
        $_SESSION['login-data'] = [
            'username' => $_POST['username'],
            'name' => $query_result['name'],
        ];
        header("Location: /index.php");
        exit();
    }else{
        $_SESSION['login-mistakes'] = "not right login or password";
    }
}else {
    $_SESSION['login-mistakes'] = "Unable to connect to database , try again later";
}
header("Location: /start.php");
exit();
