<
  $toplantiUcret = 80;
  $dersUcret = 150;?php
  $con = mysqli_connect("localhost","root","","yilmaz2");
  if($con){
    echo "";
  }
?>
<html>
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <!--Calisanlar kaç derse girdi?-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['students', 'Ders sayısı'],
         <?php
         $sql = "SELECT calisanlar.calisan_ad AS 'Çalışan', COUNT(*) AS 'Ders Sayısı'
         FROM yoklamaders LEFT JOIN calisanlar ON yoklamaders.yoklama_calisan_id = calisanlar.calisan_id
         GROUP BY yoklamaders.yoklama_calisan_id";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Çalışan']."',".$result['Ders Sayısı']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Çalışanlar kaç ders girdi?'
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchart1'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['students', 'Ders sayısı'],
         <?php
         $sql = "SELECT calisanlar.calisan_ad AS 'Çalışan', COUNT(*) AS 'Ders Sayısı'
         FROM yoklamaders LEFT JOIN calisanlar ON yoklamaders.yoklama_calisan_id = calisanlar.calisan_id
         GROUP BY yoklamaders.yoklama_calisan_id";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Çalışan']."',".$result['Ders Sayısı']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Çalışanlar kaç derse girdi?'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart.draw(data, options);
      }
    </script>
   
    <!--Calisanlar toplantıdan ne kadar kazandı?-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['students', 'Ders sayısı'],
         <?php
         //$toplantiUcret = 80;
         $sql = "SELECT calisanlar.calisan_ad AS 'Çalışan', (COUNT(*)*$toplantiUcret) AS 'Ders Sayısı'
         FROM yoklama LEFT JOIN calisanlar ON yoklama.yoklama_calisan_id = calisanlar.calisan_id
         GROUP BY yoklama.yoklama_calisan_id";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Çalışan']."',".$result['Ders Sayısı']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Çalışanlar toplantıdan ne kadar  kazandı?'
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchart2'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['students', 'Ders sayısı'],
         <?php
         //$toplantiUcret = 80;
         $sql = "SELECT calisanlar.calisan_ad AS 'Çalışan', (COUNT(*)*$toplantiUcret) AS 'Ders Sayısı'
         FROM yoklama LEFT JOIN calisanlar ON yoklama.yoklama_calisan_id = calisanlar.calisan_id
         GROUP BY yoklama.yoklama_calisan_id";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Çalışan']."',".$result['Ders Sayısı']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Çalışanlar toplantıdan ne kadar  kazandı?'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
    </script>
    
    <!--Calisanlar dersten ne kadar kazandı?-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['students', 'Ders sayısı'],
         <?php
         //$toplantiUcret = 80;
         $sql = "SELECT calisanlar.calisan_ad AS 'Çalışan', (COUNT(*)*$dersUcret) AS 'Ders Sayısı' FROM yoklamaders LEFT JOIN calisanlar ON yoklamaders.yoklama_calisan_id = calisanlar.calisan_id GROUP BY yoklamaders.yoklama_calisan_id";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Çalışan']."',".$result['Ders Sayısı']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Çalışanlar dersten ne kadar  kazandı?'
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchart3'));

        chart.draw(data, options);
      }
    </script>
     <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['students', 'Ders sayısı'],
         <?php
         //$toplantiUcret = 80;
         $sql = "SELECT calisanlar.calisan_ad AS 'Çalışan', (COUNT(*)*$dersUcret) AS 'Ders Sayısı' FROM yoklamaders LEFT JOIN calisanlar ON yoklamaders.yoklama_calisan_id = calisanlar.calisan_id GROUP BY yoklamaders.yoklama_calisan_id";
         $fire = mysqli_query($con,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['Çalışan']."',".$result['Ders Sayısı']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Çalışanlar dersten ne kadar  kazandı?'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart3'));

        chart.draw(data, options);
      }
    </script>

     <!--Toplam ödenecek miktar grafikleri-->
    
   




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
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/first/nstack/showDers.php">Ders Katılımcıları</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/first/grafik/index2.php">Grafik</a>
                </li>
                
                </ul>
            </div>
        </div>
    </nav>
 
    <div id="barchart1" style="width: 900px; height: 500px;"></div>
    <div id="piechart1" style="width: 900px; height: 500px;"></div>
    
    <div id="barchart2" style="width: 900px; height: 500px;"></div>
    <div id="piechart2" style="width: 900px; height: 500px;"></div>
    
    <div id="barchart3" style="width: 900px; height: 500px;"></div>
    <div id="piechart3" style="width: 900px; height: 500px;"></div>
   

  </body>
</html>