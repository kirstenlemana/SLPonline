<?php
require "zxcd9.php";

//start post

if(!empty($_POST)) 
{ 

        if (empty($_POST['oldpass'])) {
            die("Please enter your old password");
        }
        if (empty($_POST['newpass'])) {
            die("Please enter your new password");
        }
        if (empty($_POST['newpass2'])) {
            die("Please re-type your new password");
        }
        if ($_POST['newpass'] != $_POST['newpass2']) {
            die("Passwords do not match");
        }
        if (strlen($_POST['newpass']) < 6 || strlen($_POST['newpass2']) < 6) {
            die("Passwords must be at least six (6) characters in length");
        }

        
        $query = " 
            SELECT 
                id, 
                password, 
                salt  
            FROM hr_db 
            WHERE 
                id = :id
        "; 
         
        $query_params = array( 
            ':id' => $_SESSION['id'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        }
         
        $row = $stmt->fetch(); 
        if($row) 
        { 
            $check_password = hash('sha256', $_POST['oldpass'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) 
            { 
                $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
                $password = $_POST['newpass'];
                $password = hash('sha256', $password . $salt);
                for($round = 0; $round < 65536; $round++) 
                { 
                    $password = hash('sha256', $password . $salt); 
                }
                $query = " 
                    UPDATE hr_db 
                    SET password = :password, 
                        salt = :salt  
                    WHERE 
                        id = :id
                ";

                $query_params = array( 
                    ':id' => $_SESSION['id'], 
                    ':password' => $password, 
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

            } 
        } else {
            die("Incorrect password");
        }

}//end post
     
?>