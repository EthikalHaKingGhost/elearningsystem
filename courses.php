
<?php   

session_start();

include 'header.php'; ?>


<?php  include 'include/connection.php'; ?>


<div class="banner">
  

</div>



<div class="container-fluid pb-4">
        <div class="card-header page-title text-center">
<h1><i class="fas fa-graduation-cap"></i> Courses</h1>
    <p><em>Enroll in some of the newest courses</em></p>
</div>
<div class="row text-center">

<?php

        $sql = "SELECT * FROM Courses";
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
        <div class="col-md-4 mt-4">
        <div class="card">
        <img class="card-img-top" src="<?php echo "images/$course_img"; ?>" alt="Card image cap">
          <div class="card-body">
            <p class="card-text">
                <?php echo $course_description; ?></p>
            <h5 class="card-title"><?php echo $course_title; ?></h5> 
            <a href="<?php echo $link; ?>" class="btn btn-secondary">Begin Course</a>
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





