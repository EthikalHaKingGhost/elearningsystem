
<style type="text/css">
	.scrollable-menu {
    height: auto;
    max-height: 30px;
    overflow-x: hidden;
}
      
</style>

	<?php 

		session_start();


		if(isset($_POST["assign_topic"])){

			include 'include/connection.php';

			$course_id = $_POST["course_id"];
			$topic_id = $_POST["topic_id"];


			$sql = "SELECT * FROM topics_assigned WHERE topic_id = '$topic_id' and course_id='$course_id'";
				$result = mysqli_query($conn, $sql);
				if($result){
					if (mysqli_num_rows($result) > 0) {

						echo "This Topic is already assigned to the course";

					}else{

				$sql = "INSERT INTO `topics_assigned` (`ta_id`, `course_id`, `topic_id`) VALUES (NULL, '$course_id', '$topic_id');";

			if (mysqli_query($conn, $sql)) {

				echo "topic assigned successfully";

			}


		}


	}

}
	

	include 'header.php'; ?>


		<div class="banner">
			

		</div>




<div class="container bg-light mt-5">
	
<!-------------Create Courses ---------------------->

<form action="createtopics.php" method="post">
	<h1 class="text-center pt-3 mb-4">Assign topic to Course</h1>
		<p>Assign a topic to a course by selecting the course and the topic below. Each topic assigned to a course is visible. To change edit the lessons in a cours please go to <a href="createlessons.php">create lessons</a> page.</p>
     
<!-------- Course Title -------->


<div class="row">
	<div class="col-md-6 mb-5">
		<div class="card-header"><h1 class="text-lg text-center"><strong>Course</strong></div>
			<div class="card-body text-center">
	    		<div class="btn-group">
                	<select type="button" class="btn btn-default btn-lg dropdown-toggle text-white bg-secondary" data-toggle="dropdown" name="course_id"class="caret" class="dropdown-menu scrollable-menu scrollbar-lady-lips force-overflow" role="menu" required>
                		<option value = "" selected><strong>Select from courses available:</option>
               

						<?php 

						include 'include/connection.php';

						$sql = "SELECT * FROM courses";

						$result = mysqli_query($conn, $sql);

						if (mysqli_num_rows($result) > 0) {
						    // output data of each row
						    while($row = mysqli_fetch_assoc($result)) {

						        $course_id = $row["course_id"];
						        $course_title = $row["course_title"];

						?>

							<option value = "<?php echo $course_id; ?>"><?php echo $course_title; ?></option>

						<?php

						}

						} else {
						    echo "There is nothing to show";
					  }

				?>
              
			  </select>
          </div>
     </div>
</div>

<div class="col-md-6">
	<div class="card-header"><h1 class="text-lg text-center"><strong>Topic</strong></div>
	<div class="card-body text-center">
	    <div class="btn-group text-center">
                <select type="button" class="btn btn-default btn-lg dropdown-toggle text-white bg-secondary" data-toggle="dropdown" name="topic_id"class="caret" class="dropdown-menu scrollable-menu" role="menu" required>
                <option value = "" selected><strong>Select from topics available:</option>
     
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
							    echo "There are no topics available";
						  }

					  ?>	

				</select>
            </div>
        </div>
	</div>
</div>
	
<!-------- Assign Topic -------->

<div class="row text-center pb-5">
    <div class="col-md-6 offset-md-3 pt-5">
<input type="submit" name="assign_topic" class="btn btn-info btn-lg" value="Assign Topic">            
</div>
</div>
</form>
</div>

<?php include 'footer.php'; ?>

