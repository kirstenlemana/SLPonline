<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) { 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = test_input($_POST['roverid']);
        $comment = test_input($_POST['comment']);
        $stmt = $db->prepare("INSERT INTO hr_RVcomments (roverid, comment, added, addedby) VALUES (:roverid, :comment, :added, :addedby)");
        $stmt->bindParam(':roverid', $id);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':added', date("Y-m-d H:i:s"));
        $stmt->bindParam(':addedby', $_SESSION["id"]);
        $stmt->execute();
        echo $_SESSION['invovled'];
        if ($stmt == true) {
            foreach($_SESSION['involved'] as $recip) {
                if ($recip != $_SESSION['id']) {
                    addNotification($recip, $_SESSION['firstname'], "posted a comment in", "ROVER", "http://slp.ph/hr/viewrover.php?id=".$id);
                }
            }
            echo "good";
        }
}//end post
?>
