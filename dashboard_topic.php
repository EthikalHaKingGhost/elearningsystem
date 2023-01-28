<?php

if(session_status() === PHP_SESSION_NONE) session_start();


if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

}else{

  header("location: index.php?info=login");
  
  exit();
}

$page_title = "Edit Topic";

require 'header.php';

include('include/connection.php');

if (isset($_GET["tid"])) {

$topicid = $_GET['tid'];

$query = "SELECT * FROM topics WHERE topic_id = '$topicid'"; 

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

}else{

  header("location: dashboard.php#!tab0=2");

  exit();
}

?>

<div class="banner" style="background-image: url(images/1.jpg);">
	
</div>


<div class="col-md-6 offset-md-3 bg-light">	
<div class="form">

<div class="text-center display-4 pt-4 pb-2">Edit Topic</div><hr>

<?php

$status = "";

if(isset($_POST['create-topic']))
{

$topic_id = $_POST['topicid'];
$topictitle =$_POST['topic_title'];
$topic_detail = $_POST['topic_description'];

$update = "UPDATE `topics` SET `topic_title`='$topictitle',`topic_description`='$topic_detail' WHERE topic_id ='$topicid'";

mysqli_query($conn, $update);

echo "<meta http-equiv='refresh' content='2'>";

$_SESSION["alerts_success"] = "Topic updated successfully.";

include 'include/alerts.php';

}else {


?>
<div>
<form method="post" action="dashboard_topic.php?tid=<?php echo $row['topic_id']; ?>" enctype="multipart/form-data"> 

<input name="topicid" type="hidden" value="<?php echo $row['topic_id'];?>" />

<div class="form-group">
  <label for="title">Topic Title:</label>
  <input type="text" class="form-control text-center font-weight-bold" maxlength="300" style="font-size:25px;" name="topic_title" placeholder="Enter Topic title" value="<?php echo $row['topic_title'] ?>" required/>
</div>

<div class="form-group">
  <label for="text">Description:</label>
<textarea type="text" name="topic_description" rows="6" class="form-control" placeholder="Enter Topic description" 
required/><?php echo $row['topic_description'];?></textarea>
<div class="figure-caption">300 characters maximum</div>
</div>

<div class="text-center">
<input name="create-topic" class="btn btn-primary" type="submit" value="Save Changes"/>
</form>

<a href="dashboard.php#!tab0=4"><button type="button" class="btn btn-danger">Close</button></a>
</div>

<?php } ?>
</div>
</div>
</div>


<?php require 'footer.php'; ?>
