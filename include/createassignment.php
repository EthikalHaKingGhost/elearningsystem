

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
if(isset($_POST["add_assignment"])){

	include 'include/connection.php';
   $assignment = $_POST["assignment_name"];
   $details = $_POST["details"];
   $uploadOk = 1;
   $total = $_POST["total"];
   $size = "";
   $date = new DateTime($_POST['date']);
   $duedate = date_format($date, 'Y-m-d H:i:s');
   $ta_id = $_POST["topicassigned_id"];

$topicsql = "SELECT topic_id, course_id WHERE ta_id = '$ta_id'";

$results = mysqli_query($conn, $topicsql);

          if (mysqli_num_rows($results) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($results)) {

                $courseid = $row["course_id"];
                $topicid = $row["topic__id"];

              }
        }


 if (isset($_FILES['fileToUpload'])) {

if ($_FILES['fileToUpload']['error'] == 0){
    
    include 'upload.php';

}else{

	 echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> error uploading file or no file selected.
            </div>';
  
}

}


if ($uploadOk == 1){

$sql = "INSERT INTO `assignments` (`assignment_id`, `course_id`, `topic_id`, `assignment_title`, `assignment_details`, `file_size`, `assignment_path`, `score`, `due_date`) VALUES (NULL, '$courseid','$topicid', '$assignment', '$details', '$size', '$assignmentfile', '$total', '$duedate');";	

		if (mysqli_query($conn, $sql)) {

			 echo '<div class="alert alert-success alert-dismissible mt-2 mb-0">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> Assignment created successfully.
            </div>';

		} else {

		    '<div class="alert alert-success alert-dismissible mt-2 mb-0">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong>Error: '. $sql . "<br>" . mysqli_error($conn).'</div>';
		}
    }

}
	
?>

	      <form method="post" action="dashboard.php#!tab0=9" enctype='multipart/form-data'>

<div class="container bg-light mt-2 p-3 rounded-lg">

         <div class="text-center font-weight-bold h5 pb-4">Upload an Assignment</div>



<div class="form-group">
  	<div class="row pl-4 pr-4 text-justify">
		   <div class="col-md-3 pr-0 mt-2">
           <strong>Choose Topic:</strong>
        	</div>
        	<div class="col-md-9 mb-4">
     <select class="form-control form-control-sm" name="topicassigned_id" required>
          <option></option>

        <?php 

					include 'include/connection.php';

					$sql = "SELECT * FROM courses, topics, topics_assigned WHERE topics.topic_id = topics_assigned.topic_id AND topics_assigned.course_id = courses.course_id";

					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) > 0) {
					    // output data of each row
					    while($row = mysqli_fetch_assoc($result)) {
					        $topic_id = $row["topic_id"];
					        $topictitle = $row["topic_title"];
                  $coursetitle = $row["course_title"];
                  $id = $row["course_id"];

					?>

							<option value = "<?php echo $ta_id; ?>">
                <?php echo "[<b> ".$coursetitle." </b>] - ".$topictitle; ?>
                </option>


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


<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Assignment Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="assignment_name" id="test" title="Enter assignment Title" class="form-control form-control-sm" required>      
            </div>
        </div>
</div>
	      	

 <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Assignment description:</strong>
        </div>
        <div class="col-md-9 mb-4">
          <textarea name="details" rows="6" class="form-control" required></textarea>
        </div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Assignment Score:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="number" name="total" min="1" pattern="[0-9]+" max="100" min="0" title="Enter the assignments total" class="form-control form-control-sm" required>      
            </div>
        </div>
</div>

			
	  <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Upload Assignment:</strong>
        </div>
        <div class="col-md-9 mb-4 text-center">
            <div class="form-group files color">
              <input type="file" for="fileToUpload" name="fileToUpload" class=" form-control">
            </div>
        </div>
</div>


 <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong> Due Date:</strong>
        </div>
        <div class="col-md-9 mb-4">
          <input name="date" type="datetime-local" class="form-control" required>
        </div>
</div>
        
			<div class="text-center"><div cass="col-md-6 offset-md-3">
              <input type="submit" name="add_assignment" class="btn btn-primary" value="Upload Assignment">
              </div>
          </div>
</div>	

</form>




