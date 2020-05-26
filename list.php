<?php



require "Connect.php";

$con = new Connect();

$activeUsers = $con->getActiveUsers(); // 1 = logged in 
    $i = 1;
    foreach($activeUsers as $user){ 
        
        if($user['userName'] !== $_SESSION['userName']){
        ?>
        <div class="user">
            <div class="active"></div><div class="username">
                <?php echo "<button class='button_list' name='btn".$i."' id='btn".$user['idUser']."' value='".$user['idUser']."'>"
                    ."<span style='color:#5be44e;'>".$user['userName']."</span>
                </button>";
                $i++;
                ?>
            </div>
        </div>

         <?php
        }
    }

    $nonActiveUsers = $con->getNonActiveUsers();
    foreach($nonActiveUsers as $user){?>
        <div class="user">
        <div class="non-active"></div><div class="username">
        <?php echo "<button class='button_list' name='btn".$i."' id='btn".$user['idUser']."' value='".$user['idUser']."'>"
                    .$user['userName'].
                "</button>";
        ?>
        </div>
        </div>
    <?php
    }




?>