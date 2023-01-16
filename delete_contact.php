<?php

require "config.php";

if(!empty($_POST)){
    $id = $_POST['delete_id'];
    $query = $pdo->prepare("DELETE FROM `contacts` WHERE `contacts`.`id` = :id");
    $query->bindValue(":id", $id);
    $query->execute();
}