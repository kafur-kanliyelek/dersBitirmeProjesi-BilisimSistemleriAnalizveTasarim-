<?php 

session_start(); 

include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM calisanlar WHERE calisanlar.calisan_ad='$uname' AND calisanlar.calisan_soyad='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['calisan_ad'] === $uname && $row['calisan_soyad'] === $pass) {

                echo "Logged in!";

                $_SESSION['calisan_ad'] = $row['calisan_ad'];
                $_SESSION['calisan_soyad'] = $row['calisan_soyad'];

                $_SESSION['calisan_id'] = $row['calisan_id'];

                header("Location: home.php");

                exit();

            }else{

                header("Location: index.php?error=Incorect User name or password $uname");


                exit();

            }

        }else{

            header("Location: index.php?error=Incorect User name or password2");

            exit();

        }

    }

}else{

    header("Location: index.php");

    exit();

}