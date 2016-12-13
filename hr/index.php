<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP Online</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="http://slp.ph/css/flatbootstrap.css"/>
    <style>
body {
    background-color: #f7f9fb;
    background-size: cover;
    font-family: "Lato";
}
</style>
</head>
<body>
<div class="row" style="padding:2em">
  <div class="col-md-offset-2 col-md-8">
      <div style="border:solid 1px #c5d6de;background:#fff;text-align:center;padding:1em">
        <h2>Redirecting you to <span style="color:#00ADDe">slp.ph</span></h2>
        <h1 style="font-weight:normal;font-size:80px" id="count">5</h1>
      </div>
  </div>
</div>
<script>
i = 4;                     
function loop() {          
  if (i==0) {
    location.href = "http://slp.ph/main.php";
  }
   setTimeout(function () {
      document.getElementById("count").innerHTML = i;
      i--;
      if (i >= 0) {
         loop();
      }
   }, 1000)
}
loop();
</script>
</body>
</html>
