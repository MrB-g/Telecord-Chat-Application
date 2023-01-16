<?php

require "config.php";
$pdo_statement = $pdo->prepare("DELETE FROM login_users WHERE login_users_id =" . $_GET['id']);
$pdo_statement->execute();
header('Location: login.php');