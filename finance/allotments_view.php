<?php
require "../zxcd9.php";
if (isset($_POST['editid'])) {
  $_SESSION['editid'] = $_POST['editid'];
  die("visitpage");
}
$_SESSION['pageid'] = $_GET['id'];
if (isset($_GET['id'])) {
 // $_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_NUMBER_INT);
  $stmt = $db->prepare("SELECT fa.region as region,fa.type as type,fa.subtype as subtype,fa.saa as saa,fa.uacs as uacs,fa.fundsource as fundsource,fa.fundsourceyear as fundsourceyear,fa.amount as amount,fa.dateadded as dateadded,fa.d8 as d8, hrd.firstname as fn, hrd.id as id,fa.allotid as allotid, fa.purpose from fin_allotments as fa LEFT JOIN hr_db as hrd ON fa.hrdbid=hrd.id  WHERE allotid = :id");
  $stmt->bindParam(':id', $_GET['id']);
  $stmt->execute();
  $rowdv = $stmt->fetch();
} else {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP | Finance</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/flatbootstrap.css"/>
     <link rel="stylesheet" href="../css/pikaday.css"/>
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/fileicon.css"/>
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
.fileUpload {
    position: relative;
    overflow: hidden;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.autocomplete-suggestions { cursor:pointer;border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
.autocomplete-suggestion { cursor:pointer;padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-no-suggestion { padding: 2px 5px;}
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: bold; color: #000; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
.spinner {
  margin: 20px auto 0;
  width: 90px;
  text-align: center;
}
.spinner > div {
  width: 20px;
  height: 50px;
  background-color: #333;
  border-radius: 10px;
  display: inline-block;
  -webkit-animation: sk-bouncedelay 1.6s infinite ease-in-out both;
  animation: sk-bouncedelay 1.6s infinite ease-in-out both;
}
.spinner .bounce1 {
    background: red;
  -webkit-animation-delay: -1.2s;
  animation-delay: -1.2s;
}
.spinner .bounce2 {
    background: yellow;
  -webkit-animation-delay: -0.8s;
  animation-delay: -0.8s;
}
.spinner .bounce3 {
    background: blue;
  -webkit-animation-delay: -0.4s;
  animation-delay: -0.4s;
}
@-webkit-keyframes sk-bouncedelay {
  0%, 80%, 100% { -webkit-transform: scale(0) }
  40% { -webkit-transform: scale(1.0) }
}
@keyframes sk-bouncedelay {
  0%, 80%, 100% { 
    -webkit-transform: scale(0.0);
    transform: scale(0.0);
  } 40% { 
    -webkit-transform: scale(2.0);
    transform: scale(1.0);
  }
}
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 999999;
    background-color: rgba(255,255,255,0.8);
    text-align: center;
    vertical-align: middle;
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
.smallfont {
  font-size: 13px;
}
.btn-sm {
  padding: 4px 8px 4px 8px;
}
.link-hover:hover {
  color:#333;
  cursor: pointer;
}
.editbtn {
  color:#18bc9c;
}
.delbtn{
  color:#e74c3c;
}
.colorgray {
  color:#999;
}
</style>
</head>
<body>
<?php require "../nav.php"; ?>
<div class="row" style="margin-right:0">
  <div class="col-md-offset-1 col-md-10 padfix padfix2" style="">
    <div style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;text-align:center;padding:1em">
      <div class="row" style="border-bottom:1px solid #c5d6de;padding-left:2em">
        <div class="col-sm-6">
            <h3 style="text-align:left;margin-top:0;font-size:20px"><img src="../imgs/money.png" alt="fund" width="40" height="40">&nbsp;Fund Allotment Details</h3>
        </div>
        <div class="col-sm-6 pull-right">
            <?php
            if ($_SESSION['permlvl']>0||$_SESSION['id']==$rowdv['id']) { 
            ?> 
            <span class="link-hover editbtn pull-right" id="editfile"><span class="glyphicon glyphicon-pencil"></span> Edit &nbsp; </span>
            <span class="link-hover pull-right" id="back" style="color:#00ADDe"><span class="glyphicon glyphicon-backward"></span> Back &nbsp;</span>
            <?php 
            } else {
            ?>
            <span class="link-hover pull-right" id="back" style="color:#00ADDe"><span class="glyphicon glyphicon-backward"></span> Back &nbsp;</span>
            <?php 
            }
            ?>
        </div>
      </div>
     <div class="row">
          <table class="table table-bordered" style="line-height:0.9;vertical-align:middle;border:0;margin-bottom:1em">
              <thead style="background:#f6f8fa">
                <th style="width:10%">Region</th>
                <th >Type</th>
                <th >Sub-type</th>
                <th style="width:15%">Sub-Aro</th>
                <th >Uacs</th>
                <th >Fund Source</th>
                <th >Fund Source Year</th>
                <th >Amount</th>
                <th >Date of allotments</th>
                <th style="width:15%">Purpose</th>
                <th >Uploaded By</th>
              </thead>
              <!--comments-->
              <tr>
                <td><?php echo $rowdv['region'];?></td>
                <td><?php echo $rowdv['type'];?></td>
                <td><?php echo $rowdv['subtype'];?></td>
                <td><?php echo $rowdv['saa'];?></td>
                <td><?php echo $rowdv['uacs'];?></td>
                <td><?php echo $rowdv['fundsource'];?></td>
                <td><?php echo $rowdv['fundsourceyear'];?></td>
                <td>&#8369;<?php echo number_format($rowdv['amount'],2);?></td>
                <td><?php echo $rowdv['d8'];?></td>
                 <td><?php echo $rowdv['purpose'];?></td>
                <td><a href="../hr/user.php?id=<?php echo $rowdv['id']; ?>" style="color:#00ADDe"><?php echo $rowdv['fn']; ?></a><span style='color:#999;font-size:13px'><?php echo " On ".date("m/d/Y", strtotime($rowdv['dateadded'])); ?></span></td>
              </tr>
              <!--comments-->     
              </table>
        </div>
    </div>
  </div>
</div>
<div class="row" style="margin-right:0;margin-top:1em;margin-bottom:3em">
  <div class="col-md-offset-1 col-md-10 padfix padfix2" style="">
    <div style="border:solid 1px #c5d6de;background:#fff;text-align:left;padding:1em;padding-top:0;margin-left:1em;">
        <div class="row">
          <table class="table table-bordered" style="line-height:0.9;vertical-align:middle;border:0;margin-bottom:1em">
              <thead style="background:#f6f8fa">
                <th style="width:33%">NTA</th>
                <th style="width:33%">Amount</th>
                <th style="width:18%">Date of NTA</th>
                <th >Date Added</th>
                <th></th>
              </thead>
              <!--comments-->
            <?php
              $stmtnta = $db->prepare("SELECT f.ntaid,f.nta,f.nta_amount,f.nta_date,h.firstname,h.id,f.id,f.nta_dateadded FROM fin_nta f LEFT JOIN hr_db h ON f.hrdbid=h.id WHERE
                f.ntaid = :id");
              $stmtnta->bindParam(':id', $_GET['id']);
              $stmtnta->execute();
                while ($rowN = $stmtnta->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                if ($_SESSION['permlvl']>0 || $_SESSION['id']==$rowN[5]) {
                    echo "<tr><td>".$rowN[1]." </td><td>&#8369;".number_format($rowN[2],2)."</td><td>".$rowN[3]."</td><td><span style='color:#999;font-size:13px'>by: ".$rowN[4]." on ".date("m/d", strtotime($rowN[7]))."</span></td><td style='text-align:center'><span class='glyphicon glyphicon-edit' id='editcomment' onclick='editnta(".$rowN[6].");'></span> &nbsp;<span class='glyphicon glyphicon-remove' id='deletecomment' onclick='delnta(".$rowN[6].");'></span></td></tr>";
                      }
                    else
                      {
                     echo "<tr><td>".$rowN[1]." </td><td>&#8369;".number_format($rowN[2],2)."</td><td>".$rowN[3]."</td><td><span style='color:#999;font-size:13px'>by: ".$rowN[4]." on ".date("m/d", strtotime($rowN[7]))."</span></td><td style='text-align:center' hidden><span class='glyphicon glyphicon-edit' id='editcomment' onclick='editnta(".$rowN[6].");'></span> &nbsp;<span class='glyphicon glyphicon-remove' id='deletecomment' onclick='delnta(".$rowN[6].");'></span></td></tr>";
                      }
              }
              if ($stmtnta->rowCount() <= 0) {
              }
            ?>
              <!--comments-->     
              </table>
        </div>
        <div class="row" style="padding-left:0em">
          <div class="col-sm-4">
            <div class="form-group">
              <input class="form-control" placeholder="Type nta here.." id="nta" name="nta">
            </div>
          </div>
           <div class="col-sm-4">
            <div class="form-group">
              <input class="form-control" placeholder="Type amount here.." id="amt" name="amt" >
            </div>
          </div>
           <div class="col-sm-3">
            <div class="form-group">
              <input class="form-control" placeholder="Type date here.." style="" id="dte" name="dte">
            </div>
          </div>
          <div class="col-sm-1" style="margin-left:0;padding-left:0em">
            <div class="form-group">
              <button class="btn btn-primary" id="postcomment">Post</button>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
        <div class="modal-dialog modal-sm">
          <div class="modal-content" style="padding:1em;padding-top:0.5em">
                  <h3 style="color:#00ADDe;margin-bottom:6px">Shareable Link</h3>
                      <div class="form-group" style="margin-bottom:1em;margin-top:1em">
                      <input id="doclink" class="form-control" value="http://slp.ph/vrcabinet/docview.php?id=<?php echo $_GET['id']; ?>">
                    </div><!-- /input-group -->
                  <button type="button" class="btn btn-primary pull-right" style="border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Close</button>
                  <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <!-- Modal -->
<script>
function delnta(row){
  var r = confirm("You are about to permanently delete this information. Are you sure?");
 if (r == true) {
    var formData = {
      'action'        : "deletenta",
      'nid'       : row
     
    };
                $.ajax({
                   url: "func.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "deleted") {
                        alert("Success!");
                        location.href = "allotments_view.php?id=<?php echo $_GET['id']; ?>";
                      } else {
                        alert(data);
                      }
                   }
                });
                //endAjax
  }
 //endpost
}
function editnta(row1) {
        var formData = { 'editid' : row1 };
        $.ajax({
          type: "POST",
          url: "allotments_ntaEdit.php",
          data: formData,
          success: function(data) {
                  if (data == "visitpage") {
                    location.href="allotments_ntaEdit.php";
                  }
                }
          });
}
$("#editfile").click(function(event) {
        var formData = { 'editid1' : '<?php echo $rowdv['allotid']; ?>' };
        $.ajax({
          type: "POST",
          url: "allotments_edit.php",
          data: formData,
          success: function(data) {
                  if (data == "visitpage") {
                    location.href="allotments_edit.php"
                  }
                }
         });
});
$("#back").click(function(event) {
  location.href = "allotments.php"; 
});
$("#postcomment").click(function(event) {
  $("#postcomment").html("...");
  document.getElementById("postcomment").disabled = true;
    var formData = {
      'action'    : "comment",
      'ntaid'     : "<?php echo $_GET['id']; ?>",
      'saa'       : "<?php echo $rowdv['saa'] ?>",
      'nta'       : $('input[name=nta]').val(),
      'amt'       : $('input[name=amt]').val(),
      'dte'       : $('input[name=dte]').val()
    };
                $.ajax({
                   url: "func.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "commented") {
                        //$("#commentable").append("<tr><td>"+$('input[name=commentbox]').val()+" <span style='color:#999;font-size:13px'>- <?php echo $_SESSION['firstname']; ?> (now)</span></td></tr>");
                        location.reload();
                      } else {
                        alert(data);
                      }
                        $("#postcomment").html("Post");
                        document.getElementById("postcomment").disabled = false;
                   }
                });
                //endAjax
}); //endpost
</script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="../js/pikaday.min.js"></script>
<script>
      var picker = new Pikaday({ 
      field: $('#dte')[0], 
      format: 'M/D/YYYY'
    });
</script>
</body>
</html>
