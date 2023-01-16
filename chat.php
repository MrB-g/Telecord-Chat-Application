<?php

require "config.php";

if ($_SERVER['REQUEST_URI'] === "/telecord/chat.php") {
    echo "<script>
            window.location.href = 'login.php';
        </script>";
} else {
    $userId = $_GET['userId'];
    $stmt = $pdo->prepare("SELECT COUNT(login_users_id) AS num FROM login_users WHERE login_users_id=:user_id");
    $stmt->bindValue(':user_id', $userId);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row['num'] == 0) {
        echo "<script>
                window.location.href = 'login.php';
            </script>";
    } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chat Page</title>

    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- BootStrap Icon -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" />

    <!-- Chat Page CSS -->
    <link rel="stylesheet" href="./style/chat.css?time=<?php echo time(); ?>" />

    <!-- Icon -->
    <link rel="icon" href="./logo/TELECORD-logo.png" />

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <!-- Main Box -->
    <div class="main-box" id="main-box">
        <div class="info-btn" id="info-btn">
            <i class="bi bi-filter-left"></i>
        </div>

        <div class="left" id="left">
            <div class="left-header">
                <div class="left-header-logo">
                    <img src="./logo/TELECORD-white.png" />
                </div>
                <div class="left-header-logout">
                    <a href="logout.php?id=<?php echo $userId ?>">Logout</a>
                </div>
            </div>
            <div class="left-profile">
                <?php
                $query = $pdo->prepare("SELECT * FROM users WHERE id=:id");
                $query->bindValue(":id", $_GET['userId']);
                $query->execute();
                $user = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="left-profile-pic-wrapper">
                    <img src="./profile_pic/<?php
                                            echo $user['profile_pic_name'];
                                            ?>" />
                </div>
                <div class="left-profile-name">
                    <h1><?php
                        echo $user['name'];
                        ?></h1>
                </div>
            </div>

            <div class="left-members">
                <div class="left-member-header">
                    <h2>Group Chat Members</h2>
                </div>
                <div class="members-wrapper" id="members-wrapper">
                </div>
            </div>
        </div>

        <div class="right">
            <div class="messages-wrapper" id="messages-wrapper">
                <div class="messages" id="messages">
                </div>
            </div>

            <div class="message-input-box">
                <input type="text" placeholder="Type Message . . ." id="message" autocomplete="off" />
                <i class="bi bi-arrow-right-circle-fill" id="send"></i>
            </div>
        </div>
    </div>
    <input type="hidden" class="userId" id="<?php
        echo $userId;
    ?>">
</body>
<script src="./js/chat.js?time=<?php echo time(); ?>"></script>

</html>