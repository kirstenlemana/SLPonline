<?php
    require "../zxcd9.php";
    //start post
    if(!empty($_POST)) 
    { 
    //filter input
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $id = test_input($_POST['jobid']);
            $query = " DELETE FROM PRTdemand WHERE id = :id";
            $query_params = array( 
                ':id' => $id
            ); 
            try { 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) { 
                die("Failed to run query: " . $ex->getMessage()); 
            } 
            $query = " DELETE FROM PRTdemandtags WHERE demandid = :id";
            $query_params = array( 
                ':id' => $id
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
