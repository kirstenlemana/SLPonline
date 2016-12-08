<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) 
{ 
//filter input
//$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($_POST['action'] == "editparticipant") {
        $id = test_input($_POST['pid']);
        $remarks = test_input($_POST['remarks']);
        $parts = explode('/', $_POST['birthdate']);
        $bdate  = "$parts[2]-$parts[0]-$parts[1]";
        $stmt = $db->prepare("UPDATE PRTsupply SET
            firstname=:firstname, middlename=:middlename, lastname=:lastname, sex=:sex, birthdate=:birthdate, education=:hea, pantawidid=:pantawidid, contactnumber=:contact, height=:height, remarks=:remarks, hasNSO=:hasnso, hasNBI=:hasnbi WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':firstname', $_POST['firstname']);
        $stmt->bindParam(':middlename', $_POST['middlename']);
        $stmt->bindParam(':lastname', $_POST['lastname']);
        $stmt->bindParam(':sex', $_POST['sex']);
        $stmt->bindParam(':birthdate', $bdate);
        $stmt->bindParam(':hea', $_POST['hea']);
        $stmt->bindParam(':pantawidid', $_POST['pantawidid']);
        $stmt->bindParam(':contact', $_POST['contact']);
        $stmt->bindParam(':height', $_POST['height']);
        $stmt->bindParam(':remarks', $remarks);
        $stmt->bindParam(':hasnso', $_POST['hasnso']);
        $stmt->bindParam(':hasnbi', $_POST['hasnbi']);
        $stmt->execute();
        echo "edited";
    }
    if($_POST['action'] == "deleteparticipant") {
        $id = test_input($_POST['pid']);
        $stmt = $db->prepare("DELETE FROM PRTsupply WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
         $stmt = $db->prepare("DELETE FROM PRTsupplytags WHERE supplyrefid=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo "deleted";
    }
}//end post
?>
