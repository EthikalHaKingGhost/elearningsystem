<?php   
session_start();

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


        ?>
        <div class="col-md-3 mt-4 ">
        <div class="bg-shadow bg-light">
        <div class="card border-0">
        <img class="card-img-top rounded-0" src="<?php echo "images/$course_img"; ?>" alt="Card image cap">
        <div class="h6 font-weight-bold text-uppercase" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
            <?php echo $course_title; ?></div> 
        </div>
      
          <div class="card-body">
            <p class="card-text text-justify">
                <?php echo $course_description; ?>
                </p>
                <?php

                  $check = "SELECT * FROM courses, enrollment WHERE enrollment.course_id = '$course_id' AND enrollment.user_id = {$_SESSION["user_id"]}";

                 $checkqry = mysqli_query( $conn, $check );
                //if no records exist
                if(mysqli_num_rows($checkqry) > 0)
                {

            ?>

            <a href="<?php echo $link; ?>" class="btn btn-info btn-block rounded-0">Continue...</a>

            <?php

        }else{
?>
            <a href="<?php echo $link; ?>" class="btn btn-success btn-block rounded-0">Enroll</a>
<?php
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





