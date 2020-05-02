
<?php

if (isset($_POST['submission'])) {

	$target_dir = "submissions/";

}else{

$target_dir = "uploads/";

}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$lesson_source = "";
$book_path = "";
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$size = $_FILES["fileToUpload"]['size'];

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "pptx" 
&& $imageFileType != "ppt" && $imageFileType != "mp3" && $imageFileType != "mp4"
&& $imageFileType != "mov" && $imageFileType != "mpeg" && $imageFileType != "wmv" 
&& $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "txt" 
&& $imageFileType != "xltx"&& $imageFileType != "xlsx" && $imageFileType != "xlms" 
&& $imageFileType != "zip" && $imageFileType != "rar"){

$_SESSION["error"] = array();

$_SESSION["error"][] = "File type is not allowed, please contact administration.";

    $uploadOk = 0;
}

$date = date_create();

if (!empty($_POST['lesson_name'])){

	$target_file = $target_dir .$lesson_name. "." . $imageFileType;

	$lesson_source = $target_file;
}

if (!empty($_POST['book_title'])){

	$target_file = $target_dir .$book_title. "." . $imageFileType;

	$book_path = $target_file;
}
if (!empty($_POST['submission'])){

	$target_file = $target_dir .$user."[".$assignment."]." . $imageFileType;

	$sub_path = $target_file;

}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

   $_SESSION["error"][] = "Your file was not uploaded.";

// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    	$_SESSION["success"] = array();

    	$_SESSION["success"][] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

    } else {

        $_SESSION["error"][] = "Sorry, there was an error uploading your file.";
    }
}
?>






