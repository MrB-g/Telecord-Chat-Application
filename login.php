<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- BootStrap Icon -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" />

    <!-- Login Page CSS -->
    <link rel="stylesheet" href="./style/login.css?time=<?php
                                                        echo time();
                                                        ?>" />

    <!-- Icon -->
    <link rel="icon" href="./logo/TELECORD-logo.png" />

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <!-- Header  -->
    <div class="section-1">
        <img src="./logo/TELECORD-blue.png" />
    </div>

    <!-- Section-2 -->
    <div class="section-2">
        <div class="login-box">
            <div class="login-header">
                <h1>Login</h1>
                <p>It's quick and easy.</p>
            </div>

            <hr>

            <form class="login-form" id="login">
                <div class="input-div" id="email-div">
                    <input type="email" placeholder="Email" id="email" value="<?php
                                                                                if (!empty($_GET)) {
                                                                                    echo $_GET['email'];
                                                                                } else {
                                                                                    echo '';
                                                                                }
                                                                                ?>" />
                    <div class="error-message" id="error-email"></div>
                </div>
                <div class="input-div" id="password-div">
                    <input type="password" id="password" placeholder="Password" />
                    <div class="error-message" id="error-password"></div>
                </div>
                <div class="inv-message" id="inv-message">
                    Your email and password are invalid.
                </div>
                <div class="input-div">
                    <input type="submit" value="Let's Chat" class="login-button" />
                </div>
                <div class="register-div">
                    <a href="register.php">Sign Up?</a>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="./js/login.js?time=<?php echo time(); ?>"></script>

</html>