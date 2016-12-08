<?php
// The function header by sending raw excel
    header("Content-type: application/vnd-ms-excel"); 
// Defines the name of the export file "codelution-export.xls"
    $curdate = date("md");
    header("Content-Disposition: attachment; filename=SLPonline_PartnerData".$curdate.".xls");
    $username = "slpuser"; 
    $password = "turtles9"; 
    $host = "localhost"; 
    $dbname = "slponline"; 
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
    if ($_GET['type']=="partners") {
    	$_SESSION['exporttype'] = "partners";
    	include 'exportdata.php';
    } else {
    	$_SESSION['exporttype'] = "jobs";
    	include 'exportdata.php';	
    }
?>
