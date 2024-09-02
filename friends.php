<?php
include './assets/inc/sessCheck.php';
include './assets/inc/mysql.php';
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
    <?php include'./assets/inc/links.php' ?>
    <link rel="stylesheet" href="./assets/css/friends.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-3quater-transparent p-0">
        <div class="container-fluid ps-0">
            <div class="col-8 d-flex justify-content-start pe-3">
                <form action="./handlers/friends.php" method="post" class="d-flex m-2" id="main-form">
                    <input placeholder="username" type="text" name="target_username" class="form-control" id="">
                    <button type="submit" class="btn btn-primary">send</button>
                </form>
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
    <page id="pc-page">
        <main>
            <div id="friends" class="col-10">
            </div>
            <div class="col-2" id="right-side">
                <div id="my-req" class="col-2">
                </div>
                <div id="for-me-req" class="col-2">
                </div>
            </div>
        </main>
    </page>


    <?php
    if(isset($_SESSION['friends-mistake']) && mb_strlen($_SESSION['friends-mistake']) > 1){
        ?>
        <script>
            alert('<?=$_SESSION['friends-mistake']?>');
        </script>
        <?php
        unset($_SESSION['friends-mistake']);
    }
    ?>
    <?php include "./assets/inc/scripts.php" ?>
    <script src="assets/js/friends.js"></script>
</body>

</html>
