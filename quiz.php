
<?php  
if(session_status() === PHP_SESSION_NONE) session_start();

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
}else{
    echo "No values found in attempt to start the quiz";
    exit();

}



if(isset($_POST["submit"])){
$choice = $_POST ["choice"];
$question_solutions = $_SESSION["question_solutions"];

		if($choice == $question_solutions){

			echo "correct";
			$_SESSION["total_correct"] += 1;
		}else {
			echo "incorrect";
		}

}


//to change from one quiz to the next with LIMIT


if(isset($_POST["next"])){
$_SESSION["question_number"] += 1;
$question_number = $_SESSION["question_number"]; 

}


// to stop quiz

if ($question_number > $total_questions){
	echo "stop the quiz";
	header("location: results.php");
}



include'connection.php';

$sql = "SELECT * FROM questions_assigned, questions WHERE questions_assigned.question_id = questions.queestion_id AND questions_assigned.quiz_id=1 LIMIT $question_number";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $question = $row["question"];
      $option1 = $row["option1"];
      $option2 = $row["option2"];
      $option3 = $row["option3"];
      $option4 = $row["option4"];
      $_SESSION["question_solutions"] = $row["question_solutions"];


    }
} else {
    echo "0 results";
}


include 'header.php'; ?>


<h1>Quiz Name</h1>
<hr>


<h3><?php echo  "Question $question_number of $total_questions;" ?></h3>
<h3><?php echo $question; ?></h3>

<form action="quiz.php" method="post">

<p><input checked type="radio" name="choice" value="<?php echo $option1;?>"><?php echo $option1; ?></p>
<p><input type="radio" name="choice" value="<?php echo $option2;?>"><?php echo $option2; ?></p>
<p><input type="radio" name="choice" value="<?php echo $option3;?>"><?php echo $option3; ?></p>
<p><input type="radio" name="choice" value="<?php echo $option4;?>"><?php echo $option4; ?></p>

<p><input class="btn btn-danger" type="submit" name="next" value="Next">
<input class="btn btn-success" type="submit" name="submit" value="Submit"></p>


</form>





<?php include 'footer.php'; ?>