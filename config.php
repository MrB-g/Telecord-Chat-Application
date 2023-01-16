<?php

//username
define('MYSQL_USER', 'root');

//password
define('MYSQL_PASSWORD', '');

//host
define('MYSQL_HOST', 'localhost');

//database name
define('MYSQL_DATABASE', 'telecord');

//error handling
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);

//connect
$pdo = new PDO(
    'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DATABASE,
    MYSQL_USER,
    MYSQL_PASSWORD,
    $pdoOptions
);