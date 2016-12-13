<?php
    require "../zxcd9.php";
    $participants = explode(',', $_POST['participants']);
    if ($_POST['status'] == "1") {
    		$query = "UPDATE PRTdemand SET reviewed = '".date('Y-m-d')."', status = '1', reviewedby = '".$_SESSION['id']."' WHERE id = :id"; 
            $query_params = array(':id' => $_POST['id']);
            try 
            { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
            catch(PDOException $ex) 
            { die("Failed to run query: " . $ex->getMessage()); }
            echo "good";
  } else if ($_POST['status'] == "2") {
            $stmtz = $db->prepare("UPDATE PRTsupply SET engaged = '', status = '0', engagedto = '' WHERE engagedto = :id");
            $stmtz->bindParam(':id', $engagedto);
            $engagedto = $_POST['id'];
            $stmtz->execute();
            $stmtz = $db->prepare("UPDATE PRTsupply SET status=:status, engaged=:engaged, engagedto=:engagedto WHERE id=:id");
            $stmtz->bindParam(':status', $status);
            $stmtz->bindParam(':engaged', $datetoday);
            $stmtz->bindParam(':engagedto', $engagedto);
            $stmtz->bindParam(':id', $id);
            foreach($participants as $val) {
                $status = 1;
                $datetoday = date('Y-m-d');
                $engagedto = $_POST['id'];
                $id = $val;
                $stmtz->execute();
            }
            $query = " 
                SELECT 
                    COUNT(id) as countcurrent
                FROM PRTsupply 
                WHERE 
                    engagedto = :engagedto
            "; 
            $query_params = array( 
                ':engagedto' => $_SESSION['jobid']
            );
            try 
            { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
            catch(PDOException $ex) 
            { die("Failed to run query: " . $ex->getMessage()); } 
            $row = $stmt->fetch();
            $countcurrent = $row['countcurrent'];
            $query = " 
                SELECT 
                    numopenings 
                FROM PRTdemand
                WHERE 
                    id = :id
            "; 
            $query_params = array( 
                ':id' => $_SESSION['jobid']
            );
            try 
            { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
            catch(PDOException $ex) 
            { die("Failed to run query: " . $ex->getMessage()); } 
            $row = $stmt->fetch();
            $counttotal = $row['numopenings'];
            if (intval($countcurrent) >= intval($counttotal)) {
                $query = "UPDATE PRTdemand SET status = '3', completed = '".date('Y-m-d')."', completedby = '".$_SESSION['id']."' WHERE id = :id"; 
                $query_params = array(':id' => $_SESSION['jobid']);
                try 
                { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
                catch(PDOException $ex) 
                { die("Failed to run query: " . $ex->getMessage()); }    
          } else if (intval($countcurrent) == 0) {
                $query = "UPDATE PRTdemand SET status = '1', completed = '".date('Y-m-d')."', completedby = '".$_SESSION['id']."' WHERE id = :id"; 
                $query_params = array(':id' => $_SESSION['jobid']);
                try 
                { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
                catch(PDOException $ex) 
                { die("Failed to run query: " . $ex->getMessage()); }  
          } else {
                $query = "UPDATE PRTdemand SET status = '2', completed = '".date('Y-m-d')."', completedby = '".$_SESSION['id']."' WHERE id = :id"; 
                $query_params = array(':id' => $_SESSION['jobid']);
                try 
                { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
                catch(PDOException $ex) 
                { die("Failed to run query: " . $ex->getMessage()); }  
            }
            echo "good";
          } else if ($_POST['status'] == "3") {
    		$query = "UPDATE PRTdemand SET approved = '".date('Y-m-d')."', status = '3', approvedby = '".$_SESSION['id']."' WHERE id = :id"; 
            $query_params = array(':id' => $_POST['id']);
            try 
            { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
            catch(PDOException $ex) 
            { die("Failed to run query: " . $ex->getMessage()); }
            $stmtz = $db->prepare("UPDATE PRTsupply SET status=:status, employed=:employed, employedto=:employedto WHERE id=:id");
            $stmtz->bindParam(':status', $status);
            $stmtz->bindParam(':employed', $datetoday);
            $stmtz->bindParam(':employedto', $employedto);
            $stmtz->bindParam(':id', $id);
            foreach($participants as $val) {
                $status = 2;
                $datetoday = date('Y-m-d');
                $employedto = $_POST['id'];
                $id = $val;
                $stmtz->execute();
            }
            echo "good";
    } else if ($_POST['status'] == "4") {
            $query = "UPDATE PRTdemand SET completed = '".date('Y-m-d')."', status = '4', completedby = '".$_SESSION['id']."' WHERE id = :id"; 
            $query_params = array(':id' => $_POST['id']);
            try 
            { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
            catch(PDOException $ex) 
            { die("Failed to run query: " . $ex->getMessage()); }
            echo "good";
    }
?>
