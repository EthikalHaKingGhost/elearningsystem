

<?php

session_start();

    if(isset($_SESSION["user_id"])){

        $user_id = $_SESSION["user_id"];

    }else{

     header('Location: register.php?info-login');

     exit();
}

if(isset($_GET["eid"])){

	$enroll_id = $_GET["eid"];

}else{

  header("Location: courses.php?error=enroll");

die();

}

if(isset($_GET["cid"])){

	$course_id = $_GET["cid"];

}else{

  header("Location: courses.php?error=course");

die();

}


if(isset($_GET["lid"])){

	$lesson_id = $_GET["lid"];

	include 'include/connection.php';

	$check = "SELECT * FROM lessons_taken WHERE lesson_id = '$lesson_id' AND user_id = '$user_id' AND status = 'incomplete'";

         $checkqry = mysqli_query( $conn, $check );
                //if no records exist
                if(mysqli_num_rows($checkqry) > 0){

                while($row = mysqli_fetch_assoc($checkqry)) {

    	 				$status = $row["status"];
                	}

                if ($status == "complete"){

                	$sql = "UPDATE `lessons_taken` SET `status` = 'incomplete' WHERE `lessons_taken`.`lesson_id` = '$lesson_id'";

                	$result = mysqli_query($conn, $sql);

                }
                	
                $_SESSION["alerts_info"] = "Please click complete to complete the lesson";

                }else{

				$sql = "INSERT INTO `lessons_taken` (`lessontaken_id`, `lesson_id`, `lesson_time`, `user_id`, `status`) VALUES (NULL, '$lesson_id', NOW(), '$user_id', 'incomplete');";

				$result = mysqli_query($conn, $sql);
			}

}else{

  header("Location: index.php");

die();

}


if(isset($_GET["tid"])){

	$topic_id = $_GET["tid"];

}else{

  header("Location: index.php");

die();

}

?>

<?php require 'header.php'; ?>
<link rel="stylesheet" type="text/css" href="plugins/video_player/src/css/mkhplayer.default.css"/>



<?php

//delete the lesson enroll after completion

if (isset($_POST["completed"])) {

include 'include/connection.php';

		$sql = "UPDATE `lessons_taken` SET `status` = 'complete' WHERE `lessons_taken`.`lesson_id` = '$lesson_id'";

		$result = mysqli_query($conn, $sql);

echo $sql;
}

//save the notes to the database

if (isset($_POST["savenotes"])) {

	 $savednotes = $_POST["commentBox"];


include 'include/connection.php';

		$sql = "";

		$result = mysqli_query($conn, $sql);

		
}

include 'include/connection.php';

$lesson_id = 41;

$sql = "SELECT * FROM lessons WHERE lessons.lesson_id = $lesson_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

    	 $lesson_name = $row["lesson_name"];
         $lesson_source = $row["lesson_source"];
         $lesson_type = $row["lesson_type"];
         $lesson_details = $row["lesson_details"];
         $link = "details.php?eid=$enroll_id&cid=$course_id&tid=$topic_id";
         $page = "sample.php?eid=$enroll_id&cid=$course_id&tid=$topic_id&&lid=$lesson_id";
}

} else {

    $msg = "No Lesson Available";
}

?>

<div class="banner" style="background-image: url(images/2.jpg);">
	<h1 class="text-center pt-5 text-light"> <?php echo $lesson_name; ?> </h1>
</div>

<div class="row m-0 p-5">
	<div class="col-md-7 border">
		<div class="text-center h2"><?php echo $lesson_type; ?></div>
<div class="container">
	<div class="text-justify">
		<?php echo $lesson_details; ?>
	</div>
		<audio id="music3" preload="metadata">
			<source src="<?php echo $lesson_source; ?>">
		</audio>
	
  <script src="https://code.jquery.com/jquery-3.2.0.slim.min.js"></script>
  <script type="text/javascript" src="plugins/video_player/src/js/jquery.mkhplayer.js"></script>
  <script type="text/javascript">
			$(document).ready(function(){
				$('audio').mkhPlayer();
				$('video').mkhPlayer();
			});
		</script>
</div>


<div class="pt-5 row">
 	<a href="<?php echo $link ?>" class="mr-2"><button class="btn btn-danger">Back</button></a>
	<form action="<?php echo $page ?>" method="post">
 	<input type="submit" value="Complete" name="completed" class="btn btn-success"></div>
	</form>
</div>

<form action="<?php echo $page ?>" method="post">
<div class="col-md-5 border">
			<div class="text-center h2">Notes <input type="submit" class="btn btn-secondary btn-sm" name="savenotes" value="save"></div>
			<div class="form-group">
				<textarea class="form-control bg-light" id="commentBox" name="commentBox" value="<?php echo $notes ?>" rows="20"></textarea>
				<p class="text-success" id="status" ></p>
			</div>
		<div class="form-status-holder"></div>
	</div>
</div>
</form>

<?php require 'footer.php'; ?>
