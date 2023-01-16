<?php

require "config.php";

$json = file_get_contents('php://input');
$data = json_decode($json);

if ($data->id !== "" && $data->message !== "" && $data->email !== "") {
    $id = $data->id;
    $to_email = $data->email;
    $subject = "Telecord Organization";
    $body = $data->message;
    $headers = "From: TELECORD";
    mail($to_email, $subject, $body, $headers);
}