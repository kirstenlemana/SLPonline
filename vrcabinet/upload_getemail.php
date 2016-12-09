<?php
    require "../zxcd9.php";
    echo "<head>";
    echo '<meta name="viewport" content="width=900, initial-scale=1, user-scalable=no">';
    echo "</head>";
    echo "<div style='width:100%;text-align:justify;overflow:none;>'";
    if ($_SESSION['permlvl']>0) {
    echo "NPMO: <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
    $par = "NPMO";
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "NCR";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "CAR";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION I";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION II";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION III";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION IV-A";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION IV-B";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION V";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION VI";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION VII";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION VIII";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION IX";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION X";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION XI";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "REGION XII";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "CARAGA";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "ARMM";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    $par = "NIR";
    echo $par.": <br>";
    $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region=:region ");
            $stmt->bindParam(':region', $par);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "\"".$row['emailaddress']."\",";
            }
    echo "<hr>";
    }
?>
