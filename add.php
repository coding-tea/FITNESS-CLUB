<?php require("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add client</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="container">
        <h1 class="heading">add a body building player</h1>
        <form action="" method="POST">
            full name : <input type="text" name="name">
            tel : <input type="text" name="tel">
            date : <input type="date" name="date">
            <input type="submit" value="add" name="add">
            <input type="reset" value="reset">
        </form>
        <?php
            if(
                isset($_POST['add']) &&
                !empty($_POST['name']) &&
                !empty($_POST['tel']) &&
                !empty($_POST['date']) 
            )
            {
                $name = $_POST['name'];
                $tel = $_POST['tel'];
                $date = $_POST['date'];

                $sql = "INSERT INTO `client` (`full_name`, `tel`, `final_date`) VALUES (:name, :tel, :final_date)";
                $stmt = $db->prepare($sql);
                $flag = $stmt->execute(array(
                    ":name" => $name,
                    ":tel" => $tel,
                    ":final_date" => $date
                ));
                if($flag){
                    header('location: index.php');
                }
            }
        ?>
    </div>
</body>
</html>