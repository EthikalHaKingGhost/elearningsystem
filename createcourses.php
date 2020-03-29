
<?php 

session_start();

include 'header.php';?>

<div class="banner">
    
    <h1 class="text-center text-white">Administration</h1>

</div>

<div class="container-fluid">
    
    <div class="row">

<!-------------Create Courses ---------------------->

<div class="col-md-6">

<?php 

if(isset($_POST["create-course"])){

include 'include/connection.php'; 

    $course_title = $_POST["course_title"];                       
    $course_description = $_POST["course_description"];
    $course_img = $_POST["course_img"];
    
    $sql = "INSERT INTO `courses` (`course_id`, `course_title`, `course_description`, `course_img`, `date_created`) 
    VALUES (NULL, '$course_title', '$course_description', '$course_img', current_timestamp());";

if (mysqli_query($conn, $sql)) {

echo "successfully added";

} else {

    echo "Error: " . $sql . "<br>" . mysqli_error($conn);

}

} 

?>



<form action="createcourses.php" method="post">
    <div class="container bg-light mt-5 p-3 rounded-lg">
         <h1 class="text-center p-5">Create Course</h1>
        <div class="col-md-6 offset-md-3 pb-5">
                    <div class="card">
                      <div class="card-body">
                          <strong>Insert image</strong>
                      </div>      
                    </div>
                </div>
<!-------- Course Title -------->

    <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Course Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="course_title" class="form-control" id="pwd">      
            </div>
        </div>

<!-------- Course description -------->

        <div class="col-md-3 pr-0 mt-2">
            <strong>Description:</strong>
        </div>

        <div class="col-md-9  mb-4">
                <div class="form-group">
                <input type="text" name="course_description" class="form-control">    
            </div>
        </div>

<!-------- Course image -------->

        <div class="col-md-3 pr-0 mt-2">
            <strong>Course Image:</strong>
        </div>
<div class="col-md-9">
<div class="input-group">
  <div class="input-group-prepend">
  <div class="custom-file">
    <input id="course_img" type="file" class="custom-file-input" name="course_img"
      aria-describedby="course_img">
    <label class="custom-file-label" for="course_img" accept="image/*">Choose file</label>
  </div>
</div>
</div>
</div>
</div>

<!-------- Upload Image -------->

<div class="row text-center pb-5">
    <div class="col-md-6 offset-md-3 pt-5">
<input type="submit" name="create-course" class="btn btn-info btn-lg" value="Create a Course">            
</div>
</div>
</div>
</form>
</div>


<!----------create Topics-------------------->
<div class="col-md-6">
    
<?php  

if(isset($_POST["create-topic"])){

    include 'include/connection.php';

    $topic_title = $_POST["topic_title"];
    $topic_description = $_POST["topic_description"];

$sql = "INSERT INTO `topics` (`topic_id`, `topic_title`, `topic_description`) VALUES (NULL, '$topic_title', '$topic_description');";

if (mysqli_query($conn, $sql)) {

echo "successfully added";

        } else {

            echo "Error in code";
    }
}

?>


<form action="createcourses.php" method="post">
    <div class="container bg-light mt-5 p-3 rounded-lg">
         <h1 class="text-center p-5">Create Topic</h1>

<!-------- Course Title -------->

    <div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Topic Title:</strong>
        </div>
        <div class="col-md-9 mb-4">
            <div class="form-group">
                <input type="text" name="topic_title" title="The topic title displays as a heading of each topic" required class="form-control">      
            </div>
        </div>

<!-------- Course description -------->

        <div class="col-md-3 pr-0 mt-2">
            <strong>Description:</strong>
        </div>
        <div class="col-md-9  mb-4">
                <div class="form-group">
                <input type="text" name="topic_description" class="form-control" id="pwd">    
            </div>
        </div>
    </div>

<!-------- Create Topic-------->

<div class="row text-center pb-5">
    <div class="col-md-6 offset-md-3 pt-5">
<input class="btn btn-info btn-lg" type="submit" name="create-topic" value="Create Topic">              
</div>
</div>
</div>
</form>
</div>
</div>
</div>






<hr>






<?php include 'footer.php'; ?>