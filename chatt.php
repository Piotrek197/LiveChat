<?php

require 'Chat.php';
$chat = new Chat();
session_start();

$method = $_POST['method'];
$usrTo = $_POST['usrTo'];

if($method == 'fetch'){
    
$messages = $chat->fetchMessages($usrTo, $_SESSION['id_user']); 

if(empty($messages) === true){
    echo '<p style="color:white;">There are currently no messages in the chat.</p>';
}else{
    foreach($messages as $message){
            echo '<div class="message';
            echo $message['userName']===$_SESSION['userName'] ? ' right">' : ' left">';
                echo '<p class="usernameUnderMessage">'.$message['userName'].':</p>
                      <p style="color:white;">'.nl2br($message['message']).'</p>
            </div>';
    }}
}else if($method == 'throw' && isset($_POST['message'])){
     $message = trim($_POST['message']);
     if(empty($message) === false ){

        $chat->throwMessage($_SESSION['id_user'], $message, $usrTo);
     }
}

?>