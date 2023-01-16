<?php

require "config.php";

if($_POST['name'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" && !empty($_FILES['file'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $profile_pic_name = $_FILES['file']['name'];
    $profile_pic_tmp_name = $_FILES['file']['tmp_name'];

    $stmt = $pdo->prepare("SELECT COUNT(email) AS num FROM users WHERE email=:email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['num'] > 0){
        echo "emailExist";
    } else {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $unique_profile_name = uniqid()."-".$profile_pic_name; 
        move_uploaded_file($profile_pic_tmp_name, './profile_pic/' . $unique_profile_name);
        
        $sql = "INSERT INTO users (name,email,profile_pic_name,password) VALUES (:name,:email,:profile_pic_name,:password)";
        $pdo_statement = $pdo->prepare($sql);
        $result = $pdo_statement->execute(
            array(':name' => $name, ':email' => $email, ':profile_pic_name' => $unique_profile_name, ':password' => $passwordHash)
        );

        if ($result) {
            echo "done";
        }
    }
}