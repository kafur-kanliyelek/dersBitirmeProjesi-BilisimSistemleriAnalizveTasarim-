<?php
require_once('db_con.php');


        $sayi ='SELECT COUNT(toplanti.toplanti_id) FROM toplanti';
    

        $sql = "INSERT INTO toplanti (toplanti_id,toplanti_tarih) VALUES(0,now())";

        if($con->query($sql) === TRUE){
            header('Location: http://localhost/first/nstack/show.php');
        }else{
            echo "something went wrong $sayi";
            echo gettype($sayi);
        
        }
      


?>