<?php
require "../zxcd9.php";
byteMe($_SESSION['id'],'hb_partners',0.10);
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
            ':id' => $_SESSION['id']);
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
    -webkit-appearance:none;
    -moz-appearance:none;
    -ms-appearance:none;
    appearance:none;background:#fff url(../imgs/arrows.png) no-repeat right 9px;
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
    if (m.length > 40) {
      m = m.substring(0,40);
      m = m+"..";
    }
    return m;
}
function parseOpenings(str) {
  if (parseInt(str) >= 0) {
    return '<td>'+str+'</td>';
  } else {
    return '<td><span class="label label-primary">Untapped</span></td>';
  }
                      
}
  $.fn.DataTable.ext.pager.numbers_length = 5;
  oTable = $('#viewdata').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "orderCellsTop": true,
    "ajax": "dt_partners.php",
    "dom": '<"top">rtp<"bottom"f>',
    "aaSorting": [3,'desc'],
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
                    $(nTd).css('width', 230);
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+toTitleCase(data[1])+'</td>';
                }
            },
            { 
               "aTargets":[2],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('width', 210);
                    $(nTd).css('font-size', '13px');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+data[2]+'</td>';
                }
            },
            { 
               "aTargets":[4],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('width', 80);
                    $(nTd).css('font-size', '13px');
                    $(nTd).css('text-align', 'center');
                },
            },
            {
               "aTargets":[6],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                    $(nTd).css('width', 60);
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+parseOpenings(data[3])+'</td>';
                }
            },
            { "bVisible": false, "aTargets":[0,3,5] }
                    ]
  });
$('#viewdata').on( 'click', 'tbody tr', function () {
          var redirection = $(this).attr('id');
          window.location.href = "partnerdetails.php?id="+redirection;
        });

});//end doc ready
</script>
<div class="container-fluid">
  
    <div class="row">
        <div id="maincontent" class="col-md-5" style="border:0px solid #000">
          <div style="height:100%;background-color:#fff;margin-top:0;padding:2em;padding-top:0.8em">
            <h1 style="font-size:5em;font-weight:700;margin-bottom:5px;margin-top:0">PARTNERS</h1>
            Currently viewing data for: <b><?php echo $_SESSION['filter']; ?></b><br><br>
            <a href="partners_add.php"><button class="btn btn-info" style="padding:6px">Add Partner</button></a>
          </div>
          <div style="width:100%;margin:0">
              <div id="container" style="margin: 0 auto;"></div>
          </div>
          <div class="row" style="background:#fff;margin-left:3px;margin-right:3px">
            <div class="pull-right" style="margin-right:2em;display:none">
              <button class="btn btn-info" style="padding:5px;font-size:12px;margin-bottom:1.5em" id="viewmore">View More</button>
            </div>
          </div>
        </div>
        <div id="viewmorecontent">
            
        </div>
        <div id="tableHolder" class="col-md-7" style="border:0px solid #000;margin-bottom:2em">
          <div style="background-color:#fff;height:100%;padding:2em">
            <div class="row">              
            <?php 
              echo '<div class="pull-left col-md-4"><select id="regionfilter" onchange="filterRegion()" class="form-control" style="height:31px"><option value="" selected>Filter by Region</option>';
              $query = "SELECT regname FROM lib_regions ORDER BY regname"; 
                  try 
                  { $stmt = $db->prepare($query); $result = $stmt->execute(); } 
                  catch(PDOException $ex) 
                  { die("Failed to run query: " . $ex->getMessage()); } 
                  while ($row5 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                     if ($row5['regname'] != "NPMO") {
                        echo "<option>".$row5['regname']."</option>";
                     } else {
                        echo "<option value='NPMO'>NPMO (Inactive)</option>";
                     }
                  }
              echo '</select></div>';
            ?>
            <script>
            function filterRegion() {
                var regionvalue = document.getElementById("regionfilter").value;
                
                if (regionvalue == 'NPMO') {
                  oTable.fnFilter("1", 5, true);
                } else if (regionvalue == "") {
                  oTable.fnFilter("", 5, false);
                  oTable.fnFilter("", 4, false);
                  oTable.fnFilter("");
                } else {
                  oTable.fnFilter("^"+regionvalue+"$", 4, true);
                }
            }
            </script>
                <div class="col-md-4 pull-right" style="margin-left:0;padding-left:0;margin-bottom:1em">
                  <input id="searchbox" type="text" class="form-control pull-right" placeholder="Search all columns.." style="height:31px"/>
                </div>
            </div>
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata">
                    <thead>
                      <tr>
                      <th>id</th>
                      <th>Organization</th>
                      <th>Sector</th>
                      <th>Openings</th>
                      <th>Region</th>
                      <th>Openings</th>
                      <th>Openings</th>
                      </tr>
                    </thead>
                  </table>
                  
                  <div class="pull-left">
                    <a href="export.php?type=partners"><button class="btn btn-primary" style="font-size:12px;padding:5px">Export to Excel</button></a>
                  </div>

                  <br>
              
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

$("#sendfeedback").click(function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
    
    $("#loadicon").show();
    $("#feedback").hide();
    $("#sendfeedback").html('Processing..');
    document.getElementById("sendfeedback").classList.add("disabled");
    document.getElementById("sendfeedback").disabled = true;
    var formData = {
      'page'        : "partner_partners",
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
<?php
if ($_SESSION['filter'] == "NPMO") {
$sql = "SELECT COUNT(DISTINCT m.id) as total, COUNT(n.id) as jobs FROM PRTemployers m LEFT JOIN PRTdemand n ON m.id=n.partner";
} else {
$sql = "SELECT COUNT(DISTINCT m.id) as total, COUNT(n.id) as jobs FROM PRTemployers m LEFT JOIN PRTdemand n ON m.id=n.partner WHERE n.region = '".$_SESSION["filter"]."' AND npmo='0'";
}

try { 
  $stmt = $db->prepare($sql); $result = $stmt->execute(); 
} catch(PDOException $ex) {
  die("Failed to run query: " . $ex->getMessage());
} 
$row = $stmt->fetch();
$totalpartners = $row["total"];
$totaljobs = $row["jobs"];

if ($_SESSION['filter'] == "NPMO") {
  $sql = "SELECT m.psic, COUNT(n.id) as totalcount FROM PRTemployers m LEFT JOIN PRTdemand n ON m.id=n.partner GROUP BY psic ORDER BY totalcount DESC";
} else {
  $sql = "SELECT m.psic, COUNT(n.id) as totalcount FROM PRTemployers m LEFT JOIN PRTdemand n ON m.id=n.partner WHERE n.region='".$_SESSION['filter']."' AND npmo='0' GROUP BY psic ORDER BY totalcount DESC";
}

$sectorArray = [];
$countArray = array();
foreach ($db->query($sql) as $results)
{
             $sectorArray[] = $results["psic"];
             $countArray[] = intval($results["totalcount"]);
}
$jobArray = array();
foreach ($sectorArray as $sector) {
        $sql = "SELECT COUNT(sector) as boom FROM PRTdemandtags WHERE sector = '".$sector."'";
        try { 
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();
        } catch(PDOException $ex) {
            die("Failed to run query: " . $ex->getMessage());
        }
        $row = $stmt->fetch();
        $jobArray[] = intval($row["boom"]);
}
?>
<script>
var sectorArray = <?php echo json_encode($sectorArray);?>;
var countArray = <?php echo json_encode($countArray);?>;
var jobArray = <?php echo json_encode($jobArray);?>;
var totalcount = <?php echo $totalpartners; ?>;
if (totalcount == '') {
  totalcount = '0';
}
var totaljobs = <?php echo $totaljobs; ?>;
if (totaljobs == '') {
  totaljobs = '0';
}
console.log(totalcount);
var colors = Highcharts.getOptions().colors;
$(function () {
    var chart = $('#container').highcharts({
        chart: {
            type: 'bar',
            height: 320,
            marginTop: 0,
            marginLeft: 35
        },
        title: {
            text: totaljobs,
            x: -30,
            y: 260,
            align: 'right',
            style: {
                        fontFamily: 'Lato', 
                        fontSize: '50px',
                        fontWeight: 'bold',
                    }
        },
        subtitle: {
            text: 'jobs from '+totalcount+' partners',
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
                        s = '<span style="font-size:10px">'+this.key+'</span><br>'+this.series.name+': '+this.point.y;
                    return s;
                },
                hideDelay: 0
            },
        plotOptions: {
            bar: {
                grouping: true,
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        if (this.y != 0) {
                          return '<span style="font-size:11px">'+this.y+'</span>';
                        } else {
                          return null;
                        }
                    }
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
          name: 'Jobs',
          data: countArray,
          color: '#18bc9c'
        }

        /*{
            name: 'Partners',
            data: countArray,
            stack: 'partners',
            color: '#18bc9c'
        }, {
            name: 'Jobs',
            data: jobArray,
            stack: 'jobs',
            color: colors[1]
        }*/
        ]
    });
});

</script>
</body>
</html>
