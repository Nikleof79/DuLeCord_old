<?php
session_start();
function checkSession() {
    if(!isset($_SESSION['logined'])) {
        $_SESSION['logined'] = false;
    }
    if(!isset($_SESSION['login-data'])) {
        $_SESSION['login-data'] = [];
    }
}