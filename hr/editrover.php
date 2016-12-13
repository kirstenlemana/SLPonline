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
        $query = " 
            UPDATE hr_rover 
            SET startdate = :startdate, 
                starttime = :starttime, 
                enddate = :enddate, 
                endtime = :endtime, 
                event = :event, 
                venue = :venue, 
                remarks = :remarks, 
                added = :added, 
                addedby = :addedby 
            WHERE 
                id = :id
        ";
        $query_params = array( 
            ':id' => $id, 
            ':startdate' => $sdate,
            ':starttime' => $time1,
            ':enddate' => $edate,
            ':endtime' => $time2, 
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
        $subsector = $_POST['subsector'];
        $subsector = explode(",", $subsector);
        $stmt = $db->prepare("INSERT INTO hr_RVtags (roverid, hrdbid) VALUES (:roverid, :hrdbid)");
        $stmt->bindParam(':roverid', $id);
        $stmt->bindParam(':hrdbid', $hrdbid);
        $hrdbid = $_SESSION["id"];
        $stmt->execute();
        foreach($subsector as $val) {
            $hrdbid = $val;
            $stmt->execute();
            addNotification($val, $_SESSION['firstname'], "tagged you in", "ROVER", "http://hr.slp.ph/viewdata/viewrover.php?id=".$id);
        }
        echo "good";
}//end post    
?>
