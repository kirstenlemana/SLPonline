<?php
require "../zxcd9.php";
if(isset($_POST['submit'])){
	    $file_name = $_FILES['uploadbtn2'];
		if($file_name=="") {
			die("no filez");
		} else {
			echo "asdf";
			$maxsize=50480000;
			$upl=1;
			$ext=date("mdY");
			$FILE_EXTS = array('.pdf','.jpg','jpeg','.xls','.xlsx','.doc','.docx');
			$file_name = $_FILES['docfile']['name'];
			$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
			if (!in_array($file_ext, $FILE_EXTS)){
				die("The selected file is invalid.");
			}else{
				if($_FILES['docfile']['size']>$maxsize){
						$upl=0;
			die("filesize exceeded");
				}
		        if($upl==1){
					$uploaddir = upload_dir();
					$uploadfile = $uploaddir.$_FILES['docfile']['name'];
					$a=substr($ext,0);
					$_SESSION['docup']=$a.$_FILES['docfile']['name'];
		        if(move_uploaded_file($_FILES['docfile']['tmp_name'], $uploadfile)){
					$address = getimgplace(substr($ext,0));
				        $_SESSION['dateupload']=date(r);
					}
				}//end if upload=1
			}//endifelse
		}
	}
?>
