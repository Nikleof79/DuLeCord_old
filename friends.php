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
    <nav class="navbar navbar-expand-lg navbar-dark bg-3quater-transparent">
        <div class="container-fluid ps-0">
            <div class="col-2 d-flex justify-content-center pe-3 bg-3quater-transparent">
                <form action="./handlers/friends.php" method="post" class="d-flex">
                    <input placeholder="username" type="text" name="target_username" id="">
                    <button type="submit">send</button>
                </form>
            </div>
            <div class="collapse navbar-collapse col-8" id="navbarSupportedContent">
                <div class="col-2 d-flex justify-content-end pe-2">
                    <a href="friends.php" class="nav-round-btn">
                        <img src="assets/img/friends_logo.png" alt="">
                    </a>
                    <button class="nav-round-btn">
                        <img src="assets/img/chat_logo.png" alt="">
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div id="friends" class="col-10">
<!--            <div class="friend">
                <h1 class="friend-name">Timonyt</h1>
                <div class="friend btns">
                    <button class="friend-btn smile-font friend-deleter" >❎</button>
                </div>
         </div>-->
        </div>
        <!--    <div id="my-req">-->
        <!--    </div>-->
        <div id="for-me-req" class="col-2">

        </div>
    </main>


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
<!--    <script src="assets/js/friends.js"></script>-->
</body>

</html>
