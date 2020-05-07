
<?php
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

<form action="dashboard.php" method="post">

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

		    echo "0 results";
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

	<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Add Solution:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="question_solution" title="Enter Question solution" class="form-control form-control-sm" required>      
            </div>
        </div>
</div>


  <div class="form-group">
  	<div class="row pl-4 pr-4 text-justify">
		   <div class="col-md-3 pr-0 mt-2">
           <strong>Question Type:</strong>
        	</div>
        	<div class="col-md-9 mb-4">
                <select name="question_type" class="form-control form-control-sm "  required>
          <option></option>
					<option>Multiple Choice</option>
					<option>True/False</option>
					<option>Fill-in-the-Blank</option>
					<option>Fill-in-Multiple-Blanks</option>
					<option>Multiple Answer</option>
				</select>
			</div>
		</div>
	</div>

	<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Option[1]</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="option1" class="form-control form-control-sm">      
            </div>
        </div>
</div>

	<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Option[2]</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="option2" class="form-control form-control-sm">      
            </div>
        </div>
</div>

	<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Option[3]</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="option3" class="form-control form-control-sm">      
            </div>
        </div>
</div>

	<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Option[4]</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="option4" class="form-control form-control-sm">      
            </div>
        </div>
</div>
	<div class="row text-center pb-3">
    <div class="col-md-6 offset-md-3">
<input class="btn btn-primary" type="submit" name="createquestion" value="Add question">          
	</div>	
	</div>
	</div>
</form>

