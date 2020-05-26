<?php

session_start();

if(!isset($_SESSION['userName']) && !isset($_SESSION['password']))
    header('Location: login.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Chat</title>
</head>
<body>
    <a href="logout.php">Wyloguj</a>
    <div class="container">
        <div class="chat">
            <div class="messages">
                <p style="color:white; font-size:20px;">Zacznij konwersację :)</p>
            </div>
            <textarea name="" class="entry" placeholder="Type a message..." id="" cols="30" rows="10"></textarea>
        </div>    
        <div class="users_list">
            <div class="list">
                <?php include('list.php'); ?>
            </div>
        </div>
    </div>


    <script src="js/main.js"></script>
</body>
</html>
