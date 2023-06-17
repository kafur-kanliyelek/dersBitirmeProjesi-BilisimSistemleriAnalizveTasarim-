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



// veritabnından dataları listeleme- calşsanlar için
/*$sql = "SELECT * FROM calisanlar";
$query = $db->query($sql);

if ( $query->rowCount() ){
    print_r($query->fetchAll(PDO::FETCH_ASSOC));}
    */


//veritabanından çalışan silme

/*
$sql = "DELETE FROM calisanlar
        WHERE calisanlar.calisan_ad = 'zxc' AND
		calisanlar.calisan_soyad = 'zxc'";
$query = $db->query($sql);

if ( $query->rowCount() ){
    echo  $query->rowCount(). ' adet satır silindi.';}
    */

//veritabanına çalışan ekleme
/*$sql = "INSERT INTO calisanlar(calisanlar.calisan_id, calisanlar.calisan_ad, calisanlar.calisan_soyad)
VALUES('6', 'ad', 'soyad')";
               
$query = $db->query($sql);

if ( $query->rowCount() ){
    echo $query->rowCount().' adet veri eklendi';
}*/




?>