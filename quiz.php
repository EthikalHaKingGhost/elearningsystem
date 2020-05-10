<?php  
session_start();

	if(isset($_SESSION["user_id"])){
	    $user_id = $_SESSION["user_id"];
	}else{

	    header('location: register.php?info=login');
	    exit();

}


	if(isset($_SESSION["attempt_id"])){
	    $attempt_id = $_SESSION["attempt_id"];
	    $question_number = $_SESSION["question_number"];
	    $total_questions = $_SESSION["total_questions"];
	    $icon= "";

	}else{

	    header('location: details.php?error=url');

	    exit();
}


///select

//display

//pull



$Message = "";
print_r($_SESSION);

	if(isset($_POST["next"])){
    $question_id = $_POST["question_id"];
		$qa_id = $_SESSION["qa_id"]; //2
    $correct = "incorrect";
		$question_solutions = $_SESSION["question_solutions"];

  $_SESSION["question_number"] += 1;
$question_number = $_SESSION["question_number"]; 

//to change from one quiz to the next with LIMIT

	if (empty($_POST["choice"])){
		
		$Message = '<div class="alert alert-info m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>You Got This!</strong> Select an answer by right clicking the option.</div>';

	}else{

    $choice = $_POST["choice"];




if($choice == $question_solutions){

    $_SESSION["total_correct"] += 1;
    
    $correct = "correct";

    echo "correct";

    }else {





      if($_SESSION["total_correct"] > 0){
        $_SESSION["total_correct"] -= 1;
      }

      echo "wrong";


    }


//check to see if an attempt is already made and update the last attempt else insert

    include 'include/connection.php';

$ans = "SELECT * FROM `responses` WHERE attempt_id = '$attempt_id' AND qa_id = '$qa_id'";
echo '<h1>checking for previous response to current question</h1>';
echo $ans . "<Br>";

  $query = mysqli_query($conn, $ans);

if (mysqli_num_rows($query) > 0) {
  echo '<h1>Going to update</h1>';
  $update = "UPDATE responses SET `responses`.`response` = '$choice', correct='$correct' WHERE `responses`.`attempt_id` = '$attempt_id' AND `responses`.`qa_id` = '$qa_id'";

  echo $update . "<br>";

   $query = mysqli_query($conn, $update);

    }else{
      echo '<h1>Going to insert</h1>';
    $update = "INSERT INTO `responses` (`response_id`, `qa_id`, `question_id`, `attempt_id`, `response`, `correct`) VALUES (NULL, '$qa_id', '$question_id', '$attempt_id', '$choice', '$correct');";

    if (mysqli_query($conn, $update)) {

    } else {
        echo "Error: " . $update . "<br>" . mysqli_error($conn);
}

}

}


    //reload page

}


if(isset($_POST["previous"])){

$_SESSION["question_number"] -= 1;
$question_number = $_SESSION["question_number"]; 

}



// quiz navigation 
$titleprev="Previous question";
$titlenext = "Next question";
$labelprev = 'Previous';
$Labelnext = "Next";
$submit = $total_questions - 1 ;
$goback = "";

if ($question_number > $total_questions){

		header('location: results.php');
}

//show submit buttonand title
if ($question_number > $submit){
		$titlenext = "Submit all answers";
		$Labelnext = 'Submit';	
}

//show cancel buttonand title
if ($question_number == 1 ){

$titleprev="If canceled you will have to start over";
$labelprev = 'Cancel';


}

//Go back to courses page and delete all sessions.

if ($question_number == 0 ){

//unset($_SESSION["enroll_id"]); 
//unset($_SESSION["course_id"]);
unset($_SESSION["topic_id"]);
unset($_SESSION["quiz_id"]);
unset($_SESSION["attempt_id"]);
unset($_SESSION["total_questions"]);
unset($_SESSION["question_number"]);
unset($_SESSION["total_correct"]);
unset($_SESSION["qa_id"]);
unset($_SESSION["question_solutions"]);
unset($_SESSION["total_correct"]);

header("location: topics.php?eid={$_SESSION["enroll_id"]}&cid={$_SESSION["course_id"]}");

exit();

}






//load question here
echo '<h1>Load question here</h1>';
include'include/connection.php';

$sql = "SELECT * FROM questions_assigned, questions
	WHERE questions_assigned.question_id = questions.question_id 
	AND questions_assigned.quiz_id = {$_SESSION["quiz_id"]} LIMIT $question_number";

  echo $sql . "<Br>";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $_SESSION["qa_id"] = $row["qa_id"];
      $_SESSION["question_id"] = $row["question_id"];
      $question_id = $row["question_id"];
      $question = $row["question"];
      $option1 = $row["option1"];
      $option2 = $row["option2"];
      $option3 = $row["option3"];
      $option4 = $row["option4"];
      $_SESSION["question_solutions"] = $row["question_solutions"];
      $question_type = $row["question_type"];



	} 

}else {

	//do nothing

}

echo '<h1>Check for a previous response to highlight choice</h1>';
$qa_id = $_SESSION["qa_id"];
$response = "";
include "include/connection.php";
$sql = "SELECT * FROM `responses` WHERE attempt_id = '$attempt_id' AND qa_id = '$qa_id'";
echo $sql . "<br>";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
      $response = $row["response"];
  }
} else {
  echo "0 results";
}




include 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="Webspeaker/src/jquery.webSpeaker.css">
 <script src="Webspeaker/src/jquery.webSpeaker.js"></script>


<div class="banner" style="background-image:url('images/3.jpg'); background-size:no-repeat; background-position: center; background-size: cover;">
	
</div>

<?php echo $Message ?>

<div class="container-fluid">

<div class="col-md-8 offset-md-2 py-5 bg-light">

<div class="bg-white p-3 rounded">

	<span id="text" class="h4"> <?php echo " $question ";?> </span>
</div>

<form action="quiz.php" method="post">








      <?php 


        if($question_type == "multiple choice"){

          ?>
      
<div class="font-weight-bold">
<div class="row choices bg-light">
        <label>
          <input <?php  if($response == $option1){ echo "checked"; }  ?> type="radio" name="choice"  value="<?php echo $option1;?>" class="card-input-element"/>
            <div class="card-input py-2 m-3 rounded border">
              <div class="answer mx-4"><?php echo $option1; ?></div>
            </div>
        </label>
      </div>

      <div class="row choices bg-light">
        <label>
          <input <?php  if($response == $option2){ echo "checked"; }  ?> type="radio" name="choice"  value="<?php echo $option2;?>" class="card-input-element"/>
            <div class="card-input py-2 m-3 rounded border">
              <div class="answer mx-4"><?php echo $option2; ?></div>
            </div>
        </label>
      </div>

      <div class="row choices bg-light">
        <label>
          <input <?php  if($response == $option3){ echo "checked"; }  ?>  type="radio"  name="choice"  value="<?php echo $option3;?>" class="card-input-element"/>
            <div class="card-input py-2 m-3 rounded border">
              <div class="answer mx-4"><?php echo $option3; ?></div>
            </div>
        </label>
      </div>

      <div class="row choices bg-light">
        <label>
          <input <?php  if($response == $option4){ echo "checked"; }  ?> type="radio" name="choice"  value="<?php echo $option4;?>" class="card-input-element"/>
            <div class="card-input py-2 m-3 rounded border">
              <div class="answer mx-4"><?php echo $option4; ?></div>
            </div>
        </label>
      </div>
     </div>


          <?php

        }else if($question_type == "true or false"){
          ?>
          <!-- TRUE OR FALSE -->
   
<div class="font-weight-bold">
<div class="row choices bg-light">
        <label>
          <input <?php  if($response == $option1){ echo "checked"; }  ?> type="radio" name="choice"  value="<?php echo $option1;?>" class="card-input-element"/>
            <div class="card-input py-2 m-3 rounded border">
              <div class="answer mx-4">True</div>
            </div>
        </label>
      </div>

      <div class="row choices bg-light">
        <label>
          <input <?php  if($response == $option2){ echo "checked"; }  ?> type="radio" name="choice"  value="<?php echo $option2;?>" class="card-input-element"/>
            <div class="card-input py-2 m-3 rounded border">
              <div class="answer mx-4">False</div>
            </div>
        </label>
      </div>
    </div>


        <?php
        }

        ?>



			<input class="btn btn-danger rounded-0" type="submit" title="<?php echo $titleprev ?>" name="previous" value="<?php echo "$labelprev" ?>">
      <input type="hidden" name="question_id" value="<?php echo $question_id ?>">
				<input class="btn btn-success rounded-0" type="submit" title="<?php echo $titlenext ?>" name="next" value="<?php echo "$Labelnext" ?>">
				<?php echo $icon ?>
				<span class="font-italic my-auto float-right"><?php echo  "Question $question_number of $total_questions"; ?></span>

		</div>

</div>

</form>

</div>

<script type="text/javascript">

    $('#text').webSpeaker();

//empty session variables
  var prompt=true;

    $(document).ready(function() {
          
//http://truelogic.org/wordpress/2012/07/20/how-to-prevent-a-user-leaving-a-page-with-unsaved-data/
        $('input:submit').click(function(e) {
      if ($('input:submit').val() = 'cancel'){
      unset($_SESSION["topic_id"]);
			unset($_SESSION["quiz_id"]);
			unset($_SESSION["attempt_id"]);
			unset($_SESSION["total_questions"]);
			unset($_SESSION["question_number"]);
			unset($_SESSION["total_correct"]);
			unset($_SESSION["qa_id"]);
			unset($_SESSION["question_solutions"]);
			unset($_SESSION["total_correct"]);
          prompt = false;
        }
          });
      });

</script>

<script src="https://code.responsivevoice.org/responsivevoice.js"></script>

<?php include 'footer.php'; ?>