<?php
require "../zxcd9.php";
byteMe($_SESSION['id'],'hb_supply',0.10);
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
    <link href="../css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="../css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.js"></script>
    <script src="../js/DTbootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrapValidator.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/tag-it.js" type="text/javascript" charset="utf-8"></script>
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
.hideme {
  border: 0;
  background-color: transparent;
}
.centered
{
    text-align:center;
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
      <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="color:#fff;font-size:50px;padding:10px;"></span>
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
$(document).ready(function() {
function toTitleCase(str)
{
      return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
function parselimit(strz)
{
    var m = new String(strz);
    if (m.length > 32) {
      m = m.substring(0,32);
      m = m+"..";
    }
    console.log(m);
    return m;
}
function parseStatus(str) {
  if (str == "0") {
    status = "<span class='label label-primary'>Proposed</span>";
  } else if (str == "1") {
    status = "<span class='label label-warning'>Reviewed</span>";
  } else if (str == "2") {
    status = "<span class='label label-info'>Engaged</span>";
  } else if (str == "3") {
    status = "<span class='label label-info'>Approved</span>";
  } else if (str == "4") {
    status = "<span class='label label-success'>Completed</span>";
  } else if (str == "5") {
    status = "<span class='label label-danger'>Rejected</span>";
  }
  return status;
}
  $.fn.DataTable.ext.pager.numbers_length = 5;
  $.extend( true, $.fn.dataTable.defaults, {
    "aProcessing": true,
    "aServerSide": true,
    "orderCellsTop": true,
    "ajax": "dt_supply_2.php",
    "dom": '<"top">rtp<"bottom"f><"clear">',
    "fnRowCallback":
      function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        $(nRow).attr('id', aData[0]);
        return nRow;
      },
    "aoColumnDefs": [
            { 
               "aTargets":[1],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                    $(nTd).css('width', '60');
                },
            },

            { "bVisible": false, "aTargets":[2] }
            ]
} );
  oTable = $('#viewdata').dataTable();
      $('#viewdata').on( 'click', 'tbody tr', function () {
        var redirection = $(this).attr('id');
        var formData = { 'sector' : redirection };
        $.ajax({
          type: "POST",
          url: "participants.php",
          data: formData,
          success: function(data) {
                  if (data == "visitpage") {
                    location.href="participants.php"
                  }
                }

          });

      });
});

</script>
<div class="container-fluid">
  
    <div class="row">
        <div id="maincontent" class="col-md-5" style="border:0px solid #000;height:90%;margin-right:0">
          <div style="height:100%;background-color:#fff;margin-top:0;padding:2em;padding-top:0.8em">
            <h1 style="font-size:5em;font-weight:700;margin-bottom:5px;margin-top:0">SUPPLY</h1>
            Currently viewing data for: <b><?php echo $_SESSION['filter']; ?></b><br>
            <div id="data_adding" style="display:none">Adding participants for: <b id="data_provmuni" style="display:none;color:#00AADe">Province > Municipality</b> <span id="btnsupply_reset" style="color:rgb(217, 83, 79);cursor:pointer" class="glyphicon glyphicon-remove"></span></div>
            <div id="supply_part1" style="background:#fff;display:none;text-align:center;">
            <form id="supplyForm" method="post" action="" autocomplete="off">

<?php if ($_SESSION['filter']=="NPMO") { ?>
                        <div class="form-group">
                            <div class="col-sm-12">
                              <select class="form-control cleanselect" id="region" name="region" onChange='getProv(this.value)' required>
                                <option value="" selected>Select Region</option>
              <?php
                  $query = "SELECT * FROM lib_regions"; 
                  try 
                  { $stmt = $db->prepare($query); $result = $stmt->execute(); } 
                  catch(PDOException $ex) 
                  { die("Failed to run query: " . $ex->getMessage()); } 
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                     echo "<option value='".$row["regid"]."'>".$row['regname']."</option>";
                  }
              ?>
                              </select>
                            </div>
                        </div>
<?php } else { ?>
                              <select class="form-control cleanselect" id="region" name="region" hidden required style="visibility:hidden">
                                <option selected><?php echo $row["region"]; ?></option>
                              </select>
<?php } ?>
                        <div class="form-group">
                            <div class="col-sm-12">
                              <select class="form-control" id="prov" name="prov" onChange='getCity(this.value)' required>           
                                <option value="" selected>Select Province</option>
                                  <?php
                  $query = "SELECT * FROM lib_regions WHERE regname = :region"; 
                  $query_params = array(':region' => $_SESSION['filter']);
                  try 
                  { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
                  catch(PDOException $ex) 
                  { die("Failed to run query: " . $ex->getMessage()); } 
                  $row = $stmt->fetch();
                  $regcode = $row['regid'];

                  $query = "SELECT * FROM lib_provinces WHERE regid = :region"; 
                  $query_params = array(':region' => $regcode);
                  try 
                  { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
                  catch(PDOException $ex) 
                  { die("Failed to run query: " . $ex->getMessage()); } 
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                     echo "<option value='".$row["provid"]."'>".$row['provname']."</option>";
                  }
              ?>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                              <select class="form-control cleanselect" id="city" name="city" onChange='getBrgy(this.value)' disabled required>
                                <option value="" selected>City/Municipality (Select province first)</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                              <select class="form-control cleanselect" id="brgy" name="brgy" onChange='' disabled required>
                                <option value="" selected>Barangay (Select city/muni first)</option>
                              </select>
                            </div>
                        </div>
                          </form>
                          <div class="row">
                              <button id="btnsupply2" class="btn btn-info" style="width:100px;margin-top:1em;padding:6px">Next <span class="glyphicon glyphicon-chevron-right"></span></button>
                          </div>
                          
            </div>
            <div id="supply_part2" style="display:none;">
              <div class="row">
              <form id="supplyForm2" method="post" action="" autocomplete="off">
                            
<script>
function getProv(val) {

  var formData = { 'region' : $('#region option:selected').val() };
  $.ajax({
  type: "POST",
  url: "getProv.php",
  data: formData,
  success: function(data) {
            $("#prov").html(data);
        }

  });
}
function getCity(val) {

  var formData = { 'provi' : $('#prov option:selected').val() };
  $.ajax({
  type: "POST",
  url: "getCity.php",
  data: formData,
  success: function(data) {
            $("#city").prop('disabled', false);
            $("#city").html(data);
        }

  });
}
function getBrgy(val) {
  var formData = { 'city' : $('#city option:selected').val() };
  $.ajax({
  type: "POST",
  url: "getBrgy.php",
  data: formData,
  success: function(data) {
            $("#brgy").prop('disabled', false);
            $("#brgy").html(data);
        }

  });
}

pantawid = 0;
hasnso = 0;
hasnbi = 0;
function isPantawid() {
        if (!document.getElementById('ispantawid').checked) {
            pantawid = 0;
        } else {
            pantawid = 1;
        }
}
function hasNSO() {
        if (!document.getElementById('hasnso').checked) {
            hasnso = 0;
        } else {
            hasnso = 1;
        }
}
function hasNBI() {
        if (!document.getElementById('hasnbi').checked) {
            hasnbi = 0;
        } else {
            hasnbi = 1;
        }
}
function sectorChange() {
      var $dropdown = $("#sector");
      $.getJSON("../json/sector.json", function(data) {
      document.getElementById("filter2").disabled = false;
        var key = $dropdown.val();
        var vals = [];
        var $secondChoice = $("#filter2");

        switch(key) {
          case 'Sub-Sector(s)':
            $secondChoice.empty();
            $secondChoice.append("<option value=''>Sub-Sector(s)</option>");
            break;
          case 'Agriculture Forestry and Fishery':
            vals = data.a.split(",");
            break;
          case 'Automotive and Land Transportation':
            vals = data.b.split(",");
            break;
          case 'Construction':
            vals = data.c.split(",");
            break;
          case 'Decorative Crafts':
            vals = data.d.split(",");
            break;
          case 'Electronics':
            vals = data.e.split(",");
            break;
          case 'Footwear and Leathergoods':
            vals = data.f.split(",");
            break;
          case 'Furniture and Fixtures':
            vals = data.g.split(",");
            break;
          case 'Garments':
            vals = data.h.split(",");
            break;
          case 'HHC (Human Health/Health Care)':
            vals = data.i.split(",");
            break;
          case 'Heating Ventilation Airconditioning and Refrigeration':
            vals = data.j.split(",");
            break;
          case 'Information and Communication Technology':
            vals = data.k.split(",");
            break;
          case 'Maritime':
            vals = data.l.split(",");
            break;
          case 'Metals and Engineering':
            vals = data.m.split(",");
            break;
          case 'Processed Food & Beverages':
            vals = data.n.split(",");
            break;  
          case 'Pyrotechnics':
            vals = data.o.split(",");
            break;
          case 'SOS (Social Community Development and other Services)':
            vals = data.p.split(",");
            break;
          case 'Tourism (Hotel and Restaurant)':
            vals = data.q.split(",");
            break;
          case 'TVET':
            vals = data.r.split(",");
            break;
          case 'Utilities (Water Supply Sewerage Waste Management etc)':
            vals = data.s.split(",");
            break;
          case 'Visual Arts':
            vals = data.t.split(",");
            break;
          case 'Wholesale and Retail Trading':
            vals = data.u.split(",");
            break;
        }
        
        if (key != "") {
            document.getElementById("filter2").disabled = false;
            $secondChoice.empty();
            $secondChoice.append("<option>Select Sub-Sector(s)</option>");
            $.each(vals, function(index, value) {
              $secondChoice.append("<option>" + value + "</option>");
            });
        } else {
            $secondChoice.empty();
            $secondChoice.append("<option value=''>Select Sub-Sector(s)</option>");
            document.getElementById("filter2").disabled = true;
        }
        
      });
}
function changeValue2(){

          $('#idg').show();
          var option=document.getElementById('filter2').value;
          $("#subsector").tagit("createTag", option);
          $('#filter2').get(0).selectedIndex = 0;
}
</script>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <select id="sector" onchange="sectorChange()" class="form-control cleanselect">
                                    <option value="" selected>Primary Sector</option>
                                    <option>Agriculture Forestry and Fishery</option>
                                    <option>Automotive and Land Transportation</option>
                                    <option>Construction</option>
                                    <option>Decorative Crafts</option>
                                    <option>Electronics</option>
                                    <option>Footwear and Leathergoods</option>
                                    <option>Furniture and Fixtures</option>
                                    <option>Garments</option>
                                    <option>HHC (Human Health/Health Care)</option>
                                    <option>Heating Ventilation Airconditioning and Refrigeration</option>
                                    <option>Information and Communication Technology</option>
                                    <option>Maritime</option>
                                    <option>Metals and Engineering</option>
                                    <option>Processed Food & Beverages</option>
                                    <option>Pyrotechnics</option>
                                    <option>SOS (Social Community Development and other Services)</option>
                                    <option>Tourism (Hotel and Restaurant)</option>
                                    <option>TVET</option>
                                    <option>Utilities (Water Supply Sewerage Waste Management etc)</option>
                                    <option>Visual Arts</option>
                                    <option>Wholesale and Retail Trading</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <select id="filter2" onchange="changeValue2();" class="form-control cleanselect" disabled>
                                    <option value="" selected>Sub-Sector(s)</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group" id="idg">
                              <div class="col-sm-12">
                                  <input name="subsector" id="subsector" class="hideme" value="" type="">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input name="firstname" class="form-control" id="firstname" placeholder="First Name">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-6">
                                <input name="middlename" class="form-control" id="middlename" placeholder="Middle Name">
                              </div>
                              <div class="col-sm-6">
                                <input name="lastname" class="form-control" id="lastname" placeholder="Last Name">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-6">
                                    <select class="form-control cleanselect" id="sex" name="sex" required>
                                      <option value="" selected>Select Sex</option>
                                      <option>Male</option>
                                      <option>Female</option>
                                    </select>
                              </div>
                              <div class="col-sm-6">
                                <input name="birthdate" class="form-control" id="address" placeholder="Birthday (mm/dd/yyyy)" >
                              </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0em">
                              <div class="col-sm-6" style="margin-bottom:0em">
                                <select class="form-control cleanselect" id="height" name="height" required>
                                      <option value="0" selected>Select Height</option>
                                      <option value="1">Below 5'ft</option>
                                      <option value="2">5'0 to 5'3 ft</option>
                                      <option value="3">5'4 to 5'7 ft</option>
                                      <option value="4">5'8 to 5'10 ft</option>
                                      <option value="5">Above 5'10 ft</option>
                                    </select>
                              </div>
                              <div class="col-sm-6" style="margin-bottom:0em">
                                <input name="contactnumber" class="form-control" id="contactnumber" placeholder="Contact Number" style="margin-bottom:0.8em">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <select id="education" class="form-control cleanselect">
                                    <option value="" selected>Select Educational Attainment</option>
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
                              <div class="col-sm-12">
                                <textarea id="remarks" name="remarks" rowspan="3" placeholder="Details of Work Experience (certificates, years of work experience, etc)" style="resize:none;padding-top:8px;padding-bottom:8px;padding-right:8px" class="form-control"></textarea>
                              </div>
                            </div>
                            <div class="form-group" style="margin-bttom:0.5em">
                              <div class="col-sm-12">
                                <input name="pantawidid" class="form-control" id="pantawidid" placeholder="Pantawid HH ID# (include -)" type="tel">
                              </div>
                            </div>
                            <div class="form-group" style="margin-top:0.5em;margin-left:2em">
                                <div class="checkbox-inline" id="tooltip1">
                                  <label><input type="checkbox" value="" id="hasnso" name="hasnso" onchange="hasNSO();">w/ NSO Birth Certificate</label>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top:1em;margin-left:2em;margin-bottom:0.5em">
                                <div class="checkbox-inline" id="tooltip2">
                                  <label><input type="checkbox" value="" id="hasnbi" name="hasnbi" onchange="hasNBI();">w/ NBI Clearance</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                              <div class="col-sm-12">
                                <button id="formsubmit" class="btn col-sm-12 btn-success">Register</button>
                                <!--<button id="reloader" class="btn col-sm-4 btn-success">X</button>--><br>
                              </div>
                            </div>
                            <div class="form-group" style="margin-top:1em"><div class="col-md-12"><center>
                              <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="font-size:30px;display:none;"></span>
                              <br>
                              <div id="statusdisp" class="col-sm-12" style="color:red;text-align:center"></div>
                            </div>
                            </div>
                  </form>
                  </div>
                </div>

            <button id="btnsupply1" class="btn btn-info" style="margin-top:1em;padding:6px">Add Participant</button>
            
            <div class="row">
              <div id="container" style="width:100%; margin: 0 auto"></div>
            </div>

          </div>
        </div>
        <div id="tableHolder" class="col-md-7" style="border:0px solid #000;margin-left:0">
          <div style="background-color:#fff;height:100%;padding:2em;margin-left:0">
                  <div class="col-md-4" style="margin-left:0;padding-left:0;padding-bottom:1em">
                    <input id="searchbox" type="text" class="form-control" placeholder="Search Sectors.." style="height:31px"/>
                  </div>
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata">
                    <thead>
                      <tr>
                      <th>Sectors</th>
                      <th style="padding-right:1em">Supply</th>
                      <th>Region</th>
                      </tr>
                    </thead>
                  </table>
                  
                  <div class="col-md-6 pull-right" style="color:#5cb85c;font-size:12px;text-align:right">
                    <span id="reloadstamp"></span>
                  </div>
                  <br>
              
          </div>
        </div>
    </div><!--endrow-->
</div><!--container-->
<script>
$(document).ready(function() {

key = '<?php echo $row["region"]; ?>';
$("#searchbox").keyup(function() {
   oTable.fnFilter(this.value);
});    
$("#btnsupply1").click(function() {
   $("#btnsupply1").hide();
   $("#container").hide();
   $("#supply_part1").slideToggle();
}); 
$("#btnsupply2").click(function() {
   $('#supplyForm').bootstrapValidator('validate');
});
$("#btnsupply_reset").click(function() {
   $("#supply_part2").hide();
   $("#data_adding").hide();
   $("#data_provmuni").hide();
   $("#supply_part1").slideToggle();
   $('#supplyForm').bootstrapValidator('resetForm', true);
   document.getElementById("municipality").disabled = true;
   document.getElementById("municipality").value = "Municipality (Select Province First)";
});    
$("#formsubmit").click(function() {
  event.preventDefault();
  event.stopImmediatePropagation();
  console.log($('input[name=pantawidid]').val());
  $("#statusdisp").html('');
  $('#supplyForm2').bootstrapValidator('validate');
  return false;
}); //endHRSUBMIT
$("#sendfeedback").click(function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
    
    $("#loadicon").show();
    $("#feedback").hide();
    $("#sendfeedback").html('Processing..');
    document.getElementById("sendfeedback").classList.add("disabled");
    document.getElementById("sendfeedback").disabled = true;
    var formData = {
      'page'        : "partner_supply",
      'feedback'    : $('textarea[name=feedback]').val(),
      'feedbacker'    : "<?php echo $_SESSION['id']; ?>"
    };
                $.ajax({
                   url: "../sendfeedback.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "good") {
                        $("#loadicon").hide();
                        document.getElementById("formz").innerHTML = "<div style='padding:10px;color:#fff'><h2>Feedback Sent!</h2>Thank you!</div>"
                      } else {
                        alert(data);
                        $("#loadicon").hide();
                        $("#feedback").show();
                        $("#sendfeedback").html('Submit');
                        document.getElementById("sendfeedback").classList.remove("disabled");
                        document.getElementById("sendfeedback").disabled = false;
                      }
                      return false;
                   }
                });//endAjax
  }); //endsendfeedback


});
</script>
<script>
<?php
$stmt = $db->prepare("SELECT COUNT(id) as total FROM PRTsupply");
$stmt->execute();
$row = $stmt->fetch();
$total = $row["total"];
$stmt = $db->prepare("SELECT COUNT(id) as total FROM PRTsupply WHERE encodedby = '".$_SESSION['id']."'");
$stmt->execute();
$row = $stmt->fetch();
$totalencoded = $row["total"];
$stmt = $db->prepare("SELECT COUNT(id) as total FROM PRTsupply WHERE encodedby = '".$_SESSION['id']."' AND employed != '0000-00-00'");
$stmt->execute();
$row = $stmt->fetch();
$totalemployed = $row["total"];
?>
$(function () {

    $(document).ready(function () {
var colors = Highcharts.getOptions().colors;
var total = <?php echo $total;?>;
if (total == '') {
  total = '0';
}
var totalencoded = <?php echo $totalencoded;?>;
var totalemployed = <?php echo $totalemployed;?>;
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                backgroundColor: null
            },
            title: {
                   text: total,
                   verticalAlign: 'middle',
                   y: -12,
                   style: {
                        fontFamily: 'Lato', 
                        fontSize: '40px',
                        fontWeight: 'bold',
                    }
            },
            subtitle: {
                text: 'Total',
                verticalAlign: 'middle',
                y: 8,
                style: {
                        fontFamily: 'Lato', 
                        fontSize: '21px',
                    }
            },
            xAxis: {
                categories: ['Program Participants'],
                labels: {
                  enabled: false,
                    style: {
                        fontSize:'8px'
                    }
                },
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = '<b>'+this.series.name + '</b><br><span style="'+this.series.color+'">' + this.key +'</span>: <b>'+point.y.toFixed(0)+'</b> ('+point.percentage.toFixed(0)+'%)';
                    return s;
                },
                shared: true,
                hideDelay: 0
            },
            plotOptions: {
                pie: {
                    size: '80%',
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            legend: {
              layout: 'horizontal',
              align: 'center',
              verticalAlign: 'bottom',
              floating: false,
              backgroundColor: '',
              itemStyle: {
                 font: 'Lato, sans-serif',
              },
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Program Participants',
                colorByPoint: true,
                innerSize: '75%',
                data: [{
                    name: 'Total Encoded',
                    y: parseInt(total),
                    color: '#2c3e50'
                    
                }, {
                    name: 'Encoded by you',
                    y: parseInt(totalencoded),
                    color: '#3498db'
                }, {
                    name: 'Employed from you',
                    y: parseInt(totalemployed),
                    color: '#18bc9c'
                }]
            }]
        });
    });
});
</script>
<script src="../js/supplyForm2.js"></script>
</body>
</html>
