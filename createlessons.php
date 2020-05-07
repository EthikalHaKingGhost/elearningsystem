
<?php 



if(isset($_POST["createlessons"])){

	include 'include/connection.php';

   $lesson_name = $_POST["lesson_name"];
   $lesson_details = $_POST["lesson_details"];
   $uploadOk = 1;
   $lesson_type = $_POST["lesson_type"];
   $topic_id = $_POST["topic_id"];
   $content_type = $_POST["content"];

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

if (!empty($_POST["lesson_source"])) {

$lesson_source = $_POST["lesson_source"];

$size = "";

}


if ($uploadOk == 1){

$sqlquery = "INSERT INTO `lessons` (`lesson_id`, `lesson_name`, `lesson_details`, `lesson_type`, `file_size`, `lesson_source`, `topic_id`, `downloads`, `content`) VALUES (NULL, '$lesson_name', '$lesson_details', '$lesson_type', '$size', '$lesson_source', '$topic_id', '0' , '$content_type')";	

		if (mysqli_query($conn, $sqlquery)) {

			echo '<div class="alert alert-success alert-dismissible mt-2 mb-0">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Message!</strong> Lesson Uploaded successfully.
            </div>';
}

		} else {

		    echo "upload error";
		}
    }





?>

<form action="dashboard.php" method="post" enctype="multipart/form-data">

<div class="container bg-light p-3 mt-2 rounded-lg">

	<div class="text-center font-weight-bold h5 pb-4">Create Lesson</div>

	<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Topic:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
            	<select title="Select a topic from a course" class="form-control form-control-sm" name="topic_id" required>  
           
           <?php 

			$sqlz = "SELECT * FROM topics_assigned, courses, topics WHERE courses.course_id = topics_assigned.course_id AND topics.topic_id = topics_assigned.topic_id";
			$resultz = mysqli_query($conn, $sqlz);

			if (mysqli_num_rows($resultz) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($resultz)) {
			        $topic_title = $row["topic_title"];
			        $course_title = $row["course_title"];
			        $topic_id = $row["topic_id"];

			        ?>

			         <option value="<?php echo $topic_id?>" >[<?php echo $course_title ?>] - <?php echo $topic_title ?></option>

			        <?php
			        
			    }

			} else {

			   ?>

			         <option disabled>No topics available</option>

			   <?php

			}

    	?>

	</select>
  <div class="figure-caption">Select topic from courses available:</div>
</div>
</div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Lesson Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="lesson_name" title="Add lesson title" class="form-control form-control-sm" required>      
            </div>
        </div>
</div>

<div class="row pl-4 pr-4 text-justify">
	 <div class="col-md-3 pr-0 mt-2">
          <strong>Lesson Description:</strong>
        </div>
        <div class="col-md-9  mb-4">
                <div class="form-group">
                <textarea type="text" rows="5" name="lesson_details" class="form-control small font-italic" id="details"></textarea> 
                <div class="figure-caption">300 characters maximum</div>   
            </div>
        </div>
 </div>  

	<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Type of Lesson:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
            	<select type="select" title="Select the type of lesson being uploaded" class="form-control form-control-sm" name="lesson_type"> 
			<option value="Audio">Audio</option>
			<option value="Video">Video</option>
			<option value="Presentation">Presentation</option>
			<option value="Document">Document</option>
			<option value="Video Conference">Video Conference</option>
			<option value="Audio">Other</option>
	</select>
  <div class="figure-caption">Select Lesson type:</div>
</div>
</div>
</div>


	<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Lesson Content:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
            	<select type="select" title="Students will be able to download or view the content or have the option of both" class="form-control form-control-sm" name="content" id="content" required>  
			<option value="download">Download Only</option>
	        <option value="webbased">Web based</option>
	        <option value="both" selected>Download + Web Based</option>
	</select>
</div>
</div>
</div>

	<div class="row pl-4 pr-4 text-justify">
 <div class="col-md-3 pr-0 mt-2">
          <strong>Lesson embeded Code:</strong>
        </div>
        <div class="col-md-9  mb-4">
                <div class="form-group">
                <textarea type="text" rows="6" title="embed lesson using generated embeded code" name="lesson_source" class="form-control small font-italic" id="embeded"></textarea> 
                <div class="figure-caption">iframe must be included</div>   
            </div>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-3"></div>
    	<div class="col-md-4"><hr></div>
    	<div class="col-md-1 text-center">OR</div>
    	<div class="col-md-4 pb-3"><hr></div>
    </div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Upload Lessons</strong>
        </div>
        <div class="col-md-9 mb-4 text-center">
            <div class="form-group files color">
            	<input type="file" name="fileToUpload" id="uploadinput">
            </div>
        </div>
</div>

<div class="row text-center pb-3">
    <div class="col-md-6 offset-md-3">
<input class="btn btn-primary" type="submit" name="createlessons" value="Upload Lesson">
</div>
</div>
</form>

