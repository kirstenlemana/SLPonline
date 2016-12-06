<table border="1">
    <tr>
		<th>FIRSTNAME</th>
		<th>MIDDLENAME</th>
		<th>LASTNAME</th>
		<th>NICKNAME</th>
		<th>EXTNAME</th>
		<th>SEX</th>
		<th>BIRTHDATE</th>
		<th>EMAIL</th>
		<th>CONTACTNUMBER</th>
		<th>DESIGNATION</th>
		<th>POSITION</th>
		<th>SG</th>
		<th>EMPLOYMENT STATUS</th>
		<th>EMPLOYMENT DATE</th>
		<th>FUNDSOURCE</th>
		<th>REGION</th>
		<th>PROVINCE</th>
		<th>MUNICIPALITY</th>
		<th>REMARKS</th>
		<th>ENCODED</th>
		<th>ACTIVE</th>
		<th>COMP TYPE</th>
		<th>COMP YEAR</th>
		<th>COMP CONDITION</th>
		<th>COMP NOTES</th>
	</tr>
	<?php

$username = "slpuser"; 
$password = "turtles9"; 
$host = "localhost"; 
$dbname = "slponline"; 

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
try 
{ 
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    $db->exec("SET time_zone = '+0:00'");
    echo "SLP ONLINE (http://hr.slp.ph)<br>";
    echo "Downloaded on ".date("m/d/Y H:i:s");
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

$filter = $_SESSION['filter'];
if ($filter == "NPMO") {
$stmt = $db->prepare("SELECT firstname, middlename, lastname, nickname, extname, sex, birthdate, emailaddress, contactnumber, designation, position, sg, employstatus, employdate, fundsource, region, province, municipality, remarks, encoded, confirmed, comptype, compyear, compstatus, compnotes  FROM hr_db"); 
} else {
$stmt = $db->prepare("SELECT firstname, middlename, lastname, nickname, extname, sex, birthdate, emailaddress, contactnumber, designation, position, sg, employstatus, employdate, fundsource, region, province, municipality, remarks, encoded, confirmed, comptype, compyear, compstatus, compnotes  FROM hr_db WHERE region = '".$filter."'"); 
}

$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
      echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td><td>'.$row[7].'</td><td>'.$row[8].'</td><td>'.$row[9].'</td><td>'.$row[10].'</td><td>'.$row[11].'</td><td>'.$row[12].'</td><td>'.$row[13].'</td><td>'.$row[14].'</td><td>'.$row[15].'</td><td>'.$row[16].'</td><td>'.$row[17].'</td><td>'.$row[18].'</td><td>'.$row[19].'</td><td>'.$row[20].'</td><td>'.$row[21].'</td><td>'.$row[22].'</td><td>'.$row[23].'</td><td>'.$row[24].'</td></tr>';
}
?>
</table>