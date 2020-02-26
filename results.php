
<?php

if(session_status() === PHP_SESSION_NONE) session_start();


if(isset($_SESSION["attempt_id"])){
	$total_correct = $_SESSION["total_correct"];
	$total_questions = $_SESSION["total_questions"];
  
}


 include 'header.php'; ?>

 

<h3>Results</h3>

<h3><?php echo "You got $total_correct out of $total_questions";?></h3>

<?php include 'header.php'; ?>