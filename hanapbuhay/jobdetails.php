<?php
require "../zxcd9.php";
    if(isset($_POST['sector'])) {
      $_SESSION['sector'] = $_POST['sector'];
      die("visitpage");
    }
    if(!empty($_GET['id'])) {
      $jobfilter = $_GET['id'];
      $_SESSION['jobid'] = $jobfilter;
    }
        $query = " 
            SELECT 
                COUNT(id) as countcurrent
            FROM PRTsupply 
            WHERE 
                engagedto = :engagedto
        "; 
        $query_params = array( 
            ':engagedto' => $jobfilter
        );
        try 
        { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch();
        $countcurrent = $row['countcurrent'];
        $query = " 
            SELECT 
                k.orgname, 
                z.sector, 
                GROUP_CONCAT(DISTINCT z.tag SEPARATOR ',') tag, 
                m.jobname, 
                m.numopenings, 
                m.startdate, 
                m.workingdays, 
                m.workinghours, 
                m.employstatus, 
                m.intervention, 
                m.salary, 
                m.encoded, 
                m.region, 
                m.province, 
                m.municipality, 
                m.description, 
                m.partner, 
                m.status, 
                m.reviewed, 
                m.engaged, 
                m.approved, 
                m.completed, 
                m.encodedby, 
                p.firstname, 
                p.region 
            FROM PRTdemand m 
            LEFT JOIN PRTdemandlocs t 
            ON m.id=t.refid 
            LEFT JOIN PRTdemandtags z
            ON m.id=z.demandid
            LEFT JOIN PRTemployers k
            ON m.partner=k.id
            LEFT JOIN hr_db p 
            ON m.encodedby=p.id
            WHERE 
                m.id = :id
        "; 
        $query_params = array( 
            ':id' => $jobfilter
        );
        try 
        { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) 
        { die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch();
        $regionfilter = $row['region'];
        $jobstatus = $row['status'];
        $_SESSION['sector'] = $row['sector'];

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
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
    <script src="../js/DTbootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
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
.successcontent {
    display:none;
}
.cleanselect {
    -webkit-appearance:none;
    -moz-appearance:none;
    -ms-appearance:none;
    appearance:none;background:#fff url(../imgs/arrows.png) no-repeat right 9px;
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
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #2c3e50;
    color: #fff;
}
.highlightyellow {
    background: rgba(251, 243, 21, 0.3);
}
.highlight {
    background: rgba(92, 184, 92, 0.2);
}

.tagged {
    -moz-border-radius: 4px;
    border-radius: 3px;
    -webkit-border-radius: 4px;
    border: 1px solid #000;
    background: none;
    background-color: #000;
    font-weight: normal;
    color: #fff;
    margin-top: 5px;
    font-size: 14px;
    text-align: left;
    padding: 5px;
    margin-right: 5px;
}
</style>
</style>
</head>
<body>
<?php
  include "../nav.php";
?>
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
$("#canceljob").click(function(){
                $.ajax({
                   url: "canceljob.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "loginok") {
                        $("#loadicon").hide();
                        $("#statusdisp").html('<font color="green">Success!</font>');
                        document.getElementById("formsubmit").disabled = false;
                        document.getElementById("formsubmit").classList.remove("disabled");
                        $("#formsubmit").html('Register');
                      } else {
                        $("#statusdisp").show();
                        $("#statusdisp").html(data);
                        document.getElementById("formsubmit").disabled = false;
                        document.getElementById("formsubmit").classList.remove("disabled");
                        $("#formsubmit").html('Submit');
                        $("#loadicon").hide();
                      }
                      return false;
                   }
                });//endAjax
});
//oTable.fnFilter('<?php $psicfilter="construction"; echo $psicfilter;?>',1);
});
</script>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12" style="">
      <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
        <div class="row">
          <div class="col-md-9">
                <h3 style="margin-top:0;margin-bottom:0;font-size:40px;font-weight:bold"><?php echo $row['jobname']; ?></h3>
                <span style="font-size:20px;margin-bottom:1em"><?php echo $row['orgname']; ?></span><br>
                <span style="font-size:16px;margin-bottom:1em"><?php echo $row['intervention']; ?> - <?php echo $row['employstatus']; ?></span>
                <br><br>
                  <span style="margin-bottom:0.5em;display:block"><?php echo $row['sector']; ?></span>
                  <?php
                          $jobtagrow = $row['tag'];
                          $jobtags = explode(',', $jobtagrow);
                          foreach ($jobtags as $value) {
                            echo "<span class='tagged' style='margin-bottom:2em'>".$value."</span>";
                          }
                  ?><br><br>
                  <span style="margin-top:2em">
                  Expected Salary: <span style="color:#00AADe"><?php echo $row['salary']; ?></span><br>
                  Working Days: <span style="color:#00AADe"><?php echo $row['workingdays']; ?></span><br>
                  Working Hours: <span style="color:#00AADe"><?php echo $row['workinghours']; ?></span></span>
                  <br><br>
                  <div style="background:#d8d8d8;border:1px solid #000;padding:0.5em"><?php echo $row['description']; ?></div>
                  <br>Encoded by: <?php echo $row['firstname']; ?> (<?php echo $row['region']; ?>)
          </div>
          <div class="col-md-3" style="text-align:right">
                <h3 style="margin-top:0;margin-bottom:0;font-size:40px;margin-bottom:0" id="openingshead"><?php echo $countcurrent; ?>/<?php echo $row['numopenings']; ?></h3>
                <span style="font-size:13px;color:#555555">Openings</span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" style="text-align:left;margin-top:1em">
            <?php
              if ($_SESSION['permlvl']>0||$_SESSION['id']==$row['encodedby']) { ?>
            <a href="jobs_edit.php?id=<?php echo $_GET['id']; ?>"><button id="editjob" class="btn btn-info pull-left">Edit Job</button></a> &nbsp; 
             &nbsp; <button id="deljob" class="btn btn-danger pull-left" style="margin-left:5px">Delete Job</button>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div><!--endrow-->
  <div class="row" style="margin-bottom:2em">
    <div class="col-md-12" style="">
      <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
        <h3 style="margin-top:0;margin-bottom:0em;font-size:20px;font-weight:bold">PARTICIPANTS</h3>
        This list displays all participants that match the given job's sector. Select or deselect participants then click on "Save" below.<br>
          <div id="tabler" style="display:none;margin-top:1em;">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata" style="background-color:#fff;width:100%">
                          <thead>
                            <tr>
                              <th></th>
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
                        <br><br><center><span id="btnspan"></span>
            </div>
      </div>
    </div>
  </div>
<script>
                      $("#tabler").show();
                      $("#openingshead").html("<?php echo $countcurrent; ?>/<?php echo $row['numopenings']; ?>");
                      $("#btnspan").html('<button class="btn btn-info" id="approve">Save Selection</button>');
                      function selectedBox(str) {
                        return str;
                      }
                      function parseSex(str) {
                        if (str == 0) {
                          str = "M";
                        } else {
                          str = "F";
                        }
                        return str;
                      }
                      function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
function parseDate(str) {
                var zz = moment(str).format("M/D/Y");
                return zz;
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
clickedRows = [];
  $.fn.DataTable.ext.pager.numbers_length = 5;
  oTable = $('#viewdata').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "orderCellsTop": true,
    "ajax": "dt_supply2.php",
    "fnRowCallback":
          function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            switch(aData[13]){
                case "1":
                    $(nRow).addClass("highlight");
                    clickedRows.push(parseInt(aData[0]));
                    break;
                case 'BBBB':
                    $(nRow).css('color', 'green')
                    break;
            }
            $(nRow).attr('id', aData[0]);
            $(nRow).attr('status', aData[13]);
            return nRow;
          },
    "dom": '<"top">rt<"bottom"pl><"clear">',
    "aoColumnDefs": [
            { 
                 "aTargets":[0],
                 "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                  {
                      $(nTd).css('text-align', 'left');
                  },
                  "mData": null,
                  "mRender": function( data, type, full) {
                      if (data[13] == 1) {
                        return '<td><input type="checkbox" id="'+data[0]+'" checked></td>';
                      } else {
                        return '<td><input type="checkbox" id="'+data[0]+'"></td>';
                      }
                  }
              },
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
                    return '<td>'+toTitleCase(data[7])+'</td>';
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
                    return '<td>'+toTitleCase(data[8])+'</td>';
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
            { "bVisible": false, "aTargets":[2,9] }
                    ]
  });

  $('#viewdata').on( 'click', 'tbody tr', function (e) {
          var redirection = $(this).attr('id');
          var status = $(this).attr('status');
          var isCheckbox = $(e.target).is(":checkbox");
          var xx = jQuery(this).closest('tr').find('[type=checkbox]').prop('checked');
          var yy = $(e.target).prop('checked');

        if (status == 2) {
          alert("You are trying to select a participant that is no longer available.");
          e.preventDefault();
        } else {
          if (isCheckbox) {
            console.log("this is a checkbox");
                        if (yy == true) {
                          jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
                          clickedRows.push(parseInt(redirection));
                          $(this).addClass("highlight");
                          console.log("adding to array:"+redirection);
                        } else {
                          jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', false);
                          for(var i in clickedRows){
                              if(clickedRows[i]==redirection){
                                  clickedRows.splice(i,1);
                                  console.log("removing from array:"+redirection);
                                  break;
                                  }
                          }
                          $(this).removeClass("highlight");
                        }
                        console.log("ARRAY"+clickedRows);
          } else if (!isCheckbox) {
            console.log("this is not a checkbox");
                          if (xx == false) {
                            clickedRows.push(parseInt(redirection));
                            $(this).addClass("highlight");
                            jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', true);
                            console.log("adding to array:"+redirection);
                          } else {
                            for(var i in clickedRows){
                                if(clickedRows[i]==redirection){
                                    clickedRows.splice(i,1);
                                    console.log("removing from array:"+redirection);
                                    break;
                                    }
                            }
                            $(this).removeClass("highlight");
                            jQuery(this).closest('tr').find('[type=checkbox]').prop('checked', false);
                            
                          }
                          console.log("ARRAY"+clickedRows);
          }//endifcheckbox
        }
          
        });
</script>

</div><!--end container-->
<script>
$("#editjob").click(function() {

});

$("#approve").click(function() {

  event.preventDefault();
  event.stopImmediatePropagation();
  $("#approve").html("Processing..");
  var formData = {
      'id'       : '<?php echo $_GET["id"];?>',
      'status'       : '2',
      'participants' : clickedRows.toString()
  };
  $.ajax({
       url: "addstatus.php",
       type: "POST",
       data: formData,
       success: function(data)
       {
          if (data == "good") {
            alert("Success!");
            location.reload();
          } else {
            alert(data);
          }
          return false;
       }
    });//endajax
});
$("#deljob").click(function(event) {
    var r = confirm("You are about to delete a job. This will be recorded. Are you sure?");
    if (r == true) {
      var formData = {
      'jobid'        : "<?php echo $_GET['id']; ?>"
      };
                $.ajax({
                   url: "deljob.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "good") {
                        alert("Success!")
                        location.href = "jobs.php";
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
    }
  });
</script>
</body>
</html>
