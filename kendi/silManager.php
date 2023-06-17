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

$sql = "DELETE FROM calisanlar
        WHERE calisanlar.calisan_ad = 'zxc' AND
		calisanlar.calisan_soyad = 'zxc'";
$query = $db->query($sql);

if ( $query->rowCount() ){
    echo  $query->rowCount(). ' adet satır silindi.';}