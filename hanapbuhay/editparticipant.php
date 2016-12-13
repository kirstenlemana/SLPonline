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
    echo $year_diff." years old";
}
function parseEd($str) {
    if (str==1) {
    echo "No Grade Completed";
  } else if ($row['education']==2) {
    echo "Kinder/Daycare";
  } else if ($row['education']==3) {
    echo "Elementary";
  } else if ($row['education']==4) {
    echo "Elementary Graduate";
  } else if ($row['education']==5) {
    echo "Junior High School";
  } else if ($row['education']==6) {
    echo "Junior High School Graduate";
  } else if ($row['education']==7) {
    echo "Senior High School";
  } else if ($row['education']==8) {
    echo "High School Graduate";
  } else if ($row['education']==9) {
    echo "Alternative Learning System Graduate";
  } else if ($row['education']==10) {
    echo "Vocational Level";
  } else if ($row['education']==11) {
    echo "Vocational Graduate";
  } else if ($row['education']==12) {
    echo "College Level";
  } else if ($row['education']==13) {
    echo "College Graduate";
  } else if ($row['education']==14) {
    echo "Grad Studies (M.A., M.S., Ph.D)";
  }
}
        $query = "SELECT id, hasNSO, hasNBI, firstname, middlename, height, remarks, contactnumber, lastname, region, province, municipality, sex, birthdate, education, remarks, pantawidid FROM PRTsupply WHERE id = :id"; 
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
    <link rel="stylesheet" href="http://slp.ph/css/pikaday.css"/>
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
    border:solid 1px #c5d6de;
    margin:1em;margin-top:0;
    background:#fff;text-align: center;
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
.form-control {
   margin-bottom:0.5em;
}
.rights {
    padding-top: 0.5em;
    text-align: right;
}
</style>
</head>
<body>
<?php require "../nav.php"; ?>
<div class="row" style="margin:0;padding:0">
  <div class="col-md-offset-2 col-md-8">
      <div style="border:solid 1px #c5d6de;background:#fff;text-align:center;padding:2em;margin-bottom:4em">
        <h2 style="margin-top:0;margin-bottom:1em">Editing Participant</h2>
        <div class="form-group">
          <div class="col-md-3 rights">First Name</div>
          <div class="col-md-8">
            <input class="form-control" value="<?php echo $row['firstname'] ?>" id="firstname" name="firstname">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">Middle Name</div>
          <div class="col-md-8">
            <input class="form-control" value="<?php echo $row['middlename'] ?>" id="middlename" name="middlename">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">Last Name</div>
          <div class="col-md-8">
            <input class="form-control" value="<?php echo $row['lastname'] ?>" id="lastname" name="lastname">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">Sex</div>
          <div class="col-md-8">
            <select class="form-control" id="sex" name="sex">
              <?php if ($row['sex']==0) {
                echo "<option selected value='0'>Male</option>";
                echo "<option value='1'>Female</option>";
              } else {
                echo "<option value='0'>Male</option>";
                echo "<option selected value='1'>Female</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">Birthdate</div>
          <div class="col-md-8">
            <input class="form-control" value="<?php $birthdate = date('m/d/Y', strtotime($row['birthdate'])); echo $birthdate; ?>" id="birthdate" name="birthdate" id="birthdate" name="birthdate">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">HEA</div>
          <div class="col-md-8">
            <select class="form-control" id="hea" name="hea">
              <?php
              if ($row['education']==1) {
                echo "<option selected value='1'>No Grade Completed</option>";
              } else if ($row['education']==2) {
                echo "<option selected value='2'>Kinder/Daycare</option>";
              } else if ($row['education']==3) {
                echo "<option selected value='3'>Elementary</option>";
              } else if ($row['education']==4) {
                echo "<option selected value='4'>Elementary Graduate</option>";
              } else if ($row['education']==5) {
                echo "<option selected value='5'>Junior High School</option>";
              } else if ($row['education']==6) {
                echo "<option selected value='6'>Junior High School Graduate</option>";
              } else if ($row['education']==7) {
                echo "<option selected value='7'>Senior High School</option>";
              } else if ($row['education']==8) {
                echo "<option selected value='8'>High School Graduate</option>";
              } else if ($row['education']==9) {
                echo "<option selected value='9'>Alternative Learning System Graduate</option>";
              } else if ($row['education']==10) {
                echo "<option selected value='10'>Vocational Level</option>";
              } else if ($row['education']==11) {
                echo "<option selected value='11'>Vocational Graduate</option>";
              } else if ($row['education']==12) {
                echo "<option selected value='12'>College Level</option>";
              } else if ($row['education']==13) {
                echo "<option selected value='13'>College Graduate</option>";
              } else if ($row['education']==14) {
                echo "<option selected value='14'>Grad Studies (M.A., M.S., Ph.D)</option>";
              }
              ?>
              <option value="1">No Grade Completed</option>
              <option value="2">Kinder/Daycare</option>
              <option value="3">Elementary (Grade 1 to 6)</option>
              <option value="4">Elementary Graduate (Completed Grade 6)</option>
              <option value="5">Junior High School (1st to 4th year)</option>
              <option value="6">Junior High School Graduate (Completed 4th year)</option>
              <option value="7">Senior High School (Grade 11 and 12)</option>
              <option value="8">High School Graduate (Completed Grade 12)</option>
              <option value="9">Alternative Learning (ALS) System Graduate</option>
              <option value="10">Vocational Level</option>
              <option value="11">Vocational Graduate</option>
              <option value="12">College Level</option>
              <option value="13">College Graduate</option>
              <option value="14">Graduate Studies (M.A., M.S., Ph.D)</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">Pantawid ID</div>
          <div class="col-md-8">
            <input class="form-control" value="<?php echo $row['pantawidid'] ?>" id="pantawidid" name="pantawidid">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">Contact #</div>
          <div class="col-md-8">
            <input type="number" class="form-control" value="<?php echo $row['contactnumber'] ?>" id="contact" name="contact">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">Height</div>
          <div class="col-md-8">
            <select class="form-control" id="height" name="height">
              <?php
                if ($row['height']==1) {
                  echo "<option selected value='1'>Below 5'ft</option>";
                } else if ($row['height']==2) {
                  echo "<option selected value='2'>5'0 to 5'3</option>";
                } else if ($row['height']==3) {
                  echo "<option selected value='3'>5'4 to 5'7</option>";
                } else if ($row['height']==4) {
                  echo "<option selected value='4'>5'8 to 5'10</option>";
                } else if ($row['height']==5) {
                  echo "<option selected value='5'>Above 5'10ft</option>";
                }
              ?>
                <option value="1">Below 5'ft</option>
                <option value="2">5'0 to 5'3 ft</option>
                <option value="3">5'4 to 5'7 ft</option>
                <option value="4">5'8 to 5'10 ft</option>
                <option value="5">Above 5'10 ft</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">Remarks</div>
          <div class="col-md-8">
            <textarea class="form-control" style="padding-top:5px;resize:none" rows="4" id="remarks" name="remarks"><?php echo $row['remarks'] ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">Has NSO</div>
          <div class="col-md-8">
            <select class="form-control" id="hasnso" name="hasnso">
              <?php if ($row['hasNSO']==1) {
                echo "<option selected value='1'>Yes</option>";
                echo "<option value='0'>No</option>";
              } else {
                echo "<option value='1'>Yes</option>";
                echo "<option selected value='0'>No</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-3 rights">Has NBI</div>
          <div class="col-md-8">
            <select class="form-control" style="margin-bottom:1em" id="hasnbi" name="hasnbi">
              <?php if ($row['hasNBI']==1) {
                echo "<option selected value='1'>Yes</option>";
                echo "<option value='0'>No</option>";
              } else {
                echo "<option value='1'>Yes</option>";
                echo "<option selected value='0'>No</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group" style="margin-bottom:0;text-align:right;padding-right:5em">
          <button class="btn btn-success" id="savechanges" name="savechanges">Save Changes</button>
        </div>
        <div class="clearfix"></div>

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
<script type="text/javascript" src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="http://slp.ph/js/pikaday.min.js"></script>
<script>
$("#savechanges").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#savechanges").html("Processing..");
  document.getElementById("savechanges").disabled = true;
  var formData = {
      'action'      : 'editparticipant',
      'pid'         : '<?php echo $_GET["id"]; ?>',
      'firstname'   : $('input[name=firstname]').val(), 
      'middlename'  : $('input[name=middlename]').val(), 
      'lastname'    : $('input[name=lastname]').val(),
      'sex'         : $('#sex option:selected').val(),
      'birthdate'   : $('input[name=birthdate]').val(),
      'hea'         : $('#hea option:selected').val(),
      'pantawidid'  : $('input[name=pantawidid]').val(),
      'contact'     : $('input[name=contact]').val(),
      'height'      : $('#height option:selected').val(),
      'remarks'     : $('textarea[name=remarks]').val(),
      'hasnso'      : $('#hasnso option:selected').val(),
      'hasnbi'      : $('#hasnbi option:selected').val(),
  };
  $.ajax({
       url: "functions.php",
       type: "POST",
       data: formData,
       success: function(data)
       {
          if (data == "edited") {
            $("#sucsubtext").html("Changes Saved")
            $('#myModal').modal();
            $('#myModal').on('hidden.bs.modal', function () {
                history.back();
            })
          } else {
            alert(data);
            $("#savechanges").html("Submit");
            document.getElementById("savechanges").disabled = false;
          }
       }
    });//endajax
});
var picker2 = new Pikaday({ 
      field: $('#birthdate')[0], 
      format: 'M/D/YYYY'
});
</script>
</body>
</html>
