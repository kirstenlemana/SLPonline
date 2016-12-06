<?php require "../zxcd9.php";
byteMe($_SESSION['id'],'hb_feedbackportal',0.10);
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
            ':id' => $_SESSION['id'] 
        );
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
  -webkit-appearance:none;-moz-appearance:none;-ms-appearance:none;appearance:none;background:#fff url(../imgs/arrows.png) no-repeat right 9px;
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

#slideout {
      z-index: 998;
      position: fixed;
      top: 70%;
      right: 0;
      width: 35px;
      padding: 12px 0;
      text-align: center;
      background: #5cb85c;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
      -webkit-border-radius: 5px 0px 0px 5px;
      -moz-border-radius: 5px 0px 0px 5px;
      border-radius: 5px 0px 0px 5px;
    }
    #slideout_inner {
      z-index: 999;
      position: fixed;
      top: 70%;
      right: -250px;
      background: #5cb85c;
      width: 250px;
      padding: 0;
      height: 170px;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
      text-align: left;
      -webkit-border-radius: 0px 0 0px 5px;
      -moz-border-radius: 0px 0 0px 5px;
      border-radius: 0px 0 0px 5px;
    }
    #slideout_inner textarea {
      z-index: 999;
      margin-right: 5px;
      width: 210px;
      height: 100px;
      margin-bottom: 6px;
    }
    #slideout:hover {
      z-index: 999;
      right: 250px;
    }
    #slideout:hover #slideout_inner {
      z-index: 999;
      right: 0;
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
    #search-text-input{
    border-top:thin solid  #e5e5e5;
    border-right:thin solid #e5e5e5;
    border-bottom:0;
    border-left:thin solid  #e5e5e5;
    box-shadow:0px 1px 1px 1px #e5e5e5;
    float:left;
    height:17px;
    margin:.8em 0 0 .5em; 
    outline:0;
    padding:.4em 0 .4em .6em; 
    width:500px; 
}
  
#button-holder{
    background-color:#f1f1f1;
    border-top:thin solid #e5e5e5;
    box-shadow:1px 1px 1px 1px #e5e5e5;
    float:left;
    height:38px;
    margin:11px 0 0 0;
    text-align:center;
    width:50px;
}
  
#button-holder img{
    margin:4px;
    width:30px; 
}
.dataTables_filter, .dataTables_info { display: none; }
</style>
</style>
</head>
<body>
<?php include '../nav.php'; ?>


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

    "ajax": "dt_feedbackportal.php",
  
    "dom": '<"top">rtp<"bottom"f>',
    "fnRowCallback":
      function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        $(nRow).attr('id', aData[0]);
        $(nRow).attr('subfeed', aData[1]);
        
        return nRow;
      },
    "aoColumnDefs": [
      { 
               "aTargets":[0],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('width', 10);

                }

            },
           
       { 
               "aTargets":[1],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('width', 50);

                 
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+'<img src="../imgs/GROUP.png" width="50" height="50">'+'</td>';


                }
            },

            { 
               "aTargets":[2],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('width', 1300);
                    $(nTd).css( 'text-transform','capitalize')
                   // $(nTd).css('font-weight','bold');
                 
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+'<img src="../imgs/pin.png" width="20" height="20">'+'<b>'+data[1]+'</b>'+'<br>'+'<span style="font-size:13px">'+'posted by: '+data[2]+' '+data[3]+' '+data[4]+'</span>'+'</td>';
                }
            },
     { 
               "aTargets":[6],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('width', 180);

                 
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+' <span style="font-size:13px">'+data[5]+'&nbsp;&nbsp;'+'Comments '+'</span>'+'</td>';


                }
            },
                  
    { 
               "aTargets":[7],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('width', 250);

                 
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+' <span style="font-size:13px">'+data[6]+'&nbsp;&nbsp;'+'<br>'+'by '+data[7]+'</span>'+'</td>';


                }
            },




           
            { "bVisible": false, "aTargets":[0,3,4,5] }
                    ]
  });
  $('#viewdata').on( 'click', 'tbody tr', function () {
          var redirection = $(this).attr('id');
          var redirection2 = $(this).attr('subfeed');
          var formData = { 'subfeed' : redirection2 };
                  $.ajax({
                    type: "POST",
                    url: "feedback_portaldetails.php",
                    data: formData,
                    success: function(data) {
                            if (data == "visitpage") {
                              location.href="feedback_portaldetails.php?id="+redirection;
                            }
                          }

                    });
  });

$(document).ready(function() {
  tableshown=false;
$("#search-text-input").keyup(function() {
   if (tableshown==false) {
      tableshown=true;
   }
   oTable.fnFilter(this.value);
}); 
});

});
</script>
<div class="container-fluid">
    <div class="row">
      <div style="background-color:#fff;height:90%;padding:2em;padding-bottom:4em">
      
        <div id="tableHolder" class="col-md-12" style="border:0px solid #000;margin-bottom:2em">
        
              <h3 align="center"><img src="../imgs/slplogo_med.png" width="100" height="100">&nbsp;&nbsp;Sustainable Livelihood Program ( SLP ) Forum </h3>
              <br/>
         
<script>
function filterProvince() {
      var regionvalue = document.getElementById("provincefilter").value;
      if (regionvalue == "") {
        oTable.fnFilter("", 4, false);
      } else {
        oTable.fnFilter("^"+regionvalue+"$", 4, true);
      }
}
            </script>
 <div class="row">
         
          <div class="col-md-11" id="searchblock" style="padding:2em;">
                <div style="margin-top:2em">
                  <div class="form-group">
                      <input id="search-text-input" class="form-control" placeholder="Search keywords.." style="height:38px;text-align:center;padding-left:0"/><center>

                     <div id="button-holder" >
                      <img src="../imgs/mg.png"  id="mg">
                    </div>
                  </div>
                </div>
          </div>
          <div class="col-md-1">
                <br/><br/><br/><br/>
                 <a href="../feedback_portal.php" class="btn btn-info btn-sm" id="create" role="button">Create new thread</a> 
          </div>
                
      </div>

                  <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata">
                    <thead>
                      <tr>
                      <th>ID</th>
                      <th></th>
                      <th >FEEDBACK</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th>NO. OF COMMENTS</th>     
                      <th>LATEST REPLY</th>
                     
                      </tr>
                    </thead>
                  </table>



          </div>



                           
                 <div class="row">

                  <div class="col-md-12" >
                  <p align="right">      <a href="../feedback_portal.php" class="btn btn-info btn-sm" id="create" role="button">Create new thread</a> </p>
               
                  </div>
                 
              </div>  

        </div>

     
 

    </div><!--endrow-->
   <!--container-->


</body>
</html>
