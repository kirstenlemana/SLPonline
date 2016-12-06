<?php
require "../zxcd9.php";

//start post
if(!empty($_POST)) 
{ 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $id = test_input($_POST['roverid']);
       // $comment = test_input($_POST['comment']);
        date_default_timezone_set('Asia/Brunei');

        $stmt = $db->prepare("INSERT INTO hr_wallposts (wallowner, wall_msg, wallposter, wallposted) VALUES (:wallowner, :wall_msg, :wallposter, :wallposted)");
        $stmt->bindParam(':wallowner', $_POST['hrdbid']);
        $stmt->bindParam(':wall_msg', $_POST['comment']);
        $stmt->bindParam(':wallposter', $_SESSION["id"]);
        $date2 = date("Y-m-d H:i:s");
        $stmt->bindParam(':wallposted', $date2);
        $stmt->execute();

        if ($_POST['hrdbid'] != $_SESSION['id']) {
            addNotification($_POST['hrdbid'], $_SESSION['firstname'], "posted in your", "PROFILE", "http://slp.ph/hr/user.php?id=".$_POST['hrdbid']);
        }
        byteMe($_SESSION['id'],'hr_wallpost',0.25);
        echo "good";
}//end post
     
?>