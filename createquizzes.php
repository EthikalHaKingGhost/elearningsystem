<?php 

session_start();

if(isset($_POST["create_quiz"])){

include "connection.php";
$topic_id = $_POST["topic_id"];
$quiz_title = $_POST["quiz_title"];
$quiz_description = $_POST["quiz_description"];

$sql = "INSERT INTO `quizzes` (`quiz_id`, `quiz_title`, `quiz_description`, `total_questions`, `topic_id`) VALUES (NULL, '$quiz_title', '$quiz_description', '0', '$topic_id');";

if (mysqli_query($conn, $sql)) {
    $_SESSION["alerts"] = "Quiz created succesfully";

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}


include 'header.php'; ?>

<h1>Create Quiz</h1>

<form action="createquizzes.php" method="POST">

<h3>Topic</h3>
	<p><select name="topic_id">
		<option>select a topic</option>
		<?php include 'connection.php';

				$sql = "SELECT * FROM topics";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
				    // output data of each row
				    while($row = mysqli_fetch_assoc($result)) {
				     $topic_id = $row["topic_id"];
				     $topic_title = $row["topic_title"];     

				     ?>

					<option value="<?php echo $topic_id; ?>"><?php echo $topic_title; ?></option>

				     <?php
 
				    }
				} else {
				    echo "0 results";
				}

		?>

		</select>
	 </p>
		

<h3>Quiz Title</h3>
<p><input type="text" name="quiz_title" placeholder="Enter Title" required></p>
<h3>Quiz Description</h3>
<p><input type="text" name="quiz_description" placeholder="select Description" required></p>
<p><input type="submit" name="create_quiz" value="Add Quiz"></p>
</form>

<?php include 'footer.php'; ?>