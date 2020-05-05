<?php
include 'include/connection.php';

if(isset($_POST["createquestion"])){
  $quiz_id = $_POST["quiz_id"];
  $question = $_POST["question"];
  $question_solution = $_POST["question_solution"];
  $question_type = $_POST["question_type"];
  $option1 = $_POST["option1"];
  $option2 = $_POST["option2"];
  $option3 = $_POST["option3"];
  $option4 = $_POST["option4"];


$sql = "INSERT INTO `questions` (`question_id`, `question`, `question_solutions`, `question_type`, `option1`, `option2`, `option3`, `option4`) VALUES (NULL, '$question', '$question_solution', '$question_type', '$option1', '$option2', '$option3', '$option4');";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION["alerts"] = "question created successfully";

		$question_id = mysqli_insert_id($conn);


$sql = "INSERT INTO `questions_assigned` (`qa_id`, `quiz_id`, `question_id`) VALUES (NULL, '$quiz_id', '$question_id');";

	if (mysqli_query($conn, $sql)) {
	    $_SESSION["alerts"] = "question assigned to quiz";

		$sql = "UPDATE `quizzes` SET `total_questions` = (SELECT COUNT(*) FROM questions_assigned WHERE questions_assigned.quiz_id = $quiz_id) WHERE `quizzes`.`quiz_id` = $quiz_id;";

		if (mysqli_query($conn, $sql)) {
		    $_SESSION["alerts"] = "Quizzes updated successfully";
		} else {
		    $_SESSION["alerts"] = "Error updating record: " . mysqli_error($conn);
		}


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}

 ?>

<h1>Create Questions</h1>
<form action="dashboard.php" method="post">
	<p>Quiz</p>
	<p><select name="quiz_id">
	<option>select a quiz</option>

	<?php

include 'include/connection.php';

	$sql = "SELECT * FROM quizzes";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {       

		    	$quiz_id = $row["quiz_id"];
		    	$quiz_title = $row["quiz_title"];

		    	?>
				<option value="<?php echo $quiz_id ?>"><?php echo $quiz_title; ?></option>
	
		    	<?php
		        
			   }
		    
		} else {
		    echo "0 results";
		}

		?>
	</select></p>

	

	<p>Question</p>
	<p><input type="text" name="question"></p>

	<p>Solution</p>
	<p><input type="text" name="question_solution"></p>

	<p>Question Type</p>
	<p><input type="text" name="question_type"></p>

	<p>option1</p>
	<p><input type="text" name="option1"></p>

	<p>option2</p>
	<p><input type="text" name="option2"></p>

	<p>option3</p>
	<p><input type="text" name="option3"></p>

	<p>option4</p>
	<p><input type="text" name="option4"></p>
	<p><input class="btn btn-success" type="submit" name="createquestion" value="submit"></p>
</form>



