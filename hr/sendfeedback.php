<?php
//connect
$username = "jmigdela_slpmain"; 
$password = "turtles98"; 
$host = "localhost"; 
$dbname = "jmigdela_slponline";

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
try 
{ 
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    $db->exec("SET time_zone = '+0:00'");
} 
catch(PDOException $ex) 
{ 
    die("Failed to connect: " . $ex->getMessage()); 
} 
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
session_start(); 
$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['discard_after'] = $now + 1800;
//testinput
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if(!empty($_POST)) 
{ 
//filter input

$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


   if (empty($_POST["feedback"])) {
      echo "Form is empty";
      die;
    } else {
        $feedback = test_input($_POST["feedback"]);
    }

    if (empty($_SESSION["id"])) {
        if ($_POST["page"] != "slpph") {
          echo "You must login to send feedback";
          die;
        }
    }
         
        $query2 = " 
            INSERT IGNORE INTO hr_feedback ( 
                page,
                feedback, 
                feedbacker
            ) VALUES ( 
                :page, 
                :feedback, 
                :feedbacker
            ) 
        "; 
         
        $query_params2 = array( 
            ':page' => $_POST['page'], 
            ':feedback' => $feedback, 
            ':feedbacker' => $_POST['feedbacker'],  
        ); 
         
        try 
        {
            $stmt = $db->prepare($query2); 
            $result = $stmt->execute($query_params2);

        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run queryyy: " . $ex->getMessage()); 
        } 
        echo "good";
        
}//end post
     
?>