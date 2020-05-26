<?php
require "Chat.php";
session_start();

if(isset($_SESSION['userName']) && isset($_SESSION['password']))
    header('Location: index.php');

if(isset($_POST['submit-btn'])){

    $_SESSION['userName'] = $_POST['username']; //session needed: logout.php
    $_SESSION['password']= $_POST['password'];

    $chat = new Chat();
    $user = $chat->loginUser($_SESSION['userName'], $_SESSION['password']);

    $_SESSION['id_user'] = $user['idUser'];

    if(empty($user)==true){
        echo "Nie ma takiego użytkownika!";
    }else{
        header('Location:index.php');
    }

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Login" autocomplete="off"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <input type="submit" value="Zaloguj" name="submit-btn">
    </form>

</body>
</html>