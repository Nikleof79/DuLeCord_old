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
    <title>DuLeCord</title>
</head>

<body>
    <h1>Friends page</h1>
    <div id="friends">

    </div>
    <div id="my-req">

    </div>
    <div id="for-me-req">

    </div>
    <form action="./handlers/friends.php" method="post">
        <h1>Throw request</h1>
        <input placeholder="username" type="text" name="target_username" id="">
        <br><button type="submit">send</button>
    </form>
    <?php
    if(isset($_SESSION['friends-mistake'])) {
        ?>
        <script>
            alert('<?=$_SESSION['friends-mistake']?>');
        </script>
        <?php
        unset($_SESSION['friends-mistake']);
    }
    ?>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/friends.js"></script>
</body>

</html>
