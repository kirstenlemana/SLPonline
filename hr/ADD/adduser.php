<?php
require("../../mailer/PHPMailerAutoload.php");
require("../../mailer/class.phpmailer.php");
require("../../mailer/class.smtp.php");
require "../../zxcd9.php";

//generatepassword
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
//start post
if(!empty($_POST)) 
{ 
//filter input
$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
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
     $midname = test_input($_POST["midname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$midname)) {
       echo "middlename"; 
       die;
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
    if (empty($_POST["region"])) {
     echo "Missing region";
     die;
   } else {
     $lastname = test_input($_POST["lastname"]);
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
      echo "emailaddress";
      die;
    } else {
      $email = test_input($_POST["emailaddress"]);
    if(!filter_var($_POST['emailaddress'], FILTER_VALIDATE_EMAIL)) { 
      echo "emailaddress"; 
      die;
        } 
    }
      $birthdate = test_input($_POST["birthdate"]);
    if (!preg_match("/^[0-9\/]*$/",$birthdate)) {
      echo "birthdate";
      die;
    }
      $contactnumber = test_input($_POST["contactnumber"]);
    if (!preg_match("/^[0-9]*$/",$contactnumber)) {
      echo "contactnumber"; 
      die;
    }
      $employdate = test_input($_POST["employdate"]);
    if (!preg_match("/^[0-9\/]*$/",$employdate)) {
      echo "employdate";
      die;
    }
      $remarks = test_input($_POST["remarks"]);
    if (!preg_match("/^[a-zA-Z0-9 .]*$/",$remarks)) {
       echo "remarks"; 
       die;
    } 
       //EMAIL=====================
        $query = " 
            SELECT 
                1 
            FROM hr_db 
            WHERE 
                emailaddress = :emailaddress 
        "; 
        $query_params = array( 
            ':emailaddress' => $_POST['emailaddress'] 
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
        $row = $stmt->fetch(); 
        if($row) { 
            die("email exists"); 
        } 
        //END EMAIL=====================
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = generateRandomString();
        $password = hash('sha256', $password . $salt);
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
        $query2 = " 
            INSERT IGNORE INTO hr_db ( 
                firstname, 
                middlename, 
                lastname, 
                nickname, 
                extname, 
                sex, 
                birthdate, 
                emailaddress, 
                contactnumber, 
                designation, 
                position, 
                sg, 
                employstatus, 
                employdate, 
                fundsource, 
                region, 
                province, 
                municipality, 
                remarks,
                password, 
                salt,
                comptype,
                compyear,
                compstatus,
                compnotes,
                encoded, 
                encodedby 
            ) VALUES ( 
                :firstname, 
                :middlename, 
                :lastname, 
                :nickname, 
                :extname, 
                :sex, 
                :birthdate, 
                :emailaddress, 
                :contactnumber, 
                :designation, 
                :position, 
                :sg, 
                :employstatus, 
                :employdate, 
                :fundsource, 
                :region, 
                :province, 
                :municipality, 
                :remarks, 
                :password, 
                :salt,
                :comptype,
                :compyear,
                :compstatus,
                :compnotes, 
                :encoded, 
                :encodedby
            ) 
        "; 
        $parts = explode('/', $_POST['birthdate']);
        $bdate  = "$parts[2]-$parts[0]-$parts[1]";
        $parts2 = explode('/', $_POST['employdate']);
        $edate  = "$parts2[2]-$parts2[0]-$parts2[1]";
        switch ($_POST['position']) {
          case 'Administrative Aide IV':
            $sglevel = 4;
            break;
          case 'Administrative Officer II':
            $sglevel = 11;
            break;
          case 'Deputy Program Manager':
            $sglevel = 27;
            break;
          case 'Director':
            $sglevel = 28;
            break;
          case 'Information Technology Officer II':
            $sglevel = 22;
            break;
          case 'Information Technology Officer I':
            $sglevel = 19;
            break;
          case 'Project Development Officer IV':
            $sglevel = 22;
            break;
          case 'Project Development Officer III':
            $sglevel = 18;
            break;
          case 'Project Development Officer II':
            $sglevel = 15;
            break;
          default:
            # code...
            break;
        }
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
        $query_params2 = array( 
            ':firstname' => $firstname, 
            ':middlename' => $midname, 
            ':lastname' => $lastname, 
            ':nickname' => $nickname, 
            ':extname' => $extname, 
            ':sex' => $_POST['sex'], 
            ':birthdate' => $bdate, 
            ':emailaddress' => $email, 
            ':contactnumber' => $contactnumber, 
            ':designation' => $_POST['designation'], 
            ':position' => $_POST['position'], 
            ':sg' => $sglevel,
            ':employstatus' => $_POST['employstatus'], 
            ':employdate' => $edate, 
            ':fundsource' => $_POST['fundsource'], 
            ':region' => $_POST['region'], 
            ':province' => $_POST['province'], 
            ':municipality' => $_POST['municipality'], 
            ':remarks' => $remarks,
            ':password' => $password,
            ':salt' => $salt,
            ':comptype' => $comptype,
            ':compyear' => $compyear,
            ':compstatus' => $compstatus,
            ':compnotes' => $compnotes,
            ':encoded' => date("Y-m-d"),
            ':encodedby' => $_SESSION['id']
        ); 
        try 
        { 
      // Execute the query to create the user 
            $stmt = $db->prepare($query2); 
            $result = $stmt->execute($query_params2);
        } 
        catch(PDOException $ex) { 
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
      <img src="http://slp.ph/imgs/slponlineteaser.png">
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
        As the first installment in the creation of a fully integrated <b>SLP Online</b> system, we are proud to announce the launch of a Human Resource (HR) system which will serve as the foundation for all future systems!</p>
      </td>
      </tr>
      </table>
    </td>
    </tr>
    </table>
    <table width="100%" style="border-spacing:0" border=0>
    <tr>
    <td style="vertical-align:top;padding-bottom:10px;padding-left:70px;padding-right:70px;padding-top:28px">
      <table width="100%" style="border-spacing:0" border=0>
      <td style="text-align:center"><center>
        <img src="http://slp.ph/imgs/slphr_diagram.png" width="300px"></center>
    </td>
      </table>
    </td>
    </tr>
    </table>
    <table width="100%" style="border-spacing:0" border=0>
    <tr>
    <td style="vertical-align:top;padding-bottom:10px;padding-left:70px;padding-right:70px;padding-top:28px">
      <table width="100%" style="border-spacing:0" border=0>
      <tr>
      <td>
      <p style="Margin-top:0;font-weight:normal;color:#677483;font-family:sans-serif;font-size:14px;line-height:25px;Margin-bottom:15px">
        Because we value your time, we have taken care of all registration details and have created an account for YOU.</p>
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
      <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;vertical-align:top;text-align:center">
      <p style="Margin-top:0;font-weight:normal;color:#677483;font-family:sans-serif;font-size:14px;line-height:25px;Margin-bottom:15px">
        All you need to do now is to confirm your account and check if we did it correctly.<br><center>
        <table border="0" cellpadding="0" cellspacing="0" style="background-color:#4285f4; border:1px solid #4285f4; border-radius:5px;">
            <tr>
                <td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:15px; font-weight:bold; line-height:150%; padding-top:11px; padding-right:30px; padding-bottom:11px; padding-left:30px;">
                    <a href="http://slp.ph/hr/add/confirm.php?confirm=<?php echo $password; ?>" target="_blank" style="color:#FFFFFF; text-decoration:none;">CONFIRM ACCOUNT</a>
                </td>
            </tr>
        </table>
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
        if ($_POST['nickname'] == "") {
          $subjectname = $_POST['firstname'];
        } else {
          $subjectname = $_POST['nickname'];
        }
        $mail = new PHPMailer();
        $mail->IsSMTP();
        require("../../lcefgmai.php");
        $mail->Subject = "[SLP] BOOM! We've started it for you, ".$subjectname.".";
        $mail->IsHTML(true);
        $mail->Body = $myvar;
        $mail->AddAddress($_POST['emailaddress']);
        if(!$mail->Send()) {
          echo "Mail Error: " . $mail->ErrorInfo;
       } else {
          echo "loginok";
       }
}//end post
?>
