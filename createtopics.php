
<?php  

session_start();

if(isset($_POST["create"])){

	include 'connection.php';

	$topic_title = $_POST["topic_title"];
    $topic_description = $_POST["topic_description"];

$sql = "INSERT INTO `topics` (`topic_id`, `topic_title`, `topic_description`) VALUES (NULL, '$topic_title', '$topic_description');";

if (mysqli_query($conn, $sql)) {

    $_SESSION["alerts"] = "Topic created successfully";

		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}


include 'header.php'; ?>


<h2>Create Topic</h2>

<form action="createtopics.php" method="post">

<p>Topic Title</p>
<p><input type="text" name="topic_title" title="The topic title displays as a heading of each topic" required></p>

<p>Topic Description</p>
<p><input type="text" name="topic_description" title="This field is used to describe the content of the course" required></p>

<p><input type="submit" name="create" value="Create Topic"></p>

</form>


<hr>



<?php


if(isset($_POST["assign_topic"])){

	include 'connection.php';

	$course_id = $_POST["course_id"];
	$topic_id = $_POST["topic_id"];

	$sql = "INSERT INTO `topics_assigned` (`ta_id`, `course_id`, `topic_id`) VALUES (NULL, '$course_id', '$topic_id');";

	if (mysqli_query($conn, $sql)) {

		$_SESSION["alerts"] = "Topic assigned successfully";

	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

?>





<h2> Assign Topic to a course:</h2>

<form action="createtopics.php" method="post">

<p>Course Title</p>
<p><select name="course_id" required> 

<?php 

include 'connection.php';

$sql = "SELECT * FROM courses";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

        $course_id = $row["course_id"];
        $course_title = $row["course_title"];

?>

	<option value = "<?php echo $course_id; ?>"><?php echo $course_title; ?></option>

<?php

		    }
		} else {
		    echo "0 results";
	  }

?>

</select></p> 



<p>Topic Title</p>
<p><select name="topic_id" required> 

<?php 

include 'connection.php';

$sql = "SELECT * FROM topics";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $topic_id = $row["topic_id"];
        $topic_title = $row["topic_title"];

    ?>

		<option value = "<?php echo $topic_id; ?>"> <?php echo $topic_title; ?></option>

    <?php
        
		    }
		} else {
		    echo "0 results";
	  }

  ?>

</select></p> 

<p><input type="submit" name="assign_topic" value="Assign"></p>

</form>


<?php include 'footer.php'; ?>










