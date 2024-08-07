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
</head>

<body>
    <h1>Friends page</h1>
    <div id="friends">

    </div>
    <script src="assetss/jquery.js"></script>
    <script src="assetss/friends.js"></script>
</body>

</html>