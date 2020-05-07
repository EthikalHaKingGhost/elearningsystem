

<?php  


	

if(isset($_POST["create-topic"])){

    include 'include/connection.php';

    $topic_title = $_POST["topic_title"];

    $topic_description = $_POST["topic_description"];

   	$sql = "SELECT topic_title FROM topics WHERE topic_title = '$topic_title'";
   	
				$query = mysqli_query($conn, $sql);

				if($query){

					if (mysqli_num_rows($query) > 0) {

						echo "topic already exists";

	}else{

$sql = "INSERT INTO `topics` (`topic_id`, `topic_title`, `topic_description`) VALUES (NULL, '$topic_title', '$topic_description');";

if (mysqli_query($conn, $sql)) {

echo "topic created sucessfully";

        } else {

            echo "Error in code";
    }
}

}

}

?>

<form action="dashboard.php" method="post">

<div class="container bg-light mt-2 p-3 rounded-lg">

         <div class="text-center font-weight-bold h5 pb-4">Create Topic</div>

<!-------- Course Title -------->

    <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Topic Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="topic_title" title="The topic title displays as a heading of each topic" required class="form-control form-control-sm">      
            </div>
        </div>

<!-------- Course description -------->

        <div class="col-md-3 pr-0 mt-2">
          <strong>Description:</strong>
        </div>
        <div class="col-md-9  mb-4">
                <div class="form-group">
                <textarea type="text" rows="5" name="topic_description" class="form-control small font-italic" id="pwd"></textarea> 
                <div class="figure-caption">300 characters maximum</div>   
            </div>
        </div>
    </div>

<div class="row text-center pb-3">
    <div class="col-md-6 offset-md-3">
<input class="btn btn-primary" type="submit" name="create-topic" value="Create Topic">              
</div>
</div>
</form>
</div>



<div class="container bg-light mt-2 p-3 rounded-lg">

<!----assign the topic ---------->
	<?php 


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
	
?>

<form action="dashboard.php" method="post">

	<div class="text-center font-weight-bold h5 pb-4">Assign Topic to Course</div>
     
<!-------- Course Title -------->


<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Course Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
            	<select title="Assign a topic to a course by selecting the course and the topic below. Each topic assigned to a course is visible." class="form-control form-control-sm"  name="course_id" required>  
           <option disabled selected><strong>Select from courses available:</strong></option>
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

							?>

							<option>No Courses Avalaible</option>

						<?php


						  }

				?>
            	</select> 
            </div>
        </div>
    </div>

        <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Topic Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
            	<select type="select" class="form-control form-control-sm"  name="topic_id" required>  
           <option disabled selected><strong>Select from topics available:</strong></option>
     
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

							}else 

							{
							    ?>
							     <option disabled>No topics available</option>
							    <?php
							 }

					  ?>	

				</select>
            </div>
        </div>
    </div>

<div class="row text-center pb-5">
    <div class="col-md-6 offset-md-3">
<input type="submit" name="assign_topic" class="btn btn-primary" value="Assign Topic">            
</div>
</div>

</form>
</div>




