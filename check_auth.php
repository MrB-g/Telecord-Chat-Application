<?php
require "config.php";
$json = file_get_contents('php://input');
$data = json_decode($json);

if ($data->email !== "" && $data->password !== "") {
    $email = $data->email;
    $password = $data->password;

    if ($email === "admin@admin.com" && $password === "admin123") {
        setcookie("adminAccess", "true", time() + (60 * 60));
        echo "ADMIN";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($user)) {
            echo "WRONG";
        } else {
            $validPassword = password_verify($password, $user['password']);
            if ($validPassword) {
                $stmt = $pdo->prepare("SELECT COUNT(login_users_id) AS num FROM login_users WHERE login_users_id=:user_id");
                $stmt->bindValue(':user_id', $user['id']);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row['num'] == 0) {
                    $stmt = $pdo->prepare("INSERT INTO login_users(login_users_id) VALUES (:login_users_id)");
                    $addLoginUser = $stmt->execute(
                        array(':login_users_id' => $user['id'])
                    );
                    if ($addLoginUser) {
                        echo $user['id'];
                    }
                } else {
                    echo $user['id'];
                }
            } else {
                echo "WRONG";
            }
        }
    }
}