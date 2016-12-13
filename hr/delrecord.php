<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) { 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = test_input($_POST['id']);
        $deleter = test_input($_POST['deleter']);
        $query = "
        INSERT into hr_deleted (  
            id,
            firstname,
            middlename, 
            lastname, 
            nickname, 
            extname, 
            sex, 
            birthdate, 
            emailaddress, 
            contactnumber, 
            designation, 
            position, 
            sg, 
            employstatus, 
            employdate, 
            fundsource, 
            region, 
            province,
            municipality, 
            remarks, 
            encoded, 
            confirmed, 
            password, 
            salt, 
            logincount, 
            comptype, 
            compyear, 
            compstatus, 
            compnotes, 
            permlvl ) 
        SELECT 
            id, 
            firstname,
            middlename, 
            lastname, 
            nickname, 
            extname, 
            sex, 
            birthdate, 
            emailaddress, 
            contactnumber, 
            designation, 
            position, 
            sg, 
            employstatus, 
            employdate, 
            fundsource, 
            region, 
            province,
            municipality, 
            remarks, 
            encoded, 
            confirmed, 
            password, 
            salt, 
            logincount, 
            comptype, 
            compyear, 
            compstatus, 
            compnotes, 
            permlvl 
        FROM hr_db WHERE id=:id";
        $query_params = array( 
            ':id' => $id 
            //':deleted' => $deleter,
            //':deletedby' => date("Y-m-d")
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
        $query = " UPDATE hr_deleted SET deleted=:deleted, deletedby=:deletedby WHERE id = :id";
        $query_params = array( 
            ':id' => $id,
            ':deleted' => date("Y-m-d"),
            ':deletedby' => $deleter,
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
        $query = " DELETE FROM hr_db WHERE id = :id";
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
