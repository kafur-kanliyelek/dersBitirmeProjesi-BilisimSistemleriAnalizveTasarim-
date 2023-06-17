<?php
    require_once('db_con.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM `yoklama` WHERE yoklama.t_id = $id";

        if($con->query($sql) === TRUE){
            header('Location: http://localhost/first/nstack/showtoplanti.php');
        }else{
            echo "something went wrong";
        }
        
    }else{
        // redirect to show with error
        die('id not provided');
    }

?>