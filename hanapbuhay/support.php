<?php
require "../zxcd9.php";
byteMe($_SESSION['id'],'hb_support',0.10);
$query = " 
            SELECT 
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
                compnotes
            FROM hr_db 
            WHERE 
                id = :id
        "; 
        $query_params = array( 
            ':id' => $_SESSION['id'] 
        );
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
    <title>SLP | Hanapbuhay</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/flatbootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../css/DTbootstrap.css">
    <link rel="stylesheet" href="../css/bootstrapValidator.css"/>
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
    <script src="../js/DTbootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrapValidator.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
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
  -webkit-appearance:none;-moz-appearance:none;-ms-appearance:none;appearance:none;background:#fff url(../imgs/arrows.png) no-repeat right 9px;
}
.mainlink {
  font-size: 1.8em;
  margin-top: 1px;
}
.form-group div {
  margin-bottom: 0.5em;
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
tbody tr {
  cursor: pointer;
}
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: #2c3e50;
  color: #fff;
}
.dataTables_filter {
   display:none;
}
#slideout {
      z-index: 998;
      position: fixed;
      top: 70%;
      right: 0;
      width: 35px;
      padding: 12px 0;
      text-align: center;
      background: #5cb85c;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
      -webkit-border-radius: 5px 0px 0px 5px;
      -moz-border-radius: 5px 0px 0px 5px;
      border-radius: 5px 0px 0px 5px;
    }
    #slideout_inner {
      z-index: 999;
      position: fixed;
      top: 70%;
      right: -250px;
      background: #5cb85c;
      width: 250px;
      padding: 0;
      height: 170px;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
      text-align: left;
      -webkit-border-radius: 0px 0 0px 5px;
      -moz-border-radius: 0px 0 0px 5px;
      border-radius: 0px 0 0px 5px;
    }
    #slideout_inner textarea {
      z-index: 999;
      margin-right: 5px;
      width: 210px;
      height: 100px;
      margin-bottom: 6px;
    }
    #slideout:hover {
      z-index: 999;
      right: 250px;
    }
    #slideout:hover #slideout_inner {
      z-index: 999;
      right: 0;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 45px;
        padding: 0px 0px 0px 10px;
        font-size: 15px;
        line-height: 1.42857143;
        color: #2c3e50;
        background-color: #ffffff;
        background-image: none;
        border: 1px solid #dce4ec;
        border-radius: 4px;
    }
    .btn2 {
      color: #fff;
      background-color: #2c3e50;
      display: inline-block;
      margin-bottom: 0;
      font-weight: normal;
      text-align: center;
      vertical-align: middle;
      -ms-touch-action: manipulation;
      touch-action: manipulation;
      cursor: pointer;
      background-image: none;
      border: 1px solid transparent;
      white-space: nowrap;
      padding: 5px 15px;
      font-size: 15px;
      line-height: 1.42857143;
      border-radius: 4px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
    }
</style>
</style>
</head>
<body>
  <?php include '../nav.php'; ?>

<div id="slideout">
    <img src="http://img.usabilitypost.com.s3.amazonaws.com/1104/css_slideout/feedback.png" alt="Feedback" />
    <div id="slideout_inner">
      <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="color:#fff;font-size:50px;padding:10px;display:none"></span>
      <div id="formz" style="margin-right:5px">
      <form>
          <div class="form-group" style="padding:10px;padding-bottom:0px">
            <div class="col-sm-12" style="margin-left:5px">
                <textarea name="feedback" maxlength="250" class="form-control" id="feedback" placeholder="Any comments, ideas, or suggestions are welcome!" style="resize:none;padding-top:8px;" rows="3"></textarea>
            </div>
          </div>
      </form>
          <div class="form-group">
              <button class="btn2 btn-primary" id="sendfeedback" style="margin-left:1em">Submit</button>
          </div>
      
      </div>
    </div>
</div>
<script type="text/javascript" language="javascript" class="init">
var oTable = "";
</script>
<div class="container-fluid">
  
    <div class="row">
        <div id="maincontent" class="col-md-10 col-md-offset-1" style="border:0px solid #000">
          <div style="height:100%;background-color:#fff;margin-top:0;padding:2em;padding-top:0.8em">
            <h1 style="font-size:5em;font-weight:700;margin-bottom:5px;margin-top:0">SUPPORT CENTER</h1>
            <br><br>
            <b>Instructional Videos:</b><br>
            1. Accessing HANAPBUHAY IS <a href="https://www.dropbox.com/s/vx3wpn4gv3oodt1/1.%20Main%20Page-Login.mp4?dl=0" ><button class="btn btn-info" style="padding:2px;font-size:12px"><span class="glyphicon glyphicon-download"></span> Download</button></a><br>
            2. Supply - Adding and viewing participants <a href="https://www.dropbox.com/s/wi21h9fs9exzz3i/2.%20Supply-Adding%20and%20Viewing%20Participants.mp4?dl=0" ><button class="btn btn-info" style="padding:2px;font-size:12px"><span class="glyphicon glyphicon-download"></span> Download</button></a><br>
            3. Demand - Adding and viewing partners <a href="https://www.dropbox.com/s/6q5hm7bol49ct9g/3.%20Demand-Adding%20and%20Viewing%20Partners.mp4?dl=0" ><button class="btn btn-info" style="padding:2px;font-size:12px"><span class="glyphicon glyphicon-download"></span> Download</button></a><br>
            4. Demand - Adding and viewing jobs <a href="https://www.dropbox.com/s/vtplf6wdzlo3wzh/4.%20Demand-Adding%20and%20Viewing%20Jobs.mov?dl=0" ><button class="btn btn-info" style="padding:2px;font-size:12px"><span class="glyphicon glyphicon-download"></span> Download</button></a><br>
            5. Giving Feedback <a href="https://www.dropbox.com/s/84liyj5pb9whuod/5.%20Sending%20Feedback.mp4?dl=0" ><button class="btn btn-info" style="padding:2px;font-size:12px"><span class="glyphicon glyphicon-download"></span> Download</button></a><br>
          </div>
        </div>
    </div><!--endrow-->
    <div class="row col-md-12" style="position:absolute;bottom:1em"><center>
      This page is under development
    </div>
</div><!--container-->
<script>
$(document).ready(function() {
$("#searchbox").keyup(function() {
   oTable.fnFilter(this.value);
});    
$("#formsubmit").click(function() {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#statusdisp").html('');
  $('#supplyForm').bootstrapValidator('validate');
  return false;
}); //endHRSUBMIT

});
</script>
<script>
$(document).ready(function() {
key = '<?php echo $row["region"]; ?>';

$("#loadicon").hide();


$("#formsubmit").click(function() {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#statusdisp").html('');
  $('#supplyForm').bootstrapValidator('validate');
  return false;
}); //endHRSUBMIT


});
</script>
</body>
</html>
