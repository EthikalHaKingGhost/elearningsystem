<?php 


if(isset($_POST["create_topic"])){
	$course_id = $_POST["course_id"]; 
	$topic_title = $_POST["topic_title"];
    $topic_description = $_POST["topic_description"];

include 'connection.php';

$sql = "INSERT INTO `topics` (`topic_id`, `topic_title`, `topic_description`) VALUES (NULL, '$topic_title', '$topic_description');
";

if (mysqli_query($conn, $sql)) {
    echo "New record entered successfully";


$topic_id = mysqli_insert_id($conn);


$sql = "INSERT INTO `topics_assigned` (`ta_id`, `course_id`, `topic_id`) VALUES (NULL, '$course_id', '$topic_id');";

if (mysqli_query($conn, $sql)) {
  echo "new record succeful"; 


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


}


include 'header.php'; ?>


<h1>Create Topic</h1>

<form action="createtopics.php" method="post">

<p>Course Title</p>
<p><select name="course_id"> 
	<option>Select a Course</option>

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

		<option value = "<?php echo $course_id ?>"><?php echo $course_title ?></option>

        <?php

        
    }
} else {
    echo "0 results";
}

?>

</select></p> 

<p>Topic Title</p>
<p><input type="text" name="topic_title"></p>
<p>Topic Description</p>
<p><input type="text" name="topic_description"></p>
<p><input type="submit" name="create_topic" value="Create Topic"></p>
</form>

<?php include 'footer.php'; ?>










