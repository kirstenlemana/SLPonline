<?php
require "../zxcd9.php";
 //$stmt = $db->prepare("SELECT * from fin_allotments where hrdbid=:id");
 //$stmt->bindParam(':id', $_SESSION['id']);
 //$stmt->execute();
 //$rowfa = $stmt->fetch(PDO::FETCH_ASSOC);
  //echo $rowfa['hrdbid'];
//  echo $_SESSION['id'];
 // while ($rowfa = $stmt->fetch(PDO::FETCH_ASSOC)) {
  //      echo $rowfa['hrdbid'].'<br>';
   // }
  
$regionz = array("NCR", "CAR", "REGION I", "REGION II", "REGION III", "REGION IV-A", "REGION IV-B", "REGION V", "REGION VI", "REGION VII", "REGION VIII", "REGION IX", "REGION X", "REGION XI", "REGION XII", "CARAGA", "ARMM", "NIR");

//SELECT COUNT(region)as region,re FROM `fin_allotments` WHERE type="CMF" and region="NCR"
$cmf = [];
foreach ($regionz as $regvalue) {
      $stmt = $db->prepare("SELECT COUNT(region) as regioncount FROM fin_allotments WHERE region = '".$regvalue."' and type='CMF' ");           
      $stmt->execute();
      $row = $stmt->fetch();
      $cmf[] = intval($row['regioncount']);
}
$dr = [];
foreach ($regionz as $regvalue) {
      $stmt = $db->prepare("SELECT COUNT(region) as regioncount FROM fin_allotments WHERE region = '".$regvalue."' and type='DR'");           
      $stmt->execute();
      $row = $stmt->fetch();
      $dr[] = intval($row['regioncount']);
}




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
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
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
line-height:22px;
text-align:left;
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
tr {
  text-align: center;
}
.glyphcenter {
  font-size:12px;
  padding-right:2px;
}
.dataTables_filter, .dataTables_info { display: none; }
</style>
</head>
<body>
<?php require "navfin.php"; ?>
<script>
$(function () {
  var colors = Highcharts.getOptions().colors;
  regtot = [2,3,34,5,3,2,3,2,2,2,2,2,2,22,34];
  regconf = [2,3,34,5,3,2,3,2,2,2,2,2,2,22,3];
    $('#cont1').highcharts({
        chart: {
            type: 'column',
            backgroundColor: null,
            height: 150
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
                        s = '<b>'+this.x+'</b><br>Total: <b>'+point.total+'</b><br>'+point.series.name+': <b>'+point.y.toFixed(0)+'</b>';
                    return s;
                },
                hideDelay: 0
            },
        xAxis: {
            categories: [
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
                    fontSize:'5px'
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
  //      series: [{
   //         name: 'CMF',
    //        color: colors[3],
     //       data: [23,23,55,23,15,09,18,20,50,33,38,21,12,10,40,20]
      //  },{
       //     name: 'DR',
        //    color: colors[8],
         //   data: [43,12,44,22,10,08,25,67,32,10,29,56,19,10,40,20]
        //}]

        series: [{
            name: 'CMF',
            color:  colors[3],
            data: [<?php echo $cmf[0].",".$cmf[1].",".$cmf[2].",".$cmf[3].",".$cmf[4].",".$cmf[5].",".$cmf[6].",".$cmf[7].",".$cmf[8].",".$cmf[9].",".$cmf[10].",".$cmf[11].",".$cmf[12].",".$cmf[13].",".$cmf[14].",".$cmf[15].",".$cmf[16].",".$cmf[17]; ?>]
        },{
            name: 'DR',
            color: colors[8],
            data: [<?php echo $dr[0].",".$dr[1].",".$dr[2].",".$dr[3].",".$dr[4].",".$dr[5].",".$dr[6].",".$dr[7].",".$dr[8].",".$dr[9].",".$dr[10].",".$dr[11].",".$dr[12].",".$dr[13].",".$dr[14].",".$dr[15].",".$dr[16].",".$dr[17]; ?>]
        }]




    });
});
function delcom(xx) {
      var r = confirm("This will permanently delete this record. Are you sure?");
      if (r == true) {
          var formData = { 
          'action' : 'delallo',
          'delid'  : xx
        };
        $.ajax({
        type: "POST",
        url: "func.php",
        data: formData,
        success: function(data) {
                  $("#sucsubtext").html("Record deleted");
                  $('#myModal').modal();
                  $('#myModal').on('hidden.bs.modal', function () {location.href = "../finance/allotments_add.php"; });
                  location.reload();
              }

        });
      }
}
function allotview(ee) {
        var formData = { 'editid' : ee };
        $.ajax({
          type: "POST",
          url: "allotments_view.php?id="+ee,
          data: formData,
          success: function(data) {
                  if (data == "visitpage") {
                    location.href="allotments_view.php?id="+ee;
                  }
                }
          });
}
</script>
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

function com(x) {
                   return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
    "ajax": "dt_allotments.php",
    "dom": '<"top">rt<"bottom"ip><"clear">',
    "aaSorting": [9,'desc'],
    "fnRowCallback":
      function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        $(nRow).attr('id', aData[0]);
      //  $(nRow).attr('subfeed', aData[1]);
        
        return nRow;
      },
    "aoColumnDefs": [
           { 
               "aTargets":[7],
                "mData": null,
                "mRender": function( data, type, full) {
                 return '<td>&#8369;'+com(data[7])+'</td>';
                }
            },
            { 
               "aTargets":[9],
                "mData": null,
                "mRender": function( data, type, full) {
               var id='<?php echo $_SESSION['id']; ?>';
               var lvl='<?php echo $_SESSION['permlvl']; ?>';
               var d9=data[9];
               if(lvl>0 || d9==id) {              
                    return '<td><span class=" glyphicon glyphicon-search" onclick="allotview('+data[0]+')"></span>&nbsp;<span class="glyphicon glyphicon-remove" onclick="delcom('+data[0]+')"></span></td>';
               }
               else
               {
                  return '<td><span class=" glyphicon glyphicon-search" onclick="allotview('+data[0]+')"></span></td>';
               }
              }
            },
        
            { "bVisible": false, "aTargets":[0] }
                    ]
  });


$(document).ready(function() {
  tableshown=false;
$("#searchme").keyup(function() {
   if (tableshown==false) {
      tableshown=true;
   }
   oTable.fnFilter(this.value);
}); 
});
});

</script>
<div class="row" style="margin:0;padding:0">
  <div class="col-md-2">
    <?php require "nav_side.php"; ?>
  </div>
  <div class="col-md-10">
      <div class="row">
        <div class="col-md-12">
            
<div style="border:solid 1px #c5d6de;background:#fff;text-align:left;padding:2em;margin-bottom:2em">
    <div class="row">
      <div class="col-md-4">        
        
        <h2 style="font-size:36px;margin-bottom:0em;margin-top:0em">Fund Allotments</h2>
        Encoded by SLP-NPMO
        <br><br>
        <a href="allotments_add.php"><button class="btn btn-info btn-sm">Add Fund Allotment</button></a>
        <button class="btn btn-success btn-sm" onclick="showsearch()"><span class="glyphicon glyphicon-search"></span>&nbsp; Search</button>
        <br>
      </div>
      <div class="col-md-8" id="cont1" style="">
        
      </div>
    </div>
        <div class="row" style="margin-top:1em;margin-bottom:1em;display:none;" id="searchfields">
          <div class="row" style="padding:2em;padding-bottom:1em">
              <input class="col-md-12 form-control" placeholder="Search keywords ..." id="searchme">
          </div>
          <div class="col-md-4">
              <select class="form-control">
                <option>Filter by Region</option>
              </select>
          </div>
          <div class="col-md-4">
              <select class="form-control">
                <option>Filter by Type</option>
                <option>CMF</option>
                <option>DR</option>
              </select>
          </div>
          <div class="col-md-4">
              <select class="form-control">
                <option>Filter by Fund Source</option>
                <option>SLP GAA - MD</option>
                <option>SLP GAA - EF</option>
                <option>BUB</option>
                <option>RRP</option>
              </select>
          </div>
        </div>



        <table class="table table-bordered table-hover" style="margin-top:2em;line-height:0.9;vertical-align:middle;border-top:2;padding-bottom:0;margin-bottom:0" id="viewdata">
          <thead style="background:#f6f8fa">
            <th></th>
            <th>Region</th>
            <th>Type</th>
            <th>Sub-Type</th>
            <th>Sub-Aro</th>
            <th>UACS</th>
            <th>Fund Source</th>
            <th>Amount</th>
            <th>Date</th>
            <th></th>
       

          </thead>
        <!--    <tr>
              <td>Region IV-B</td>
              <td>CMF</td>
              <td>Grant</td>
              <td>2348712398</td>
              <td>-</td>
              <td>SLP-EF</td>
              <td>468,232.00</td>
              <td>06/17/2016</td>
              <td><span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-remove"></span></td> 
            </tr> 

            <tr>
              <td>Region IV-B</td>
              <td>CMF</td>
              <td>Grant</td>
              <td>3021000003</td>
              <td>-</td>
              <td>SLP-MD</td>
              <td>268,232.00</td>
              <td>06/17/2016</td>
              <td><span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-remove"></span></td>
            </tr>
            <tr>
              <td>Region IV-B</td>
              <td>DR</td>
              <td>Admin</td>
              <td>-</td>
              <td>Travelling Expense</td>
              <td>PAMANA</td>
              <td>568,232.00</td>
              <td>06/17/2016</td>
              <td><span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-remove"></span></td>
            </tr>
            <tr data-toggle="tooltip" title="<div style='text-align:left'>Realigned to: <span style='font-weight:normal'>Training Expenses</span><br>Amount: <font color=red>-20,000.00</font><br>Original Amount: 188,232.00<br>Date: 09/27/2016</div>" data-html="true" data-placement="left" data-container="body">
              <td>Region IV-B</td>
              <td>DR</td>
              <td>Admin</td>
              <td>-</td>
              <td>Salary</td>
              <td>BUB</td>
              <td>168,232.00</td>
              <td>06/17/2016</td>
              <td><span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-remove"></span></td>
            </tr>
            <tr data-toggle="tooltip" title="<div style='text-align:left'>Realigned from: <span style='font-weight:normal'>Salary</span><br>Amount: <span class='colgreen'>+20,000.00</span><br>Original Amount: 1,444,232.00<br>Date: 09/27/2016</div>" data-html="true" data-placement="left" data-container="body">
              <td>NCR</td>
              <td>CMF</td>
              <td>Admin</td>
              <td>-</td>
              <td>Training Expenses</td>
              <td>RRP</td>
              <td>1,468,232.00</td>
              <td>06/17/2016</td>
              <td><span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-remove"></span></td>
            </tr>
            <tr>
              <td>Region X</td>
              <td>CMF</td>
              <td>Admin</td>
              <td>-</td>
              <td>Mobile</td>
              <td>RSF</td>
              <td>868,232.00</td>
              <td>06/17/2016</td>
              <td><span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-remove"></span></td>
            </tr> -->
        </table>
              <button class="btn btn-primary btn-xs" style="margin-top:0.5em;margin-left:3px">Export to Excel</button>
              <div class="clearfix"></div>
          </div>
        </div>
  </div>
</div>
<!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
        <div class="modal-dialog modal-sm">

          <div class="modal-content" style="padding:1em;padding-top:0.5em;">
                  <h3 style="color:#5cb85c;margin-bottom:6px">Success!</h3>
                  <span style="font-size:13px" id="sucsubtext">Fund Allotments saved!</span><br><br>
                  <button type="button" class="btn btn-primary pull-right" style="background:#5cb85c;border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Okay</button>
                  <div class="clearfix"></div>
          </div>
          
        </div>
      </div>
<!-- Modal -->
<script>
$('[data-toggle="tooltip"]').tooltip();
shown = false;
function showsearch() {
    if (shown == true) {
      $('#searchfields').fadeOut(399);
      shown = false;
    } else {
      shown = true;
      $('#searchfields').slideDown(399);
    }
}
function getProv() {
  var formData = { 
    'action' : 'province',
    'regionid' : $('#region option:selected').val()
  };
  $.ajax({
  type: "POST",
  url: "getLocations.php",
  data: formData,
  success: function(data) {
            $("#province").prop('disabled', false);
            $("#province").html(data);
        }

  });
}
</script>

</body>
</html>
