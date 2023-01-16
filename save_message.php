<?php
require "config.php";

$json = file_get_contents('php://input');
$data = json_decode($json);

if($data->user_id !== "" && $data->message !== ""){
    $query = $pdo->prepare("INSERT INTO messages (user_id, message) VALUES (:user_id, :message)");
    $isSaved = $query->execute(
        array(":user_id"=>$data->user_id, ":message"=>$data->message)
    );
    if($isSaved){
        echo "saved";
    }
}