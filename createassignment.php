

<?php 

if(isset($_POST["add_assignment"])){

	include 'include/connection.php';

   $assignment = $_POST["assignment_name"];
   $details = $_POST["details"];
   $uploadOk = 1;
   $total = $_POST["total"];

 if (isset($_FILES['fileToUpload'])) {

if ($_FILES['fileToUpload']['error'] == 0){

	$_SESSION["alerts"] = "the file is ok to upload";
    
    include 'upload.php';

}else{

	$_SESSION["alerts"] = "error uploading file or no file selected";

	$lesson_source = $_POST["lesson_source"];
}

}

if ($uploadOk == 1){

$sql = "INSERT INTO `lessons` (`lesson_id`, `lesson_name`, `lesson_type`, `file_size`, `lesson_source`, `topic_id`, `downloads`) VALUES (NULL, '$lesson_name', '$lesson_type', '$size', '$lesson_source', '$topic_id', '$downloads', '$contenttype')";	

		if (mysqli_query($conn, $sql)) {

			$_SESSION["alerts"] = "Lesson Uploaded successfully";

		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
    }

}
	
?>

	      <form method="post" action="test.php" enctype='multipart/form-data'>

<div class="container bg-light mt-2 p-3 rounded-lg">

         <div class="text-center font-weight-bold h5 pb-4">Upload an Assignment</div>

<div class="form-group">
  	<div class="row pl-4 pr-4 text-justify">
		   <div class="col-md-3 pr-0 mt-2">
           <strong>Topic Title:</strong>
        	</div>
        	<div class="col-md-9 mb-4">
                <select type="select" class="form-control form-control-sm" name="topic_id" required>
     
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


<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Assignment Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="assignment_name" id="test" placeholder="Assignment Title" class="form-control form-control-sm" required>      
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
           <strong>Upload Assignment:</strong>
        </div>
        <div class="col-md-9 mb-4 text-center">
            <div class="form-group files color">
              <input type="file" for="fileToUpload" name="fileToUpload" class=" form-control">
            </div>
        </div>
</div>
        
			<div class="text-center"><div cass="col-md-6 offset-md-3">
              <input type="submit" name="add_assignment" class="btn btn-primary" value="Upload Assignment">
              </div>
          </div>
</div>	

</form>




