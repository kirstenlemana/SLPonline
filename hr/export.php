<?php
// The function header by sending raw excel
header("Content-type: application/vnd-ms-excel");
 // Defines the name of the export file "codelution-export.xls"
$curdate = date("md");
header("Content-Disposition: attachment; filename=SLPonline_HRdata".$curdate.".xls");
 // Add data table
include 'exportdata.php';
?>
