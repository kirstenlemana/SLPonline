<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) { 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = test_input($_POST['id']);
        $option = test_input($_POST['option']);
        $twgname = test_input($_POST['twgname']);
        $twgremarks = test_input($_POST['twgremarks']);
        $stmt = $db->prepare("INSERT INTO hr_twgrequest (twgoption, twgname, remarks, added, addedby) VALUES (:twgoption, :twgname, :remarks, :added, :addedby)");
        $stmt->bindParam(':twgoption', $option);
        $stmt->bindParam(':twgname', $twgname);
        $stmt->bindParam(':remarks', $twgremarks);
        $stmt->bindParam(':added', date("Y-m-d"));
        $stmt->bindParam(':addedby', $_SESSION["id"]);
        $stmt->execute();
        /*
        $notify = array(683, 334, 332, 9);
        foreach($notify as $recip) {
                    addNotification($recip, $_SESSION['firstname'], "requested a change of TWG", "", "http://hr.slp.ph/viewdata/user.php?id=".$_SESSION['id']);
            }
        */
        echo "good";
}//end post
?>
