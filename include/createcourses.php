
<?php 

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION["user_id"])){

if ($_SESSION["user_type"] == "Admin") {
  
    $user_id = $_SESSION["user_id"];

}else{

  header("location: ../index.php");
  
  exit();
}

}

if(isset($_POST["create-course"])){

include 'include/connection.php'; 

    $course_title = $_POST["course_title"];                       
    $course_description = $_POST["course_description"];
    $uploadOk = 1;
    $course_img = "images/book.png";

if (isset($_FILES['fileToUpload'])) {

if ($_FILES['fileToUpload']['error'] == 0){

      echo '<div class="alert alert-info alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info! </strong> the file is ok to upload.
            </div>';
    
    include 'upload.php';

}else{

    
          echo '<div class="alert alert-warning alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Alert! </strong> No image was selected for upload, stock image used.
            </div>';

}

}

if ($uploadOk == 1){
    
    $sql = "INSERT INTO `courses` (`course_id`, `course_title`, `course_description`, `course_img`, `date_created`) 
    VALUES (NULL, '$course_title', '$course_description', '$course_img', current_timestamp());";

if (mysqli_query($conn, $sql)) {

  echo '<div class="alert alert-success alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success! </strong> Course added successfully <a href="courses.php">click</a> here to view courses.
            </div>';

} else {

    echo "Error: " . $sql . "<br>" . mysqli_error($conn);

}

} 

}

?>



<form action="dashboard.php#!tab0=1" method="post" enctype="multipart/form-data">
    <div class="container bg-light mt-2 p-3 rounded-lg">
<!-------- Course Title -------->
<div class="grid-responsive">
    <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Course Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="course_title" class="form-control form-control-sm" id="pwd">      
            </div>
        </div>

<!-------- Course description -------->

 <div class="col-md-3 pr-0 mt-2">
            <strong>Description:</strong>
        </div>
        <div class="col-md-9  mb-4">
                <div class="form-group">
                <textarea type="text" name="course_description" maxlength="200" rows="4" class="form-control"></textarea>    
            </div>
        </div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Course Image:</strong>
        </div>
        <div class="col-md-9 mb-4 text-center">
            <div class="form-group files color">
                <input type="file" name="fileToUpload">
            </div>
        </div>
</div>

<!-------- Upload Image -------->

<div class="row text-center pb-5">
    <div class="col-md-6 offset-md-3">
<input type="submit" name="create-course" class="btn btn-primary" value="Create a Course">            
</div>
</div>
</div>
</form>










