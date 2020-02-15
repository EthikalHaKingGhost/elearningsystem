

<?php 



session_start();

if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
}else{
    echo "please login";
    exit();

}


if(isset($_GET["cid"])){
    $course_id = $_GET["cid"];
    $page= "enrollment.php?cid=$course_id";
}else{
    echo "No course id in the url";
    exit();
}






include 'connection.php'; 

$sql = "SELECT * FROM `enrollment` WHERE enrollment.course_id = $course_id AND enrollment.user_id = $user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    //enoll id from database
    $enroll_id = $row["enroll_id"];
} 
    //send user to topics page
     $link = "topics.php?eid=$enroll_id&cid=$course_id";
    header("location: $link");
    exit();
}





include "connection.php";

if(isset($_POST["enroll"])){

$sql = "INSERT INTO `enrollment` (`enroll_id`, `course_id`, `user_id`) VALUES (NULL, '$course_id', '$user_id');";
   
if (mysqli_query($conn, $sql)) {

    $enroll_id = mysqli_insert_id($conn);
    $link = "topics.php?eid=$enroll_id&cid=$course_id";
    header("location: $link");
    exit();
    
}
} else {
    
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}






include 'header.php'; ?>

<div class="container">

<br>
<h1>Enrollment</h1>

<h3>Are ou sure you want to enroll in this course</h3>
<form action="<?php echo $page;?>" method="post">
<input class= "btn btn-success btn-lg" type=submit value="enroll" name="enroll">
<a class="btn btn-danger btn-lg" href="courses.php">Cancel</a>
</div>
</div>
<br>
<br>
<?php include 'footer.php'; ?>