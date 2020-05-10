<?php   
session_start();

    if(isset($_SESSION["user_id"])){

        $user_id = $_SESSION["user_id"];

    }else{


}


$page_title = "Courses";

 print_r($_SESSION);  


include 'header.php'; ?>


<div class="banner" style='background-image: url("images/2.jpg")' ;>


</div>

<div class="card-header bg-shadow page-title text-center">
<h1><i class="fas fa-graduation-cap"></i> Courses</h1>
    <p><em>Enroll in some of the newest courses</em></p>
</div>

<div class="container-fluid" style="background-image: url('images/blur-background12.jpg');  background-size: cover; background-size: no-repeat; ">


<div class="row text-center">

<?php


if (isset($_POST["delete_course"])) {
    
    $delete_id = $_POST["delete_course"];

    $sql = "DELETE FROM `courses` WHERE course_id = $delete_id";

    $sql ="DELETE FROM `enrollment` WHERE course_id = $delete_id";

   $sql = "DELETE FROM `topics_assigned` WHERE course_id = $delete_id";

        if (mysqli_query($conn, $sql)) {
          echo "Record deleted successfully";

        } else {
          echo "Error deleting record: " . mysqli_error($conn);
        }

        echo $sql;
   
        }


include 'include/connection.php'; 

        $sql = "SELECT * FROM courses";

        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                            
        $date_created = $row["date_created"];
        $time = strtotime($date_created);
        $date = date("m/d/y g:i A", $time);
                        
        $course_id = $row["course_id"]; 
        $course_title = $row["course_title"];
        $course_description = $row["course_description"];
        $course_img = $row["course_img"];
        $link = "enrollment.php?cid=$course_id";

        $max = 80; // or 200, or whatever
        if(strlen($course_description) > $max) {
                              // find the last space < $max:
        $shorter = substr($course_description, 0, $max+1);
        $description = substr($course_description, 0, strrpos($shorter, ' ')).'...';
        }elseif (strlen($course_description) < $max){

            $description = $course_description."...";
        }

        ?>
        <div class="col-md-3 mt-4 ">
        <div class="bg-shadow bg-light">
        <div class="card border-0">
        <img class="card-img-top rounded-0" src="<?php echo "$course_img"; ?>" alt="Card image cap" style="width:auto; height:250px;">
<?php

if (isset($_SESSION["user"])) {

        if($_SESSION["user"] == "Admin"){

            ?>
        <div style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
        <form action="courses.php" method="post">
        <button class="p-2 btn btn-danger" type="submit" name="delete_course" value="<?php echo $course_id; ?>">remove <i class="fas fa-trash"></i></button> 
        </form>

        </div> 
       
            <?php

                }else{



                }

        }
  ?>      
        </div>
          <div class="card-body">
            <div><?php echo $course_title; ?></div>
            <p class="card-text text-justify">
                <?php echo $description; ?>
                </p>
                <?php

                if (isset($_SESSION["user_id"])) {
                    
                  $check = "SELECT * FROM courses, enrollment WHERE enrollment.course_id = '$course_id' AND enrollment.user_id = '$user_id'";

                 $checkqry = mysqli_query( $conn, $check );
                //if no records exist
                if(mysqli_num_rows($checkqry) > 0)
                {

            ?>

            <a href="<?php echo $link; ?>" class="btn btn-primary btn-block">Continue...</a>

            <?php

        }else{
?>
            <a href="<?php echo $link; ?>" class="btn btn-success btn-block">Enroll</a>
<?php
        }

        }else{

          echo  '<a href="register.php?info=login" class="btn btn-success btn-block">Enroll</a>';    
        }
            ?>
          </div>
        </div>
        </div>
       
        <?php 

        }
                        
          }else{

            echo "No courses Available please return to courses page <a href='index.php'> Home Page</a>";

        }

    ?>
  </div>
 </div>

<?php include 'footer.php'; ?>





