
<?php

if (isset($_POST["submission"])) {

	$target_dir = "submissions/";

}elseif(isset($_POST["createlessons"])){

$target_dir = "lessons/";

}elseif (isset($_POST['create-course'])){

$target_dir = "images/";

}else{

$target_dir = "uploads/";

}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$book_path = "";
$lesson_source ="";
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


$errors[] = "File type is not allowed, please match the file type or contact administration.";

  echo '<div class="alert alert-danger alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>OOPS! </strong> File type is not allowed, please match the file type or contact administration.
            </div>';

    $uploadOk = 0;
}

$date = date_create();


if (!empty($_POST['book_title'])){

	$target_file = $target_dir .$book_title .round(microtime(true))."." . $imageFileType;

	$book_path = $target_file;

}

if (!empty($_POST['submission'])){

	$target_file = $target_dir .$user."_".round(microtime(true))."[".$filesubmit_id."]." . $imageFileType;

	$sub_path = $target_file;

}

$target_file = $target_dir .round(microtime(true))."." . $imageFileType;

if (isset($_POST['create-course'])){ $course_img = $target_file;}

if(isset($_POST["createlessons"])){$lesson_source = $target_file;}

if(isset($_POST["uploadimage"])) {$user_image = $target_file;}

if(isset($_POST["add_assignment"])){

$target_file = $target_dir .$assignment.'_'.round(microtime(true))."." . $imageFileType;

    $assignmentfile = $target_file;
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

   $errors[] = "Your file was not uploaded.";

    echo '<div class="alert alert-danger alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>OOPS! </strong> Your file was not uploaded.
            </div>';

// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    	
        echo '<div class="alert alert-info alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message! </strong>The file ' .basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded.
            </div>';

    } else {

        $errors[] = "Sorry, there was an error uploading your file.";

         echo '<div class="alert alert-danger alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>OOPS! </strong>Sorry, there was an error uploading your file.
            </div>';
    }
}
?>






