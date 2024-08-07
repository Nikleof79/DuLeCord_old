<?php
session_start();
include('../assets/inc/mysql.php');

// $_POST['username'];
// $_POST['pass'];

//TODO : Login system
try{
$MySql = new BulbaSqlConn();
$query_result = $MySql ->query("SELECT * FROM users WHERE username ='" . $_POST['username'] . "';")->fetch_array();
}catch(Exception $e){
    $_SESSION['login-mistakes'] = "Unable to connect to database , try again later";
    header("Location: /start.php");
    exit();
}
// print_r($query_result);
// echo $query_result;

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
