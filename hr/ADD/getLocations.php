<?php
$username = "jmigdela_slpmain"; 
$password = "turtles98"; 
$host = "localhost"; 
$dbname = "jmigdela_slponline";
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
try { 
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    $db->exec("SET time_zone = '+0:00'");
} 
catch(PDOException $ex) { 
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
if(!empty($_POST["action"])) {
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if ($_POST['action']=='province') {
    $query = "SELECT * FROM lib_provinces WHERE regid = :regid"; 
              $query_params = array(':regid' => $_POST['regionid']);
              try { 
                $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
              catch(PDOException $ex) { 
              die("Failed to run query: " . $ex->getMessage()); } 
              echo "<option value=''>Select Province</option>";
              while ($rowl = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='".$rowl["provid"]."'>".$rowl['provname']."</option>";
          	  }
    }
if ($_POST['action']=='citymun') {
    $query = "SELECT * FROM lib_citymuni WHERE provid = :provid"; 
              $query_params = array(':provid' => $_POST['provid']);
              try {
               $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
              catch(PDOException $ex) { 
                die("Failed to run query: " . $ex->getMessage()); } 
              echo "<option value=''>Select City/Municipality</option>";
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='".$row["citymunid"]."'>".$row['citymun_name']."</option>";
              }
    }
} else {
	echo "boom";
}
?>
