<?php   
session_start();

    if(isset($_SESSION["user_id"])){

        $user_id = $_SESSION["user_id"];

    }else{


}

if (isset($_GET["unregister"])) {
    
    $id = $_GET["unregister"];

    include ('include/connection.php');

    $unreg = " DELETE FROM `enrollment` WHERE `enrollment`.`course_id` = '$id' AND  `enrollment`.`user_id` = '$user_id'";

   if (mysqli_query($conn, $unreg)) {
        
        $_SESSION["alerts_info"] = "You have unregistered from course ID: $id All work completed will be saved incase you change your mind, Thank you for choosing us.";

    }

}


$page_title = "Courses";


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
        <div style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
          <div class="font-weight-bold text-uppercase bg-shadow text-light h5 bg-secondary p-2 "><?php echo $course_title; ?></div>
        </div>

          <div class="card-body">
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

            <a href="<?php echo $link; ?>" title="click to go to details page" class="btn btn-primary">Continue...</a>
            <a href="courses.php?unregister=<?php echo $row["course_id"]; ?>" title="click to unregister from course" class="text-secondary pl-2 small">unregister</a>

            <?php

        }else{

            ?>
            <a href="<?php echo $link; ?>" class="btn btn-success btn-block">Register</a>
             <?php
             
        }

        }else{

          echo  '<a href="register.php?info=login" class="btn btn-success btn-block">Login to Register</a>';    
        }
            ?>
          </div>
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
</div>
<?php include 'footer.php'; ?>





