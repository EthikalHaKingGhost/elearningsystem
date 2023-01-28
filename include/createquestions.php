
<?php

if(session_status() === PHP_SESSION_NONE) session_start();


if(isset($_SESSION["user_id"])){

if ($_SESSION["user_type"] == "Admin") {
  
    $user_id = $_SESSION["user_id"];

}else{

  header("location: ../index.php");
  
  exit();
}

}

include 'include/connection.php';

if(isset($_POST["createquestion"])){
  $quiz_id = $_POST["quiz_id"];
  $question = $_POST["trumbowyg"];
  $question_solution = $_POST["question_solution"];
  $question_type = $_POST["question_type"];
  $option1 = $_POST["option1"];
  $option2 = $_POST["option2"];
  $option3 = $_POST["option3"];
  $option4 = $_POST["option4"];


$sql = "INSERT INTO `questions` (`question_id`, `question`, `question_solutions`, `question_type`, `option1`, `option2`, `option3`, `option4`) VALUES (NULL, '$question', '$question_solution', '$question_type', '$option1', '$option2', '$option3', '$option4');";

	if (mysqli_query($conn, $sql)) {

      echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> question created successfully
            </div>';

		$question_id = mysqli_insert_id($conn);


$sql = "INSERT INTO `questions_assigned` (`qa_id`, `quiz_id`, `question_id`) VALUES (NULL, '$quiz_id', '$question_id');";

	if (mysqli_query($conn, $sql)) {

	    $_SESSION["alerts-info"] = "question assigned to quiz";

		$sql = "UPDATE `quizzes` SET `total_questions` = (SELECT COUNT(*) FROM questions_assigned WHERE questions_assigned.quiz_id = $quiz_id) WHERE `quizzes`.`quiz_id` = $quiz_id;";

		if (mysqli_query($conn, $sql)) {

		    $_SESSION["alerts-success"] = "";

        echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> Quizzes updated successfully
            </div>';

		} else {

        echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> Error adding Quiz, please contact Administration
            </div>';

		}


} else {

     echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> Error code 1 adding Quiz, please contact Administration
            </div>';

}

} else {

     echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> Error code 1 adding Quiz, please contact Administration
            </div>';
}

}

 ?>

<form action="dashboard.php#!tab0=4" method="post">

	<div class="container bg-light mt-2 p-3 rounded-lg">

         <div class="text-center font-weight-bold h5 pb-4">Add questions to Quizzes</div>

<div class="form-group">
	<div class="row pl-4 pr-4 text-justify">
		   <div class="col-md-3 pr-0 mt-2">
		   	<strong>Select a quiz:</strong>
        	</div>
        	<div class="col-md-9 mb-4">
              <select class="form-control form-control-sm"  name="quiz_id" required>
                <option></option>

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

        ?>
        <option>No Quizzes available</option>
  
        <?php
		}

		?>
	</select>

	</div>	
	</div>
</div>


<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Add Question:</strong>
        </div>
        <div class="col-md-9 mb-4">
                <div id="trumbowyg" name="trumbowyg" class="trumbowyg bg-white" required></div>       
        </div>
</div>

  <div class="form-group">
  	<div class="row pl-4 pr-4 text-justify">
		   <div class="col-md-3 pr-0 mt-2">
           <strong>Question Type:</strong>
        	</div>
        	<div class="col-md-9 mb-4">
                <select name="question_type" class="form-control form-control-sm" id="seeAnotherFieldGroup" required>
					<option value="multiple choice">Multiple Choice</option>
					<option value="true or false">True/False</option>
				</select>
			</div>
		</div>

<div class="form-group" id="otherFieldGroupDiv">

  <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Answer[1]</strong>
        </div>
        <div class="col-md-9 mb-4">
                <input type="text" name="option1" id="otherField1" class="form-control form-control-sm">      
        </div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Answer[2]</strong>
        </div>
        <div class="col-md-9 mb-4">
                <input type="text" name="option2" id="otherField2" class="form-control form-control-sm">      
        </div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Answer[3]</strong>
        </div>
        <div class="col-md-9 mb-4">
                <input type="text" name="option3" id="otherField3" class="form-control form-control-sm">      
        </div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Answer[4]</strong>
        </div>
        <div class="col-md-9 mb-4">
                <input type="text" name="option4" id="otherField4" class="form-control form-control-sm">      
        </div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Add Solution:</strong>
        </div>
        <div class="col-md-9 mb-4">
                <input type="text" name="question_solution" id="otherField5" title="Enter Question solution" class="form-control form-control-sm">      
        </div>
</div>

</div>



<div class="form-group" id="otherFieldGroupDiv2">

    <div class="row pl-4 pr-4 text-justify">
       <div class="col-md-3 pr-0 mt-2">
           <strong>Choose Solution:</strong>
          </div>
          <div class="col-md-9 mb-4">
                <select name="question_solution" class="form-control form-control-sm" id="otherField6" >
          <option value="1">True</option>
          <option value="2">False</option>
        </select>
      </div>
    </div>

    <input type="hidden" name="option1" value="1" id="otherField7">

    <input type="hidden" name="option2" value="2" id="otherField8"> 
</div>  

	<div class="row text-center pb-3">
    <div class="col-md-6 offset-md-3">
<input class="btn btn-primary" type="submit" name="createquestion" value="Add question">          
	</div>	
	</div>
	</div>
</form>




