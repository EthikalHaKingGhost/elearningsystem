<?php

if(session_status() === PHP_SESSION_NONE) session_start();


if(isset($_SESSION["user_id"])){

    $user_id = $_SESSION["user_id"];

}else{

  header("location: index.php?info=login");
  
  exit();
}


if (isset($_GET["tid"])) {
    
    $topicid = $_GET["tid"];

include ('include/connection.php');

$sqltopics = "SELECT * FROM topics";

        $resulttopics = mysqli_query($conn, $sqltopics);
        
        if (mysqli_num_rows($resulttopics) < 2) {

 header("location: dashboard.php?deltopic=error#!tab0=4");

}else{

    $delete1 = "DELETE FROM `lessons` WHERE topic_id = '$topicid'";

  if (mysqli_query($conn, $delete1)) {
    
  $_SESSION["alerts_success"] = "Topic Deleted from lessons";

}

    $delete2 = "DELETE FROM `quizzes` WHERE topic_id = '$topicid'";

$del2 = mysqli_query($conn, $delete2);

    $delete3 = "DELETE FROM `submissions` WHERE topic_id = '$topicid'";

$del3 = mysqli_query($conn, $delete3);

    $delete4 = "DELETE FROM `topics_assigned` WHERE topic_id = '$topicid'";
$del4 = mysqli_query($conn, $delete4);

    $delete5 = "DELETE FROM ``lessons_taken` WHERE topic_id = '$topicid'";

$del5 = mysqli_query($conn, $delete5);

    $delete6 = "DELETE FROM `assignments` WHERE topic_id = '$topicid'";

$del6 = mysqli_query($conn, $delete6);

    $delete7 = "DELETE FROM `books_assign` WHERE topic_id = '$topicid'";

$del7 = mysqli_query($conn, $delete7);

    $delete = "DELETE FROM `topics` WHERE topic_id = '$topicid'";

if (mysqli_query($conn, $delete)) {
    
  $_SESSION["alerts_success"] = "Topic deleted from E-learning2020 successfuly";

  header("location: dashboard.php#!tab0=4");

  exit();

} else {

 $_SESSION["alerts_danger"] = "Error deleting Topic, please contact Administrator";

   header("location: dashboard.php#!tab0=4");

 exit();
 
}

}

}




if (isset($_GET["taid"])) {
    
    $taid = $_GET["taid"];

include ('include/connection.php');

    $remove = "DELETE FROM topics_assigned WHERE topics_assigned.ta_id = '$taid'";

if (mysqli_query($conn, $remove)) {

   echo '<div class="alert alert-success alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info! </strong> Topic removed successfuly
            </div>';

  header("location: dashboard.php#!tab0=4");

  exit();

} else {

  echo '<div class="alert alert-danger alert-dismissible mt-2 mb-1">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info! </strong> Error removing course
            </div>';

header("location: dashboard.php#!tab0=4");

}

}




if (isset($_GET["lid"])) {
    
    $lessonid = $_GET["lid"];
    $topicid = $_GET["id"];

include ('include/connection.php');

    $deleteid = "DELETE FROM `lessons` WHERE lesson_id = '$lessonid' AND topic_id = '$topicid'";

if (mysqli_query($conn, $deleteid)) {
    
  $_SESSION["alerts_success"] = "Lesson deleted successfuly";

  header("location: dashboard.php#!tab0=6");

} else {

 $_SESSION["alerts-danger"] = "Error deleting Lesson";

   header("location: dashboard.php#!tab0=6");


}

}


if (isset($_GET["bid"])) {
    
    $bookid = $_GET["bid"];

include ('include/connection.php');

    $deleteid = "DELETE FROM `library` WHERE book_id = '$bookid'";

if (mysqli_query($conn, $deleteid)) {
    
  $_SESSION["alerts_success"] = "Book deleted successfuly";

  header("location: dashboard.php#!tab0=12");

  exit();

} else {

 $_SESSION["alerts-danger"] = "Error deleting this Book, please contact the Administrator";

   header("location: dashboard.php#!tab0=12");

   exit();


}

}


