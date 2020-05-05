
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



<form action="dashboard.php" method="post">
    <div class="container bg-light mt-2 p-3 rounded-lg">
          <div class="text-center font-weight-bold h5 pb-4">Create Course</div>
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
</div>

<div class="row pl-4 pr-4 text-justify">
        <div class="col-md-3 pr-0 mt-2">
           <strong>Course Image:</strong>
        </div>
        <div class="col-md-9 mb-4 text-center">
            <div class="form-group files color">
                <input type="file" name="fileToUpload" accept="image/*">
            </div>
        </div>
</div>

<!-------- Upload Image -------->

<div class="row text-center pb-5">
    <div class="col-md-6 offset-md-3">
<input type="submit" name="create-course" class="btn btn-primary" value="Create a Course">            
</div>
</div>
</div>
</form>










