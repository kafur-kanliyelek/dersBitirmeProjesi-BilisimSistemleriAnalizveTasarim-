<?php

require_once('db_con.php');
   
        $id = $_GET['id'];
        

        $sql = "INSERT INTO `yoklama`(`t_id`,`yoklama_calisan_id`, `yoklama_toplanti_tarih`) 
        VALUES (NULL, '$id', now())";
      

            if($con->query($sql) === TRUE){
                header('Location: http://localhost/first/nstack/show.php');
            }else{
                echo "something went wrong";
            }
    
?>