
<?php

if(session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
}else{
    echo "please login";
    exit();

}

if(isset($_GET["eid"])){
    $enroll_id = $_GET["eid"];
}else{
    echo "No enroll id in the url";

    exit();
}


if(isset($_GET["cid"])){
$course_id = $_GET["cid"];

}else {

    echo "No courses Id in the url";
    exit();
}



if(isset($_GET["tid"])){
    $topic_id = $_GET["tid"];
}else{
    echo "No topic id in the url";

    exit();
}

if(isset($_GET["qid"])){
    $quiz_id = $_GET["qid"];
}else{
    echo "No quiz id in the url";

    exit();
}



    //clear previous values
    unset($_SESSION["enroll_id"]); 
    unset($_SESSION["course_id"]);
    unset($_SESSION["topic_id"]);
    unset($_SESSION["quiz_id"]);
    unset($_SESSION["attempt_id"]);
    unset($_SESSION["total_questions"]);
    unset($_SESSION["question_number"]);
    unset($_SESSION["total_correct"]);
    unset($_SESSION["qa_id"]);
    unset($_SESSION["question_solutions"]);
    unset($_SESSION["total_correct"]);



include 'include/connection.php';

$sql = "SELECT * FROM `quizzes` WHERE quizzes.quiz_id = $quiz_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       $total_questions = $row["total_questions"];

    }
} else {
    echo "0 results";
}


include 'include/connection.php';


$sql = "INSERT INTO `quizzes_attempted` (`attempt_id`, `enroll_id`, `quiz_id`, `total_correct`, `user_id`) VALUES (NULL, '$enroll_id', '$quiz_id', '0', '$user_id');";

if (mysqli_query($conn, $sql)) {
   $attempt_id = mysqli_insert_id($conn);


$_SESSION["enroll_id"] = $enroll_id;
$_SESSION["course_id"] = $course_id;
$_SESSION["topic_id"] = $topic_id;
$_SESSION["quiz_id"] = $quiz_id;
$_SESSION["attempt_id"] = $attempt_id;
$_SESSION["total_questions"] = $total_questions;
$_SESSION["question_number"] = 1;
$_SESSION["total_correct"] = 0;




header("location: quiz.php");


} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>