<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) { 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = test_input($_POST['id']);
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = "dswd1234";
        $password = hash('sha256', $password . $salt);
        for($round = 0; $round < 65536; $round++) { 
            $password = hash('sha256', $password . $salt); 
        } 
        $query = "UPDATE hr_db SET password = :pass, salt = :salt WHERE id=:id"; 
        $query_params = array( 
            ':id' => $id, 
            ':pass' => $password, 
            ':salt' => $salt 
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
