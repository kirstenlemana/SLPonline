<?php
  require "../zxcd9.php";
    if(!empty($_GET['id'])) {
     $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
  $query = " 
            SELECT 
                k.id, 
                k.orgname, 
                z.sector, 
                GROUP_CONCAT(DISTINCT z.tag SEPARATOR ',') tag, 
                m.jobname, 
                m.numopenings, 
                m.startdate, 
                m.workingdays, 
                m.workinghours, 
                m.employstatus, 
                m.salary, 
                m.encoded, 
                GROUP_CONCAT(DISTINCT t.region SEPARATOR ', ') region, 
                m.province, 
                m.municipality, 
                m.description, 
                m.requirements, 
                m.partner, 
                m.status, 
                m.reviewed, 
                k.orgname, 
                m.engaged, 
                m.approved, 
                m.completed
            FROM PRTdemand m 
            LEFT JOIN PRTdemandlocs t 
            ON m.id=t.refid 
            LEFT JOIN PRTdemandtags z
            ON m.id=z.demandid
            LEFT JOIN PRTemployers k
            ON m.partner=k.id
            WHERE 
                m.id = :id
        "; 
        $query_params = array( 
            ':id' => $_GET['id'] 
        );
        try 
        { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) 
        { die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP | Partners</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/flatbootstrap.css"/>
    <link rel="stylesheet" href="../css/bootstrapValidator.css"/>
    <link href="../css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="../css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="../js/bootstrapValidator.js"></script>    
    <script src="../js/tag-it.js" type="text/javascript" charset="utf-8"></script>
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
    -webkit-appearance:none;
    -moz-appearance:none;
    -ms-appearance:none;
    appearance:none;background:#fff url(../../../imgs/arrows.png) no-repeat right 9px;
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
.input-group {
    margin-bottom:0.5em;margin-right:1em;margin-left:1em;
}
.autocomplete-suggestions { cursor:pointer;border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
.autocomplete-suggestion { cursor:pointer;padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-no-suggestion { padding: 2px 5px;}
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: bold; color: #000; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
.ui-tooltip {
    background: #000;
    color: white;
    border: none;
    padding: 0;
    opacity: 1;
}
.ui-tooltip-content {
    position: relative;
    padding: 1em;
}
.ui-tooltip-content::after {
    content: '';
    position: absolute;
    border-style: solid;
    display: block;
    width: 0;
}
.right .ui-tooltip-content::after {
    top: 18px;
    left: -10px;
    border-color: transparent #666;
    border-width: 10px 10px 10px 0;
}
.left .ui-tooltip-content::after {
    top: 18px;
    right: -10px;
    border-color: transparent #666;
    border-width: 10px 0 10px 10px;
}
.top .ui-tooltip-content::after {
    bottom: -10px;
    left: 72px;
    border-color: #666 transparent;
    border-width: 10px 10px 0;    
}
.bottom .ui-tooltip-content::after {
    top: -10px;
    left: 72px;
    border-color: #666 transparent;
    border-width: 0 10px 10px;
}
</style>
</style>
</head>
<body>
<script>
$(document).ready(function() {
      prefloc = 0;
      $('#tooltip1').popover();
      $('#jobname').tooltip();
});
</script>
<?php include "../nav.php"; ?>
<div class="container-fluid" id="successcontent" style="display:none">
      <div class="col-md-12" stlye="margin-top:2em">
              <center><img src="../imgs/upload.png"><br>
              <h1>Success!</h1><br>
              Your changes have been saved.<br><br>
              <button id="resetbutton" class="btn btn-info">Go Back</button>
      </div>
</div>
<div class="container-fluid" id="maincontent">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-bottom:3em"><center>
        <form id="postjobForm_edit" action="" method="post">
          <h2><b>Job</b> Details</h2><br>
<?PhP
$sql = "SELECT id, orgname FROM PRTemployers";
$partnerIDArray = [];
$partnerArray = [];
foreach ($db->query($sql) as $results)
{
  $partnerIDArray[] = intval($results["id"]);
  $partnerArray[] = $results["orgname"];
}
?>
<script>
$(document).ready(function() {
  window.selectPartner = "";
  window.originalPartner = "<?php echo $row['id']; ?>";
  window.idName = "<?php echo $_GET['id']; ?>";
$(function () {
    'use strict';
    var partnerIDArray = <?php echo json_encode($partnerIDArray);?>;
    var partnerArray = <?php echo json_encode($partnerArray);?>;
    var arr = [];
    var element = {};
    for (var i = 0; i < partnerArray.length; i++) {
        var idname=partnerIDArray[i];
        var name=partnerArray[i];
        element[idname] = name;
    }
    var countriesArray = $.map(element, function (value, key) { return { value: value, data: key }; });
    $('#autocompleteajax').autocomplete({
        lookup: countriesArray,
        lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
            var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
            return re.test(suggestion.value);
        },
        onSelect: function(suggestion) {
            window.selectPartner = suggestion.data;
            
            $('#selction-ajax').html('<font color="#18bc9c">Selected Partner: <b>' + suggestion.value + '</b></font> ');
        },
        onHint: function (hint) {
            $('#autocomplete-ajax-x').val(hint);
        },
        onInvalidateSelection: function() {
            $('#selction-ajax').html('Selected Partner: <b><font color="#e74c3c">none</font></b>');
        }
    });
});
});
</script>
                            <div class="form-group">
                              <div class="col-sm-12">
                                        <input type="text" name="autocompleteajax" id="autocompleteajax" class="form-control" placeholder="Search for Partner" value="<?php echo $row['orgname']; ?>"/>
                                        <input type="hidden" id="autocomplete-ajax-x" disabled="disabled"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12" style="text-align:left;margin-top:0.5em;margin-bottom:0.5em">
                                <div class="has-feedback" id="selction-ajax">Selected Partner: <b><?php echo $row["orgname"]; ?></b></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <select id="sector" name="sector" onchange="sectorChange()" class="form-control cleanselect">
                                    <option selected><?php echo $row["sector"]; ?></option>
                                    <option>Primary Sector</option>
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
                  <div class="form-group" style="margin-bottom:0.2em;" id="idg">
                    <div class="col-sm-12">
                        <input name="subsector" id="subsector" value="" type="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input name="jobname" class="form-control" id="jobname" placeholder="Specific Vacancy / Job Opening Name" value="<?php echo $row['jobname']; ?>" title="Specific Job Opening / Vacancy Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-6">
                      <input name="numopenings" class="form-control" type="number" id="numopenings" placeholder="Number of Openings" value="<?php echo $row['numopenings']; ?>" title="Number of Openings">
                    </div>
                    <div class="col-sm-6">
                      <input name="startdate" class="form-control" id="startdate" placeholder="Expected Start Date (mm/dd/yyyy)" value="<?php $phpdate = strtotime( $row['startdate'] ); $mysqldate = date( 'm/d/Y', $phpdate ); echo $mysqldate; ?>" title="Expected Start Date (mm/dd/yyyy)">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-6">
                      <input name="workingdays" class="form-control" type="number" id="workingdays" placeholder="Working Days per Week" value="<?php echo $row['workingdays']; ?>" title="Working Days Per Week">
                    </div>
                    <div class="col-sm-6">
                      <input name="workinghours" class="form-control" type="number" id="workinghours" placeholder="Working Hours per Day" value="<?php echo $row['workinghours']; ?>" title="Working Hours per Day">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                                <select class="form-control cleanselect" name="employstatus" id="employstatus" required>
                                  <option selected><?php echo $row["employstatus"]; ?></option>
                                  <option>Regular</option>
                                  <option>Contractual</option>
                                  <option>MOA</option>
                                  <option>Job Order</option>
                                </select>
                    </div>
                  </div>
                  <div class="form-group">
                        <div class="col-sm-6">
                              <select class="form-control cleanselect" name="salary" id="salary" required>
                                <option selected><?php echo $row["salary"]; ?></option>
                                <option>Below 4,000</option>
                                <option>4,000-6,000</option>
                                <option>6,001-10,000</option>
                                <option>10,001-15,000</option>
                                <option>15,001-20,000</option>
                                <option>20,001-25,000</option>
                                <option>25,001-30,000</option>
                                <option>Above 30,000</option>
                              </select>
                        </div>
                        <div class="col-sm-6">
                              <select class="form-control cleanselect" name="prefsex" id="prefsex" >
                                <option value="" selected>Preferred Sex</option>
                                <option><?php echo $row["prefsex"]; ?></option>
                                <option value="">None</option>
                                <option>Male</option>
                                <option>Female</option>
                              </select>
                        </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-6">
                      <select class="form-control cleanselect" name="prefage" id="prefage" >
                                <option value="" selected>Preferred Age Group</option>
                                <option><?php echo $row["prefage"]; ?></option>
                                <option value="">None</option>
                                <option>18-25</option>
                                <option>25-35</option>
                                <option>35-45</option>
                                <option>45+</option>
                              </select>
                    </div>
                    <div class="col-sm-6">
                      <select class="form-control cleanselect" name="prefheight" id="prefheight" >
                                <option value="0" selected>Preferred Height</option>
                                <option value="0">None</option>
                                      <option value="1">Below 5'ft</option>
                                      <option value="2">5'0 to 5'3 ft</option>
                                      <option value="3">5'4 to 5'7 ft</option>
                                      <option value="4">5'8 to 5'10 ft</option>
                                      <option value="5">Above 5'10 ft</option>
                              </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <textarea name="description" class="form-control" id="description" placeholder="Brief Description of Job" style="resize:none;padding-top:8px;padding-bottom:8px;" rows="3" value="<?php echo $row['description']; ?>" required title="Brief Description of Job"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <textarea name="requirements" class="form-control" id="requirements" placeholder="Job Requirements / Qualifications (Docs, ID pics, Certificates, etc)" style="resize:none;padding-top:8px;padding-bottom:8px;" rows="3" value="<?php echo $row['requirements']; ?>" required title="Job Requirements"></textarea>
                    </div>
                  </div>
                        <?php
                          if ($_SESSION['filter'] == "NPMO") {
                            echo '<div class="form-group" style="">'.
                                        '<div class="col-sm-12">'.
                                          '<select class="form-control cleanselect" name="region" id="region" required>'.
                                            '<option value="" selected>Select Region</option>'.
                                            '<option value="CAR">Cordillera Administrative Region</option>'.
                                            '<option value="NCR">National Capital Region</option>'.
                                            '<option value="REGION I">REGION I: Ilocos Region</option>'.
                                            '<option value="REGION II">REGION II: Cagayan Valley</option>'.
                                            '<option value="REGION III">REGION III: Central Luzon</option>'.
                                            '<option value="REGION IV-A">REGION IV-A: CALABARZON</option>'.
                                            '<option value="REGION IV-B">REGION IV-B: MIMAROPA</option>'.
                                            '<option value="REGION V">REGION V: Bicol</option>'.
                                            '<option value="REGION VI">REGION VI: Western Visayas</option>'.
                                            '<option value="REGION VII">REGION VII: Central Visayas</option>'.
                                            '<option value="REGION VIII">REGION VIII: Eastern Visayas</option>'.
                                            '<option value="REGION IX">REGION IX: Zamboanga Peninsula</option>'.
                                            '<option value="REGION X">REGION X: Northern Mindanao</option>'.
                                            '<option value="REGION XI">REGION XI: Davao</option>'.
                                            '<option value="REGION XII">REGION XII: SOCCSKSARGEN</option>'.
                                            '<option>CARAGA</option>'.
                                            '<option>ARMM</option>'.
                                            '<option value="NIR">Negros Island Region</option>'.
                                          '</select>'.
                                        '</div>'.
                            '</div>';
                          }?>
                            <div class="form-group" id="provholder">
                                        <div class="col-sm-12">
                                          <select class="form-control cleanselect" id="province" name="province" required>
                                            <option selected><?php echo $row['province']; ?></option>
                                          </select>
                                        </div>
                            </div>
                            <div class="form-group" id="muniholder" >
                                        <div class="col-sm-12">
                                          <select class="form-control cleanselect" id="municipality" name="municipality" >
                                            <option selected><?php echo $row['municipality']; ?></option>
                                          </select>
                                        </div>
                            </div>
                            
                            <div id="newinput" style="display:block" class="form-group"></div>
                            <div id="newinput2" style="display:block" class="form-group"></div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input name="contactperson" class="form-control" id="contactperson" placeholder="Alternate Contact Person" value="<?php echo $row['contactperson']; ?>" title="Alternate Contact Person">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-6">
                                <input name="contacttitle" class="form-control" id="contacttitle" placeholder="Alternate Contact Title" value="<?php echo $row['contacttitle']; ?>" title="Alternate Contact Title">
                              </div>
                              <div class="col-sm-6">
                                <input name="contactemail" class="form-control" id="contactemail" placeholder="Alternate Contact E-mail" value="<?php echo $row['contactemail']; ?>" title="Alternate Contact E-mail">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input name="contactnumber" class="form-control" id="contactnumber" placeholder="Alternate Contact Number (Mobile)" value="<?php echo $row['contactnumber']; ?>" title="Alternate Contact Number (Mobile)">
                              </div>
                            </div>
                      </form>
                            <div class="form-group">
                              <div class="col-md-5">
                                <div id="statusdisp" class="col-sm-12" style="color:red;text-align:center"></div>
                              </div>
                              <div class="col-md-2">
                                <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="font-size:30px;"></span>
                              </div>
                              <div class="col-md-5">
                                  <button class="btn btn-warning pull-right" id="" onclick="history.back();">Go Back</button> &nbsp; 
                                  <button class="btn btn-success pull-right" id="formsubmit" style="margin-right:5px">Save Changes</button> &nbsp; 
                              </div>
                            </div>

                  </div>
              </div>
            
          </div><!--end container-->
<?php
              $jobtagrow = $row['tag'];
              $jobtags = explode(',', $jobtagrow);
?>
<script>
var tagsArray = <?php echo json_encode($jobtags);?>;
$('#jobname').tooltip({'trigger':'focus', 'title': 'Hello!'});
$('#numopenings').tooltip({'trigger':'focus', 'title': 'Hello!'});
$('#startdate').tooltip({'trigger':'focus', 'title': 'Hello!'});
$('#workinghours').tooltip({'trigger':'focus', 'title': 'Hello!'});
$('#workingdays').tooltip({'trigger':'focus', 'title': 'Hello!'});
$('#description').tooltip({'trigger':'focus', 'title': 'Hello!'});
$('#requirements').tooltip({'trigger':'focus', 'title': 'Hello!'});
$('#contactperson').tooltip({'trigger':'focus', 'title': 'Hello!'});
$('#contacttitle').tooltip({'trigger':'focus', 'title': 'Hello!'});
$('#contactemail').tooltip({'trigger':'focus', 'title': 'Hello!'});
$('#contactnumber').tooltip({'trigger':'focus', 'title': 'Hello!'});
var desc = "<?php echo preg_replace( "/\r|\n/", " ", $row['description'] ); ?>"
var req = "<?php echo preg_replace( "/\r|\n/", " ", $row['requirements'] ); ?>"
document.getElementById("description").value = desc;
document.getElementById("requirements").value = req;
    $('#subsector').tagit({
        readOnly: true,
        onTagClicked: function(evt, ui) {
            var tagname = ($('#subsector').tagit('tagLabel', ui.tag));
            $("#subsector").tagit("removeTagByLabel", tagname);
        }
    });
    for (i=0;i<tagsArray.length;i++) {
              $("#subsector").tagit("createTag", tagsArray[i]);
            }
    sectorChange();
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
$("#zprefloc2").click(function(event) {
  console.log("sad");
  event.preventDefault();
  event.stopImmediatePropagation();
  addForm();
});
function preferLoc() {
        if (!document.getElementById('preflocbox').checked) {
            for (i = 1; i <= prefloc; ++i) {
              document.getElementById("pref"+i+"").style.display = "none";
            }
            document.getElementById("zprefloc2").style.display = "none";
        } else {
          if (prefloc > 0) {
            for (i = 1; i <= prefloc; ++i) {
              document.getElementById("pref"+i+"").style.display = "block";
            }
            document.getElementById("zprefloc2").style.display = "block";
          } else {
            addForm();        
          }
        }
}
$("#prefloc2").click(function(event) {
  console.log("sad");
  event.preventDefault();
  event.stopImmediatePropagation();
  addForm();
});
function addForm() {
  prefloc++;
  var newdiv = document.createElement('div');
      newdiv.setAttribute("id", "pref"+prefloc+"");
  newdiv.innerHTML = '<div class="input-group">'+
                                '<span class="input-group-addon">Preferred '+prefloc+'</span>'+
                                '<select class="form-control cleanselect" id="reg'+prefloc+'" onchange="populateField('+prefloc+',this.value);" name="reg'+prefloc+'" required>'+
                                            '<option value="" selected>Select Region</option>'+
                                            '<option value="CAR">Cordillera Administrative Region</option>'+
                                            '<option value="NCR">National Capital Region</option>'+
                                            '<option value="REGION I">REGION I: Ilocos Region</option>'+
                                            '<option value="REGION II">REGION II: Cagayan Valley</option>'+
                                            '<option value="REGION III">REGION III: Central Luzon</option>'+
                                            '<option value="REGION IV-A">REGION IV-A: CALABARZON</option>'+
                                            '<option value="REGION IV-B">REGION IV-B: MIMAROPA</option>'+
                                            '<option value="REGION V">REGION V: Bicol</option>'+
                                            '<option value="REGION VI">REGION VI: Western Visayas</option>'+
                                            '<option value="REGION VII">REGION VII: Central Visayas</option>'+
                                            '<option value="REGION VIII">REGION VIII: Eastern Visayas</option>'+
                                            '<option value="REGION IX">REGION IX: Zamboanga Peninsula</option>'+
                                            '<option value="REGION X">REGION X: Northern Mindanao</option>'+
                                            '<option value="REGION XI">REGION XI: Davao</option>'+
                                            '<option value="REGION XII">REGION XII: SOCCSKSARGEN</option>'+
                                            '<option value="CARAGA">CARAGA</option>'+
                                            '<option value="ARMM">ARMM</option>'+
                                            '<option value="NIR">Negros Island Region</option>'+
                                '</select>'+
                            '</div>'+
                            '<div class="input-group">'+
                                '<span class="input-group-addon">Preferred '+prefloc+'</span>'+
                                '<select class="form-control cleanselect" id="prov'+prefloc+'" name="prov'+prefloc+'" required><option value="" selected>Province (Select Region)</option></select>'+
                            '</div>'
  document.getElementById("newinput").appendChild(newdiv);
  document.getElementById("newinput2").innerHTML = '<div class="form-group">'+
                                        '<div class="col-sm-7" style="font-size:14px">'+
                                        '</div>'+
                                        '<div class="col-sm-5">'+
                                          '<button class="btn col-sm-12 btn-info" id="zprefloc2" onclick="addForm(); return false;" name="zprefloc2">Add Location</button>'+
                                        '</div>'+
                            '</div>';
}
function removeOptions(selectbox)
{
    var i;
    for(i=selectbox.options.length-1;i>=0;i--)
    {
        selectbox.remove(i);
    }
}

$("#region").change(function() {
      var $dropdown = $(this);
      $.getJSON("../json/regiondata.json", function(data) {
      
        var key = $dropdown.val();
        var vals = [];
        var $secondChoice = $("#province");
        var $thirdChoice = $("#province");
        switch(key) {
          case 'Select Office':
            $secondChoice.empty();
            $secondChoice.append("<option value=''>-</option>");
            break;
          case 'NPMO':
            $secondChoice.empty();
            $secondChoice.append("<option value=''>-</option>");
            break;
          case 'CAR':
            vals = data.CAR.split(",");
            break;
          case 'NCR':
            vals = data.NCR.split(",");
            break;
          case 'REGION I':
            vals = data.I.split(",");
            break;
          case 'REGION II':
            vals = data.II.split(",");
            break;
          case 'REGION III':
            vals = data.III.split(",");
            break;
          case 'REGION IV-A':
            vals = data.IVA.split(",");
            break;
          case 'REGION IV-B':
            vals = data.IVB.split(",");
            break;
          case 'REGION V':
            vals = data.V.split(",");
            break;
          case 'REGION VI':
            vals = data.VI.split(",");
            break;
          case 'REGION VII':
            vals = data.VII.split(",");
            break;
          case 'REGION VIII':
            vals = data.VIII.split(",");
            break;
          case 'REGION IX':
            vals = data.IX.split(",");
            break;
          case 'REGION X':
            vals = data.X.split(",");
            break;
          case 'REGION XI':
            vals = data.XI.split(",");
            break;  
          case 'REGION XII':
            vals = data.XII.split(",");
            break;
          case 'CARAGA':
            vals = data.CARAGA.split(",");
            break;
          case 'ARMM':
            vals = data.ARMM.split(",");
            break;
          case 'NIR':
            vals = data.NIR.split(",");
            break;
        }
        
        if (key != "NPMO" && key != "Select Office") {
            document.getElementById("province").disabled = false;
            $secondChoice.empty();
            $secondChoice.append("<option>Select Province</option>");
            $.each(vals, function(index, value) {
              $secondChoice.append("<option>" + value + "</option>");
            });
        } else {
            document.getElementById("province").disabled = true;
            document.getElementById("municipality").disabled = true;
        }
    });
});

$.getJSON("../json/regiondata.json", function(data) {
      key = "<?php echo $_SESSION['filter']; ?>";
      var $secondChoice = $("#province");
      vals = [];
        switch(key) {
          case 'Job Location (Region)':
            $secondChoice.empty();
            $secondChoice.append("<option value=''>Province (Select Region First)</option>");
            break;
          case 'CAR':
            vals = data.CAR.split(",");
            break;
          case 'NCR':
            vals = data.NCR.split(",");
            break;
          case 'REGION I':
            vals = data.I.split(",");
            break;
          case 'REGION II':
            vals = data.II.split(",");
            break;
          case 'REGION III':
            vals = data.III.split(",");
            break;
          case 'REGION IV-A':
            vals = data.IVA.split(",");
            break;
          case 'REGION IV-B':
            vals = data.IVB.split(",");
            break;
          case 'REGION V':
            vals = data.V.split(",");
            break;
          case 'REGION VI':
            vals = data.VI.split(",");
            break;
          case 'REGION VII':
            vals = data.VII.split(",");
            break;
          case 'REGION VIII':
            vals = data.VIII.split(",");
            break;
          case 'REGION IX':
            vals = data.IX.split(",");
            break;
          case 'REGION X':
            vals = data.X.split(",");
            break;
          case 'REGION XI':
            vals = data.XI.split(",");
            break;  
          case 'REGION XII':
            vals = data.XII.split(",");
            break;
          case 'CARAGA':
            vals = data.CARAGA.split(",");
            break;
          case 'ARMM':
            vals = data.ARMM.split(",");
            break;
          case 'NIR':
            vals = data.NIR.split(",");
            break;
        }    
        if (key != "") {
            $secondChoice.empty();
            $secondChoice.append("<option selected><?php echo $row['province']; ?></option>");
            $.each(vals, function(index, value) {
              $secondChoice.append("<option>" + value + "</option>");
            });
        } else {
            $secondChoice.empty();
            $secondChoice.append("<option value=''>Province (Select Region First)</option>");
            document.getElementById("province").disabled = true;
            document.getElementById("municipality").disabled = true;
        }
      });//endjson
    $.getJSON("../json/munidata.json", function(data) {
        var key2 = $("#province").val();
        var vals = [];
        var $thirdchoice = $("#municipality");
        document.getElementById("municipality").disabled = false;
            if (key2) {       
                for (key in data) {
                    vals = data[key2].split(",");
                }
            }
        $.each(vals, function(index, value) {
          $thirdchoice.append("<option>" + value + "</option>");
        });
    });//endjson
    $("#province").change(function() {
      $("#muniholder").slideDown("fast");
      var $dropdown = $(this);
      var json = $.getJSON("../json/munidata.json", function(data) {
        var key2 = $dropdown.val();
        var vals = [];
        var $thirdchoice = $("#municipality");
        document.getElementById("municipality").disabled = false;
            if (key2) {       
                for (key in data) {
                    vals = data[key2].split(",");
                }
            }
        $thirdchoice.empty();
        $thirdchoice.append("<option selected><?php echo $row['municipality']; ?></option>");
        $.each(vals, function(index, value) {
          $thirdchoice.append("<option>" + value + "</option>");
        });
          });//endjson
      });//endprovince
</script>
<script type="text/javascript" src="../js/postjobForm_edit.js"></script>
<script type="text/javascript" src="../js/jquery.autocomplete.min.js"></script>
</body>
</html>
