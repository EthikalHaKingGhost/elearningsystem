
<?php

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION["attempt_id"])){
	$total_correct = $_SESSION["total_correct"];
	$total_questions = $_SESSION["total_questions"];
	$attempt_id = $_SESSION["attempt_id"];

	include 'include/connection.php';

		$sql = "UPDATE `quizzes_attempted` SET `total_correct` = '$total_correct' WHERE `quizzes_attempted`.`attempt_id` = $attempt_id;";

	if (mysqli_query($conn, $sql)) {

	    echo "Record updated successfully";

	    unset($_SESSION["enroll_id"]);
		unset($_SESSION["course_id"]);
		unset($_SESSION["topic_id"]);
		unset($_SESSION["quiz_id"]);
		unset($_SESSION["attempt_id"]);
		unset($_SESSION["total_questions"]);
		unset($_SESSION["question_number"]);
		unset($_SESSION["total_correct"]);

	} else {

	    echo "Error updating record: " . mysqli_error($conn);


	}

}

 include 'header.php'; ?>

<h1>Results</h1>

<hr>

<h3><?php echo "You got $total_correct out of $total_questions";?></h3>

<?php include 'footer.php'; ?>