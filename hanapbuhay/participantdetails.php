<?php
  require "../zxcd9.php";
  if(!empty($_GET['id'])) {
    $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
}
function dob($dob) {
    //calculate years of age (input string: YYYY-MM-DD)
    list($year, $month, $day) = explode("-", $dob);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
        $year_diff--;
    return $year_diff." years old";
}
function parseEd($str) {
    if ($str==1) {
    return "No Grade Completed";
  } else if ($str==2) {
    return "Kinder/Daycare";
  } else if ($str==3) {
    return "Elementary";
  } else if ($str==4) {
    return "Elementary Graduate";
  } else if ($str==5) {
    return "Junior High School";
  } else if ($str==6) {
    return "Junior High School Graduate";
  } else if ($str==7) {
    return "Senior High School";
  } else if ($str==8) {
    return "High School Graduate";
  } else if ($str==9) {
    return "Alternative Learning System Graduate";
  } else if ($str==10) {
    return "Vocational Level";
  } else if ($str==11) {
    return "Vocational Graduate";
  } else if ($str==12) {
    return "College Level";
  } else if ($str==13) {
    return "College Graduate";
  } else if ($str==14) {
    return "Grad Studies (M.A., M.S., Ph.D)";
  }
}
    $query = "SELECT id, firstname, middlename, remarks, contactnumber, lastname, region, province, municipality, sex, birthdate, education, remarks, pantawidid FROM PRTsupply WHERE id = :id"; 
    $query_params = array(':id' => $_GET['id']);
      try 
      { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
      catch(PDOException $ex) 
      { die("Failed to run query: " . $ex->getMessage()); } 
      $row = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP Online</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/flatbootstrap.css"/>
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <style>
body {
    background-color: #f7f9fb;
    background-size: cover;
    font-family: "Lato";
}
.navbar-nav > li > a, .navbar-brand {
    padding-top:15px !important; 
    padding-bottom:0 !important;
    height: 40px;
    
}
.navbar {min-height:45px !important;background-color: #000}
#bootstrapSelectForm .selectContainer .form-control-feedback {
     right: -15px;
}
.disabled {
     background:rgba(1,1,1,0.2);
     border:0px solid;
     cursor:progress;
}
.vcenter {
     min-height: 90%;  
     min-height: 90vh; 
     display: -webkit-box;
     display: -moz-box;
     display: -ms-flexbox;
     display: -webkit-flex;
     display: flex; 
     -webkit-box-align : center;
     -webkit-align-items : center;
     -moz-box-align : center;
     -ms-flex-align : center;
     align-items : center;
     width: 100%;
     -webkit-box-pack : center;
     -moz-box-pack : center;
     -ms-flex-pack : center;
     -webkit-justify-content : center;
     justify-content : center;
}
table {
     border-collapse: inherit;
}
.slpdrop {
     margin-bottom:1em;
}
.slpdropsub {
     background: #000;
     color:#fff;
}
.slpdropsub li a {
     background: #000;
     color:#fff;
}
-webkit-tap-highlight-color: rgba(0,0,0,0);
button {
      outline: none;
}
.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
      background: #000;
}
.dashpanel {
      border:solid 1px #c5d6de;margin:1em;margin-top:0;background:#fff;text-align: center;
      height:100%;
      border-radius: 4px;
}
.bluetext {
      color: #00ADDe;
}
.padfix {
      padding-right: 0;
      margin-bottom:1em;
      margin-right: 1em;
}
.padfix2{
      padding-right:0em;
      padding-left: 1em;
}
.padfix3 {
      padding-left:1em;
      padding-right:0;
}
.padfix4 {
      padding: 1em;
      padding-right:0;
}
.dashpanelheader {
      font-weight:900;padding-top:0.5em;padding-left:1em;font-size:18px;
      margin-bottom: 0;text-align: left;
}
@media (min-width: 990px) {
  .slpdrop {
      font-weight:900;
      font-size:22px;
  }
  .padfix {
      padding-right: 0;
      margin-right: 0;
      margin-bottom: 0;
  }
  .padfix2{
      padding-right:0em;
      padding-left: 2em;
  }
  .padfix3 {
      padding-left:0;
      padding-right: 1em;
  }
  .padfix4 {
      padding: 1em;
      padding-right:1em;
    }
}
.dashpanelsubhead {
      text-align:left;padding-left:1.2em;margin-bottom:0;padding-bottom:0;
}
thead th {
      text-align: center;
      cursor: pointer;
}
.dataTables_paginate {
      float:none;
}
h3 {
      font-weight: 400
}
.nopad {
      margin:0;
      padding:0;
      padding-top:4px;
}
.nopad::after {
      color: #ccc;
      content: attr(data-bg-text);
      display: block;
      font-size: 12px;
      text-align:right;
      line-height: 1;
      padding:0;
      margin:0;
      margin-top: 0px;
      position: relative;
      bottom: 0px;
      right: 0px;
}
.labelhover:hover {
      background: #000;
      color: #fff;
}
.editbtn {
      color:#18bc9c;
}
.delbtn{
      color:#e74c3c;
}
</style>
</head>
<body>
<?php require "../nav.php"; ?>
<div class="row" style="margin:0;padding:0">

  <div class="col-md-offset-3 col-md-6">
      <div style="border:solid 1px #c5d6de;background:#fff;text-align:center;padding:2em">

        <?php
          if ($row['sex'] == "0") {
            echo '<img src="../imgs/partner.png" style="margin-bottom:1em;width:7em">';
          } else {
            echo '<img src="../imgs/female.png" style="margin-bottom:1em;width:7em">';
          }
        ?>
        <h1 style="margin-top:0;text-transform:uppercase"><?php echo $row['lastname'].", ".$row['firstname']." ".$row['middlename']; ?></h1>
        <?php echo dob($row['birthdate']); ?><br>
        <?php echo ucwords(strtolower($row['region']." - ".$row['province']." - ".$row['municipality'])); ?><br><br>

        <b>Contact:</b> <?php echo $row['contactnumber']; ?><br>
        <b>HH ID:</b> <?php echo $row['pantawidid']; ?><br>
        <b>HEA:</b> <?php echo parseEd($row['education']); ?><br>
        <b>Remarks:</b> <?php echo $row['remarks']; ?><br><br>

          <div style="text-align:left;width:100%;padding:2em;padding-top:1em">
            <b style="font-size:20px;font-weight:bold">SLP Online History</b><br>
            -

          </div>
          <div class="row" style="margin-top:1em;text-align:right;padding-right:1em;color:#00ADDe;font-size:14px">
            <a href="editparticipant.php?id=<?php echo $_GET['id']; ?>"><span class="link-hover editbtn" id="editfile"><span class="glyphicon glyphicon-pencil"></span> Edit &nbsp; </span></a>
            <span class="link-hover delbtn" id="deleter"><span class="glyphicon glyphicon-trash"></span> Delete</span>
          </div>
      </div>
  </div>

</div>
<!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
        <div class="modal-dialog modal-sm">

          <div class="modal-content" style="padding:1em;padding-top:0.5em;">
                  <h3 style="color:#5cb85c;margin-bottom:6px">Success!</h3>
                  <span style="font-size:13px" id="sucsubtext">Boom</span><br><br>
                  <button type="button" class="btn btn-primary pull-right" style="background:#5cb85c;border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Okay</button>
                  <div class="clearfix"></div>
          </div>
          
        </div>
      </div>
      <!-- Modal -->
<script>
$("#submitpass").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#submitpass").html("Processing..");
  document.getElementById("submitpass").disabled = true;
  var formData = {
      'oldpass'       : $('input[name=oldpass]').val(), 
      'newpass'       : $('input[name=newpass]').val(), 
      'newpass2'      : $('input[name=newpass2]').val()
  };
  $.ajax({
       url: "chpass.php",
       type: "POST",
       data: formData,
       success: function(data)
       {
          if (data == "good") {
            $("#sucsubtext").html("Password changed")
            $('#myModal').modal();
            $('#myModal').on('hidden.bs.modal', function () {
                location.href = "http://slp.ph/main.php";
            })
          } else {
            alert(data);
            $("#submitpass").html("Submit");
            document.getElementById("submitpass").disabled = false;
          }
       }
    });//endajax
});
$("#deleter").click(function(event) {
  var r = confirm("You are about to delete a participant. Are you sure?");
  if (r == true) {
    var formData = {
      'action'        : "deleteparticipant",
      'pid'           : "<?php echo $_GET['id']; ?>",
    };
                $.ajax({
                   url: "functions.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "deleted") {
                        alert("Success!");
                        location.href = "http://slp.ph/hanapbuhay/supply.php";
                      } else {
                        alert(data);
                      }
                   }
                });
                //endAjax
  }
}); //endpost
</script>
</body>
</html>
