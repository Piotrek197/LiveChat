
<?php

class Connect{

    private $rows;
    protected $stmt, $result;
    private $acitveUsers, $nonActiveUsers;
    private $au_rows, $nu_rows;



    public function __construct(){
        
        $mysql_host = 'localhost';
        $port = '3306';
        $username = 'root';
        $password = '';
        $database = 'messengerpl';

        try{

        $this->stmt = new PDO('mysql:host=' . $mysql_host . ';dbname=' . $database . ';port=' . $port . ";charset=utf8", $username, $password );
    }catch(PDOException $e){

            echo('<p>Houston mamy problem! Nie możemy się połączyć!</p>');
        
            die();
        
        }
    
    }

    public function query($sql){
        //if(empty($this->result) === true)
        $this->result = $this->stmt->prepare($sql);
        $this->result->execute();
    }

    public function getActiveUsers(){
        $this->activeUsers = $this->stmt->prepare("SELECT * FROM `logindata` WHERE `LoggedIn` = 1");
        $this->activeUsers->execute();
        for($i = 0; $i <=$this->activeUsers->rowCount()-1; $i++){
            $this->au_rows[] = $this->activeUsers->fetch(PDO::FETCH_ASSOC);
        }

        return $this->au_rows;
    }

    public function getNonActiveUsers(){
        $this->nonActiveUsers = $this->stmt->prepare("SELECT * FROM `logindata` WHERE `LoggedIn` = 0");
        $this->nonActiveUsers->execute();
        for($i = 0; $i <=$this->nonActiveUsers->rowCount()-1; $i++){
            $this->nu_rows[] = $this->nonActiveUsers->fetch(PDO::FETCH_ASSOC);
        }

        return $this->nu_rows;
    }

    public function rows(){
        for($i = 0; $i <=$this->result->rowCount()-1; $i++){
            $this->rows[] = $this->result->fetch(PDO::FETCH_ASSOC);
        }
        return $this->rows;
    }

}
?>