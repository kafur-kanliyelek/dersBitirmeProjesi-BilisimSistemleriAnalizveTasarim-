<?php

require_once('db_con.php');
   
        $id = $_GET['id'];
        

        $sql = "INSERT INTO `yoklamaders`(`yoklama_calisan_id`, `yoklama_ders_tarih`) 
        VALUES ('$id', now())";
      

            if($con->query($sql) === TRUE){
                header('Location: http://localhost/first/nstack/show.php');
            }else{
                echo "something went wrong";
            }
    
?>