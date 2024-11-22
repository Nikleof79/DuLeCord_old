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
                        <img src="./assets/img/account_logo.png" class="intercultor-header-data"
                            id="intercultor-avatar">
                        <p alt="" id="intercultor-name" class="intercultor-header-data" class="m-0">Nikleof</p>
                    </ul>
                    <div class="col-2 d-flex justify-content-end pe-2">
                        <?php include './assets/inc/nav-btns.php' ?>
                    </div>
                </div>
            </div>
        </nav>
        <main>
            <div id="friends" class="col-2 bg-2quater-transparent">
                <!-- <button class="friend">
                <img src="assets/img/account_logo.png" alt="" class="friend-avatar">
                <h1 class="friend-name">Nikleof</h1>
            </button> -->
            </div>
            <div id="chatarea" class="col-8 p-2 pt-0">
                <div id="messages">
                    <!-- <div class="message messageByIntercultor">
                        <img src="assets/img/test_avatar2.png " alt="" class="senderAvatar">
                        <div class="d-inline-block">
                            <div class="d-flex align-items-center">
                                <p class="messageInner">Hi nikleof</p>
                            </div>
                        </div>
                    </div>
                    <div class="message messageByMe">
                        <img src="assets/img/test_avatar.png " alt="" class="senderAvatar">
                        <div class="d-inline-block">
                            <div class="d-flex align-items-center">
                                <p class="messageInner">
                                    Hi <span class="smile-font">👋</span>
                                </p>
                            </div>
                        </div> -->
                    <!-- </div> -->
                </div>
                <div id="around-textarea">
                    <div id="textarea" style="height: 56.8px;">
                        <!-- <form id="textarea-form"> -->
                        <textarea name="" style="" class="textarea-element" id="textarea-input"
                            placeholder="Start Message In DuLeCord" disabled></textarea>
                        <div id="textarea-btns">
                            <div class="btn-group dropup">
                                <button class="textarea-btn-smile textarea-element smile-font dropdown-toggle"
                                    type="button" id="dropdownMenuButtonSmiles" data-bs-toggle="dropdown"
                                    aria-expanded="false" disabled>
                                    😎
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSmiles">
                                    <div class="smile-font" id="DropdownMenuSmiles-body" onload="load_emojies">

                                    </div>
                                </ul>
                            </div>
                            <button class="textarea-btn-img textarea-element" id="textarea-submit" disabled>
                                <!-- <img src="assets/img/image_logo.png" alt=""> -->
                                <p>S</p>

                            </button>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
            <div id="intercultor-info" class="col-2 bg-2quater-transparent">
                <div class="w100" id="intercultor-full-info" style="margin-bottom: 10em; align-items: center;">
                    <img style="justify-self: center" src="assets/img/account_logo.png" alt=""
                        id="intercultor-info-avatar">
                    <h4 class="text-center" id="intercultor-info-username">Nikleof</h4>
                    <h4 class='text-center' id="intercultor-info-name">@n1kLe0f</h4>
                    <div class="intercultor-info-about">
                        <p id="intercultor-info-about">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci facilis quia enim eligendi
                            corporis quibusdam tempora sit quod voluptatem minima. In blanditiis ea repudiandae animi
                            ad,
                            atque officia earum! Doloribus?
                        </p>
                    </div>
                </div>
                <!-- an example of intercultor info -->
                <h2 id="select-chat-info-text" style="align-self: center ; margin-bottom: 10em" class="text-center">Select a Chat</h2>
            </div>
        </main>
    </page>
    <page id="mobile-page">
        <page id="chatarea-mobile">

        </page>
        <page id="index-mobile">
            <nav class="mobile-navbar">
                <?php include "./assets/inc/nav-btns.php"; ?>
            </nav>
            <div id="friends-mobile">
                <div class="friend-mobile">

                </div>
            </div>
        </page>
    </page>
    <?php include "./assets/inc/scripts.php" ?>
    <script src="/assets/js/index.js"></script>
    <script>
        const load_emojies = () => {
            const blocks = {
                "emoji": (emoji) => {
                    return `
                    <li><button class="dropdown-item emoji-button">${emoji}</button></li>
                    `;
                }
            }
            const emoji_ranges = [
                [0x1F600, 0x1F64F], // Смайлики и эмоции
                [0x1F300, 0x1F5FF], // Символы и пиктограммы
                [0x1F680, 0x1F6FF], // Транспорт и символы
                [0x1F700, 0x1F77F], // Алхимия
                [0x2600, 0x26FF],   // Разное (символы)
                [0x2700, 0x27BF],   // Дополнительные символы
                [0x1F900, 0x1F9FF], // Дополнительные эмодзи
                [0x1FA70, 0x1FAFF], // Дополнительные объекты
                [0x1F1E6, 0x1F1FF], // Флаги (регионы)
            ];

            // Заполнение массива смайликов
            emoji_ranges.forEach(([start, end]) => {
                for (let i = start; i <= end; i++) {
                    const emoji = String.fromCodePoint(i);
                    console.log(i + " : " + emoji);
                    // $("DropdownMenuSmiles-body").append(blocks.emoji());
                }
            });
            $(".emoji-button").click(()=>{
                $("textarea").val($("textarea").val() + $(this).text() );
            });
            
        }

    </script>
</body>

</html>