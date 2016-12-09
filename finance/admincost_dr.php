<?php
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP Online</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/flatbootstrap.css"/>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
}table {
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
</style>
</head>
<body>
<?php 
  require "navfin.php"; 
?>
<div class="row" style="margin:0;padding:0">
  <div class="col-md-2">
      <?php 
        require "nav_side.php";
      ?>
  </div>
    <div class="col-md-10">
      <div class="row">
        <div class="col-md-12">
          <div style="border:solid 1px #c5d6de;background:#fff;text-align:left;padding:2em;margin-bottom:2em;width:100%">
              <div class="row">
                <div class="col-md-8">
                  <h2 style="font-size:40px;margin-bottom:0em;margin-top:0em">Admin Costs - CMF</h2>
                  Viewing data for: <b>Region VI</b><br>
                    <div style="margin-top:0.6em">
                      <a href="addadmin.php"><button class="btn btn-info btn-sm">Add CMF</button></a>
                      <button class="btn btn-success btn-sm" onclick="showsearch()"><span class="glyphicon glyphicon-search"></span>&nbsp; Search</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="border:solid 0px #c5d6de;background:#fff;text-align:left;padding:0.2em;margin-bottom:0;height:160px" id="cont2">
                      Pie Chart 2: Summary
                    </div>
                </div>
              </div>
       <table class="table table-bordered" style="margin-top:2em;line-height:0.9;vertical-align:middle;border-top:2;padding-bottom:0;margin-bottom:2em;width:100%">
          <thead style="background:#f6f8fa">
            <tr>
                <th rowspan="2" style="vertical-align:middle">UACS</th>
                <th rowspan="2" style="vertical-align:middle">Sub-ARO</th>
                <th rowspan="2" style="vertical-align:middle">Cost</th>
                <th rowspan="2" style="vertical-align:middle">Date</th>
                <th style="vertical-align:middle">BUDGET</th>
                <th style="vertical-align:middle">ACCOUNTING</th>
                <th style="vertical-align:middle">CASH</th>
                <th></th>
            </tr>
          </thead>
            <tr>
                <td>Travelling Expenses</td>
                <td>5020011002</td>
                <td>232,125.00</td>
                <td>09/09/1990</td>
                <td data-toggle="tooltip" title="<div style='text-align:left'>5020011002<hr style='padding:0;margin:0;margin-bottom:0.5em'>OBR#: 23116<br>Amount: 23,220.00<br>Date: 09/26/2016</div>" data-html="true" data-placement="bottom" data-container="body"><span class="glyphicon glyphicon-ok colgreen"></span></td>
                <td data-toggle="tooltip" title="<div style='text-align:left'>5020011002<hr style='padding:0;margin:0;margin-bottom:0.5em'>DV#: 23116<br>Amount: 23,220.00<br>Date: 09/26/2016</div>" data-html="true" data-placement="bottom" data-container="body"><span class="glyphicon glyphicon-ok colgreen"></span></td>
                <td data-toggle="tooltip" title="<div style='text-align:left'>5020011002<hr style='padding:0;margin:0;margin-bottom:0.5em'>Check #: 23116<br>Amount: 23,220.00<br>Date: 09/26/2016</div>" data-html="true" data-placement="bottom" data-container="body"><span class="glyphicon glyphicon-ok colgreen"></span></td>
                <td><span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-remove"></span></td>
            </tr>
            <tr>
                <td>Cost of Service</td>
                <td>324011002</td>
                <td>332,125.00</td>
                <td>09/10/1990</td>
                <td data-toggle="tooltip" title="<div style='text-align:left'>5020011002<hr style='padding:0;margin:0;margin-bottom:0.5em'>OBR#: 23116<br>Amount: 23,220.00<br>Date: 09/26/2016</div>" data-html="true" data-placement="bottom" data-container="body"><span class="glyphicon glyphicon-ok colgreen"></span></td>
                <td data-toggle="tooltip" title="<div style='text-align:left'>5020011002<hr style='padding:0;margin:0;margin-bottom:0.5em'>DV#: 23116<br>Amount: 23,220.00<br>Date: 09/26/2016</div>" data-html="true" data-placement="bottom" data-container="body"><span class="glyphicon glyphicon-ok colgreen"></span></td>
                <td>-</td>
                <td><span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-remove"></span></td>
            </tr>
            <tr>
                <td>Travelling Expenses</td>
                <td>9020078999</td>
                <td>432,125.00</td>
                <td>09/11/1990</td>
                <td data-toggle="tooltip" title="<div style='text-align:left'>5020011002<hr style='padding:0;margin:0;margin-bottom:0.5em'>OBR#: 23116<br>Amount: 23,220.00<br>Date: 09/26/2016</div>" data-html="true" data-placement="bottom" data-container="body"><span class="glyphicon glyphicon-ok colgreen"></span></td>
                <td>-</td>
                <td>-</td>
                <td><span class="glyphicon glyphicon-edit"></span> <span class="glyphicon glyphicon-remove"></span></td>
            </tr>
          </thead>
          </table>
             </div>
          </div>
        </div>
  </div>
</div>
<script>
$(document).ready(function () {
      $('[data-toggle="tooltip"]').tooltip(); 
                encoded = 500;
                budget = 320;
                accounting = 40;
                cash = 100;
                completed = 232;
      var colors = Highcharts.getOptions().colors;
        $("#cont2").highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                backgroundColor: null,
                margin: [1,1,1,1],
                spacing: 0,
            },
            title: {
                   text: '1,723',
                   verticalAlign: 'middle',
                   y: 0,
                   x: 0,
                   style: {
                        fontFamily: 'Lato', 
                        fontSize: '20px',
                        fontWeight: 'bold',
                    }
            },
            subtitle: {
                text: 'Records',
                verticalAlign: 'middle',
                y: 14,
                x: 0,
                style: {
                        fontFamily: 'Lato', 
                        fontSize: '12px',
                    }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = '<span style="color:#000;font-size:11">' + point.name +': <b>'+ Highcharts.numberFormat(this.point.y,0,'.',',') +'</b><br/>';
                    if (point.drilldown) {
                        s += '<span style="color:#000;font-size:11">Click to view regional';
                    } else if (!point.drilldown) {
                        s = this.point.name +': <b>'+ Highcharts.numberFormat(this.point.y,0,'.',',') +'</b><br/>';
                    } else {
                        s += '<span style="color:#000;font-size:10">Click to return';
                    }
                    return s;
                },
                hideDelay: 0
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    size:'100%',
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        distance: 3
                    },
                    showInLegend: true
                }
            },
            legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              floating: false,
              backgroundColor: '',
              //width: 300,
              //x: 50,
              itemStyle: {
                 font: 'Lato, sans-serif',
                 fontSize: '10px'
              },
              enabled: false
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Users',
                colorByPoint: true,
                innerSize: '70%',
                startAngle: -20,
                data: [{
                    name: 'Encoded',
                    y: parseInt(encoded),
                    color: colors[0]
                }, {
                    name: 'Budget',
                    y: parseInt(budget),
                    color: colors[2]
                }, {
                    name: 'Accounting',
                    y: parseInt(accounting),
                    color: colors[3]
                }, {
                    name: 'Cash',
                    y: parseInt(cash),
                    color: colors[4]
                }, {
                    name: 'Completed',
                    y: parseInt(completed),
                    color: colors[5]
                }]
            }]
        });
      });
</script>
</body>
</html>
