<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) { 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = test_input($_POST['id']);
        $parts = explode('/', $_POST['startdate']);
        $sdate  = "$parts[2]-$parts[0]-$parts[1]";
        $parts = explode('/', $_POST['enddate']);
        $edate  = "$parts[2]-$parts[0]-$parts[1]";
        $remarks = test_input($_POST["remarks"]);
        $time1 = test_input($_POST["starttime"]);
        $time2 = test_input($_POST["endtime"]);
        $event = test_input($_POST["event"]);
        $venue = test_input($_POST["venue"]);
        $query = "INSERT IGNORE INTO hr_rover (refid, startdate, starttime, enddate, endtime, event, venue, remarks, added, addedby) VALUE
        (:id, :sdate, :stime, :edate, :etime, :event, :venue, :remarks, :added, :addedby)"; 
        $query_params = array( 
            ':id' => $id, 
            ':sdate' => $sdate,
            ':stime' => $time1,
            ':edate' => $edate,
            ':etime' => $time2, 
            ':event' => $event, 
            ':venue' => $venue,  
            ':remarks' => $remarks, 
            ':added' => date("Y-m-d"), 
            ':addedby' => $_SESSION["id"] 
        ); 
         try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
        $refid = $db->lastInsertId();
        $subsector = $_POST['subsector'];
        if ($subsector!="") {
        $subsector = explode(",", $subsector);
        $stmt = $db->prepare("INSERT INTO hr_RVtags (roverid, hrdbid) VALUES (:roverid, :hrdbid)");
        $stmt->bindParam(':roverid', $refid);
        $stmt->bindParam(':hrdbid', $hrdbid);
        $hrdbid = $_SESSION["id"];
        $stmt->execute();
            foreach($subsector as $val) {
                $hrdbid = $val;
                $stmt->execute();
                addNotification($val, $_SESSION['firstname'], "tagged you in", "ROVER", "http://slp.ph/hr/viewrover.php?id=".$refid);
            }
        }
        echo "good";
}//end post
?>
