<?php
require "../zxcd9.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP | HR</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="../css/flatbootstrap.css"/>
    <link rel="stylesheet" href="../css/bootstrapValidator.css"/>
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrapValidator.js"></script>
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
.successcontent {
  display:none;
}
.cleanselect {
  -webkit-appearance:none;-moz-appearance:none;-ms-appearance:none;appearance:none;background:#fff url(../imgs/arrows.png) no-repeat right 9px;
}
.spin {
  -webkit-animation: spin 1000ms infinite linear;
  -moz-animation: spin 1000ms infinite linear;
  -o-animation: spin 1000ms infinite linear;
  animation: spin 1000ms infinite linear;
}

@-moz-keyframes spin {
  from {
    -moz-transform: rotate(0deg);
  }
  to {
    -moz-transform: rotate(360deg);
  }
}

@-webkit-keyframes spin {
  from {
    -webkit-transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(360deg);
  }
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

.disabled {
  background:rgba(1,1,1,0.2);
  border:0px solid;
  cursor:progress;
}
</style>
</head>
<body>
  <script type="text/javascript" language="javascript" class="init">
  function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
</script>
<nav class="navbar navbar-default navbar-static-top" >
  <div class="container">
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../" style="font-weight:900"><img src="../imgs/slpsmall.png" style="display:inline;margin-right:0.5em;margin-top:-0.19em">SLP</a>
    </div>
   <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li style="color:#042d49"><a href="index.php" >View Data</a></li>
        <li style="color:#042d49"><a href="user.php?id=<?php echo $_SESSION['id'];?>" >My Profile</a></li>
      </ul>
      <ul class="nav navbar-nav" style="float:right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:rgba(255,255,255,0.5);"><span class="glyphicon glyphicon-bell"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Notifications: <b>x</b></a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['firstname']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<script type="text/javascript" src="../js/editForm.js"></script>
<div class="container-fluid">
  <div class="row col-md-offset-2 col-md-8" style="border-bottom:2px solid #000;padding-bottom:0">
    <center><img src="../imgs/rover.png" width="120em"></center>
  </div>
  <div class="col-md-offset-1 col-md-5" style="background:#fff;margin-bottom:2em;padding:2em;padding-top:1em">
<?php
echo "<center>";
echo "<h2>Out of Office Today:</h2>";
$query = "SELECT DISTINCT z.addedby, CONCAT(m.firstname, ' ', m.lastname) as name FROM hr_rover z LEFT JOIN hr_db m ON m.id=z.addedby WHERE startdate = DATE(NOW()) OR enddate = DATE(NOW())"; 
try { 
  $stmt = $db->prepare($query); 
  $result = $stmt->execute(); 
} 
catch(PDOException $ex) { 
  die("Failed to run query: " . $ex->getMessage()); 
}
if ($stmt->rowCount() <= 0) {
  echo "<i>-none-</i>";
}
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo ucwords(strtolower($row["name"]))."<BR>";
}
?>
</div>
<div class="col-md-5" style="background:#fff;margin-bottom:2em;padding:2em;padding-top:1em">
<center>
<?php
echo "<h2>Out of Office Tomorrow:</h2>";
$query = "SELECT DISTINCT z.addedby, CONCAT(m.firstname, ' ', m.lastname) as name FROM hr_rover z LEFT JOIN hr_db m ON m.id=z.addedby WHERE enddate = DATE(NOW() + INTERVAL 1 DAY) OR CURDATE() BETWEEN z.startdate AND z.enddate"; 
try { 
  $stmt = $db->prepare($query); 
  $result = $stmt->execute(); 
} 
catch(PDOException $ex) { 
  die("Failed to run query: " . $ex->getMessage()); 
}
if ($stmt->rowCount() <= 0) {
  echo "<i>-none-</i>";
}
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
  echo ucwords(strtolower($row["name"]))."<BR>";
}
?>
</div>

<div class="row col-md-12" style="position:absolute;bottom:1em"><center>
  This page is under development
</div>

</div><!--endcontainer-->
       
<script>
$(document).ready(function() {

$("#loadicon").hide();
  
$("#hrsubmit").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#statusdisp").html('');
  $('#editForm').bootstrapValidator('validate');
  return false;
}); //endHRSUBMIT

$('#btnAddnew').click(function() {
      $(".successcontent").hide();
      $("#maincontent").show();
      $('#editForm').data('bootstrapValidator').resetForm(true);
});//endreset

});//end DOC READY
</script>
</body>
</html>
