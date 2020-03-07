

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "pptx" 
&& $imageFileType != "ppt" && $imageFileType != "mp3" && $imageFileType != "mp4"
&& $imageFileType != "mov" && $imageFileType != "mpeg" && $imageFileType != "wmv" 
&& $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt" 
&& $imageFileType != "xltx"&& $imageFileType != "xlsx" && $imageFileType != "xlms"){
echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; 
    $uploadOk = 0;
}

$date=date_create();
$target_file = $target_dir .date_format($date,'m-d-Y_g-i-s'). "." . $imageFileType;
echo "The file should be stored in the $target_file"; 
$lesson_source = $target_file;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>






