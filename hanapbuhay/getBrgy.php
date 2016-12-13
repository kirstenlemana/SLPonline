<?php
require "../zxcd9.php";
if(!empty($_POST["city"])) {
		$city = test_input($_POST["city"]);
			  $query = "SELECT * FROM LIBbrgy WHERE city_code = :city"; 
              $query_params = array(':city' => $city);
              try 
              { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
              catch(PDOException $ex) 
              { die("Failed to run query: " . $ex->getMessage()); } 
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 echo "<option>".$row['brgy_name']."</option>";
          	  }
} else {
	echo "boom";
}
?>
