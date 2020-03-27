
<?php 

session_start();

if(isset($_POST["createlessons"])){

	include 'include/connection.php';

   $lesson_name = $_POST["lesson_name"];
   $lesson_details = $_POST["lesson_details"];
   $uploadOk = 1;
   $lesson_type = $_POST["lesson_type"];
   $topic_id = $_POST["topic_id"];

if ($_FILES['fileToUpload']['error'] == 0){

	$_SESSION["alerts"] = "the file is ok to upload";
    
    include 'upload.php';

}else{

	$_SESSION["alerts"] = "error uploading file or no file selected";

	$lesson_source = $_POST["lesson_source"];
}


if ($uploadOk == 1){

		$sql = "INSERT INTO `lessons` (`lesson_id`, `lesson_name`, `lesson_type`, `lesson_source`, `topic_id`) VALUES (NULL, '$lesson_name', '$lesson_type', '$lesson_source', '$topic_id');";	

		if (mysqli_query($conn, $sql)) {
			$_SESSION["alerts"] = "Lesson Uploaded successfully";

		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
    }

}
	

include 'header.php';?>

<form action="createlessons.php" method="post" enctype="multipart/form-data">

	<h1>Create Lessons</h1>

    <p>Select Topic from Course</p>
    <p><select name="topic_id">

    	<?php

    	include 'include/connection.php';

			$sql = "SELECT * FROM topics_assigned, courses, topics WHERE courses.course_id = topics_assigned.course_id AND topics.topic_id = topics_assigned.topic_id";
			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			        $topic_title = $row["topic_title"];
			        $course_title = $row["course_title"];
			        $topic_id = $row["topic_id"];

			        ?>

			         <option value="<?php echo $topic_id?>" >[<?php echo $course_title ?>] - <?php echo $topic_title ?></option>

			        <?php
			        
			    }
			} else {
			    echo "0 results";
			}

    	?>



	</select>
	</p>


	<p>lesson</p>
	<p><input type="text" name="lesson_name"></p>

	<p>Lesson Details</p>
	<p><input type="text" name="lesson_details"></p>

    <p>Select Lesson Type</p>
	<p><select name="lesson_type">
		<option value="Audio">Audio</option>
		<option value="Video">Video</option>
		<option value="Presentation">Presentation</option>
		<option value="Document">Document</option>
		<option value="Video Conference">Video Conference</option>
	</select></p>


<p>Select trial Limit</p>
      <p><select name="limit" id="limit">
        <option value="0">Unlimited</option>
        <option value="#">1</option>
        <option value="#">2</option>
        <option value="#">3</option>
        <option value="#">5</option>
        <option value="#">10</option>
      </select></p>

      <p><textarea name="lesson_source" cols="30" rows="10"></textarea></p>

      <h4>Upload</h4>
     <p><input type="file" name="fileToUpload" id="fileToUpload"></p>

	<p><input class="btn btn-info" type="submit" name="createlessons" value="submit"></p>

</form>
	<?php include 'footer.php'; ?>
