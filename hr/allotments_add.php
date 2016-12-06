<?php


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
          <div style="border:solid 1px #c5d6de;background:#fff;text-align:left;padding:0em;padding-left:1em;margin-bottom:2em;width:100%">
          
              <div class="row" style="height:100%">
                <div class="col-md-6" style="background-color:#007ee5;padding:3em;color:#fff;height:480px">
                  SLP Finance System<h3>How to add Fund Allotments</h3>
                  <ul>
                    <li>Please enter this</li>
                    <li>Please select that</li>
                  </ul>
                </div>
                <div class="col-md-6" style="padding:3em;color:#000;padding-top:1em">
                  <br>Please complete the form below:<br><br>
                  <div class="form-group">
                        <select class="form-control" style="margin-bottom:0.5em" id="region" name="region">
                            <option selected>Select Region</option>
                            <option>Region I</option>
                            <option>Region II</option>
                            <option>Region III</option>
                        </select>
                  </div>
                  <div class="form-group">
                        <select class="form-control" style="margin-bottom:0.5em" id="fundtype" name="fundtype">
                            <option selected>Select Type</option>
                            <option value="CMF">Centrally Managed Fund</option>
                            <option value="DR">Direct Release</option>
                        </select>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <select class="form-control" id="subtype" name="subtype" onchange="displaySubType();">
                            <option value="'">Select Sub-Type</option>
                            <option>Grant</option>
                            <option>Admin Cost</option>
                        </select>
                      </div>
                      <div class="col-md-6" style="" id="blankholder">
                        <input class="form-control" style="padding-right:0;" placeholder="" disabled>
                      </div>
                      <div class="col-md-6" style="display:none;" id="saaholder">
                        <input class="form-control" style="padding-right:0;" id="saa" name="saa" placeholder="SAA Number">
                      </div>
                      <div class="col-md-6" style="display:none" id="uacsholder">
                        <select class="form-control" id="uacs" name="uacs">
                            <option>Select UACS</option>
                            <option>Travelling Expense</option>
                            <option>Cost of Service</option>
                            <option>Rental Office</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <select class="form-control" id="fundsource" name="fundsource">
                            <option>Select Fund Source</option>
                            <option>SLP-MD</option>
                            <option>SLP-EF</option>
                            <option>PAMANA</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <select class="form-control" id="fundsourceyear" name="fundsourceyear">
                            <option>Select Fund Year</option>
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <input class="form-control" placeholder="Amount (PhP)"></input>
                      </div>
                      <div class="col-md-6">
                        <input class="form-control" placeholder="Date Accomplished"></input>
                      </div>
                    </div>
                  </div>
                  <button class="btn-info btn pull-right">Add Fund</button>


                </div>
              </div>

          </div>
        </div>
      </div>
  </div>
</div>
<script>
function displaySubType() {
    var selected = $("#subtype option:selected").val();
    console.log(selected);

    if (selected == "Grant") {
        $("#saaholder").fadeIn();
        $("#uacsholder").hide();
        $("#blankholder").hide();
    } else {
        $("#uacsholder").fadeIn();
        $("#saaholder").hide();
        $("#blankholder").hide();
    }
}
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
