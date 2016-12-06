<?php
require("mailer/PHPMailerAutoload.php");
require("mailer/class.phpmailer.php");
require("mailer/class.smtp.php");
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
if(!empty($_POST)) 
{ 
  
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if (empty($_POST["emailaddress"])) {
  die("Please enter email address");
} else {
  if(!filter_var($_POST['emailaddress'], FILTER_VALIDATE_EMAIL)) { 
      die("Invalid email address");
  } 
}


    $query = "SELECT emailaddress, password FROM hr_db WHERE emailaddress = :emailaddress"; 
    $query_params = array( ':emailaddress' => $_POST['emailaddress'] );
    try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        }
        $row = $stmt->fetch(); 
        if($row) { 
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
      <p class="lead" style="font-family: Helvetica; color:#0A0A23; font-size:16px">You are recieving this because you have requested for your password to be reset. Please click on the button below to continue.<br>
      </p>
    </div>
  </div>
<br>
<center>
<div style="width:33%">
<table border="0" cellpadding="0" cellspacing="0" style="width:100%;background-color:#4285f4; border:1px solid #4285f4; border-radius:5px;">
            <tr>
                <td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:16px; font-weight:bold; line-height:150%; padding-top:11px; padding-right:30px; padding-bottom:11px; padding-left:30px;">
                    <a href="http://slp.ph/hr/add/recover.php?id=<?php echo $row['password']; ?>" target="_blank" style="color:#FFFFFF; text-decoration:none;">Recover Password</a>
                </td>
            </tr>
        </table>
</div></center>
  

  <div class="row" style="display:block;padding-top:0;font-family:Helvetica">
    <div style="margin:0em 10% 0 10%"><center>
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
        
        require "lcefgmai.php";

        $mail->IsHTML(true);
        $mail->Subject = "SLP Online Password Recovery";
        $mail->Body = $myvar;
        $mail->AddAddress($_POST['emailaddress']);
                     if(!$mail->Send()) {
                        die("Mail Error");
                     } else {
                        echo "loginok";
                     }
        
        } else {
        	die("No records matching that email address was found");
        }

} //emptypost

?>