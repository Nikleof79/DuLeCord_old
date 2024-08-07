<?php
include '../assets/inc/sessCheck.php';
checkSession();
$_SESSION['logined'] = false;
$_SESSION['login-data'] = [];
header('Location: ../start.php');
exit();