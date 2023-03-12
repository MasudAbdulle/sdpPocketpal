<html>
<form action="" method="post" enctype="multipart/form-data">
 <label for="pdf">PDF Uploader</label>
 <input type="file" name="pdf" id="pdf">
 <input type="submit" value="Upload">
 <small> <strong>Note:</strong> Only pdf files are to be uploaded. With a maximum size of 5MB</small>
</form>
</html>


<?php


require_once('tcpdf/tcpdf.php');
//if the file is uploaded by clicking the upload button
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
 //if the file is uploaded with any errors encounterd
 if(isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0){
 //setting the allowed file format
 $allowed = array("pdf" => "application/pdf");
//getting the files name,size and type using the $_FILES //superglobal
 $filename = $_FILES['pdf']['name'];
 $filesize = $_FILES['pdf']['size'];
 $filetype = $_FILES['pdf']['type'];
//verifying the extention of the file
 $ext = pathinfo($filename,PATHINFO_EXTENSION);
 if(!array_key_exists($ext,$allowed)) die("Error: the file format is not acceptable");
//verifying the file size
 $maxsize = 5 * 1024 * 1024;
 if($filesize > $maxsize) die("Error: file size too large!!");
if(in_array($filetype,$allowed)){
if(file_exists("upload/".$filename)){
 die("Sorry the file already exists");
 }else{
 move_uploaded_file($_FILES['pdf']['tmp_name'],"upload/".$filename);
 echo "File was uploaded successfully <br>";
 }
}else{
 echo "Sorry a problem was encountered when trying to upload data!!";
 }
}else{
 echo "Error: ". $_FILES['pdf']['error'];
 }
//extra information describing the successfully uploaded file
 if($_FILES['pdf']['error'] == 0){
 echo "Filename: ". $_FILES['pdf']['name'] ."<br>";
 echo "Filetype :". $_FILES['pdf']['type'] . "<br>";
 echo "Filesize: ". ($_FILES['pdf']['size'] / 1024) . "KB <br>";
 }
}

?>