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
<link rel="stylesheet" type="text/css" href="../css/jquery.datepick.css"> 
<script type="text/javascript" src="../js/jquery.plugin.js"></script> 
<script type="text/javascript" src="../js/jquery.datepick.js"></script>
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
.btn:hover, .btn:focus, .btn.focus {
  color: #000;
}
</style>
</head>
<body>
<?php include "../nav.php"; ?>
<div class="container-fluid">
<?php
if(!empty($_GET)) 
{ 
  $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_NUMBER_INT);
        $query = " 
            SELECT   *
            FROM hr_rover 
            WHERE 
                id = :id
        "; 
        $query_params = array( 
            ':id' => $_GET['id'] 
        ); 
        try { 
          $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) { 
          die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch();
        $parts = explode('-', $row['startdate']);
        $sdate  = "$parts[1]/$parts[2]/$parts[0]";
        $parts = explode('-', $row['enddate']);
        $edate  = "$parts[1]/$parts[2]/$parts[0]";
        if ($_SESSION['id'] == $row['refid']) {
          $isdisabled = "";
        } else {
          $isdisabled = "disabled";
        }
        if ($row['id'] == "") {
?>
    <div class='row'>
      <!--iferror-->
      <div class='col-md-offset-2 col-md-8 errorcontent'>
        <center>
          <br><font size='90px' color='#5cb85c'><img src='../imgs/ufo.png'></font>
          <br><font size='70px' color='#d9534f'>Oops!</font><br>
          <br><font size='4px'>Missing object.<br><br>If you feel this is an error, please send an email to: <b>jmodelacruz@e-dswd.net.</font></b>
     </div>
      <!--end iferror-->
<?php
        die;
        }
?>
<!--ifsuccess-->
      <div class="col-md-offset-2 col-md-8 successcontent">
        <center>
          <br><img src="../imgs/upload.png">
          <br><font size="70px" color="#5cb85c">Success!</font>
          <br><font size="4px">Details have been updated.</font>
          <br><br><a href="http://hr.slp.ph/viewdata"><button class="btn btn-success" id="btnAddnew">Leave this page</button></a>
      </div>
      <!--end ifsuccess-->
      <div class="col-md-offset-2 col-md-8" id="maincontent">
          <div class="row">
              <div class="col-sm-12" role="alert" style="border:0px solid;padding:5px 0px 15px 0px;font-size:20px">
                <center>
                <div class="col-sm-offset-2 col-sm-8" style="text-align:center;padding-left:2em">
                  <h1>ROVER <span style="font-weight:900">Edit</span></h1>
                </div>
              </div>
            </div>
<script>
function ismale() {
  sex = "0";
  console.log(sex);
}
function isfemale() {
  sex = "1";
  console.log(sex);
}
</script>
<form class="form-horizontal" id="editForm" method="post" action="adduser.php" autocomplete="off">
    <div class="form-group" style="margin-left:1em;margin-right:1em">
    <div class="input-group">
      <input type="text" class="form-control" aria-label="..." placeholder="Start Date" id="startdate" name="startdate" <?php echo $isdisabled; ?>>
      <div class="input-group-btn">
        <button id="ampm1" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 2px solid #dce4ec;" <?php echo $isdisabled; ?>>AM / PM <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" id="selectampm1">
          <li><a href="#">AM</a></li>
          <li><a href="#">PM</a></li>
        </ul>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->
</div>
<div class="form-group" style="margin-left:1em;margin-right:1em">
    <div class="input-group">
      <input type="text" class="form-control" aria-label="..." placeholder="End Date" id="enddate" name="enddate" <?php echo $isdisabled; ?>>
      <div class="input-group-btn">
        <button id="ampm2" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 2px solid #dce4ec;" <?php echo $isdisabled; ?>>AM / PM <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" id="selectampm2">
          <li><a href="#">AM</a></li>
          <li><a href="#">PM</a></li>
        </ul>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->
</div>
        <div class="form-group" style="margin-right:1em">
              <div class="col-sm-12" style="margin-left:1em;margin-right:1em">
                  <select class="form-control cleanselect" name="event" id="event" required <?php echo $isdisabled; ?>>
                      <option selected><?php echo $row["event"]; ?></option>
                      <option>Compensatory Day Off</option>
                      <option>Meeting within Metro Manila</option>
                      <option>Meeting within Central Office</option>
                      <option>Travel for Field Monitoring</option>
                      <option>Leave</option>
                      <option>Workshop</option>
                      <option>Training</option>
                  </select>
              </div>
        </div>
              <div class="form-group" style="margin-right:1em">
              <div class="col-sm-12" style="margin-left:1em;margin-right:1em">
              <textarea name="remarks" maxlength="255" class="form-control" id="remarks" placeholder="Remarks" style="resize:none;padding-top:8px;padding-bottom:8px;" rows="3" <?php echo $isdisabled; ?>></textarea>
       </div>
     </div>
  </form>
              <button id="goback" class="btn btn-warning pull-right" style="margin-right:1em">Go Back</button> 
                <?php
                if ($_SESSION['id'] == $row['refid']) {
                ?>
                <button id="deleterecord" class="btn btn-danger pull-right" style="margin-right:1em">Delete</button> 
                <button id="addrover" class="btn btn-info pull-right" style="margin-right:1em">Save Changes</button>
                <?php
                  }
                ?>
        </div>
      <div class="col-md-2"></div>
    </div>
</div><!--endcontainer-->
<?php
} else {
?>
    <div class='row'>
      <!--iferror-->
      <div class='col-md-offset-2 col-md-8 errorcontent'>
        <center>
          <br><font size='90px' color='#5cb85c'><img src='../imgs/ufo.png'></font>
          <br><font size='70px' color='#d9534f'>Oops!</font><br>
          <br><font size='4px'>Missing object.<br><br>If you feel this is an error, please send an email to: <b>jmodelacruz@e-dswd.net.</font></b>
      </div>
      <!--end iferror-->
<?php } ?>          
<script>
$(document).ready(function() {
  $("#startdate").datepick();
  $("#enddate").datepick();
  time1 = "";
  time2 = "";
  $('#selectampm1 li').on('click', function(){
      time1 = $(this).text();
      $('#ampm1').html(time1 + ' <span class="caret"></span>');
  });
  $('#selectampm2 li').on('click', function(){
      time2 = $(this).text();
      $('#ampm2').html(time2 + ' <span class="caret"></span>');
  });
document.getElementById("remarks").value = '<?php echo $row["remarks"]; ?>';
document.getElementById("startdate").value = '<?php echo $sdate; ?>';
document.getElementById("enddate").value = '<?php echo $edate; ?>';
document.getElementById("ampm1").innerHTML = '<?php echo $row["starttime"]; ?>  <span class="caret"/>';
time1 = document.getElementById("ampm1").value = '<?php echo $row["starttime"]; ?>';
document.getElementById("ampm2").innerHTML = '<?php echo $row["endtime"]; ?>  <span class="caret"/>';
time2 = document.getElementById("ampm2").value = '<?php echo $row["endtime"]; ?>';
sexload = '<?php echo $row['sex'];?>';
var found3 = [];
		$("select option").each(function() {
			  if($.inArray(this.value, found3) != -1) $(this).remove();
			  found3.push(this.value);
		});
  $("#loadicon").hide();
  $(".successcontent").hide();
  $("#maincontent").show();
  $("#hrsubmit").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#statusdisp").html('');
  $('#editForm').bootstrapValidator('validate');
  return false;
}); //endHRSUBMIT
$("#goback").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  history.back();
}); //endHRSUBMIT
$("#deleterecord").click(function(event) {
    var r = confirm("You are about to delete a record. This will be recorded. Are you sure?");
    if (r == true) {
      var formData = {
      'id'        : "<?php echo $_GET['id']; ?>"
    };
                $.ajax({
                   url: "delrecord_rover.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "good") {
                        alert("Successfully deleted!");
                        history.back();
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
    }
});
$("#addrover").click(function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
    errors = 0;
    errorlist = "";
    if ($('input[name=startdate]').val() == "") {
      errors++;
      errorlist = "Please enter start date\n";
    }
    if ($('input[name=enddate]').val() == "") {
      errors++;
      errorlist = errorlist + "Please enter end date\n";
    }
    if (time1 == "") {
      errors++;
      errorlist = errorlist + "Please select time (AM/PM) for start date\n";
    }
    if (time2 == "") {
      errors++;
      errorlist = errorlist + "Please select time (AM/PM) for end date\n";
    }
    if ($('#event option:selected').val() == "") {
      errors++;
      errorlist = errorlist + "Please select event";
    }
    if (errors == 0) {
      $("#addrover").html("Processing..");
      var formData = {
              'id'                 : '<?php echo $_GET["id"]; ?>',
              'startdate'          : $('input[name=startdate]').val(),
              'starttime'          : time1,
              'enddate'            : $('input[name=enddate]').val(),
              'endtime'            : time2,
              'event'              : $('#event option:selected').val(),
              'remarks'            : $('textarea[name=remarks]').val()
            };
      $.ajax({
                       url: "editrover.php",
                       type: "POST",
                       data: formData,
                       success: function(data){
                          if (data == "good") {
                            alert("Success!");
                            location.reload();
                          } else {
                            alert(data);
                          }
                       }
                    });//endAjax
      } else {
        alert(errorlist);
      }
   });
});//end DOC READY
</script>
</body>
</html>
