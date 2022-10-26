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
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM client where `id` =?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $client = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($client)) {
    ?>
    <div class="container">
        <h1 class="heading">modify a body building player</h1>
            <form action="" method="POST">
                id : <input type="text" value="<?= $client->id ?>" <?php if ($_GET['id'] == $client->id) echo "readonly"; ?>>
                full name : <input type="text" name="name" value="<?= $client->full_name ?>">
                tel : <input type="text" name="tel" value="<?= $client->tel ?>">
                date : <input type="date" name="date" value="<?= $client->final_date ?>">
                <input type="submit" value="modify" name="add">
                <input type="reset" value="reset">
            </form>
    <?php
        }
    }
    if (
        isset($_POST['add']) &&
        !empty($_POST['name']) &&
        !empty($_POST['tel']) &&
        !empty($_POST['date'])
    ) {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $tel = $_POST['tel'];
        $date = $_POST['date'];

        $sql = "UPDATE `client` set `full_name` = :name, `tel` = :tel, `final_date` = :final_date WHERE `id` =:id";
        $stmt = $db->prepare($sql);
        $flag = $stmt->execute(
            array(
                ":name" => $name,
                ":tel" => $tel,
                ":final_date" => $date,
                ":id" => $id
            )
        );
        if ($flag) {
            header('location: index.php');
        }
    }
    ?>
    </div>
</body>

</html>