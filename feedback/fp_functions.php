<?php
require "../zxcd9.php";




     if($_POST['action'] == "comment") {
        $id = test_input($_POST['id']);

        $stmt = $db->prepare("INSERT INTO hrf_replies (qid,message,dt,feedbacker) VALUES (:qid,:message,:dt,:feedbacker)");
        $stmt->bindParam(':qid', $_POST['qid']);
        $stmt->bindParam(':message', $_POST['message']);
        $stmt->bindParam(':dt', Date("Y-m-d"));
        $stmt->bindParam(':feedbacker', $_SESSION['id']);
        $stmt->execute();
        
        

         $stmt1 = $db->prepare("UPDATE hr_feedbackquestion set latestfeedbacker=:feedbacker1 where id=:qid");
         $stmt1->bindParam(':feedbacker1', $_SESSION['id']);
          $stmt1->bindParam(':qid', $_POST['qid']);
           $stmt1->execute(); 




        byteMe($_SESSION['id'],'comment',0.25);
        echo "commented";
    

    }


//end post
     
?>
