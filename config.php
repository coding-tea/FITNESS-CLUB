<?php

//data source name
$dsn = "mysql:host=localhost:3310;dbname=fitness";

//database user && password
$user = "root";
$pass = "";

try {
    $db = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Error :" . $e->getMessage());
}
