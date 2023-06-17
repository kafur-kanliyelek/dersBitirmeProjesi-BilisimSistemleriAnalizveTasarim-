<?php

require_once('db_con.php');
    if(isset($_POST['submitForm'])){
        $id = $_POST['id'];
        $name = $_POST['pname'];
        $soyad = $_POST['soyad'];
        echo "Ad : $name <br> Soyad : $soyad";

        $sql = "INSERT INTO calisanlar(calisanlar.calisan_id, calisanlar.calisan_ad, calisanlar.calisan_soyad)
        VALUES('$id', '$name', '$soyad')";

            if($con->query($sql) === TRUE){
                echo "added successfully";
            }else{
                echo "something went wrong";
            }



    }else{
        echo "no submit";
        // redirect to homepage
    }
    
?>