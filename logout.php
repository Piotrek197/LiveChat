<?php

require "Chat.php";
session_start();
$chat = new Chat();
$userName = $_SESSION['userName'];
$password = $_SESSION['password'];
$chat->logoutUser($userName, $password);
session_unset();
header('Location:login.php');

?>