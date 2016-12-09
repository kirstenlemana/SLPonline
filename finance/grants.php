<?php
    $username = "root"; 
    $password = "root"; 
    $host = "localhost"; 
    $dbname = "csc613m";
    try 
    { 
        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
        $db->exec("SET time_zone = '+0:00'");
    } 
    catch(PDOException $ex) 
    { 
        die("Failed to connect to the database: " . $ex->getMessage()); 
    } 
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
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
<?php require "navfin.php"; ?>
<div class="row" style="margin:0;padding:0">
  <div class="col-md-2">
    <?php require "nav_side.php"; ?>
  </div>
  <div class="col-md-10">
      <div class="row">
        <div class="col-md-12">
            <div style="border:solid 1px #c5d6de;background:#fff;text-align:left;padding:2em;margin-bottom:2em">
              <div class="row">
                <div class="col-md-8">
                  <h2 style="font-size:50px;margin-bottom:0em;margin-top:0em">Grants</h2>
                  Viewing data for: <b>Region VI</b><br>
                  <a href="addprojects.php"><button class="btn btn-info btn-sm" style="margin-top:0.8em">Add Project Grant</button></a>
                  <button class="btn btn-success btn-sm" onclick="showsearch()" style="margin-top:0.8em"><span class="glyphicon glyphicon-search"></span>&nbsp; Search</button>
                </div>
                <div class="col-md-4">
                    <div style="border:solid 0px #c5d6de;background:#fff;text-align:left;padding:0.2em;margin-bottom:0;height:160px" id="cont2">
                      Pie Chart 2: Summary
                    </div>
                </div>
              </div>
        <br>
        <div class="row" style="margin-top:1em;margin-bottom:1em;display:none;" id="searchfields">
          <div class="row" style="padding:2em;padding-bottom:1em">
              <input class="col-md-12 form-control" placeholder="Sub Aro. #">
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
        <table class="table table-bordered" style="margin-top:2em;line-height:0.9;vertical-align:middle;border-top:2;padding-bottom:0;margin-bottom:0" >
          <thead style="background:#f6f8fa">
          <tr>
            <th rowspan="2" style="vertical-align:middle">Project ID</th>
            <th rowspan="2" style="vertical-align:middle">Cost</th>
            <th rowspan="2" style="vertical-align:middle">Date</th>
            <th rowspan="2" style="vertical-align:middle">SARO</th>
            <th colspan="2" style="background:#ccc;font-size:12px;padding:0">BUDGET</th>
            <th colspan="2" style="background:#ccc;font-size:12px;padding:0">ACCOUNTING</th>
            <th colspan="3" style="background:#ccc;font-size:12px;padding:0">CASH</th>
          <tr>
            <th>OBR</th>
            <th>Date</th>
            <th>DV</th>
            <th>Date</th>
            <th>Vari</th>
            <th>Check No.</th>
            <th>Date</th>
          </tr>
          </thead>
            <tr>
              <td><a href="" style="color:blue">2016-028221-07</a></td>
              <td style="font-size:12px">853,231.50</td>
              <td>07/04/16</td>
              <td>3200238</td>
              <td>12312</td>
              <td>06/17/16</td>
              <td>12312</td>
              <td>06/18/16</td>
              <td style="font-size:12px">743,211.20</td>
              <td>12312</td>
              <td>06/20/16</td>
            </tr>
            <tr>
              <td><a href="" style="color:blue">2016-028221-08</a></td>
              <td style="font-size:12px">853,231.50</td>
              <td>07/04/16</td>
              <td>3200238</td>
              <td>12312</td>
              <td>06/17/16</td>
              <td>12312</td>
              <td>06/18/16</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
            </tr>
            <tr>
              <td><a href="" style="color:blue">2016-028221-09</a></td>
              <td style="font-size:12px">853,231.50</td>
              <td>07/04/16</td>
              <td>3200238</td>
              <td>12312</td>
              <td>06/17/16</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
            </tr>
            <tr>
              <td><a href="" style="color:blue">2016-028221-10</a></td>
              <td style="font-size:12px">853,231.50</td>
              <td>07/04/16</td>
              <td>3200238</td>
              <td>12312</td>
              <td>06/17/16</td>
              <td>12312</td>
              <td>06/18/16</td>
              <td style="font-size:12px">325,532.29</td>
              <td>12312</td>
              <td>06/20/16</td>
            </tr>
        </table>        
          </div>
        </div>
  </div>
</div>
<script>
$(document).ready(function () {
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
                margin: [0,0,0,0],
                spacing: 0,
                spacingRight: 5,
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
                text: 'Projects',
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
