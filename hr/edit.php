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
</style>
</head>
<body>
<?php include "nav.php"; ?>
<script type="text/javascript" src="../js/editForm.js"></script>
<div class="container-fluid">
<?php
if(!empty($_GET)) { 
  $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_NUMBER_INT);
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
            ':id' => $_GET['id'] 
        ); 
        try  {
         $stmt = $db->prepare($query); $result = $stmt->execute($query_params);
         } 
        catch(PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage()); 
        } 
        $row = $stmt->fetch();
        $birthdate = date('m/d/Y', strtotime($row['birthdate']));
        $employdate = date('m/d/Y', strtotime($row['employdate']));
        if ($row['password'] == "") {
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
        die; }
?>
<!--ifsuccess-->
      <div class="col-md-offset-2 col-md-8 successcontent">
        <center>
          <br><img src="../imgs/upload.png">
          <br><font size="70px" color="#5cb85c">Success!</font>
          <br><font size="4px">Details have been updated.</font>
          <br><br><a href="http://slp.ph/hr/user.php?id=<?php echo $_GET['id'];?>"><button class="btn btn-success" id="btnAddnew">Leave this page</button></a>
      </div>
      <!--end ifsuccess-->
      <div class="col-md-offset-2 col-md-8" id="maincontent">
          <div class="row">
              <div class="col-sm-12" role="alert" style="border:0px solid;padding:5px 0px 15px 0px;font-size:20px">
                <center>
                <div class="col-sm-offset-2 col-sm-9" style="text-align:center;padding-left:2em">
                  <h1>HR <span style="font-weight:900">Edit</span></h1>
                </div>
              </div>
            </div>
<script>
window.sex = 0;
function ismale() {
  window.sex = 0;
  console.log(sex);
}
function isfemale() {
  window.sex = 1;
  console.log(sex);
}
</script>
<form class="form-horizontal" id="editForm" method="post" action="adduser.php" autocomplete="off">
                          <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                              <input name="firstname" class="form-control" id="firstName" value="<?php echo $row['firstname'];?>" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="midname" class="col-sm-2 control-label">Middle Name</label>
                            <div class="col-sm-10">
                              <input name="midname" class="form-control" id="midName" value="<?php echo $row['middlename'];?>" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                              <input name="lastname" class="form-control" id="lastName" value="<?php echo $row['lastname'];?>" required>
                            </div>
                          </div>
                          <div class="row" >
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="nickname" class="col-sm-4 control-label">Nick Name</label>
                                  <div class="col-sm-8">
                                    <input name="nickname" class="form-control" id="nickname" value="<?php echo $row['nickname'];?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="extname" class="col-sm-4 control-label">Ext Name</label>
                                  <div class="col-sm-8">
                                    <input name="extname" class="form-control" id="extName" value="<?php echo $row['extname'];?>">
                                  </div>
                                </div>
                              </div>
                          </div>
                           <div class="row" >
                              <div class="col-sm-6">
                                  <div class="form-group">
                                        <label for="sex" class="col-sm-4 control-label">Sex</label>
                                        <div class="radio col-sm-4">
                                          <label>
                                            <input type="radio" name="sex" id="sexmale" value="0" onclick="ismale()"/> Male
                                        </label>
                                        </div>
                                        <div class="radio col-sm-4">
                                          <label>
                                            <input type="radio" name="sex" id="sexfemale" value="1" onclick="isfemale()"/> Female
                                        </label>
                                        </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Birthdate</label>
                                      <div class="col-xs-8">
                                          <input type="text" class="form-control" name="birthdate" id="birthdate" value="<?php echo $birthdate;?>" required/>
                                      </div>
                                  </div>
                                </div>
                          </div>
                          <div class="row" >
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="emailaddress" class="col-sm-4 control-label">Email</label>
                                  <div class="col-sm-8">
                                    <input name="emailaddress" class="form-control" id="emailaddress" value="<?php echo $row['emailaddress'];?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="extName" class="col-sm-4 control-label">Mobile Number</label>
                                  <div class="col-sm-8">
                                    <input class="form-control" name="contactnumber" id="contactnumber" value="<?php echo $row['contactnumber'];?>" required>
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="designation" class="col-sm-4 control-label">Designation</label>
                                  <div class="col-sm-8">
                                        <select class="form-control cleanselect" name="designation" id="designation" required>
                                          <option selected><?php echo $row['designation'];?></option>
                                          <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM libhr_designation order by hrdesignationname");
                              //$prof->bindParam(':hr_dbida', $_SESSION['pageid']);
                              $sql->execute();
                         //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                        
                        while($hrdesignationname=$sql->fetch(PDO::FETCH_ASSOC))
                        {
                      ?>
                        <option value=" <?php echo $hrdesignationname['hrdesignationname']; ?>"> <?php echo $hrdesignationname['hrdesignationname']; ?> </option>
                      <?php
                        }
                        } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                            }//en
                      ?>
                      </select>
                    <!-- upto this -->    
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="position" class="col-sm-4 control-label">Position</label>
                                  <div class="col-sm-8">
                                        <select class="form-control cleanselect" id="position" name="position" id="position" required>
                                          <option selected><?php echo $row['position'];?></option>
                                           <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM libhr_position order by hrpositionname");
                              //$prof->bindParam(':hr_dbida', $_SESSION['pageid']);
                              $sql->execute();
                         //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                      while($hrpositionname=$sql->fetch(PDO::FETCH_ASSOC))
                        {
                      ?>
                        <option value=" <?php echo $hrpositionname['hrpositionname']; ?>"> <?php echo $hrpositionname['hrpositionname']; ?> </option>
                      <?php
                        }
                        } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                            }//en
                      ?>
                      </select>
                    <!-- upto this --> 
                                  </div>
                                </div>
                              </div>
                         </div>
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="designation" class="col-sm-4 control-label">Employment Status</label>
                                <div class="col-sm-8">
                                      <select class="form-control cleanselect" name="employstatus" id="employstatus"  required>
                                        <option><?php echo $row['employstatus'];?></option>
                                        <option>Regular</option>
                                        <option>Contractual</option>
                                        <option>MOA</option>
                                        <option>Job Order</option>
                                      </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="designation" class="col-sm-4 control-label" >Fund Source</label>
                                <div class="col-sm-8">
                                      <select class="form-control cleanselect" name="fundsource" id="fundsource"  required>
                                        <option><?php echo $row['fundsource'];?></option>
                                               <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM libhr_fundsource order by hrfundsourcename");
                              //$prof->bindParam(':hr_dbida', $_SESSION['pageid']);
                              $sql->execute();
                         //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                      while($hrfundsourcename=$sql->fetch(PDO::FETCH_ASSOC))
                        {
                      ?>
                        <option value=" <?php echo $hrfundsourcename['hrfundsourcename']; ?>"> <?php echo $hrfundsourcename['hrfundsourcename']; ?> </option>
                      <?php
                        }
                              } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                            }//en
                      ?>
                      </select>
                    <!-- upto this --> 
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-6">
                                              <div class="form-group">
                                                  <label class="col-sm-4 control-label">Date of Employment</label>
                                                  <div class="col-xs-8">
                                                      <input type="text" class="form-control" name="employdate" id="employdate" value="<?php echo $employdate;?>" required/>
                                                  </div>
                                              </div>
                                            </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="designation" class="col-sm-4 control-label">Regional Office</label>
                                    <div class="col-sm-8">
                                          <select class="form-control cleanselect" name="region" id="region" onchange="getProv()" required >
                                            <option selected><?php echo $row['region'];?></option>
                                           <!-- get this --> 
                      <?php
                      $query = "SELECT * FROM lib_regions"; 
                      try { 
                          $stmt = $db->prepare($query); $result = $stmt->execute(); } 
                      catch(PDOException $ex) { 
                      die("Failed to run query: " . $ex->getMessage()); 
                      } 
                      while ($rowl = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          echo "<option value='".$rowl["regid"]."'>".$rowl['regname']."</option>";
                      }
                      ?>
                      </select>
<!-- up to this -->
                                    </div>
                                  </div>
                                </div>
                        </div>
                        <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="designation" class="col-sm-4 control-label">Province</label>
                                  <div class="col-sm-8">
                                        <select class="form-control cleanselect" id="province" name="province" onchange="getCitymun()">
                                          <option selected><?php echo $row['province'];?></option>
                                        </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="designation" class="col-sm-4 control-label">Municipality</label>
                                  <div class="col-sm-8">
                                        <select class="form-control cleanselect" id="municipality" name="municipality" >
                                          <option selected><?php echo $row['municipality'];?></option>
                                        </select>
                                  </div>
                                </div>
                              </div>
                      </div>
                          <div class="form-group">
                            <label for="remarks" class="col-sm-2 control-label">Remarks</label>
                            <div class="col-sm-10">
                              <input name="remarks" class="form-control" id="remarks" placeholder="" value="<?php echo $row['remarks'];?>">
                            </div>
                      </div><br>
                      <div class="col-md-offset-2 col-md-10"><center><b>DSWD-SLP Issued Computers</b><br>
                      This will be used as a reference in the distribution of new laptops, desktops, or tablets.</center><hr style="border:1.5px solid #d4dcde;"></div>
                      <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="designation" class="col-sm-4 control-label">Type of DSWD issued computer</label>
                                    <div class="col-sm-8">
                                          <select class="form-control cleanselect" name="comptype" id="comptype" >
                                            <?php
                                            if ($row['comptype'] == "") {
                                              echo '<option selected>None issued</option>';
                                            } else {
                                              echo '<option selected>'.$row['comptype'].'</option>';
                                            }
                                            ?>
                                            <option>None issued</option>
                                            <option>Desktop</option>
                                            <option>Laptop</option>
                                            <option>Tablet</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="designation" class="col-sm-4 control-label">Year Issued</label>
                                    <div class="col-sm-8">
                                          <select class="form-control cleanselect" name="compyear" id="compyear" >
                                            <?php
                                            if ($row['compyear'] != "") {
                                              echo '<option selected>'.$row['compyear'].'</option>';
                                            }
                                            ?>
                                            <option>-</option>
                                            <option>2011</option>
                                            <option>2012</option>
                                            <option>2013</option>
                                            <option>2014</option>
                                            <option>2015</option>
                                            <option>2016</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="designation" class="col-sm-4 control-label">Condition</label>
                                    <div class="col-sm-8">
                                          <select class="form-control cleanselect" name="compstatus" id="compstatus" >
                                            <?php
                                            if ($row['compstatus'] == "") {
                                              echo '<option selected>-</option>';
                                            } else {
                                              echo '<option selected>'.$row['compstatus'].'</option>';
                                            }
                                            ?>
                                            <option>-</option>
                                            <option>Working</option>
                                            <option>Not working</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Notes</label>
                                      <div class="col-xs-8">
                                          <input type="text" class="form-control" name="compnotes" id="compnotes" value="<?php echo $row['compnotes'];?>" placeholder="" />
                                      </div>
                                  </div>
                                </div>
                        </div>
                      <div class="row">
                          <div class="col-sm-6">
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <div class="col-sm-4" style="text-align:right;vertical-align:middle;padding-top:7px">
                                <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="font-size:30px;"></span>
                              </div>
                              <div class="col-sm-8">
                                <button id="hrsubmit" class="btn col-sm-12 btn-success has-feedback" style="font-size:18px">Save Edit</button>
                                <div id="statusdisp" class="col-sm-12" style="color:red;text-align:center"></div>
                              </div>
                            </div>
                          </div>
                      </div>
  </form>
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
function getProv() {
  var formData = { 
    'action' : 'province',
    'regionid' : $('#region option:selected').val()
  };
  $.ajax({
  type: "POST",
  url: "add/getLocations.php",
  data: formData,
  success: function(data) {
            $("#province").prop('disabled', false);
            $("#province").html(data);
        }
    });
}
function getCitymun() {
  var formData = { 
    'action' : 'citymun',
    'provid' : $('#province option:selected').val()
  };
  $.ajax({
  type: "POST",
  url: "add/getLocations.php",
  data: formData,
  success: function(data) {
            $("#municipality").prop('disabled', false);
            $("#municipality").html(data);
        }
    });
}
$(document).ready(function() {
sexload = '<?php echo $row['sex'];?>';
window.confirmcode = '<?php $getid = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT); echo $getid;?>';
key = '<?php echo $row["region"]; ?>';
var found3 = [];
		$("select option").each(function() {
			  if($.inArray(this.value, found3) != -1) $(this).remove();
			  found3.push(this.value);
		});
if (sexload == 0) {
  document.getElementById("sexmale").checked = true;
  document.getElementById("sexfemale").checked = false;
} else {
  document.getElementById("sexmale").checked = false;
  document.getElementById("sexfemale").checked = true;
}
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
$('#btnAddnew').click(function() {
      $(".successcontent").hide();
      $("#maincontent").show();
      $('#editForm').data('bootstrapValidator').resetForm(true);
});//endreset
});//end DOC READY
</script>
</body>
</html>
