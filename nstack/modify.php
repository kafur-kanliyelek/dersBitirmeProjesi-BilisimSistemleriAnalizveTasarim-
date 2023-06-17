<?php
    require_once('db_con.php');

    if(isset($_GET['id']) && isset($_POST['editForm'])){

        $id = $_GET['id'];
        $name = $_POST['pname'];
        $soyad = $_POST['soyad'];
        
        $sql = "UPDATE `calisanlar` SET 
        `calisan_id`='$id',
        `calisan_ad`='$name',
        `calisan_soyad`='$soyad' 
        WHERE calisan_id = $id";

            if($con->query($sql) === TRUE){
                echo "Modified the data";
                header('Location: http://localhost/first/nstack/show.php');
            }else{
                echo "something went wrong";
            
            }
    }else{
        echo 'invalid';
    }
?>