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


	if(isset($_POST["submit"])){
		$choice = $_POST["choice"];
		$qa_id = $_SESSION["qa_id"];
    	$correct = "incorrect";
		$question_solutions = $_SESSION["question_solutions"];
		

	if($choice == $question_solutions){
		$_SESSION["total_correct"] += 1;
		$correct = "correct";

		$icon = 'yes';

		}else {

			$icon = 'no';
		}

		include 'include/connection.php';

		$sql = "INSERT INTO `responses` (`response_id`, `qa_id`, `attempt_id`, `response`, `correct`) VALUES (NULL, '$qa_id', '$attempt_id', '$choice', '$correct');";

		if (mysqli_query($conn, $sql)) {

		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

}

//to change from one quiz to the next with LIMIT
$Message = "";
if(isset($_POST["next"])){

	if (empty($_POST["choice"])){
		
		$Message = '<div class="alert alert-info m-0 rounded-lg text-center alert-dismissible" name="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>You Got This!</strong> Select an answer by right clicking the option.</div>';

	}else{

$_SESSION["question_number"] += 1;
$question_number = $_SESSION["question_number"]; 

}

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



include'include/connection.php';

$sql = "SELECT * FROM questions_assigned, questions
	WHERE questions_assigned.question_id = questions.question_id 
	AND questions_assigned.quiz_id = {$_SESSION["quiz_id"]} LIMIT $question_number";

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

	//do nothing

}





include 'header.php'; ?>

 <script src="Webspeaker/src/jquery.webSpeaker.js"></script>



<div class="banner" style="background-image:url('images/3.jpg'); background-size:no-repeat; background-position: center; background-size: cover;">
	
</div>

<?php echo $Message ?>

<div class="container-fluid bg-dark">

<div class="col-md-6 offset-md-3 py-5">

<div class="card border-0 rounded-0">

<div class="card-header border-0 rounded-0" style="background-image:url('images/ma.jpg')">
	<span id="text" class="h4"> <?php echo " $question ";?> </span>
</div>

<form action="quiz.php" method="post">

<div class="text-center font-weight-bold">

<div class="row choices bg-light">
        <label>
          <input type="radio" name="choice"  value="<?php echo $option1;?>" class="card-input-element"/>
            <div class="card-input py-2 m-3 bg-shadow">
              <div class="answer"><?php echo $option1; ?></div>
            </div>
        </label>
      </div>

      <div class="row choices bg-light">
        <label>
          <input type="radio" name="choice"  value="<?php echo $option2;?>" class="card-input-element"/>
            <div class="card-input py-2 m-3 bg-shadow">
              <div class="answer"><?php echo $option2; ?></div>
            </div>
        </label>
      </div>

      <div class="row choices bg-light">
        <label>
          <input type="radio"  name="choice"  value="<?php echo $option3;?>" class="card-input-element"/>
            <div class="card-input py-2 m-3 bg-shadow">
              <div class="answer"><?php echo $option3; ?></div>
            </div>
        </label>
      </div>

      <div class="row choices bg-light">
        <label>
          <input type="radio" name="choice"  value="<?php echo $option4;?>" class="card-input-element"/>
            <div class="card-input py-2 m-3 bg-shadow">
              <div class="answer"><?php echo $option4; ?></div>
            </div>
        </label>
      </div>
     </div>


		<div class="card-footer bg-warning border-0 rounded-0" style="background-image:url('images/ma.jpg')">
			<input class="btn btn-danger rounded-0" type="submit" title="<?php echo $titleprev ?>" name="previous" value="<?php echo "$labelprev" ?>">
				<input class="btn btn-success rounded-0" type="submit" title="<?php echo $titlenext ?>" name="next" value="<?php echo "$Labelnext" ?>">
				<?php echo $icon ?>
				<span class="font-italic my-auto float-right"><?php echo  "Question $question_number of $total_questions"; ?></span>


		</div>

</div>

</form>

</div>

<script type="text/javascript">

    $('#text').webSpeaker();

</script>

<script type="text/javascript">
  var prompt=true;

    $(document).ready(function() {

        $('input:not(:button,:submit),radio').change(function () {
          window.onbeforeunload = function () {
            if (prompt == true) 
              return "Are you sure you want to leave the quiz?";
            }
          });
//http://truelogic.org/wordpress/2012/07/20/how-to-prevent-a-user-leaving-a-page-with-unsaved-data/
        $('input:submit').click(function(e) {
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
          });
      });

</script>

<script src="https://code.responsivevoice.org/responsivevoice.js"></script>

<?php include 'footer.php'; ?>