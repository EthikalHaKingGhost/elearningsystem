<link rel="stylesheet" href="progressbar/progresscircle.css">

<?php

if(session_status() === PHP_SESSION_NONE) session_start();


if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

}else{

  header("location: ../index.php?info=login");
  
  exit();
}



$page_title = "Results";

 include 'header.php'; 



if(isset($_SESSION["attempt_id"])){
	$userid = $_SESSION["user_id"];
	$total_correct = $_SESSION["total_correct"];
	$total_questions = $_SESSION["total_questions"];
	$attempt_id = $_SESSION["attempt_id"];
	$topic_id = $_SESSION["topic_id"];
	$enroll_id = $_SESSION["enroll_id"];
	$course_id = $_SESSION["course_id"];
	$quiz_id = $_SESSION["quiz_id"];
	$goback ="details.php?eid=$enroll_id&cid=$course_id&tid=$topic_id";

	include 'include/connection.php';

		$sql = "UPDATE `quizzes_attempted` SET `total_correct` = '$total_correct' WHERE `quizzes_attempted`.`attempt_id` = $attempt_id;";

	if (mysqli_query($conn, $sql)) {

	    $_SESSION["alerts-success"] = "Thanks for talking our Quiz, see you next time!";

	    unset($_SESSION["enroll_id"]);
		unset($_SESSION["course_id"]);
		unset($_SESSION["topic_id"]);
		unset($_SESSION["quiz_id"]);
		unset($_SESSION["attempt_id"]);
		unset($_SESSION["total_questions"]);
		unset($_SESSION["question_number"]);
		unset($_SESSION["total_correct"]);

	} else {

	    $_SESSION["alerts-success"] = "Quiz was not Submitted, please contact your Administration";  

	}

}

?>
<div class="banner" style="background-image: url(images/2.jpg);">
	
</div>

<div class="row bg-dark">

<?php

if (isset($course_id)){

  $sql = "SELECT * FROM quizzes, topics WHERE quizzes.topic_id = topics.topic_id AND topics.topic_id = $topic_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{

    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {
		$limit = $row["total_attempts"];
        $linkstart = "start_quiz.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&qid=$quiz_id";
        $choice = "";
}

if ($total_questions > 0) {

	$count = "SELECT * FROM quizzes_attempted WHERE user_id = '$userid' AND quiz_id= '$quiz_id'";

        $countqry = mysqli_query($conn, $count);

            // Return the number of rows in result set
            $capture = mysqli_num_rows($countqry);

            mysqli_free_result($countqry);

	
	       if ($limit == 0)
            {

				$choice = '<a href="'.$linkstart.'" class="text-decoration-none btn btn-outline-info border border-dark rounded-0 py-2 mx-2"><div class="col">Retake Quiz</div></a>';
            }

            else if ($limit > 0 && $capture < $limit)
            {
            	
				$choice = '<a href="'.$linkstart.'" class="text-decoration-none btn btn-outline-info border border-dark rounded-0 py-2 mx-2"><div class="col">Retake Quiz</div></a>';
            }

            else if ($capture = $limit)
            {
				$choice = '<a href="'.$goback.'" class="text-decoration-none btn btn-outline-danger border border-dark rounded-0 py-2 mx-2"><div class="col">Take another Quiz</div></a>';

            }else{

           		$choice = "";

            }
     
			?>

			<?php echo $choice;  ?>

			<?php

}

}

?>
   <a href="index.php" class="text-decoration-none btn btn-outline-warning border border-dark rounded-0 py-2 mx-2"><div class="col">Go Home</div></a>
   <a href="courses.php" class="text-decoration-none btn btn-outline-light border border-dark rounded-0 py-2 mx-2"><div class="col">Do another Course</div></a>
   <a href="profile.php" class="text-decoration-none btn btn-outline-info border border-dark rounded-0 py-2 mx-2"><div class="col">Go to Profile</div></a>
  <a href="myresults.php" class="text-decoration-none btn btn-outline-primary border border-dark rounded-0 py-2 mx-2"><div class="col">Check all Results</div></a>
  <a href="<?php echo $goback ?>" class="text-decoration-none btn btn-outline-success border border-dark rounded-0 py-2 mx-2"><div class="col">Quizzes</div></a>
  <a href="logout.php" class="text-decoration-none btn btn-outline-danger border border-dark rounded-0 py-2 mx-2"><div class="col">Logout</div></a>
</div>
	
</div>

<div class="col-md-6 offset-md-3 rounded-lg mt-5 mb-5 bg-light">

<div class="text-center font-weight-bold h1 py-3">Results</div>

<div class="text-center py-3">

<h3><?php echo "You got $total_correct out of $total_questions" ?></h3>
</div>

<?php

$total = $total_correct / $total_questions * 100 ; ?>

 <div class="circlechart text-center" 
     data-percentage="<?php echo round($total); ?>">
     <?php

 if($total < 50){
 	
echo "<p class='text-danger'>Try again!</p>";
	$pass = "failed";

  } else if($total > 50 && $total <= 75){

    echo "<p class='text-primary'>Good Job!</p>";
 	$pass = "pass";

  } else if($total > 75 && $total <= 100){

    echo "<p class='text-success'>Exellent!</p>"; 
 	$pass = "pass";
  }

 ?>
</div>

<?php
if($total > 75){
?>
<div class="text-center p-5">
<img src="http://bestanimations.com/Games/Awards/trophy-gold-animated-gif-3.gif#.XryPmB-9LiA.link" width="150">
</div>
<?php

}if($total > 50 && $total < 60){

?>
<div class="text-center p-5">
<img src="http://bestanimations.com/Games/Awards/trophy-bronze-animated-gif-3.gif#.XryPmJacu-Y.link" width="150">
</div>
<?php

}if($total > 60 && $total <= 75){

?>
<div class="text-center p-5">
<img src="http://bestanimations.com/Games/Awards/trophy-silver-animated-gif-3.gif#.XryPmFxF0Zw.link" width="150">
</div>
<?php

}if($total < 50){

?>

<h5 class="py-3">Please try course again, <b>remember</b>, you are better than your last try! </h5>

<?php

}

?>

</div>
</div>	

<?php

}else{
	
	header("location: courses.php");
		exit();
}


include 'footer.php'; ?>

<script type="text/javascript">

$(function(){

  $('.circlechart').circlechart();

});

</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
</script>

<script src="progressbar/progresscircle.js"></script>


