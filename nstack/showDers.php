<?php
    require_once('db_con.php');

    $sql = "SELECT * FROM `yoklamaders`";
    $result = $con->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logiscool</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Logiscool</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/first/kendi/index.php">Çıkış Yap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/first/nstack/show.php">Çalışanlar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/first/nstack/showtoplanti.php">Toplantı Katılımcıları</a>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <table class="table table-striped table-borderrer">
            <tr>
                <th>ID#</th>
                <th>Çalışan ID</th>
                <th>Tarih</th>
            </tr>

            <?php
                if($result->num_rows > 0 ){
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . $row['d_id'] . "</td>";
                        echo "<td>" . $row['yoklama_calisan_id'] . "</td>";
                        echo "<td>" . $row['yoklama_ders_tarih'] . "</td>";
                        echo "<td>";
                        echo "<div class='btn-group'>";
                        echo "<a class='btn btn-danger' href='./deleteders.php?id=" .$row['d_id'] ."'> Sil</a>";
                       
                        echo "</div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>