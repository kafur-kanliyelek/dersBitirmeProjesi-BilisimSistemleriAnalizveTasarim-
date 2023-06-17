<?php

//fetch.php

include('database_connection.php');

if(isset($_POST["year"]))
{
 $query = "
 SELECT * FROM yoklama 
 WHERE yoklama.yoklama_calisan_id = '".$_POST["yoklama_calisan_id"]."' 
 ORDER BY yoklama.yoklama_calisan_id ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'month'   => $row["month"],
   'profit'  => floatval($row["profit"])
  );
 }
 echo json_encode($output);
}

?>