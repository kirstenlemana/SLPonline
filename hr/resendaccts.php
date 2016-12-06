<?php
require("../mailer/PHPMailerAutoload.php");
require("../mailer/class.phpmailer.php");
require("../mailer/class.smtp.php");
require "../zxcd9.php";
//$stmt = $db->prepare("SELECT firstname, emailaddress, password FROM hr_db WHERE region = 'REGION VIII' AND confirmed = '0' OR emailaddress = 'jmodelacruz@e-dswd.net' LIMIT 40 OFFSET 80");
$stmt->execute();
$namearray = [];
$emailarray = [];
$passarray = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $namearray[] = $row['firstname'];
    $emailarray[] = $row['emailaddress'];
    $passarray[] = $row['password'];
}

$i = 0;
foreach ($namearray as $name) {
  
ob_start();
?>
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
                    <a href="http://slp.ph/hr/add/confirm.php?confirm=<?php echo $passarray[$i]; ?>" target="_blank" style="color:#FFFFFF; text-decoration:none;">CONFIRM ACCOUNT</a>
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
        $mail = new PHPMailer();
        $mail->IsSMTP();
        
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "livelihood@dswd.gov.ph";
        $mail->Password = "slp12345";
        $mail->From = "livelihood@dswd.gov.ph";
        $mail->FromName = "Livelihood";


        $mail->Subject = "[SLP] BOOM! We've started it for you, ".$name.".";
        $mail->IsHTML(true);
        $mail->Body = $myvar;
        $mail->AddAddress($emailarray[$i]);
        
       if(!$mail->Send()) {
          echo "Mail Error: " . $mail->ErrorInfo;
       } else {
          echo "Sent: ".$name."<br>";
       }
$i++;
}
echo "done";
 /*
        
*/?>