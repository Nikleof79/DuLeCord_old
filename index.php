<?php
include './assets/inc/sessCheck.php';
checkSession();
if ($_SESSION['logined'] == false) {
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
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
        .dropdown-toggle::after {
            display: none !important;
        }
    </style>
    <!-- <a href="./handlers/LeaveFromAcc.php" class="btn btn-danger">Leave From Account</a> -->
</head>

<body>
    <page id="pc-page">
        <nav class="navbar navbar-expand-lg navbar-dark bg-3quater-transparent">
            <div class="container-fluid ps-0">
                <div class="col-2 d-flex justify-content-center pe-3 bg-3quater-transparent">
                    <h1 class="navbar-brand">Chats</h1>
                </div>
                <div class="collapse navbar-collapse col-8" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
<!--                        <img src="assets/img/test_avatar.png" alt="" id="intercultor-avatar">-->
<!--                        <p alt="" id="intercultor-name" class="m-0">Nikleof</p>-->
                    </ul>
                    <div class="col-2 d-flex justify-content-end pe-2">
                        <a href="friends.php" class="nav-round-btn">
                            <img src="assets/img/friends_logo.png" alt="">
                        </a>
                        <button class="nav-round-btn">
                            <img src="assets/img/chat_logo.png" alt="">
                        </button>

                        <a href="account.php" class="nav-round-btn">
                            <img src="assets/img/account_logo.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <main>
            <div id="friends" class="col-2 bg-2quater-transparent">
                <button class="friend">
                    <img src="assets/img/test_avatar.png" alt="" class="friend-avatar">
                    <h1 class="friend-name">Nikleof</h1>
                </button>
            </div>
            <div id="chatarea" class="col-8 p-2 pt-0">
                <div id="messages">
<!--                    <div class="message messageByIntercultor">-->
<!--                        <img src="assets/img/test_avatar2.png " alt="" class="senderAvatar">-->
<!--                        <div class="d-inline-block">-->
<!--                            <div class="d-flex align-items-center">-->
<!--                                <p class="messageInner">Hi nikleof</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="message messageByMe">-->
<!--                        <img src="assets/img/test_avatar.png " alt="" class="senderAvatar">-->
<!--                        <div class="d-inline-block">-->
<!--                            <div class="d-flex align-items-center">-->
<!--                                <p class="messageInner">-->
<!--                                    Hi <span class="smile-font">👋</span>-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
                <div id="around-textarea">
                    <div id="textarea">
                        <textarea name="" id="textarea-input" placeholder="Start Message In DuLeCord" disabled></textarea>
                        <div id="textarea-btns">
                            <div class="btn-group dropup">
                                <button class="textarea-btn-smile smile-font dropdown-toggle" type="button" id="dropdownMenuButtonSmiles"
                                    data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                    😎
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSmiles">
                                    <div class="smile-font">
                                         <li class="dropdown-item">😎</li>
                                    </div>
                                </ul>
                            </div>
                            <button class="textarea-btn-img" disabled> <img src="assets/img/image_logo.png" alt="" > </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="intercultor-info" class="col-2 bg-2quater-transparent">
<!--                <img src="assets/img/test_avatar.png" alt="" id="intercultor-info-avatar">-->
<!--                <h4 id="intercultor-info-username">Nikleof</h4>-->
<!--                <h4 id="intercultor-info-name"><em>@n1kLe0f</em></h4>-->
<!--                <div class="intercultor-info-about">-->
<!--                    <p id="intercultor-info-about">-->
<!--                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci facilis quia enim eligendi-->
<!--                        corporis quibusdam tempora sit quod voluptatem minima. In blanditiis ea repudiandae animi ad,-->
<!--                        atque officia earum! Doloribus?-->
<!--                    </p>-->
<!--                </div>-->
<!--                an example of intercultor info-->
                <h2 style="align-self: center ; margin-top: 3em" class="text-center">Select a Chat</h2>
            </div>
        </main>
    </page>
    <?php include "./assets/inc/scripts.php" ?>
    <script src="assets/js/index.js"></script>
</body>

</html>