<?php
require("../../mailer/PHPMailerAutoload.php");
require("../../mailer/class.phpmailer.php");
require("../../mailer/class.smtp.php");
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

//start post
if(!empty($_POST)) 
{ 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

   if (empty($_POST["firstname"])) {
     echo "firstname";
     die;
   } else {
     $firstname = test_input($_POST["firstname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
       echo "firstname"; 
       die;
     }
   }
   if (empty($_POST["midname"])) {
     echo "middlename";
     die;
   } else {
     $midname = test_input($_POST["midname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$midname)) {
       echo "middlename"; 
       die;
     }
   }
   if (empty($_POST["lastname"])) {
     echo "lastname";
     die;
   } else {
     $lastname = test_input($_POST["lastname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
       echo "lastname"; 
       die;
     }
   }

   $nickname = test_input($_POST["nickname"]);
   if (!preg_match("/^[a-zA-Z ]*$/",$nickname)) {
       echo "nickname"; 
       die;
   }

   $extname = test_input($_POST["extname"]);
   if (!preg_match("/^[a-zA-Z .]*$/",$extname)) {
       echo "extname"; 
       die;
   }

   $sex = test_input($_POST["sex"]);
   if (!preg_match("/^[0-9]*$/",$sex)) {
       echo "sex"; 
       die;
   }

   if (empty($_POST["emailaddress"])) {
      echo "Missing emailaddress";
      die;
    } else {
        $email = test_input($_POST["emailaddress"]);
        if(!filter_var($_POST['emailaddress'], FILTER_VALIDATE_EMAIL)) { 
            echo "emailaddress"; 
            die;
        } 
    }
    if (empty($_POST["birthdate"])) {
         echo "birthdate";
         die;
       } else {
         $birthdate = test_input($_POST["birthdate"]);
         if (!preg_match("/^[0-9\/]*$/",$birthdate)) {
           echo "birthdate";
           die;
         }
       }

    $designation = test_input($_POST["designation"]);


    $contactnumber = test_input($_POST["contactnumber"]);
    if (!preg_match("/^[0-9]*$/",$contactnumber)) {
       echo "contactnumber"; 
       die;
    }
    if (empty($_POST["employdate"])) {
         echo "employdate";
         die;
       } else {
         $employdate = test_input($_POST["employdate"]);
         if (!preg_match("/^[0-9\/]*$/",$employdate)) {
           echo "employdate";
           die;
         }
       } 
    $remarks = test_input($_POST["remarks"]);
    if (!preg_match("/^[a-zA-Z0-9 _\.\!]*$/",$remarks)) {
       echo "remarks"; 
       die;
    } 

    $employstatus = test_input($_POST["employstatus"]);

    if (empty($_POST["password"])) {
       echo "password";
       die;
     } else {
       $password = test_input($_POST["password"]);
       if (!preg_match("/^[a-zA-Z0-9. ]*$/",$password)) {
         echo "password"; 
         die;
       }
     }

     if (empty($_POST["confirm"])) {
       echo "confirm empty";
       die;
     } else {
       $confirm = test_input($_POST["confirm"]);
       if (!preg_match("/^[a-zA-Z0-9. ]*$/",$confirm)) {
         echo "confirm"; 
         die;
       }
     }
      
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = $_POST['password'];
        $password = hash('sha256', $password . $salt);
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 

        $query = " 
            UPDATE hr_db 
            SET firstname = :firstname, 
                middlename = :middlename, 
                lastname = :lastname, 
                nickname = :nickname, 
                extname = :extname, 
                sex = :sex, 
                birthdate = :birthdate, 
                emailaddress = :emailaddress, 
                contactnumber = :contactnumber, 
                designation = :designation, 
                employstatus = :employstatus, 
                employdate = :employdate, 
                province = :province, 
                municipality = :municipality, 
                remarks = :remarks, 
                confirmed = :confirmed, 
                confirmdate = :confirmdate, 
                password = :password, 
                salt = :salt, 
                comptype = :comptype,
                compyear = :compyear,
                compstatus = :compstatus,
                compnotes = :compnotes
            WHERE 
                password = :password2
        "; 
         
        $parts = explode('/', $_POST['birthdate']);
        $bdate  = "$parts[2]-$parts[0]-$parts[1]";

        $parts2 = explode('/', $_POST['employdate']);
        $edate  = "$parts2[2]-$parts2[0]-$parts2[1]";
        if ($_POST['comptype'] == "None issued") {
          $comptype = "";
        } else {
          $comptype = $_POST['comptype'];
        }

        if ($_POST['compyear'] == "-") {
          $compyear = "";
        } else {
          $compyear = $_POST['compyear'];
        }

        if ($_POST['compstatus'] == "-") {
          $compstatus = "";
        } else {
          $compstatus = $_POST['compstatus'];
        }

        $query_params = array( 
            ':firstname' => $firstname, 
            ':middlename' => $midname, 
            ':lastname' => $lastname, 
            ':nickname' => $nickname, 
            ':extname' => $extname, 
            ':sex' => $sex, 
            ':birthdate' => $bdate, 
            ':emailaddress' => $email, 
            ':contactnumber' => $contactnumber, 
            ':designation' => $designation, 
            ':employstatus' => $employstatus, 
            ':employdate' => $edate, 
            ':province' => $_POST['province'], 
            ':municipality' => $_POST['municipality'], 
            ':remarks' => $remarks, 
            ':confirmed' => 1, 
            ':confirmdate' => date("Y-m-d"), 
            ':password' => $password,
            ':salt' => $salt,
            ':password2' => $confirm,
            ':comptype' => $comptype,
            ':compyear' => $compyear,
            ':compstatus' => $compstatus,
            ':compnotes' => $compnotes
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params);
        } 
        catch(PDOException $ex) 
        { 
            echo "failed";
            die;
            die("Failed to run queryyy: " . $ex->getMessage()); 
        } 
        $from = "noreply@slp.ph";
        $fromname = "SLP Online";

ob_start();
?>
<body>
<table width=100% cellpadding=12 cellspacing=0 border=0>
  <tr><td><div style="overflow: hidden;"><font size=-1>
    <div style="Margin:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;min-width:100%;background-color:#f1f2f6">


<table style="border-spacing:0;width:100%;background-color:#f1f2f6;table-layout:fixed">
<tr>
<td align="center" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;vertical-align:top">
  <div style="font-size:40px;line-height:40px;min-height:40px;display:block"> </div>
  <center>
<table width="75%" style="border-spacing:0;Margin:0 auto" border=0>
<tr>
<td width="75%" bgcolor="#ffffff" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;vertical-align:top;Margin:0 auto">
    <table width="100%" style="border-spacing:0;background-color:#4285f4;border-left-width:0px;border-left-style:solid;border-left-color:#e2e3e7;border-top-width:1px;border-top-style:solid;border-top-color:#e2e3e7;border-right-width:0px;border-right-style:solid;border-right-color:#e2e3e7;border-top-left-radius:5px;border-top-right-radius:5px;" border=0>
    <tr>
    <td style="vertical-align:top;padding-bottom:10px;padding-left:70px;padding-right:70px;padding-top:20px">
      <table width="100%" style="border-spacing:0" border=0>
      <tr>
      <td style="padding-top:0;padding-bottom:5px;padding-right:0;padding-left:0;vertical-align:top;text-align:center">
      <a href="http://slp.ph"><img src="https://ci6.googleusercontent.com/proxy/Vn84K6UJ7L5E9ZzSDUur3O4eNX5bVE2iuje15_bIwrqUeILh_i9hKXCma6QGJL2vfytXzg=s0-d-e1-ft#http://i.imgur.com/sREcfLZ.png"></a>
      </td>
      </tr>
      </table>
    </td>
    </tr>
    </table>
    <table width="100%" style="border-spacing:0" border=0>
    <tr>
    <td style="vertical-align:top;padding-bottom:10px;padding-left:70px;padding-right:70px;padding-top:48px">
      <table width="100%" style="border-spacing:0" border=0>
      <tr>
      <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;vertical-align:top;text-align:left">
      <p style="Margin-top:0;font-weight:normal;color:#677483;font-family:sans-serif;font-size:14px;line-height:25px;Margin-bottom:15px">
        Your account is all set up and ready to use! Once other SLP Online systems are launched, you will be able to log in using the following credentials:
        <br>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:Helvetica;padding-top:2em">
    <tr style="padding-top:2em;">
        <td align="center" width="15%"></td>
        <td align="center" width="70%" style="text-align:left">
            Username: <b><?php echo $_POST['emailaddress']; ?></b><br>
            Password: <b><?php echo $_POST['password']; ?></b>
        </td>
        <td align="center" width="15%"></td>
    </tr>
</table>
      </p>
      </td>
      </tr>
      </table>
    </td>
    </tr>
    </table>
    <table width="100%" style="border-spacing:0" border=0>
    <tr>
    <td style="vertical-align:top;padding-bottom:10px;padding-left:70px;padding-right:70px;padding-top:48px">
      <table width="100%" style="border-spacing:0" border=0>
      <tr>
      <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;vertical-align:top;text-align:left">
      <p style="Margin-top:0;font-weight:normal;color:#677483;font-family:sans-serif;font-size:14px;line-height:25px;Margin-bottom:15px">
        We hope you're excited about this as much as we are! To see what we're currently working on, you can always check out <a href="http://slp.ph" style="color:#4285f4"><b>http://slp.ph</b></a>. Rest assured, we will notify you of updates soon to come. Have a great day!
      </p>
      </td>
      </tr>
      </table>
    </td>
    </tr>
    </table>
    <table width="100%" style="border-spacing:0;background-color:#e2e3e7" border=0>
    <tr>
    <td style="vertical-align:top;padding-bottom:10px;padding-left:70px;padding-right:70px;padding-top:48px;order-spacing:0;background-color:#fff;border-left-width:0px;border-left-style:solid;border-left-color:#e2e3e7;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#e2e3e7;border-right-width:0px;border-right-style:solid;border-right-color:#e2e3e7;border-bottom-left-radius:5px;border-bottom-right-radius:5px;">
      <table width="100%" style="border-spacing:0;background:transparent" border=0>
      <tr>
      <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;vertical-align:top;text-align:center">
      <p style="Margin-top:0;font-weight:normal;color:#bbb;font-family:sans-serif;font-size:14px;line-height:25px;Margin-bottom:15px">
        This is an automated e-mail. Replies cannot be read<br>
        <b>SLP</b><center>
      </p>
      </td>
      </tr>
      </table>
    </td>
    </tr>
    </table>

</td>
</tr>
</table>

<table width="610" style="border-spacing:0;Margin:0 auto">
<tr>
<td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;vertical-align:top">

</td>
</tr>
</table>


</center>
</td>
</tr>
</table>
<div style="font-size:40px;line-height:40px;min-height:40px;display:block"> </div>
</div>
</font></div></table></table></div></div>
</body>
<?php

        $myvar = ob_get_clean();
        $message = 'hallo';
        $mail = new PHPMailer();
        $mail->IsSMTP();
        
        require("../../lcefgmai.php");
        
        $mail->IsHTML(true);

        $mail->Subject = "SLP Online Account Information";
        $mail->Body = $myvar;
        $mail->AddAddress($_POST['emailaddress']);
        
       if(!$mail->Send()) {
          echo "Mail Error: " . $mail->ErrorInfo;
       } else {
          echo "loginok";
       }

}//end post
     
?>