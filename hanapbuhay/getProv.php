<?php
require "../zxcd9.php";
if(!empty($_POST["region"])) {
		$reg = test_input($_POST["region"]);
			  $query = "SELECT * FROM lib_provinces WHERE regid = :reg"; 
              $query_params = array(':reg' => $reg);
              try 
              { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
              catch(PDOException $ex) 
              { die("Failed to run query: " . $ex->getMessage()); } 
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 echo "<option value='".$row["provid"]."'>".$row['provname']."</option>";
          	  }
} else {
	echo "boom";
}
?>
