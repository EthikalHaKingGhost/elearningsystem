<style type="text/css">
  .modal-backdrop {
    z-index: 1020;
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

if (isset($_GET["delete"])) {
    
    $delete_id = $_GET["delete"];

    $delete1 = "DELETE FROM `enrollment` WHERE `enrollment`.`course_id` = '$delete_id'";

    if (mysqli_query($conn, $delete1)){

          $_SESSION["alerts_success"] = "All enrollments deleted from Course.";
    }


    $delete2 = "DELETE FROM `topics_assigned` WHERE `topics_assigned`.`course_id` = '$delete_id'";

     if (mysqli_query($conn, $delete2)){

        $_SESSION["alerts_success"] = "Deleted all topics assigned to Course.";
    }

    $delete = "DELETE FROM `courses` WHERE `courses`.`course_id` = '$delete_id';";


if (mysqli_query($conn, $delete)) {

   $_SESSION["alerts_success"] = "Course deleted permanently";

} else {

 $_SESSION["alerts_danger"] = " Error deleting course";

}

}

include 'alerts.php';


?>

<div class="container bg-light mt-2 p-3 rounded-lg">

<div class="card-body rounded-0">
<?php 

include 'connection.php';

//code to show recent courses added

        $sql = "SELECT * FROM courses ORDER BY `Courses`.`date_created` DESC";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                            
        $courseid = $row["course_id"]; 
        $coursetitle = $row["course_title"];
        $course_description = $row["course_description"];
        $courseimg = $row["course_img"]; 
        $deletecourse = "dashboard.php?delete=$courseid#!tab0=2"; 
        $edit = "courseedit.php?cid=$courseid";

        $max = 100; // or 200, or whatever
        if(strlen($course_description) > $max) {
                              // find the last space < $max:
        $shorter = substr($course_description, 0, $max+1);
        $description = substr($course_description, 0, strrpos($shorter, ' ')).'...';
        }elseif (strlen($course_description) < $max){

            $description = $course_description."...";
        }

    ?>

<div class="row py-auto my-2">

<div class="row p-0 m-0 border bg-white">    
 <div class="col-md-2 m-0 p-0">
   <a href="editcourse.php"><img class="card-img-top border rounded-0" src="<?php echo "$courseimg"; ?>" alt="Image" height="100" width="100"></a>
 </div> 
  
  <div class="col-md-8 rounded-0 my-auto">
    <h5 class="text-left bold"><?php echo $coursetitle; ?></h5>
    <p class="card-text text-justify font-italic"><?php echo $description; ?></p>
  </div>

  <div class="col-md-2 rounded-0">
    <form action="<?php echo $edit ?>" method="post">
                  <input class="btn btn-info btn-sm btn-block mt-3" type="submit" value="Edit">
        </form>
      <form action="<?php echo $deletecourse ?>" method="post">
                <input type="hidden" name="${_csrf.parameterName}" value="${_csrf.token}"/>
                <input type="hidden" name="delete_id" value="<?php echo $courseid ?>"/>
                <input type="submit" class="btn btn-danger btn-sm btn-block delete" name="delete" value="Delete"/>
          </form>
            
  </div>
</div>
</div>
        
<?php

  }                
          }else{

          ?>

            <div class="display-4 text-center">No Courses Available</div>

          <?php

        }

    ?>
</div>
</div>




