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

if(isset($_POST["create_quiz"])){

include "include/connection.php";

$topic_id = $_POST["topic_id"];
$quiz_title = $_POST["quiz_title"];
$limit = $_POST["total_attempts"];

$query1 = "INSERT INTO `quizzes` (`quiz_id`, `quiz_title`, `total_attempts`, `total_questions`, `topic_id`) VALUES (NULL, '$quiz_title', '$limit', '0', '$topic_id');";

if (mysqli_query($conn, $query1)) {

    $_SESSION["alerts_success"] = "Quiz Created successfully";

} else {

    $_SESSION["alerts_danger"] = "Error inserting quiz please check database query";
}

}
?>



<form action="dashboard.php#!tab0=4" method="POST">

<div class="container bg-light mt-2 p-3 rounded-lg">

         <div class="text-center font-weight-bold h5 pb-4">Add Quiz</div>

  <div class="form-group">
  	<div class="row pl-4 pr-4 text-justify">
		   <div class="col-md-3 pr-0 mt-2">
           <strong>Topic Title:</strong>
        	</div>
        	<div class="col-md-9 mb-4">
                <select class="form-control form-control-sm"  name="topic_id" required>
                	<option></option>
     
                	<?php 

					include 'include/connection.php';

					$sql = "SELECT * FROM topics";

					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {
					        $topic_id = $row["topic_id"];
					        $topic_title = $row["topic_title"];

					?>

							<option value = "<?php echo $topic_id; ?>"> <?php echo $topic_title; ?></option>

					<?php
							}

							} else {

							    ?>

							<option>No topics available</option>

						<?php

						  }

					  ?>	

				</select>
</div>
</div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Quiz Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="quiz_title" title="Enter Title" class="form-control form-control-sm" required>      
            </div>
        </div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Total Attempts:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
            	<select type="text" title="please enter the limit" name="total_attempts" class="form-control form-control-sm" required/>
            		<option value="-1">&#8734; - unlimited</option>
            	<!--- loop to 50 -->
				<?php
				    for ($i=1; $i<=50; $i++)
				    {
				        ?>
				            <option value="<?php echo $i;?>"><?php echo $i;?></option>
				        <?php
				    }
				?>
				</select>     
        </div>
    </div>
</div>

<div class="row text-center pb-3">
    <div class="col-md-6 offset-md-3">
<input class="btn btn-primary" type="submit" name="create_quiz" value="Add Quiz">          
</div>
</div>
</div>
</form>

