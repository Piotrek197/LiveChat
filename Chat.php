<?php
require 'Connect.php';
class Chat extends Connect{
    public function fetchMessages($selectedUser, $id_user){
        $this->query("SELECT `chat`.`message`,
                    `logindata`.`userName`,
                    `logindata`.`idUser`
            FROM    `chat`
            JOIN `logindata` ON `chat`.`messageFrom` = `logindata`.`idUser`
            WHERE (`chat`.`messageTo` = '$selectedUser' AND `chat`.`messageFrom` = '$id_user')
                    OR
                    (`chat`.`messageTo` = '$id_user' AND `chat`.`messageFrom` = '$selectedUser')
            ORDER BY `chat`.`timestamp`
            -- DESC
        ");
        
        return $this->rows();
    }

    public function throwMessage($id_user, $message, $receiver){
        $this->query("INSERT INTO `chat`(`messageFrom`, `message`, `timestamp`, `messageTo`)
                    VALUES (".intval($id_user).", '".$message."', UNIX_TIMESTAMP(), ".$receiver.")");
    }


    public function users($loggedIn){
        $this->query("SELECT `userName` FROM `logindata` 
                    WHERE `LoggedIn` = '$loggedIn' ");
        return $this->rows();
    }


    public function loginUser($userName, $password){
        $this->query("UPDATE logindata SET LoggedIn = 1 WHERE userName = '$userName'");
        $this->query("SELECT * FROM logindata WHERE userName='$userName' AND pwd='$password'");
        return $this->result->fetch(PDO::FETCH_ASSOC);
    }

    public function logoutUser($userName, $password){
        $this->query("UPDATE logindata SET LoggedIn = 0 WHERE userName = '$userName'");
    }

}