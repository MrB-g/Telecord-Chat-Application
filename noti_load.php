<?php

require "config.php";

$query = $pdo->prepare("SELECT COUNT(*) AS num FROM contacts");
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);


if ($_GET['child'] == "no-contact") {
    echo $row['num'];
} else if($_GET['child'] == "contact-form"){
    if ($row['num'] > $_GET['num']) {
        if ($row['num'] - $_GET['num'] > 99) {
            echo "99+";
        } else {
            echo $row['num'] - $_GET['num'];
        }
    }
    
    if ($row['num'] == 0 || $row['num'] == $_GET['num']) {
        echo "0";
    }
}