<?php
    require "../zxcd9.php";
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
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
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
    <?php require "../nav.php"; ?>
    <div class="row" style="margin:0;padding:0">
      <div class="col-md-2">
        <?php require "nav_side.php"; ?>
      </div>
      <div class="col-md-10">
          <div class="row">
            <div class="col-md-12">
                    <div style="border:solid 1px #c5d6de;background:#fff;text-align:left;padding:2em;margin-bottom:2em">
            <div class="row">
                  <div class="col-md-6">
                      <h2 style="font-size:40px;margin-bottom:0em;margin-top:0em">Work and Financial Plan</h2>
                      <a href="wfp2016final.xlsx" download><button class="btn btn-primary btn-xs" style="margin-top:0.5em;margin-left:3px">Download Full Excel Version</button></a>
                  </div>
                  <div class="col-md-2 pull-right">
                      <div class="form-group">
                        <select class="form-control">
                            <option>2016</option>
                        </select>
                      </div>
                  </div>
            </div>
          <div id="regularslp">
            <div class="row">
              <div class="col-md-8">
                <script>
    function changefundsource() {
        currfund = $('#fundselector option:selected').val();
        if (currfund == "PAMANA") {
          $('#pamanaslp').show();
          $('#regularslp').hide();
          $(window).resize();
          $("#cont2").highcharts().reflow();
        } else {
          $('#pamanaslp').hide();
          $('#regularslp').show();
          $(window).resize();
        }
    }
    function getPamanaAdmin() {
      var formData = {
          'action'    : "pamana_admin",
          'region'    : $('#pamanaselector option:selected').val()
        };
      $.ajax({
                       url: "finance_functions.php",
                       type: "POST",
                       data: formData,
                       success: function(data)
                       {
                              if (data != "") {
                                $('#pamanatable').html(data);
                              }
                       }
                    });
    }
    function getAdminRegion(type2) {
      var formData = {
          'action'    : "admincost",
          'type'      : type2,
          'region'    : $('#'+type2+'selector option:selected').val()
        };
      $.ajax({
                       url: "finance_functions2.php",
                       type: "POST",
                       data: formData,
                       success: function(data)
                       {
                              if (data != "" && type2 == "cmf") {
                                //alert(data);
                                cmfdata = data.split(",");
                                var cmfdata2 = data.split(',').map(function(n) {
                                    return Number(n);
                                });
                                chart3.series[0].setData(cmfdata2,true);
                              } else {
                                drdata = data.split(",");
                                var drdata2 = data.split(',').map(function(n) {
                                    return Number(n);
                                });
                                chart2.series[0].setData(drdata2,true);
                              }
                       }
                    });
    }
    function getAdminRegion2(type2) {
      var formData = {
          'action'    : "pamana_admin",
          'type'      : type2,
          'region'    : $('#'+type2+'selector option:selected').val()
        };
      $.ajax({
                       url: "finance_functions2.php",
                       type: "POST",
                       data: formData,
                       success: function(data)
                       {
                              if (data != "" && type2 == "cmf") {
                                //alert(data);
                                cmfdata = data.split(",");
                                var cmfdata2 = data.split(',').map(function(n) {
                                    return Number(n);
                                });
                                chart3.series[0].setData(cmfdata2,true);
                              } else {
                                drdata = data.split(",");
                                var drdata2 = data.split(',').map(function(n) {
                                    return Number(n);
                                });
                                chart2.series[0].setData(drdata2,true);
                              }
                       }
                    });
    }
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
                    margin: [0,0,0,0],
                    spacing: 0,
                    spacingRight: 5,
                },
                title: {
                       text: '9.67B',
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
                    text: 'Total',
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
                  enabled: false,
                  //width: 300,
                  //x: 50,
                itemStyle: {
                   font: 'Lato, sans-serif',
                   fontSize: '10px'
                  },
                },
                credits: {
                   enabled: false
                },
                series: [{
                  name: 'Users',
                  colorByPoint: true,
                  innerSize: '70%',
                  startAngle: 70,
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
                </script>
                          <div id="cont6" style="height:180px;padding-top:2em;border:0px solid #000;margin-top:1em"></div>
              </div>
              <div class="col-md-4" style="padding:2em;padding-bottom:1em">
                  <div style="border:solid 0px #c5d6de;background:#fff;text-align:left;padding:0.2em;margin-bottom:0;height:160px" id="cont1">
                    Pie Chart 1: Summary
                  </div>    
              </div>
            </div>
    <?php
                  //$filter = $_SESSION['filter'];
                  $stmt = $db->prepare("SELECT region, md, ef, bub FROM fin_wfp_grants"); 
                  $stmt->execute();
                  $reg = [];
                  $md = [];
                  $ef = [];
                  $bub = [];
                  while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                        $reg[] = $row[0];
                        $md[] = intval($row[1]);
                        $ef[] = intval($row[2]);
                        $bub[] = intval($row[3]);
                  }
    ?>
\
    <script>
    $(function () {
    var colors = Highcharts.getOptions().colors;
    Highcharts.setOptions({
        lang: {
            thousandsSep: ','
        }
    });
        chart6 = new Highcharts.Chart({
            chart: {
                renderTo: 'cont6',
                type: 'column',
                inverted: true,
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: ['Q1', 'Q2', 'Q3', 'Q4']
            },
            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: ''
                }
            },
            legend: {
                align: 'right',
                x: -10,
                verticalAlign: 'top',
                y: -10,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false,
                itemStyle: {
                     fontSize: '10px'
                },
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + com(this.y) + '<br/>' +
                        'Total: ' + com(this.point.stackTotal);
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal'
                }
            },
            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: 'Grants',
                data: [1712661841, 390018373, 3846533228, 2783154608],
                stack: 'male',
                color: colors[2]
            }, {
                name: 'Admin (MOOE)',
                data: [173801468, 173801468, 173801468, 173801468],
                stack: 'female',
                color: colors[0]
            }, {
                name: 'Admin (PS)',
                data: [45457250, 45457250, 45457250, 45457250],
                stack: 'female',
                color: colors[3]
            }]
        });
    chart6.renderer.label('Total WFP', 530, 80, 'callout')
                .css({
                    color: '#FFFFFF'
                })
                .attr({
                    fill: 'rgba(0, 0, 0, 0.75)',
                    padding: 8,
                    r: 5,
                    zIndex: 6,
                    id: 'targetlabel'
                })
        .add();
    });
    $(function () {
      var colors = Highcharts.getOptions().colors;
      Highcharts.setOptions({
        lang: {
            thousandsSep: ','
        }
    });
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'cont3',
                type: 'column'
            },
            title: {
                text: ''
           },
            xAxis: {
                categories: ['<?php echo $reg[0]; ?>','<?php echo $reg[1]; ?>','<?php echo $reg[2]; ?>','<?php echo $reg[3]; ?>','<?php echo $reg[4]; ?>','<?php echo $reg[5]; ?>','<?php echo $reg[6]; ?>','<?php echo $reg[7]; ?>','<?php echo $reg[8]; ?>','<?php echo $reg[9]; ?>','<?php echo $reg[10]; ?>','<?php echo $reg[11]; ?>','<?php echo $reg[12]; ?>','<?php echo $reg[13]; ?>','<?php echo $reg[14]; ?>','<?php echo $reg[15]; ?>','<?php echo $reg[16]; ?>','<?php echo $reg[17]; ?>'],
                minorGridLineWidth: 0,
                minorTickWidth: 0,
                tickWidth: 0,
                labels: {
                  enabled: true,
                    style: {
                        fontSize:'8px'
                    }
                },
            },
            yAxis: {
                min: 0,
                gridLineWidth: 0,
                title: {
                    text: ''
                },
                stackLabels: {
                    enabled: false,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                },
            },
            legend: {
                align: 'right',
                x: -30,
                verticalAlign: 'top',
                y: 0,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal:,.0f}'
            },
            credits: {
                enabled:false
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    pointPadding: 0,
                    borderWidth: 0,
                    groupPadding: 0.1,
                    dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black'
                        }
                    }
                }
            },
            series: [{
                name: 'MD',
                data: [<?php echo $md[0].",".$md[1].",".$md[2].",".$md[3].",".$md[4].",".$md[5].",".$md[6].",".$md[7].",".$md[8].",".$md[9].",".$md[10].",".$md[11].",".$md[12].",".$md[13].",".$md[14].",".$md[15].",".$md[16].",".$md[17]; ?>],
                color: colors[7]
            }, {
                name: 'EF',
                data: [<?php echo $ef[0].",".$ef[1].",".$ef[2].",".$ef[3].",".$ef[4].",".$ef[5].",".$ef[6].",".$ef[7].",".$ef[8].",".$ef[9].",".$bub[10].",".$bub[11].",".$bub[12].",".$bub[13].",".$bub[14].",".$bub[15].",".$bub[16].",".$bub[17]; ?>],
                color: colors[9]
            }, {
                name: 'BUB',
                data: [<?php echo $bub[0].",".$bub[1].",".$bub[2].",".$bub[3].",".$bub[4].",".$bub[5].",".$bub[6].",".$bub[7].",".$bub[8].",".$bub[9].",".$bub[10].",".$bub[11].",".$bub[12].",".$bub[13].",".$bub[14].",".$bub[15].",".$bub[16].",".$bub[17]; ?>],
                color: colors[8]
            }, {
                name: 'PAMANA',
                data: [2600000,0,500000,0,0,0,0,0,25050000,0,0,0,1000000,3000000,0,89460000,54200000],
                color: colors[6]
            }],
            credits: {
              enabled: false
            }
        });
        chart.renderer.label('Grants', 80, 5, 'callout')
                .css({
                    color: '#FFFFFF'
                })
                .attr({
                    fill: 'rgba(0, 0, 0, 0.75)',
                    padding: 8,
                    r: 5,
                    zIndex: 6,
                    id: 'targetlabel'
                })
        .add();
    });
    </script>        
            <hr>
            <div id="cont3">
            </div>        
            <div class="row">
              <hr>
              <div class="col-md-6">
                <div id="cont4" style="margin-top:1.5em">
                </div>
                <select class="form-control" onchange="getAdminRegion('dr')" id="drselector">
                  <option value="drviewall">DR - View All</option>
            <?php 
                  $query = "SELECT regname FROM lib_regions ORDER BY regname"; 
                  $stmt = $db->prepare($query); $result = $stmt->execute();  
                      while ($row5 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            if ($row5['regname']!="NPMO") {
                                echo "<option>".$row5['regname']."</option>";
                            }
                      }
                ?>
                </select>
                <!--<table class="table table-bordered" style="margin-top:1em;line-height:0.9;vertical-align:middle;border-top:2;padding-bottom:0;margin-bottom:0" id="drtable">
                  <thead style="background:#f6f8fa">
                    <th colspan="2">Direct Release</th>
                  </thead>
            <?php
                  //$filter = $_SESSION['filter'];
                  $stmt = $db->prepare("SELECT uacs, amount FROM fin_wfp_admin WHERE type='DR' GROUP BY uacs ORDER BY amount DESC"); 
                  $stmt->execute();
                  $dr[][] = "";
                  $totaldr = 0;
                  $a = 0;
                  while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                        $totaldr = ($totaldr+$row[1]);
                        $dr[$a][0] = $row[0];
                        $dr[$a][1] = $row[1];
                        $a++;
                        echo '<tr><td>'.$row[0].'</td><td>'.number_format($row[1]).'</td></tr>';
                  }
                  $stmt = $db->prepare("SELECT uacs, amount FROM fin_wfp_pamanaadmin WHERE type='CMF' GROUP BY uacs ORDER BY amount DESC"); 
                  $stmt->execute();
                  $pamanaadmin[][] = "";
                  $totalpamanaadmin = 0;
                  $a = 0;
                  while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                        $totalpamanaadmin = ($totalpamanaadmin+$row[1]);
                        $pamanaadmin[$a][0] = $row[0];
                        $pamanaadmin[$a][1] = $row[1];
                        $a++;
                        echo '<tr><td>'.$row[0].'</td><td>'.number_format($row[1]).'</td></tr>';
                  }
                  function adminRegions($dr,$getname) {
                    if ($getname==false) {
                      foreach ($dr as $region) { 
                          echo "'".$region[0]."',";
                      }
                    } else {
                      foreach ($dr as $region) { 
                          echo $region[1].",";
                      }
                    }
                  }
            ?>
                <tr style="background:#f6f8fa"><th style="text-align:right">Total</th><th style="text-align:center"><b><?php echo number_format($totaldr); ?></b></th></tr>
                </table>-->
              </div>
              <div class="col-md-6">
                <div id="cont5" style="margin-top:1.5em">
                </div>
                  <select class="form-control" onchange="getAdminRegion('cmf')" id="cmfselector">
                    <option value="cmfviewall">CMF - View All</option>
                <?php 
                  $query = "SELECT regname FROM lib_regions ORDER BY regname"; 
                  $stmt = $db->prepare($query); $result = $stmt->execute();  
                      while ($row5 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option>".$row5['regname']."</option>";
                      }
                ?>
            <?php
                  $stmt = $db->prepare("SELECT uacs, SUM(amount) FROM fin_wfp_admin WHERE type='CMF' GROUP BY uacs ORDER BY amount DESC"); 
                  $stmt->execute();
                  $cmf[][] = "";
                  $a = 0;
                  $totalcmf = 0;
                  while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                        $totalcmf = ($totalcmf+$row[1]);
                        $cmf[$a][0] = $row[0];
                        $cmf[$a][1] = $row[1];
                        $a++;
                        //echo "<tr><td>".$row[0]."</td><td>".number_format($row[1])."</td></tr>";
                  }
            ?>
                  </select>
                  <!--<table class="table table-bordered" style="margin-top:1em;line-height:0.9;vertical-align:middle;border-top:2;padding-bottom:0;margin-bottom:0" id="cmftable">
                  <thead style="background:#f6f8fa"><th colspan="2">Centrally Managed Funds</th></thead>
            <?php
                  $stmt = $db->prepare("SELECT uacs, SUM(amount) FROM fin_wfp_admin WHERE type='CMF' GROUP BY uacs ORDER BY amount DESC"); 
                  $stmt->execute();
                  $cmf[][] = "";
                  $a = 0;
                  $totalcmf = 0;
                  while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                        $totalcmf = ($totalcmf+$row[1]);
                        $cmf[$a][0] = $row[0];
                        $cmf[$a][1] = $row[1];
                        $a++;
                        echo "<tr><td>".$row[0]."</td><td>".number_format($row[1])."</td></tr>";
                  }
            ?>
                  <tr style="background:#f6f8fa"><th style="text-align:right">Total</th><th style="text-align:center"><b><?php echo number_format($totalcmf); ?></b></th></tr>
                </table>-->
              </div>
              </div>
          </div><!--div end regularslp-->
          <div id="pamanaslp" style="display:none">
            <div class="row">
              <div class="col-md-8">
                <script>
                    caraga = 99249100;
                    region6 = 33361808;
                    nir = 65044672;
                    region10 = 1000000;
                    region11 = 4288432;
                    region1 = 500000;
                    ncr = 2600000;
                    npmo = 12080548;
    $(function () {
        $(document).ready(function () {
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
                       text: '218m',
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
                    text: 'Total',
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
                  enabled: false,
                  //width: 300,
                  //x: 50,
                  itemStyle: {
                     font: 'Lato, sans-serif',
                     fontSize: '10px'
                  },
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Users',
                    colorByPoint: true,
                    innerSize: '70%',
                    startAngle: 90,
                    data: [{
                        name: 'CARAGA',
                        y: parseInt(caraga),
                        color: colors[0]
                    }, {
                        name: 'REGION VI',
                        y: parseInt(region6),
                        color: colors[2]
                    }, {
                        name: 'NIR',
                        y: parseInt(nir),
                        color: colors[3]
                    }, {
                        name: 'REGION X',
                        y: parseInt(region10),
                        color: colors[4]
                    }, {
                        name: 'REGION XI',
                        y: parseInt(region11),
                        color: colors[5]
                    }, {
                        name: 'REGION I',
                        y: parseInt(region1),
                        color: colors[6]
                    }, {
                        name: 'NCR',
                        y: parseInt(ncr),
                        color: colors[7]
                    }, {
                        name: 'NPMO',
                        y: parseInt(npmo),
                        color: colors[8]
                    }]
                }]
            });
        });
    });
    $(function () {
    var colors = Highcharts.getOptions().colors;
        chart2 = new Highcharts.Chart({
            chart: {
                renderTo: 'cont4',
                polar: true,
                type: 'area'
            },
            title: {
                text: '',
                x: -80
            },
            pane: {
                size: '80%'
            },
            xAxis: {
                categories: [<?php adminRegions($dr,false); ?>],
                tickmarkPlacement: 'on',
                lineWidth: 0
            },
            yAxis: {
                gridLineInterpolation: 'polygon',
                lineWidth: 0,
                min: 0
            },
            tooltip: {
                shared: true,
                pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
            },
            legend: {
                align: 'right',
                verticalAlign: 'top',
                y: 70,
                layout: 'vertical',
                enabled: false
            },
            credits: {
              enabled: false
            },
            series: [{
                name: 'Allocatd Budget',
                data: [<?php adminRegions($dr,true); ?>],
                pointPlacement: 'on',
                colors: colors[1]
            }]
        });
    chart2.renderer.label('Admin Cost: DR', 30, 0, 'callout')
                .css({
                    color: '#FFFFFF'
                })
                .attr({
                    fill: 'rgba(0, 0, 0, 0.75)',
                    padding: 8,
                    r: 5,
                    zIndex: 6,
                    id: 'targetlabel'
                })
        .add();
    });
    $(function () {
    var colors = Highcharts.getOptions().colors;
        chartOptions = {
            chart: {
                renderTo: 'cont5',
                polar: true,
                type: 'area'
            },
            title: {
                text: '',
                x: -80
            },
            pane: {
                size: '80%'
            },
            xAxis: {
                categories: [<?php adminRegions($cmf,false); ?>],
                tickmarkPlacement: 'on',
                lineWidth: 0
            },
            yAxis: {
                gridLineInterpolation: 'polygon',
                lineWidth: 0,
                min: 0,
            },
            tooltip: {
                shared: true,
                snap: 0,
                pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
            },
            plotOptions: {
                series: {
                    stickyTracking: false
                }
            },
            legend: {
                align: 'right',
                verticalAlign: 'top',
                y: 70,
                layout: 'vertical',
                enabled: false
            },
            credits: {
              enabled: false
            },
            series: [{
                name: 'Allocated Budget',
                data: [<?php adminRegions($cmf,true); ?>],
                pointPlacement: 'on',
                color: colors[0]
            }]
        };
        chart3 = new Highcharts.Chart(chartOptions);
        chart3.renderer.label('Admin Cost: CMF', 30, 0, 'callout')
                .css({
                    color: '#FFFFFF'
                })
                .attr({
                    fill: 'rgba(0, 0, 0, 0.75)',
                    padding: 8,
                    r: 5,
                    zIndex: 6,
                    id: 'targetlabel'
                })
        .add();
    });
                </script>
                <table class="table table-bordered" style="margin-top:2em;line-height:0.9;vertical-align:middle;border-top:2;padding-bottom:0;margin-bottom:0" >
                  <thead style="background:#f6f8fa">
                    <th>Region</th>
                    <th>Grand Total</th>
                  </thead>
                  <tr>
                    <td style="background:#f6f8fa">CARAGA</td>
                    <td><script>document.write(com(caraga));</script></td>
                  </tr>
                  <tr>
                    <td style="background:#f6f8fa">REGION VI</td>
                    <td><script>document.write(com(region6));</script></td>
                  </tr>
                  <tr>
                    <td style="background:#f6f8fa">NIR</td>
                    <td><script>document.write(com(nir));</script></td>
                  </tr>
                  <tr>
                    <td style="background:#f6f8fa">REGION X</td>
                    <td><script>document.write(com(region10));</script></td>
                  </tr>
                  <tr>
                    <td style="background:#f6f8fa">REGION XI</td>
                    <td><script>document.write(com(region11));</script></td>
                  </tr>
                  <tr>
                    <td style="background:#f6f8fa">REGION I</td>
                    <td><script>document.write(com(region1));</script></td>
                  </tr>
                  <tr>
                    <td style="background:#f6f8fa">NCR</td>
                    <td><script>document.write(com(ncr));</script></td>
                  </tr>
                  <tr>
                    <td style="background:#f6f8fa">NPMO</td>
                    <td><script>document.write(com(npmo));</script></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-4" style="padding:2em;">
                  <div style="border:solid 0px #c5d6de;background:#fff;text-align:left;padding:0.2em;margin-bottom:0;height:160px" id="cont2">
                    Pie Chart 1: Summary
                  </div>      
                  <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
            </div>
              <div class="row">
                <hr>
                <center><h3>GRANTS</h3></center>
                <table class="table table-bordered" style="margin-top:2em;line-height:0.9;vertical-align:middle;border-top:2;padding-bottom:0;margin-bottom:0" >
                  <thead style="background:#f6f8fa">
                    <th rowspan="3" style="vertical-align:middle">Region</th>
                      <th>Grants<br>(Grants-R)</th>
                      <th>Incentive Fund<br>(Grants-IF)</th>
                      <th>Community Mobilization Fund<br>(Grants-CMF)</th>
                      <th style="vertical-align:middle">Total Grants</th>
                  </thead>
                <?php
                      //$filter = $_SESSION['filter'];
                      $stmt = $db->prepare("SELECT region, pamana_gr, pamana_if, pamana_cmf FROM fin_wfp_pamana"); 
                      $stmt->execute();

                      while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {                        
                            if (($row[1]+$row[2]+$row[3]) != 0) { 
                              echo '<tr><td>'.$row[0].'</td><td>'.number_format($row[1]).'</td><td>'.number_format($row[2]).'</td><td>'.number_format($row[3]).'</td><td><b>'.number_format($row[1]+$row[2]+$row[3]).'</b></td></tr>';
                            }
                      }
                ?>
                </table>
              </div>
              <div class="row">
                <hr>
                  <center><h3>CAPITAL OUTLAY</h3></center>
                <table class="table table-bordered" style="margin-top:2em;line-height:0.9;vertical-align:middle;border-top:2;padding-bottom:0;margin-bottom:0" >
                  <thead style="background:#f6f8fa">
                    <th rowspan="3" style="vertical-align:middle">Region</th>
                      <th>Capital Outlay</th>
                  </thead>
                <?php
                      //$filter = $_SESSION['filter'];
                      $stmt = $db->prepare("SELECT region, pamana_outlay FROM fin_wfp_pamana"); 
                      $stmt->execute();
                      while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {                        
                            if ($row[1] != 0) { 
                              echo '<tr><td>'.$row[0].'</td><td>'.number_format($row[1]).'</td></tr>';
                            }
                      }
                ?>
                </table>
              </div>
              <div class="row">
              <hr>
              <center><h3 style="margin-bottom:1em">ADMINISTRATIVE COSTS</h3></center>
              <div class="col-md-offset-3 col-md-6">
                  <select class="form-control" onchange="getPamanaAdmin()" id="pamanaselector">
                      <option>CMF - View All</option>
                      <option>CARAGA</option>
                      <option>REGION VI</option>
                      <option>REGION X</option>
                      <option>REGION XI</option>
                      <option>REGION I</option>
                      <option>NIR</option>
                      <option>NCR</option>
                      <option>NPMO</option>
                  </select>
                  <table class="table table-bordered" style="margin-top:1em;line-height:0.9;vertical-align:middle;border-top:2;padding-bottom:0;margin-bottom:0" id="pamanatable">
                  <thead style="background:#f6f8fa"><th colspan="2">Centrally Managed Funds</th></thead>
            <?php
                  $stmt = $db->prepare("SELECT uacs, SUM(amount) FROM fin_wfp_pamanaadmin WHERE type='CMF' GROUP BY uacs ORDER BY amount DESC"); 
                  $stmt->execute();
                  $totalcmf = 0;
                  while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                        $totalcmf = ($totalcmf+$row[1]);
                        echo "<tr><td>".$row[0]."</td><td>".number_format($row[1])."</td></tr>";
                  }
            ?>
                  <tr style="background:#f6f8fa"><th style="text-align:right">Total</th><th style="text-align:center"><b><?php echo number_format($totalcmf); ?></b></th></tr>
                </table>
              </div>
              </div>
          </div>
            </div>
              </div>
            </div>
      </div>
    </div>
    </body>
    </html>
