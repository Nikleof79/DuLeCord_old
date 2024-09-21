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
    <link rel="stylesheet" href="/assets/css/account.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-3quater-transparent p-0">
        <div class="container-fluid ps-0">
            <div class="col-8 d-flex justify-content-center pe-3 text-center">
                <h1 class="text-center" style="color: white">Profile and settings</h1>
            </div>
            <div class="collapse navbar-collapse col-2" style=" justify-content: flex-end; "
                id="navbarSupportedContent">
                <div class="col-2 d-flex justify-content-end pe-2">
                    <?php include './assets/inc/nav-btns.php' ?>
                </div>
            </div>
        </div>
    </nav>
    <page id="pc-page" class="d-flex">
        <div class="left-bar col-2 text-center">
            <h1>Edit profile</h1>
            <img src="/assets/img/account_logo.png" alt="" class="my-avatar">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AvatarModal">Change Avatar</button>
            <button class="btn btn-primary">Change Display Name</button>
            <button class="btn btn-primary">Change About</button>
            <hr>
            <a href="/handlers/LeaveFromAcc.php" class="btn btn-danger">Leave From Account</a>
            <button class="btn btn-danger">Delete Account</button>
        </div>
        <main class="col-8">
            <img src="/assets/img/account_logo.png" class="my-avatar" alt="">
            <h1 id="user-name">name</h1>
            <h2 class="user-username">@<span id="user-username">username</span></h2>
            <div class="about">
                <p>No info available</p>
            </div>
        </main>
        <div class="right-bar col-2">
            <h1>Change Theme</h1>
            <div>
                <button class="btn btn-primary changer-theme" dulecord-theme="default">Default</button>
                <button class="btn btn-primary changer-theme" dulecord-theme="grape">Grape</button>
                <button class="btn btn-primary changer-theme" dulecord-theme="dark">Dark</button>
                <button class="btn btn-primary changer-theme" dulecord-theme="aqua">Aqua</button>
            </div>
        </div>
        <!-- Avatar Modal -->
        <div class="modal fade" id="AvatarModal" tabindex="-1" aria-labelledby="AvatarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" style="color: black; " id="AvatarModalLabel">Change Avatar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/handlers/upload_avatar.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body text-center">
                        <input type="file" name="avatar" id="avatar-file-input" style="color: black;" value=" ">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button class="btn btn-primary" type="submit">Submit</button> -->
                         <input type="submit" value="submit" class="btn btn-primary">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </page>
    <?php include "./assets/inc/scripts.php" ?>
    <script src="assets/js/account.js"></script>
</body>

</html>