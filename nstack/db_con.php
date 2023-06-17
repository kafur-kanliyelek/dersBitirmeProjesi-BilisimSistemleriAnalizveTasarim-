<?php
        $server = "localhost";
        $user = "root";
        $pass = "";
        $db_name = "yilmaz2";

        $con = new mysqli($server, $user, $pass,  $db_name );

        if($con->connect_error){
            die("Connection Error");
        }else{
            echo "";
        }

    ?>