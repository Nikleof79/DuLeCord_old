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
</head>

<body>
    <?php include "./assets/inc/scripts.php" ?>
</body>

</html>