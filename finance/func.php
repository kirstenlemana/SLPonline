<?php
require "../zxcd9.php";

function besIsLove($idbes)
{
  try{
  $stmt2 = $db->prepare("DELETE from fin_allotments where allotid=:allotid");
  $stmt2->bindparam(':allotid',$idbes);
  $stmt2->execute();
 } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }//endtry
}



$dates = date("Y-m-d h:i:sa",time() + 86400);
$dt = date("Y-m-d",time() + 86400);
if(!empty($_POST)) 
{ 
    if($_POST['action'] == "addf") 
    {
      
              try   
                  { 
                   
                     $stmt = $db->prepare("INSERT INTO fin_admincosts
                     (
                     uacs,subaro,amount,dte,hrdbid,dateadded
                     )
                      VALUES
                      ( 
                         :uacs,
                         :subaro,
                         :amount,
                         :dt,
                         :id1,
                         :dt1                                         
                         )

                       ");
                      $stmt->bindParam(':uacs',$_POST['uacs']);
                      $stmt->bindParam(':subaro',$_POST['subaro']);
                      $stmt->bindParam(':amount', $_POST['amount']);
                      $stmt->bindParam(':dt', $_POST['dateacc']);
                      $stmt->bindParam(':id1', $_SESSION['id']);
                      $stmt->bindParam(':dt1', $dates);
                                 
                     $stmt->execute();
                  
                  } 
                catch(PDOException $e) 
                  {
                      echo "Error: " . $e->getMessage();
                  }
   

        }


if($_POST['action'] == "delallo") {
              $stmt = $db->prepare("DELETE FROM fin_allotments WHERE allotid = :id");
              $stmt->bindParam(':id',$_POST['delid']);
              $stmt->execute();
}
if($_POST['action'] == "deletenta") {
              $stmt = $db->prepare("DELETE FROM fin_nta WHERE id = :nid");
              $stmt->bindParam(':nid',$_POST['nid']);
              $stmt->execute();
              echo "deleted";
}

if($_POST['action']=="updateallot") {
    $stmt=$db->prepare("UPDATE fin_allotments SET region=:region,type=:type,subtype=:subtype,saa=:saa,uacs=:uacs,fundsource=:fundsource,fundsourceyear=:fundsourceyear,amount=:amt,d8=:d8,purpose=:purpose WHERE allotid=:eid");
    $stmt->bindparam(':eid',$_SESSION['editid1']);
    $stmt->bindParam(':region',$_POST['region']);
    $stmt->bindParam(':type',$_POST['fundtype']);
    $stmt->bindParam(':subtype', $_POST['subtype']);
    $stmt->bindParam(':saa', $_POST['saa']);
    $stmt->bindParam(':uacs', $_POST['uacs1']);
    $stmt->bindParam(':fundsource', $_POST['fundsource']);
    $stmt->bindParam(':fundsourceyear', $_POST['fundsourceyear']);
    $stmt->bindParam(':amt', $_POST['amt']);
    $stmt->bindParam(':d8', $_POST['d8']);
    $stmt->bindParam(':purpose', $_POST['purpose']);

    $stmt->execute();
    echo "success";
}
if($_POST['action']=="updatenta") {
    $parts = explode('/', $_POST['edate']);
    $datenta  = "$parts[2]-$parts[0]-$parts[1]";
    $stmt=$db->prepare("UPDATE fin_nta SET nta=:enta,nta_amount=:eamt,nta_date=:edate WHERE id=:ntaeid");
    $stmt->bindparam(':ntaeid',$_SESSION['editid']);
    $stmt->bindParam(':enta',$_POST['enta']);
    $stmt->bindParam(':eamt',$_POST['eamt']);
    $stmt->bindParam(':edate',$datenta);
    $stmt->execute();
    echo "edited";
}
if($_POST['action'] == "comment") {
        $parts = explode('/', $_POST['dte']);
        $dateondta  = "$parts[2]-$parts[0]-$parts[1]";
        $stmt = $db->prepare("INSERT INTO fin_nta(ntaid,subaro,nta,nta_amount,nta_date,hrdbid,nta_dateadded) VALUES (:ntaid,:saa,:nta,:amt,:dte,:hrdbid,:added)");
        $stmt->bindParam(':ntaid',$_POST['ntaid']);
        $stmt->bindParam(':saa',$_POST['saa']);
        $stmt->bindParam(':nta',$_POST['nta']);
        $stmt->bindParam(':amt',$_POST['amt']);
        $stmt->bindParam(':dte',$dateondta);
        $stmt->bindParam(':hrdbid',$_SESSION['id']);
        $stmt->bindParam(':added',$dt);
        $stmt->execute();

        byteMe($_SESSION['id'],'comment',0.25);
        echo "commented";
    }
if($_POST['action'] == "addfundallo") {
 

                    
              try   
                  { 
                  
                 

                     $stmt1 = $db->prepare("INSERT INTO fin_allotments
                      (region,
                        type,
                        subtype,
                        saa,
                        uacs,
                        fundsource,
                        fundsourceyear,
                        amount,
                        d8,
                        hrdbid,
                        dateadded,
                        purpose
                        )
                      VALUES
                      ( 
                         :region,
                         :type,
                         :subtype,
                         :saa,
                         :uacs1,
                         :fundsource,
                         :fundsourceyear,
                         :amt,
                         :d8,
                         :hrid,
                         :dateadd,
                         :purpose                                       
                         )

                       ");
                      $stmt1->bindParam(':region',$_POST['region']);
                      $stmt1->bindParam(':type',$_POST['fundtype']);
                      $stmt1->bindParam(':subtype', $_POST['subtype']);
                      $stmt1->bindParam(':saa', $_POST['saa']);
                      $stmt1->bindParam(':uacs1', $_POST['uacs1']);
                      $stmt1->bindParam(':fundsource', $_POST['fundsource']);
                      $stmt1->bindParam(':fundsourceyear', $_POST['fundsourceyear']);
                      $stmt1->bindParam(':amt', $_POST['amt']);
                      $stmt1->bindParam(':d8', $_POST['d8']);
                      $stmt1->bindParam(':hrid', $_SESSION['id']);
                      $stmt1->bindParam(':dateadd', $dates);
                      $stmt1->bindParam(':purpose', $_POST['purpose']);

                      $stmt1->execute();
                    }        
                catch(PDOException $e) 
                  {
                      echo "Error: " . $e->getMessage();
                  }
                  echo "success";
                



    }




}






?>
