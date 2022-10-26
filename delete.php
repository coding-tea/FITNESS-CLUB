<?php
require("config.php");

if(!empty($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "DELETE FROM `client` WHERE `id` = ?";
    $stmt = $db->prepare($sql);
    $flag =  $stmt->execute([$id]);
    if($flag)
        header('location: index.php');
}