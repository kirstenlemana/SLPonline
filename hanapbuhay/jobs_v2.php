<?php
require "../zxcd9.php";
byteMe($_SESSION['id'],'hb_jobs',0.10);
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
                remarks 
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
    return m;
}
function parseStatus(str) {
  if (str == "0") {
    status = "<span class='label label-primary'>Open</span>";
  } else if (str == "1") {
    status = "<span class='label label-primary'>Proposed</span>";
  } else if (str == "2") {
    status = "<span class='label label-warning'>In Progress</span>";
  } else if (str == "3") {
    status = "<span class='label label-info'>Completed</span>";
  }
  return status;
}
  $.fn.DataTable.ext.pager.numbers_length = 5;
  oTable = $('#viewdata').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "orderCellsTop": true,
    "ajax": "dt_jobs.php",
    "language": {
        "search": "_INPUT_",
        "searchPlaceholder": "Search Partners..."
    },
    "dom": '<"top">rtp<"bottom"f>',
    "fnRowCallback":
      function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        $(nRow).attr('id', aData[0]);
        $(nRow).attr('sector', aData[1]);
        return nRow;
      },
    "aoColumnDefs": [
            { 
               "aTargets":[1],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('width', 180);
                }
            },
            { 
               "aTargets":[2],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('width', 270);
                    $(nTd).css('font-size', '13px');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+parselimit(data[2])+'</td>';
                }
            },
            {
               "aTargets":[3],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                    $(nTd).css('width', 95);
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+data[6]+'/'+data[3]+'</td>';
                }
            },
            {
               "aTargets":[4],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                    $(nTd).css('font-size', '13px');
                    $(nTd).css('width', 90);
                }
            },
            {
               "aTargets":[5],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                    $(nTd).css('width', 90);
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+parseStatus(data[5])+'</td>';
                }
            },
            { "bVisible": false, "aTargets":[0,6] }
                    ]
  });
  $('#viewdata').on( 'click', 'tbody tr', function () {
          var redirection = $(this).attr('id');
          var redirection2 = $(this).attr('sector');
          var formData = { 'sector' : redirection2 };
                  $.ajax({
                    type: "POST",
                    url: "jobdetails.php",
                    data: formData,
                    success: function(data) {
                            if (data == "visitpage") {
                              location.href="jobdetails.php?id="+redirection;
                            }
                          }

                    });
  });

});
</script>
<div class="container-fluid">
  
    <div class="row">
        <div id="maincontent" class="col-md-5" style="border:0px solid #000">
          <div style="height:100%;background-color:#fff;margin-top:0;padding:2em;padding-top:0.8em">
            <h1 style="font-size:5em;font-weight:700;margin-bottom:5px;margin-top:0">JOBS</h1>
            Currently viewing data for: <b><?php echo $_SESSION['filter']; ?></b><br><br>
            <a href="jobs_add.php"><button class="btn btn-info" style="padding:6px">Add Job</button></a>
          </div>
          <div style="width:100%;margin:0">
              <div id="container" style="margin: 0 auto;"></div>
          </div>
        </div>
        <div id="tableHolder" class="col-md-7" style="border:0px solid #000;margin-bottom:2em">
          <div style="background-color:#fff;height:90%;padding:2em;padding-bottom:4em">
          <?php 
              echo '<div class="pull-left col-md-4" style="margin-left:-1em"><select id="provincefilter" onchange="filterProvince()" class="form-control" style="height:31px"><option value="" selected>Filter by Province</option>';
              $query = "SELECT * FROM lib_regions WHERE regname = :region"; 
                  $_SESSION['filter'] = "REGION VII";
                  $query_params = array(':region' => $_SESSION['filter']);
                  try 
                  { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
                  catch(PDOException $ex) 
                  { die("Failed to run query: " . $ex->getMessage()); } 
                  $rowzzz = $stmt->fetch();
                  $regcode = $rowzzz['regid'];

                  $query = "SELECT * FROM lib_provinces WHERE regid = :region"; 
                  $query_params = array(':region' => $regcode);
                  try 
                  { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
                  catch(PDOException $ex) 
                  { die("Failed to run query: " . $ex->getMessage()); } 
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                     if ($_SESSION['filter']=="NPMO") {
                      echo "<option value=''>NPMO</option>";
                      break;
                     } else {
                        echo "<option>".$row['provname']."</option>";
                     }
                  }
              echo '</select></div>';
            ?>
            <script>
function filterProvince() {
      var regionvalue = document.getElementById("provincefilter").value;
      console.log(regionvalue);
      if (regionvalue == "") {
        oTable.fnFilter("", 4, false);
      } else {
        oTable.fnFilter("^"+regionvalue+"$", 4, true);
      }
}
            </script>
<div class="col-md-4 pull-right" style="margin-left:0;padding-left:0;margin-bottom:1em;margin-right:0;padding-right:0;margin-top:0">
  <input id="searchbox" type="text" class="form-control pull-right" placeholder="Search all columns.." style="height:31px"/>
</div>
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata">
                    <thead>
                      <tr>
                      <th>id</th>
                      <th>Job Name</th>
                      <th>Sector</th>
                      <th>Openings</th>
                      <th>Province</th>
                      <th>Status</th>
                      <th></th>
                      </tr>
                    </thead>
                  </table>
                  <div class="pull-left">
                    <a href="export.php?type=jobs"><button class="btn btn-primary" style="font-size:12px;padding:5px">Export to Excel</button></a>
                  </div>
          </div>
        </div>
    </div><!--endrow-->
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

$("#sendfeedback").click(function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
    
    $("#loadicon").show();
    $("#feedback").hide();
    $("#sendfeedback").html('Processing..');
    document.getElementById("sendfeedback").classList.add("disabled");
    document.getElementById("sendfeedback").disabled = true;
    var formData = {
      'page'        : "partner_jobs",
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
$(document).ready(function() {

$("#formsubmit").click(function() {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#statusdisp").html('');
  $('#supplyForm').bootstrapValidator('validate');
  return false;
}); //endHRSUBMIT


});
</script>
<?php
if ($_SESSION['filter'] == "NPMO") {
$sql = "SELECT COUNT(id) as total, SUM(numopenings) as opens FROM PRTdemand ";
} else {
$sql = "SELECT COUNT(id) as total, SUM(numopenings) as opens FROM PRTdemand WHERE region = '".$_SESSION["filter"]."'";
}
try { 
  $stmt = $db->prepare($sql); $result = $stmt->execute(); 
} catch(PDOException $ex) {
  die("Failed to run query: " . $ex->getMessage());
} 
$row = $stmt->fetch();
$totalpartners = $row["total"];
$totalopens = $row["opens"];
if ($_SESSION['filter'] == "NPMO") {
  $sql = "SELECT z.sector, SUM(DISTINCT m.numopenings) as totalcount FROM PRTdemand m LEFT JOIN PRTdemandtags z ON m.id=z.demandid GROUP BY z.sector ORDER BY totalcount DESC";
} else {
  $sql = "SELECT z.sector, SUM(DISTINCT m.numopenings) as totalcount FROM PRTdemand m LEFT JOIN PRTdemandtags z ON m.id=z.demandid WHERE m.region = '".$_SESSION["filter"]."' GROUP BY z.sector ORDER BY totalcount DESC";
}
$sectorArray = [];
$countArray = array();
foreach ($db->query($sql) as $results)
{
             $sectorArray[] = $results["sector"];
             $countArray[] = intval($results["totalcount"]);
}
?>
<script>
$("#searchbox").keyup(function() {
   oTable.fnFilter(this.value);
});  
var sectorArray = <?php echo json_encode($sectorArray);?>;
var countArray = <?php echo json_encode($countArray);?>;
var totalcount = <?php echo $totalpartners; ?>;
if (totalcount == '') {
  totalcount = '0';
}
var totalopen = <?php echo $totalopens; ?>;
if (totalopen == '') {
  totalopen = '0';
}
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$(function () {
    var chart = $('#container').highcharts({
        chart: {
            type: 'bar',
            height: 320,
            marginTop: 0,
            marginLeft: 35
        },
        title: {
            text: numberWithCommas(totalopen),
            x: -30,
            y: 260,
            align: 'right',
            style: {
                        fontFamily: 'Lato', 
                        fontSize: '40px',
                        fontWeight: 'bold',
                    }
        },
        subtitle: {
            text: 'openings from '+totalcount+' Jobs',
                align: 'right',
                x: -30,
                y: 285,
                style: {
                        fontFamily: 'Lato', 
                        fontSize: '21px',
                    }
        },
        xAxis: {
            categories: sectorArray,
            gridLineWidth: 0,
            minorGridLineWidth: 0,
            minorTickWidth: 0,
            tickWidth: 0,
            lineWidth: 0,
            title: {
                text: null
            },
            labels:
            {
            enabled: false
            }
        },
        yAxis: {
            
            gridLineWidth: 0,
            minorGridLineWidth: 0,
            minorTickWidth: 0,
            tickWidth: 0,
            lineWidth: 0,
            min: 0,
            title: {
            enabled: false
            },
            labels: {
                enabled: false,
                overflow: 'justify'
            }
        },
        tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = '<span style="font-size:10px">'+this.key+'</span>';
                    return s;
                },
                hideDelay: 0
            },
        plotOptions: {
            bar: {
                grouping: false,
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            enabled: false,
        },
        credits: {
            enabled: false
        },
        series: [{
          data: countArray,
          color: '#f79c82'
        }]
    });
});

</script>
</body>
</html>
