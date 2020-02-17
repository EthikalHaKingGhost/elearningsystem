
<?php 

session_start();

if(isset($_POST["create"])){

include 'connection.php'; 

  $course_title = $_POST["course_title"];                       
    $course_description = $_POST["course_description"];
    $course_img = $_POST["course_img"];
    

    $sql = "INSERT INTO `courses` (`course_id`, `course_title`, `course_description`, `course_img`, `date_created`) 
    VALUES (NULL, '$course_title', '$course_description', '$course_img', current_timestamp());";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";

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

<p>Select Course Image</p>
  <label for="img"></label>
<p><input type="file" name="course_img" accept="image/*"><p>


<p><input type="submit" name="create" value="Create a Course"></p>


</form>




</form>
<?php include 'footer.php'; ?>