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
    <script src="https://code.highcharts.com/modules/treemap.js"></script>
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
<script>
         function com(x) {
         return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
         }
                grants = [1712661841,390018373,3846533228,2783154608];
                admincosts = [173801468,173801468,173801468,173801468];
                ps = [45457250,45457250,45457250,45457250];
                sum1 = grants.reduce(function(grants, b) { return grants + b; }, 0);
                sum2 = admincosts.reduce(function(admincosts, b) { return admincosts + b; }, 0);
                sum3 = ps.reduce(function(ps, b) { return ps + b; }, 0);
$(function () {
    $(document).ready(function () {
      var colors = Highcharts.getOptions().colors;
        $('#cont1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                backgroundColor: null,
                margin: [0,70,0,0],
                spacing: 0,
                spacingRight: 5,
            },
            title: {
                   text: '9.7B',
                   verticalAlign: 'middle',
                   y: 0,
                   x: -30,
                   style: {
                        fontFamily: 'Lato', 
                        fontSize: '42px',
                        fontWeight: 'bold',
                    }
            },
            subtitle: {
                text: 'Total',
                verticalAlign: 'middle',
                y: 24,
                x: -30,
                style: {
                        fontFamily: 'Lato', 
                        fontSize: '20px',
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
                        enabled: false
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
                 fontSize: '13px'
              },
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Users',
                colorByPoint: true,
                innerSize: '70%',
                data: [{
                    name: 'GRANTS',
                    y: parseInt(sum1),
                    color: colors[2]
                }, {
                    name: 'ADMIN',
                    y: parseInt(sum2),
                    color: colors[0]
                }, {
                    name: 'PS',
                    y: parseInt(sum3),
                    color: colors[3]
                }]
            }]
        });
    });
});
$(function () {
  var colors = Highcharts.getOptions().colors;
  regtot = [2,3,34,5,3,2,3,2,2,2,2,2,2,22,34];
  regconf = [2,3,34,5,3,2,3,2,2,2,2,2,2,22,3];
    $('#cont2').highcharts({
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
        series: [{
            name: 'CMF',
            color: colors[3],
            data: [23,23,55,23,15,09,18,20,50,33,38,21,12,10,40,20]
        },{
            name: 'DR',
            color: colors[8],
            data: [43,12,44,22,10,08,25,67,32,10,29,56,19,10,40,20]
        }]
    });
});
$(function () {
    $('#cont3').highcharts({
        series: [{
            type: "treemap",
            layoutAlgorithm: 'stripes',
            colorByPoint:true,
            height: 150,
            alternateStartingDirection: true,
            levels: [{
                level: 1,
                layoutAlgorithm: 'sliceAndDice',
                dataLabels: {
                    enabled: false,
                    align: 'left',
                    verticalAlign: 'top',
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Lato', 
                        textShadow: false
                    }
                }
            }],
            data: [{
                name: 'MOA Cost of Service',
                value: 54647405
            }, {
                name: 'Travelling Expense',
                value: 38987597
            }, {
                name: 'Repair-IT',
                value: 950000
            }, {
                name: 'Rental Office',
                value: 950000
            }, {
                name: 'Supplies',
                value: 4156000
            }, {
                name: 'Meeting',
                value: 915723
            }, {
                name: 'Electricity',
                value: 6440000
            }]
        }],
        title: {
            text: ''
        },
        credits: {
          enabled: false
        }
    });
});
   </script>
<div class="row" style="margin:0;padding:0">
  <div class="col-md-3">
      <div style="border:solid 1px #c5d6de;background:#fff;text-align:left;padding:0;margin:0">
                <table class="table table-hover" style="margin:0;">
                  <tr><td><a href="wfp_2.php" style="text-decoration:none;"><h3 style="font-size:16px;margin-bottom:0;text-align:left;padding-left:1em;margin-top:0.5em"><span class="glyphicon glyphicon-list-alt glyphcenter"></span>&nbsp; WFP 2016</h3></a></td></tr>
                  <tr><td><a href="allotments_2.php" style="text-decoration:none;"><h3 style="font-size:16px;margin-bottom:0.2em;text-align:left;padding-left:1em;margin-top:0.2em"><span class="glyphicon glyphicon-inbox glyphcenter"></span>&nbsp; ALLOTMENTS</h3></a></td></tr>
                  <tr><td><a href="grants.php" style="text-decoration:none;"><h3 style="font-size:16px;margin-bottom:0.2em;text-align:left;padding-left:1em;margin-top:0.2em"><span class="glyphicon glyphicon-random glyphcenter"></span>&nbsp; GRANTS</h3></a></td></tr>
                  <tr><td><a href="admincosts2.php" style="text-decoration:none;"><h3 style="font-size:16px;margin-bottom:0.2em;text-align:left;padding-left:1em;margin-top:0.2em"><span class="glyphicon glyphicon-tag glyphcenter"></span>&nbsp; ADMIN COSTS</h3></a></td></tr>
                  <tr><td><a href="admincosts2.php" style="text-decoration:none;"><h3 style="font-size:16px;margin-top:0;text-align:left;padding-left:1em"><span class="glyphicon glyphicon-signal glyphcenter"></span>&nbsp; REPORTS</h3></a></td></tr>
                </table>
      </div>
  </div>
  <div class="col-md-9">
      <div class="row">
        <div class="col-md-12">
          <div style="border:solid 1px #c5d6de;background:#fff;text-align:left;padding:2em;margin-bottom:2em;width:100%">
                    ANNOUNCEMENTS<br>
                    For finance concerns
          </div>
        </div>
        <div class="col-md-12">
          <div style="border:solid 1px #c5d6de;background:#fff;text-align:left;padding:2em;margin-bottom:2em;width:100%">
                    DASHBOARD<br>
                    <div class="row" style="margin-top:0em">
                      <div class="col-md-5">
                           <div style="border:solid px #c5d6de;background:#fff;text-align:left;padding:0em;margin-top:-1.5em;margin-bottom:0em;height:470px" id="cont3">
                                Pie chart: Admin Costs
                      </div>
                    </div>
                      <div class="col-md-7">
                        <div class="row">
                            <div style="border:solid 0px #c5d6de;background:#fff;text-align:left;padding:2em;margin-bottom:2em;height:300px" id="cont1">
                                 Pie Chart: National Obligation
                                 </div>
                            </div>
                            <div class="row">
                              <div style="border:solid 0px #c5d6de;background:#fff;text-align:left;padding:0;margin-bottom:2em;margin-top:-2em" id="cont2">
                                Column chart: Regional Obligation
                              </div>
                            </div>
                         <div>
                    </div>
                 </div>
             </div>
        </div>
     </div>
</body>
</html>
