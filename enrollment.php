<?php 

session_start();

    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];

    }else{

      header("location: courses.php?info=login");;

        exit();
    }


     if(isset($_GET["cid"])){
         $course_id = $_GET["cid"];

         $page= "enrollment.php?cid=$course_id";   

    }else{
        
         
       header("Location: courses.php");

        exit();

    }           

                include 'include/connection.php'; 

                $sql = "SELECT * FROM enrollment WHERE enrollment.course_id = $course_id AND enrollment.user_id = $user_id";
                $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)){
                            //enoll id from database
                            $enroll_id = $row["enroll_id"];
                            
                    //send user to topics page
                    $link = "topics.php?eid=$enroll_id&cid=$course_id";

                    header("location: $link");  

                    exit();
                  }
              }
    
       
        //insert enrollment information from database

                include "include/connection.php";

                        if(isset($_POST["enroll"])){

                        $sql = "INSERT INTO `enrollment` (`enroll_id`, `course_id`, `user_id`) VALUES (NULL, '$course_id', '$user_id');";

                        if (mysqli_query($conn, $sql)) {

                    $enroll_id = mysqli_insert_id($conn);

                    $link = "topics.php?eid=$enroll_id&cid=$course_id";

                    header("location: $link");

                    exit();

                        
                } else {
                    
                    echo "Error with server connection";
                
                }
            }


$page_title = "Enrollment";

include 'header.php'; ?>


<div class="banner" style="background-image: url(images/2.jpg);">
    
</div>


     <?php 
include 'include/connection.php'; 

                $sql = "SELECT * FROM courses WHERE course_id = $course_id";
                $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)){
                            //enoll id from database
                         
                            $course_title =$row["course_title"];

                       }
                   }



         $sql = "SELECT * FROM enrollment WHERE user_id = '$user_id' AND completion = 'incomplete'";

                $result = mysqli_query($conn, $sql);

                if($result){

                if (mysqli_num_rows($result) == 2) {


                            ?>

                    <div class="container p-3 my-3 bg-light">

                    <div class="card">
                        <div class="card-header pb-3 text-center">
                          <h1>Enrollment</h1>
                        </div>
                        
                    <h3 class="p-5">You are only allowed to ebroll in two courses at a time, please complete any outstanding courses to continue.</h3>

                    <div class="text-center p-3">
                       <a class="btn btn-primary" title="go back to course page" href="courses.php">Go Back</a>
                    </div>
                    </div>
              </div>  
                        
                      <?php


                        }else{

                          ?>

<div class="container p-3 my-3 bg-light">
    <div class="card-header text-center"><h1>Enrollment</h1></div>
  
<form action="<?php echo $page; ?>" method="post">
    
<h3 class="p-5">Thank you for choosing our <b><?php echo $course_title; ?></b> Course please Click next to enroll into this course</h3>

<div class="p-3">

<a class="btn btn-danger" href="courses.php">Cancel</a>

<input class= "btn btn-success" type=submit value="Next" name="enroll">

</div>
</form>

</div>

<?php

    }

  }

?>



<?php include 'footer.php'; ?>