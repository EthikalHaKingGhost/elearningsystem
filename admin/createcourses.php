
<?php 

session_start();

if(isset($_POST["create"])){

include 'include/connection.php'; 

    $course_title = $_POST["course_title"];                       
    $course_description = $_POST["course_description"];
    $course_img = $_POST["course_img"];
    

    $sql = "INSERT INTO `courses` (`course_id`, `course_title`, `course_description`, `course_img`, `date_created`) 
    VALUES (NULL, '$course_title', '$course_description', '$course_img', current_timestamp());";

if (mysqli_query($conn, $sql)) {
    $_SESSION["alerts"] = "Course added successfuly";

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);

}


}

include 'header.php';?>


<h1>Create Course</h1>

<form action="createcourses.php" method="POST">

<p>Course Title</p>
<p><input type="text" name="course_title"></p>

<p> Course description</p>
<p><input type="text" name="course_description"></p>

<p>Select Course Image:</p>
  <label for="course_img"></label>
<p><input type="file" id="course_img" name="course_img" accept="image/*"><p>
<p><input type="submit" name="create" value="Create a Course"></p>

</form>




<div class="container">
	
<div class="row">
	<div class="col-md-3">
		a
	</div>

	<div class="col-md-9">
		d
	</div>
</div>

<div class="row"></div>


</div>












<?php include 'footer.php'; ?>