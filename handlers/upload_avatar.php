<?php
session_start();
include '../assets/inc/resize_img.php';
include '../assets/inc/mysql.php';

$avaible_types = ['image/png', 'image/jpg', 'image/webp', 'image/jpeg'];

function checks($file)
{
    $ret_data = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['avatar'])) {
        $ret_data = true;
    }
    return $ret_data;
}

if (checks($_FILES['avatar'])) {
    $dest = __DIR__ . '/../avatars/' . $_SESSION['login-data']['username'] . '.jpg';
    $target_size = 64;//px
    $resized_image = resizeImage($_FILES['avatar']['tmp_name'],$target_size,$target_size);
    imagejpeg($resized_image,$dest);
    $mysql = new BulbaSqlConn('../security/passsql.json');
    $mysql->query("
    UPDATE users 
    SET hasAvatar = 1 
    WHERE username = '" . $_SESSION['login-data']['username'] . "' 
    ;");
}

header("Location: /account.php");
exit;

// if ($_SERVER['REQUEST_METHOD'] != 'POST') {
//     header('Location: /test.html ');
//     exit;
// }

// $types = ['image/png','image/jpg','image/webp','image/jpeg'];

// if (! in_array($_FILES['avatar']['type'] , $types)) {
//     header('Location: /test.html ');
//     exit;
// }

// $filename = $_FILES['avatar']['name'];

// $dest = __DIR__ . '/../avatars/' . $filename;

// move_uploaded_file($_FILES['avatar']['tmp_name'],$dest);

// header("Location: /test.html");