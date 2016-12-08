<?php
  require "../zxcd9.php";
  if(isset($_POST['sector'])) {
    $_SESSION['sector'] = $_POST['sector'];
    die("visitpage");
  }
  if(!empty($_GET['psic'])) {
    $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $psicfilter = $_GET['psic'];
}
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
    
    <script type="text/javascript" src="http://momentjs.com/downloads/moment.min.js"></script>
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
.cl-effect-1 a::before,
.cl-effect-1 a::after {
    display: inline-block;
    opacity: 0;
    -webkit-transition: -webkit-transform 0.3s, opacity 0.2s;
    -moz-transition: -moz-transform 0.3s, opacity 0.2s;
    transition: transform 0.3s, opacity 0.2s;
}

.cl-effect-1 a::before {
    margin-right: 10px;
    content: '[';
    -webkit-transform: translateX(20px);
    -moz-transform: translateX(20px);
    transform: translateX(20px);
}

.cl-effect-1 a::after {
    margin-left: 10px;
    content: ']';
    -webkit-transform: translateX(-20px);
    -moz-transform: translateX(-20px);
    transform: translateX(-20px);
}

.cl-effect-1 a:hover::before,
.cl-effect-1 a:hover::after,
.cl-effect-1 a:focus::before,
.cl-effect-1 a:focus::after {
    opacity: 1;
    -webkit-transform: translateX(0px);
    -moz-transform: translateX(0px);
    transform: translateX(0px);
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
<?php include "../nav.php"; ?>
<script type="text/javascript" language="javascript" class="init">
var oTable = "";
$(document).ready(function() {
function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
function parseDate(str) {
                var zz = moment(str).format("M/D/Y");
                var years = moment().diff(str, 'years');
                return years;
}
function parseSex(str) {
    if (str == 0) {
      return "M";
    } else {
      return "F";
    }
}
function parseStatus(str) {
    if (str == 0) {
      return "Available";
    } else {
      return "Employed";
    }
}
function parseHEA(str) {
  if (str==1) {
    return "No Grade Completed";
  } else if (str==2) {
    return "Kinder/Daycare";
  } else if (str==3) {
    return "Elementary";
  } else if (str==4) {
    return "Elementary Graduate";
  } else if (str==5) {
    return "Junior High School";
  } else if (str==6) {
    return "Junior High School Graduate";
  } else if (str==7) {
    return "Senior High School";
  } else if (str==8) {
    return "High School Graduate";
  } else if (str==9) {
    return "Alternative Learning System Graduate";
  } else if (str==10) {
    return "Vocational Level";
  } else if (str==11) {
    return "Vocational Graduate";
  } else if (str==12) {
    return "College Level";
  } else if (str==13) {
    return "College Graduate";
  } else if (str==14) {
    return "Grad Studies (M.A., M.S., Ph.D)";
  }
}
  $.fn.DataTable.ext.pager.numbers_length = 5;
  oTable = $('#viewdata').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "orderCellsTop": true,
    "ajax": "dt_supply2.php",
    "dom": '<"top">rt<"bottom"pl><"clear">',
    "fnRowCallback":
      function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        $(nRow).attr('id', aData[0]);
        return nRow;
      },
    "aoColumnDefs": [
            { 
               "aTargets":[1],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'left');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+data[2]+', '+data[1]+'</td>';
                }
            },
            { 
               "aTargets":[3],
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+data[3]+'</td>';
                }
            },
            { 
               "aTargets":[4],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+parseSex(data[4])+'</td>';
                }
            },
            { 
               "aTargets":[5],
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+parseDate(data[5])+'</td>';
                }
            },
            { 
               "aTargets":[6],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'left');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+parseHEA(data[6])+'</td>';
                }
            },
            { 
               "aTargets":[7],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'left');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+data[7]+'</td>';
                }
            },
            { 
               "aTargets":[8],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'left');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+data[8]+'</td>';
                }
            },
            { 
               "aTargets":[10],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    if (data[10] != "") {
                      return '<td><span style="color:#5cb85c" class="glyphicon glyphicon-ok"></span></td>';
                    } else {
                      return '<td> - </td>';
                    }
                }
            },
            { 
               "aTargets":[11],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    if (data[11] > 0) {
                      return '<td><span style="color:#5cb85c" class="glyphicon glyphicon-ok"></span></td>';
                    } else {
                      return '<td> - </td>';
                    }
                }
            },
            { 
               "aTargets":[12],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    if (data[12] > 0) {
                      return '<td><span style="color:#5cb85c" class="glyphicon glyphicon-ok"></span></td>';
                    } else {
                      return '<td> - </td>';
                    }
                }
            },
            { 
               "aTargets":[13],
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+parseStatus(data[13])+'</td>';
                }
            },
            { "bVisible": false, "aTargets":[0,2,9] }
                    ]
  });
    $('#viewdata').on( 'click', 'tbody tr', function () {
        var redirection = $(this).attr('id');
        location.href="participantdetails.php?id="+redirection;
    });
});
</script>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12" style="">
      <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
          <h2 style="font-weight:bold;margin-top:0;margin-bottom:0"><?php echo $_SESSION['sector']; ?></h2>
          <?php echo $row['region']; ?><br>
          <div class="row">
          <script>
          function filterRegion() {
              var sectorvalue = document.getElementById("subsectorfilter").value;
              //oTable.fnFilter(regionvalue,6);
              oTable.fnFilter(sectorvalue, 3, true, false, true);
          }
          </script>
              <div class="form-group col-md-4" style="margin-top:1em" onchange="filterRegion();">
                <select class="form-control" id="subsectorfilter">
                  <option value="" selected>Filter by Sub-sector</option>
                  <?php
                      $query = "SELECT DISTINCT tag FROM PRTsupplytags WHERE sector='".$_SESSION['sector']."'"; 
                      try 
                      { $stmt = $db->prepare($query); $result = $stmt->execute(); } 
                      catch(PDOException $ex) 
                      { die("Failed to run query: " . $ex->getMessage()); } 
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                         echo "<option>".$row['tag']."</option>";
                      }
                  ?>
                  <option value=""><i>--Reset Filter--</i></option>
                </select>
              </div>
              <div class="form-group col-md-4" style="margin-top:1em">
                <input class="form-control" placeholder="Search participant.." id="searchbox">
              </div>
          </div>
            <div class="col-md-12" id="tableHolder" style="margin-top:1em;margin-bottom:2em">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata" style="background-color:#fff;margin-bottom:2em">
        <thead>
          <td style="background-color:#000;color:#fff" colspan="14">Program Participants</td>
          <tr>
          <th>id</th>
          <th>Name</th>
          <th>Last Name</th>
          <th>Sub-Sector(s)</th>
          <th>Sex</th>
          <th>Age</th>
          <th>HEA</th>
          <th>Province</th>
          <th>City/Muni.</th>
          <th>Sector</th>
          <th>4Ps</th>
          <th>NSO</th>
          <th>NBI</th>
          <th>Status</th>
          </tr>
        </thead>
        </table>
            </div>
            <center>
            <a href="supply.php"><button class="btn btn-info">Go Back</button></a><br><br>
        </div>
      </div>
    </div>
    <div class="col-md-2"></div>
</div>
<script>
$("#searchbox").keyup(function() {
   oTable.fnFilter(this.value);
});
$(document).ready(function() {
key = '<?php echo $row['region']; ?>';
console.log('<?php echo $psicfilter; ?>');
$("#loadicon").hide();

$("#formsubmit").click(function() {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#statusdisp").html('');
  $('#supplyForm').bootstrapValidator('validate');
  return false;
}); //endHRSUBMIT
});
</script>
</body>
</html>
