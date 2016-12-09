<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) { 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = test_input($_POST['id']);
        $name = test_input($_POST["twgname"]);
        $type = test_input($_POST["twgtype"]);
        $status = test_input($_POST["twgstatus"]);
        $membership = test_input($_POST["twgmember"]);
        $query = "INSERT IGNORE INTO hr_groups (HRDBid, groupleader, groupname, groupdesc, isactive) VALUES (:HRDBid, :groupleader, :groupname, :groupdesc, :isactive)"; 
        $query_params = array( 
            ':HRDBid' => $id,
            ':groupleader' => $membership,
            ':groupname' => $name,
            ':groupdesc' => $type,
            ':isactive' => $status
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
        echo "good";
}//end post
?>
