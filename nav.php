<?php
try {
    $stmt2 = $db->prepare("SELECT COUNT(notifid) as idz FROM notifications WHERE recipient = '".$_SESSION['id']."' AND isclicked = 0 ORDER BY notifid DESC");
    $stmt2->execute();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}//endtry
$row3 = $stmt2->fetch();
$notifs = $row3['idz'];

try {
    $stmt2 = $db->prepare("SELECT * FROM `notifications` WHERE recipient = '".$_SESSION['id']."' AND isclicked = 0 ORDER BY notifid DESC");
    $stmt2->execute();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}//endtry

$notiArray = [];
$i = 0;
while ($row2 = $stmt2->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
      for ($j=0; $j<7; $j++) {
        $notiArray[$i][$j] = $row2[$j];
      }
      $i++;
}
$linkadd = "http://".$_SERVER[HTTP_HOST];
?>
<script>
  function triggerClicked(str,str2) {
    console.log(str2);
  var formData = {
              'notifid'                 : str
            };
    $.ajax({
                   url: "<?php echo $linkadd; ?>hr/clickNotif.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "good") {
                          location.href = str2;
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
}
  </script>
<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      <a class="navbar-brand" href="<?php echo $linkadd; ?>/main.php" style="font-weight:900"><img src="<?php echo $linkadd; ?>/imgs/slpsmall.png" style="display:inline;margin-right:0.5em;margin-top:-0.17em">SLP</a>
    </div>
   <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Human Resources <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <?php
            echo "<li><a href='".$linkadd."/hr/add'>Add Record</a></li>";
            echo "<li><a href='".$linkadd."/hr/viewdata.php'>View Directory</a></li>";
            echo "<li><a href='".$linkadd."/rpmodirectory.php'>RPMO Directory</a></li>";
            ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            HanapBuhay <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <?php
            echo "<li><a href='".$linkadd."/hanapbuhay/partners.php'>Partners</a></li>";
            echo "<li><a href='".$linkadd."/hanapbuhay/jobs.php'>Jobs</a></li>";
            echo "<li><a href='".$linkadd."/hanapbuhay/supply.php'>Supply</a></li>";
            echo "<li><a href='".$linkadd."/hanapbuhay/support.php'>Support</a></li>";
            ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            E-Library <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <?php
            echo "<li><a href='".$linkadd."/vrcabinet/'>Search</a></li>";
            echo "<li><a href='".$linkadd."/vrcabinet/upload.php'>Upload</a></li>";
            ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Reports <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <?php
            echo '<li><a href="#" style="color:#888">Operations Dashboard</a></li>';
            echo "<li><a href='".$linkadd."/hbdashboard.php'>HanapBuhay Dashboard</a></li>";
            echo "<li><a href='".$linkadd."/monicadb'>Historical Data</a></li>";
            ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Others <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <?php
            echo "<li><a href='".$linkadd."/faqs.php'>FAQs</a></li>";
            echo "<li><a href='".$linkadd."/feedbackportal.php'>Feedback Portal</a></li>";
            echo "<li><a href='".$linkadd."/dev.php'>System Development</a></li>";
            ?>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav" style="float:right;">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:rgba(255,255,255,0.5);"><span class="badge nonotif" style="<?php if ($notifs > 0) { echo 'background: #e74c3c;color: #fff;'; } ?>"><?php echo $notifs; ?> &nbsp;<span class="glyphicon glyphicon-bell <?php if ($notifs >0) { echo 'spin'; } ?>"></span></span></a>
          <ul class="dropdown-menu" style="width:160px">
<?php

$i = 0;
  foreach($notiArray as $notif) {
      echo '<li style="font-size:10px;width:160px;white-space:none;border-bottom:1px solid #ccc" onclick="triggerClicked('.$notif[0].','.'\''.$notif[5].'\')"><a href="#" style="width:160px;padding-left:10px;white-space:none;"><b style="color:#00AADe">'.$notif[2].'</b> '.$notif[3].' <b>'.$notif[4].'</b></a></li>';
    $i++;
    if ($i==6) {
      echo '<li id="notifbox"><a href="http://slp.ph/hr/notifications.php" style="color:#00AADe">View more</a></li>';
      break;
    }
  }


if ($notifs == 0) {
    echo '<li id="notifbox"><a href="#">No new notifications</a></li>';
    echo '<li id="notifbox"><a href="http://slp.ph/hr/notifications.php" style="color:#00AADe">View all previous</a></li>';
}

?>            
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['firstname']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <li><a href="<?php echo $linkadd; ?>/changepassword.php">Change Password</a></li>
            <li><a href="<?php echo $linkadd; ?>/hr/user.php?id=<?php echo $_SESSION['id']; ?>">My Profile</a></li>
            <li><a href="<?php echo $linkadd; ?>/hr/feedback.php">My Feedback</a></li>
            <li><a href="<?php echo $linkadd; ?>/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>