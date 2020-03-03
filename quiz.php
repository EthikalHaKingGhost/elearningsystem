<?php  
session_start();

	if(isset($_SESSION["user_id"])){
	    $user_id = $_SESSION["user_id"];
	}else{
	    echo "please login";
	    exit();

}


	if(isset($_SESSION["attempt_id"])){
	    $attempt_id = $_SESSION["attempt_id"];
	    $question_number = $_SESSION["question_number"];
	    $total_questions = $_SESSION["total_questions"];
	    $icon= "";

	}else{
	    echo "No values found in attempt to start the quiz";
	    exit();
}



	if(isset($_POST["submit"])){
		$choice = $_POST["choice"];
		$qa_id = $_SESSION["qa_id"];
    	$correct = "incorrect";
		$question_solutions = $_SESSION["question_solutions"];
		

	if($choice == $question_solutions){
		$_SESSION["total_correct"] += 1;
		$correct = "correct";
		$icon = '<i class="fas fa-check-circle answer_icon green"></i></p>';

		}else {
			$icon = '<i class="fas fa-times-circle answer_icon red"></i>';
		}

		include 'connection.php';

		$sql = "INSERT INTO `responses` (`response_id`, `qa_id`, `attempt_id`, `response`, `correct`) VALUES (NULL, '$qa_id', '$attempt_id', '$choice', '$correct');";

		if (mysqli_query($conn, $sql)) {
		    echo "record created";

		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}




//to change from one quiz to the next with LIMIT


if(isset($_POST["next"])){
$_SESSION["question_number"] += 1;
$question_number = $_SESSION["question_number"]; 

}


// to stop quiz

	if ($question_number > $total_questions){

		header('location: results.php');
}



include'connection.php';

$sql = "SELECT * FROM questions_assigned, questions WHERE questions_assigned.question_id = questions.queestion_id AND questions_assigned.quiz_id= 1 LIMIT $question_number";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $_SESSION["qa_id"] = $row["qa_id"];
      $question = $row["question"];
      $option1 = $row["option1"];
      $option2 = $row["option2"];
      $option3 = $row["option3"];
      $option4 = $row["option4"];
      $_SESSION["question_solutions"] = $row["question_solutions"];
  
	} 

}else {
		    echo "0 results";
}


include 'header.php'; ?>


<style>

	.answer_icon{
		font-size: 2.5rem;
	}
	.red{
		color:red;
	}
	.green{
		color:green;
	}

</style>





<h1>Quiz Name</h1>
<hr>


<h3><?php echo  "Question $question_number of $total_questions;" ?></h3>
<h3><?php echo $question; ?></h3>

<form action="quiz.php" method="post">

<p><input checked type="radio" name="choice" value="<?php echo $option1;?>"><?php echo $option1; ?></p>
<p><input type="radio" name="choice" value="<?php echo $option2;?>"><?php echo $option2; ?></p>
<p><input type="radio" name="choice" value="<?php echo $option3;?>"><?php echo $option3; ?></p>
<p><input type="radio" name="choice" value="<?php echo $option4;?>"><?php echo $option4; ?></p>
<p><input class="btn btn-danger btn-lg" type="submit" name="next" value="Next">
<input class="btn btn-success btn-lg" type="submit" name="submit" value="Submit">
<?php echo $icon ?></p>

</form>

<?php include 'footer.php'; ?>