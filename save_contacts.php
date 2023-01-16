<?php
require "config.php";

$json = file_get_contents('php://input');
$data = json_decode($json);

if ($data->contact_name !== "" && $data->contact_email !== "" && $data->contact_message !== "") {
    $query = $pdo->prepare("INSERT INTO `contacts` (`name`, `email`, `message`) VALUES (:name ,:email, :message)");
    $query->execute(
        array(':name' => $data->contact_name, ':email' => $data->contact_email, ':message' => $data->contact_message)
    );
}