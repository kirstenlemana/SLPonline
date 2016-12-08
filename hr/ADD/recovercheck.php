<?php
require("../../mailer/PHPMailerAutoload.php");
require("../../mailer/class.phpmailer.php");
require("../../mailer/class.smtp.php");
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
if(!empty($_POST)) {
  if (empty($_POST["password"])) {
     echo "password missing";
     die;
   } else {
     $password = test_input($_POST["password"]);
   }
   if (empty($_POST["password2"])) {
     echo "password missing";
     die;
   } else {
     $password2 = test_input($_POST["password2"]);
   }
if ($_POST['password'] != $_POST['password2']) {
      echo "passwords do not match";
      die;
   }
    $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
    $password = $_POST['password'];
    $password = hash('sha256', $password . $salt);
    for($round = 0; $round < 65536; $round++) { 
    $password = hash('sha256', $password . $salt); 
   }
  $query = "UPDATE hr_db SET password = :password, salt = :salt WHERE password = :confirm";
  $query_params = array( 
            ':password' => $password,
            ':salt' => $salt,
            ':confirm' => $_POST['confirm']
        );
  try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params);
       } 
        catch(PDOException $ex) { 
            die("Failed to run queryyy: " . $ex->getMessage()); 
        }
        $query = "SELECT emailaddress FROM hr_db WHERE salt = :salt"; 
        $query_params = array( 
            ':salt' => $salt
        ); 
        try { 
            $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch();
        $from = "noreply@slp.ph";
        $fromname = "SLP Online";
ob_start();
?>
<body>
<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr style="background-color:#4285f4; height:8em; padding-top:2em;color:#fff">
        <td align="center" width="100%">
           <img src="http://i.imgur.com/sREcfLZ.png" style="height:2.8em"><br>
        </td>
    </tr>
</table>
<div class="row" style="display:block">
    <div style="margin:2em 10% 0 10%">
      <p class="lead" style="font-family: Helvetica; color:#0A0A23; font-size:14px">Your request to reset your password has been successfully completed! Please see your new login details below.<br>
      </p>
    </div>
  </div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica">
    <tr style="padding-top:2em;color:#000">
        <td align="center" width="25%"></td>
        <td align="center" width="50%" style="text-align:left">
            Username: <b><?php echo $row['emailaddress']; ?></b><br>
            Password: <b><?php echo $_POST['password']; ?></b><br>
        </td>
        <td align="center" width="25%"></td>
    </tr>
</table>
  <div class="row" style="display:block;padding-top:0;font-family:Helvetica">
    <div style="margin:0em 10% 0 10%"><center><br>
      <p style="font-size:11px;color:#aaa">This is an automated email, replies cannot be read.</p>
      <p style="font-size:20px;color:#aaa;">SLP<br>
      </p>
    </div>
  </div>
</div><!--endcontainer-->
</body>
<?php
        $myvar = ob_get_clean();
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "info@slp.ph";
        $mail->Password = "turtles98!!";
        $mail->From = "info@slp.ph";
        $mail->FromName = "SLP";
        $mail->IsHTML(true);
        $mail->Subject = "New Password for SLP Online";
        $mail->Body = $myvar;
        $mail->AddAddress($row['emailaddress']);
        if(!$mail->Send()) {
          echo "Mail Error: " . $mail->ErrorInfo;
       }
          echo "loginok";
}
?>
