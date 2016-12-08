<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP | Partners</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="../../imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../imgs/favicon.ico" type="image/x-icon">
    <script src="../../js/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" href="../../css/flatbootstrap.css"/>
    <style>
body {
    background-color: #f7f9fb;
    background-size: cover;
    font-family: "Lato";
}
.navbar-nav > li > a, .navbar-brand {
    padding-top:15px !important; 
    padding-bottom:0 !important;
    height: 45px;
}
.navbar {min-height:45px !important;background-color: #000}
#bootstrapSelectForm .selectContainer .form-control-feedback {
    right: -15px;
}
.slidedown {
  -webkit-transform: scaleY(0);
       -o-transform: scaleY(0);
      -ms-transform: scaleY(0);
          transform: scaleY(0);
  -webkit-transform-origin: top;
       -o-transform-origin: top;
      -ms-transform-origin: top;
          transform-origin: top;
  -webkit-transition: -webkit-transform 0.2s ease;
            -o-transition: -o-transform 0.2s ease;
          -ms-transition: -ms-transform 0.2s ease;
                  transition: transform 0.2s ease;
}
.slidedown.active {
  -webkit-transform: scaleY(1);
       -o-transform: scaleY(1);
      -ms-transform: scaleY(1);
          transform: scaleY(1);
}
.successcontent {
  display:none;
}
.cleanselect {
  -webkit-appearance:none;-moz-appearance:none;-ms-appearance:none;appearance:none;background:#fff url(imgs/arrows.png) no-repeat right 9px;
}
.mainlink {
  font-size: 1.8em;
  margin-top: 1px;
}
.form-group input {
  margin-bottom:1em;
}
</style>
</style>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" >
  <div class="container">
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="font-weight:900"><img src="../imgs/slpsmall.png" style="display:inline;margin-right:0.5em;margin-top:-0.19em">SLP</a>
    </div>
   <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid" id="maincont">
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
//testinput
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
if(!empty($_GET)) { 
        $query = " 
            SELECT 
                id, 
                emailaddress, 
                password, 
                salt
            FROM hr_db 
            WHERE 
                password = :password
        "; 
        $query_params = array( 
            ':password' => test_input($_GET['id']) 
        ); 
        try { 
          $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) { 
        die("Failed to run query: " . $ex->getMessage()); } 
          $row = $stmt->fetch();
        if ($row['password'] == "") {
          echo "This password link is not valid or has already expired. Please check if you've already changed your password.<br>If you feel this is an error, please email <b>jmodelacruz@e-dswd.net";
          die;
        }
        } else {
          echo "This password link is not valid or has already expired. Please check if you've already changed your password.<br>If you feel this is an error, please email <b>jmodelacruz@e-dswd.net";
          die;
}
//ENDGET
?>
     <div class="row" style="margin-top:3em;">
      <div class="col-md-offset-1 col-md-10"><center>
        We have confirmed your identity. You may now choose a new password for your account.
      </div>
     </div>
     <div class="row" style="margin-top:2em;">
      <form action="recover.php" method="post" id="resetForm" autocomplete="off">
                        <div class="col-md-offset-3 col-sm-6">
                              <div class="form-group">
                                  <label for="nickname" class="col-sm-4 control-label">New Password</label>
                                  <div class="col-sm-8" style="padding-right:0px">
                                    <input name="password" type="password" class="form-control" id="password" >
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="extname" class="col-sm-4 control-label">Re-type New Password</label>
                                  <div class="col-sm-8" style="padding-right:0px">
                                    <input name="password2" type="password" class="form-control" id="password2" >
                                    <input name="confirm" type="hidden" class="form-control" id="confirm" value="<?php echo $_GET['id'];?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <button id="resetpass" type="submit" class="btn col-md-offset-8 col-md-4 btn-success">Submit</button>
                                </div>
                        </div>
        </div>
</form>
</div><!--endcontainer-->
            <div class="container-fluid" id="successcont"><center>
            <font size="90px" color="#5cb85c"><span class="glyphicon glyphicon-ok"></font></span><br>
            <font size="2">Success! You may now login using your new password.</font>
            <br><br>
            <a href="http://slp.ph"><button class="btn btn-primary">Login</button></a>
            </div>
<script>
$(document).ready(function() {
$("#successcont").hide();
$("#resetForm").submit(function() {
  event.preventDefault();
  document.getElementById("resetpass").disabled = true;
  var resetData = {
      'password'        : $('input[name=password]').val(),
      'password2'       : $('input[name=password2]').val(),
      'confirm'         : $('input[name=confirm]').val()
  };
  $.ajax({
       url: "recovercheck.php",
       type: "POST",
       data: resetData,
       success: function(data){
          if (data == "loginok") {
            $("#maincont").hide();
            $("#successcont").show();
          } else {
            $("#successcont").show();
            $("#successcont").html(data);
          }
       }
    });//endajax
  });
});
</script>
</body>
</html>
