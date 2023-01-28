<style type="text/css">
  .timing::-webkit-datetime-edit-ampm-field {
   display: none;
 }
 input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
 }
</style>

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


if(isset($_POST["createlessons"])){

	include 'include/connection.php';

   $lesson_name = $_POST["lesson_name"];
   $lesson_details = $_POST["lesson_details"];
   $uploadOk = 1;
   $lesson_type = $_POST["lesson_type"];
   $topic_id = $_POST["topic_id"];
   $content_type = $_POST["content"];
   $size = 0;
   $lesson_source = "";

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


if (isset($_POST["addcontent"])){


if($_POST["addcontent"] == "upload"){

require("mp3file.class.php");

$mp3file = new MP3File($lesson_source);//http://www.npr.org/rss/podcast.php?id=510282
//$duration1 = $mp3file->getDurationEstimate();//(faster) for CBR only
$duration2 = $mp3file->getDuration();//(slower) for VBR (or CBR)
$duration = MP3File::formatTime($duration2)."\n";

}else{

  $duration = $_POST["duration"];

}

}

if ($uploadOk == 1){


$sqlquery = "INSERT INTO `lessons` (`lesson_id`, `lesson_name`, `lesson_details`, `lesson_type`, `file_size`, `lesson_source`, `topic_id`, `downloads`, `content`, `duration`) VALUES (NULL, '$lesson_name', '$lesson_details', '$lesson_type', '$size', '$lesson_source', '$topic_id', '0' , '$content_type', '$duration')";	

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

<form action="dashboard.php#!tab0=5" method="post" enctype="multipart/form-data">

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

			$sqlz = "SELECT * FROM topics";
			$resultz = mysqli_query($conn, $sqlz);

			if (mysqli_num_rows($resultz) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($resultz)) {
			        $topic_title = $row["topic_title"];
			        $course_title = $row["course_title"];
			        $topic_id = $row["topic_id"];

			        ?>
			         <option value="<?php echo $topic_id?>" ><?php echo $topic_title ?></option>
			        <?php
			    }

			} else {
			   ?>
			   <option disabled>No topics available</option>
			   <?php
			}
    	?>

	</select>
  <div class="figure-caption">Select topics available:</div>
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
           <strong>Lesson Material:</strong>
        </div>
        <div class="col-md-9 mb-4">
                <div id="trumbowyg" name="lesson_details" class="trumbowyg bg-white" required></div>       
        </div>
</div>

	<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Type of Lesson:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
            	<select type="select" title="Select the type of lesson being uploaded" class="form-control form-control-sm" id="textlesson" name="lesson_type" required> 
      <option value="noupload">Only Lesson Material</option>
			<option value="Audio">Audio</option>
			<option value="Video">Video</option>
			<option value="Presentation">Presentation</option>
			<option value="Document">Document file</option>
			<option value="Audio">Other</option>
	</select>
  <div class="figure-caption">Select the type of lesson.</div>
</div>
</div>
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Lesson Duration:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="time" name="duration" step="1" title="Add estimated time required to complete lesson in hours, minutes and seconds" class="rounded timing" id=
                "timing" required>   
                <span class="figure-caption">HH:MM:SS</span>   
            </div>
        </div>
</div>


	<div class="row pl-4 pr-4 text-justify" id="access">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Accessibility:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
            	<select type="select" title="Students will be able to download or view the lesson content" class="form-control form-control-sm" name="content" id="content" required>  
			<option value="download">Download Only</option>
	        <option value="webbased">Web based</option>
	</select>
</div>
</div>
</div>

<div class="row pl-4 pr-4 text-justify" id="upload">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Add Lesson Content:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
              <select class="form-control form-control-sm" name="addcontent" id="addcontent" required>
                <option value="">Choose an option...</option>
      <option value="upload">Upload Lesson</option>
      <option value="embed">Embeded Lesson</option>
  </select>
</div>
</div>
</div>


<div class="form-group" id="see-embed">
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

</div>

<div class="form-group" id="see-upload">
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
</div>

<div class="row text-center pb-3">
    <div class="col-md-6 offset-md-3">
<input class="btn btn-primary" type="submit" name="createlessons" value="Upload Lesson">
</div>
</div>
</form>

