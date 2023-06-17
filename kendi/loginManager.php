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

        $sql = "SELECT * FROM yonetici WHERE yonetici.yonetici_user_name='$uname' AND yonetici.yonetici_pass='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['yonetici_user_name'] === $uname && $row['yonetici_pass'] === $pass) {

                echo "Logged in!";

               // $_SESSION['calisan_ad'] = $row['calisan_ad'];
                $_SESSION['yonetici_pass'] = $row['yonetici_pass'];

                $_SESSION['yonetici_user_name'] = $row['yonetici_user_name'];

                header("Location: http://localhost/first/nstack/show.php");

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