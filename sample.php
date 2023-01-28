

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



if(isset($_POST["gotolesson"])){

include 'include/connection.php';

	$sql1 = "SELECT * FROM lessons_taken WHERE lesson_id = '$lesson_id' AND user_id = '$user_id' AND status = 'incomplete'";

         $result1 = mysqli_query($conn, $sql1);
                //if no records exist
                if(mysqli_num_rows($result1) > 0){


                }else{

        $time = date("Y-m-d h:i:s", time());

		$sql3 = "INSERT INTO `lessons_taken` (`lessontaken_id`, `lesson_id`, `topic_id`, `lesson_time`, `user_id`) VALUES (NULL, '$lesson_id' ,'$topic_id', '$time' , '$user_id')";

		$result3 = mysqli_query($conn, $sql3);

                }

}

 require 'header.php'; ?>

<link rel="stylesheet" type="text/css" href="plugins/video_player/src/css/mkhplayer.default.css"/>


<?php

if (isset($_POST["completed"])) {

include 'include/connection.php';

//search for last saved 
	$querysql = "SELECT * FROM lessons_taken WHERE lesson_id = '$lesson_id' AND user_id = '$user_id'";

         $results = mysqli_query( $conn, $querysql );
                //if no records exist
                if(mysqli_num_rows($results) > 0){

                	while($row = mysqli_fetch_assoc($results)) {

                		$lessontaken_id = $row["lessontaken_id"];
                		$status = $row["status"];
                	}

               if($status == "incomplete"){

               	$time = date("Y-m-d h:i:s", time());

				$sql = "UPDATE `lessons_taken` SET `status` = 'complete', `time_end` = '$time' WHERE `lessons_taken`.`lesson_id` = '$lesson_id' AND user_id = '$user_id';";

					$update = mysqli_query($conn, $sql);

				header("Location: lessoncompleted.php");

				exit();

					}else{

						$sql3 = "INSERT INTO `lessons_taken` (`lessontaken_id`, `lesson_id`, `user_id`, `status`) VALUES (NULL, '$lesson_id', '$user_id', 'incomplete');";

						$result3 = mysqli_query($conn, $sql3);

						$_SESSION["alerts_success"] =  "The lesson is completed successfuly";

					}
		}

	}


include 'include/connection.php';

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
         $downloadlink = "download.php?tid=$topic_id&lid=$lesson_id";
}

} else {

    $msg = "No Lesson Available";
}

?>

<div class="banner" style="background-image: url(images/2.jpg);">
	<h1 class="text-center pt-5 text-light"> <?php echo $lesson_name; ?> </h1>
</div>

<div class="text-center">
<div class="container bg-light py-5">

		<div class="text-center h2"><?php echo $lesson_type; ?></div>

	<div class="text-justify py-3">
		<?php echo $lesson_details; ?>
	</div>

<div class="card p-5" style="background-image: url(images/ma.jpg);">


<div class="col-md-6 offset-md-3">
		<audio id="music3" preload="metadata" >
			<source src="<?php echo $lesson_source; ?>">
		</audio>

<div class="card-footer">

<?php

 require("mp3file.class.php");

$mp3file = new MP3File($lesson_source);//http://www.npr.org/rss/podcast.php?id=510282
$duration1 = $mp3file->getDurationEstimate();//(faster) for CBR only
$duration2 = $mp3file->getDuration();//(slower) for VBR (or CBR)
echo "This audio duration is $duration1 seconds"."\n";
?>
</div>
</div>	
</div>



	<div class="row p-3">

 	<a href="<?php echo $link ?>" class="mr-2"><button class="btn btn-danger">Exit</button></a>

 	<form action="<?php echo $page ?>" method="post">

 	<div class="float-right">	
 	<button type="submit" name="completed" class="btn btn-success">Complete</button>

 	<a class="btn btn-warning" href="<?php echo $downloadlink; ?>">Download <i class="fas fa-download"></i></a>
 	</div>
</div>


</form>
</div>
</div>
	

  <script src="https://code.jquery.com/jquery-3.2.0.slim.min.js"></script>
  <script type="text/javascript" src="plugins/video_player/src/js/jquery.mkhplayer.js"></script>
  <script type="text/javascript">
			$(document).ready(function(){
				$('audio').mkhPlayer();
				$('video').mkhPlayer();
			});
		</script>

<?php require 'footer.php'; ?>
