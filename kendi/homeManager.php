<?php
try {

     $host = 'localhost';
     $dbname = 'yilmaz2';
     $username = 'root';
     $password = '';
 
     $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", "$username", "$password");
     
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $db->query('USE yilmaz2');
     $db->query("SET CHARACTER SET utf8mb4");
     $db->query("SET CHARACTER_SET_CONNECTION=utf8mb4");
     $db->query("SET @@lc_time_names = 'tr_TR'");
 
 } catch ( PDOException $e ){
     print $e->getMessage();
 }
 


 
?>
<?php 

session_start();

if (isset($_SESSION['calisan_id']) && isset($_SESSION['calisan_ad'])) {

 ?>

<!DOCTYPE html>

<html>

<head>

    <title>HOME</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

     <h1>Hellomanager, <?php echo $_SESSION['calisan_ad']; ?></h1>

     <a href="logout.php">Logout</a>

</body>

</html>

<?php 

}else{

     header("Location: index.php");

     exit();

}

 ?>
 <?php
 $sql = "SELECT * FROM calisanlar";
 $query = $db->query($sql);
 
 if ( $query->rowCount() ){
     print_r($query->fetchAll(PDO::FETCH_ASSOC));
}
 ?>


</table>

<?php

include('db_conn.php');

if(isset($_POST['calisanSil']))
{
    $calisan_id = $_POST['calisanSil'];

    try {

        $query = "DELETE FROM calisanlar WHERE $calisan_id = :calisan_id";
        $statement = $conn->prepare($query);
        $data = [
            ':calisan_id' => $calisan_id
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            $_SESSION['message'] = "Deleted Successfully";
            header('Location: homeManager.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Deleted";
            header('Location: homeManager.php');
            exit(0);
        }

    } catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>


                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th> Ad</th>
                                    <th>Soyad</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $con = mysqli_connect("localhost","root","","yilmaz2");

                                    $query = "SELECT * FROM calisanlar";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['calisan_id']; ?></td>
                                                <td><?= $row['calisan_ad']; ?></td>
                                                <td><?= $row['calisan_soyad']; ?></td>
                                                <td>
                                                
                                            <div class='btn-group'>
                                            <a class='btn btn-secondary' href='./update.php?id=" .$row['id'] ."'> Update </a>
                                            <a class='btn btn-danger' href='./delete.php?id=" .$row['id'] ."'> Delete</a>
                                            </div>

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <tr>
                                                <td colspan="4">No Record Found</td>
                                            </tr>
                                        <?php
                                    }
                                ?>

                            </tbody>
                        </table>

                    </div>