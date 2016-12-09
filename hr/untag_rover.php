<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) { 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $rovid = test_input($_POST['rovid']);
        $hrid = test_input($_POST['hrid']);
        $query = "DELETE FROM hr_RVtags WHERE roverid = :rovid AND hrdbid = :hrdbid";
        $query_params = array( 
            ':rovid' => $rovid,
            ':hrdbid' => $hrid
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
            $row = $stmt->fetch();
        } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
        if ($stmt == true) {
            echo "good";    
        }
}//end post
?>
