<?php
require "zxcd9.php";
if(!empty($_POST)) 
{ 
    if($_POST['action'] == "submitcomment") 
    {
              $typeofcomm = $_POST['typeofcomm'];
              $subject = $_POST['subject'];
              $remarks= $_POST['remarks'];

				      try 	
                	{	
                 
                     $stmt = $db->prepare("INSERT INTO hr_feedback (type, subject, feedback ,feeddate  ,feedbacker) VALUES (:typeofcomm,:subject,:remarks,:dt,:feedbacker)");                     
                
                      $stmt->bindParam(':typeofcomm', $typeofcomm);
                      $stmt->bindParam(':subject', $subject);
                      $stmt->bindParam(':remarks', $remarks);
                      $stmt->bindParam(':dt', date("Y-m-d"));
                      $stmt->bindParam(':feedbacker', $_SESSION['id']);
                      $stmt->execute(); 
                          echo "Success";
                  } 
                catch(PDOException $e) 
                  {
                      echo "Error: " . $e->getMessage();
                  }        
    }
  else
    {
              $typeofcomm = $_POST['typeofcomm'];
              $subject = $_POST['subject']; 
              $remarks= $_POST['remarks'];

              try   
                  { 
                 
                 $stmt = $db->prepare("INSERT INTO hr_feedbackquestion (hrdbid, type, subject, feedback ,fdate) VALUES (:hrdbid,:typeofcomm,:subject,:remarks,:dt)");    
                      $stmt->bindParam(':hrdbid', $_SESSION['id']);                
                      $stmt->bindParam(':typeofcomm', $typeofcomm);
                      $stmt->bindParam(':subject', $subject);
                      $stmt->bindParam(':remarks', $remarks);
                      $stmt->bindParam(':dt', date("Y-m-d"));
                 

                      $stmt->execute(); 
                          echo "Success";
                  } 
                catch(PDOException $e) 
                  {
                      echo "Error: " . $e->getMessage();
                  }          
        } 
        
}
?>
