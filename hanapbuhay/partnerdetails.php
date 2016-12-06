<?php
require "../zxcd9.php";

if(!empty($_GET['id'])) {
  $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
  $_SESSION["partnerid"] = $_GET['id'];
}

        $query = "SELECT m.orgname, m.address, m.psic, m.region, m.createdby, m.contactperson, m.contactemail, m.contactnumber, m.npmo, t.firstname, t.region FROM PRTemployers m LEFT JOIN hr_db t ON m.createdby=t.id WHERE m.id = :id"; 
        $query_params = array(':id' => $_SESSION['partnerid']);
        try 
        { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) 
        { die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch();
        $partnername = $row['orgname'];

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
</style>
</style>
</head>
<body>
<?php
  include "../nav.php";
?>
<script type="text/javascript" language="javascript" class="init">
var oTable = "";
$(document).ready(function() {
function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
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
  oTable = $('#viewdata').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "orderCellsTop": true,
    "ajax": "dt_partnerdetails.php",
    "dom": '<"top">rt<"bottom"lp><"clear">',
    "fnRowCallback":
      function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        $(nRow).attr('id', aData[0]);
        return nRow;
      },
    "aoColumnDefs": [
            { 
               "aTargets":[3],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                }
            },
            { 
               "aTargets":[5],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+parseStatus(data[5])+'</td>';
                }
            },
            { "bVisible": false, "aTargets":[0] }
                    ]
  });
$('#viewdata').on( 'click', 'tbody tr', function () {
          var redirection = $(this).attr('id');
          window.location.href = "jobdetails.php?id="+redirection;
        });
});

</script>
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12" style="">
      <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
        <h2 style="margin-top:0;margin-bottom:0;font-weight:bold"><?php echo $partnername; ?></h2>
        <?php echo $row['address']; ?>
        <br><?php echo $row['psic']; ?><br>
        <?php
          $stmt2 = $db->prepare("SELECT region FROM PRTemployersloc WHERE refid = :id");
          $stmt2->bindParam(':id', $_GET['id']);
          $stmt2->execute();
          $rowdv = $stmt2->fetch();
          $i=0;
          while ($rowdv = $stmt2->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
              if ($rowdv[0] != "") {
                    if ($i==0) {
                      echo "Preferred Locations: ".$rowdv[0].", ";
                    } else {
                      echo $rowdv[0].", ";
                    }
                    $i++;
              }
          }
        ?>
        
        
        <br><br>
        Contact Person: <?php echo $row['contactperson']; ?><br>
        Contact Email Address: <?php echo $row['contactemail']; ?><br>
        Contact Number: <?php echo $row['contactnumber']; ?>
        <br><br>
        <?php if ($row['firstname']!="") { echo "Encoded by: ".$row['firstname']." (".$row['region'].")<br>"; } ?>
        <?php if($row['npmo']=='1') { echo "<button class='btn btn-primary' style='padding:5px' id='activateregion'>Activate and send to region</button>"; }; ?>

        <?php if($_SESSION['permlvl']>0 || $row['createdby']==$_SESSION['id']) { echo ' <a href="partners_edit.php?id='.$_GET['id'].'"><button id="editpartner" class="btn btn-success" style="padding:4px 8px 4px 8px">Edit Partner</button></a> <button id="deljob" class="btn btn-danger" style="padding:4px 8px 4px 8px">Delete Partner</button>'; } ?>

        
        <br><br>
            <div class="col-md-12" id="tableHolder" style="margin-bottom:2em">
              <div class="row">
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata" style="background-color:#fff;">
                    <thead>
                      <td style="background-color:#000;color:#fff" colspan="7">Jobs posted</td>
                      <tr>
                      <th>id</th>
                      <th>Industry</th>
                      <th>Job Name</th>
                      <th><center>Openings</th>
                      <th>Province</th>
                      <th>Status</th>
                      </tr>
                    </thead>
                  </table>
              </div>
            </div>
            <center>
            <a href="partners.php"><button class="btn btn-info">Go Back</button></a><br><br>
        </div>
      </div>
    </div>
    <div class="col-md-2"></div>
</div>
<script>
$(document).ready(function() {
$("#deljob").click(function(event) {
    var r = confirm("You are about to delete a partner. This will be recorded. Are you sure?");
    if (r == true) {
      var formData = {
      'jobid'        : "<?php echo $_GET['id']; ?>"
      };
                $.ajax({
                   url: "delpartner.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "good") {
                        alert("Success!")
                        location.href = "partners.php";
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
    }
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
    
      $.getJSON("../json/regiondata.json", function(data) {
        
        var vals = [];
        var $secondChoice = $("#province");
        switch(key) {
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
        
        processMyJson(vals);
        
      });//getjson


function processMyJson(json){
      valregion2 = json;
      var arrayLength = valregion2.length;
      for (var i = 0; i < arrayLength; i++) {
        
<?php
$stmt = $db->prepare("SELECT DISTINCT province FROM PRTsupply WHERE region = '".$_SESSION['filter']."'");
$stmt->execute();
$result = array();
while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
      $result[] = $row[0];
}
$chartdata = array();
$result2 = array_filter($result);
for ($i = 0; $i < count($result2); ++$i) {
    $stmt = $db->prepare("SELECT COUNT(province) as provincecount FROM PRTsupply WHERE province = '".$result2[$i]."'");
    $stmt->execute();
    $row = $stmt->fetch();
    $chartdata[] = intval($row['provincecount']);
}
?>

      };
      var regionchartdata = <?php echo json_encode($chartdata);?>;

$(function () {
    
    regionchart = $('#container2').highcharts({
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
                        s = this.key +': <b>'+point.y.toFixed(0)+'</b>';
                    return s;
                },
                hideDelay: 0
            },
        xAxis: {
            categories: <?php echo json_encode($result2); ?>,
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
            }
        },
        series: [{
            name: 'Encoded',
            color: '#2c3e50',
            data: regionchartdata
        }]
    });
});
};


$("#formsubmit").click(function() {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#statusdisp").html('');
  $('#supplyForm').bootstrapValidator('validate');
  return false;
}); //endHRSUBMIT

$("#activateregion").click(function() {
  event.preventDefault();
  event.stopImmediatePropagation();
  var formData = { 'partnerid' : '<?php echo $_GET["id"]; ?>' };
  $.ajax({
  type: "POST",
  url: "activateRegion.php",
  data: formData,
  success: function(data) {
            alert("Success!");
            location.reload();
        }

  });
  return false;
}); //end activate


<?php
$filter = $_SESSION['filter'];
        /*if ($filter == "NPMO") {*/
$stmt = $db->prepare("SELECT count(id) as total, count(case when sex = '1' then 1 else null end) as confirmed FROM PRTsupply WHERE region = '".$filter."'"); 
        /*} else {
$stmt = $db->prepare("SELECT count(id) as total, count(case when isnew = '1' then 1 else null end) as confirmed FROM hr_db WHERE region = '".$filter."'");           
        }*/
$stmt->execute();
$row = $stmt->fetch();
?>
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
                        fontSize: '28px',
                        fontWeight: 'bold',
                    }
            },
            subtitle: {
                text: 'Total',
                verticalAlign: 'middle',
                y: 3,
                style: {
                        fontFamily: 'Lato', 
                        fontSize: '13px',
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
                    name: 'Participants',
                    y: parseInt(counttotal-countconfirmed),
                    color: '#2c3e50'
                    
                }, {
                    name: 'Employed',
                    y: parseInt(countconfirmed),
                    color: colors[1]
                }]
            }]
        });
    });
});


});
</script>
</body>
</html>
