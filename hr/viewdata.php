<?php
require "../zxcd9.php";
byteMe($_SESSION['id'],'hr_view',0.10);
  $query = "SELECT region FROM hr_db WHERE emailaddress = :emailaddress";
  $query_params = array(':emailaddress' => $_SESSION['emailaddress']);
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params);
        } 
        catch(PDOException $ex)  { 
            echo "failed";
            die;
        }
        $row = $stmt->fetch();
        $filter = $row['region'];
        if ($filter == "NPMO") {
          $filter = "NPMO";
        }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP | HR</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/flatbootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../css/DTbootstrap.css">
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
    <script src="../js/DTbootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
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
  -webkit-appearance:none;-moz-appearance:none;-ms-appearance:none;appearance:none;background:#fff url(arrows.png) no-repeat right 9px;
}
tbody tr {
  cursor: pointer;
}
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: #2c3e50;
  color: #fff;
}
.disabled {
  background:rgba(1,1,1,0.2);
  border:0px solid;
  cursor:progress;
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
#slideout {
      z-index: 998;
      position: fixed;
      top: 25%;
      left: 0;
      width: 35px;
      padding: 12px 0;
      text-align: center;
      background: #6DAD53;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
      -webkit-border-radius: 0 5px 5px 0;
      -moz-border-radius: 0 5px 5px 0;
      border-radius: 0 5px 5px 0;
    }
    #slideout_inner {
      z-index: 999;
      position: fixed;
      top: 25%;
      left: -250px;
      background: #6DAD53;
      width: 250px;
      padding: 0;
      height: 165px;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
      text-align: left;
      -webkit-border-radius: 0 0 5px 0;
      -moz-border-radius: 0 0 5px 0;
      border-radius: 0 0 5px 0;
    }
    #slideout_inner textarea {
      z-index: 999;
      width: 190px;
      height: 100px;
      margin-bottom: 6px;
    }
    #slideout:hover {
      z-index: 999;
      left: 250px;
    }
    #slideout:hover #slideout_inner {
      z-index: 999;
      left: 0;
    }
</style>
</head>
<body onbeforeunload="reset_filt()">
<script>
function reset_filt() {
    $('#regionfilter').get(0).selectedIndex = 0;
}
</script>
    <div id="slideout">
    <img src="http://img.usabilitypost.com.s3.amazonaws.com/1104/css_slideout/feedback.png" alt="Feedback" />
    <div id="slideout_inner">
      <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="color:#fff;font-size:50px;padding:10px;"></span>
      <div id="formz">
      <form>
          <div class="form-group">
            <div class="col-sm-12">
                <textarea name="feedback" class="form-control" id="feedback" placeholder="Any comments or suggestions are welcome!" style="resize:none;padding-top:8px;padding-bottom:8px;" rows="3"></textarea>
            </div>
          </div>
      </form>
          <div class="form-group">
              <button class="btn btn-primary" id="sendfeedback" style="padding:4px;margin-left:1em">Submit</button>
          </div>
      </div>
    </div>
  </div>
<?php require "../nav.php"; ?>
<script>
function replaceStatus(status) {
  if (status == '1') {
    status = "Yes";
  } else {
    status = "No";
  }
  return status;
}
</script>
<script type="text/javascript" language="javascript" class="init">
  function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
var oTable = "";
$(document).ready(function() {
    $.fn.DataTable.ext.pager.numbers_length = 5;
  oTable = $('#viewdata').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "orderCellsTop": true,
    "order": [[11, "desc" ]],
    "ajax": "dt_hrviewdata2.php",
    "dom": '<"top">rt<"bottom"ipl><"clear">',
    "buttons": [
        'excel'
    ],
    "fnRowCallback":
      function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        $(nRow).attr('id', aData[0]);
        return nRow;
      },
    "aoColumnDefs": [
            { 
               "aTargets":[1],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).css('text-align', 'left');
                    $(nTd).css('width', '18%');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+toTitleCase(data[2])+', '+toTitleCase(data[1])+'</td>';
                }
            },
            { 
               "aTargets":[2],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).css('text-align', 'left');
                    $(nTd).css('width', '15%');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+toTitleCase(data[2])+'</td>';
                }
            },
            { 
               "aTargets":[3],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).css('width', '20%');
                }
            },
            { 
               "aTargets":[6],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).css('text-align', 'center');
                }
            },
            { 
               "aTargets":[10],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).css('text-align', 'center');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+replaceStatus(data[8])+'</td>';
                }
            },
            { 
               "aTargets":[8],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).css('text-align', 'center');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+replaceStatus(data[8])+'</td>';
                }
            },
            { 
               "aTargets":[9],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                    $(nTd).css('text-align', 'left');
                    $(nTd).css('font-size', '11px');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    if (data[9]!=null) {
                      return '<td>'+data[9]+'</td>';  
                    } else {
                      return '<td>-</td>';
                    }
                    }
            },
            { "bVisible": false, "aTargets":[<?php if ($_SESSION['filter']=='NPMO') { echo "0,2,7,8,11"; } else { echo "0,2,6,9,10,11"; } ?>] }
                    ]
  });
      //oTable.fnFilter('<?php echo $filter;?>',6);
        $('#viewdata').on( 'click', 'tbody tr', function () {
          var redirection = $(this).attr('id');
          window.location.href = "user.php?id="+redirection;
        });
});
function filterRegion() {
    var regionvalue = document.getElementById("regionfilter").value;
    //oTable.fnFilter(regionvalue,6);
    oTable.fnFilter("^"+regionvalue+"$", 6, true, false, true);
}
</script>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
        <div class="col-md-3" style="">
          <div id="container" style="background-color:#fff;min-width: 200px; height: 200px; max-width: 600px; margin: 0 auto"></div>
        </div>
        <div class="col-md-9" style="padding-left:0">
          <div id="container2" style="background-color:#fff;min-width: 100%; height: 200px; max-width: 600px; margin: 0 auto"></div>
        </div>
    </div>
  </div><br>
    <div class="row">  
      <div class="col-md-12" style="">
        <div class="col-md-12" style="margin-right:0;margin-bottom:0.6em;padding-right:0">
            <div class="pull-left"><a href="export.php" class="pull-left"><button class="btn btn-primary" style="font-size:12px;padding:5px">Export to Excel</button></a></div>
            <div class="pull-right col-md-3" style="text-align:right"><input id="searchbox" type="text" class="form-control" placeholder="Search directory (all columns)" style="height:31px"/></div>
            <?php if ($_SESSION['filter']=="NPMO") {
              echo '<div class="pull-right col-md-2" style="padding-right:0"><select id="regionfilter" onchange="filterRegion()" class="form-control" style="height:31px"><option value="" selected>Filter by Region</option>';
              $query = "SELECT regname FROM lib_regions ORDER BY regname"; 
                  try 
                  { $stmt = $db->prepare($query); $result = $stmt->execute(); } 
                  catch(PDOException $ex) 
                  { die("Failed to run query: " . $ex->getMessage()); } 
                  while ($row5 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                     echo "<option>".$row5['regname']."</option>";
                  }
              echo '</select></div>';
            }
            ?>
        </div>
        <div class="col-md-12">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata" style="background-color:#fff;">
        <thead>
          <tr>
          <th>id</th>
          <th>Name (Last, First)</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Mobile Num.</th>
          <th>Designation</th>
          <th>Region</th>
          <th>Province</th>
          <th>Confirmed</th>
          <th>Working Group(s) <span class="glyphicon glyphicon-question-sign" data-toggle="popover" data-original-title="Working Groups" data-content="<span class='glyphicon glyphicon-star' style='color:#ffcc09'></span> - Indicates head / focal person" rel="popover" data-placement="top" data-trigger="hover" style="margin-top:2px"></span></span></th>
          <th>Confirmed</th>
          <th></th>
          </tr>
        </thead>
        </table>
      </div>
    </div>        
  </div>
</div>
<br>
<?php
$filter = $_SESSION['filter'];
        /*if ($filter == "NPMO") {*/
$stmt = $db->prepare("SELECT count(id) as total, count(case when confirmed = '1' then 1 else null end) as confirmed FROM hr_db"); 
        /*} else {
$stmt = $db->prepare("SELECT count(id) as total, count(case when isnew = '1' then 1 else null end) as confirmed FROM HRDB WHERE region = '".$filter."'");           
        }*/
$stmt->execute();
$row = $stmt->fetch();
?>
<script>
$(function () {
    $(document).ready(function () {
      var colors = Highcharts.getOptions().colors,
        counttotal = '<?php echo $row['total']; ?>',
        countconfirmed = '<?php echo $row['confirmed']; ?>';
        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                backgroundColor: null
            },
            title: {
                   text: counttotal,
                   verticalAlign: 'middle',
                   y: -12,
                   style: {
                        fontFamily: 'Lato', 
                        fontSize: '30px',
                        fontWeight: 'bold',
                    }
            },
            subtitle: {
                text: 'Total',
                verticalAlign: 'middle',
                y: 3,
                style: {
                        fontFamily: 'Lato', 
                        fontSize: '14px',
                    }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = point.name+': <b>'+point.y.toFixed(0)+'</b>';
                    return s;
                },
                hideDelay: 0
            },
            plotOptions: {
                pie: {
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
                name: 'Users',
                colorByPoint: true,
                innerSize: '75%',
                data: [{
                    name: 'Pending',
                    y: parseInt(counttotal-countconfirmed),
                    color: '#d8d8d8'
                    
                }, {
                    name: 'Confirmed',
                    y: parseInt(countconfirmed),
                    color: '#2c3e50'
                }]
            }]
        });
    });
});
<?php
$regionz = array("NPMO", "NCR", "CAR", "REGION I", "REGION II", "REGION III", "REGION IV-A", "REGION IV-B", "REGION V", "REGION VI", "REGION VII", "REGION VIII", "REGION IX", "REGION X", "REGION XI", "REGION XII", "CARAGA", "ARMM", "NIR");
$regtot = [];
foreach ($regionz as $regvalue) {
      $stmt = $db->prepare("SELECT COUNT(region) as regioncount FROM hr_db WHERE region = '".$regvalue."'");           
      $stmt->execute();
      $row = $stmt->fetch();
      $regtot[] = intval($row['regioncount']);
}
$regconf = [];
foreach ($regionz as $regvalue) {
      $stmt = $db->prepare("SELECT COUNT(region) as regioncount FROM hr_db WHERE region = '".$regvalue."' AND confirmed = '1'");           
      $stmt->execute();
      $row = $stmt->fetch();
      $regconf[] = intval($row['regioncount']);
}
?>
$(function () {
    $('#container2').highcharts({
        chart: {
            type: 'column',
            backgroundColor: null
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        credits: {
          enabled: false
        },
        legend: {
          enabled: false
        },
        tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = 'Total: <b>'+point.total+'</b><br>'+point.series.name+': <b>'+point.y.toFixed(0)+'</b>';
                    return s;
                },
                hideDelay: 0
            },
        xAxis: {
            categories: [
                'NPMO',
                'NCR',
                'CAR',
                'I',
                'II',
                'III',
                'IV-A',
                'IV-B',
                'V',
                'VI',
                'VII',
                'VIII',
                'IX',
                'X',
                'XI',
                'XII',
                'CARAGA',
                'ARMM',
                'NIR'
            ],
            crosshair: true,
            minorGridLineWidth: 0,
            minorTickWidth: 0,
            tickWidth: 0,
            labels: {
              enabled: true,
                style: {
                    fontSize:'8px'
                }
            }
        },
        yAxis: {
            min: 0,
            gridLineWidth: 0,
            title: '',
            labels: {
              enabled: false
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0,
                borderWidth: 0
            },
            series: {
                stacking: 'normal'
            }
        },
        series: [{
            name: 'Unconfirmed',
            color: '#d8d8d8',
            data: [<?php echo $regtot[0]-$regconf[0].",".($regtot[1]-$regconf[1]).",".($regtot[2]-$regconf[2]).",".($regtot[3]-$regconf[3]).",".($regtot[4]-$regconf[4]).",".($regtot[5]-$regconf[5]).",".($regtot[6]-$regconf[6]).",".($regtot[7]-$regconf[7]).",".($regtot[8]-$regconf[8]).",".($regtot[9]-$regconf[9]).",".($regtot[10]-$regconf[10]).",".($regtot[11]-$regconf[11]).",".($regtot[12]-$regconf[12]).",".($regtot[13]-$regconf[13]).",".($regtot[14]-$regconf[14]).",".($regtot[15]-$regconf[15]).",".($regtot[16]-$regconf[16]).",".($regtot[17]-$regconf[17]).",".($regtot[18]-$regconf[18]); ?>]
        },{
            name: 'Confirmed',
            color: '#2c3e50',
            data: [<?php echo $regconf[0].",".$regconf[1].",".$regconf[2].",".$regconf[3].",".$regconf[4].",".$regconf[5].",".$regconf[6].",".$regconf[7].",".$regconf[8].",".$regconf[9].",".$regconf[10].",".$regconf[11].",".$regconf[12].",".$regconf[13].",".$regconf[14].",".$regconf[15].",".$regconf[16].",".$regconf[17].",".$regconf[18]; ?>]
        }]
    });
});
</script>
<script>
$(document).ready(function() {
$("#searchbox").keyup(function() {
   oTable.fnFilter(this.value);
});  
$('[data-toggle="popover"]').popover({
    'trigger': 'hover',
    'placement': 'left',
    'html': 'true'
  });
$("#loadicon").hide();
$("#sendfeedback").click(function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
$("#loadicon").show();
$("#feedback").hide();
$("#sendfeedback").html('Processing..');
    document.getElementById("sendfeedback").classList.add("disabled");
    document.getElementById("sendfeedback").disabled = true;
    var formData = {
      'page'        : "viewdata_user",
      'feedback'    : $('textarea[name=feedback]').val(),
      'feedbacker'    : "<?php echo $_SESSION['id']; ?>"
    };
                $.ajax({
                   url: "../sendfeedback.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
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
  }); //endHRSUBMIT
}); //enddocready
</script>
</body>
</html>
