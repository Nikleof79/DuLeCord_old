<?php
include './assets/inc/sessCheck.php';
checkSession();
if (!$_SESSION['logined']) {
    header("Location: start.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "./assets/inc/links.php"; ?>
    <link rel="stylesheet" href="./assets/css/account.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-3quater-transparent p-0">
    <div class="container-fluid ps-0">
        <div class="col-8 d-flex justify-content-center pe-3 text-center">
            <h1 class="text-center" style="color: white">Profile and settings</h1>
        </div>
        <div class="collapse navbar-collapse col-2" style=" justify-content: flex-end; " id="navbarSupportedContent">
            <div class="col-2 d-flex justify-content-end pe-2">
                <button class="nav-round-btn">
                    <img src="assets/img/friends_logo.png" alt="">
                </button>
                <a href="index.php" class="nav-round-btn">
                    <img src="assets/img/chat_logo.png" alt="">
                </a>
                <a href="account.php" class="nav-round-btn">
                    <img src="assets/img/account_logo.png" alt="">
                </a>
            </div>
        </div>
    </div>
</nav>
<?php include "./assets/inc/scripts.php" ?>
<script src="assets/js/dataFromBack.js"></script>
<script src="assets/js/account.js"></script>
</body>

</html>