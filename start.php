<?php
// session_start();
include './assets/inc/sessCheck.php';
checkSession();





?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DuLeCord</title>
    <?php
    include './assets/inc/links.php'
        ?>
    <link rel="stylesheet" href="assetsss/start.css">
</head>

<body>
    <main id="pc-main">
        <div id="header">
            <h1>
                <span style="color: #fff;">Welcome to</span> <span class="DuLeCord"><span
                        style="color: #0A9B00;">Du</span><span style="color: #3F48CB;">Le</span><span
                        style="color: #fff;">Cord !</span></span>
            </h1>
        </div>
        <div id="button-group">
            <button type="button" class="btn btn-primary btn-lg is-primary m-2" style="width: 250px"
                data-bs-toggle="modal" data-bs-target="#RegistrationModal">
                Registration
            </button>
            <button type="button" class="btn btn-primary btn-lg is-primary m-2" style="width: 250px"
                data-bs-toggle="modal" data-bs-target="#LoginModal">
                Login
            </button>
        </div>
    </main>
    <!-- Registration Modal -->
    <div class="modal fade" id="RegistrationModal" tabindex="-1" aria-labelledby="RegistrationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RegistrationModalLabel">Regestration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action=".\handlers\registration.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="RegestrationUsername" class="form-label">Think About Your Username</label>
                            <input type="text" class="form-control" id="RegestrationUsername" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="RegestrationPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="RegestrationPassword" name="pass">
                        </div>
                        <div class="mb-3">
                            <label for="RegestrationRePassword" class="form-label">Repeat Password</label>
                            <input type="password" class="form-control" id="RegestrationRePassword" name="rePass">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="policy[]"
                                value="true">
                            <label class="form-check-label" for="exampleCheck1">I agree with the <a
                                    href="support.html">policy confidentiality</a></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Modal -->
    <div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="LoginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action=".\\handlers\\login.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="LoginUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="LoginUsername" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="LoginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="LoginPassword" name="pass">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </page>
    <?php
    if (isset($_SESSION['login-mistakes'])) {
        ?>
        <script> alert(" <?php echo $_SESSION['login-mistakes'] ?>"); </script>
        <?php
    } elseif (isset($_SESSION['reg-mistakes'])) {
        ?>
        <script> alert(" <?php echo $_SESSION['reg-mistakes'] ?>"); </script>
        <?php
    }
    include './assets/inc/scripts.php';
    ?>
</body>


</html>