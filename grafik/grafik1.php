 <?php       
        $server = "localhost";
        $user = "root";
        $pass = "";
        $db_name = "yilmaz2";

        $con = new mysqli($server, $user, $pass,  $db_name );

        $query = "SELECT calisanlar.calisan_ad, calisanlar.calisan_soyad, yoklama.yoklama_calisan_id, COUNT(yoklama.yoklama_calisan_id) AS sayi
        FROM yoklama, calisanlar
        WHERE  yoklama.yoklama_calisan_id = calisanlar.calisan_id
        GROUP BY yoklama.yoklama_calisan_id";
	$exec = mysqli_query($con,$query);
	while($row = mysqli_fetch_array($exec)){
	//echo "['".$row['calisan_ad']."',".$row['calisan_soyad']."],".$row['sayi']."]";
	 }
        ?>

<!DOCTYPE HTML>
<html>
<head>
 <meta charset="utf-8">
 <title>TechJunkGigs</title>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 google.setOnLoadCallback(drawChart2);

 function drawChart() {
 var data = google.visualization.arrayToDataTable([

 ['Çalışan','Kazanç'],
 <?php 
			$query = "SELECT calisanlar.calisan_ad, calisanlar.calisan_soyad, yoklama.yoklama_calisan_id, COUNT(yoklama.yoklama_calisan_id) AS sayi
            FROM yoklama, calisanlar
            WHERE  yoklama.yoklama_calisan_id = calisanlar.calisan_id
            GROUP BY yoklama.yoklama_calisan_id";

			 $exec = mysqli_query($con,$query);
			 while($row = mysqli_fetch_array($exec)){

			 echo "['".$row['calisan_ad']."',".$row['sayi']."],";
			 }
			 ?> 
 
 ]);

 var options = {
 title: 'Çalışana Göre Kazanç Miktarı',
  pieHole: 0.3,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
 };
 var chart = new google.visualization.ComboChart(document.getElementById("columnchart12"));
 chart.draw(data,options);
 }

 function drawChart2() {
 var data2 = google.visualization.arrayToDataTable([

 ['Çalışan','Kazanç'],
 <?php 
			$query = "SELECT calisanlar.calisan_ad, calisanlar.calisan_soyad, yoklama.yoklama_calisan_id, COUNT(yoklama.yoklama_calisan_id) AS sayi
            FROM yoklama, calisanlar
            WHERE  yoklama.yoklama_calisan_id = calisanlar.calisan_id
            GROUP BY yoklama.yoklama_calisan_id";

			 $exec = mysqli_query($con,$query);
			 while($row = mysqli_fetch_array($exec)){

			 echo "['".$row['calisan_ad']."',".$row['sayi']."],";
			 }
			 ?> 
 
 ]);

 var options = {
 title: 'Çalışana Göre Kazanç Miktarı',
  pieHole: 0.3,
          pieSliceTextStyle: {
            color: 'black',
          },
          legend: 'none'
 };
 var chart = new google.visualization.PieChart(document.getElementById("columnchart12"));
 chart.draw(data2,options);
 }
	
	
    </script>

</head>
<body>
 <div class="container-fluid">
 <div id="columnchart12" style="width: 100%; height: 500px;"></div>
 </div>
 <table class="columns">
      <tr>
        <td><div id="drawChart" style="border: 1px solid #ccc"></div></td>
        <td><div id="drawChart2" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table>
 

</body>
</html>