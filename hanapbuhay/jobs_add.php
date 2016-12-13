<?php
  require "../zxcd9.php";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
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
. {
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
</style>
</style>
</head>
<body>
<script>
$(document).ready(function() {
      prefloc = 0;
      $('#tooltip1').popover();
});
</script>
<?php include "../nav.php"; ?>
<div class="container-fluid" id="successcontent" style="display:none">
      <div class="col-md-12">
              <center><img src="../imgs/upload.png"><br>
              <h1>Success!</h1><br>
              Job successfully added to database.<br><br>
              <button id="resetbutton" class="btn btn-primary">Add More</button>
      </div>
</div>
<div class="container-fluid" id="maincontent">
     <div class="row">
          <div class="col-md-8 col-md-offset-2" style="margin-bottom:3em"><center>
          <form id="postjobForm" action="" method="post">
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
            console.log(suggestion.data);
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
function intervent() {
  var intervent = $('#pintervention option:selected').val();
  if (intervent == "Training" || intervent == "Placement") {
      $('#indirectholder').slideDown(500);
  }
  if (intervent == "Direct Employment") {
      $('#indirectholder').fadeOut(500);
  }
}
</script>
                            <div class="form-group">
                              <div class="col-sm-12" style="text-align:left">
                                        This job was referred by:<br>
                                        <input type="text" name="autocompleteajax" id="autocompleteajax" class="form-control" placeholder="Search for partner"/>
                                        <input type="hidden" id="autocomplete-ajax-x" disabled="disabled"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12" style="text-align:left;margin-top:0.5em;margin-bottom:0.5em">
                                <div id="selction-ajax">Selected Partner: <b><font color="#e74c3c">none</font></b></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-6">
                                          <select class="form-control " name="pintervention" id="pintervention" required onchange="intervent()">
                                              <option value="" selected>Intervention Type</option>
                                              <option>Direct Employment</option>
                                              <option>Training</option>
                                              <option>Placement</option>
                                          </select>
                              </div>
                              <div class="col-sm-6" id="indirectholder" style="display:none;">
                                    <input type="text" name="indirectpartner" id="indirectpartner" class="form-control" placeholder="Indirect Partner Name">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <select id="sector" name="sector" onchange="sectorChange()" class="form-control ">
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
                                    <option>Manufacturing</option>
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
                                <select id="filter2" onchange="changeValue2();" class="form-control " disabled>
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
                      <input name="jobname" class="form-control" id="jobname" placeholder="Specific Vacancy / Job Opening Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-6">
                      <input name="numopenings" class="form-control" type="number" id="numopenings" placeholder="Number of Openings">
                    </div>
                    <div class="col-sm-6">
                      <input name="startdate" class="form-control" id="startdate" placeholder="Expected Start Date (mm/dd/yyyy)">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-6">
                      <input name="workingdays" class="form-control" type="number" id="workingdays" placeholder="Working Days per Week">
                    </div>
                    <div class="col-sm-6">
                      <input name="workinghours" class="form-control" type="number" id="workinghours" placeholder="Working Hours per Day">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                              <select class="form-control " name="employstatus" id="employstatus" required>
                                <option value="" selected>Status of Employment</option>
                                <option>Regular</option>
                                <option>Contractual</option>
                                <option>MOA</option>
                                <option>Job Order</option>
                              </select>
                    </div>
                  </div>
                  <div class="form-group">
                        <div class="col-sm-6">
                              <select class="form-control " name="salary" id="salary" required>
                                <option value="" selected>Expected Salary (PhP)</option>
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
                              <select class="form-control " name="prefsex" id="prefsex" >
                                <option value="" selected>Preferred Sex</option>
                                <option value="">None</option>
                                <option>Male</option>
                                <option>Female</option>
                              </select>
                        </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-6">
                      <select class="form-control " name="prefage" id="prefage" >
                                <option value="" selected>Preferred Age Group</option>
                                <option value="">None</option>
                                <option>18-25</option>
                                <option>25-35</option>
                                <option>35-45</option>
                                <option>45+</option>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <select class="form-control " name="prefheight" id="prefheight" >
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
                      <textarea name="description" class="form-control" id="description" placeholder="Brief Description of Job" style="resize:none;padding-top:8px;padding-bottom:8px;" rows="3" required></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <textarea name="requirements" class="form-control" id="requirements" placeholder="Job Requirements / Qualifications (Docs, ID pics, Certificates, etc)" style="resize:none;padding-top:8px;padding-bottom:8px;" rows="3" required></textarea>
                    </div>
                  </div>
                        <?php if ($_SESSION['filter'] == "NPMO") { ?>
                        <div class="form-group">
                            <div class="col-sm-12">
                              <select class="form-control" id="region" name="region" onChange='getProv(this.value)' required>
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
                              <select class="form-control " id="region" name="region" hidden required style="visibility:hidden">
                                <option selected><?php echo $_SESSION["filter"]; ?></option>
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
                              <select class="form-control" id="city" name="city" onChange='getBrgy(this.value)' disabled required>
                                <option value="" selected>City/Municipality</option>
                              </select>
                            </div>
                        </div>
                            <div id="newinput" style="display:block" class="form-group"></div>
                            <div id="newinput2" style="display:block" class="form-group"></div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input name="contactperson" class="form-control" id="contactperson" placeholder="Alternate Contact Person">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-6">
                                <input name="contacttitle" class="form-control" id="contacttitle" placeholder="Alternate Contact Title">
                              </div>
                              <div class="col-sm-6">
                                <input name="contactemail" class="form-control" id="contactemail" placeholder="Alternate Contact E-mail">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input name="contactnumber" class="form-control" id="contactnumber" placeholder="Alternate Contact Number (Mobile)">
                              </div>
                            </div>
                      </form>
                            <div class="form-group">
                              <div class="col-md-6">
                                <div id="statusdisp" class="col-sm-12" style="color:red;text-align:center"></div>
                              </div>
                              <div class="col-md-2">
                                <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="font-size:30px;"></span>
                              </div>
                              <div class="col-md-4">
                                <button class="btn btn-success col-md-12" id="formsubmit">SUBMIT</button>
                              </div>
                            </div>
        </div>
    </div>
  
</div><!--end container-->
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
    $('#subsector').tagit({
        readOnly: true,
        onTagClicked: function(evt, ui) {
            var tagname = ($('#subsector').tagit('tagLabel', ui.tag));
            $("#subsector").tagit("removeTagByLabel", tagname);
        }
    });
    $('#idg').hide();
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
          case 'Manufacturing':
            vals = data.zz.split(",");
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
                                '<select class="form-control " id="reg'+prefloc+'" onchange="populateField('+prefloc+',this.value);" name="reg'+prefloc+'" required>'+
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
                                '<select class="form-control " id="prov'+prefloc+'" name="prov'+prefloc+'" required><option value="w" selected>Province (Select Region)</option></select>'+
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
function removeOptions(selectbox) {
    var i;
    for(i=selectbox.options.length-1;i>=0;i--)
    {
        selectbox.remove(i);
    }
}
</script>
<script type="text/javascript" src="../js/postjobForm.js"></script>
<script type="text/javascript" src="../js/jquery.autocomplete.min.js"></script>
</body>
</html>
