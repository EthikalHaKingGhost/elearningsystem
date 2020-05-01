

<?php
$target_dir = "uploads/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$size = $_FILES["fileToUpload"]['size'];

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "pptx" 
&& $imageFileType != "ppt" && $imageFileType != "mp3" && $imageFileType != "mp4"
&& $imageFileType != "mov" && $imageFileType != "mpeg" && $imageFileType != "wmv" 
&& $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt" 
&& $imageFileType != "xltx"&& $imageFileType != "xlsx" && $imageFileType != "xlms"){

echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. <br>";

    $uploadOk = 0;
}

$date=date_create();

$target_file = $target_dir .$book_title. "." . $imageFileType;

echo "The file should be stored in the $target_file"."<br>"; 

$lesson_source = $target_file;
$book_path = $target_file;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br>";

// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. <br>";
    } else {
        echo "Sorry, there was an error uploading your file.</br>";
    }
}
?>






