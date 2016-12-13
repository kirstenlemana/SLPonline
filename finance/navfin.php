<script>
  function triggerClicked(str,str2) {
    console.log(str2);
  var formData = {
              'notifid'                 : str
            };
    $.ajax({
                   url: "http://slp.ph/hr/clickNotif.php",
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
    </div>
   <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Human Resources <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <li><a href="http://slp.ph/hr/add/">Add Data</a></li>
            <li><a href="http://slp.ph/hr/viewdata.php">View Data</a></li>
            <li><a href="http://slp.ph/hr/user.php?id=<?php echo $_SESSION['id']; ?>">My Profile</a></li>
            <li><a href="http://slp.ph/hr/user.php?id=<?php echo $_SESSION['id']; ?>">ROVER</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            HanapBuhay <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <li><a href="http://slp.ph/hanapbuhay/jobs.php">EF - Jobs</a></li>
            <li><a href="http://slp.ph/hanapbuhay/jobs.php">MD - Micro Ent.</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            SLPIS <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <li><a href="http://slp.ph/hanapbuhay/partners.php">Participants</a></li>
            <li><a href="http://slp.ph/hanapbuhay/jobs.php">Projects</a></li>
            <li><a href="http://slp.ph/hanapbuhay/jobs.php">EF</a></li>
            <li><a href="http://slp.ph/hanapbuhay/jobs.php">MD</a></li>
          </ul>
        </li>-->
        <li class="dropdown">
          <a href="dashboard.php">
          <img src="../images/SLP LOGO.png" width="65" height="25" alt="SLPIT">&nbsp;Finance v3</a>
        </li>
        <!--<li class="dropdown">
          <a href="wfp.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            E-Library </a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            More <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Databases</a>
                <ul class="dropdown-menu">
                  <li><a href="#">Partnerships</a></li>
                  <li><a href="#">Historical Data</a></li>
                </ul>
            </li>
            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports</a>
                <ul class="dropdown-menu">
                  <li><a href="#">Operations</a></li>
                  <li><a href="#">Finance</a></li>
                  <li><a href="#">HanapBuhay</a></li>
                  <li><a href="#">Rover</a></li>
                </ul>
            </li>
            <li class="dropdown dropdown-submenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Feedback</a>
                <ul class="dropdown-menu">
                  <li><a href="#">For Program Implementation</a></li>
                  <li><a href="#">SLPIS</a></li>
                </ul>
            </li>
            <li><a href="external.php">RPMO Directory</i></a></li>
            <li><a href="external.php">System Dev't</i></a></li>
            <li><a href="external.php">Help & Support</i></a></li>
          </ul>
        </li>-->
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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['firstname'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu slpdropsub">
            <li><a href="http://slp.ph/changepassword.php">Change Password</a></li>
            <li><a href="http://slp.ph/hr/feedback.php">My Feedback</a></li>
            <li><a href="http://slp.ph/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
