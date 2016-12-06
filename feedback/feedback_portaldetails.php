<?php
require "../zxcd9.php";
byteMe($_SESSION['id'],'hb_feedbackportaldetails',0.10);
 
   if(isset($_POST['subfeed'])) {
      $_SESSION['subfeed'] = $_POST['subfeed'];
      die("visitpage");
    }

    if(!empty($_GET['id'])) {
      $subfeedfilter = $_GET['id'];
      $_SESSION['subfeedfilter'] = $subfeedfilter;
    }
        $query = " 
            SELECT 
                COUNT(id) as countcurrent
            FROM hrf_replies 
            WHERE   
                qid = :engagedto
        "; 
        $query_params = array( 
            ':engagedto' => $subfeedfilter
        );
        try 
        { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) 
        { die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch();
        $countcurrent = $row['countcurrent'];


      $query="SELECT hr_feedbackquestion.subject as subject, hr_feedbackquestion.feedback as feedback, hr_db.firstname as first, hr_db.middlename as mid, hr_db.lastname as last, hr_feedbackquestion.fdate as fdate from hr_feedbackquestion INNER JOIN hr_db on hr_feedbackquestion.hrdbid=hr_db.id where hr_feedbackquestion.id=:id
      ";
      $query_params = array(':id' => $subfeedfilter);
        try 
        { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); 

        } 
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

</script>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12" style="">
      <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
        <div class="row">
          <div class="col-md-10">

                <h3 style="margin-top:0;margin-bottom:0;font-size:40px;font-weight:bold"><img src='../imgs/write.png' width='50' height='50'><?php echo $row['subject']; ?></h3>
                <span style="font-size:25px;margin-bottom:1em"><?php echo $row['feedback'].'<br>'; 
                ?></span>
                <span style="font-size:15px;margin-bottom:1em"><?php echo 'Posted by: '.$row['first'].' '.$row['mid'].' '.$row['last'].'<br>on '.$row['fdate']; ?></span>
                <br>
                 <a href="feedback_portal2.php" class="btn btn-primary btn-xs" id="back" role="button">Back</a> 
     <!-- end   -->                 
          </div>
          <div class="col-md-2" style="text-align:right">
                <h3 style="margin-top:0;margin-bottom:0;font-size:40px;margin-bottom:0" id="openingshead"><?php echo $countcurrent; ?>/<?php echo $row['numopenings']; ?></h3>
                <span style="font-size:13px;color:#555555">total replies</span>

          </div>
        </div>
  <div class="row" >
   <div class="col-md-12" ">
<!-- comment-->
            <b>Replies:</b><br>
            <table class="table table-striped" style="font-size:13px" id="commentable" > 
<!--comments-->
<col width="20%">
<col width="*">
    <?php
                $stmtcom = $db->prepare("SELECT hrf_replies.message,
                hrdb.firstname,
                hrdb.lastname,
                hrf_replies.dt,
                hrdb.region,
                hr_profilepics.name,
                hrdb.position
                from hrf_replies LEFT JOIN hr_db on hrf_replies.feedbacker=hrdb.id
                LEFT JOIN hr_profilepics on hr_profilepics.hrdbid=hrdb.id
                 WHERE hrf_replies.qid = :qid1
              
                 ");
              $stmtcom->bindParam(':qid1', $_GET['id']);
              $stmtcom->execute();
         
              while ($row7 = $stmtcom->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                $replyno = $replyno + 1;

                  echo " <tr><td><img src='../docs/".$row7[5]."' width='60' height='60' align='left' style='border-radius:50%'>
                  <span style='color:#00134d;font-size:17px;font-weight:bold;padding-left: 0.3em'>".$row7[1].' '.$row7[2]."</span>

                  <br><span style='color:#00134d;font-size:13px;padding-left:0.5em'> ".$row7[4]."</span><br><span style='color:#00134d;font-size:13px;padding-left:0.5em'> ".$row7[6]."</span>
                  </td>";
                    echo "<td><img src='../imgs/paper.png' width='20' height='20'><span style='color:#00134d;font-size:12px;'> Reply #".$replyno." on: </span><span style='color:#a6a6a6;font-size:12px'> ".$row7[3]." </span><hr style='margin-top:0em;margin-bottom:0.5em;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row7[0]."</td></tr>";
              }
              if ($stmtcom->rowCount() <= 0) {
                echo "-none-";
              }
              ?>
              <!--comments-->

              </table>
                 <br>
                <a href="#top" class="btn btn-primary btn-xs" role="button">Back to top</a> 
                 <a href="feedback_portal2.php" class="btn btn-primary btn-xs" id="back" role="button">Back</a> 

       </div>
      </div>
      </div>
     </div>
    </div>
  </div>
   <!--comment -->
<div class="row" style="margin-right:0em;margin-top:1em">
  <div class="col-md-offset-3 col-md-6 padfix padfix2" style="">
    <div style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;text-align:left;padding:1em;padding-left:2em">
   
        <div class="row">
          <div class="col-sm-10">
            <div class="form-group">
              <input class="form-control" placeholder="Type comment here.." id="commentbox" name="commentbox">
            </div>
          </div>
          <div class="col-sm-2" style="margin-left:0;padding-left:0">
            <div class="form-group">
              <button class="btn btn-primary" id="postcomment">Post</button>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<!-- comment -->
<script>
$("#postcomment").click(function(event) {
  $("#postcomment").html("...");
  document.getElementById("postcomment").disabled = true;
    var formData = {
      'action'        : "comment",
      'qid'       : "<?php echo $_GET['id']; ?>",
      'message'       : $('input[name=commentbox]').val()
    };

                $.ajax({
                   url: "fp_functions.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "commented") {
                        $("#commentable").append("<tr><td><img src='../imgs/user.png' width='60' height='60' align='left'><span style='color:#00134d;font-size:17px;font-weight:bold;padding-left:0.3em'>"+"<?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?></span><br><span style='color:#00134d;font-size:13px;padding-left: 0.3em'>Region ...</span> <br><span style='color:#00134d;font-size:13px;padding-left: 0.3em'>Position ... </span></td><td><img src='../imgs/paper.png' width='20' height='20'><span style='color:#00134d;font-size:12px'>Reply # ...</span> on:<span style='color:#a6a6a6;font-size:12px'>  (now)</span> <hr style='margin-top:0em;margin-bottom:0.5em;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+$('input[name=commentbox]').val()+"</td></tr>");
                     

                      } else {
                       alert(data);
                     
                      }
                        $("#postcomment").html("Post");
                        document.getElementById("postcomment").disabled = false;
                   }
                });
                //endAjax
}); //endpost
</script>

</body>
</html>
