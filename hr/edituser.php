<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) 
{ 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

   if (empty($_POST["firstname"])) {
     echo "firstname";
     die;
   } else {
     $firstname = test_input($_POST["firstname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
       echo "firstname"; 
       die;
     }
   }
   if (empty($_POST["midname"])) {
     echo "middlename";
     die;
   } else {
     $midname = test_input($_POST["midname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$midname)) {
       echo "middlename"; 
       die;
     }
   }
   if (empty($_POST["lastname"])) {
     echo "lastname";
     die;
   } else {
     $lastname = test_input($_POST["lastname"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
       echo "lastname"; 
       die;
     }
   }

   $nickname = test_input($_POST["nickname"]);
   if (!preg_match("/^[a-zA-Z ]*$/",$nickname)) {
       echo "nickname"; 
       die;
   }

   $extname = test_input($_POST["extname"]);
   if (!preg_match("/^[a-zA-Z .]*$/",$extname)) {
       echo "extname"; 
       die;
   }

   $sex = test_input($_POST["sex"]);
   if (!preg_match("/^[0-9]*$/",$sex)) {
       echo "sex"; 
       die;
   }

   if (empty($_POST["emailaddress"])) {
      echo "emailaddress";
      die;
    } else {
        $email = test_input($_POST["emailaddress"]);
        if(!filter_var($_POST['emailaddress'], FILTER_VALIDATE_EMAIL)) { 
            echo "emailaddress"; 
            die;
        } 
    }
    if (empty($_POST["birthdate"])) {
         echo "birthdate";
         die;
       } else {
         $birthdate = test_input($_POST["birthdate"]);
         if (!preg_match("/^[0-9\/]*$/",$birthdate)) {
           echo "birthdate";
           die;
         }
       }
    $contactnumber = test_input($_POST["contactnumber"]);
    if (!preg_match("/^[0-9]*$/",$contactnumber)) {
       echo "contactnumber"; 
       die;
    }
    if (empty($_POST["employdate"])) {
         echo "employdate";
         die;
       } else {
         $employdate = test_input($_POST["employdate"]);
         if (!preg_match("/^[0-9\/]*$/",$employdate)) {
           echo "employdate";
           die;
         }
       } 
    $remarks = test_input($_POST["remarks"]);
    if (!preg_match("/^[a-zA-Z0-9 _\.\!]*$/",$remarks)) {
       echo "remarks"; 
       die;
    } 


     if (empty($_POST["id"])) {
       echo "id empty";
       die;
     } else {
       $id = test_input($_POST["id"]);
       if (!preg_match("/^[a-zA-Z0-9. ]*$/",$id)) {
         echo "id"; 
         die;
       }
     }

     $position = test_input($_POST["position"]);

        $query = " 
            UPDATE hr_db 
            SET firstname = :firstname, 
                middlename = :middlename, 
                lastname = :lastname, 
                nickname = :nickname, 
                extname = :extname, 
                sex = :sex, 
                birthdate = :birthdate, 
                emailaddress = :emailaddress, 
                contactnumber = :contactnumber, 
                designation = :designation, 
                position = :position, 
                employdate = :employdate, 
                employstatus = :employstatus, 
                province = :province, 
                municipality = :municipality, 
                remarks = :remarks, 
                comptype = :comptype,
                compyear = :compyear,
                compstatus = :compstatus,
                compnotes = :compnotes
            WHERE 
                id = :id
        "; 
         
        $parts = explode('/', $_POST['birthdate']);
        $bdate  = "$parts[2]-$parts[0]-$parts[1]";

        $parts2 = explode('/', $_POST['employdate']);
        $edate  = "$parts2[2]-$parts2[0]-$parts2[1]";
        if ($_POST['comptype'] == "None issued") {
          $comptype = "";
        } else {
          $comptype = $_POST['comptype'];
        }

        if ($_POST['compyear'] == "-") {
          $compyear = "";
        } else {
          $compyear = $_POST['compyear'];
        }

        if ($_POST['compstatus'] == "-") {
          $compstatus = "";
        } else {
          $compstatus = $_POST['compstatus'];
        }
        $query_params = array( 
            ':firstname' => $_POST['firstname'], 
            ':middlename' => $_POST['midname'], 
            ':lastname' => $_POST['lastname'], 
            ':nickname' => $_POST['nickname'], 
            ':extname' => $_POST['extname'], 
            ':sex' => $_POST['sex'], 
            ':birthdate' => $bdate, 
            ':emailaddress' => $_POST['emailaddress'], 
            ':contactnumber' => $_POST['contactnumber'], 
            ':designation' => $_POST['designation'], 
            ':position' => $_POST['position'], 
            ':employstatus' => $_POST['employstatus'], 
            ':employdate' => $edate, 
            ':province' => $_POST['province'], 
            ':municipality' => $_POST['municipality'], 
            ':remarks' => $_POST['remarks'], 
            ':comptype' => $comptype,
            ':compyear' => $compyear,
            ':compstatus' => $compstatus,
            ':compnotes' => $_POST['compnotes'],
            ':id' => $id,
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params);
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run queryyy: " . $ex->getMessage()); 
        } 
        echo "loginok";
       

}//end post
     
?>