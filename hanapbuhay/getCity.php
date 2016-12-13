<?php
require "../zxcd9.php";
if(!empty($_POST["provi"])) {
		$prov = test_input($_POST["provi"]);
			  $query = "SELECT * FROM lib_citymuni WHERE provid = :prov"; 
              $query_params = array(':prov' => $prov);
              try 
              { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
              catch(PDOException $ex) 
              { die("Failed to run query: " . $ex->getMessage()); } 
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 echo "<option value='".$row["citymunid"]."'>".$row['citymun_name']."</option>";
          	  }
} else {
	echo "boom";
}
?>
