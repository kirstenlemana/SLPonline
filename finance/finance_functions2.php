<?php
		require "../zxcd9.php";
		if(!empty($_POST)) 
		{ 
			if($_POST['action'] == "admincost") {
			$type = test_input($_POST['type']);
			$region = test_input($_POST['region']);
			if ($region == "cmfviewall" || $region == "drviewall") {
			    $stmt = $db->prepare("SELECT uacs, SUM(amount) FROM fin_wfp_admin WHERE type=:type GROUP BY uacs ORDER BY amount DESC");
			    $stmt->bindParam(':type', $type);
			} else {
			    $stmt = $db->prepare("SELECT uacs, SUM(amount) FROM fin_wfp_admin WHERE type=:type AND REGION=:REGION GROUP BY uacs ORDER BY amount DESC");
			    $stmt->bindParam(':type', $type);
			    $stmt->bindParam(':REGION', $region);
			}
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
				echo $row[1].",";
				}
		    }
		    if($_POST['action'] == "pamana_admin") {
			$region = test_input($_POST['region']);
			$stmt = $db->prepare("SELECT uacs, SUM(amount) FROM fin_wfp_pamanaadmin WHERE REGION=:REGION GROUP BY uacs ORDER BY amount DESC");
			$stmt->bindParam(':REGION', $region);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
				echo $row[1].",";
				}
		    }
		}
?>
