<?php

if(session_status() === PHP_SESSION_NONE) session_start();


if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

}else{

  header("location: index.php?info=login");
  
  exit();
}

$page_title = "Edit Course";

require 'header.php';

include('include/connection.php');

if (isset($_GET["cid"])) {

$courseid = $_GET['cid'];

$query = "SELECT * FROM courses WHERE course_id = '$courseid'"; 

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

}else{

  header("location: dashboard.php#!tab0=2");

  exit();
}

?>

<style>
	.image-upload>input {
  display: none;
}

  .image-upload img:hover {
  		cursor: pointer;
}
</style>


<div class="banner" style="background-image: url(images/1.jpg);">
	
</div>


<div class="col-md-6 offset-md-3 bg-light">	
<div class="form">

<div class="text-center display-4 pt-4 pb-2">Edit Course</div><hr>

<?php

$status = "";
$course_img = "images/book.png";

if(isset($_POST['create-course']))
{
$course_id = $_POST['course_id'];
$trn_date = date("Y-m-d H:i:s");
$course_title =$_POST['course_title'];
$course_description = $_POST['course_description'];

if (isset($_FILES['fileToUpload'])) {

if ($_FILES['fileToUpload']['error'] == 0){

      echo '<div class="alert alert-info alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info! </strong> the file is ok to upload.
            </div>';
    
    include 'upload.php';

}else{

            $course_img = $row["course_img"];
}

}

if ($uploadOK = 1) {

$update = "UPDATE `courses` SET `course_title`='$course_title',`course_description`='$course_description', `course_img` = '$course_img', `date_created`='$trn_date' WHERE course_id ='$course_id'";

mysqli_query($conn, $update);

echo "<meta http-equiv='refresh' content='3'>";

echo '<div class="alert alert-success alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success! </strong> Course updated successfully.
            </div>';

}

}else {


?>
<div>
<form method="post" id="profileImageForm" action="courseedit.php?cid=<?php echo $row['course_id']; ?>" enctype="multipart/form-data"> 

<div class="image-upload text-center">
  <label for="file-input">
    <img title="Click to change Image" class="border" src="
    <?php 

    if(empty($row['course_img'])){

    	echo $course_img;

    }else{

    	echo $row['course_img'];

    } ?>"
    	
    width="300" height="300"/>
  </label>
  <input id="file-input" type="file" name="fileToUpload" accept="image/*"/>
</div>

<input name="course_id" type="hidden" value="<?php echo $row['course_id'];?>" />

<div class="form-group">
  <label for="title">Course Title:</label>
  <input type="text" class="form-control text-center font-weight-bold" maxlength="300" style="font-size:25px;" name="course_title" placeholder="Enter Course title" value="<?php echo $row['course_title'] ?>" required/>
</div>

<div class="form-group">
  <label for="text">Description:</label>
<textarea type="text" name="course_description" rows="6" class="form-control" placeholder="Enter Course description" 
required/><?php echo $row['course_description'];?></textarea>
<div class="figure-caption">300 characters maximum</div>
</div>

<div class="text-center">
<input name="create-course" id="savechanges" class="btn btn-primary" type="submit" value="Save Changes"/>
</form>

<a href="dashboard.php#!tab0=2"><button type="button" class="btn btn-danger">Close</button></a>
</div>



<?php } ?>
</div>
</div>
</div>


<?php require 'footer.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){ 
            $('input[type="file"]').change(function(){ 
                jQuery('#savechanges').click();
            }); 
        }); 
  
</script>