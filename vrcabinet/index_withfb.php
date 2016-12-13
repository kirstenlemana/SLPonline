<?php 
    require "zxcd9.php";
    require_once 'fbsdk/src/Facebook/autoload.php';
    $fb = new Facebook\Facebook([
      'app_id' => '549469675232922',
      'app_secret' => '1ef3769dd214f7083128f3504b9649fd',
      'default_graph_version' => 'v2.6',
    ]);
    //// get following data from the db or just replace them ////
    $title = "Auto Post on Facebook Using PHP SDK v5";
    $targetUrl = "http://www.tricksofit.com/2015/08/auto-post-on-facebook-using-php-sdk-v5";
    $imgUrl = "http://www.tricksofit.com/wp-content/uploads/2015/08/Auto-Post-on-Facebook-Using-PHP-SDK-v5.png";
    $description= "This tutorial will help you to auto post on Facebook using PHP. For this you need FB app with App ID, App secret, PHP SDK 5.0 and access token of the user.";
    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes']; // optional
    $loginUrl = $helper->getLoginUrl('http://localhost:8888/SLP.PH/OFFICE/login-callback.php', $permissions);
    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>SLP | Office</title>
        <meta name="description" content="SLP DSWD Livelihood"/>
        <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
        <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
        <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
        <script src="js/jquery-1.10.2.min.js"></script>
        <link rel="stylesheet" href="css/flatbootstrap.css"/>
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
    .disabled {
        background:rgba(1,1,1,0.2);
        border:0px solid;
        cursor:progress;
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
    #slideout {
        z-index: 998;
        position: fixed;
        top: 25%;
        left: 0;
        width: 35px;
        padding: 12px 0;
        text-align: center;
        background: #6DAD53;
        -webkit-transition-duration: 0.3s;
        -moz-transition-duration: 0.3s;
        -o-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-border-radius: 0 5px 5px 0;
        -moz-border-radius: 0 5px 5px 0;
        border-radius: 0 5px 5px 0;
        }
        #slideout_inner {
        z-index: 999;
        position: fixed;
        top: 25%;
        left: -250px;
        background: #6DAD53;
        width: 250px;
        padding: 0;
        height: 165px;
        -webkit-transition-duration: 0.3s;
        -moz-transition-duration: 0.3s;
        -o-transition-duration: 0.3s;
        transition-duration: 0.3s;
        text-align: left;
        -webkit-border-radius: 0 0 5px 0;
        -moz-border-radius: 0 0 5px 0;
        border-radius: 0 0 5px 0;
        }
        #slideout_inner textarea {
        z-index: 999;
        width: 190px;
        height: 100px;
        margin-bottom: 6px;
        }
        #slideout:hover {
        z-index: 999;
        left: 250px;
        }
        #slideout:hover #slideout_inner {
        z-index: 999;
        left: 0;
        }
        .login-block {
        width: 20em;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        border: 1px solid #e1e2e3;
        border-top: 5px solid #1a242f;
        margin: 1px auto;
    }
        .status-block {
        width: 355px;
        margin-top: 20px;
        padding: 10px;
        padding-top: 10px;
        background: #f2dede;
        border-radius: 5px;
        border: 1px solid #f84040;
        color: #f84040;
        display: none;
    }
        .status-accept {
        width: 355px;
        margin-top: 20px;
        padding: 10px;
        background: #dff0d8;
        border-radius: 5px;
        border: 1px solid #3c763d;
        color: #3c763d;
        display: none;
    }
        .login-block h1 {
        text-align: center;
        color: #000;
        font-size: 20px;
        text-transform: uppercase;
        margin-top: 0;
        margin-bottom: 20px;
    }
        .login-block input {
        width: 100%;
        height: 42px;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 16px;
        padding: 0 20px 0 50px;
        outline: none;
    }
        .login-block input#username {
        background: #fff url('imgs/usericon.png') top no-repeat;
        background-position: 15px, 7px;
    }
        .login-block input#password {
        background: #fff url('imgs/keyicon.png') top no-repeat;
        background-position: 15px, 7px;
    }
        .login-block input:active, .login-block input:focus {
        border: 1px solid #000;
    }
        .login-block button {
        width: 100%;
        height: 40px;
        background: #1a242f;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #1a242f;
        color: #fff;
        font-weight: 900;
        text-transform: uppercase;
        font-size: 16px;
        font-family: "Lato";
        outline: none;
        cursor: pointer;
    }
        .login-block button:hover {
        opacity: 0.8;
    }
        .login-block button.disabled {
        background-color: #ccc;
        border-color: #ccc;
    }
    a,a:active,a:hover, a:focus {
        color: #2c3e50;
        text-decoration: none;
    }
        .modalDialog {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(1, 1, 1, 0.7);
        z-index: 99999;
        opacity:0;
        -webkit-transition: opacity 400ms ease-in;
        -moz-transition: opacity 400ms ease-in;
        transition: opacity 400ms ease-in;
        pointer-events: none;
    }
        .modalDialog:target {
        opacity:1;
        pointer-events: auto;
    }
        .modalDialog > div {
        width: 20em;
        position: relative;
        margin: 10% auto;
        padding: 5px 20px 13px 20px;
        border-radius: 10px;
        background: #fff;
    }
        .close {
        background: #fff;
        color: #000;
        line-height: 25px;
        position: absolute;
        right: 6px;
        text-align: center;
        top: 6px;
        width: 24px;
        text-decoration: none;
        font-weight: bold;
    }
        .modalDialog input {
        width: 100%;
        height: 42px;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 16px;
        padding: 0 10px 0 10px;
        outline: none;
    }
        .good {
        color: #5cb85c;
    }
        .bad {
        color: red;
    }
        .pads {
        margin-bottom: 1em;
    }
        .padstop {
        margin-top: 1em;
    }
        .checkbox label {
        min-height: 20px;
        padding-left: 20px;
        margin-bottom: 0;
        font-weight: 400;
        cursor: pointer;
    }
    label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 700;
    }
        .lead {
        font-size: 21px;
        font-weight: 200;
        margin-bottom: 20px;
    }
    </style>
    </head>
    <body>
      <div id="slideout">
        <img src="http://img.usabilitypost.com.s3.amazonaws.com/1104/css_slideout/feedback.png" alt="Feedback" />
        <div id="slideout_inner">
          <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="color:#fff;font-size:50px;padding:10px;display:none"></span>
          <div id="formz">
          <form>
              <div class="form-group">
                <div class="col-sm-12">
                    <textarea name="feedback" maxlength="250" class="form-control" id="feedback" placeholder="Any comments or suggestions are welcome!" style="resize:none;padding-top:8px;padding-bottom:8px;" rows="3"></textarea>
                </div>
              </div>
          </form>
              <div class="form-group">
                  <button class="btn btn-primary" id="sendfeedback" style="padding:4px;margin-left:1em">Submit</button>
              </div>  
          </div>
        </div>
      </div>
    <nav class="navbar navbar-default navbar-static-top" >
      <div class="container">
        <div class="navbar-header" >
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="font-weight:900"><img src="imgs/slpsmall.png" style="display:inline;margin-right:0.5em;margin-top:-0.19em">SLP</a>
        </div>
       <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <!--<li style="color:#042d49"><a href="#" >Human Resources</a></li>-->
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" id="maincontent" style="margin-top:3em;margin-bottom:1em;text-align:center">
                  <img src="imgs/slpangel.png" style="max-width:12em;display:none" id="angelimg">
            </div>
        </div>
        <div class="row">
          <br>
          <div class="login-block" id="loginblock" style="display:none">
            <form action="" method="post" id="login" autocomplete="off">
              <input type="text" placeholder="Email" id="username" name="email" required style="margin-bottom:5px" value="<?php
    echo $_COOKIE['rememberme']; ?>"/>
              <input type="password" value="" placeholder="Password" id="password" name="password" required style="margin-bottom:0.6em"/>
              <center>
              <div class="checkbox" style="display:inline;margin:0;padding:0;height:1px;margin-bottom:0.7em;text-align:center">
                <label style="margin:0;margin-bottom:0.6em;padding:0;margin-left:20px;text-align:center"><input type="checkbox" id="remember" name="remember" value="" style="width:1em;height:15px" <?php if(isset($_COOKIE['rememberme'])) {
        echo 'checked';
      }
      else {
        echo '';
      }
      ?>>Remember Me</label>
              </div>
              <button id="status" >Log in</button><br></form>
              <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="font-size:30px;display:none"></span>
              <div id="statusdisp" class="padstop" style="color:red;text-align:center;display:none"></div>
              <br><center>
              <a href="#openModal"><font size="3px">Forgot your password?</font></a>
          </div>
        </div>
      </div>
    </div>
    <div id="openModal" class="modalDialog">
        <div> <a href="#close" title="Close" class="close">X</a>
              <h2>Forgot Password</h2>
            <p>Please enter your registered email address below. We will send you a link for password recovery.</p>
            <div id="errors" class="bad"></div>
            <form action="" method="post" id="forgotForm" autocomplete="off">
            <input name="emailadd" id="emailadd" placeholder="you@youremail.com" style="margin-bottom:0.5em;margin-top:1em;"> 
            <button type="submit" id="forgotsend" style="margin-bottom:1em">Submit</button>
            </form>
        </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
            $("#angelimg").hide().delay( 400 ).fadeIn( 500 );
            $("#loginblock").hide().delay( 1000 ).slideDown( 400 );
            $("#sendfeedback").click(function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
            $("#loadicon").show();
            $("#feedback").hide();
            $("#sendfeedback").html('Processing..');
        document.getElementById("sendfeedback").classList.add("disabled");
        document.getElementById("sendfeedback").disabled = true;
        var formData = {
          'page'        : "angel_index",
          'feedback'    : $('textarea[name=feedback]').val(),
          'feedbacker'    : "<?php echo $_SESSION['id']; ?>"
        };
                    $.ajax({
                       url: "sendfeedback.php",
                       type: "POST",
                       data: formData,
                       success: function(data)
                       {
                          if (data == "good") {
                            $("#loadicon").hide();
                            document.getElementById("formz").innerHTML = "<div style='padding:10px;color:#fff'><h2>Feedback Sent!</h2>Thank you!</div>"
                          } else {
                            alert(data);
                            $("#loadicon").hide();
                            $("#feedback").show();
                            $("#sendfeedback").html('Submit');
                            document.getElementById("sendfeedback").classList.remove("disabled");
                            document.getElementById("sendfeedback").disabled = false;
                          }
                          return false;
                       }
                    });//endAjax
      }); //endHRSUBMIT
    $("#forgotForm").submit(function() {
      event.preventDefault();
      $("#errors").html("Processing..");
      document.getElementById("forgotsend").classList.add("disabled");
      document.getElementById("forgotsend").disabled = true;
      var forgotData = {
          'emailaddress'       : $('input[name=emailadd]').val()
      };
      $.ajax({
           url: "forgot.php",
           type: "POST",
           data: forgotData,
           success: function(data)
           {
              if (data == "loginok") {
                $("#errors").html('Success! Password recovery has been sent to your email.');
                document.getElementById("errors").classList.remove("bad");
                document.getElementById("errors").classList.add("good");
                document.getElementById("errors").classList.add("pads");
                $("#emailadd").hide();
              } else {
                $("#errors").html("Specified email was not found in database.");
                document.getElementById("forgotsend").classList.remove("disabled");
                document.getElementById("forgotsend").disabled = false;
              }
           }
        });//endajax
    });
    $("#status").click(function(event) {
      event.preventDefault();
      event.stopImmediatePropagation();
            $("#statusdisp").hide();
            $("#loadicon").show();
            $("#loadicon").addClass("spin");
            $("#loadicon").addClass("padstop");
            $("#status").html('Processing..');
            document.getElementById("status").classList.add("disabled");
            document.getElementById("status").disabled = true;
    var formData = {
          'emailaddress'       : $('input[name=email]').val(),
          'password'           : $('input[name=password]').val(),
          'rememberme'         : document.getElementById("remember").checked
        };
        $.ajax({
           url: "login2.php",
           type: "POST",
           data: formData,
           success: function(data)
           {
              if (data == "loginok") {
                $("#loadicon").hide();
                $("#statusdisp").html('<font color="green">Success!</font>');
                document.getElementById("statusdisp").classList.add("good");
                $("#statusdisp").show();
                window.location.href = "main.php";
              } else if (data == "alreadyin") {
                $("#loadicon").hide();
                $("#statusdisp").html('Already logged in.');
                document.getElementById("statusdisp").classList.add("bad");
                $("#statusdisp").show();
                $("#status").html("LOG IN");
                document.getElementById("status").classList.remove("disabled");
                document.getElementById("status").disabled = false;
              } else {
                $("#loadicon").hide();
                $("#statusdisp").html('Incorrect login.');
                document.getElementById("statusdisp").classList.add("bad");
                $("#statusdisp").show();
                $("#status").html("LOG IN");
                document.getElementById("status").classList.remove("disabled");
                document.getElementById("status").disabled = false;
              }
              return false;
           }
        });//endajax
    return false;
      });
    });
</script>
</body>
</html>
S
