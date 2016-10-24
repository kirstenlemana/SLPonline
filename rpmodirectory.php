<?php
require "zxcd9.php";
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
</style>
</head>
<body>
<?php require "nav.php"; ?>
<div class="row" style="margin:0;padding:0">

  <div class="col-md-12">
      <div style="border:solid 1px #c5d6de;background:#fff;text-align:center;padding:2em;margin-bottom:2em;padding-bottom:0">
        
            <table class="table table-striped" stlye="margin-bottom:2em">
              <thead>
                <tr>
                  <th>Region</th>
                  <th>Regional Director</th>
                  <th>ARDO</th>
                  <th>SLP RPC</th>
                  <th>E-mail</th>
                </tr>
              </thead>
              <tr>
                <td>NCR</td>
                <td>Vincent Andrew T. Leyson</td>
                <td>Jacel J. Paguio</td>
                <td>Jerry Brenches</td>
                <td>slp.foncr@e-dswd.net</td>
              </tr>
              <tr>
                <td>CAR</td>
                <td>Janet P. Armas (OIC)</td>
                <td>Mary Grail B. Dong-as</td>
                <td>Brenda Consolacion</td>
                <td>livelihoodcar@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION I</td>
                <td>Marcelo Nicomedes J. Castillo</td>
                <td>Marlene Febes D. Peralta</td>
                <td>Agnes Tambalo</td>
                <td>livelihood.fo1@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION II</td>
                <td>Remia T. Tapispisan</td>
                <td>Ponciana P. Condoy</td>
                <td>Nena Mayo</td>
                <td>livelihood02@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION III</td>
                <td>Gemma B. Gabuya</td>
                <td>Venus F. Rebuldela</td>
                <td>Fe Manarang (OIC)</td>
                <td>fo3@dswd.gov.ph, slpunit.fo3@e-dswd.net</td>
              </tr>
              <tr>
                <td>REGION IV-A</td>
                <td>Leticia T. Diokno</td>
                <td></td>
                <td>Milante Aceveda</td>
                <td>livelihoodunit_dswd4a@yahoo.com</td>
              </tr>
              <tr>
                <td>REGION IV-B</td>
                <td>Wilma D. Naviamos</td>
                <td>OIC Floreceli G. Gunio</td>
                <td>Domingo Agra</td>
                <td>livelihood04b@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION V</td>
                <td>Arnel B. Garcia</td>
                <td>Corazon B. Miña</td>
                <td>Generosa Millete, Earl Maximillian A. Cecilio</td>
                <td>livelihood.fo5@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION VI</td>
                <td>Rebecca E. Geamala</td>
                <td></td>
                <td>Mary Ann H. Masculino</td>
                <td>livelihoo06@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION VII</td>
                <td>Ma. Evelyn B. Macapobre</td>
                <td>Shalaine Marie S. Lucero</td>
                <td>Jennifer Quimno</td>
                <td>livelihood07@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION VIII</td>
                <td>Restituto B. Macuto (OIC)</td>
                <td></td>
                <td>Hermanito Mangalao</td>
                <td>livelihood08@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION IX</td>
                <td>Zenaida L. Arevalo</td>
                <td>Consejo H. Usman</td>
                <td>Elizabeth Saavedra</td>
                <td>livelihood09@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION X</td>
                <td>Araceli F. Solamillo</td>
                <td>Aldersey M. Dela Cruz</td>
                <td>Glofelia Uayan</td>
                <td>livelihood10@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION XI</td>
                <td>Priscilla N. Razon</td>
                <td>Rebecca A. Santamaria</td>
                <td>Rebecca Sta. Maria</td>
                <td>livelihood11@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>REGION XII</td>
                <td>Bai Zorahayda T. Taha</td>
                <td>Gemma N. Rivera</td>
                <td>Noraidah Busran</td>
                <td>livelihood12@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>CARAGA</td>
                <td>Minda B. Brigoli, CESO III</td>
                <td>Mita G. Lim</td>
                <td>Roy Serdeña</td>
                <td>slpmoarmm@gmail.com</td>
              </tr>
              <tr>
                <td>ARMM</td>
                <td>Sec. Haroun Alrashid A. Lucman</td>
                <td></td>
                <td>Jaiton Ibrahim</td>
                <td>livelihoodcrg@dswd.gov.ph</td>
              </tr>
              <tr>
                <td>NIR</td>
                <td>Shalaine Marie S. Lucero</td>
                <td></td>
                <td>Fernando V. Alabado (OIC)</td>
                <td>livelihood.fonir@dswd.gov.ph, fonir@dswd.gov.ph</td>
              </tr>
            </table>

      </div>
  </div>

</div>
<!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
        <div class="modal-dialog modal-sm">

          <div class="modal-content" style="padding:1em;padding-top:0.5em;">
                  <h3 style="color:#5cb85c;margin-bottom:6px">Success!</h3>
                  <span style="font-size:13px" id="sucsubtext">Boom</span><br><br>
                  <button type="button" class="btn btn-primary pull-right" style="background:#5cb85c;border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Okay</button>
                  <div class="clearfix"></div>
          </div>
          
        </div>
      </div>
<!-- Modal -->
</body>
</html>