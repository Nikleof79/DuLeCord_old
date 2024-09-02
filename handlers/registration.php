<?php
session_start();
include '../assets/inc/mysql.php';

function checks($post)
{
    $ret_data = false;
    $_SESSION['reg-mistakes'] = "Unable data";
    if (isset($post['username']) && isset($post['pass']) && isset($post['rePass']) && isset($post['policy'])) { //$session['policy'] is checkbox checks agreement with policy confidentiality
        $_SESSION['reg-mistakes'] = "Passwords not match";
        if ($post['pass'] == $post['rePass']) {
            //in case of adding new checks with username or pass add it here 

            //checking sql injection 
            $_SESSION['reg-mistakes'] = 'Too long username'; 
            if(mb_strlen($post['username'],'UTF-8') < 25){
                $_SESSION['reg-mistakes'] = 'Unable username';
                if (!preg_match("/['\"`]/", $post['username'])) {
                    try {
                        $Mysql = new BulbaSqlConn("../security/passsql.json");

                        $db = $Mysql->query('SELECT * FROM `users` WHERE `username` = "' . $post['username'] . '"')->fetch_assoc();
                    } catch (Exception $e) {
                        $_SESSION['reg-mistakes'] = "Unable to connect to db try later";
                        header("Location: ../start.php");
                        exit();
                    }
                    if (is_array($db)) {
                        $cond = count($db) == 0 ? true : false;
                    } else {
                        $cond = true;
                    }
                    $ret_data = $cond;
                    if (!$cond) {
                        $_SESSION['reg-mistakes'] = "This user exist";
                    }
                    unset($cond);
                }
            }
            
        }
    }
    return $ret_data;
}

$checks = checks($_POST) ? true : false;
if ($checks) {
    $new_data = [
        'username' => $_POST['username'],
        'pass' => $_POST['pass'],
    ];
    $newUsername = $new_data['username'];
    $newName = $new_data['username'];
    $newPass = password_hash($new_data['pass'], PASSWORD_DEFAULT);
    $insert_sql_query = " 
        INSERT INTO users (username,name,password,hasAvatar,about) VALUES ('$newUsername','$newName','$newPass',0,null)
    ;";
    // echo $insert_sql_query;
    $MySql = new BulbaSqlConn("../security/passsql.json");
    $MySql->query($insert_sql_query);

    $_SESSION['logined'] = true;
    $_SESSION['login-data'] = [
        'username' => $_POST['username'],
        'name' => $_POST['username']
    ];
    header("Location: ../index.php");
    exit;
}else{
    header("Location: ../start.php");
    exit;
}