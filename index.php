<?php require("config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fitness</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    scroll-behavior: smooth;
}

body {
    min-height: 100vh;
    width: 100%;
    background-color: #202225;
    color: white;
    padding: 30px 150px;
}

.container{
    padding: 20px;
    width: 100%;
}

.header {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.logo{
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 30px;
}

.search{
    float: right;
}

.container{
    background-color: #36393F;
    border-radius: 5px;
}

input[type="text"]
{
    margin: 0;
    background-color: #202225;
    color: white;
}

.search form {
    position: relative;
}
.search form button {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    width: 50px;
    background: transparent;
    border: transparent;
    font-size: 16px;
    color: white;
    cursor: pointer;
    outline: 0;
}

input{
    padding: 6px 15px;
    outline: none;
    border: none;
    border-radius: 10px;
}

.info a{
    text-decoration: none;
    letter-spacing: 1px;
    text-transform: uppercase;
    background-color: #3BA55D;
    color: #36393F;
    padding: 8px 20px;
    font-weight: 700;
    margin-bottom: 40px;
}

.heading{
    letter-spacing: 1px;
    text-transform: uppercase;
    font-size: 17px;
    font-weight: 400;
    padding: 20px 0;
}

table , th, td{
    border: 1px solid white;
    border-collapse: collapse;
}

table{
    width: 100%;
}

th, td{
    padding: 10px 20px;
    text-align: center;
}

.modify{
    color: #3BA55D;
    font-size: 18px;
}
.delete{
    color: #D83C3E;
    font-size: 18px;
    margin-left: 10px;
}
th{
    background-color: #2F3136;
    letter-spacing: 1px;
    text-transform: uppercase;
}
    </style>
</head>

<body>
    <div class="container">
        <div class="all">
            <div class="header">
                <h1 class="logo">fitness sale</h1>
                <div class="search">
                    <form action="" method="POST">
                        <input type="text" name="text" placeholder="search .....">
                        <button type="submit" name="ok"><i class="fa-solid fa-magnifying-glass"></i></button>
                        <!-- <input type="submit" value="search" name="ok"> -->
                    </form>
                </div>
            </div>
            <div class="info">
                <a href="add.php"><i class="fa-solid fa-circle-plus"></i> add a new client</a>
            </div>
            <?php
            $sql = "SELECT * FROM client where final_date=DATE(NOW());";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $client = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (!empty($client)) {
            ?>
                <div class="table">
                    <h1 class="heading">They need to pay again :</h1>
                    <table class="tab1">
                        <tr>
                            <th>id</th>
                            <th>full name</th>
                            <th>phone number</th>
                            <th>final date</th>
                            <th>action</th>
                        </tr>
                        <?php foreach ($client as $c) : ?>
                            <tr>
                                <td><?= $c->id ?></td>
                                <td><?= $c->full_name ?></td>
                                <td><?= $c->tel ?></td>
                                <td><?= $c->final_date ?></td>
                                <td>
                                    <a title="modify" class="modify" href="modify.php?id=<?= $c->id ?>"><i class="fa-solid fa-square-pen"></i></a>
                                    <a title="delete" class="delete" onclick="return confirm('do you realy want to delete <?= $c->full_name ?>??')" href="delete.php?id=<?= $c->id ?> z"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php } ?>
                <?php
                if (
                    isset($_POST['ok']) &&
                    !empty($_POST['text'])
                ) {
                    $text = $_POST['text'];
                    $sql = "SELECT * FROM client where full_name REGEXP ? ;";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$text]);
                    $client = $stmt->fetchAll(PDO::FETCH_OBJ);
                    if (!empty($client)) {

                ?>
                        <div class="all">
                            <h1 class="heading">You searched for : <?= $text ?></h1>
                            <table class="tab2">
                                <tr>
                                    <th>id</th>
                                    <th>full name</th>
                                    <th>phone number</th>
                                    <th>final date</th>
                                    <th>action</th>
                                </tr>
                                <?php foreach ($client as $c) : ?>
                                    <tr>
                                        <td><?= $c->id ?></td>
                                        <td><?= $c->full_name ?></td>
                                        <td><?= $c->tel ?></td>
                                        <td><?= $c->final_date ?></td>
                                        <td>
                                            <a class="modify" href="modify.php?id=<?= $c->id ?>"><i class="fa-solid fa-square-pen"></i></a>

                                            <a class="delete" onclick="return confirm('do you realy want to delete <?= $c->full_name ?>??')" href="delete.php?id=<?= $c->id ?> z"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                    <?php }
                } else{
                    $sql = "SELECT * FROM client";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $client = $stmt->fetchAll(PDO::FETCH_OBJ);
                    if (!empty($client)) {

                ?>
                        <div class="all">
                            <h1 class="heading">list client : </h1>
                            <table class="tab2">
                                <tr>
                                    <th>id</th>
                                    <th>full name</th>
                                    <th>phone number</th>
                                    <th>final date</th>
                                    <th>action</th>
                                </tr>
                                <?php foreach ($client as $c) : ?>
                                    <tr>
                                        <td><?= $c->id ?></td>
                                        <td><?= $c->full_name ?></td>
                                        <td><?= $c->tel ?></td>
                                        <td><?= $c->final_date ?></td>
                                        <td>
                                            <a class="modify" href="modify.php?id=<?= $c->id ?>"><i class="fa-solid fa-square-pen"></i></a>

                                            <a class="delete" onclick="return confirm('do you realy want to delete <?= $c->full_name ?>??')" href="delete.php?id=<?= $c->id ?> z"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                <?php 
                }
                }
                ?>
                        </div>
                </div>
        </div>
</body>

</html>